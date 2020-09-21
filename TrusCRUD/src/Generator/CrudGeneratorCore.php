<?php
namespace TrusCRUD\Generator;

use TrusCRUD\Core\Models\AccessMenu;
use TrusCRUD\Core\Models\AccessRoleToMenu;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/*
    Generate Controller, Model, Migration, Route
*/
trait CrudGeneratorCore {

    use Generator;

    //Create Controller With Scaffold
    function controller($cmd) {
        $name             = $this->name."Controller";
        $this->controller = $name;

        $location = app_path('Http/Controllers/'.$this->controller.'.php');
        $check    = file_exists($location);

        if($check) {
            $cmd->info("<error>Controller already exists!</error>\n");
        } else {
            //Make Controller with artisan command
            Artisan::call("make:controller ".$this->controller);
            $output = Artisan::output();
            $cmd->info($output);

            $stub               = $this->getStub('Controller');
            $nameCamel          = $this->name;
            $nameUndescore      = $this->from_camel_case($nameCamel);
            $fields             = $this->make_field_controller();
            $fields_oncreate    = $this->make_field_controller_oncreate();
            $searchable         = $this->searchable;
            $load_class         = '';

            if($this->with_uuid) {
                $load_class .= 'use Illuminate\Support\Str;';
            }

            $full_code     = str_replace(
                [
                    '{{nameCamel}}', 
                    '{{nameUnderscore}}', 
                    '{{fields}}', 
                    '{{searchable}}',
                    '{{load_class}}',
                    '{{fields_oncreate}}',
                ],
                [
                    $nameCamel,
                    $nameUndescore,
                    $fields,
                    $searchable,
                    $load_class,
                    $fields_oncreate
                ],
                $stub
            );

            file_put_contents($location, $full_code);
        }
    }

    //Create Model and Migration
    function model_migration($cmd) {
        $location = app_path('Models/'.$this->name.'.php');
        $check    = file_exists($location);

        if(!$check) {
            Artisan::call("make:model -m $this->name");
            $output           = Artisan::output();
            $cmd->info($output);
            $output           = explode("\n", $output);
            $nameMigration    = preg_replace("/Created Migration: (.*)/", "$1", $output[1]);
            $nameMigration    = str_replace("\r", "", $nameMigration);
            $columns          = $this->make_field_migration();
            
            $migration_path   = base_path('database/migrations/'.$nameMigration.".php");
            $migration_stub   = file_get_contents($migration_path);
    
            $migration_code   = str_replace("\$table->id();", "\n$columns", $migration_stub);
    
            File::put($migration_path, $migration_code);
            
            //Load Relation
            $this->model_related();

            //Move To Models
            // $path           = base_path('app/'.$this->name.'.php');
            // rename($path, base_path('app/Models/'.$this->name.'.php'));
        } else {
            $cmd->info("<error>Model already exists!</error>\n");
            $cmd->info("<error>=> $location</error>\n");
        }
    }

    //Build Model Relation
    function model_related() {
        try {
            $count_related = 0;
            $output        = '';

            if($this->softDelete) {
                $output .= "\tuse \Illuminate\Database\Eloquent\SoftDeletes; //Enable SoftDelete\n\n\n";
            }

            if(count($this->relations) > 0) {
                $getStub     = $this->getStub('Related');
                foreach($this->relations as $relate) {
                    $lower       = str_replace('_id', '', $relate['fk']);

                    $output     .= str_replace(
                        ['{{lower_name}}','{{class_name}}', '{{type}}',      '{{fk}}'], 
                        [$lower,          $relate['class'],       $relate['type'], $relate['fk']
                    ], $getStub);
                }
                $count_related++;
            }

            foreach($this->columns as $k => $col) {

                if(isset($col['form_as']) && $col['form_as']['type'] == 'upload') {

                    $getStub     = $this->getStub('RelatedUpload');
                    $output     .= str_replace('{{lower_name}}', $col['name'], $getStub);
                }
            }
    
            $path           = app_path('Models/'.$this->name.'.php');
            $getModel       = file_get_contents($path);
            $append_related = str_replace('//', "\n".$output, $getModel);
            
            File::put($path, $append_related);

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }
    
    function make_field_migration() {
        $code = "\t\t\t\$table->id();\n";
        
        if($this->with_uuid) {
            $code .= "\t\t\t\$table->uuid('uuid')->index();\n";
        }

        foreach($this->columns as $col) {
            $name = $col['name'];
            $type = $col['type'];
            
            $code .= "\t\t\t\$table->$type('$name')";
            
            if(isset($col['options']['nullable']) && $col['options']['nullable'] == 1) {
                $code .= "->nullable()";
            }

            //Set Column Index
            if(isset($col['options']['index']) && $col['options']['index'] == 1) {
                $code .= "->index()";
            }

            //Set Column Default Value
            if(isset($col['options']['default']) && $col['options']['default'] != '') {
                $code .= "->default(".$col['default'].")";
            }

            $code .= ";\n";

        }

        if($this->softDelete) {
            $code .= "\t\t\t\$table->softDeletes();\n";
        }

        return $code;
    }
    
    function add_route() {
        $path          = base_path('routes/app.php');
        $nameUndescore = $this->name_underscore;
        
        $code = str_replace(['{{nameUndescore}}', '{{nameController}}'], [$nameUndescore, $this->controller], $this->getStub('Route'));
        
        File::append($path, $code);
    }


    function make_field_controller() {
        $code = '';

        foreach($this->columns as $col) {
            $name = $col['name'];
            
            if(isset($col['form_as']['type']) && $col['form_as']['type'] == 'upload') {
                $part = "\t\t\t\$upload             = \$this->upload(\$req->file('$name'));\n";
                $part .= "\t\t\t\$model->$name      = \$upload['uuid'];\n";
                $code .= $part;
            } else {
                $code .= "\t\t\t\$model->$name      = \$req->$name;\n";
            }
        }

        return $code;
    }

    function make_field_controller_oncreate() {
        $code = '';
        // {{fields_oncreate}}
        if($this->with_uuid) {
            $code .= '$model->uuid = Str::uuid();';
        }

        return $code;
    }

    function add_menu() {
        try {
            DB::beginTransaction();
            $title               = $this->underscore_to_space($this->from_camel_case($this->name));
            $model               = new AccessMenu();
            $model->uuid         = Str::uuid();
            $model->title        = ucwords($title);
            $model->route_name   = $this->name_underscore.'.index';
            $model->url          = "/".$this->name_underscore;
            $model->description  = "";
            $model->parent_id    = 0;
            $model->icon         = "fa fa-box-open";
            $model->actions      = '["show","create","index","edit","delete"]';
            $model->order        = $model->where('parent_id', 0)->orderBy('order', 'desc')->first()->order+1;
            $model->save();
    
            $menu_id = $model->id;
            $actions = ["show","create","index","edit","delete"];

            foreach($actions as $act) {
                $form['access_action_suffix']  = $act;
                $form['access_menu_id']        = $menu_id;
                $form['access_role_id']        = 1; //SuperAdmin
                
                AccessRoleToMenu::create($form);
            }
            Cache::flush();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

}