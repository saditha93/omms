@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Lunch Orders
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

                <table id="allLunchTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Index</th>
                        <th>Officer Name</th>
                        <th>Date</th>
                        <th>Menu</th>
                        <th>Qty</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

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
                .datepicker("setDate",new Date()).on('keypress keydown paste change', function (e) {
                $('.datepicker').datepicker('hide');
            });

            lunch($('#fromDate').val(),$('#toDate').val());


            $(document).on('click', '#dateFilter', function (e) {
                let fromDate = $('#fromDate').val();
                let toDate = $('#toDate').val();
                //destroy datatable and call
                $('#allLunchTbl').DataTable().destroy();
                lunch(fromDate,toDate);
            });

            function lunch(fromDate='',toDate='')
            {
                //dtaTable
                $('#allLunchTbl').DataTable({
                    // responsive: true,
                    // processing: true,
                    serverSide: true,
                    ajax: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{url("admin/get-all-lunch")}}',
                        type: "POST",
                        data: {fromDate:fromDate, toDate:toDate},
                        dataType: "json",
                    },
                    columns: [
                        {
                            "data": null, "render": function (data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {data: 'name', name: 'name'},
                        {data: 'ration_date', name: 'ration_date'},
                        {data: 'menu_name', name: 'menu_name'},
                        {data: 'order_lunch', name: 'order_lunch'},

                    ]
                });



            }
        });
    </script>

@endpush

@push('page_css')
    <style>
        #allLunchTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush

