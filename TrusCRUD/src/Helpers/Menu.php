<?php
namespace TrusCRUD\Helpers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Menu {

    var $template_list = '';
    var $template_sublist = '';
    var $template_parentlist = '';

    function __construct() 
    {
        $this->template_list = '
        <li class="nav-item">
            <a href="{url}" class="nav-link">
            <i class="nav-icon {icon}"></i>
            <p>{title}</p>
            </a>
        </li>
        ';

        $this->template_sublist = '
        <li class="nav-item">
            <a href="{url}" class="nav-link">
            <i class="nav-icon {icon}"></i>
            <p>{title}</p>
            </a>
        </li>
        ';

        $this->template_parentlist = '
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon {icon}"></i>
                <p>
                {title}
                <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                {submenu}
            </ul>
        </li>
        ';
    }

    function set_template($html) {
        $this->template_list = $html;
    }

    function set_subtemplate($html) {
        $this->template_sublist = $html;
    }

    function set_parenttemplate($html) {
        $this->template_parentlist = $html;
    }

    public function getMenu($role_id, $parent_id=0) {
        
        $output = Cache::remember('menu:'.$role_id.':'.$parent_id, 100, function() use($role_id, $parent_id) {
            $get = DB::table('access_role_to_menus AS prm')->distinct()
            ->select([
                "menu.id",
                "menu.title",
                "menu.url",
                "menu.icon",
                "menu.route_name",
                "menu.order",
            ])
            ->join('access_menus AS menu', 'menu.id', "=", "prm.access_menu_id")
            // ->orderBy('menu.order', 'asc')
            ->where('prm.access_role_id', '=', $role_id)
            ->where("menu.parent_id", "=", $parent_id)
            // ->groupBy('menu.id')
            ->get();
    
            return $get->sortBy('order');
        });

        return $output;
    }

    public function getRecursive($role_id, $parent_id=0) {
        $html    = "";
        $getMenu = $this->getMenu($role_id, $parent_id);

        if($getMenu->count() == 0) {
            return false;
        }

        foreach($getMenu as $menu) {

            $check = $this->getRecursive($role_id, $menu->id);
            $url  = $menu->route_name != '' ? route($menu->route_name):'#';
            
            
            if(!$check) {

                if( $parent_id > 0) {
                    $template = $this->template_sublist;
                } else {
                    $template = $this->template_list;
                }

                $template = preg_replace("/{title}/", $menu->title, $template);
                $template = preg_replace("/{icon}/", (isset($menu->icon) ? $menu->icon:'fa fa-chevron-circle-right'), $template);
                $template = preg_replace("/{url}/", $url, $template);

                $html .= $template;
            } else {
                $template_sub = $this->template_parentlist;
                $template_sub = preg_replace("/{title}/", $menu->title, $template_sub);
                $template_sub = preg_replace("/{icon}/", (isset($menu->icon) ? $menu->icon:'fa fa-chevron-circle-right'), $template_sub);
                $template_sub = preg_replace("/{submenu}/", $check, $template_sub);
                $template_sub = preg_replace("/{id}/", $menu->id, $template_sub);

                $html .= $template_sub;
            }
        }

        return $html;
    }

     function buildMenu($role) {
        $value = Cache::remember('menu-'.$role, 60, function () use($role) {
            $value = $this->getRecursive($role, 0);
             return $value;
        });

        return $value;
    }
}