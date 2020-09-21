<?php
namespace TrusGenerator;

use TrusCRUD\Generator\CrudGenerator;

class Generator extends CrudGenerator {


    public function run($cmd) {
        $this->cmd = $cmd;

        //Add Mode All Class CRUD Generator
        $this->call(Invoice::class);
        $this->call(Purchase::class);
        //.................................
        //Add More
    }

}