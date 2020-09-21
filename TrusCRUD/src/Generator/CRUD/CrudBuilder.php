<?php
namespace TrusCRUD\Generator\CRUD;

use TrusCRUD\Generator\CrudGenerator;

class CrudBuilder extends CrudGenerator {


    public function run($cmd) {
        $this->cmd = $cmd;

        //Add Mode All Class CRUD Generator
        $this->call(Invitation::class);
        //.................................
        //Add More
    }

}