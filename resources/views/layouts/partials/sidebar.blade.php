<div class="sidebar-wrapper" data-simplebar="true">

    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class="bx bx-home-alt"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="javaScript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                @if(has_role('category_view',$permission))
                <li>
                    <a href="{{ route('category.index') }}">
                        <i class="bx bx-right-arrow-alt"></i>Manage Category
                    </a>
                </li>
                @endif
                @if(has_role('category_create',$permission))
                <li>
                    <a href="{{ route('category.create') }}">
                        <i class="bx bx-right-arrow-alt"></i>Add Category
                    </a>
                </li>
                @endif
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javaScript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Product</div>
            </a>
            <ul>
                @if(has_role('product_view',$permission))
                <li>
                    <a href="{{ route('product.index') }}">
                        <i class="bx bx-right-arrow-alt"></i>Manage Product
                    </a>
                </li>
                @endif
                @if(has_role('product_create'))
                <li>
                    <a href="{{ route('product.create') }}">
                        <i class="bx bx-right-arrow-alt"></i>Add Product
                    </a>
                </li>
                @endif
            </ul>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                <div class="parent-icon"><i class="bx bx-power-off"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
    <!--end navigation-->
</div>