<?php

namespace TrusCRUD\Core\Commands;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use TrusCRUD\Core\Models\AccessMenu;
use TrusCRUD\Core\Models\AccessRoleToMenu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CrudRemove extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:remove {name} {--table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove CRUD Generated';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $style = new OutputFormatterStyle('green', 'default', ['bold']);
        $this->output->getFormatter()->setStyle('bold', $style);
        $this->banner();


        if($this->option('table')) {

            $confirm = $this->confirm('Are you sure, remove with table..? your data will lose.');

            if(!$confirm) {
                exit;
            }
        }
        
        $multiple = explode(',', $this->argument('name'));
        if(count($multiple) > 1) {
            foreach($multiple as $className) {
                $className = trim($className);
                $this->rm_route($className);
                $this->checker($className);
                $this->remove_api($className, $className);
            }
        } else {
            $className = $this->argument('name');
            $this->rm_route_api($className);
            $this->checker($className);
            $this->remove_api($className, $className);
        }


    }

    function checker($className) {
        $controllerPath     = app_path('Http/Controllers/'.$className.'Controller.php');
        $modelPath          = app_path('Models/'.$className.'.php');
        $name               = $this->from_camel_case($className);
        $viewsPath          = base_path('resources/views/templates/admin/adminLTE/'.$name);

        $this->line('=============================================');
        $this->info('Delete CRUD : <bold>'.$className.'</bold>');
        $this->line('=============================================');

        if(file_exists($controllerPath)) {
            $this->info("Controller Detected: ".$controllerPath);
            unlink($controllerPath);
            $this->info("Controller Removed..!");
            $this->line('---------------------------------------------');
        }
        if(file_exists($modelPath)) {
            $this->info("Model Detected: ".$modelPath);
            unlink($modelPath);
            $this->info("Model Removed..!");
            $this->line('---------------------------------------------');
        }

        $this->rm_migrate($className);
        if(is_dir($viewsPath)) {
            $this->info("View Detected: ".$viewsPath);

            $this->rrmdir($viewsPath);
            $this->info("View Removed..!");
            $this->line('---------------------------------------------');

        }

        $this->rm_menu($name);
        $this->line('---------------------------------------------');
        if($this->option('table')) {
            $this->remove_table($className);
            $this->line('---------------------------------------------');
        }
    }

    function rrmdir($src) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                $full = $src . '/' . $file;
                if ( is_dir($full) ) {
                    $this->rrmdir($full);
                }
                else {
                    unlink($full);
                }
            }
        }
        closedir($dir);
        rmdir($src);
    }

    public function rm_migrate($className) {
        $migrate_name       = $this->from_camel_case("Create".Str::plural($className)."Table");
        $migrate_path       = base_path('database/migrations');
        $scan               = scandir($migrate_path);
        // dd($scan);
        foreach($scan as $file) {
            if(strpos($file, $migrate_name)) {
                if(file_exists($migrate_path.'/'.$file)) {
                    unlink($migrate_path.'/'.$file);
                    $this->info("Migrate deleted: /database/migrations/".$file);
                    $this->line('---------------------------------------------');
                }
            }
        }
    }

    public function from_camel_case($input) {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    protected function rm_menu($link) {
        $link = '/'.$link;

        try {
            $this->info('Find menu with link: '.$link);
            DB::beginTransaction();
            
            $menu = AccessMenu::where('url', $link);

            if($menu->count() > 0) {
                foreach($menu->get() as $m) {
                    AccessRoleToMenu::where('access_menu_id', $m->id)->delete();
                }
                $menu->delete();
                $this->info("Menu has been deleted.");
            } else {
                $this->error("Menu not found.");
            }
            Cache::flush();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->error("Error Delete Menu.");
            $this->info($th->getMessage());
        }
    }

    function remove_table($name) {
        $tableName = Str::plural($this->from_camel_case($name));
        try {
            Schema::dropIfExists($tableName);
            $this->info("Table <bold>$name</bold> Deleted.");
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
            die;
        }

    }

    function rm_route($name) {
        $routes = file_get_contents(base_path('routes/app.php'));
        $name               = $this->from_camel_case($name);

        $output = preg_replace('/\n\/\/Begin Route '.$name.'\n(.*)\n\/\/End Route '.$name.'/', "", $routes);

        file_put_contents(base_path('routes/app.php'),$output);

    }

    function remove_api($name, $className) {
        $this->rm_route_api($name);
        $this->rm_controller_api($className);
    }

    function rm_route_api($name) {
        $path      = base_path('api/Routes/api.php');
        $routes    = file_get_contents($path);
        $name      = $this->from_camel_case($name);

        // $output = preg_replace("/RouteResourceApi\(\'$name\', (.*)\)/", "", $routes);
        $output = preg_replace("/\nRouteResourceApi(.*)people(.*);/" ,"", file_get_contents($path));

        file_put_contents($path,$output);
    }

    function rm_controller_api($className) {
        $path = base_path('api/Controllers/'.$className.'Controller.php');

        if(is_file($path)) {
            unlink($path);
        } else {
            $this->error("Api Controller Not Found.");
        }
        $this->line('---------------------------------------------');
    }
}
