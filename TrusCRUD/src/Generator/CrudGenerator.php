<?php
namespace TrusCRUD\Generator;

use TrusCRUD\Core\Models\Generator as GModel;
use TrusCRUD\Generator\CrudGeneratorView;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

/**
 * Class CrudGenerator
 * First Class Running on Generate a CRUD
 */
class CrudGenerator {

    use CrudGeneratorView;
    use CrudGeneratorCore;
    use CrudGeneratorAPI;

    public function __construct() {

    }

    public function build(Command $cmd) {
        $this->cmd = $cmd;

        $this->name_underscore = $this->from_camel_case($this->name);
        
        $this->saveConfigToDb();

        if($this->with_menu) {
            $this->initView();
            $this->controller($cmd);
            $this->add_menu();
            $this->add_route();
        }

        $this->cmd->line('');
        $this->cmd->line('Make Model');
        $this->model_migration($cmd);


        $this->cmd->line('--------------------------------');
        $this->cmd->line('Build RESTApi');
        $this->cmd->line('--------------------------------');
        $this->makeApi();
        
        // $this->makeApiController();
        // $this->makeApiRoute();

    }

    public function call($class) {
        $runClass = (new $class);
        $runClass->initial();

        $this->cmd->info("\nCrud Generator : <bold>$runClass->name</bold>");
        $runClass->build($this->cmd);
        $this->cmd->line('----------------------------------------------------');
    }

    function saveConfigToDb() {
        $tcGenerator = new GModel();

        $config              = [
            "columns"           => $this->columns,
            "underscore_name"   => $this->name_underscore,
            "camel_case_name"   => $this->name,
        ];

        $tcGenerator->uuid          = Str::uuid();
        $tcGenerator->name          = $this->name;
        $tcGenerator->config        = serialize($config);
        $tcGenerator->status        = true;
        $tcGenerator->generate_from = 'Command Line Interface';
        $tcGenerator->healthy       = 0;
        $tcGenerator->generated_at  = gmdate('Y-M-d H:i:s', time()+60*60*7);

        $tcGenerator->save();
    }

}