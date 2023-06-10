@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Mess Billing
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="officer" class="form-label">Select Date</label>
                            <input type="text" autocomplete="off" placeholder="Date" class="form-control datepicker order_date" name="order_date" id="datepicker1">
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="form-group">
                            <button class="btn btn-primary float-right order-report-btn" type="button" id="order_report_search">Search</button>
                        </div>
                    </div>

                </div>
                                
                <div id="billing_div">

                    <div class="messing">
                        <h5>Messing</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Menu Name</th>
                                    <th>Menu Type</th>
                                    <th>Meal Type</th>
                                    <th>Tentative Price</th>
                                    <th>Updated Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            </tbody>
                        </table>
                    </div>

                    <div class="extra_messing">
                        <h5>Extra Messing</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Officer No</th>
                                    <th>Item Name</th>
                                    <th>Tentative Price</th>
                                    <th>Updated Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            </tbody>
                        </table>
                    </div>

                    <div class="tea">
                        <h5>Tea</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    <th>Officer No</th>
                                    <th>Item Name</th>
                                    <th>Tentative Price</th>
                                    <th>Updated Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbody">
                            </tbody>
                        </table>
                    </div>  
 
                </div>

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



            //// MESSING ////
            // Show Messing Ordered Details
            $("#order_report_search").click(function() {

                $('#billing_div').show()
                var date = $('#datepicker1').val()
                // Load Details
                $.ajax({
                    url:"{{ url('') }}/admin/billing_messing",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , date:date },
                    success:function(data){
                        $('.messing .tbody').html(data)
                    }
                });
            });
            // Show Messing Ordered Details

            // Update Price
            $(document).on("click",".update_m",function() {

                var order_id = $(this).attr('id')

                var updated_price = $(this).siblings('.updated_price').val()

                $(this).parent('div').parent('td').siblings('.updated_price_td').html("Rs. " + updated_price)
                
                $(this).siblings('.updated_price').val('') // clear field

                $.ajax({
                    url:"{{ url('') }}/admin/billing_messing_update",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , order_id:order_id , updated_price:updated_price },
                    success:function(data){
                        
                    }
                });
            });
            // Update Price

            // Update Price with Same Value
            $(document).on("click",".update_same_m",function() {

                var order_id = $(this).attr('id')

                var updated_price = $(this).attr("data-price")
     
                $(this).parent('div').parent('td').siblings('.updated_price_td').html("Rs. " + updated_price) // chnage td field value
                
                $(this).siblings('.updated_price').val('') // clear field

                $.ajax({
                    url:"{{ url('') }}/admin/billing_messing_update",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , order_id:order_id , updated_price:updated_price },
                    success:function(data){
                        
                    }
                });
            });
            // Update Price with Same Value

            //// MESSING ////







            //// EXTRA MESSING ////
            // Show Extra Messing Ordered Details
            $("#order_report_search").click(function() {
                var date = $('#datepicker1').val()
                // Load Details
                $.ajax({
                    url:"{{ url('') }}/admin/billing_extra_messing",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , date:date },
                    success:function(data){
                        $('.extra_messing .tbody').html(data)
                    }
                });
            });
            // Show Extra Messing Ordered Details

            // Update Price
            $(document).on("click",".update_em",function() {

                var order_id = $(this).attr('id')

                var updated_price = $(this).siblings('.updated_price').val()

                $(this).parent('div').parent('td').siblings('.updated_price_td').html("Rs. " + updated_price)
                
                $(this).siblings('.updated_price').val('') // clear field

                $.ajax({
                    url:"{{ url('') }}/admin/billing_extra_messing_update",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , order_id:order_id , updated_price:updated_price },
                    success:function(data){
                        
                    }
                });
            });
            // Update Price


            // Update Price with Same Value
            $(document).on("click",".update_same_em",function() {

                var order_id = $(this).attr('id')

                var updated_price = $(this).attr("data-price")
     
                $(this).parent('div').parent('td').siblings('.updated_price_td').html("Rs. " + updated_price) // chnage td field value
                
                $(this).siblings('.updated_price').val('') // clear field

                $.ajax({
                    url:"{{ url('') }}/admin/billing_extra_messing_update",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , order_id:order_id , updated_price:updated_price },
                    success:function(data){
                        
                    }
                });
            });
            // Update Price with Same Value
            //// EXTRA MESSING ////





            //// TEA ////
            // Show Tea Ordered Details
            $("#order_report_search").click(function() {
                var date = $('#datepicker1').val()
                // Load Details
                $.ajax({
                    url:"{{ url('') }}/admin/billing_tea",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , date:date },
                    success:function(data){
                        $('.tea .tbody').html(data)
                    }
                });
            });
            // Show Tea Ordered Details

            // Update Price
            $(document).on("click",".update_tea",function() {

                var order_id = $(this).attr('id')

                var updated_price = $(this).siblings('.updated_price').val()

                $(this).parent('div').parent('td').siblings('.updated_price_td').html("Rs. " + updated_price)
                
                $(this).siblings('.updated_price').val('') // clear field

                $.ajax({
                    url:"{{ url('') }}/admin/billing_tea_update",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , order_id:order_id , updated_price:updated_price },
                    success:function(data){
                        
                    }
                });
            });
            // Update Price


            // Update Price with Same Value
            $(document).on("click",".update_same_tea",function() {

                var order_id = $(this).attr('id')

                var updated_price = $(this).attr("data-price")
     
                $(this).parent('div').parent('td').siblings('.updated_price_td').html("Rs. " + updated_price) // chnage td field value
                
                $(this).siblings('.updated_price').val('') // clear field

                $.ajax({
                    url:"{{ url('') }}/admin/billing_tea_update",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , order_id:order_id , updated_price:updated_price },
                    success:function(data){
                        
                    }
                });
            });
            // Update Price with Same Value
            //// TEA ////





            //// TEA ////
            // Show tea Details
            // $("#order_report_search").click(function() {
            //     var date = $('#datepicker1').val()
            //     // Load Details
            //     $.ajax({
            //         url:"{{ url('') }}/admin/billing_tea",
            //         method:'POST',
            //         data:{ "_token": "{{ csrf_token() }}" , date:date },
            //         success:function(data){
            //             $('.tea .tbody').html(data)
            //         }
            //     });
            // });
            // // Show tea Details

            // // Update Price
            // $(document).on("click",".update_tea",function() {

            //     var item_price_id = $(this).attr('id')

            //     var updated_price = $(this).siblings('.updated_price').val()

            //     $(this).parent('div').parent('td').siblings('.updated_price_td').html("Rs. " + updated_price)
                
            //     $(this).siblings('.updated_price').val('') // clear field

            //     $.ajax({
            //         url:"{{ url('') }}/admin/billing_tea_update",
            //         method:'POST',
            //         data:{ "_token": "{{ csrf_token() }}" , item_price_id:item_price_id , updated_price:updated_price },
            //         success:function(data){
                        
            //         }
            //     });
            // });
            // Update Price
            //// TEA ////











            


        });

    </script>

@endpush

@push('page_css')

@endpush

