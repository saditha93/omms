<li class="nav-item">
    @if(Auth::user()->user_type !==2 && auth()->user()->can('stock-view') && !auth()->user()->can('bar-stock'))
        <a href="{{ route('stock.home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
            {{--<i class="nav-icon fas fa-home"></i>--}}
            <img class="nav-icon" src="{{ asset('/flat-icon/home.png') }}" style=" float: left;">
            <p>Home</p>
        </a>

    @else
        <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
            {{--<i class="nav-icon fas fa-home"></i>--}}
            <img class="nav-icon" src="{{ asset('/flat-icon/home.png') }}" style=" float: left;">
            <p>Home</p>
        </a>
    @endif
</li>

@if(Auth::guard('admin')->check())

    {{--Super User--}}
    @if(Auth::user()->user_type ==1)
        <li class="nav-item">
            <a href="{{ route('establishment.index') }}"
               class="nav-link {{ Request::is('admin/establishment') ? 'active' : '' }}">
                {{--<i class="nav-icon fas fa-map"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/add-establishment.png') }}" style=" float: left;">
                <p>Add Establishment</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mess.index') }}" class="nav-link {{ Request::is('admin/mess') ? 'active' : '' }}">
                {{--<i class="nav-icon fas fa-building"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/add-mess.png') }}" style=" float: left;">
                <p>Add Mess</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mess-manager') }}"
               class="nav-link {{ Request::is('admin/mess-manager') ? 'active' : '' }}">
                {{--<i class="nav-icon fas fa-user"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/add-mess-manager.png') }}" style=" float: left;">
                <p>Add Mess Manager</p>
            </a>
        </li>
    @endif

    {{--Mess Manager--}}
    @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-roles') || auth()->user()->can('manage-users') || auth()->user()->can('register-officers'))
        <li class="nav-item">
            <a href="" class="nav-link">
                {{--<i class="nav-icon fas fa-calendar"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/user-manage.png') }}" style=" float: left;">
                <p>
                    Manage Users
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-roles') )
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}"
                           class="nav-link {{ Request::is('admin/roles') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-address-card"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/roles.png') }}" style=" float: left;">
                            <p>Manage Role</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-users') )
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                           class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-user"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/users.png') }}" style=" float: left;">
                            <p>Manage Users</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->user_type ==2 || auth()->user()->can('register-officers') )
                    <li class="nav-item">
                        <a href="{{ route('officer.index') }}"
                           class="nav-link {{ Request::is('admin/officer') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-user"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/register-officer.png') }}"
                                 style=" float: left;">
                            <p>Add Members</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    {{--Admins under mess Manager--}}
    @if(Auth::user()->user_type ==2 || auth()->user()->can('view-mess-item-categories') || auth()->user()->can('manage-sub-menu-items') || auth()->user()->can('manage-mess-menus') ||
    auth()->user()->can('add-daily-rations') || auth()->user()->can('add-tea-items') || auth()->user()->can('add-extra-messing') || auth()->user()->can('add-desserts') || auth()->user()->can('place-orders'))
        <li class="nav-item">
            <a href="" class="nav-link">
                {{--<i class="nav-icon fas fa-calendar"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/menu-manage.png') }}" style=" float: left;">
                <p>
                    Menu Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-mess-item-categories'))
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}"
                           class="nav-link {{ Request::is('admin/category') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-list"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/category.png') }}" style=" float: left;">
                            <p>Menu Item Category</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-sub-menu-items'))
                    <li class="nav-item">
                        <a href="{{ route('item.index') }}"
                           class="nav-link {{ Request::is('admin/item') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-shopping-cart"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/items.png') }}" style=" float: left;">
                            <p>Sub Menu Items</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-mess-menus'))
                    <li class="nav-item">
                        <a href="{{ route('menu.index') }}"
                           class="nav-link {{ Request::is('admin/menu') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/mess-menu.png') }}" style=" float: left;">
                            <p>Add Menus</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('add-daily-rations') || auth()->user()->can('add-tea-items') || auth()->user()->can('add-extra-messing') || auth()->user()->can('add-desserts'))
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            {{--<i class="nav-icon fas fa-calendar"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/daily-ration.png') }}"
                                 style=" float: left;">
                            <p>
                                Manage Menus
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            @if(Auth::user()->user_type ==2 || auth()->user()->can('add-daily-rations'))
                                <li class="nav-item">
                                    <a href="{{ route('ration.index') }}"
                                       class="nav-link {{ Request::is('ration') ? 'active' : '' }}">
                                        {{--<i class="far fa-circle nav-icon"></i>--}}
                                        <img class="nav-icon" src="{{ asset('/flat-icon/ration.png') }}"
                                             style=" float: left;">
                                        <p>Messing</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->user_type ==2 || auth()->user()->can('add-tea-items'))
                                <li class="nav-item">
                                    <a href="{{route('tea-items')}}"
                                       class="nav-link" {{Request::is('tea-items')?'active':''}}>
                                        {{--<i class="far fa-circle nav-icon"></i>--}}
                                        <img class="nav-icon" src="{{ asset('/flat-icon/tea.png') }}"
                                             style=" float: left;">
                                        <p>Tea</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->user_type ==2 || auth()->user()->can('add-extra-messing'))
                                <li class="nav-item">
                                    <a href="extra-messing" class="nav-link">
                                        {{--<i class="far fa-circle nav-icon"></i>--}}
                                        <img class="nav-icon" src="{{ asset('/flat-icon/extra.png') }}"
                                             style=" float: left;">
                                        <p>Extra Messing</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->user_type ==2 || auth()->user()->can('add-desserts'))
                                <li class="nav-item">
                                    <a href="dessert" class="nav-link">
                                        {{--<i class="far fa-circle nav-icon"></i>--}}
                                        <img class="nav-icon" src="{{ asset('/flat-icon/dessert.png') }}"
                                             style=" float: left;">
                                        <p>Dessert</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('place-orders'))
                    <li class="nav-item">
                        <a href="{{ route('view-daily-menus') }}"
                           class="nav-link {{ Request::is('admin/view-daily-menus') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/menu.png') }}" style=" float: left;">
                            <p>View Daily Menus</p>
                        </a>
                    </li>
                @endif

            </ul>
        </li>
    @endif

    {{--Reports--}}
    @if(Auth::user()->user_type ==2)
        <li class="nav-item    has-treeview  {{ request()->is('admin/reports*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <img class="nav-icon" src="{{ asset('/flat-icon/report.png') }}" style=" float: left;">
                <p>
                    Reports
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('reports.users') }}"
                       class="nav-link {{  request()->is('admin/reports/users*') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-yellow"></i>
                        <p>Users In Mess</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.staffs') }}"
                       class="nav-link {{  request()->is('admin/reports/staffs*') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-yellow"></i>
                        <p>Staff In Mess</p>
                    </a>
                </li>
            </ul>
        </li>
    @endif

    {{--Meal Module--}}
    @if(Auth::user()->user_type ==2 || auth()->user()->can('place-orders') || auth()->user()->can('view-orders') || auth()->user()->can('view-orders-report') || auth()->user()->can('billing'))
        <li class="nav-item">
            <a href="" class="nav-link">
                {{--<i class="nav-icon fas fa-calendar"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/meal-manage.png') }}" style=" float: left;">
                <p>
                    Meal Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">

                @if(Auth::user()->user_type ==2 || auth()->user()->can('place-orders'))
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}"
                           class="nav-link {{ Request::is('admin/orders') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/order.png') }}" style=" float: left;">
                            <p>Meal Orders</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-orders'))
                    <li class="nav-item">
                        <a href="{{ route('order-details') }}"
                           class="nav-link {{ Request::is('admin/order-details') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/view-stock.png') }}" style=" float: left;">
                            <p>View Meal Orders</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-orders-report'))
                    <li class="nav-item">
                        <a href="{{ route('order-report') }}"
                           class="nav-link {{ Request::is('admin/order-report') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/order-report.png') }}"
                                 style=" float: left;">
                            <p>View Meal Order Reports</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('billing'))
                    <li class="nav-item">
                        <a href="{{ route('billing') }}"
                           class="nav-link {{ Request::is('admin/billing') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/bill.png') }}" style=" float: left;">
                            <p>Billing</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

<<<<<<< HEAD



=======
    {{--Stock Module--}}
>>>>>>> 5994828ce0c42e300deec56b7e72edb7308f32d8
    @if(Auth::user()->user_type ==2 || auth()->user()->can('stock-view'))
        <li class="nav-item    has-treeview  {{ request()->is('admin/stock*') && !request()->is('admin/stock/bar*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <img class="nav-icon" src="{{ asset('/flat-icon/stock-manage.png') }}" style=" float: left;">
                <p>
                    Stock Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                @if(Auth::user()->user_type ==2 || auth()->user()->can('grn-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/gRNHeader*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon  text-info fas fa fa-receipt"></i>
                            <p>Good Receive</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('gRNHeader.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/gRNHeader/create*') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-info"></i>
                                    <p>Add Good Receive </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('gRNHeader.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/gRNHeader') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-info"></i>
                                    <p>All Good Receive</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('issue-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/issueHeader*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-danger fas fa fa-clipboard-list"></i>
                            <p>Good Issue</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('issueHeader.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/issueHeader/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-danger"></i>
                                    <p>Add Good Issue </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('issueHeader.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/issueHeader') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-danger"></i>
                                    <p>All Good Issues</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('item-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/stockItem*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-warning fas fa fa-cubes"></i>
                            <p>Items</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('stockItem.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/stockItem/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-warning"></i>
                                    <p>Create Item </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stockItem.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/stockItem') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-warning"></i>
                                    <p>All Items</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('stock-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-purple fas fa fa-cash-register"></i>
                            <p>Stocks</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('stock.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/stock') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-purple"></i>
                                    <p>All Stocks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stockAdjustment.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/stockAdjustment/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-purple"></i>
                                    <p>Stock Adjustment </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('stock-book'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/stockBook*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-blue fas fa fa-book"></i>
                            <p>Stocks Book</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('stockBook.selcetQuarter') }}"
                                   class="nav-link   {{  request()->is('admin/stock/stockBook/selcetQuarter') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-blue"></i>
                                    <p>Select Duration</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('reports-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/reports*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon fas text-gradient-navy fa fa-archive"></i>
                            <p>Reports</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('reports.singleitem') }}"
                                   class="nav-link   {{  request()->is('admin/stock/reports/singleitem') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-gradient-navy"></i>
                                    <p>Current stock of a item</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.grnin') }}"
                                   class="nav-link {{  request()->is('admin/stock/reports/grnin') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-gradient-navy"></i>
                                    <p>GRN and IN Details </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.in') }}"
                                   class="nav-link {{  request()->is('admin/stock/reports/in') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-gradient-navy"></i>
                                    <p>Item Issued</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.grnprice') }}"
                                   class="nav-link {{  request()->is('admin/stock/reports/grnprice') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-gradient-navy"></i>
                                    <p>Last GRN Price</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.allitems') }}"
                                   class="nav-link {{  request()->is('admin/stock/reports/allitems') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-gradient-navy"></i>
                                    <p>Category wise stock</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.stock') }}"
                                   class="nav-link {{  request()->is('admin/stock/reports/stock') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-gradient-navy"></i>
                                    <p>Stock</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.recive_expier') }}"
                                   class="nav-link {{  request()->is('admin/stock/reports/recive_expier') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-gradient-navy"></i>
                                    <p>Expire GRN</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.outstock') }}"
                                   class="nav-link {{  request()->is('admin/stock/reports/outstock') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-gradient-navy"></i>
                                    <p>Out of stock Items</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('supplier-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/supplier*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-lime fas fa fa-truck"></i>
                            <p>Supplier</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('supplier.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/supplier/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-lime"></i>
                                    <p>New Supplier </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('supplier.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/supplier') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-lime"></i>
                                    <p>All Suppliers</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(!auth()->user()->can('bar-stock'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/settings*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-yellow fas fa fa-cog"></i>
                            <p>Settings</p>
                        </a>
                        @if(Auth::user()->user_type ==2 || auth()->user()->can('category-list'))
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('stockCategory.index') }}"
                                       class="nav-link   {{  request()->is('admin/stock/settings/stockCategory*') ? 'active' : '' }} ">
                                        <i
                                            class="fas fa fa-list-alt nav-icon text-yellow"></i>
                                        <p>Category</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        @if(Auth::user()->user_type ==2 || auth()->user()->can('measureUnit-list'))
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('measureUnit.index') }}"
                                       class="nav-link   {{  request()->is('admin/stock/settings/measureUnit') ? 'active' : '' }} ">
                                        <i
                                            class="fas fa fa-balance-scale nav-icon text-yellow"></i>
                                        <p>Measure Unit</p>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </li>
                @endif

            </ul>
        </li>
    @endif

    {{--Bar Module--}}
    @if(Auth::user()->user_type ==2 || auth()->user()->can('bar-orders') || auth()->user()->can('bar-stock'))
        <li class="nav-item    has-treeview  {{ request()->is('admin/stock/bar*') ||  request()->is('admin/bar*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <img class="nav-icon" src="{{ asset('/flat-icon/beer.png') }}" style=" float: left;">
                <p>
                    Bar Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                @if(Auth::user()->user_type ==2 || auth()->user()->can('bar-stock'))

                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/barItem*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-warning fas fa fa-cubes"></i>
                            <p>Bar Items</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bar.barItem') }}"
                                   class="nav-link {{  request()->is('admin/stock/bar_item_create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-warning"></i>
                                    <p>Create Bar Item </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('bar.allBarItem') }}"
                                   class="nav-link   {{  request()->is('admin/stock/barItem') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-warning"></i>
                                    <p>All Bar Items</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/bar*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-purple fas fa fa-cash-register"></i>
                            <p>Bar Stocks</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bar.stock') }}"
                                   class="nav-link   {{  request()->is('admin/stock/bar_stock') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon text-purple"></i>
                                    <p>All Bar Stocks</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('bar-orders'))

                    <li class="nav-item    has-treeview  {{ request()->is('admin/bar') || request()->is('admin/stock/bar_orders') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-red fas fa fa-beer"></i>
                            <p>Bar Order</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bar.index') }}"
                                   class="nav-link {{ Request::is('admin/bar') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon text-red"></i>
                                    <p>Create Bar Orders</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('bar.orders') }}"
                                   class="nav-link   {{  request()->is('admin/stock/bar_orders') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon text-red"></i>
                                    <p>View Bar Orders</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                @endif

            </ul>
        </li>
    @endif

    {{--Setting--}}
    <li class="nav-item">
        <a href="" class="nav-link">
            {{--<i class="nav-icon fas fa-calendar"></i>--}}
            <img class="nav-icon" src="{{ asset('/flat-icon/settings.png') }}" style=" float: left;">
            <p>
                Settings
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: none;">


            @if(Auth::user()->user_type ==2)
                <li class="nav-item">
                    <a href="{{ route('settings') }}"
                       class="nav-link {{ Request::is('admin/settings') ? 'active' : '' }}">
                        {{--<i class="nav-icon fas fa-address-card"></i>--}}
                        <img class="nav-icon" src="{{ asset('/flat-icon/change-logo.png') }}" style=" float: left;">
                        <p>Change Logo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('meal-time') }}"
                       class="nav-link {{ Request::is('admin/meal-time') ? 'active' : '' }}">
                        {{--<i class="nav-icon fas fa-address-card"></i>--}}
                        <img class="nav-icon" src="{{ asset('/flat-icon/change-logo.png') }}" style=" float: left;">
                        <p>Set Meal Order Time</p>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('admin-password') }}"
                   class="nav-link {{ Request::is('admin/admin-password') ? 'active' : '' }}">
                    {{--<i class="nav-icon fas fa-address-card"></i>--}}
                    <img class="nav-icon" src="{{ asset('/flat-icon/password.png') }}" style=" float: left;">
                    <p>Change Password</p>
                </a>
            </li>
        </ul>
    </li>

@endif







