<?php

namespace TrusCRUD\Core\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    
    public function error($code)
    {
        return view('errors.'.$code);
    }
}
