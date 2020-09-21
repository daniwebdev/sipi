<?php

namespace TrusCRUD\Core\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use TrusCRUD\Core\Models\Generator;

class GeneratorController extends Controller
{

    protected $view  = 'generator';

    function __construct()
    {
        parent::__construct();
        $this->base             = route($this->view.'.index');
        $this->data['resource'] = $this->view;
        $this->view             = $this->template.$this->view;
    }

    public function index(Generator $model, Request $req) {

        if($req->get('search') != '') {

            $serach = strtolower($req->get('search'));

            $model = $model->where(DB::raw('LOWER(name)'), "LIKE", "%$serach%");
        }
        
        $this->data['results'] = $model->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    public function create() {
        return view($this->view.'.form', $this->data);
    }

    public function show() {

    }

    public function edit( $model, $id) {
        $this->data['data'] = $model->find($id)->first();
        return view($this->view.'.form', $this->data);
    }



    public function store(Generator $model, Request $req) {

        try {   
            DB::beginTransaction();
            if(isset($req->id)) {
                $model = Generator::find($req->id);
            }

			$model->name      = $req->name;
			$model->config      = $req->config;
			$model->status      = $req->status;


            $model->save();

            $status  = 'success';
            $message = "Save Successfully";
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

    public function destroy(Generator $model, $id) {

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


    //GUI Builder
    function build_view(Request $req) {
        $name      = '';
        $form_html = '';
        $column    = '';

        $response = [
            "status" => true,
            "message" => "Resource successful generated." 
        ];
        return response()->json($response);
    }

    function build_controller(Request $req) {
        $response = [
            "status" => true,
            "message" => "Controller successful generated." 
        ];
        return response()->json($response);
    }

    function build_model(Request $req) {
        $response = [
            "status" => true,
            "message" => "Model successful generated...\nMigration successful generated..." 
        ];
        return response()->json($response);
    }

    function build_migrate(Request $req) {
        $response = [
            "status" => true,
            "message" => "Migrate successful generated." 
        ];
        return response()->json($response);
    }

}
