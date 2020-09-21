<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        {{--
        <li class="nav-header">Main Menu</li> --}} 
        @php 
            $role_id = Auth::user()->access_role_id; 
            // $menu    = Role::buildMenu($role_id); 
            $menu = new Menu();

            $menu->set_template('
            <li class="nav-item">
                <a href="{url}" class="nav-link">
                    <i class="nav-icon {icon}"></i>
                    <p>{title}</p>
                </a>
            </li>');
            $menu->set_subtemplate('
            <li class="nav-item">
                <a href="{url}" class="nav-link">
                    <i class="nav-icon {icon}"></i>
                    <p>{title}</p>
                </a>
            </li>');
            $menu->set_parenttemplate('
            <li class="nav-item has-treeview">
                <a href="#menu{id}" class="nav-link">
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
            ');
            $gen_menu = $menu->buildMenu($role_id); 
        @endphp
        
        {{-- {!! $menu !!} --}}
        {!! $gen_menu !!}
        
        @if ($role_id == 1)
        <li class="nav-header">Super Admin</li>
        <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>Users</p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-lock"></i>
                <p>
                    Permissions
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('role.index')}}" class="nav-link">
                        <i class="fa fa-chevron-circle-right nav-icon"></i>
                        <p>User Role</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('menu.index')}}" class="nav-link">
                        <i class="fa fa-chevron-circle-right nav-icon"></i>
                        <p>Menu Accesses</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/generator" class="nav-link">
                <i class="nav-icon fas fa-robot"></i>
                <p>Generator</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/settings" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>Settings</p>
            </a>
        </li>
        @endif
    </ul>
</nav>
<!-- /.sidebar-menu -->