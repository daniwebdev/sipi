<?php
namespace FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicController extends Controller
{   
    public $template = '_frontend.default.';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $data = [];

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(conf('default-page')) {
            return view(conf('default-page'));
        } else {
            return view($this->template.'index', $this->data);
        }
    }
}
