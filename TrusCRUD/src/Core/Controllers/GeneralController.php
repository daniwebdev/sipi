<?php

namespace TrusCRUD\Core\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Gate;

class GeneralController extends Controller
{
    protected $base  = '/profile';
    protected $view  = '.general';

    function __construct()
    {
        parent::__construct();
        $this->data['base'] = $this->base;
        $this->view = $this->template.$this->view;
    }

    function profile(Request $req) {

        return view($this->view.'.profile', $this->data);
    }
    
}
