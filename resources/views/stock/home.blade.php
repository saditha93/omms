@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">
                <div class="card-header">{{ __('Stock Dashboard') }}</div>
                <div class="row mt-2">

                    @if(Auth::user()->user_type ==2 || auth()->user()->can('stock-list'))
                        <div onclick="location.href='{{ route('stock.index') }}';" class="col-12 col-sm-6 col-md-4 p-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-purple elevation-1">
                                <i class="fas fa-solid fa-cash-register"></i>
                                {{-- <i class="fas fa-user text-dark"></i> --}}
                            </span>

                                <div class="info-box-content" style="background-color: rgba(134,7,253,0.47)">
                                <span class="info-box-text">
                                    <a href="{{ route('stock.index') }}" class="text-dark">Current Stocks</a>
                                </span>
                                    <span class="info-box-number">{{$stockCount}}
                                </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->user_type ==2 || auth()->user()->can('item-list'))
                        <div onclick="location.href='{{ route('stockItem.index') }}';"
                             class="col-12 col-sm-6 col-md-4 p-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1">
                                <i class="fas fa-cubes"></i>
                            </span>
                                <div class="info-box-content" style="background-color: rgba(253,233,7,0.47)">
                                <span class="info-box-text">
                                    <a href="{{ route('stockItem.index') }}" class="small-box-footer text-dark">Items Details</a>
                                </span>
                                    <span class="info-box-number">
                                  {{$itemsCount}}
                                </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->user_type ==2 || auth()->user()->can('category-list'))
                        <div onclick="location.href='{{ route('stockCategory.index') }}';"
                             class="col-12 col-sm-6 col-md-4 p-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-olive elevation-1"><i class="fas fa-list-alt"></i></span>

                                <div class="info-box-content" style="background-color: rgba(40,253,7,0.47)">
                                    <span class="info-box-text"><a href="{{ route('stockCategory.index') }}"
                                                                   class="text-dark">Category</a></span>
                                    <span class="info-box-number">{{$categoryCount}}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->user_type ==2 || auth()->user()->can('grn-list'))
                        <div onclick="location.href='{{ route('gRNHeader.index') }}';"
                             class="col-12 col-sm-6 col-md-4 p-3">
                            <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1">
                                <i class="fas fa-receipt"></i>
                            </span>
                                <div class="info-box-content" style="background-color: rgba(7,175,253,0.47)">
                                <span class="info-box-text">
                                    <a href="{{ route('gRNHeader.index') }}" class="text-dark">Good Receive Note</a>
                                </span>
                                    <span class="info-box-number">{{$grnCount}}
                                </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->user_type ==2 || auth()->user()->can('issue-list'))
                        <div onclick="location.href='{{ route('issueHeader.index') }}';"
                             class="col-12 col-sm-6 col-md-4 p-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"> <i class="fas fa-clipboard-list"></i>  </span>
                                <div class="info-box-content" style="background-color: rgba(238,11,19,0.38)">
                                <span class="info-box-text">
                                    <a href="{{ route('issueHeader.index') }}" class="text-dark">Good Issues Note</a>
                                </span>
                                    <span class="info-box-number">{{$issueCount}}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->user_type ==2 || auth()->user()->can('measureUnit-list'))
                        <div onclick="location.href='{{ route('measureUnit.index') }}';"
                             class=" col-sm-6 col-md-4 p-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fas fa-balance-scale"></i></span>

                                <div class="info-box-content" style="background-color: rgba(163,253,7,0.47)">
                                <span class="info-box-text"><a href="{{ route('measureUnit.index') }}"
                                                               class="text-dark">Measure Unit </a></span>
                                    <span class="info-box-number">{{$muCount}} </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(Auth::user()->user_type ==2 || auth()->user()->can('supplier-list'))
                        <div onclick="location.href='{{ route('supplier.index') }}';"
                             class="col-12 col-sm-6 col-md-4 p-3">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-lime elevation-1"><i class="fas fa-truck"></i></span>
                                <div class="info-box-content" style="background-color: rgba(7,253,48,0.47)">
                                    <span class="info-box-text"><a href="{{ route('supplier.index') }}"
                                                                   class="text-dark">Supplier </a></span>
                                    <span class="info-box-number"> {{$supCount}}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

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
                                <ul>
                                    @if(count($category->items))
                                        @foreach($category->items as $item)
                                            <li>
                                                {{ $item->name }} - Qty({{$item->stock->qty}})
                                            </li>
                                        @endforeach
                                    @endif
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
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Available Stock Bar Chart</h3>
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
                                <h3 class="card-title">Available Stock Pie Chart</h3>
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

                </div>
            </div>
        </div>

    </div>
@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('plugin/MCDatepicker/mc-calendar.min.css') }}"/>

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
    </style>

@stop

@section('third_party_scripts')
    <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
    <script src="{{ asset('plugin/MCDatepicker/mc-calendar.min.js') }}"></script>
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
    <script src="{{ asset('plugin/chart/charts.js') }}"></script>
    <script src="{{ asset('plugin/chart/chartjs-plugin-datalabels@2.js') }}"></script>

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
                            anchor: 'end',
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

            new Chart("myChart", {
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
