<?php
namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Invoice;
use TrusCRUD\Helpers\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Role::isAllow("show");

        $this->data['count'] = [
            "users" => User::count()
        ];

        $this->data['total_contract']        = Invoice::sum('total_invoice'); 
        $this->data['total_contract_unpaid'] = Invoice::where('status', 'UNPAID')->sum('total_invoice'); 
        $this->data['total_contract_paid']   = $this->data['total_contract']-$this->data['total_contract_unpaid']; 

        $months = range(1,12);
        $total_invs = [];

        foreach($months as $value) {
            $bln = date('Y', time()+60*60*7).str_pad($value, 2, 0, STR_PAD_LEFT);

            $total_invs[] = Invoice::where(DB::raw('DATE_FORMAT(date_invoice, "%Y%m")'), $bln)->where('status', 'PAID')->sum('total_invoice');
        }

        $this->data['total_invoice'] = json_encode($total_invs);

        return view($this->template.'.dashboard.main', $this->data);
    }
}
