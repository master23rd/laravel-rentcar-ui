<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            {{-- <a href="{{ route('admin.profile.show') }}" class="d-block">{{ Auth::user()->name }}</a> --}}
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                {{-- <a href="{{ route('admin.users.index') }}" class="nav-link">
                <i class="nav-icon fa fa-address-book"></i>
                <p>
                    {{ __('Users') }}
                </p>
                </a> --}}
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.brands.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-inbox"></i>
                    <p>
                        {{ __('Brands') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.models.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-copyright"></i>
                    <p>
                        {{ __('Model') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.cars.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-car"></i>
                    <p>
                        {{ __('Mobil') }}
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.rents.index') }}" class="nav-link">
                    <i class="nav-icon fa fa-credit-card"></i>
                    <p>
                        {{ __('Rental') }}
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
