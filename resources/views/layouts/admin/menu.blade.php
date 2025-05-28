<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li class="menu-title" key="t-menu">Master Data</li>

                <li>
                    <a href="{{ route('admin.kategori.index') }}" class="waves-effect">
                        <i class="bx bx-list-ol"></i>
                        <span key="t-dashboards">Kategori</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.mahasiswa.index') }}" class="waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-dashboards">Mahasiswa</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.mata-kuliah.index') }}" class="waves-effect">
                        <i class="bx bx-book"></i>
                        <span key="t-dashboards">Matakuliah</span>
                    </a>
                </li>

                <li class="menu-title" key="t-menu">Project</li>

                <li>
                    <a href="{{ route('admin.project.index') }}" class="waves-effect">
                        <i class="bx bxs-folder"></i>
                        <span key="t-dashboards">Project</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.contact-us.index') }}" class="waves-effect">
                        <i class="bx bx-message-square-dots"></i>
                        <span key="t-dashboards">Contact Us</span>
                    </a>
                </li>

                <li class="menu-title" key="t-menu">Monitoring</li>

                <li>
                    <a href="{{ route('admin.user.index') }}" class="waves-effect">
                        <i class="bx bxs-user-rectangle"></i>
                        <span key="t-dashboards">User Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.activity-log.index') }}" class="waves-effect">
                        <i class="bx bx-walk"></i>
                        <span key="t-dashboards">Log Aktivitas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('log-viewer.index') }}" class="waves-effect">
                        <i class="bx bx-error-circle"></i>
                        <span key="t-dashboards">Error Log</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
