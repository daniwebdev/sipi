<?php
namespace TrusCRUD\Builder\Params;


trait BuilderComponent {

    public $name;
    public $name_underscore;
    public $columns          = [];
    public $relations        = [];
    public $viewDir;
    public $searchable       = 'name';
    public $controller       = '';
    public $location         = 'TrusCRUD/src/Generator';
    public $column_key       = '';
    public $softDelete       = 0;
    private $with_menu       = 1;
    private $with_uuid       = 0;
    public $cmd;

}