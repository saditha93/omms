@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Order Details
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="offset-md-9 col-md-2">
                        <div class="form-group">
                            <label for="filter_dt">Filter Date</label>
                            <input type="text" autocomplete="off" placeholder="From Date" class="form-control datepicker" id="filter_dt" name="filter_dt">
                        </div>
                    </div>
                    <div class="col-md-1 mt-4">
                        <button class="btn btn-primary float-right mt-2" type="button" id="orderdateFilter">
                            Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-indigo text-bold">Mess Orders</div>
            <div class="card-body">
                <table class="cell-border" id="dailyRationDatatable"
                       style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 50px">Serial</th>
                            <th>Officer</th>
                            <th>Breakfast Qty</th>
                            <th>Lunch Qty</th>
                            <th>Dinner Qty</th>
                            {{--<th>Event Qty</th>--}}
                            <th>Other Qty</th>
                            <th>Cancel Order</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-2 offset-md-4">
                        <label for="dtBreakfastQty">Breakfast Qty</label>
                        <input readonly type="text" id="dtBreakfastQty" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-2">
                        <label for="dtLunchQty">Lunch Qty</label>
                        <input readonly type="text" id="dtLunchQty" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-2">
                        <label for="dtDinnerQty">Dinner Qty</label>
                        <input readonly type="text" id="dtDinnerQty" class="form-control form-control-sm">
                    </div>
                    {{--<div class="col-md-2">--}}
                        {{--<label for="dtEventQty">Event Qty</label>--}}
                        {{--<input readonly type="text" id="dtEventQty" class="form-control form-control-sm">--}}
                    {{--</div>--}}
                    <div class="col-md-2">
                        <label for="dtOtherQty">Other Qty</label>
                        <input readonly type="text" id="dtOtherQty" class="form-control form-control-sm">
                    </div>
                </div>
            </div>



            <div class="card-header text-indigo text-bold">Other Orders (Extra/ Dessert/ Tea)</div>
            <div class="card-body">
                <table class="cell-border" id="dailyExtraOrderDatatable"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th style="width: 50px">Serial</th>
                        <th>Officer</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>Time</th>
                        <th>Note</th>
                        <th style="width: 86px">Action</th>
                        {{--<th>Other Qty</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="mb-3" id="status"></div>

        </div>
    </div>


@endsection

@push('scripts')

    <script src="{{asset('/js/datepicker/datepicker.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>


        $(document).ready(function () {

            //date picker
            $('.datepicker').datepicker({
                format: 'YYYY-MM-DD',
                autoclose: true,
                // endDate: '0d'
            })
                .datepicker("setDate", new Date()).on('keypress keydown paste change', function (e) {
                $('.datepicker').datepicker('hide');
            });


           //get officer details
            {{--$('#officer').on('change', function () {--}}

                {{--let officer_id = $(this).val();--}}

                {{--if (officer_id) {--}}
                    {{--$.ajax({--}}
                        {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                        {{--dataType: 'json',--}}
                        {{--url: '{{route('get-officer-details')}}',--}}
                        {{--type: 'POST',--}}
                        {{--data: {officer_id: officer_id},--}}
                        {{--success: function (response) {--}}

                            {{--$('#full_name').val(response[0].full_name);--}}
                            {{--$('#e_number').val(response[0].enumber);--}}
                            {{--$('#name_with_init').val(response[0].name_according_to_part2);--}}
                            {{--$('#nic').val(response[0].nic);--}}
                            {{--$('#rank').val(response[0].rank);--}}
                            {{--$('#regiment').val(response[0].regiment);--}}
                            {{--$('#service_number').val(response[0].service_no);--}}
                            {{--$('#unit').val(response[0].unit);--}}

                            {{--// $(".item-div").addClass('').removeClass('');--}}
                            {{--$(".order-btn").removeClass('disabled');--}}
                        {{--},--}}
                        {{--error: function (error) {--}}
                        {{--}--}}
                    {{--});--}}


                {{--}--}}
            {{--});--}}

            $('#orderdateFilter').on('click', function () {

                $('#dailyRationDatatable').DataTable().destroy();
                $('#dailyExtraOrderDatatable').DataTable().destroy();
                officerOrders();

            });

            officerOrders();

            function officerOrders() {

                let filter_dt = $('#filter_dt').val();

               let tbl = $('#dailyRationDatatable').DataTable({
                    serverSide: true,
                    ajax: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{url("admin/officer-respective-orders")}}',
                        type: "POST",
                        data: {filter_dt:filter_dt},
                        dataType: "json",
                        rowId: 'id',
                        serverSide: true
                    },
                    columns: [
                        {
                            "data": null, "render": function (data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {data: 'name_according_to_part2', name: 'name_according_to_part2'},
                        {data: 'breakfastOrders', name: 'breakfastOrders'},
                        {data: 'lunchOrders', name: 'lunchOrders'},
                        {data: 'dinnerOrders', name: 'dinnerOrders'},
                        // {data: 'eventOrders', name: 'eventOrders'},
                        {data: 'otherOrders', name: 'otherOrders'},
                        {
                            "mRender": function (data, group, full, meta) {

                                 $breakfast = '<button class="btn btn-danger btn-sm btn-dark btn-breakfast-cancel m-1">Breakfast</button>';
                                 $lunch = '<button class="btn btn-danger btn-sm btn-dark btn-lunch-cancel m-1">Lunch</button>';
                                 $dinner = '<button class="btn btn-danger btn-sm btn-dark btn-dinner-cancel m-1">Dinner</button>';
                                 $event = '<button class="btn btn-danger btn-sm btn-dark btn-event-cancel m-1">Event</button>';
                                 $other = '<button class="btn btn-danger btn-sm btn-dark btn-other-cancel m-1">Other</button>';

                                 return $breakfast+$lunch+$dinner+$event+$other;
                            }
                        },

                    ],
                   "initComplete": function (row, data, start, end, display) {


                   },
                   "footerCallback": function (row, data, start, end, display) {

                        let date = $('#filter_dt').val();

                       $.ajax({
                           headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                           dataType: 'json',
                           url: '{{route('get-total-ration-for-the-day')}}',
                           type: 'POST',
                           data: {
                               date: date,
                           },
                           success: function (response) {


                               $('#dtBreakfastQty').val(response['order_breakfast'])
                               $('#dtLunchQty').val(response['order_lunch'])
                               $('#dtDinnerQty').val(response['order_dinner'])
                               $('#dtEventQty').val(response['order_event'])
                               $('#dtOtherQty').val(response['order_other'])


                           },
                           error: function (error) {

                           }
                       });


                   },
                   "drawCallback": function (row, data, start, end, display) {
                       // var api = this.api(), data;
                       //
                       // // converting to interger to find total
                       // var intVal = function ( i ) {
                       //     return typeof i === 'string' ?
                       //         i.replace(/[\$,]/g, '')*1 :
                       //         typeof i === 'number' ?
                       //             i : 0;
                       // };
                       //
                       // // computing column Total of the complete result
                       // var breakfastQty = api
                       //     .column( 2 )
                       //     .data()
                       //     .reduce( function (a, b) {
                       //         return intVal(a) + intVal(b);
                       //     });
                       //
                       //
                       //
                       // var lunchQty = api
                       //     .column( 3 )
                       //     .data()
                       //     .reduce( function (a, b) {
                       //         return intVal(a) + intVal(b);
                       //     }, 0 );
                       //
                       // var dinnerQty = api
                       //     .column( 4 )
                       //     .data()
                       //     .reduce( function (a, b) {
                       //         return intVal(a) + intVal(b);
                       //     }, 0 );
                       //
                       // var eventQty = api
                       //     .column( 5 )
                       //     .data()
                       //     .reduce( function (a, b) {
                       //         return intVal(a) + intVal(b);
                       //     }, 0 );
                       //
                       // var otherQty = api
                       //     .column( 6 )
                       //     .data()
                       //     .reduce( function (a, b) {
                       //         return intVal(a) + intVal(b);
                       //     }, 0 );
                       //

                       // $('#dtBreakfastQty').val(breakfastQty)
                       // $('#dtLunchQty').val(lunchQty)
                       // $('#dtDinnerQty').val(dinnerQty)
                       // $('#dtEventQty').val(eventQty)
                       // $('#dtOtherQty').val(otherQty)

                   }
                });






                $('#dailyExtraOrderDatatable').DataTable({
                    serverSide: true,
                    ajax: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{url("admin/officer-respective-extra-orders")}}',
                        type: "POST",
                        data: {filter_dt:filter_dt},
                        dataType: "json",
                        rowId: 'id'
                    },
                    columns: [
                        {
                            "data": null, "render": function (data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {data: 'name_according_to_part2', name: 'name_according_to_part2'},
                        {data: 'item_name', name: 'item_name'},
                        {data: 'qty', name: 'qty'},
                        // {data: 'meal_time', name: 'meal_time'},
                        {
                            "mRender": function (data, group, full, meta) {

                                if (full.category_id==4)
                                {
                                    if (full.meal_time==1)
                                    {
                                        return '0600 Hrs'
                                    }
                                    if (full.meal_time==2)
                                    {
                                        return '1000 Hrs'
                                    }
                                    if (full.meal_time==3)
                                    {
                                        return '1500 Hrs'
                                    }
                                    if (full.meal_time==4)
                                    {
                                        return 'Other'
                                    }
                                }
                                else
                                {
                                    if (full.meal_time==1)
                                    {
                                        return 'Breakfast'
                                    }
                                    if (full.meal_time==2)
                                    {
                                        return 'Lunch'
                                    }
                                    if (full.meal_time==3)
                                    {
                                        return 'Dinner'
                                    }
                                    if (full.meal_time==4)
                                    {
                                        return 'Other'
                                    }
                                }
                            }
                        },
                        {data: 'note', name: 'note'},
                        {
                            "mRender": function (data, group, full, meta) {

                                return '<button class="btn btn-danger btn-sm btn-dark btn-extra-cancel">Cancel Order</button>';

                            }
                        },
                        // {data: 'otherOrders', name: 'otherOrders'},
                    ]
                });

            }


            //approve
            {{--$(document).on('click', '.btn-ration-order-approve', function (e) {--}}
                {{--e.preventDefault();--}}

                {{--let rowId = $(this).closest('tr').attr('id');--}}

                {{--if (confirm('Accept order?')) {--}}

                    {{--$.ajax({--}}
                    {{--headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},--}}
                    {{--dataType: 'json',--}}
                    {{--url: '{{route("accept-ration-order")}}',--}}
                    {{--type: 'post',--}}
                    {{--data: {rowId:rowId},--}}
                    {{--success: function (response) {--}}

                        {{--alert('Order Accepted')--}}
                        {{--location.reload()--}}

                    {{--},--}}
                    {{--error: function (error) {--}}
                    {{--}--}}
                    {{--});--}}
                {{--}--}}

            {{--});--}}


            //ration order cancel
            $(document).on('click', '.btn-breakfast-cancel', function (e) {
                e.preventDefault();
                let rowId = $(this).closest('tr').attr('id');

                // if (confirm('Cancel order?')) {
                //     cancelRations(rowId,'breakfast')
                // }

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
                        cancelRations(rowId,'breakfast')
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })

            });
            $(document).on('click', '.btn-lunch-cancel', function (e) {
                e.preventDefault();
                let rowId = $(this).closest('tr').attr('id');

                // if (confirm('Cancel order?')) {
                //     cancelRations(rowId,'lunch')
                // }

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
                        cancelRations(rowId,'lunch')
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            });
            $(document).on('click', '.btn-dinner-cancel', function (e) {
                e.preventDefault();
                let rowId = $(this).closest('tr').attr('id');

                // if (confirm('Cancel order?')) {
                //     cancelRations(rowId,'dinner')
                // }


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
                        cancelRations(rowId,'dinner')
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            });
            $(document).on('click', '.btn-event-cancel', function (e) {
                e.preventDefault();
                let rowId = $(this).closest('tr').attr('id');
                // if (confirm('Cancel order?')) {
                //     cancelRations(rowId,'event')
                // }

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
                        cancelRations(rowId,'event')
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })

            });
            $(document).on('click', '.btn-other-cancel', function (e) {
                e.preventDefault();
                let rowId = $(this).closest('tr').attr('id');
                // if (confirm('Cancel order?')) {
                //     cancelRations(rowId,'other')
                // }

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
                        cancelRations(rowId,'other')
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            });
            $(document).on('click', '.btn-extra-cancel', function (e) {
                e.preventDefault();
                let rowId = $(this).closest('tr').attr('id');
                // if (confirm('Cancel order?')) {
                //     cancelRations(rowId,'extra')
                // }

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
                        cancelRations(rowId,'extra')
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            });



            function cancelRations(rowId,type) {

                let rationDate = $('#filter_dt').val();

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route("cancel-ration-order")}}',
                    type: 'post',
                    data: {rowId:rowId, meal_time:type, rationDate:rationDate},
                    success: function (response) {

                        // alert('Order Cancelled')
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Order Cancelled',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function(){
                            location.reload()
                        }, 1500);


                    },
                    error: function (error) {
                    }
                });
            }

        });

    </script>

@endpush

@push('page_css')
    <style>
        #dailyExtraOrderDatatable_wrapper .dt-buttons{
            display: none !important;
        }

        #dailyRationDatatable_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush



