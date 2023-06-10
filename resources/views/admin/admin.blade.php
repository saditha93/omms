@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{--{{Auth::user()->getAllPermissions()}}--}}

            <div class="row">
                {{--super user--}}
                @if(Auth::user()->user_type ==1)
                    <div class="col-md-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 class="estb-count"></h3>
                                <p>Establishments</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('more-info-establishment') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 class="mess-count"></h3>
                                <p>Officer Messes</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{route('more-info-messes')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box bg-teal">
                            <div class="inner">
                                <h3 class="mess-manager-count"></h3>
                                <p>User Accounts</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-user"></i>
                            </div>
                            <a href="{{route('more-info-mess-managers')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif

                @if(Auth::user()->user_type ==4 || Auth::user()->user_type ==5)
                    <div class="col-md-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 class="pending-event-count"></h3>
                                <p>Pending Event</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('event-order') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 class="approved-event-count"></h3>
                                <p>Approved Event</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('event-order') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 class="declined-event-count"></h3>
                                <p>Declined Event</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('event-order') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                @endif
                {{--mess manager--}}
                @if(Auth::user()->user_type ==2 || auth()->user()->can('view-mess-item-categories'))

                    {{--<div class="col-md-3 offset-md-5">--}}
                    {{--<div class="form-group">--}}
                    {{--<input type="text" autocomplete="off" placeholder="From Date" class="form-control datepicker" id="fromDate" name="fromDate">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-3">--}}
                    {{--<div class="form-group">--}}
                    {{--<input type="text" autocomplete="off" placeholder="To Date" class="form-control datepicker" id="toDate" name="toDate">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-1">--}}
                    {{--<button class="btn btn-primary float-right w-100" type="button" id="dateFilter">--}}
                    {{--Search--}}
                    {{--</button>--}}
                    {{--</div>--}}

                    <div class="col-md-3">
                        <div class="small-box bg-gradient-yellow">
                            <div class="inner">
                                <h3 class="next-breakfast"></h3>
                                <p>Breakfast </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa fa-cubes"></i>
                            </div>
                            <a href="{{route('order-details')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-gradient-navy">
                            <div class="inner">
                                <h3 class="next-lunch"></h3>
                                <p>Lunch </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa fa-cubes"></i>
                            </div>
                            <a href="{{route('order-details')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-gray-dark">
                            <div class="inner">
                                <h3 class="next-dinner"></h3>
                                <p>Dinner </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa fa-cubes"></i>
                            </div>
                            <a href="{{route('order-details')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 class="officer-count"></h3>
                                <p>Officers </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa fa-cubes"></i>
                            </div>
                            <a href="{{route('mess-info-officers')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Daily Messing Count</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <canvas id="myChart"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Daily Extra Messing List</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                        <tr>
                                            <th>Officer Name</th>
                                            <th>Extra Order Item</th>
                                            <th>Order Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if(isset($extraMessingDetails))
                                            @foreach($extraMessingDetails as $extraMessingDetail)
                                                <tr>
                                                    <td>{{$extraMessingDetail->name_according_to_part2}}</td>
                                                    <td>{{$extraMessingDetail->item_name}}</td>
                                                    <td>{{$extraMessingDetail->ordered_date}}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="card-footer clearfix">
                                {{--<a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>--}}
                                {{--<a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All--}}
                                {{--Orders</a>--}}
                            </div>

                        </div>
                    </div>

                @elseif(auth()->user()->can('bar-stock'))

                    <div onclick="location.href='{{ route('bar.stock') }}';" class="col-12 col-sm-6 col-md-4 p-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-purple elevation-1">
                                <i class="fas fa-solid fa-cash-register"></i>
                                {{-- <i class="fas fa-user text-dark"></i> --}}
                            </span>

                            <div class="info-box-content" style="background-color: rgba(134,7,253,0.47)">
                                <span class="info-box-text">
                                    <a href="{{ route('bar.stock') }}" class="text-dark">Current Bar Item Stocks</a>
                                </span>
                                <span class="info-box-number">{{$stockCount}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div onclick="location.href='{{ route('bar.allBarItem') }}';"
                         class="col-12 col-sm-6 col-md-4 p-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1">
                                <i class="fas fa-cubes"></i>
                            </span>
                            <div class="info-box-content" style="background-color: rgba(253,233,7,0.47)">
                                <span class="info-box-text">
                                    <a href="{{ route('bar.allBarItem') }}" class="small-box-footer text-dark">Bar Items Details</a>
                                </span>
                                <span class="info-box-number">
                                  {{$itemsCount}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div onclick="location.href='{{ route('bar.index') }}';"
                         class="col-12 col-sm-6 col-md-4 p-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-green elevation-1">
                                <i class="fas fa-cubes"></i>
                            </span>
                            <div class="info-box-content" style="background-color: rgba(89,253,7,0.47)">
                                <span class="info-box-text">
                                    <a href="{{ route('bar.index') }}" class="small-box-footer text-dark">Bar Orders</a>
                                </span>
                                <span class="info-box-number">
                                  {{$barCount}}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div onclick="location.href='{{ route('gRNHeader.bar.index') }}';"
                         class="col-12 col-sm-6 col-md-4 p-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-receipt"></i>
                            </span>
                            <div class="info-box-content" style="background-color: rgba(7,175,253,0.47)">
                                <span class="info-box-text">
                                    <a href="{{ route('gRNHeader.bar.index') }}"
                                       class="text-dark">Bar Item Receive Note</a>
                                </span>
                                <span class="info-box-number">{{$grnCount}}
                                </span>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Items Stock in Category</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <ul id="tree1" class="tree ">
                                @foreach($categories as $category)
                                    <li style="font-weight: bolder;color: black;">
                                        {{ $category->name }}
                                        @if(count($category->items))
                                            <ul>
                                                @foreach($category->items as $item)
                                                    <li>
                                                        {{ $item->name }} - Qty({{$item->stock->qty}})
                                                    </li>
                                                @endforeach
                                                @if(count($category->childs))
                                                    @foreach($category->childs as $child)
                                                        <li style="font-weight: bolder;color: black;">
                                                            {{ $child->name }}
                                                            <ul>
                                                                @if(count($child->items))
                                                                    @foreach($child->items as $item)
                                                                        <li>
                                                                            {{ $item->name }} -
                                                                            Qty({{$item->stock->qty}})
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">Available Bar Stock Bar Chart</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <canvas id="stockChart"></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header border-transparent">
                                    <h3 class="card-title">Available Bar Stock Pie Chart</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <canvas id="stockPieChart"></canvas>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @elseif(auth()->user()->can('stock-view'))
                    <script>window.location = "{{ route('stock.home') }}";</script>

                @elseif(auth()->user()->can('billing'))

                    <div class="col-md-3">
                        <div class="small-box bg-gradient-yellow">
                            <div class="inner">
                                <h3 class="next-breakfast"></h3>
                                <p>Breakfast </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa fa-cubes"></i>
                            </div>
                            {{--<a href="{{route('order-details')}}" class="small-box-footer">More info <i--}}
                            {{--class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-gradient-navy">
                            <div class="inner">
                                <h3 class="next-lunch"></h3>
                                <p>Lunch </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa fa-cubes"></i>
                            </div>
                            {{--<a href="{{route('order-details')}}" class="small-box-footer">More info <i--}}
                            {{--class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-gray-dark">
                            <div class="inner">
                                <h3 class="next-dinner"></h3>
                                <p>Dinner </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa fa-cubes"></i>
                            </div>
                            {{--<a href="{{route('order-details')}}" class="small-box-footer">More info <i--}}
                            {{--class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3 class="officer-count"></h3>
                                <p>Officers </p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa fa-cubes"></i>
                            </div>
                            {{--<a href="{{route('mess-info-officers')}}" class="small-box-footer">More info <i--}}
                            {{--class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Daily Messing Count</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <canvas id="myChart"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>

    <style>

        .tree {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .tree ul {
            margin: 0;
            padding: 0;
            list-style: none;
            margin-left: 1em;
            position: relative;
        }

        .tree ul ul {
            margin-left: 0.5em;
        }

        .tree ul:before {
            content: "";
            display: block;
            width: 0;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            border-left: 1px solid;
        }

        .tree ul li:before {
            content: "";
            display: block;
            width: 10px;
            height: 0;
            border-top: 1px solid;
            margin-top: -1px;
            position: absolute;
            top: 1em;
            left: 0;
        }

        .tree ul li:last-child:before {
            background: #fff;
            height: auto;
            top: 1em;
            bottom: 0;
        }

        .tree li {
            margin: 0;
            padding: 0 1em;
            line-height: 2em;
            color: #369;
            font-weight: 700;
            position: relative;
        }

        .tree li .expand {
            display: block;
        }

        .tree li .collapse {
            display: none;
        }

        .tree li a {
            text-decoration: none;
            color: #369;
        }

        .tree li button {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }

        .tree li button:active {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }

        .tree li button:focus {
            text-decoration: none;
            color: #369;
            border: none;
            background: transparent;
            margin: 0px 0px 0px 0px;
            padding: 0px 0px 0px 0px;
            outline: 0;
        }

        .indicator {
            margin-right: 5px;
        }


        /*hide datatable export icons*/


    </style>

@stop


@push('scripts')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('/js/datepicker/datepicker.js')}}"></script>
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
    <script>


        var tree = document.getElementById("tree1");
        if (tree) {
            tree.querySelectorAll("ul").forEach(function (el, key, parent) {
                var elm = el.parentNode;
                elm.classList.add("branch");
                var x = document.createElement("i");
                x.classList.add("indicator");
                x.classList.add("bi-folder-plus");
                elm.insertBefore(x, elm.firstChild);
                el.classList.add("collapse");

                elm.addEventListener("click", function (event) {
                    if (elm === event.target || elm === event.target.parentNode) {

                        if (el.classList.contains('collapse')) {
                            el.classList.add("expand");
                            el.classList.remove("collapse");
                            x.classList.remove("bi-folder-plus");
                            x.classList.add("bi-folder-minus");
                        } else {
                            el.classList.add("collapse");
                            el.classList.remove("expand");
                            x.classList.remove("bi-folder-minus");
                            x.classList.add("bi-folder-plus");
                        }
                    }
                }, false);
            });
        }


        //date picker
        $('.datepicker').datepicker({
            format: 'YYYY-MM-DD',
            autoclose: true,
            // endDate: '0d'
        })
            .datepicker("setDate", new Date()).on('keypress keydown paste change', function (e) {
            $('.datepicker').datepicker('hide');
        });


        const ctx = document.getElementById('myChart');
        //Chart mess manager
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            url: '{{route("ration-data-count")}}',
            type: 'get',
            success: function (response) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Breakfast', 'Lunch', 'Dinner', 'Event', 'Other'],
                        datasets: [{
                            label: 'Meal Tendency Chart',
                            data: [
                                response.order_breakfast,
                                response.order_lunch,
                                response.order_dinner,
                                response.order_event,
                                response.order_other
                            ],
                            borderWidth: 1,
                            backgroundColor: ['#f54f3c', '#257df5', '#5af55c', '#923bf5', '#f5df36']
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });


        //event order count
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            url: '{{route("event-count")}}',
            type: 'get',
            success: function (response) {

                $('.pending-event-count').empty().append(response.pendingEventOrders);
                $('.approved-event-count').empty().append(response.ApprovedEventOrders);
                $('.declined-event-count').empty().append(response.declinedEventOrders);
            },
            error: function (error) {
            }
        });


        //widget count super admin
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            url: '{{route("establishment-count")}}',
            type: 'get',
            success: function (response) {
                $('.estb-count').empty().append(response.establishments);
                $('.mess-count').empty().append(response.messes);
                $('.mess-manager-count').empty().append(response.messManagers);
            },
            error: function (error) {
            }
        });


        //next meal count
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            url: '{{route("meal-count")}}',
            type: 'get',
            success: function (response) {

                console.log(response)
                $('.next-breakfast').empty().append(response.order_breakfast);
                $('.next-lunch').empty().append(response.order_lunch);
                $('.next-dinner').empty().append(response.order_dinner);
                $('.officer-count').empty().append(response.officer_count);
            },
            error: function (error) {
            }
        });


    </script>
@endpush


@section('third_party_scripts')
    <script src="{{ asset('plugin/chart/charts.js') }}"></script>
    <script src="{{ asset('plugin/chart/chartjs-plugin-datalabels@2.js') }}"></script>

    <script>
        $(function () {

            @php $items = ''; $stocks= ''; @endphp

            @foreach ($itemArray as $item)
            @php  $items .= '"' . $item->name . '",';  $stocks .= '"' . $item->stock->qty . '",'; @endphp
            @endforeach

            var barColors = [
                "#b91d47",
                "#00aba9",
                "#2b5797",
                "#e8c3b9",
                "#1e7145",
                "#042d86",
                "#d78d2c",
                "#9b088f",
                "#d53c3c",
                "#98e857",
                "#55e7e7",
                "#e89797",
                "#6179cc",
                "#3df140",
                "#e86d09",
                "#0d17d7",
                "rgba(7,175,253,0.47)",
                "#daef51",
                "#424b3e",
                "#85858d",
                "#9d045f",
            ];

            var stockChartData = {

                labels: [{!! $items !!}],
                datasets: [
                    {
                        label: 'Stocks',
                        backgroundColor: barColors,
                        data: [{!! $stocks !!}],
                        datalabels: {
                            formatter: function (value, context) {
                                return 'Total Stock ' + context.chart.data.labels[context.dataIndex] + ' : \n' + value.toLocaleString();
                            },
                            labels: {
                                title: {
                                    color: '#000',
                                    font: {
                                        weight: 'bold'
                                    },
                                },
                            },
                        }
                    },
                ]
            }
            const config = {
                type: 'bar',
                data: stockChartData,
                plugins: [ChartDataLabels],
                options: {
                    layout: {
                        padding: {
                            top: 200
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                color: '#000000', beginAtZero: true, font: {
                                    weight: 'bold'
                                },
                            }
                        },
                        x: {
                            ticks: {
                                color: '#000000', beginAtZero: true, font: {
                                    weight: 'bold'
                                },
                            }
                        }
                    },
                    plugins: {
                        datalabels: {
                            anchor: 'start',
                            align: 'end',
                            rotation: -90,
                            labels: {
                                title: {
                                    color: '#2ce356'
                                }
                            },
                            formatter: function (value, context) {
                                return context.chart.data.labels[context.data];
                            }
                        },
                        legend: {
                            display: false,
                            labels: {
                                color: 'rgb(255, 99, 132)'
                            }
                        }
                    }
                }
            };

            const stockChart = new Chart(
                document.getElementById('stockChart'),
                config
            );


            var xValues = [{!! $items !!}];
            var yValues = [{!! $stocks !!}];

            new Chart("stockPieChart", {
                type: "pie",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: "Available Stock"
                    }
                }
            });


        })
    </script>
@stop
