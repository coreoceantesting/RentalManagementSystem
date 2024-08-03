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

                @can(['masters.allmasters'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarLayoutsMasters" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                            <i class="ri-layout-3-line"></i>
                            <span data-key="t-layouts">Masters</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarLayoutsMasters">
                            <ul class="nav nav-sm flex-column">
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
                @endcan


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
                @can('complaint.add')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('complaint.index') }}" >
                            <i class="ri-add-circle-line"></i>
                            <span data-key="t-dashboards">Add Complaint</span>
                        </a>
                    </li>
                @endcan

                @can('complaint.applicationlist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('list.all.applications') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Application List</span>
                        </a>
                    </li>
                @endcan

                @can('complaint.rejectlist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('list.rejected.applications') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Rejected Application List</span>
                        </a>
                    </li>
                @endcan

                @can('complaint.hearinglist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('list.hearing.applications') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Hearing Application List</span>
                        </a>
                    </li>
                @endif

                @canany(['complaint.closelist' , 'lists.closelist'])
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('list.close.applications') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Close List</span>
                        </a>
                    </li>
                @endcan

                {{-- clerk menu --}}

                @can('lists.complaintlist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('complaint.list') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Complaint List</span>
                        </a>
                    </li>
                @endcan

                @can('lists.approvedcomplaintlist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('approved.complaint.list') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Approved List</span>
                        </a>
                    </li>
                @endif

                @can('lists.annexureverificationlist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('annexure.verification.list') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Annexure Verification List</span>
                        </a>
                    </li>
                @endcan

                @can('lists.hearinglist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('application.hearing.list') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Hearing List</span>
                        </a>
                    </li>
                @endcan

                {{-- contractors Menu --}}
                @can('lists.explainationcalllist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('list.explaination') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Explaination Call List</span>
                        </a>
                    </li>
                @endcan

                {{-- stop work menu --}}
                @can('lists.stopworklist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#stopWorks" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                            <i class="bx bx-user-circle"></i>
                            <span data-key="t-layouts">Stop Work Lists</span>
                        </a>
                        <div class="collapse menu-dropdown" id="stopWorks">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('application.stopwork.list') }}" class="nav-link" data-key="t-horizontal">Application List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('application.stopwork.approved.list') }}" class="nav-link" data-key="t-horizontal">Approved Application List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('application.stopwork.rejected.list') }}" class="nav-link" data-key="t-horizontal">Rejected Application List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- final stop work --}}
                @can('lists.finalstopworklist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#finalstopWorks" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                            <i class="bx bx-user-circle"></i>
                            <span data-key="t-layouts">Final Stop Work Lists</span>
                        </a>
                        <div class="collapse menu-dropdown" id="finalstopWorks">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('application.finalstopwork.approved.list') }}" class="nav-link" data-key="t-horizontal">Approved Application List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('application.finalstopwork.rejected.list') }}" class="nav-link" data-key="t-horizontal">Rejected Application List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- total application list --}}
                @can('lists.totalapplicationlist')
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('total.application.list') }}" >
                            <i class="ri-list-check"></i>
                            <span data-key="t-dashboards">Total Application</span>
                        </a>
                    </li>
                @endcan

                {{-- new module --}}
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('add.form') }}" >
                        <i class="ri-account-circle-fill"></i>
                        <span data-key="t-dashboards">Scheme Details</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('list.schemeDetails') }}" >
                        <i class="ri-file-list-line"></i>
                        <span data-key="t-dashboards">Scheme Details List</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>


<div class="vertical-overlay"></div>
