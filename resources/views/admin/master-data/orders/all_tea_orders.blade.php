@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Tea Orders
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

                <table id="allteaTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Index</th>
                        <th>Officer Name</th>
                        <th>Tea Item</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Note</th>
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

            tea($('#fromDate').val(),$('#toDate').val());


            $(document).on('click', '#dateFilter', function (e) {
                let fromDate = $('#fromDate').val();
                let toDate = $('#toDate').val();
                //destroy datatable and call
                $('#allteaTbl').DataTable().destroy();
                tea(fromDate,toDate);
            });

            function tea(fromDate='',toDate='')
            {
                //dtaTable
                $('#allteaTbl').DataTable({
                    // responsive: true,
                    // processing: true,
                    serverSide: true,
                    ajax: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{url("admin/get-all-tea")}}',
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
                        {data: 'name_according_to_part2', name: 'name_according_to_part2'},
                        {data: 'item_name', name: 'item_name'},
                        {
                            "mRender": function (data, group, full, meta) {

                                let mealTime = '';
                               if(full.meal_time==1){mealTime = "0600 Hrs"}
                               if(full.meal_time==2){mealTime = "1000 Hrs"}
                               if(full.meal_time==3){mealTime = "1500 Hrs"}
                               if(full.meal_time==4){mealTime = "Other"}

                               return mealTime;

                            }
                        },
                        {data: 'ordered_date', name: 'ordered_date'},
                        {data: 'note', name: 'note'},
                        {data: 'qty', name: 'qty'},

                    ]
                });



            }
        });
    </script>

@endpush

@push('page_css')
    <style>
        #allteaTbl_wrapper .dt-buttons{
            display: none !important;
        }

    </style>
@endpush
