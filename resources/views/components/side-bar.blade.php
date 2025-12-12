<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('user-avatar.jpg') }}" alt="..."
                        class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a>
                        <span>
                            {{ session('userData')->username }}
                            <span class="user-level">{{ session('userData')->role }}</span>
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary" id="menu-nav">
                <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="/admin/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- users --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">USERS</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" aria-expanded="false" href="#users">
                        <i class="fas fa-users"></i>
                        <p>Pengguna</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.users.index') }}">
                                    <span class="sub-item">Kelola Pengguna</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.users.log') ? 'active' : '' }}">
                                <a href="{{ route('admin.users.log') }}">
                                    <span class="sub-item">Log Aktivitas</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- Area Kemah --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master</h4>
                </li>
                <li class="nav-item {{ request()->routeIs('master.campSite.index') ? 'active' : '' }}">
                    <a href="{{ route('master.campSite.index') }}">
                        <i class="fas fa-list-alt"></i>
                        <p>Area Kemah</p>
                    </a>
                </li>
                
                <li class="mx-4 mt-5">
                    <a href="{{ route('auth.logout') }}" class="btn btn-warning btn-block" style="background-color: #595857 !important"><span
                            class="btn-label mr-2"> <i class="fas fa-sign-out-alt"></i>
                        </span>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
