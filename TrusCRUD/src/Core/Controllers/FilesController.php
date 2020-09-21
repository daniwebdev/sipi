<?php

namespace TrusCRUD\Core\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TrusCRUD\Core\Models\Files;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FilesController extends Controller
{

    protected $view  = 'files';

    function __construct()
    {
        parent::__construct();
        $this->base             = route($this->view.'.index');
        $this->data['resource'] = $this->view;
        $this->view             = $this->template.$this->view;
    }

    public function index(Files $model, Request $req) {

        if($req->get('search') != '') {

            $serach = $req->get('search');

            $model = $model->where('original_name', "LIKE", "%$serach%");
        }

        $this->data['results'] = $model->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    public function create() {
        return view($this->view.'.form', $this->data);
    }

    public function show() {

    }

    public function edit(Files $model, $id) {
        $this->data['data'] = $model->find($id)->first();
        return view($this->view.'.form', $this->data);
    }

    public function store(Files $model, Request $req) {

        try {   
            DB::beginTransaction();

            // if(isset($req->id)) {
            //     $model = Files::find($req->id);
            // }

            // $model->uuid            = Str::uuid();
            // $model->name            = $req->filename;
            // $model->last_modified   = $req->last_modified;
            // $model->original_name   = $req->filename;
            // $model->parent_id       = $req->directory_id;
            // $model->size            = $req->filesize;
            // $model->path            = 'data/'.$req->filename;
            // $model->url             = 'data/'.$req->filename;

            // $model->save();

            $this->upload($req->file('file'));

            $data    = $model->toArray();
            $status  = 'success';
            $message = "Save Successfully";

            DB::commit();
        } catch (\Exception $er) {
            DB::rollBack();
            $status  = 'error';
            $message = $er->getMessage();
        }

        $response = [
            'status'  => $status,
            'message' => $message
        ];
        if(isset($data)) {
            $response['data'] = $data;
        }
        return response()->json($response);

        return redirect($this->base)->with('status', $status)->with('message', $message);
    }


    public function update() {

    }

    public function destroy(Files $model, $id) {

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
