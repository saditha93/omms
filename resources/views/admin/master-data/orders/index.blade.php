@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Place an Order
                <div class="row mt-2">
                    <div class="col-md-3 offset-md-8">
                        <div class="form-group">
                            <input type="text" autocomplete="off" placeholder="From Date"
                                   class="form-control datepicker" id="fromDate" name="fromDate">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary float-right" type="button" id="dateFilter">
                            Search
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">

                @if(!isset($item->id))
                    <form method="POST" action="" id="orderForm">
                        @else
                            <form method="POST" action="">
                                @method('PUT')
                                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="officer" class="form-label">Officers</label>
                                            <select id="officer"
                                                    class="select2-single form-control" name="officer"
                                                    autocomplete="off">
                                                <option value="" selected="selected">Select the name</option>
                                                @foreach($officers as $officer)
                                                    <option value="{{$officer->id}}">{{ $officer->name_according_to_part2 .' - '. $officer->service_no}}</option>
                                                @endforeach
                                            </select>
                                            @error('item')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="full_name" class="form-label">Full Name</label>
                                            <input readonly type="text" class="form-control form-control-sm"
                                                   name="full_name"
                                                   id="full_name"
                                                   value="{{isset($dataCollections)?$dataCollections->person[0]->full_name:''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="e_number" class="form-label">E-Number</label>
                                            <input readonly type="text" class="form-control form-control-sm"
                                                   name="e_number"
                                                   id="e_number"
                                                   value="{{isset($dataCollections)?$dataCollections->person[0]->eno:''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="service_number" class="form-label">Service Number</label>
                                            <input readonly type="text" class="form-control form-control-sm"
                                                   name="service_number" id="service_number"
                                                   value="{{isset($dataCollections)?$dataCollections->person[0]->service_no:''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="rank" class="form-label">Rank</label>
                                            <input readonly type="text" class="form-control form-control-sm" name="rank"
                                                   id="rank"
                                                   value="{{isset($dataCollections)?$dataCollections->person[0]->rank:''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name_with_init" class="form-label">Name With Initials</label>
                                            <input readonly type="text" class="form-control form-control-sm"
                                                   name="name_with_init" id="name_with_init"
                                                   value="{{isset($dataCollections)?$dataCollections->person[0]->name_according_to_part2:''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="regiment" class="form-label">Regiment</label>
                                            <input readonly type="text" class="form-control form-control-sm"
                                                   name="regiment"
                                                   id="regiment"
                                                   value="{{isset($dataCollections)?$dataCollections->person[0]->regiment:''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="unit" class="form-label">Unit</label>
                                            <input readonly type="text" class="form-control form-control-sm" name="unit"
                                                   id="unit"
                                                   value="{{isset($dataCollections)?$dataCollections->person[0]->unit:''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nic" class="form-label">NIC</label>
                                            <input readonly type="text" class="form-control form-control-sm" name="nic"
                                                   id="nic"
                                                   value="{{isset($dataCollections)?$dataCollections->person[0]->nic:''}}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-indigo text-bold">

                <div class="row">
                    <div class="col-md-3">
                        Daily Ration
                    </div>
                    {{--<div class="col-md-3 offset-md-5">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="text" autocomplete="off" placeholder="From Date"--}}
                                   {{--class="form-control datepicker" id="fromDate" name="fromDate">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-1">--}}
                        {{--<button class="btn btn-primary float-right" type="button" id="dateFilter">--}}
                            {{--Search--}}
                        {{--</button>--}}
                    {{--</div>--}}

                </div>
            </div>
        </div>

        <div class="card-body">

            @isset($rations)
                <div class="container-fluid">
                    <div class="row ration-div">
                        @foreach($rations as $ration)
                            @if($ration->meal_time ==='breakfast')
                                <div class="col-md-3 d-flex">
                                    <div class="card card-body flex-fill">
                                        <div class="card-body">
                                            <div class="row">
                                                <h4 class="card-title text-bold">{{$ration->menu_name}}</h4>
                                            </div>
                                            <div class="row">
                                                <p class="card-title text-purple">{{date('l', strtotime($ration->ration_date))}}
                                                    -{{$ration->meal_time}}</p>
                                            </div>
                                            <div class="row">
                                                <p class="card-text text-primary">{{$ration->ration_date}}</p>
                                            </div>
                                            <div class="row">
                                                <p class="card-text {{$ration->meal_type==1?'text-danger':'text-success'}}">{{$ration->meal_type==1?'Non-Vegetarian':'Vegetarian'}}</p>
                                            </div>
                                            <div class="row">
                                                <h6 class="card-text mb-4 text-danger">Tentative Price :
                                                    Rs:{{$ration->tentative_price}}</h6>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5>Menu Items </h5>
                                            <ul class="list-group list-group-flush">
                                                @foreach($ration->items as $item)
                                                    <li>{{$item}}</li>
                                                @endforeach
                                            </ul>
                                            <p class="card-text">Dessert
                                                : {{isset($ration->dessert)?$ration->dessert:''}}</p>
                                        </div>
                                        <label for="ration_qty">Qty</label>
                                        <input type="number" class="form-control mb-4 ration-qtys" autocomplete="off"
                                               name="ration_qty" value="1"
                                               min="1" id="{{$ration->id.'_ration_qty'}}">
                                        <button class="order-btn disabled btn btn-primary btn-order mt-2 ration-order"
                                                value="{{$ration->id}}">Order
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @foreach($rations as $ration)
                            @if($ration->meal_time ==='lunch')
                                <div class="col-md-3 d-flex">
                                    <div class="card card-body flex-fill">
                                        <div class="card-body">
                                            <div class="row">
                                                <h4 class="card-title text-bold">{{$ration->menu_name}}</h4>
                                            </div>
                                            <div class="row">
                                                <p class="card-title text-purple">{{date('l', strtotime($ration->ration_date))}}
                                                    -{{$ration->meal_time}}</p>
                                            </div>
                                            <div class="row">
                                                <p class="card-text text-primary">{{$ration->ration_date}}</p>
                                            </div>
                                            <div class="row">
                                                <p class="card-text {{$ration->meal_type==1?'text-danger':'text-success'}}">{{$ration->meal_type==1?'Non-Vegetarian':'Vegetarian'}}</p>
                                            </div>
                                            <div class="row">
                                                <h6 class="card-text mb-4 text-danger">Tentative Price :
                                                    Rs:{{$ration->tentative_price}}</h6>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5>Menu Items </h5>
                                            <ul class="list-group list-group-flush">
                                                @foreach($ration->items as $item)
                                                    <li>{{$item}}</li>
                                                @endforeach
                                            </ul>
                                            <p class="card-text">Dessert
                                                : {{isset($ration->dessert)?$ration->dessert:''}}</p>
                                        </div>
                                        <label for="ration_qty">Qty</label>
                                        <input type="number" class="form-control mb-4 ration-qtys" autocomplete="off"
                                               name="ration_qty" value="1"
                                               min="1" id="{{$ration->id.'_ration_qty'}}">
                                        <button class="order-btn disabled btn btn-primary btn-order mt-2 ration-order"
                                                value="{{$ration->id}}">Order
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @foreach($rations as $ration)
                            @if($ration->meal_time ==='dinner')
                                <div class="col-md-3 d-flex">
                                    <div class="card card-body flex-fill">
                                        <div class="card-body">
                                            <div class="row">
                                                <h4 class="card-title text-bold">{{$ration->menu_name}}</h4>
                                            </div>
                                            <div class="row">
                                                <p class="card-title text-purple">{{date('l', strtotime($ration->ration_date))}}
                                                    -{{$ration->meal_time}}</p>
                                            </div>
                                            <div class="row">
                                                <p class="card-text text-primary">{{$ration->ration_date}}</p>
                                            </div>
                                            <div class="row">
                                                <p class="card-text {{$ration->meal_type==1?'text-danger':'text-success'}}">{{$ration->meal_type==1?'Non-Vegetarian':'Vegetarian'}}</p>
                                            </div>
                                            <div class="row">
                                                <h6 class="card-text mb-4 text-danger">Tentative Price :
                                                    Rs:{{$ration->tentative_price}}</h6>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5>Menu Items </h5>
                                            <ul class="list-group list-group-flush">
                                                @foreach($ration->items as $item)
                                                    <li>{{$item}}</li>
                                                @endforeach
                                            </ul>
                                            <p class="card-text">Dessert
                                                : {{isset($ration->dessert)?$ration->dessert:''}}</p>
                                        </div>
                                        <label for="ration_qty">Qty</label>
                                        <input type="number" class="form-control mb-4 ration-qtys" autocomplete="off"
                                               name="ration_qty" value="1"
                                               min="1" id="{{$ration->id.'_ration_qty'}}">
                                        <button class="order-btn disabled btn btn-primary btn-order mt-2 ration-order"
                                                value="{{$ration->id}}">Order
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @foreach($rations as $ration)
                            @if($ration->meal_time ==='other')
                                <div class="col-md-3 d-flex">
                                    <div class="card card-body flex-fill">
                                        <div class="card-body">
                                            <div class="row">
                                                <h4 class="card-title text-bold">{{$ration->menu_name}}</h4>
                                            </div>
                                            <div class="row">
                                                <p class="card-title text-purple">{{date('l', strtotime($ration->ration_date))}}
                                                    -{{$ration->meal_time}}</p>
                                            </div>
                                            <div class="row">
                                                <p class="card-text text-primary">{{$ration->ration_date}}</p>
                                            </div>
                                            <div class="row">
                                                <p class="card-text {{$ration->meal_type==1?'text-danger':'text-success'}}">{{$ration->meal_type==1?'Non-Vegetarian':'Vegetarian'}}</p>
                                            </div>
                                            <div class="row">
                                                <h6 class="card-text mb-4 text-danger">Tentative Price :
                                                    Rs:{{$ration->tentative_price}}</h6>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5>Menu Items </h5>
                                            <ul class="list-group list-group-flush">
                                                @foreach($ration->items as $item)
                                                    <li>{{$item}}</li>
                                                @endforeach
                                            </ul>
                                            <p class="card-text">Dessert
                                                : {{isset($ration->dessert)?$ration->dessert:''}}</p>
                                        </div>
                                        <label for="ration_qty">Qty</label>
                                        <input type="number" class="form-control mb-4 ration-qtys" autocomplete="off"
                                               name="ration_qty" value="1"
                                               min="1" id="{{$ration->id.'_ration_qty'}}">
                                        <button class="order-btn disabled btn btn-primary btn-order mt-2 ration-order"
                                                value="{{$ration->id}}">Order
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            @endisset

        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-indigo text-bold">Tea Item</div>
            <div class="card-body">

                @isset($teaitems)
                    <div class="row">
                        <div class="col-md-12">
                            <select aria-hidden="true" id="tea_items"
                                    class="multiple-select form-control" name="tea_items">

                                @foreach($teaitems as $teaitem)
                                    <option value="{{ $teaitem->id }}">{{'Item : '.$teaitem->item_name .' | Scale : '.$teaitem->scale.' | Rs : '.$teaitem->price}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="tea_item_qty">Qty</label>
                                <input type="number" class="form-control mb-4" name="tea_item_qty" value="1" min="1"
                                       id="tea_item_qty">
                            </div>
                            <div class="col-md-2">
                                <label for="tea_time">Time</label>
                                <select aria-hidden="true" id="tea_time" class="form-control w-100" name="tea_time">
                                    <option value="1">0600 Hrs</option>
                                    <option value="2">1000 Hrs</option>
                                    <option value="3">1500 Hrs</option>
                                    <option value="4">Other</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="order_date_tea">Order Date</label>
                                <input type="text" autocomplete="off" placeholder="From Date"
                                       class="form-control datepicker order_date_tea" name="order_date_tea">
                            </div>
                            <div class="col-md-5">
                                <label for="tea_remarks">Remarks</label>
                                <input type="text" class="form-control mb-4" name="tea_remarks" id="tea_remarks">
                            </div>
                            <div class="col-md-1">
                                <button type="button"
                                        class="order-btn disabled btn btn-success btn-height btn_tea_item_order">Order
                                </button>
                            </div>
                        </div>
                    </div>
                @endisset

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-indigo text-bold">Extra Messing Items</div>
            <div class="card-body">

                @isset($extraMessings)
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <select aria-hidden="true" id="extra_messing_items"
                                        class="multiple-select form-control w-100" name="extra_messing_items">

                                    @foreach($extraMessings as $dessert)
                                        <option value="{{$dessert->id }}">{{'Item : '. $dessert->item_name .' | Scale : '.$dessert->scale.' | Rs : '.$dessert->price}} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="extra_mess_item_qty">Qty</label>
                                <input type="number" class="form-control mb-4" name="extra_mess_item_qty" value="1"
                                       min="1" id="extra_mess_item_qty">
                            </div>
                            <div class="col-md-2">
                                <label for="extra_mess_item_time">Time</label>
                                <select aria-hidden="true" id="extra_mess_item_time" class="form-control w-100"
                                        name="extra_mess_item_time">
                                    <option value="1">Breakfast</option>
                                    <option value="2">Lunch</option>
                                    <option value="3">Dinner</option>
                                    <option value="4">Other</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="order_date_extra">Order Date</label>
                                <input type="text" autocomplete="off" placeholder="From Date"
                                       class="form-control datepicker order_date_extra" name="order_date_extra">
                            </div>
                            <div class="col-md-5">
                                <label for="extra_mess_item_remarks">Remarks</label>
                                <input type="text" class="form-control mb-4" name="extra_mess_item_remarks"
                                       id="extra_mess_item_remarks">
                            </div>
                            <div class="col-md-1">
                                <button type="button"
                                        class="order-btn disabled btn btn-success btn-height btn_extra_mess_item_order">
                                    Order
                                </button>
                            </div>
                        </div>
                    </div>
                @endisset

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-indigo text-bold">Dessert Items</div>
            <div class="card-body">

                @isset($desserts)
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <select aria-hidden="true" id="dessert_items"
                                        class="multiple-select form-control w-100" name="dessert_items">

                                    @foreach($desserts as $dessert)
                                        <option value="{{ $dessert->id }}">{{'Item : '.$dessert->item_name .' | Scale : '.$dessert->scale.' | Rs : '.$dessert->price}} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label for="dessert_item_qty">Qty</label>
                                <input type="number" class="form-control mb-4" name="dessert_item_qty" value="1" min="1"
                                       id="dessert_item_qty">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="dessert_item_time">Time</label>
                                    <select aria-hidden="true" id="dessert_item_time" class="form-control"
                                            name="dessert_item_time">
                                        <option value="1">Breakfast</option>
                                        <option value="2">Lunch</option>
                                        <option value="3">Dinner</option>
                                        <option value="4">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="order_date_dessert">Order Date</label>
                                <input type="text" autocomplete="off" placeholder="From Date"
                                       class="form-control datepicker order_date_dessert" name="order_date_dessert">
                            </div>
                            <div class="col-md-5">
                                <label for="dessert_item_remarks">Remarks</label>
                                <input type="text" class="form-control mb-4" name="dessert_item_remarks"
                                       id="dessert_item_remarks">
                            </div>
                            <div class="col-md-1">
                                <button type="button"
                                        class="order-btn disabled btn btn-success btn-height btn_dessert_item_order">
                                    Order
                                </button>
                            </div>
                        </div>
                    </div>
                @endisset

            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="{{asset('/js/datepicker/datepicker.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        $(document).ready(function () {

            const weekday = ["Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday",];
            //date picker
            $('.datepicker').datepicker({
                format: 'YYYY-MM-DD',
                autoclose: true,
                // endDate: '0d'
            })
                .datepicker("setDate", new Date()).on('keypress keydown paste change', function (e) {
                $('.datepicker').datepicker('hide');
            });


            // search daily ration
            $(document).on('click', '#dateFilter', function (e) {

                $('#orderForm')[0].reset();
                $('#officer').val('').change();

                let date = $('#fromDate').val();
                rations(date);
            });

            function rations(date = '') {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('ration-search')}}',
                    type: 'POST',
                    data: {date: date},
                    success: function (response) {


                        $(".ration-div").empty();

                        response.forEach((element) => {

                            let items1 = (element.items);
                            let item2 = items1.toString()


                            let dt = new Date(element.ration_date);


                            let breakfastDiv,lunchDiv,dinnerDiv,otherDiv;

                            if (element.meal_time ==='breakfast')
                            {
                                breakfastDiv = `<div class="col-md-3 d-flex ">

                                    <div class="card card-body flex-fill">
                                        <div class="card-body">
                                            <div class="row"><h4 class="card-title text-bold">` + element.menu_name + `</h4></div>
                                            <div class="row"><h4 class="card-title text-bold">` + weekday[dt.getDay()] + '-' + element.meal_time + `</h4></div>
                                            <div class="row"><h4 class="card-title text-purple">` + element.meal_time + `</h4></div>

                                            <div class="row"><p class="card-text text-primary">` + element.ration_date + `</p></div>
                                            <div class="row"><p class="card-text ` + (element.meal_type == 1 ? 'text-danger' : 'text-success') + `">` + (element.meal_type == 1 ? 'Non-vegetarian' : 'Vegetarian') + `</p></div>
                                            <div class="row"><h6 class="card-text mb-4 text-danger">Tentative Price : Rs:` + element.tentative_price + `</h6></div>
                                        </div>
                                         <div class="card-body">
                                            <h5>Menu Items </h5>
                                                 <ul class="list-group list-group-flush">
                                                ` +
                                    item2.replace(/,/g, '')
                                    + `
                                                </ul>
                                            <p class="card-text">Dessert :` + (element.dessert ? element.dessert : 'No Dessert') + `</p>

                                         </div>
                                        <label for="ration_qty">Qty</label>
                                        <input type="number" class="form-control mb-4" name="ration_qty" value="1" min="1" id="` + element.id + `_ration_qty">
                                        <button class="order-btn disabled btn btn-primary btn-order mt-2 ration-order" value="` + element.id + `">Order</button>
                                    </div>
                                </div>`;
                            }
                            if (element.meal_time ==='lunch')
                            {
                                lunchDiv = `<div class="col-md-3 d-flex ">

                                    <div class="card card-body flex-fill">
                                        <div class="card-body">
                                            <div class="row"><h4 class="card-title text-bold">` + element.menu_name + `</h4></div>
                                            <div class="row"><h4 class="card-title text-bold">` + weekday[dt.getDay()] + '-' + element.meal_time + `</h4></div>
                                            <div class="row"><h4 class="card-title text-purple">` + element.meal_time + `</h4></div>

                                            <div class="row"><p class="card-text text-primary">` + element.ration_date + `</p></div>
                                            <div class="row"><p class="card-text ` + (element.meal_type == 1 ? 'text-danger' : 'text-success') + `">` + (element.meal_type == 1 ? 'Non-vegetarian' : 'Vegetarian') + `</p></div>
                                            <div class="row"><h6 class="card-text mb-4 text-danger">Tentative Price : Rs:` + element.tentative_price + `</h6></div>
                                        </div>
                                         <div class="card-body">
                                            <h5>Menu Items </h5>
                                                 <ul class="list-group list-group-flush">
                                                ` +
                                    item2.replace(/,/g, '')
                                    + `
                                                </ul>
                                            <p class="card-text">Dessert :` + (element.dessert ? element.dessert : 'No Dessert') + `</p>

                                         </div>
                                        <label for="ration_qty">Qty</label>
                                        <input type="number" class="form-control mb-4" name="ration_qty" value="1" min="1" id="` + element.id + `_ration_qty">
                                        <button class="order-btn disabled btn btn-primary btn-order mt-2 ration-order" value="` + element.id + `">Order</button>
                                    </div>
                                </div>`;
                            }
                            if (element.meal_time ==='dinner')
                            {
                                dinnerDiv = `<div class="col-md-3 d-flex ">

                                    <div class="card card-body flex-fill">
                                        <div class="card-body">
                                            <div class="row"><h4 class="card-title text-bold">` + element.menu_name + `</h4></div>
                                            <div class="row"><h4 class="card-title text-bold">` + weekday[dt.getDay()] + '-' + element.meal_time + `</h4></div>
                                            <div class="row"><h4 class="card-title text-purple">` + element.meal_time + `</h4></div>

                                            <div class="row"><p class="card-text text-primary">` + element.ration_date + `</p></div>
                                            <div class="row"><p class="card-text ` + (element.meal_type == 1 ? 'text-danger' : 'text-success') + `">` + (element.meal_type == 1 ? 'Non-vegetarian' : 'Vegetarian') + `</p></div>
                                            <div class="row"><h6 class="card-text mb-4 text-danger">Tentative Price : Rs:` + element.tentative_price + `</h6></div>
                                        </div>
                                         <div class="card-body">
                                            <h5>Menu Items </h5>
                                                 <ul class="list-group list-group-flush">
                                                ` +
                                    item2.replace(/,/g, '')
                                    + `
                                                </ul>
                                            <p class="card-text">Dessert :` + (element.dessert ? element.dessert : 'No Dessert') + `</p>

                                         </div>
                                        <label for="ration_qty">Qty</label>
                                        <input type="number" class="form-control mb-4" name="ration_qty" value="1" min="1" id="` + element.id + `_ration_qty">
                                        <button class="order-btn disabled btn btn-primary btn-order mt-2 ration-order" value="` + element.id + `">Order</button>
                                    </div>
                                </div>`;
                            }
                            if (element.meal_time ==='other')
                            {
                                otherDiv = `<div class="col-md-3 d-flex ">

                                    <div class="card card-body flex-fill">
                                        <div class="card-body">
                                            <div class="row"><h4 class="card-title text-bold">` + element.menu_name + `</h4></div>
                                            <div class="row"><h4 class="card-title text-bold">` + weekday[dt.getDay()] + '-' + element.meal_time + `</h4></div>
                                            <div class="row"><h4 class="card-title text-purple">` + element.meal_time + `</h4></div>

                                            <div class="row"><p class="card-text text-primary">` + element.ration_date + `</p></div>
                                            <div class="row"><p class="card-text ` + (element.meal_type == 1 ? 'text-danger' : 'text-success') + `">` + (element.meal_type == 1 ? 'Non-vegetarian' : 'Vegetarian') + `</p></div>
                                            <div class="row"><h6 class="card-text mb-4 text-danger">Tentative Price : Rs:` + element.tentative_price + `</h6></div>
                                        </div>
                                         <div class="card-body">
                                            <h5>Menu Items </h5>
                                                 <ul class="list-group list-group-flush">
                                                ` +
                                    item2.replace(/,/g, '')
                                    + `
                                                </ul>
                                            <p class="card-text">Dessert :` + (element.dessert ? element.dessert : 'No Dessert') + `</p>

                                         </div>
                                        <label for="ration_qty">Qty</label>
                                        <input type="number" class="form-control mb-4" name="ration_qty" value="1" min="1" id="` + element.id + `_ration_qty">
                                        <button class="order-btn disabled btn btn-primary btn-order mt-2 ration-order" value="` + element.id + `">Order</button>
                                    </div>
                                </div>`;
                            }

                            let divArray = [breakfastDiv,lunchDiv,dinnerDiv,otherDiv]

                            $(".ration-div").append(
                                divArray
                            );

                        });


                    },
                    error: function (error) {
                    }
                });
            }

            $('.select2-single').select2({});

            //get officer details
            $('#officer').on('change', function () {

                let officer_id = $(this).val();
                if (officer_id) {
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        url: '{{route('get-officer-details')}}',
                        type: 'POST',
                        data: {officer_id: officer_id},
                        success: function (response) {

                            $('#full_name').val(response[0].full_name);
                            $('#e_number').val(response[0].email);
                            $('#name_with_init').val(response[0].name_according_to_part2);
                            $('#nic').val(response[0].nic);
                            $('#rank').val(response[0].rank);
                            $('#regiment').val(response[0].regiment);
                            $('#service_number').val(response[0].service_no);
                            $('#unit').val(response[0].unit);

                            // $(".item-div").addClass('').removeClass('');
                            $(".order-btn").removeClass('disabled');
                        },
                        error: function (error) {
                        }
                    });
                }
                else {
                    $(".order-btn").addClass('disabled');
                }
            });


            //ration order
            $('body').on('click', '.ration-order', function () {
                // $('.ration-order').on('click', function () {


                let order_type = 'ration';
                let order_id = $(this).val();
                let service_number = $('#e_number').val();
                let qty = $('#' + order_id + '_ration_qty').val();

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-valid-order-time')}}',
                    type: 'post',
                    data: {order_id: order_id},
                    success: function (response) {

                        // // console.log(response)
                        let confirmationMessage = response;

                        if (response != 1) {
                            // if (confirm(confirmationMessage) == true) {
                            //
                            //     functionRationOrder(order_type, order_id, service_number, qty)
                            // }

                            Swal.fire({
                                title: confirmationMessage,
                                showDenyButton: true,
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                denyButtonText: 'No',
                                customClass: {
                                    actions: 'my-actions',
                                    cancelButton: 'order-1 right-gap',
                                    confirmButton: 'order-2',
                                    denyButton: 'order-3',
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    functionRationOrder(order_type, order_id, service_number, qty)

                                } else if (result.isDenied) {
                                    Swal.fire('Changes are not saved', '', 'info')
                                }
                            })


                        }
                        else {
                            functionRationOrder(order_type, order_id, service_number, qty)
                        }


                    },
                });


            });


            function functionRationOrder(order_type, order_id, service_number, qty) {


                let text = "Confirm this order";
                {{--if (confirm(text) == true) {--}}

                {{--$.ajax({--}}
                {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                {{--dataType: 'json',--}}
                {{--url: '{{route('place-an-order')}}',--}}
                {{--type: 'POST',--}}
                {{--data: {order_type: order_type, order_id: order_id, service_number: service_number, qty: qty},--}}
                {{--success: function (response) {--}}

                {{--alert('Order placed successfully!');--}}
                {{--location.reload();--}}
                {{--},--}}

                {{--error: function (error) {--}}
                {{--alert('Order place error!')--}}
                {{--}--}}
                {{--});--}}

                {{--}--}}

                Swal.fire({
                    title: text,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: 'json',
                            url: '{{route('place-an-order')}}',
                            type: 'POST',
                            data: {
                                order_type: order_type,
                                order_id: order_id,
                                service_number: service_number,
                                qty: qty
                            },
                            success: function (response) {

                                $('input[name=ration_qty]').val(1);
                                // alert('Order placed successfully!');
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Order placed successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                // setTimeout(function(){
                                //     location.reload()
                                // }, 1500);
                                // location.reload();
                            },

                            error: function (error) {
                                // alert('Order place error!')
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Order place error!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        });


                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            }


            //tea order
            $('.btn_tea_item_order').on('click', function () {

                let order_type = 'tea';
                let order_id = $('#tea_items').val();
                let service_number = $('#e_number').val();
                let qty = $('#tea_item_qty').val();
                let time = $('#tea_time').val();
                let remarks = $('#tea_remarks').val();
                let order_date = $('.order_date_tea').val();

                // alert(order_id+' '+service_number+' '+qty)
                let text = "Confirm this order";

                // if (confirm(text) == true) {

                {{--$.ajax({--}}
                {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                {{--dataType: 'json',--}}
                {{--url: '{{route('place-an-order')}}',--}}
                {{--type: 'POST',--}}
                {{--data: {--}}
                {{--time: time,--}}
                {{--remarks: remarks,--}}
                {{--order_type: order_type,--}}
                {{--order_id: order_id,--}}
                {{--service_number: service_number,--}}
                {{--qty: qty,--}}
                {{--order_date: order_date--}}
                {{--},--}}
                {{--success: function (response) {--}}
                {{--alert('Order placed successfully!');--}}
                {{--$('#tea_item_qty').val(1);--}}
                {{--$('#tea_remarks').val('');--}}
                {{--location.reload();--}}
                {{--},--}}
                {{--error: function (error) {--}}
                {{--alert('Order place error!')--}}
                {{--}--}}
                {{--});--}}

                // } else { }

                Swal.fire({
                    title: text,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: 'json',
                            url: '{{route('place-an-order')}}',
                            type: 'POST',
                            data: {
                                time: time,
                                remarks: remarks,
                                order_type: order_type,
                                order_id: order_id,
                                service_number: service_number,
                                qty: qty,
                                order_date: order_date
                            },
                            success: function (response) {
                                // alert('Order placed successfully!');

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Order placed successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                $('#tea_item_qty').val(1);
                                $('#tea_remarks').val('');

                                // setTimeout(function(){
                                //     location.reload()
                                // }, 1500);


                                // location.reload();
                            },
                            error: function (error) {

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Order place error!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                // alert('Order place error!')
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })

            });

            //extra order
            $('.btn_extra_mess_item_order').on('click', function () {

                let order_type = 'extra';
                let order_id = $('#extra_messing_items').val();
                let service_number = $('#e_number').val();
                let qty = $('#extra_mess_item_qty').val();
                let time = $('#extra_mess_item_time').val();
                let remarks = $('#extra_mess_item_remarks').val();
                let order_date = $('.order_date_extra').val();

                // alert(order_id+' '+service_number+' '+qty)
                let text = "Confirm this order";
                // if (confirm(text) == true) {

                {{--$.ajax({--}}
                {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                {{--dataType: 'json',--}}
                {{--url: '{{route('place-an-order')}}',--}}
                {{--type: 'POST',--}}
                {{--data: {--}}
                {{--time: time,--}}
                {{--remarks: remarks,--}}
                {{--order_type: order_type,--}}
                {{--order_id: order_id,--}}
                {{--service_number: service_number,--}}
                {{--qty: qty,--}}
                {{--order_date: order_date--}}
                {{--},--}}
                {{--success: function (response) {--}}
                {{--alert('Order placed successfully!')--}}
                {{--$('#extra_mess_item_qty').val(1);--}}
                {{--$('#extra_mess_item_remarks').val('');--}}
                {{--location.reload();--}}
                {{--},--}}
                {{--error: function (error) {--}}
                {{--alert('Order place error!')--}}
                {{--}--}}
                {{--});--}}

                // } else {}

                Swal.fire({
                    title: 'Do you want to cancel order?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: 'json',
                            url: '{{route('place-an-order')}}',
                            type: 'POST',
                            data: {
                                time: time,
                                remarks: remarks,
                                order_type: order_type,
                                order_id: order_id,
                                service_number: service_number,
                                qty: qty,
                                order_date: order_date
                            },
                            success: function (response) {
                                // alert('Order placed successfully!')

                                // location.reload();

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Order placed successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $('#extra_mess_item_qty').val(1);
                                $('#extra_mess_item_remarks').val('');
                                // setTimeout(function(){
                                //     location.reload()
                                // }, 1500);
                            },
                            error: function (error) {
                                // alert('Order place error!')
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Order place error!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            });

            //dessert order
            $('.btn_dessert_item_order').on('click', function () {

                let order_type = 'dessert';
                let order_id = $('#dessert_items').val();
                let service_number = $('#e_number').val();
                let qty = $('#dessert_item_qty').val();
                let time = $('#dessert_item_time').val();
                let remarks = $('#dessert_item_remarks').val();
                let order_date = $('.order_date_dessert').val();

                // alert(order_id+' '+service_number+' '+qty)
                let text = "Confirm this order";
                {{--if (confirm(text) == true) {--}}

                {{--$.ajax({--}}
                {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                {{--dataType: 'json',--}}
                {{--url: '{{route('place-an-order')}}',--}}
                {{--type: 'POST',--}}
                {{--data: {--}}
                {{--time: time,--}}
                {{--remarks: remarks,--}}
                {{--order_type: order_type,--}}
                {{--order_id: order_id,--}}
                {{--service_number: service_number,--}}
                {{--qty: qty,--}}
                {{--order_date: order_date--}}
                {{--},--}}
                {{--success: function (response) {--}}
                {{--alert('Order placed successfully!')--}}
                {{--$('#dessert_item_qty').val(1);--}}
                {{--$('#dessert_item_remarks').val('');--}}
                {{--location.reload();--}}
                {{--},--}}
                {{--error: function (error) {--}}
                {{--alert('Order place error!')--}}
                {{--}--}}
                {{--});--}}

                {{--} else {}--}}


                Swal.fire({
                    title: text,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: 'json',
                            url: '{{route('place-an-order')}}',
                            type: 'POST',
                            data: {
                                time: time,
                                remarks: remarks,
                                order_type: order_type,
                                order_id: order_id,
                                service_number: service_number,
                                qty: qty,
                                order_date: order_date
                            },
                            success: function (response) {
                                // alert('Order placed successfully!')

                                // location.reload();

                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Order placed successfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $('#dessert_item_qty').val(1);
                                $('#dessert_item_remarks').val('');
                                // setTimeout(function(){
                                //     location.reload()
                                // }, 1500);


                            },
                            error: function (error) {
                                // alert('Order place error!')
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Order place error!',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })

            });
        });

    </script>

@endpush

@push('page_css')
    <style>
        .btn-order {
            position: absolute !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            border-radius: 0px !important;
        }
    </style>
@endpush

