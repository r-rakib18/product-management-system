<header class="top-header">
    <nav class="navbar navbar-expand">
        <div class="left-topbar d-flex align-items-center">
            <a href="javaScript:;" class="toggle-btn">	<i class="bx bx-menu"></i>
            </a>
            <div class="pt-2">
                <h4>PMS</h4>
            </div>
        </div>

        <div class="right-topbar ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item search-btn-mobile">
                    <a class="nav-link position-relative" href="javaScript:;">	<i class="bx bx-search vertical-align-middle"></i>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-lg">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>