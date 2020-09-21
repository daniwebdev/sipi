<?php
namespace App\Http\Controllers;

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
        $this->data['count'] = [
            "users" => User::count()
        ];

        Role::isAllow("show");


        return view($this->template.'.dashboard.main', $this->data);
    }
}
