<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--select-2--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>


    {{--date time picker--}}
    <link rel="stylesheet" href="{{asset('/css/datepicker/datepicker.css')}}"/>

    {{--clock picker--}}
    <link rel="stylesheet" href="{{asset('/css/clock-picker/jquery-clockpicker.min.css')}}"/>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/Sri_Lanka_Army_Logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/Sri_Lanka_Army_Logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/Sri_Lanka_Army_Logo.png') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{--<link href="{{ mix('css/app.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('third_party_stylesheets')
    @stack('page_css')

    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 4px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #363232;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #f6eded;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>


        <ul class="navbar-nav ml-auto">

            {{--Open Notification Button--}}
            @if(auth()->user()->can('stock-view'))

                <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                        class="inline-flex items-center text-sm font-medium text-center text-white-400 hover:text-gray-900 focus:outline-none dark:hover:text-gray-900 dark:text-gray-400 pr-4"
                        type="button">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                    </svg>
                    <div class="flex relative">
                        <div
                            class="inline-flex relative -top-2 right-3 w-3 h-3 bg-red-500 rounded-full border-2 border-white dark:border-gray-900"></div>
                    </div>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownNotification"
                     class="hidden z-20 w-full max-w-sm bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-800 dark:divide-gray-700"
                     aria-labelledby="dropdownNotificationButton">
                    <div
                        class="block py-2 px-4 font-medium text-center bg-danger text-gray-700 bg-gray-50 dark:bg-gray-800 dark:text-white">
                        Notifications
                    </div>
                    <div id="notificationData">
                        <div>

                        </div>
                    </div>
                </div>
            @endif

            @if(auth()->user()->can('bar-orders') || auth()->user()->can('bar-stock'))

                <button id="bardropdownNotificationButton" data-dropdown-toggle="dropdownNotification"
                        class="inline-flex items-center text-sm font-medium text-center text-white-400 hover:text-gray-900 focus:outline-none dark:hover:text-gray-900 dark:text-gray-400 pr-4"
                        type="button">
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                    </svg>
                    <div class="flex relative">
                        <div
                            class="inline-flex relative -top-2 right-3 w-3 h-3 bg-red-500 rounded-full border-2 border-white dark:border-gray-900"></div>
                    </div>
                </button>

                <!-- Dropdown menu -->
                <div id="dropdownNotification"
                     class="hidden z-20 w-full max-w-sm bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-800 dark:divide-gray-700"
                     aria-labelledby="dropdownNotificationButton">
                    <div
                        class="block py-2 px-4 font-medium text-center bg-danger text-gray-700 bg-gray-50 dark:bg-gray-800 dark:text-white">
                        Notifications
                    </div>
                    <div id="notificationData">
                        <div>

                        </div>
                    </div>
                </div>
            @endif
            {{--Close Notification Button--}}

            @if(Auth::user()->user_type ==2 || auth()->user()->can('view-mess-item-categories'))
                <li class="nav-item dropdown">
                    <a class="nav-link breakfast-clear" href="{{ route('all-breakfast') }}">
                        <i class="far fa-bell"> Breakfast</i>
                        <span class="badge badge-primary navbar-badge mt-4 breakfast-val"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link lunch-clear" href="{{ route('all-lunch') }}">
                        <i class="far fa-bell"> Lunch</i>
                        <span class="badge badge-primary navbar-badge mt-4 lunch-val"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dinner-clear" href="{{ route('all-dinner') }}">
                        <i class="far fa-bell"> Dinner</i>
                        <span class="badge badge-primary navbar-badge mt-4 dinner-val"></span>
                    </a>
                </li>

                @if(Auth::user()->user_type ==2)
                    @if(Auth::user()->estb == \App\Models\Establishments::where('abbr','AHQ')->first()->id)
                <li class="nav-item dropdown">
                    <a class="nav-link event-clear" href="{{ route('all-event') }}">
                        <i class="far fa-bell"> Event</i>
                        <span class="badge badge-primary navbar-badge mt-4 event-val"></span>
                    </a>
                </li>
                    @endif
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link other-clear" href="{{ route('all-other') }}">
                        <i class="far fa-bell"> Other</i>
                        <span class="badge badge-primary navbar-badge mt-4 other-val"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link tea-clear" href="{{ route('all-tea') }}">
                        <i class="far fa-bell"> Tea</i>
                        <span class="badge badge-primary navbar-badge mt-4 tea-val"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link extra-clear" href="{{ route('all-extra') }}">
                        <i class="far fa-bell"> Extra</i>
                        <span class="badge badge-primary navbar-badge mt-4 extra-val"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dessert-clear" href="{{ route('all-dessert') }}">
                        <i class="far fa-bell"> Dessert</i>
                        <span class="badge badge-primary navbar-badge mt-4 dessert-val"></span>
                    </a>
                </li>
            @endif

            @if(Auth::user()->user_type ==4)
                <li class="nav-item dropdown">
                    <a class="nav-link event-clear" href="{{ route('rspnd-event-ntf-clear') }}">
                        <i class="far fa-bell"> Event</i>
                        <span class="badge badge-primary navbar-badge mt-4 event-val-responded"></span>
                    </a>
                </li>
            @endif


            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('flat-icon/user.png') }}"
                         class="user-image img-circle elevation-2" alt="User Image" style="float: left !important;">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="{{ asset('images/Sri_Lanka_Army_Logo.png') }}"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

    </nav>

    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(session()->has('status'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('status')}}
            </div>
        @endif
        @if(session()->has('foreign'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('foreign')}}
            </div>
        @endif
        @if(session()->has('waring'))
            <div class="alert alert-warning" role="alert">
                {{ session()->get('waring')}}
            </div>
        @endif
        @yield('content')
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright © 2022 . &copy; 2014-2022 <a href="">Software Solution by Directorate of Information
                Technology</a>.</strong> - SRI LANKA ARMY

    </footer>
