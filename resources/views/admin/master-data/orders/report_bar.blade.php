@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Bar Orders Report
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

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="officer" class="form-label">Officers</label>
                                        <select id="officer"
                                                class="select2-single form-control" name="officer">
                                            <option value="">Select the name</option>
                                            @foreach($officers as $officer)
                                                <option value="{{$officer->email}}">{{ $officer->name_according_to_part2 .' - '. $officer->email}}</option>
                                            @endforeach

                                        </select>
                                        @error('item')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="officer" class="form-label">Date From</label>
                                        <input type="text" autocomplete="off" placeholder="From Date" class="form-control datepicker order_date" name="order_date" id="datepicker1">
                                        @error('item')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="officer" class="form-label">Date To</label>
                                        <input type="text" autocomplete="off" placeholder="From Date" class="form-control datepicker order_date" name="order_date" id="datepicker2">
                                        @error('item')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button class="btn btn-primary float-right order-report-btn" type="button" id="order_report_search">Search</button>
                                    </div>
                                </div>


                            </div>

                        </form>
                                
                        <div id="mess_bill_report_div"></div>

            </div>

        </div>

    </div>
    
@endsection

@push('scripts')    

    <script src="{{asset('/js/datepicker/datepicker.js')}}"></script>

    <script>

        $(document).ready(function () {
    
            const weekday = ["Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday",];
            //date picker
            $('.datepicker').datepicker({
                format: 'YYYY-MM-DD',
                autoclose: true,
                // endDate: '0d'
            })
            .datepicker("setDate", new Date()).on('keypress keydown paste change', function (e) {
                $('.datepicker').datepicker('hide');
            });



            $("#order_report_search").click(function() {

                var officer_enum = $('#officer').val()

                if (officer_enum == "") {
                    $('#mess_bill_report_div').html('<p class="no_data alert alert-danger">Please Select the Officer Name</p>');
                }
                else{
                    var date1 = $('#datepicker1').val() 
                    var date2 = $('#datepicker2').val()
                    var enumber = $('#officer').val()

                    $.ajax({
                        url:"{{ url('') }}/admin/bar_order_details",
                        method:'POST',
                        data:{ "_token": "{{ csrf_token() }}" , enumber:enumber , date1:date1 , date2:date2 },
                        success:function(data){
                            if (data == null) {
                                console.log('Summary Report is not Available')
                            }
                            else{
                                $('#mess_bill_report_div').html(data);
                            }
                        }
                    });
                }


            
            });

        });

    </script>

@endpush

@push('page_css')

@endpush

