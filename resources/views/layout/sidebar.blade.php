    <!--start sidebar-->
    <aside class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="logo-name text-center flex-grow-1 text-decoration-none">
                <h5 class="mb-0">Maxim's Group</h5>
            </a>
            <div class="sidebar-close">
                <span class="material-icons-outlined">close</span>
            </div>
        </div>
        <div class="sidebar-nav">
            <ul class="metismenu" id="sidenav">
                <li class="menu-label">Dashboard</li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">home</i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>

                <li class="menu-label">Users</li>

                @canany(['role_view', 'user_view', 'user_activity_view'])
                    @php
                        $userManagementActive =
                            request()->routeIs('user.*') ||
                            request()->routeIs('role.*') ||
                            request()->routeIs('user_activity.*');
                    @endphp

                    <li class="{{ $userManagementActive ? 'mm-active' : '' }}">
                        <a href="javascript:;" class="has-arrow {{ $userManagementActive ? 'mm-active' : '' }}"
                            aria-expanded="{{ $userManagementActive ? 'true' : 'false' }}">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">person</i>
                            </div>
                            <div class="menu-title">User Management</div>
                        </a>

                        <ul class="{{ $userManagementActive ? 'mm-show' : '' }}">
                            @can('user_view')
                                <li>
                                    <a href="{{ route('user.index') }}"
                                        class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
                                        <i class="material-icons-outlined">arrow_right</i>
                                        Users
                                    </a>
                                </li>
                            @endcan

                            @can('role_view')
                                <li>
                                    <a href="{{ route('role.index') }}"
                                        class="{{ request()->routeIs('role.*') ? 'active' : '' }}">
                                        <i class="material-icons-outlined">arrow_right</i>
                                        Roles
                                    </a>
                                </li>
                            @endcan

                            @can('user_activity_view')
                                <li>
                                    <a href="{{ route('user_activity.index') }}"
                                        class="{{ request()->routeIs('user_activity.*') ? 'active' : '' }}">
                                        <i class="material-icons-outlined">arrow_right</i>
                                        User Activity
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany
                <li class="menu-label">Company</li>

                {{-- @can('company_view') --}}
                    @php
                        $companyActive = request()->routeIs('company.*');
                    @endphp

                    <li class="{{ $companyActive ? 'mm-active' : '' }}">
                        <a href="javascript:;" class="has-arrow {{ $companyActive ? 'mm-active' : '' }}">
                            <div class="parent-icon">
                                <i class="material-icons-outlined">business</i>
                            </div>
                            <div class="menu-title">Company Management</div>
                        </a>

                        <ul class="{{ $companyActive ? 'mm-show' : '' }}">
                            <li>
                                <a href="{{ route('company.index') }}"
                                    class="{{ request()->routeIs('company.*') ? 'active' : '' }}">
                                    <i class="material-icons-outlined">arrow_right</i>
                                    Companies
                                </a>
                            </li>
                        </ul>
                    </li>
                {{-- @endcan --}}
            </ul>
        </div>
    </aside>