</div>

<script src="{{ asset('js/app.js') }}"></script>
{{--select-2--}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    //get ration counts
    $(document).ready(function () {

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            url: '{{route('get-order-notifications')}}',
            type: 'POST',
            success: function (response) {

                $(".breakfast-val").empty();
                $(".lunch-val").empty();
                $(".dinner-val").empty();
                $(".event-val").empty();
                $(".event-val-responded").empty();
                $(".other-val").empty();

                $(".tea-val").empty();
                $(".extra-val").empty();
                $(".dessert-val").empty();


                if (response.breakfastOrders) {
                    $(".breakfast-val").append(response.breakfastOrders);

                }
                if (response.lunchOrders) {
                    $(".lunch-val").append(response.lunchOrders);

                }
                if (response.dinnerOrders) {
                    $(".dinner-val").append(response.dinnerOrders);

                }
                if (response.eventOrders) {
                    $(".event-val").append(response.eventOrders);

                }
                if (response.eventOrdersResponse) {
                    $(".event-val-responded").append(response.eventOrdersResponse);

                }
                if (response.otherOrders) {
                    $(".other-val").append(response.otherOrders);

                }

                if (response.teaOrders) {
                    $(".tea-val").append(response.teaOrders);

                }
                if (response.dessertOrders) {
                    $(".dessert-val").append(response.dessertOrders);

                }
                if (response.extraOrders) {
                    $(".extra-val").append(response.extraOrders);

                }

            },
            error: function (error) {
            }
        });


        $('.breakfast-clear').on('click', function () {
            clearNotification('breakfast');
        });
        $('.lunch-clear').on('click', function () {
            clearNotification('lunch');
        });
        $('.dinner-clear').on('click', function () {
            clearNotification('dinner');
        });
        $('.tea-clear').on('click', function () {
            clearNotification('tea');
        });
        $('.event-clear').on('click', function () {
            clearNotification('event');
        });
        $('.extra-clear').on('click', function () {
            clearNotification('extra');
        });
        $('.dessert-clear').on('click', function () {
            clearNotification('dessert');
        });
        $('.other-clear').on('click', function () {
            clearNotification('other');
        });

        function clearNotification(val) {

            let clearMenu = (val)

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                url: '{{route('clear-dashboard-notification')}}',
                type: 'POST',
                data: {clearMenu: clearMenu},
                success: function (response) {


                },
                error: function (error) {
                }
            });
        }

    });
</script>

<script>
    $('#dropdownNotificationButton').click(function () {
        var id = 0;
        $.ajax({
            url: '{{ route('ajax.getOutStockRation') }}',
            type: 'get',
            data: {
                'id': id,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                var i = 1;
                $('#notificationData div').remove();
                $.each(response, function (key, value) {

                    var APP_URL = {!! json_encode(url('/admin/stock/stock/')) !!}

                        APP_URL = APP_URL + '/' + value.stock.id

                    $('#notificationData').append("<div class='divide-y divide-gray-100 dark:divide-gray-700'>\
                    <a href='" + APP_URL + " ' class='flex py-3 px-4 bg-red-100 hover:bg-blue-200 dark:hover:bg-gray-700'>\
                    <divclass='pl-3 w-full'>\
                     <div class='text-black text-sm mb-1.5 dark:text-black'>" + value.name + '\xa0\xa0\xa0\xa0' + "    below to reorder level</div>\
                    </a></div>");

                })
            }
        });
    })

    $('#bardropdownNotificationButton').click(function () {
        var id = 0;
        $.ajax({
            url: '{{ route('ajax.getOutStockBar') }}',
            type: 'get',
            data: {
                'id': id,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                var i = 1;
                $('#notificationData div').remove();
                $.each(response, function (key, value) {

                    var APP_URL = {!! json_encode(url('/admin/stock/stock/')) !!}

                        APP_URL = APP_URL + '/' + value.stock.id

                    $('#notificationData').append("<div class='divide-y divide-gray-100 dark:divide-gray-700'>\
                    <a href='" + APP_URL + " ' class='flex py-3 px-4 bg-red-100 hover:bg-blue-200 dark:hover:bg-gray-700'>\
                    <divclass='pl-3 w-full'>\
                     <div class='text-black text-sm mb-1.5 dark:text-black'>" + value.name + '\xa0\xa0\xa0\xa0' + "    below to reorder level</div>\
                    </a></div>");

                })
            }
        });
    })

    $('[data-toggle="tooltip"]').hover(function () {
        $('[data-toggle="tooltip"]').tooltip({
            sanitize: false
        }).tooltip('show')
    })

</script>


@yield('third_party_scripts')

@stack('page_scripts')
@stack('scripts')
</body>
</html>
