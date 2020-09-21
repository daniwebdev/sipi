<?php
namespace TrusCRUD\Generator\CRUD;

use TrusCRUD\Generator\CrudGenerator;

class People extends CrudGenerator {

    public function initial() {
        
        $this->setName('People');
        
        $this->setSearchable('fullname');

        $this->withMenu(true); //FALSE = menu not generate
        $this->withUUID(true); //FALSE = menu not generate

        $this->addColumn('fullname', 'string')->setOption([
            'index' => 1
        ]);
        
        $this->addColumn('birthday', 'date')->setOption([
            'nullable' => 1
        ]);

        $this->addColumn('gender', 'string')->setOption([
            'nullable' => 1
        ]);
    }

}