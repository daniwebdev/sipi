<?php
/*
 * This file generated by TrusCRUD.
 *
 * (c) M. Yusup Hamdani <me@dani.work>
 * website: www.dani.work
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;
use TrusCRUD\Helpers\Role;

class ContractController extends Controller
{

    protected $view  = 'contract';

    function __construct()
    {
        parent::__construct();
        $this->base             = route($this->view.'.index');
        $this->data['resource'] = 'contract';
        $this->view             = $this->template.$this->view;
    }

    public function index(Contract $model, Request $req) {

        if($req->get('search') != '') {

            $serach = strtolower($req->get('search'));

            $model = $model->where(DB::raw('LOWER(project_name)'), "LIKE", "%$serach%");
        }
        
        $this->data['results'] = $model->orderByDesc('id')->paginate(10);

        return view($this->view.'.index', $this->data);
    }

    public function create() {
        return view($this->view.'.form', $this->data);
    }

    public function show() {

    }

    public function edit(Contract $model, $id) {
        $this->data['data'] = $model->find($id);
        // dd($this->data['data']->toArray());
        return view($this->view.'.form', $this->data);
    }

    public function store(Contract $model, Request $req) {

        // dd($req->all());
        try {   
            DB::beginTransaction();
            if(isset($req->id)) {
                $model = Contract::where('id', $req->id)->first();
            } else {
                
            }
            $model->id                      = $req->id;
            $model->no_contract             = $req->no_contract;
            $model->project_name            = $req->project_name;
            $model->customer                = $req->customer;
            $model->end_customer            = $req->end_customer;
            $model->project_year            = $req->project_year;
            $model->total_contract_value    = getInt($req->total_contract_value);
            $model->start_contract          = implode('-', array_reverse(explode('/', $req->start_contract)));
            $model->end_contract            = implode('-', array_reverse(explode('/', $req->end_contract)));
            $model->status_contract         = $req->status_contract;

			$model->balance                 = $model->total_contract_value;

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

    public function destroy(Contract $model, $id) {

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
