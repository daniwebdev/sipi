<?php
namespace TrusCRUD\Generator;

use Illuminate\Support\Facades\File;

/*
    Generate Controller, Model, Migration, Route

*/
trait CrudGeneratorAPI {

    use Generator;

    function makeApi() {
        if($this->makeApiController()) {
            $this->makeApiRoute();
        }
    }

    function makeApiController() {
        $path       = base_path('api/Controllers/');
        $location   = $path.$this->controller.'.php';
        $check      = file_exists($location);

        if(!$check) {
            $stub               = $this->getStub('api/Controller');
            $nameCamel          = $this->name;
            $nameUndescore      = $this->from_camel_case($nameCamel);
            $fields             = $this->make_field_api_controller();
            $searchable         = $this->searchable;
            $load_class         = '';
            $primaryKey         = $this->with_uuid ? 'uuid':'id';

            $full_code     = str_replace(
                [
                    '{{nameCamel}}', 
                    '{{nameUnderscore}}', 
                    '{{fields}}', 
                    '{{searchable}}',
                    '{{load_class}}',
                    '{{primaryKey}}',
                ],
                [
                    $nameCamel,
                    $nameUndescore,
                    $fields,
                    $searchable,
                    $load_class,
                    $primaryKey
                ],
                $stub
            );

            $path = base_path('api/Controllers/').$this->controller.'.php';
            File::put($path, $full_code);

            $this->cmd->info('API Controller Generated: <bold>'.$path.'</bold>');

            return true;
        } else {
            $this->cmd->error('Api Controller exists!');
            $this->cmd->line('=> : '.$location);

            return false;
        }

    }

    function makeApiRoute() {
        //Route API
        $nameUndescore = $this->name_underscore;
        $path = base_path('api/Routes/api.php');
    
        $code = str_replace([
                '{{nameUndescore}}', 
                '{{nameController}}'
            ], [
                $nameUndescore, 
                $this->controller
            ],
        $this->getStub('api/RouteApi'));

        File::append($path, $code);
        $this->cmd->info('API Route Added: <bold>'.$path.'</bold>');
    }

    private function make_field_api_controller() {
        $code = '';

        foreach($this->columns as $col) {
            $name = $col['name'];
            $code .= "\t\t\t\$model->$name      = \$request->$name;\n";
        }

        return $code;
    }

}