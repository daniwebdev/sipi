<?php
use TrusCRUD\Core\Models\AccessRoleToMenu;
use TrusCRUD\Core\Models\AccessAction;
use TrusCRUD\Core\Models\AccessMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionAction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccessAction::create(["name" => "Show", "supfix" => "show"]);
        AccessAction::create(["name" => "List", "supfix" => "index"]);
        AccessAction::create(["name" => "Insert", "supfix" => "create"]);
        AccessAction::create(["name" => "Edit", "supfix" => "edit"]);
        AccessAction::create(["name" => "Delete", "supfix" => "destroy"]);
        AccessAction::create(["name" => "Print", "supfix" => "print"]);


        $menus = [
            [ //1
                "uuid"          => Str::uuid(),
                "title"         => "Dashboard",
                "description"   => "",
                "route_name"    => "dashboard",
                "url"           => "/dashboard",
                "icon"          => "fas fa-home",
                "actions"       => '["show","index"]',
                "order"         => 1,
            ],
            [ //2
                "uuid"          => Str::uuid(),
                "title"         => "Article",
                "description"   => "",
                "route_name"    => "",
                "url"           => "#",
                "icon"          => "fa fa-newspaper",
                "actions"       => '["show","index"]',
                "order"         => 2,
            ],
            [ //3
                "uuid"          => Str::uuid(),
                "title"         => "All Article",
                "parent_id"     => 2,
                "description"   => "",
                "route_name"    => "article.index",
                "url"           => "/article",
                "icon"          => "fas fa-arrow-circle-right",
                "actions"       => '["show","index", "destroy","edit"]',
                "order"         => 2,
            ],
            [ //4
                "uuid"          => Str::uuid(),
                "title"         => "Category",
                "parent_id"     => 2,
                "description"   => "",
                "route_name"    => "article_categories.index",
                "url"           => "/article_categories",
                "icon"          => "fas fa-arrow-circle-right",
                "actions"       => '["show","index", "destroy","edit"]',
                "order"         => 2,
            ],
            [ //11
                "uuid"          => Str::uuid(),
                "title"         => "Api Key",
                "description"   => "",
                "route_name"    => "user_api_key.index",
                "url"           => "/user_api_key",
                "icon"          => "fas fa-key",
                "actions"       => '["show","index", "create","destroy","edit"]',
                "order"         => 3,
            ],
            [ //12
                "uuid"          => Str::uuid(),
                "title"         => "Files",
                "description"   => "",
                "route_name"    => "files.index",
                "url"           => "/files",
                "icon"          => "fas fa-folder",
                "actions"       => '["show","index", "destroy","edit"]',
                "order"         => 3,
            ],
        ];

        foreach($menus as $data) {
            AccessMenu::create($data);
        }


        for ($i = 1; $i <= 15; $i++) {

            AccessRoleToMenu::create([
                "access_action_suffix" => "show",
                "access_menu_id" => $i,
                "access_role_id" => 1,
            ]);
            AccessRoleToMenu::create([
                "access_action_suffix" => "index",
                "access_menu_id" => $i,
                "access_role_id" => 1,
            ]);
            AccessRoleToMenu::create([
                "access_action_suffix" => "create",
                "access_menu_id" => $i,
                "access_role_id" => 1,
            ]);
            AccessRoleToMenu::create([
                "access_action_suffix" => "edit",
                "access_menu_id" => $i,
                "access_role_id" => 1,
            ]);
            AccessRoleToMenu::create([
                "access_action_suffix" => "destroy",
                "access_menu_id" => $i,
                "access_role_id" => 1,
            ]);
        }

        foreach([5,6,7,8,9,10,11,13] as $val) {
            AccessRoleToMenu::create([
                "access_action_suffix" => "show",
                "access_menu_id" => $val,
                "access_role_id" => 2,
            ]);

            AccessRoleToMenu::create([
                "access_action_suffix" => "index",
                "access_menu_id" => $val,
                "access_role_id" => 2,
            ]);

            AccessRoleToMenu::create([
                "access_action_suffix" => "create",
                "access_menu_id" => $val,
                "access_role_id" => 2,
            ]);

            AccessRoleToMenu::create([
                "access_action_suffix" => "edit",
                "access_menu_id" => $val,
                "access_role_id" => 2,
            ]);

            AccessRoleToMenu::create([
                "access_action_suffix" => "destroy",
                "access_menu_id" => $val,
                "access_role_id" => 2,
            ]);

        }


    }
}
