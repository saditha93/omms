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
        {{--<li class="nav-item    >--}}

        <li class="nav-item has-treeview  {{ request()->is('admin/establishment*') ? 'menu-open' : '' }}">
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


        <li class="nav-item">
            <a href="{{ route('ahq-establishment') }}"
               class="nav-link {{ Request::is('admin/ahq-establishment') ? 'active' : '' }}">
                {{--<i class="nav-icon fas fa-user"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/estb-to-ahq.png') }}" style=" float: left;">
                <p>Add Estb to AHQ</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('establishment-user') }}"
               class="nav-link {{ Request::is('admin/establishment-user') ? 'active' : '' }}">
                {{--<i class="nav-icon fas fa-user"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/add-estab-user.png') }}" style=" float: left;">
                <p>Add Estb User</p>
            </a>
        </li>
    @endif

    @if(Auth::user()->user_type ==4)
        <li class="nav-item">
            <a href="{{ route('event-order') }}"
               class="nav-link {{ Request::is('admin/event-order') ? 'active' : '' }}">
                {{--<i class="nav-icon fas fa-user"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/event.png') }}" style=" float: left;">
                <p>Place Event Order</p>
            </a>
        </li>
    @endif

    {{--Mess Manager--}}
    @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-roles') || auth()->user()->can('manage-users') || auth()->user()->can('register-officers'))
        <li class="nav-item has-treeview {{request()->is('admin/roles*') || request()->is('admin/users*') || request()->is('admin/officer*')? 'menu-open' : '' }}">
            <a href="" class="nav-link">
                {{--<i class="nav-icon fas fa-calendar"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/user-manage.png') }}" style=" float: left;">
                <p>
                    Users Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-roles') )
                    {{--<li class="nav-item">--}}
                    <li class="nav-item has-treeview {{request()->is('admin/roles*')? 'menu-open' : '' }}">
                        <a href="{{ route('roles.index') }}"
                           class="nav-link {{ Request::is('admin/roles') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-address-card"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/roles.png') }}" style=" float: left;">
                            <p>Manage Role</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-users') )
                    <li class="nav-item has-treeview {{request()->is('admin/users*')? 'menu-open' : '' }}">
                        <a href="{{ route('users.index') }}"
                           class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-user"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/users.png') }}" style=" float: left;">
                            <p>Manage Users</p>
                        </a>
                    </li>
                @endif
                @if(Auth::user()->user_type ==2 || auth()->user()->can('register-officers') )
                    <li class="nav-item {{request()->is('admin/officer*')? 'menu-open' : '' }}">
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

        <li class="nav-item has-treeview {{request()->is('admin/category*') || request()->is('admin/item*') || request()->is('admin/menu*') ||
        request()->is('admin/ration*') || request()->is('admin/tea-items*') || request()->is('admin/extra-messing*')  || request()->is('admin/view-daily-menus') || request()->is('admin/dessert*')? 'menu-open' : '' }}">


            <a href="" class="nav-link">
                {{--<i class="nav-icon fas fa-calendar"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/menu-manage.png') }}" style=" float: left;">
                <p>
                    Menu Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-mess-item-categories'))
                    <li class="nav-item has-treeview {{request()->is('admin/category*')? 'menu-open' : '' }}">
                        <a href="{{ route('category.index') }}"
                           class="nav-link {{ Request::is('admin/category') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-list"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/category.png') }}" style=" float: left;">
                            <p>Serving Category</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-sub-menu-items'))
                    <li class="nav-item has-treeview {{request()->is('admin/item*')? 'menu-open' : '' }}">
                        <a href="{{ route('item.index') }}"
                           class="nav-link {{ Request::is('admin/item') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-shopping-cart"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/items.png') }}" style=" float: left;">
                            <p>Add Menu Items</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('manage-mess-menus'))
                    <li class="nav-item has-treeview {{request()->is('admin/menu*')? 'menu-open' : '' }}">
                        <a href="{{ route('menu.index') }}"
                           class="nav-link {{ Request::is('admin/menu') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/mess-menu.png') }}" style=" float: left;">
                            <p>Add Menus</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('add-daily-rations') || auth()->user()->can('add-tea-items') || auth()->user()->can('add-extra-messing') || auth()->user()->can('add-desserts'))
                    <li class="nav-item has-treeview {{request()->is('admin/ration*') || request()->is('admin/extra-messing') ||
                    request()->is('admin/tea-items*') || request()->is('admin/dessert*')? 'menu-open' : '' }}">
                        <a href="" class="nav-link">
                            {{--<i class="nav-icon fas fa-calendar"></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/daily-ration.png') }}"
                                 style=" float: left;">
                            <p>
                                Assign Menus
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(Auth::user()->user_type ==2 || auth()->user()->can('add-daily-rations'))
                                <li class="nav-item has-treeview {{request()->is('admin/ration*')? 'menu-open' : '' }}">
                                    <a href="{{ route('ration.index') }}"
                                       class="nav-link {{ request()->is('admin/ration*') ? 'active' : '' }}">
                                        {{--<i class="far fa-circle nav-icon"></i>--}}
                                        <img class="nav-icon" src="{{ asset('/flat-icon/ration.png') }}"
                                             style=" float: left;">
                                        <p>Messing</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->user_type ==2 || auth()->user()->can('add-tea-items'))
                                <li class="nav-item {{request()->is('admin/tea-items*')? 'menu-open' : '' }}">
                                    <a href="{{route('tea-items')}}"
                                       class="nav-link {{request()->is('admin/tea-items')?'active':''}}">
                                        {{--<i class="far fa-circle nav-icon"></i>--}}
                                        <img class="nav-icon" src="{{ asset('/flat-icon/tea.png') }}"
                                             style=" float: left;">
                                        <p>Tea</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->user_type ==2 || auth()->user()->can('add-extra-messing'))
                                <li class="nav-item {{request()->is('admin/extra-messing*')? 'menu-open' : '' }}">
                                    <a href="{{route('extra-messing')}}"
                                       class="nav-link {{request()->is('admin/extra-messing')?'active':''}} ">
                                        {{--<i class="far fa-circle nav-icon"></i>--}}
                                        <img class="nav-icon" src="{{ asset('/flat-icon/extra.png') }}"
                                             style=" float: left;">
                                        <p>Extra Messing</p>
                                    </a>
                                </li>
                            @endif
                            @if(Auth::user()->user_type ==2 || auth()->user()->can('add-desserts'))
                                <li class="nav-item {{request()->is('admin/dessert*')? 'menu-open' : '' }}">
                                    <a href="{{route('dessert')}}"
                                       class="nav-link {{request()->is('admin/dessert*')? 'active' : '' }}">
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
                    <li class="nav-item {{request()->is('admin/view-daily-menus')? 'menu-open' : '' }}">
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

    {{--Meal Module--}}
    @if(Auth::user()->user_type ==2 || auth()->user()->can('place-orders') || auth()->user()->can('view-orders'))
        <li class="nav-item has-treeview  {{ request()->is('admin/orders*') ||  request()->is('admin/order-details*')? 'menu-open' : '' }}">
            <a href="" class="nav-link">
                {{--<i class="nav-icon fas fa-calendar"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/meal-manage.png') }}" style=" float: left;">
                <p>
                    Meal Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                @if(Auth::user()->user_type ==2 || auth()->user()->can('place-orders'))
                    <li class="nav-item {{  request()->is('admin/orders*') ? 'active' : '' }}">
                        <a href="{{ route('orders.index') }}"
                           class="nav-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/order.png') }}" style=" float: left;">
                            <p>Meal Orders</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-orders'))
                    <li class="nav-item {{  request()->is('admin/order-details*') ? 'active' : '' }}">
                        <a href="{{ route('order-details') }}"
                           class="nav-link {{ request()->is('admin/order-details*') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/view-stock.png') }}" style=" float: left;">
                            <p>View Meal Orders</p>
                        </a>
                    </li>
                @endif

                {{--@if(Auth::user()->user_type ==2 || auth()->user()->can('view-orders-report'))--}}
                {{--<li class="nav-item">--}}
                {{--<a href="{{ route('order-report') }}"--}}
                {{--class="nav-link {{ Request::is('admin/order-report') ? 'active' : '' }}">--}}
                {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                {{--<img class="nav-icon" src="{{ asset('/flat-icon/order-report.png') }}"--}}
                {{--style=" float: left;">--}}
                {{--<p>View Meal Order Reports</p>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--@endif--}}

                {{--@if(Auth::user()->user_type ==2 || auth()->user()->can('billing'))--}}
                {{--<li class="nav-item">--}}
                {{--<a href="{{ route('billing') }}"--}}
                {{--class="nav-link {{ Request::is('admin/billing') ? 'active' : '' }}">--}}
                {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                {{--<img class="nav-icon" src="{{ asset('/flat-icon/bill.png') }}" style=" float: left;">--}}
                {{--<p>Billing</p>--}}
                {{--</a>--}}
                {{--</li>--}}
                {{--@endif--}}
            </ul>
        </li>
    @endif

    {{--Billing Module--}}
    @if(Auth::user()->user_type ==2 ||  auth()->user()->can('billing'))
        <li class="nav-item has-treeview  {{ request()->is('admin/billing_mess') ||  request()->is('admin/bar') ||  request()->is('admin/stock/bar_orders') ||  request()->is('admin/billing_event') ||  request()->is('admin/billing_general') ||  request()->is('admin/bill_payments') ? 'menu-open' : '' }}">
            <a href="" class="nav-link">
                {{--<i class="nav-icon fas fa-calendar"></i>--}}
                <img class="nav-icon" src="{{ asset('/flat-icon/bill-management.png') }}" style=" float: left;">
                <p>
                    Billing Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                @if(Auth::user()->user_type ==2 || auth()->user()->can('billing'))
                    <li class="nav-item">
                        <a href="{{ route('billing_mess') }}"
                           class="nav-link {{ Request::is('admin/billing_mess') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/bill.png') }}" style=" float: left;">
                            <p>Mess Billing</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('billing-event'))
                    <li class="nav-item">
                        <a href="{{ route('billing_event') }}"
                           class="nav-link {{ Request::is('admin/billing_event') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/bill.png') }}" style=" float: left;">
                            <p>Event Billing</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('billing-general'))
                    <li class="nav-item">
                        <a href="{{ route('billing_general') }}"
                           class="nav-link {{ Request::is('admin/billing_general') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/bill.png') }}" style=" float: left;">
                            <p>General Deductions</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('billing'))
                    <li class="nav-item">
                        <a href="{{ route('bill_payments') }}"
                           class="nav-link {{ Request::is('admin/bill_payments') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/bill.png') }}" style=" float: left;">
                            <p>Mess Bill Payments</p>
                        </a>
                    </li>
                @endif


            </ul>
        </li>
    @endif

    {{--Stock Module--}}
    @if(Auth::user()->user_type ==2)
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
                            <p>Good Receive Note</p>
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
                            <p>Good Issue Note</p>
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
                            <p>Items Management</p>
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
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/stock*') ? 'menu-open' : '' }}">
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
                                    <p>Stock Reorder Level</p>
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
                                    <p>Current stock</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('reports.grnin') }}"
                                   class="nav-link {{  request()->is('admin/stock/reports/grnin') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-gradient-navy"></i>
                                    <p>GRN and GIN Details </p>
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
                                    <p>Expire Items</p>
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

    {{--Stock Module Stock Keaper --}}
    @if(auth()->user()->can('stock-view'))
        <li class="nav-item    has-treeview  {{ request()->is('admin/stock/gRNHeader*') || request()->is('admin/stock/issueHeader*') || request()->is('admin/stock/stock') || request()->is('admin/stock/stockAdjustment*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <i class="nav-icon  text-yellow fas fa fa-cash-register"></i>
                <p>Stock Management</p>
            </a>
            <ul class="nav nav-treeview">
                @if(auth()->user()->can('grn-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/gRNHeader*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon  text-yellow fas fa fa-receipt"></i>
                            <p>Good Receive Note</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('gRNHeader.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/gRNHeader/create*') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-yellow"></i>
                                    <p>Add Good Receive </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('gRNHeader.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/gRNHeader') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-yellow"></i>
                                    <p>All Good Receive</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->can('issue-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/issueHeader*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-yellow fas fa fa-clipboard-list"></i>
                            <p>Good Issue Note</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('issueHeader.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/issueHeader/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-yellow"></i>
                                    <p>Add Good Issue </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('issueHeader.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/issueHeader') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-yellow"></i>
                                    <p>All Good Issues</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->can('stock-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/stock') || request()->is('admin/stock/stockAdjustment*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-yellow fas fa fa-file"></i>
                            <p>Stocks</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('stock.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/stock') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-yellow"></i>
                                    <p>All Stocks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stockAdjustment.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/stockAdjustment/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-yellow"></i>
                                    <p>Stock Reorder Level</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </li>
        <li class="nav-item    has-treeview  {{ request()->is('admin/stock/stockItem*') || request()->is('admin/stock/supplier*') || request()->is('admin/stock/settings/stockCategory*') || request()->is('admin/stock/settings/measureUnit*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link" style="width: max-content;">
                <i class="nav-icon  text-info fas fa fa-database"></i>
                <p>Master Data Management</p>
            </a>
            <ul class="nav nav-treeview">
                @if(auth()->user()->can('item-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/stockItem*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-info fas fa fa-cubes"></i>
                            <p>Items Management</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('stockItem.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/stockItem/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-info"></i>
                                    <p>Create Item </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('stockItem.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/stockItem') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-info"></i>
                                    <p>All Items</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->can('supplier-list'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/supplier*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-info fas fa fa-truck"></i>
                            <p>Supplier</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('supplier.create') }}"
                                   class="nav-link {{  request()->is('admin/stock/supplier/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-info"></i>
                                    <p>New Supplier </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('supplier.index') }}"
                                   class="nav-link   {{  request()->is('admin/stock/supplier') ? 'active' : '' }} ">
                                    <i
                                        class="far fa-circle nav-icon text-info"></i>
                                    <p>All Suppliers</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->can('category-list'))
                    <li class="nav-item">
                        <a href="{{ route('stockCategory.index') }}"
                           class="nav-link   {{  request()->is('admin/stock/settings/stockCategory*') ? 'active' : '' }} ">
                            <i
                                class="fas fa fa-list-alt nav-icon text-info"></i>
                            <p>Category</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('measureUnit-list'))
                    <li class="nav-item">
                        <a href="{{ route('measureUnit.index') }}"
                           class="nav-link   {{  request()->is('admin/stock/settings/measureUnit') ? 'active' : '' }} ">
                            <i
                                class="fas fa fa-balance-scale nav-icon text-info"></i>
                            <p>Measure Unit</p>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        @if(Auth::user()->user_type ==2 || auth()->user()->can('reports-list'))
            <li class="nav-item    has-treeview  {{ request()->is('admin/stock/reports*') || request()->is('admin/stock/stockBook*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link  ">
                    <i class="nav-icon fas text-gradient-navy fa fa-archive"></i>
                    <p>Reports</p>
                </a>
                <ul class="nav nav-treeview">
                    @if(auth()->user()->can('stock-book'))
                        <li class="nav-item    has-treeview  {{ request()->is('admin/stock/stockBook*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link" style="width: max-content;">
                                <i class="nav-icon text-blue fas fa fa-book"></i>
                                <p>Stocks Receive And Issue Summary</p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('stockBook.selcetQuarter') }}"
                                       class="nav-link   {{  request()->is('admin/stock/stockBook*') ? 'active' : '' }} ">
                                        <i
                                            class="far fa-circle nav-icon text-blue"></i>
                                        <p>Select Duration</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('reports.singleitem') }}"
                           class="nav-link   {{  request()->is('admin/stock/reports/singleitem') ? 'active' : '' }} ">
                            <i
                                class="far fa-circle nav-icon text-gradient-navy"></i>
                            <p>Current stock</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('reports.grnin') }}"
                           class="nav-link {{  request()->is('admin/stock/reports/grnin') ? 'active' : '' }}  ">
                            <i
                                class="far fa-circle nav-icon text-gradient-navy"></i>
                            <p>GRN and GIN Details </p>
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
                            <p>Expire Items</p>
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
    @endif

    {{--Bar Module--}}
    @if(Auth::user()->user_type ==2)
        <li class="nav-item    has-treeview  {{ request()->is('admin/stock/bar*') ||  request()->is('admin/bar*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <img class="nav-icon" src="{{ asset('/flat-icon/beer.png') }}" style=" float: left;">
                <p>
                    Bar Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item    has-treeview  {{ request()->is('admin/bargrn*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  ">
                        <i class="nav-icon  text-info fas fa fa-receipt"></i>
                        <p>Bar Item Receive</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bar.grn.create') }}"
                               class="nav-link {{  request()->is('admin/bargrn_create') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-info"></i>
                                <p>Add Bar Item Receive </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gRNHeader.bar.index') }}"
                               class="nav-link   {{  request()->is('admin/bargrn_index') || request()->is('admin/bargrnItems')  ? 'active' : '' }} ">
                                <i
                                    class="far fa-circle nav-icon text-info"></i>
                                <p>All Bar Item Receive</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(Auth::user()->user_type ==2 || auth()->user()->can('bar-orders'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/bar') || request()->is('admin/stock/bar_orders') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-red fas fa fa-beer"></i>
                            <p>Bar Billing</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bar.index') }}"
                                   class="nav-link {{ request()->is('admin/bar') ? 'active' : '' }}">
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

                @if(Auth::user()->user_type ==2 || auth()->user()->can('bar-stock'))

                    <li class="nav-item    has-treeview  {{ request()->is('admin/stock/barItem*') || request()->is('admin/stock/bar_item*') ? 'menu-open' : '' }}">
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
                            <li class="nav-item">
                                <a href="{{ route('barstockAdjustment.create') }}"
                                   class="nav-link {{  request()->is('admin/barstockAdjustment/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-purple"></i>
                                    <p>Stock Reorder Level</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item    has-treeview  {{ request()->is('admin/barsupplier*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  ">
                        <i class="nav-icon text-lime fas fa fa-truck"></i>
                        <p>Supplier</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bar.supplier.create') }}"
                               class="nav-link {{  request()->is('admin/barsupplier/create') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-lime"></i>
                                <p>New Supplier </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bar.supplier') }}"
                               class="nav-link   {{  request()->is('admin/barsupplier') ? 'active' : '' }} ">
                                <i
                                    class="far fa-circle nav-icon text-lime"></i>
                                <p>All Suppliers</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item    has-treeview  {{ request()->is('admin/bar_report*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon text-red fas fa fa-file"></i>
                        <p>Bar Reports</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reports.barsingleitem') }}"
                               class="nav-link   {{  request()->is('admin/bar_report/barsingleitem') ? 'active' : '' }} ">
                                <i
                                    class="far fa-circle nav-icon text-red"></i>
                                <p>Stock of Bar Items</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.bargrnin') }}"
                               class="nav-link {{  request()->is('admin/bar_report/bargrnin') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-red"></i>
                                <p>GRN Details </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.bargrnprice') }}"
                               class="nav-link {{  request()->is('admin/bar_report/bargrnprice') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-red"></i>
                                <p>Last GRN Price</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.barallitems') }}"
                               class="nav-link {{  request()->is('admin/bar_report/batallitems') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-red"></i>
                                <p>Category wise stock</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.barstock') }}"
                               class="nav-link {{  request()->is('admin/bar_report/stock') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-red"></i>
                                <p>Stock</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.baroutstock') }}"
                               class="nav-link {{  request()->is('admin/bar_report/baroutstock') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-red"></i>
                                <p>Out of stock Items</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item    has-treeview  {{ request()->is('admin/barsettings*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  ">
                        <i class="nav-icon text-yellow fas fa fa-cog"></i>
                        <p>Settings</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('barCategory.index') }}"
                               class="nav-link   {{  request()->is('admin/barsettings/barCat*') ? 'active' : '' }} ">
                                <i
                                    class="fas fa fa-list-alt nav-icon text-yellow"></i>
                                <p>Category</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('barmeasureUnit.index') }}"
                               class="nav-link   {{  request()->is('admin/barsettings/measureUnit*') ? 'active' : '' }} ">
                                <i
                                    class="fas fa fa-balance-scale nav-icon text-yellow"></i>
                                <p>Measure Unit</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>
    @endif

    {{--Bar Module For Barman--}}
    @if(auth()->user()->can('bar-orders') || auth()->user()->can('bar-stock'))
        <li class="nav-item    has-treeview  {{ request()->is('admin/stock/bar_orders') || request()->is('admin/bargrn*') || request()->is('admin/bar') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  ">
                <img class="nav-icon" src="{{ asset('/flat-icon/beer.png') }}" style=" float: left;">
                <p>
                    Bar Order Management
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item    has-treeview  {{ request()->is('admin/bargrn*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  ">
                        <i class="nav-icon  text-info fas fa fa-receipt"></i>
                        <p>Bar Item Receive</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bar.grn.create') }}"
                               class="nav-link {{  request()->is('admin/bargrn_create') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-info"></i>
                                <p>Add Bar Item Receive </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('gRNHeader.bar.index') }}"
                               class="nav-link   {{  request()->is('admin/bargrn_index') || request()->is('admin/bargrnItems')  ? 'active' : '' }} ">
                                <i
                                    class="far fa-circle nav-icon text-info"></i>
                                <p>All Bar Item Receive</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(auth()->user()->can('bar-orders'))
                    <li class="nav-item    has-treeview  {{ request()->is('admin/bar') || request()->is('admin/stock/bar_orders') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-info fas fa fa-beer"></i>
                            <p>Bar Billing</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bar.index') }}"
                                   class="nav-link {{ request()->is('admin/bar') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon text-info"></i>
                                    <p>Create Bar Orders</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('bar.orders') }}"
                                   class="nav-link   {{  request()->is('admin/stock/bar_orders') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon text-info"></i>
                                    <p>View Bar Orders</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </li>
        @if(auth()->user()->can('bar-stock'))
            <li class="nav-item    has-treeview  {{ request()->is('admin/stock/bar_stock') || request()->is('admin/barstockAdjustment*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link" style="width: max-content">
                    <i class="nav-icon text-purple fas fa fa-cash-register"></i>
                    <p>Bar Stocks Management</p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item    has-treeview  {{  request()->is('admin/stock/bar_stock') || request()->is('admin/barstockAdjustment*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link  ">
                            <i class="nav-icon text-purple fas fa fa-cash-register"></i>
                            <p>Bar Stock</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('bar.stock') }}"
                                   class="nav-link   {{  request()->is('admin/stock/bar_stock') ? 'active' : '' }} ">
                                    <i class="far fa-circle nav-icon text-purple"></i>
                                    <p>All Bar Stocks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('barstockAdjustment.create') }}"
                                   class="nav-link {{  request()->is('admin/barstockAdjustment/create') ? 'active' : '' }}  ">
                                    <i
                                        class="far fa-circle nav-icon text-purple"></i>
                                    <p>Stock Reorder Level</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif
        <li class="nav-item    has-treeview  {{ request()->is('admin/stock/bar_item_create*') || request()->is('admin/stock/barItem*') || request()->is('admin/barsupplier*') || request()->is('admin/barsettings/barCat*') || request()->is('admin/barsettings/measureUnit*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link" style="width: max-content">
                <i class="nav-icon text-lime fas fa fa-database"></i>
                <p>Master data Management</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item    has-treeview  {{ request()->is('admin/stock/bar_item_create') || request()->is('admin/stock/barItem') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  ">
                        <i class="nav-icon text-lime fas fa fa-cash-register"></i>
                        <p>Bar Items</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bar.barItem') }}"
                               class="nav-link {{  request()->is('admin/stock/bar_item_create') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-lime"></i>
                                <p>Create Bar Item </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bar.allBarItem') }}"
                               class="nav-link   {{  request()->is('admin/stock/barItem') ? 'active' : '' }} ">
                                <i
                                    class="far fa-circle nav-icon text-lime"></i>
                                <p>All Bar Items</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item    has-treeview  {{ request()->is('admin/barsupplier*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon text-lime fas fa fa-truck"></i>
                        <p>Suppliers</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bar.supplier.create') }}"
                               class="nav-link {{  request()->is('admin/barsupplier/create') ? 'active' : '' }}  ">
                                <i
                                    class="far fa-circle nav-icon text-lime"></i>
                                <p>New Supplier </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('bar.supplier') }}"
                               class="nav-link   {{  request()->is('admin/barsupplier') ? 'active' : '' }} ">
                                <i
                                    class="far fa-circle nav-icon text-lime"></i>
                                <p>All Suppliers</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('barCategory.index') }}"
                       class="nav-link   {{  request()->is('admin/barsettings/barCat*') ? 'active' : '' }} ">
                        <i
                            class="fas fa fa-list-alt nav-icon text-lime"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('barmeasureUnit.index') }}"
                       class="nav-link   {{  request()->is('admin/barsettings/measureUnit*') ? 'active' : '' }} ">
                        <i
                            class="fas fa fa-balance-scale nav-icon text-lime"></i>
                        <p>Measure Unit</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item    has-treeview  {{ request()->is('admin/bar_report*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon text-red fas fa fa-file"></i>
                <p>Bar Reports</p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('reports.barsingleitem') }}"
                       class="nav-link   {{  request()->is('admin/bar_report/barsingleitem') ? 'active' : '' }} ">
                        <i
                            class="far fa-circle nav-icon text-red"></i>
                        <p>Stock of Bar Items</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.bargrnin') }}"
                       class="nav-link {{  request()->is('admin/bar_report/bargrnin') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-red"></i>
                        <p>GRN Details </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.bargrnprice') }}"
                       class="nav-link {{  request()->is('admin/bar_report/bargrnprice') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-red"></i>
                        <p>Last GRN Price</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.barallitems') }}"
                       class="nav-link {{  request()->is('admin/bar_report/barallitems') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-red"></i>
                        <p>Category wise stock</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.barstock') }}"
                       class="nav-link {{  request()->is('admin/bar_report/barstock') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-red"></i>
                        <p>Stock</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.baroutstock') }}"
                       class="nav-link {{  request()->is('admin/bar_report/baroutstock') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-red"></i>
                        <p>Out of stock Items</p>
                    </a>
                </li>
            </ul>
        </li>
    @endif

    @if(Auth::user()->estb == \App\Models\Establishments::where('abbr','AHQ')->first()->id)
    
            <li class="nav-item">
                <a href="{{ route('view-event-order') }}"
                   class="nav-link {{ Request::is('admin/view-event-order') ? 'active' : '' }}">
                    {{--<i class="nav-icon fas fa-user"></i>--}}
                    <img class="nav-icon" src="{{ asset('/flat-icon/event.png') }}" style=" float: left;">
                    <p>View Event Order</p>
                </a>
            </li>
    @endif

    {{--Reports--}}
    @if(Auth::user()->user_type ==2 || auth()->user()->can('view-report-messing') || auth()->user()->can('view-report-bar') || auth()->user()->can('view-report-all') || auth()->user()->can('view-report-event') || auth()->user()->can('view-report-general') )
        <li class="nav-item    has-treeview  {{ request()->is('admin/reports*') || request()->is('admin/report-messing') ||
        request()->is('admin/report-bar') || request()->is('admin/report-all') || request()->is('admin/report-messing') ||
        request()->is('admin/report-bar') || request()->is('admin/report-event') || request()->is('admin/report-general') || request()->is('admin/report-all') || request()->is('admin/report-all-officers') ? 'menu-open' : '' }}">
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
                        <p>Registered Members</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('reports.staffs') }}"
                       class="nav-link {{  request()->is('admin/reports/staffs*') ? 'active' : '' }}  ">
                        <i
                            class="far fa-circle nav-icon text-yellow"></i>
                        <p>Mess Staff</p>
                    </a>
                </li>

                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-report-messing'))
                    <li class="nav-item ">
                        <a href="{{ route('report-messing') }}"
                           class="nav-link {{ Request::is('admin/report-messing') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/order-report.png') }}"
                                 style=" float: left;">
                            <p>Meal Order Bill</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-report-bar'))
                    <li class="nav-item ">
                        <a href="{{ route('report-bar') }}"
                           class="nav-link {{ Request::is('admin/report-bar') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/order-report.png') }}"
                                 style=" float: left;">
                            <p>Bar Order Bill</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-report-event'))
                    <li class="nav-item ">
                        <a href="{{ route('report-event') }}"
                           class="nav-link {{ Request::is('admin/report-event') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/order-report.png') }}"
                                 style=" float: left;">
                            <p>Event Order Bill</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-report-general'))
                    <li class="nav-item ">
                        <a href="{{ route('report-general') }}"
                           class="nav-link {{ Request::is('admin/report-general') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/order-report.png') }}"
                                 style=" float: left;">
                            <p>General Deductions</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-report-all'))
                    <li class="nav-item ">
                        <a href="{{ route('report-all') }}"
                           class="nav-link {{ Request::is('admin/report-all') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/order-report.png') }}"
                                 style=" float: left;">
                            <p>Total Order Bill</p>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-report-all'))
                    <li class="nav-item ">
                        <a href="{{ route('report-all-officers') }}"
                           class="nav-link {{ Request::is('admin/report-all-officers') ? 'active' : '' }}">
                            {{--<i class="nav-icon fas fa-sticky-note "></i>--}}
                            <img class="nav-icon" src="{{ asset('/flat-icon/order-report.png') }}"
                                 style=" float: left;">
                            <p>Total Mess Bill</p>
                        </a>
                    </li>
                @endif

            </ul>
        </li>
    @endif


    {{--Setting--}}
    <li class="nav-item has-treeview  {{ request()->is('admin/settings*') || request()->is('admin/meal-time*') || request()->is('admin/admin-password') ? 'menu-open' : '' }}">
        <a href="" class="nav-link">
            {{--<i class="nav-icon fas fa-calendar"></i>--}}
            <img class="nav-icon" src="{{ asset('/flat-icon/settings.png') }}" style=" float: left;">
            <p>
                Settings
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">


            @if(Auth::user()->user_type ==2)
                <li class="nav-item">
                    <a href="{{ route('settings') }}"
                       class="nav-link {{ request()->is('admin/settings') ? 'active' : '' }}">
                        {{--<i class="nav-icon fas fa-address-card"></i>--}}
                        <img class="nav-icon" src="{{ asset('/flat-icon/change-logo.png') }}" style=" float: left;">
                        <p>Change Logo</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('meal-time') }}"
                       class="nav-link {{ request()->is('admin/meal-time') ? 'active' : '' }}">
                        {{--<i class="nav-icon fas fa-address-card"></i>--}}
                        <img class="nav-icon" src="{{ asset('/flat-icon/meal-time.png') }}" style=" float: left;">
                        <p>Set Meal Order Time</p>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('admin-password') }}"
                   class="nav-link {{ request()->is('admin/admin-password') ? 'active' : '' }}">
                    {{--<i class="nav-icon fas fa-address-card"></i>--}}
                    <img class="nav-icon" src="{{ asset('/flat-icon/password.png') }}" style=" float: left;">
                    <p>Change Password</p>
                </a>
            </li>
        </ul>
    </li>

@endif







