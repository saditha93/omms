@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Daily Menu<span class="text-primary mr-5 ml-5 ration-non-veg"></span><span class="text-success ration-veg mr-5"></span> <span class="text-indigo mr-5 ml-2 ration-event"></span> <span class="text-maroon mr-5 ml-2 ration-other"></span>
            </div>
            <div class="card-body">
                 @if(!isset($rationOf[0]->id))
                    <form method="POST" action="{{route('ration.store')}}">
                 @else
                    <form method="POST" action="{{route('ration.update',$rationOf[0]->id)}}">
                 @method('PUT')
                 @endif
                 @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="menu" class="form-label">Menu</label>
                                            <select class="form-control" name="menu" id="menu">
                                                <option value=" ">Select menu</option>
                                                @foreach($menus as $menu)
                                                    <option value="{{$menu->id}}" {{isset($rationOf[0]->mess_menu_id)?$rationOf[0]->mess_menu_id==$menu->id?'selected':'':old('menu')}}>{{$menu->menu_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('menu')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="menu_type" class="form-label">Menu Type</label>
                                            <select class="form-control" id="menu_type" name="menu_type">
                                                <option value=" ">Select Type</option>
                                                <option value="breakfast" {{isset($rationOf[0]->meal_time)?$rationOf[0]->meal_time=='breakfast'?'selected':'':''}}>
                                                    Breakfast
                                                </option>
                                                <option value="lunch" {{isset($rationOf[0]->meal_time)?$rationOf[0]->meal_time=='lunch'?'selected':'':''}}>
                                                    Lunch
                                                </option>
                                                <option value="dinner" {{isset($rationOf[0]->meal_time)?$rationOf[0]->meal_time=='dinner'?'selected':'':''}}>
                                                    Dinner
                                                </option>
                                                {{--<option value="event" {{isset($rationOf[0]->meal_time)?$rationOf[0]->meal_time=='event'?'selected':'':''}}>--}}
                                                    {{--Event--}}
                                                {{--</option>--}}
                                                <option value="other" {{isset($rationOf[0]->meal_time)?$rationOf[0]->meal_time=='other'?'selected':'':''}}>
                                                    Other
                                                </option>
                                            </select>
                                            @error('menu_type')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="desert" class="form-label">Dessert</label>
                                            <select class="form-control" name="desert" id="desert">
                                                <option value="" {{isset($rationOf[0]->dessert_item_id)?$rationOf[0]->dessert_item_id==null?'selected':'':''}}>Select dessert</option>
                                                @foreach($desserts as $dessert)
                                                    <option value="{{$dessert->id}}" {{isset($rationOf[0]->dessert_item_id)?$rationOf[0]->dessert_item_id==$dessert->id?'selected':'':''}}>{{$dessert->item_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('desert')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="date" class="form-label">Date</label>
                                        <div class="input-group">
                                            <input name="date" id="date" type="date" class="form-control" value="{{isset($rationOf[0]->ration_date)?$rationOf[0]->ration_date:old('date')}}">
                                        </div>
                                        @error('date')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meal_remark" class="form-label">Remarks</label>
                                            <input disabled aria-describedby="currency-input" type="text" class="form-control" id="meal_remark" value="{{isset($rationOf[0]->remarks)?$rationOf[0]->remarks:''}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card mt-4">
                                            <div class="card-header">
                                                Menu Items
                                            </div>
                                            <div class="card-body">
                                                <h5 class="item-container"><?php echo isset($htmlData)?$htmlData:''?></h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="meal_type" class="form-label">Meal Type</label>
                                            <input disabled aria-describedby="currency-input" type="text" class="form-control" id="meal_type" value="{{isset($rationOf[0]->meal_type)?$rationOf[0]->meal_type==1?'Non-Vegetarian':'Vegetarian':''}}">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="price" class="form-label">Tentative Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="currency-input">RS</span>
                                            <input aria-describedby="currency-input" data-type="currency"  type="number" step="0.01" class="form-control" name="price" id="price" value="{{isset($rationOf[0]->tentative_price)?$rationOf[0]->tentative_price:old('price')}}">
                                            @error('price')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-4 pt-2">
                                        <div class="form-group">
                                            @if(!isset($rationOf[0]->id))
                                                <input class="btn btn-primary float-right" type="submit" value="Add Daily Menu">
                                            @else
                                                <input class="btn btn-primary float-right" type="submit" value="Update Daily Ration">
                                                <a class="btn btn-secondary float-right mr-1" type="button" href="{{route('ration.index')}}">Cancel</a>
                                            @endif
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
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3 offset-md-5">
                        <div class="form-group">
                            <label for="fromDate">From Date</label>
                            <input type="text" autocomplete="off" placeholder="From Date" class="form-control datepicker" id="fromDate" name="fromDate">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="toDate">To Date</label>
                            <input type="text" autocomplete="off" placeholder="To Date" class="form-control datepicker" id="toDate" name="toDate">
                        </div>
                    </div>
                    <div class="col-md-1 mt-4">
                        <button class="btn btn-primary float-right mt-2" type="button" id="dateFilter">
                            Search
                        </button>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="cell-border" id="dailyRationDatatable"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th style="width: 50px">Serial</th>
                            <th>Menu</th>
                            <th>Type</th>
                            <th>Menu Type</th>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Tentative Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
{{--    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}--}}

    <script src="{{asset('/js/datepicker/datepicker.js')}}"></script>

    <script>


            $( document ).ready(function() {

                //date picker
                $('.datepicker').datepicker({
                    format: 'YYYY-MM-DD',
                    autoclose: true,
                    // endDate: '0d'
                })
                    .datepicker("setDate",new Date()).on('keypress keydown paste change', function (e) {
                    $('.datepicker').datepicker('hide');
                });

                rationHistory($('#fromDate').val(),$('#toDate').val());

                //price input
                $( document ).ready(function() {
                    formatUnitPrice();
                    $("input[data-type='currency']").on({
                        keyup: function() {
                        },
                        blur: function() {
                            formatUnitPrice($(this), "blur");
                        }
                    });
                });
                function formatUnitPrice()
                {
                    let inputVal = $('#price').val();
                    let cry = Number(inputVal).toFixed(2);
                    $('#price').val(cry);
                }





                //get items according to category
                $("#menu").change(function(){
                    let menuId = this.value;

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: 'json',
                        url: '{{route('menu-items')}}',
                        type: 'POST',
                        data: {menuId:menuId },
                        success: function (response) {
                            // console.log(response[1][0]['meal_type'])
                            $( ".item-container" ).html("").append(response[0]);
                            $("#meal_type").val(response[1][0]['meal_type']==1?'Non-vegetarian':'Vegetarian');
                            $("#meal_remark").val(response[1][0]['remarks']);
                        },
                        error: function (error) {
                        }
                    });
                });


                {{--//get ration count--}}
                {{--$.ajax({--}}
                    {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                    {{--dataType: 'json',--}}
                    {{--url: '{{route('ration-count')}}',--}}
                    {{--type: 'GET',--}}
                    {{--success: function (response) {--}}

                        {{--$( ".ration-non-veg" ).html("").append('Non-vegetarian '+response.nonVeg+'/3');--}}
                        {{--$( ".ration-veg" ).html("").append('Vegetarian '+response.veg+'/3');--}}
                        {{--$( ".ration-event" ).html("").append('Event - '+response.event);--}}
                        {{--$( ".ration-other" ).html("").append('Other - '+response.other);--}}
                    {{--},--}}
                    {{--error: function (error) {--}}

                    {{--}--}}
                {{--});--}}


                // search daily ration
                $(document).on('click', '#dateFilter', function (e) {


                    let fromDate = $('#fromDate').val();
                    let toDate = $('#toDate').val();

                    //destroy datatable and call
                    $('#dailyRationDatatable').DataTable().destroy();
                    rationHistory(fromDate,toDate);
                });

            });

            function rationHistory(fromDate='',toDate='')
            {
                //dtaTable
                $('#dailyRationDatatable').DataTable({
                    // responsive: true,
                    // processing: true,
                    serverSide: true,
                    ajax: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        // url: 'daily-ration-datatable',
                        url: '{{url("admin/daily-ration-datatable")}}',
                        type: "POST",
                        data: {fromDate:fromDate, toDate:toDate},
                        dataType: "json",
                    },
                    rowId: 'id',
                    columns: [
                        {
                            "data": null, "render": function (data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {data: 'menu_name', name: 'menu_name'},
                        {
                            "mRender": function (data, group, full, meta) {

                                $veg = '<span class="badge rounded-pill bg-success">Vegetarian</span>';
                                $nonveg = '<span class="badge rounded-pill bg-info">Non-vegetarian</span>';
                                return full.meal_type==1?$nonveg:$veg;

                            }
                        },
                        {data: 'meal_time', name: 'meal_time'},
                        {data: 'ration_date', name: 'ration_date'},
                        {
                            "mRender": function (data, group, full, meta) {

                                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                                var d = new Date(full.ration_date);
                                return days[d.getDay()];

                            }
                        },
                        {
                            "mRender": function (data, group, full, meta) {
                            return Number(full.tentative_price).toFixed(2);
                        }
                        },
                        // {data: 'purchase_description', name: 'purchase_description'},
                        // {data: 'action', name: 'action', orderable: false, searchable: false},
                        {
                            "mRender": function (data, group, full, meta) {

                            return `<a class="btn btn-sm btn-warning" href="ration/`+full.id+`/edit">Edit</a>`;
                           //     return '<button class="btn btn-sm btn-warning btn-daily-ration-edit" href="" > Edit</button>';

                            }
                        },

                    ]
                        });



            }




            {{--//Edit--}}
                {{--$('#dailyRationDatatable').on('click', '.btn-daily-ration-edit', function() {--}}

                {{--let rationID = $(this).closest('tr').attr('id');--}}

                    {{--$.ajax({--}}
                        {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                        {{--dataType: 'json',--}}
                        {{--url: '{{route('re-activate-mess-manager')}}',--}}
                        {{--type: 'POST',--}}
                        {{--data: {rationID:rationID },--}}
                        {{--success: function (response) {--}}
                            {{--// alert('User Re-Activated');--}}
                            {{--// location.reload();--}}
                            {{--Swal.fire({--}}
                                {{--position: 'top-end',--}}
                                {{--icon: 'success',--}}
                                {{--title: 'User activated',--}}
                                {{--showConfirmButton: false,--}}
                                {{--timer: 1500--}}
                            {{--})--}}
                            {{--setTimeout(function(){--}}
                                {{--location.reload()--}}
                            {{--}, 1500);--}}
                        {{--},--}}
                    {{--});--}}
            {{--});--}}



    </script>

@endpush

@push('page_css')
    <style>
        #dailyRationDatatable_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush

