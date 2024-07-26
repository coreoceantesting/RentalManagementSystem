<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/Slum-Rehabilitation-Authority-Mumbai (1).png') }}" alt="" height="22" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/Slum-Rehabilitation-Authority-Mumbai (1).png') }}" alt="" height="17" />
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('admin/images/Slum-Rehabilitation-Authority-Mumbai (1).png') }}" alt="" height="70" />
            </span>
            <span class="logo-lg">
                <img src="{{ asset('admin/images/Slum-Rehabilitation-Authority-Mumbai (1).png') }}" alt="" height="70" />
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}" >
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayoutsMasters" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-layout-3-line"></i>
                        <span data-key="t-layouts">Masters</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayoutsMasters">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('wards.index') }}" class="nav-link" data-key="t-horizontal">Wards</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contractors.index') }}" class="nav-link" data-key="t-horizontal">Contractor</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('architects.index') }}" class="nav-link" data-key="t-horizontal">Architect</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('schemes.index') }}" class="nav-link" data-key="t-horizontal">Schemes</a>
                            </li>
                        </ul>
                    </div>
                </li>


                @canany(['users.view', 'roles.view'])
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="bx bx-user-circle"></i>
                        <span data-key="t-layouts">User Management</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            @can('users.view')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link" data-key="t-horizontal">Users</a>
                                </li>
                            @endcan
                            @can('roles.view')
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link" data-key="t-horizontal">Roles</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                {{-- Citizen Menus --}}

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('complaint.index') }}" >
                        <i class="ri-add-circle-line"></i>
                        <span data-key="t-dashboards">Add Complaint</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('list.all.applications') }}" >
                        <i class="ri-list-check"></i>
                        <span data-key="t-dashboards">Application List</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('list.rejected.applications') }}" >
                        <i class="ri-list-check"></i>
                        <span data-key="t-dashboards">Rejected Application List</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" >
                        <i class="ri-list-check"></i>
                        <span data-key="t-dashboards">Hearing Application List</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" >
                        <i class="ri-list-check"></i>
                        <span data-key="t-dashboards">Close List</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>


<div class="vertical-overlay"></div>
