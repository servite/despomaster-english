<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu">
            <li class="header"></li>
            <li class="treeview {{ set_active('e/dashboard*', false) }}">
                <a href="{{ url('/e/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview {{ set_active('e/calendar', false) }}">
                <a href="{{ '/e/calendar' }}">
                    <i class="fa fa-calendar"></i> <span>Kalender</span>
                </a>
            </li>
            <li class="treeview {{ set_active('e/profile*', false) }}">
                <a href="{{ '/e/profile' }}">
                    <i class="fa fa-user"></i> <span>Profil</span>
                </a>
            </li>
            <li class="treeview {{ set_active('e/history*', false) }}">
                <a href="{{ '/e/history' }}">
                    <i class="fa fa-edit"></i> <span>Historie</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
