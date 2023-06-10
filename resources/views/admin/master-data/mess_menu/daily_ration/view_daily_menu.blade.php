@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Daily Menu
                <form method="POST" action="{{route('daily-menu-filter')}}">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-3 offset-md-8">
                            <div class="form-group">
                                <label for="date">To Date</label>
                                <input type="text" autocomplete="off" placeholder="Date" class="form-control datepicker"
                                       id="date" name="date" value="{{isset($filteredDate)?$filteredDate:''}}">
                            </div>
                        </div>
                        <div class="col-md-1 mt-4">
                            <button class="btn btn-primary float-right mt-2" type="submit" id="dateFilter">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="card-body">

        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="messing-tab" data-toggle="pill" href="#messing" role="tab"
                   aria-controls="messing" aria-selected="true">Messing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="dessert-tab" data-toggle="pill" href="#dessert" role="tab"
                   aria-controls="dessert" aria-selected="false">Dessert</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="extra-messing-tab" data-toggle="pill" href="#extra-messing" role="tab"
                   aria-controls="extra-messing" aria-selected="false">Extra Messing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="tea-tab" data-toggle="pill" href="#tea" role="tab" aria-controls="tea"
                   aria-selected="false">Tea</a>
            </li>
        </ul>
        <div class="tab-custom-content">
        </div>
        <div class="tab-content sidebar-light-gray-dark p-5" id="custom-content-above-tabContent">
            <div class="tab-pane fade active show" id="messing" role="tabpanel" aria-labelledby="messing-tab">
                @isset($rations)
                    <div class="row">
                        @foreach($rations as $ration)
                            @if($ration->meal_time ==='breakfast')
                            <div class="col-md-3 d-flex">
                                    <div class="card rounded border-danger card-body bg-gradient-dark flex-fill">
                                        <div class="card-body p-0">
                                            <div class="row text-center">
                                                <h4 class="card-title text-bold">{{$ration->menu_name}}</h4>
                                            </div>
                                            <div class="row text-center">
                                                <p class="card-title text-bold">{{date('l', strtotime($ration->ration_date))}}
                                                    -{{$ration->meal_time}}</p>
                                            </div>
                                            <div class="row text-center">
                                                <p class="card-text">{{$ration->ration_date}}</p>
                                            </div>
                                            <div class="row text-center">
                                                <p class="card-text text-bold">{{$ration->meal_type==1?'Non-Vegetarian':'Vegetarian'}}</p>
                                            </div>
                                            <div class="row">
                                                <p class="card-text mb-4 text-center">Tentative Price :
                                                    Rs:{{number_format($ration->tentative_price,2)}}</p>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5>Menu Items </h5>
                                            <ul class="list-group list-group-flush">
                                                @foreach($ration->items as $item)
                                                    <li>{{$item}}</li>
                                                @endforeach
                                            </ul>
                                            <p class="card-text mt-4"><b>Dessert</b>
                                                : {{isset($ration->dessert)?$ration->dessert:''}}</p>
                                        </div>
                                    </div>
                            </div>
                            @endif
                        @endforeach
                            @foreach($rations as $ration)
                                @if($ration->meal_time ==='lunch')
                                    <div class="col-md-3 d-flex">
                                        <div class="card rounded border-danger card-body bg-gradient-dark flex-fill">
                                            <div class="card-body p-0">
                                                <div class="row text-center">
                                                    <h4 class="card-title text-bold">{{$ration->menu_name}}</h4>
                                                </div>
                                                <div class="row text-center">
                                                    <p class="card-title text-bold">{{date('l', strtotime($ration->ration_date))}}
                                                        -{{$ration->meal_time}}</p>
                                                </div>
                                                <div class="row text-center">
                                                    <p class="card-text">{{$ration->ration_date}}</p>
                                                </div>
                                                <div class="row text-center">
                                                    <p class="card-text text-bold">{{$ration->meal_type==1?'Non-Vegetarian':'Vegetarian'}}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="card-text mb-4 text-center">Tentative Price :
                                                        Rs:{{number_format($ration->tentative_price,2)}}</p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5>Menu Items </h5>
                                                <ul class="list-group list-group-flush">
                                                    @foreach($ration->items as $item)
                                                        <li>{{$item}}</li>
                                                    @endforeach
                                                </ul>
                                                <p class="card-text mt-4"><b>Dessert</b>
                                                    : {{isset($ration->dessert)?$ration->dessert:''}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @foreach($rations as $ration)
                                @if($ration->meal_time ==='dinner')
                                    <div class="col-md-3 d-flex">
                                        <div class="card rounded border-danger card-body bg-gradient-dark flex-fill">
                                            <div class="card-body p-0">
                                                <div class="row text-center">
                                                    <h4 class="card-title text-bold">{{$ration->menu_name}}</h4>
                                                </div>
                                                <div class="row text-center">
                                                    <p class="card-title text-bold">{{date('l', strtotime($ration->ration_date))}}
                                                        -{{$ration->meal_time}}</p>
                                                </div>
                                                <div class="row text-center">
                                                    <p class="card-text">{{$ration->ration_date}}</p>
                                                </div>
                                                <div class="row text-center">
                                                    <p class="card-text text-bold">{{$ration->meal_type==1?'Non-Vegetarian':'Vegetarian'}}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="card-text mb-4 text-center">Tentative Price :
                                                        Rs:{{number_format($ration->tentative_price,2)}}</p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5>Menu Items </h5>
                                                <ul class="list-group list-group-flush">
                                                    @foreach($ration->items as $item)
                                                        <li>{{$item}}</li>
                                                    @endforeach
                                                </ul>
                                                <p class="card-text mt-4"><b>Dessert</b>
                                                    : {{isset($ration->dessert)?$ration->dessert:''}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @foreach($rations as $ration)
                                @if($ration->meal_time ==='other')
                                    <div class="col-md-3 d-flex">
                                        <div class="card rounded border-danger card-body bg-gradient-dark flex-fill">
                                            <div class="card-body p-0">
                                                <div class="row text-center">
                                                    <h4 class="card-title text-bold">{{$ration->menu_name}}</h4>
                                                </div>
                                                <div class="row text-center">
                                                    <p class="card-title text-bold">{{date('l', strtotime($ration->ration_date))}}
                                                        -{{$ration->meal_time}}</p>
                                                </div>
                                                <div class="row text-center">
                                                    <p class="card-text">{{$ration->ration_date}}</p>
                                                </div>
                                                <div class="row text-center">
                                                    <p class="card-text text-bold">{{$ration->meal_type==1?'Non-Vegetarian':'Vegetarian'}}</p>
                                                </div>
                                                <div class="row">
                                                    <p class="card-text mb-4 text-center">Tentative Price :
                                                        Rs:{{number_format($ration->tentative_price,2)}}</p>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h5>Menu Items </h5>
                                                <ul class="list-group list-group-flush">
                                                    @foreach($ration->items as $item)
                                                        <li>{{$item}}</li>
                                                    @endforeach
                                                </ul>
                                                <p class="card-text mt-4"><b>Dessert</b>
                                                    : {{isset($ration->dessert)?$ration->dessert:''}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                    </div>
                @endisset

            </div>
            <div class="tab-pane fade" id="dessert" role="tabpanel" aria-labelledby="dessert-tab">
                @isset($desserts)
                    <div class="row">
                        @foreach($desserts as $dessert)
                            <div class="col-md-2 d-flex">
                                <div class="card text-white bg-gradient-dark mb-3 flex-fill">
                                    <div class="card-header text-bold text-center">{{$dessert->item_name}}</div>
                                    <div class="card-body">
                                        <p class="card-text text-center">Qty - {{$dessert->scale}}</p>
                                        <p class="card-text mb-0 text-center">Tentative Price</p>
                                        <p class="card-text text-center">Rs :{{number_format($dessert->price,2)}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
            <div class="tab-pane fade" id="extra-messing" role="tabpanel" aria-labelledby="extra-messing-tab">
                @isset($extraMessings)
                    <div class="row">
                        @foreach($extraMessings as $extraMessing)
                            <div class="col-md-2 d-flex">
                                <div class="card text-white bg-gradient-dark mb-3 flex-fill">
                                    <div class="card-header text-bold text-center">{{$extraMessing->item_name}}</div>
                                    <div class="card-body">
                                        <p class="card-text text-center">Qty - {{$extraMessing->scale}}</p>
                                        <p class="card-text mb-0 text-center">Tentative Price</p>
                                        <p class="card-text text-center">Rs
                                            : {{number_format($extraMessing->price,2)}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
            <div class="tab-pane fade" id="tea" role="tabpanel" aria-labelledby="tea-tab">
                @isset($teaitems)
                    <div class="row">
                        @foreach($teaitems as $teaitem)
                            <div class="col-md-2 d-flex">
                                <div class="card text-white bg-gradient-dark mb-3 flex-fill">
                                    <div class="card-header text-bold text-center">{{$teaitem->item_name}}</div>
                                    <div class="card-body">
                                        <p class="card-text text-center">Qty - {{$teaitem->scale}}</p>
                                        <p class="card-text mb-0 text-center">Tentative Price</p>
                                        <p class="card-text text-center">Rs : {{number_format($teaitem->price,2)}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('/js/datepicker/datepicker.js')}}"></script>
    <script>


        $(document).ready(function () {

            //date picker
            $('.datepicker').datepicker({
                format: 'YYYY-MM-DD',
                autoclose: true,
                // endDate: '0d'
            })

            if (!$('.datepicker').val()) {
                $('.datepicker')
                    .datepicker("setDate", new Date()).on('keypress keydown paste change', function (e) {
                    $('.datepicker').datepicker('hide');
                });
            }

        });

    </script>
@endpush

@push('page_css')
@endpush

