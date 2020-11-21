<?php
namespace App\Http\Controllers;

use App\Models\Contract;
use TrusCRUD\Helpers\Role;
use App\Models\User;
use Illuminate\Http\Request;

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

        $this->data['total_contract'] = Contract::sum('total_contract_value'); 
        $this->data['total_contract_unpaid'] = Contract::sum('balance'); 
        $this->data['total_contract_paid'] = $this->data['total_contract']-$this->data['total_contract_unpaid']; 


        return view($this->template.'.dashboard.main', $this->data);
    }
}
