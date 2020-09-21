<?php

namespace Api\Controllers;

use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeopleController extends APIController
{

    function __construct()
    {
        parent::__construct();
    }

    function index(Request $request, People $model) {
        try {

            if($request->q != null) {
                $data = $model->where('fullname','like', "%$request->q%")->paginate(10);
            } else {
                $data = $model->paginate(10);
            }

            $this->success['data'] = [
                'results' => $data
            ];

            return resJSON($this->success);
        } catch (\Throwable $th) {
            $this->error['message'] = $th->getMessage();

            return resJSON($this->error);
        }
    }

    function store(Request $request, People $model) {
        try {
            DB::beginTransaction();
            $model->uuid     = Str::uuid();
            $model->fullname = $request->fullname;
            $model->birthday = $request->birthday;
            $model->gender   = $request->gender;
            
            $model->save();
            DB::commit();
            $this->success['message'] = __('Saved Successful.');
            $this->success['data'] = $model->id;

            return resJSON($this->success);
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->error['message'] = $th->getMessage();

            return resJSON($this->error);
        }
    }

    function show(Request $request, $key) {
        try {
            $data = People::where('uuid', $key)->orWhere('id', $key)->firstOrFail();

            $this->success['data'] = $data;

            return resJSON($this->success);
        } catch (\Throwable $th) {
            $this->error['message'] = $th->getMessage();

            return resJSON($this->error);
        }
    }

    function destroy(Request $request, $key) {
        try {

            $data = People::where('uuid', $key)->orWhere('id', $key)->delete();

            $this->success['message'] = __('Deleted Successful.');

            return resJSON($this->success);
        } catch (\Throwable $th) {
            $this->error['message'] = $th->getMessage();

            return resJSON($this->error);
        }   
    }
}
