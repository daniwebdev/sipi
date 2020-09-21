<?php
namespace Api\Controllers;

use App\Http\Controllers\Controller;
use stdClass;

class APIController extends Controller {
    public $success = [];
    public $error = [];
    
    function __construct()
    {
        parent::__construct();
        $this->success = [
            'status'    => true,
            'message'   => 'Request Successfully.',
            'data'      => new stdClass()
        ];

        $this->error = [
            'status'  => false,
            'message' => 'Request Failed.',
            'error'   => 'Error.',
            'data'    => new stdClass(),
        ];
    }
}