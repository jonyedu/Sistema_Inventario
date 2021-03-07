<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('team_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.teams.index") }}" class="nav-link {{ request()->is('admin/teams') || request()->is('admin/teams/*') ? 'active' : '' }}">
                            
                                   
                                    <i class="fas fa-medkit"></i>
                                    {{ trans('cruds.team.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('asset_access')
                <li class="nav-item">
                    <a href="{{ route("admin.assets.index") }}" class="nav-link {{ request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-medkit nav-icon">
                                    
                        </i>
                        {{ trans('cruds.asset.title') }}
                    </a>
                </li>
            @endcan

            @can('stock_access')
                <li class="nav-item">
                    <a href="{{ route("admin.stocks.index") }}" class="nav-link {{ request()->is('admin/stocks') || request()->is('admin/stocks/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-boxes nav-icon">
                    
                        </i>
                       
                        {{ trans('cruds.stock.title') }}
                    </a>
                </li>
            @endcan

            @can('transaction_access')
                <li class="nav-item">
                    <a href="{{ route("admin.transactions.index") }}" class="nav-link {{ request()->is('admin/transactions') || request()->is('admin/transactions/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-clipboard-list nav-icon">
                        
                        </i>
                        {{ trans('cruds.transaction.title') }}
                    </a>
                </li>
            @endcan

            @can('donaciones_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-hand-holding-medical nav-icon">

                        </i>
                        Donaciones
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('donador_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.donadores.index") }}" class="nav-link {{ request()->is('admin/donadores') || request()->is('admin/donadores/*') ? 'active' : '' }}">
                                <i class="fa-fw  fas fa-user-plus nav-icon">                        
                                </i>
                                {{ trans('cruds.donador.title') }}
                                </a>
                            </li>
                        @endcan
                    @can('orden_donacion_access')
                        <li class="nav-item">
                            <a href="{{ route('admin.ordenes_donacion.index') }}" class="nav-link {{ request()->is('admin/ordenes_donacion') || request()->is('admin/ordenes_donacion/*') ? 'active' : '' }}">
                                
                                <i class="fa-fw fas fa-list-alt nav-icon">
                                
                                </i>
                                {{ trans('cruds.orden_donacion.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('orden_donacion_download')
                        <li class="nav-item">
                            <a href="{{ route('admin.serve_fileDonacion.serve.file') }}" class="nav-link {{ request()->is('admin/serveFileD') || request()->is('admin/serveFile/*') ? 'active' : '' }}">
                                
                                <i class="fa-fw fas fa-file-download nav-icon">
                                
                                </i>
                                Visualizar O. Donacion
                            </a>
                        </li>
                    @endcan
                    </ul>
                </li>
  
            @endcan

            @can('compras_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-hand-holding-usd nav-icon">

                        </i>
                        Compras
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('proveedor_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.proovedores.index") }}" class="nav-link {{ request()->is('admin/proovedores') || request()->is('admin/proovedores/*') ? 'active' : '' }}">
                                
                                    <i class="fa-fw fas fa-people-carry nav-icon">
                                    
                                    </i>
                                    {{ trans('cruds.proovedor.title') }}
                                </a>
                            </li>
                        @endcan

                        @can('cotizacion_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.cotizaciones.index") }}" class="nav-link {{ request()->is('admin/proovedores') || request()->is('admin/proovedores/*') ? 'active' : '' }}">
                                
                                    <i class="fa-fw fas fa-people-carry nav-icon">
                                    
                                    </i>
                                    Cotizaciones
                                </a>
                            </li>
                        @endcan

                        @can('orden_compra_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.ordenes_compra.index') }}" class="nav-link {{ request()->is('admin/ordenes_compra') || request()->is('admin/ordenes_compra/*') ? 'active' : '' }}">
                                    
                                    <i class="fa-fw fas fa-list-alt nav-icon">
                                    
                                    </i>
                                    Ordenes de compras
                                </a>
                            </li>
                        @endcan

                        @can('orden_compra_download')
                        <li class="nav-item">
                                <a href="{{ route('admin.serve_file.serve.file') }}" class="nav-link {{ request()->is('admin/serveFile') || request()->is('admin/serveFile/*') ? 'active' : '' }}">
                                    
                                    <i class="fa-fw fas fa-file-download nav-icon">
                                    
                                    </i>
                                    Visualizar O. Compras
                                </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('retiros_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        Retiros
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('orden_retiro_access')
                            <li class="nav-item">
                                <a href="{{ route('admin.ordenes_retiro.index') }}" class="nav-link {{ request()->is('admin/ordenes_retiro') || request()->is('admin/ordenes_retiro/*') ? 'active' : '' }}">
                                    
                                    <i class="fa-fw fas fa-list-alt nav-icon">
                                    
                                    </i>
                                    Ordenes de Retiro
                                </a>
                            </li>
                        @endcan

                        @can('orden_retiro_download')
                        <li class="nav-item">
                                <a href="{{ route('admin.serve_fileRetiro.serve.file') }}" class="nav-link {{ request()->is('admin/serveFile') || request()->is('admin/serveFile/*') ? 'active' : '' }}">
                                    
                                    <i class="fa-fw fas fa-list-alt nav-icon">
                                    
                                    </i>
                                    Visualizar O. Retiros
                                </a>
                        </li>
                        @endcan
                    </ul>
                </li>
            @endcan
 
            
            
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif

            
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
