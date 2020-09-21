<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    protected $view  = 'article';

    function __construct()
    {
        parent::__construct();
        $this->base             = route($this->view.'.index');
        $this->data['resource'] = $this->view;
        $this->view             = $this->template.$this->view;
    }

    public function index(Article $model, Request $req) {

        if($req->get('search') != '') {

            $serach = strtolower($req->get('search'));

            $model = $model->where(DB::raw('LOWER(title)'), "LIKE", "%$serach%");
        }
        
        $this->data['results'] = $model->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    public function create() {
        $this->data['categories'] = ArticleCategory::all();
        return view($this->view.'.form', $this->data);
    }

    public function show() {

    }

    public function edit(Article $model, $id) {
        $this->data['data'] = $model->find($id)->first();
        return view($this->view.'.form', $this->data);
    }

    public function store(Article $model, Request $req) {

        try {   
            DB::beginTransaction();
            
            if(isset($req->id)) {
                $model = Article::find($req->id)->first();
            }

			$model->title         = $req->title;
			$upload               = $this->upload($req->file('cover'));
			$model->cover         = $upload['uuid'];
			$model->permalink     = $req->permalink;
			$model->content       = $req->content;
			$model->description   = $req->description;
			$model->tags          = $req->tags;
			$model->category_id   = $req->category_id;

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

    public function destroy(Article $model, $id) {

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
