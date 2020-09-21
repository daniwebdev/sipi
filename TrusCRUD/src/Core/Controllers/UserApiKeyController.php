<?php

namespace TrusCRUD\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TrusCRUD\Core\Models\UserApiKey;
use Illuminate\Support\Facades\DB;

class UserApiKeyController extends Controller
{

    protected $view  = 'user_api_key';

    function __construct()
    {
        parent::__construct();
        $this->base             = route($this->view.'.index');
        $this->data['resource'] = $this->view;
        $this->view             = $this->template.$this->view;
    }

    public function index(UserApiKey $model, Request $req) {

        if($req->get('search') != '') {

            $serach = strtolower($req->get('search'));

            $model = $model->where(DB::raw('LOWER(label)'), "LIKE", "%$serach%");
        }
        
        $this->data['results'] = $model->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    public function create() {
        return view($this->view.'.form', $this->data);
    }

    public function show() {

    }

    public function edit(UserApiKey $model, $id) {
        $this->data['data'] = $model->find($id)->first();
        return view($this->view.'.form', $this->data);
    }


    function v5($name) {
        $hash = sha1($name, false);
        return sprintf(
            '%s-%s-5%s-%s-%s',
            substr($hash,  0,  8),
            substr($hash,  8,  4),
            substr($hash, 17,  3),
            substr($hash, 24,  4),
            substr($hash, 32, 12)
        );
    }
    public function store(UserApiKey $model, Request $req) {

        try {   
            DB::beginTransaction();
            $user = auth()->user();

            if(isset($req->id)) {
                $model = UserApiKey::find($req->id);
            } else {
                $model->key         = strtoupper($this->v5($user->id));
            }

			$model->label        = $req->label;
			$model->user_id      = is_super() ? $req->user_id:$user->id;

            $model->save();

            $status  = 'success';
            $message = "Saved Successfully.";
            DB::commit();
        } catch (\Exception $er) {
            DB::rollBack();
            $status  = 'error';
            $message = $er->getMessage();
        }

        if($req->get('format') == 'json') {
            $response = [
                'status' => $status,
                'message' => $message,
            ];
            return response()->json($response);
        }

        return redirect($this->base)->with('status', $status)->with('message', $message);
    }


    public function update() {

    }

    public function destroy(UserApiKey $model, $id) {

        try {
            $model->where('id', $id)->delete();
            $status  = true;
            $message = 'Delete Successfully.';
        } catch (\Exception $err) {
            $status  = false;
            $message = $err->getMessage();
        }

        $output['status']   = $status;
        $output['message']  = $message;

        return response()->json($output);
    }

}
