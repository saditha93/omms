@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Bill Payments
            </div>
            <div class="card-body">

                <form method="POST" action="" id="orderForm">
                    @csrf

                    <div class="row">

                        <p class="general_alert general_alert_fail alert alert-danger"></p>
                        <p class="general_alert general_alert_success alert alert-success"></p>
                                    
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="officer" class="form-label">Officer</label>
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
                                <label for="remaining_bal" class="form-label">Remaining Balance</label>
                                <input id="remaining_bal" name="remaining_bal" type="text" placeholder="" class="form-control" disabled>
                            </div>
                        </div>  

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="officer" class="form-label">Date</label>
                                <input type="text" autocomplete="off" placeholder="From Date" class="form-control datepicker order_date" name="order_date" id="datepicker1">
                                @error('item')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="payment_value" class="form-label">Amount</label>
                                <input id="payment_value" name="payment_value" type="number" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note" class="form-label">Note</label>
                                <textarea id="note" name="note" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary float-right order-report-btn mt-0" type="button" id="bill_pay">Pay</button>
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



            $("#bill_pay").click(function() {

                var officer_enum = $('#officer').val()
                var amount = $('#payment_value').val()

                if (officer_enum == "" || amount == "" ) {
                    $('.general_alert_fail').show() 
                    $('.general_alert_fail').html('Please Insert all the Details')
                    setTimeout(hideMsg, 1500);
                    function hideMsg() { 
                        $('.general_alert_fail').fadeOut()
                    }  
                }
  
                else{
                    var date1 = $('#datepicker1').val() 
                    var note = $('#note').val()

                    $.ajax({
                        url:"{{ url('') }}/admin/bill_payment",
                        method:'POST',
                        data:{ "_token": "{{ csrf_token() }}" , enumber:officer_enum , date1:date1 , amount:amount , note:note },
                        success:function(data){
                            if (data == 'success') {
                                console.log('')
                                $('.general_alert_success').show() 
                                $('.general_alert_success').html('Data has been added Successfully')
                                setTimeout(hideMsg, 1500);
                                function hideMsg() { 
                                    $('.general_alert_success').fadeOut()
                                }

                                $("#officer").prop("selectedIndex", 0);
                                $('#remaining_bal').val("")
                                $('#payment_value').val("")
                                $('#note').val("")           
                            }
                            else{
                                console.log('')
                                $('.general_alert_fail').show() 
                                $('.general_alert_fail').html('Database Error')
                                setTimeout(hideMsg, 1500);
                                function hideMsg() { 
                                    $('.general_alert_fail').fadeOut()
                                }
                            }
                        }
                    });
                }

            });


            // Get remaining balance
            $('#officer').on('change', function() { // ok

                var enumber = $('#officer').val()

                $.ajax({
                    url:"{{ url('') }}/admin/remaining_payment",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , enumber:enumber},
                    success:function(data){
                        console.log(data)
                        if (data == "nodata") {
                            $('#remaining_bal').val("")
                        }
                        else{
                            $('#remaining_bal').val("Rs: " + data )
                        }
                    }
                });

            });

            


        });

    </script>

@endpush

@push('page_css')

@endpush

