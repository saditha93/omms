<!DOCTYPE html>
<html lang="en">
<head>
    @include('app_mobile/inc/links')
    <title>Messing</title>
</head>
<body>
    
    <div class="dashboard_main">
        
        <div id="dashboard_main_topbar" class="dashboard_topbar dashboard_main_topbar">
            @include('app_mobile/inc/header')
        </div>


        <div id='messing' class="dashboard dashboard_messing">

            <div class="dashboard_in">
            
                <div class="statusbox">
                    <input id="today_orders" class="add_button btn btn-success" type="button" value="View Today Orders">
                    <div class="status">
                        <div class="status_all breakfast_status">
                            <div class="count">
                                <p>You have ordered</p>
                                <div>
                                    <span id="breakfast_count">0</span><p>Breakfast Today</p>
                                </div>
                            </div>
                            <div class="lbl">
                                <span id="breakfast_status_msg"></span>
                            </div>
                        </div>

                        <div class="status_all lunch_status">
                            <div class="count">
                                <p>You have ordered </p>
                                <div>
                                    <span id="lunch_count">0</span><p>Lunch Today</p>
                                </div>
                            </div>
                            <div class="lbl">
                                <span id="lunch_status_msg"></span>
                            </div>
                        </div>

                        <div class="status_all dinnner_status">
                            <div class="count">
                                <p>You have ordered </p>
                                <div>
                                    <span id="dinner_count">0</span><p>Dinnner Today</p>
                                </div>
                            </div>
                            <div class="lbl">
                                <span id="dinner_status_msg"></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="title">
                    <div class="imgdiv">
                        <div class="imgdivin">
                            <img src="{{ asset('img/messing.png')}}" alt="">
                        </div>
                    </div>
                    <h1>Messing</h1>
                </div>
                <div class="inputs messing_inputs">


                    <div class="search_fields">
                        <div class="calander">
                            <label for="datepicker" class="col-1 col-form-label">Select Date</label>
                            <input class="datepicker_messing form-control" id="datepicker" type="text">
                            <script>
                                    
                                //Today Date
                                var today_date = new Date();
                                var dd = String(today_date.getDate()).padStart(2, '0');
                                var mm = String(today_date.getMonth() + 1).padStart(2, '0');
                                var yyyy = today_date.getFullYear();

                                const picker = MCDatepicker.create({
                                    el: '#datepicker',
                                    dateFormat: 'yyyy-mm-dd',
                                    theme: {
                                        theme_color: '#000024'
                                    },
                                    minDate: new Date(yyyy, mm-1, dd),
                                    jumpOverDisabled: false,
                                });    
         
                                     
                            </script>
                        </div>

                        <div class="search_dv">
                            <input id="search" class="add btn btn-success" type="button" value="Search">
                        </div>
                    </div>


                    <div class="populated_fields">
                            
                        <div class="important">
                            <p>These are tentative listings. The menu and Price can be changed.</p>
                        </div>
                    
                        <div class="sec breakfast">

                            <h5 class="sub_ttl">Breakfast
                                <!-- <span id="booking_date_breakfast" class="date"></span>  -->
                                <span id="order_before_breakfast" class="order_before"></span>
                            </h5>
                            <div class="sec_in">

                                <div class="sec_left">
                                        <div class="sec vege">
                                            <div class="cont">
                                                <div class="meal contin">
                                                    <h3>Meal</h3>
                                                    <p id="breakfast_meal"></p>
                                                </div>
                                                <div class="dessert contin">
                                                    <h3>Dessert</h3>
                                                    <p id="breakfast_dessert"></p>
                                                </div>
                                                <div class="price">
                                                    <h5>Tentative Price : </h5>
                                                        <span class="price_tag" id="price_breakfast"></span>
                                                </div>
                                            </div>
                                            <div class="add">
                                                <div class="dv2"><input id="add_breakfast_value" class="messing_value form-control" type="number" value="" placeholder="Enter No of Meals" min="1">
                                                </div>
                                            </div>
                                        </div>
                                </div>

                            </div>
                        </div>



                        <div class="sec lunch">
                            <h5 class="sub_ttl">Lunch
                                <span id="order_before_lunch" class="order_before"></span>
                            </h5>
                            <div class="sec_in">

                                <div class="sec_left">
                                        <div class="sec vege">
                                            <div class="cont">
                                                <div class="meal contin">
                                                    <h3>Meal</h3>
                                                    <p id="lunch_meal"></p>
                                                </div>
                                                <div class="dessert contin">
                                                    <h3>Dessert</h3>
                                                    <p id="lunch_dessert"></p>
                                                </div>
                                                <div class="price">
                                                    <h5>Tentative Price : </h5>
                                                    <span class="price_tag" id="price_lunch"></span>
                                                </div>
                                            </div>
                                            <div class="add">
                                                <div class="dv2"><input id="add_lunch_value" class="messing_value form-control" type="number" value="" placeholder="Enter No of Meals" min="1">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>                        



                        <div class="sec dinner">
                            <h5 class="sub_ttl">Dinner
                                <span id="order_before_dinner" class="order_before"></span>
                            </h5>
                            <div class="sec_in">

                                <div class="sec_left">
                                        <div class="sec vege">
                                            <div class="cont">
                                                <div class="meal contin">
                                                    <h3>Meal</h3>
                                                    <p id="dinner_meal"></p>
                                                </div>
                                                <div class="dessert contin">
                                                    <h3>Dessert</h3>
                                                    <p id="dinner_dessert"></p>
                                                </div>
                                                <div class="price">
                                                    <h5>Tentative Price : </h5>
                                                    <span class="price_tag" id="price_dinner"></span>
                                                </div>
                                            </div>
                                            <div class="add">
                                                <div class="dv2"><input id="add_dinner_value" class="messing_value form-control" type="number" value="" placeholder="Enter No of Meals" min="1">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>  



                        <div class="order">
                            <label id="success_msg" class="success_msg _msg" for="">The order has been placed successfully</label>
                            <label id="error_msg" class="error_msg _msg" for="">Please enter the number of meals</label>
                            <div class="msg">
                                <h3></h3>
                            </div>
                            <input id="add_messing" class="add_button btn btn-success" type="button" value="Order">
                        </div>




                        


                    </div>



                </div>
            </div>

        </div>

        

        <div class="footer">
            @include('app_mobile/inc/footer')
        </div>

        <div class="popup">
            <p>Prices are not been updated yet. Please check again later!</p>
            <input id="popup_close" class="add btn btn-success" type="button" value="Ok">
        </div>


    </div>                       

<script type="text/javascript">

    $(document).ready(function() {

        //Today Date
        var today_date = new Date();
        var dd = String(today_date.getDate()).padStart(2, '0');
        var mm = String(today_date.getMonth() + 1).padStart(2, '0');
        var yyyy = today_date.getFullYear();
        today_date_new = yyyy + "-" + mm + "-" + dd ;
        $('#datepicker').val(today_date_new)

        // Time Now
        //var t1 = today_date.getTime()
        //console.log(t1)

        var hours = today_date.getHours();
        var minutes = today_date.getMinutes();




        // Get order status
        var selected_date = $('#datepicker').val()

        function OrderStatus(){
            $.ajax({
            url:"{{ url('') }}/app_mobile/get_status_messing",
            method:'POST',
            data:{ "_token": "{{ csrf_token() }}" , date_value:selected_date },
            dataType: 'json',
            success:function(data){
                if ( data == "nodata" ) { 
                    $("#breakfast_count").html( '0' )
                    $("#lunch_count").html( '0' )
                    $("#dinner_count").html( '0' )
                    $("#breakfast_status_msg").hide();
                    $("#lunch_status_msg").hide();
                    $("#dinner_status_msg").hide();
                }
                else{
                    if (data.order_breakfast == "" || data.order_breakfast == null || data.order_breakfast == '0' ) {
                        $("#breakfast_count").html( '0' )
                        $("#breakfast_status_msg").hide();
                    }
                    else{
                        $("#breakfast_status_msg").show()
                        $("#breakfast_count").html( data.order_breakfast )
                        // $('.breakfast').css('opacity','0.4') // Add opacity, if alredy placed an order
                        $("#add_breakfast_value").attr("placeholder", "Enter New Order Value"  );
                    }

                    if (data.breakfast_status == '0') { // 0 = pending order/notification visible
                        $("#breakfast_status_msg").html('Pending')
                        $("#breakfast_status_msg").removeClass();
                        $("#breakfast_status_msg").addClass('pending');
                    }
                    else if (data.breakfast_status == '1') { // 1 = oder confirmed/notification hidden
                        $("#breakfast_status_msg").html('Confirmed')
                        $("#breakfast_status_msg").removeClass();
                        $("#breakfast_status_msg").addClass('confirmed');
                    }
                    else if (data.breakfast_status == null) { // null = order cancelled
                        $("#breakfast_status_msg").html('Cancelled')
                        $("#breakfast_status_msg").removeClass();
                        $("#breakfast_status_msg").addClass('not_confirmed');
                    }

                    //----//

                    if (data.order_lunch == "" || data.order_lunch == null || data.order_lunch == '0' ) {
                        $("#lunch_count").html( '0' )
                        $("#lunch_status_msg").hide()
                    }
                    else{
                        $("#lunch_status_msg").show()
                        $("#lunch_count").html( data.order_lunch )
                        // $('.lunch').css('opacity','0.4')
                        $("#add_lunch_value").attr("placeholder", "Enter New Order Value"  );
                    }

                    if (data.lunch_status == '0') { // 0 = pending order/notification visible
                        $("#lunch_status_msg").html('Pending')
                        $("#lunch_status_msg").removeClass();
                        $("#lunch_status_msg").addClass('pending');
                    }
                    else if (data.lunch_status == '1') { // 1 = oder confirmed/notification hidden
                        $("#lunch_status_msg").html('Confirmed')
                        $("#lunch_status_msg").removeClass();
                        $("#lunch_status_msg").addClass('confirmed');
                    }
                    else if (data.lunch_status == null) { // null = order cancelled
                        $("#lunch_status_msg").html('Cancelled')
                        $("#lunch_status_msg").removeClass();
                        $("#lunch_status_msg").addClass('not_confirmed');
                    }

                    //----//
                    if (data.order_dinner == "" || data.order_dinner == null || data.order_dinner == '0' ) {
                        $("#dinner_count").html( '0' )
                        $("#dinner_status_msg").hide()
                    }
                    else{
                        $("#dinner_status_msg").show()
                        $("#dinner_count").html( data.order_dinner )
                        // $('.dinner').css('opacity','0.4')
                        $("#add_dinner_value").attr("placeholder", "Enter New Order Value"  );
                    }

                    if (data.dinner_status == '0') { // 0 = pending order/notification visible
                        $("#dinner_status_msg").html('Pending')
                        $("#dinner_status_msg").removeClass();
                        $("#dinner_status_msg").addClass('pending');
                    }
                    else if (data.dinner_status == '1') { // 1 = oder confirmed/notification hidden
                        $("#dinner_status_msg").html('Confirmed')
                        $("#dinner_status_msg").removeClass();
                        $("#dinner_status_msg").addClass('confirmed');
                    }
                    else if (data.dinner_status == null) { // null = order cancelled
                        $("#dinner_status_msg").html('Cancelled')
                        $("#dinner_status_msg").removeClass();
                        $("#dinner_status_msg").addClass('not_confirmed');
                    }

                }
            }
            }); 
        }
        // Get order status
        

        OrderStatus();


        $("#search").click(function(){

            $('.msg>h3').html('')
            $('.statusbox').show()

            var selected_date = $('#datepicker').val()

            // hours = 0 // Enable all 3 menu for testing purpose
            // today_date_new = "2023-04-05"; // custom date for testing purpose
            // hours = 22; // custom hours for testing purpose

            // 1. Get Menu & Dessert & Price & Time - Breakfast
            $('.breakfast').hide();
            $('.msg').hide();
            $.ajax({
                url:"{{ url('') }}/app_mobile/menu_breakfast",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , date:selected_date
                },
                success:function(data){
                    console.log("*****Menu(Breakfast)***** " + data + " *****Menu(Breakfast)*****")
                    
                    if (data == null || data == " " || data == "") {
                        $('.msg').show();
                        $('.msg>h3').append('<span>No Menu Available for Breakfast</span>');
                        $('.important').hide() // Hide Tentative Msg
                    }
                    else{
                        $('.breakfast').show();
                        $("#breakfast_meal").html(data)
                        $('#add_messing').show(); // Show Add Messing Button
                        $('.important').show() // Show Tentative Msg
                    }
                }
            });

            $.ajax({
                url:"{{ url('') }}/app_mobile/dessert_breakfast",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , date:selected_date},
                success:function(data){
                    if (data != "" || data != null ) { // Has data
                        $("#breakfast_dessert").html("<span><i></i>" + data + "</span>")
                    }
                }
            });

            $.ajax({
                url:"{{ url('') }}/app_mobile/price_breakfast",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , date:selected_date},
                success:function(data){
                    if (data != "" || data != null ) { // Has data
                        $("#price_breakfast").html( "<span>Rs.</span>" + data  )
                    }
                    else{ // No data
                        $("#price_breakfast").html( "<span>Rs.</span>" + "N/A" )
                    }

                    if (data == '0' ) { // No data. Equal to 0
                        $("#price_breakfast").html( "<span>Rs.</span>" + "N/A" )
                    }
                }
            });

            $.ajax({
                url:"{{ url('') }}/app_mobile/time_breakfast",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" },
                success:function(data){
                    if (data != "" || data != null ) { // Has data
                        $("#order_before_breakfast").html("Order before : " + data + " hours")
   
                        var splt_time = data.split(':')
                        var fix_hr = splt_time[0]
                        var fix_min = splt_time[1]

                        // Hide Sections according to order before time
                        if (selected_date == today_date_new) { // user selected date as today

                            if (hours && fix_hr > 12) { // user check the meal in evening. after 12
                                $('#add_breakfast').prop("disabled",true);
                                $('#add_breakfast_value').prop("disabled",true);
                                $('.breakfast').css('opacity','0.3')
                            }
                            else{ // user check the meal in morning. before 12

                                if (hours >= fix_hr ) { // hours equal or exeed

                                    if (hours == fix_hr) { // hours equal

                                        if (minutes > fix_min) { // minutes exceed
                                            $('#add_breakfast').prop("disabled",true);
                                            $('#add_breakfast_value').prop("disabled",true);
                                            $('.breakfast').css('opacity','0.3')
                                        }
                                        else{ // minutes not exceed
                                            $('#add_breakfast').prop("disabled",false);
                                            $('#add_breakfast_value').prop("disabled",false);
                                            $('.breakfast').css('opacity','1')  
                                        }
                                    }
                                    else{ // hours exeed
                                        $('#add_breakfast').prop("disabled",true);
                                        $('#add_breakfast_value').prop("disabled",true);
                                        $('.breakfast').css('opacity','0.3')
                                    }
                                } 
                                else{ // time not exeed
                                    $('#add_breakfast').prop("disabled",false);
                                    $('#add_breakfast_value').prop("disabled",false);
                                    $('.breakfast').css('opacity','1')
                                }

                            }


                        }
                        else{ // user selected another date. tommorow or up comming date.

                            if (hours && fix_hr > 12) { // user check tommorow breakfast menu
                                if (fix_hr < hours) { // time limit is exceeded
                                    $('#add_breakfast').prop("disabled",true);
                                    $('#add_breakfast_value').prop("disabled",true);
                                    $('.breakfast').css('opacity','0.3')
                                }
                                else{ // time limit is not exceeded
                                    $('#add_breakfast').prop("disabled",false);
                                    $('#add_breakfast_value').prop("disabled",false);
                                    $('.breakfast').css('opacity','1')
                                }
                            }
                            else{
                                $('#add_breakfast').prop("disabled",false);
                                $('#add_breakfast_value').prop("disabled",false);
                                $('.breakfast').css('opacity','1')  
                            }
                        }
                        // Hide Sections according to order before time

                    }
                }
            });
            // 1. Get Menu & Dessert & Price & Time - Breakfast



            // 2. Get Menu & Dessert & Price & Time - Lunch
            $('.lunch').hide();
            $('.msg').hide();
            $.ajax({
                url:"{{ url('') }}/app_mobile/menu_lunch",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , date:selected_date},

                success:function(data){
                    console.log("*****Menu(Lunch)***** " + data + " *****Menu(Lunch)*****")
                    
                    if (data == null || data == " " || data == "") {
                        $('.msg').show();
                        $('.msg>h3').append('<span>No Menu Available for Lunch</span>');
                        $('.important').hide()
                    }
                    else{
                        $('.lunch').show();
                        $("#lunch_meal").html(data)
                        $('#add_messing').show();
                        $('.important').show()
                    }
                }

            });

            $.ajax({
                url:"{{ url('') }}/app_mobile/dessert_lunch",
                method:'POST',
                data:{"_token": "{{ csrf_token() }}" , date:selected_date},
                success:function(data){
                    if (data != "" || data != null ) { // Has data
                        $("#lunch_dessert").html("<span><i></i>" + data + "</span>")
                    }
                }
            });

            $.ajax({
                url:"{{ url('') }}/app_mobile/price_lunch",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , date:selected_date},
                success:function(data){
                    if (data != "" || data != null ) { // Has data
                        $("#price_lunch").html( "<span>Rs.</span>" + data  )
                    }
                    else{ // No data
                        $("#price_lunch").html( "<span>Rs.</span>" + "N/A" )
                    }

                    if (data == '0' ) { // No data. Equal to 0
                        $("#price_lunch").html( "<span>Rs.</span>" + "N/A" )
                    }
                }
            });      
            
            $.ajax({
                url:"{{ url('') }}/app_mobile/time_lunch",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" },
                success:function(data){
                    if (data != "" || data != null ) { // Has data
                        $("#order_before_lunch").html("Order before : " + data + " hours")

                        var splt_time = data.split(':')
                        var fix_hr = splt_time[0]
                        var fix_min = splt_time[1]

                        // Hide Sections according to order before time
                        if (selected_date == today_date_new) {

                            if (hours >= fix_hr ) { // hours equal or exeed

                                if (hours == fix_hr) { // hours equal

                                    if (minutes > fix_min) { // minutes exceed
                                        $('#add_lunch').prop("disabled",true);
                                        $('#add_lunch_value').prop("disabled",true);
                                        $('.lunch').css('opacity','0.3')
                                    }
                                    else{ // minutes not exceed
                                        $('#add_lunch').prop("disabled",false);
                                        $('#add_lunch_value').prop("disabled",false);
                                        $('.lunch').css('opacity','1')  
                                    }
                                }
                                else{ // hours exeed
                                    $('#add_lunch').prop("disabled",true);
                                    $('#add_lunch_value').prop("disabled",true);
                                    $('.lunch').css('opacity','0.3')
                                }
                            } 
                            else{ // time not exeed
                                $('#add_lunch').prop("disabled",false);
                                $('#add_lunch_value').prop("disabled",false);
                                $('.lunch').css('opacity','1')
                            }
                        }
                        else{
                            $('#add_lunch').prop("disabled",false);
                            $('#add_lunch_value').prop("disabled",false);
                            $('.lunch').css('opacity','1')  
                        }
                        // Hide Sections according to order before time

                    }
                }
            });      
            // 2. Get Menu & Dessert & Price & Time - Lunch




            // 3. Get Menu & Dessert & Price & Time - Dinner
            $('.dinner').hide();
            $('.msg').hide();
            $.ajax({
                url:"{{ url('') }}/app_mobile/menu_dinner",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , date:selected_date},

                success:function(data){
                    console.log("*****Menu(Dinner)***** " + data + " *****Menu(Dinner)*****")
                    
                    if (data == null || data == " " || data == "") {
                        $('.msg').show();
                        $('.msg>h3').append('<span>No Menu Available for Dinner</span>');
                        $('.important').hide()
                    }
                    else{
                        $('.dinner').show();
                        $("#dinner_meal").html(data)
                        $('#add_messing').show(); 
                        $('.important').show()
                    }
                }
            });

            $.ajax({
                url:"{{ url('') }}/app_mobile/dessert_dinner",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , date:selected_date},
                success:function(data){
                    if (data != "" || data != null ) { // Has data
                        $("#dinner_dessert").html("<span><i></i>" + data + "</span>")
                    }
                }
            });

            $.ajax({
                url:"{{ url('') }}/app_mobile/price_dinner",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , date:selected_date},
                success:function(data){
                    if (data != "" || data != null ) { // Has data
                        $("#price_dinner").html( "<span>Rs.</span>" + data  )
                    }
                    else{ // No data
                        $("#price_dinner").html( "<span>Rs.</span>" + "N/A" )
                    }

                    if (data == '0' ) { // No data. Equal to 0
                        $("#price_dinner").html( "<span>Rs.</span>" + "N/A" )
                    }
                }
            });

            $.ajax({
                url:"{{ url('') }}/app_mobile/time_dinner",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" },
                success:function(data){
                    if (data != "" || data != null ) { // Has data
                        $("#order_before_dinner").html("Order before : " + data + " hours")

                        var splt_time = data.split(':')
                        var fix_hr = splt_time[0]
                        var fix_min = splt_time[1]

                        // Hide Sections according to order before time
                        if (selected_date == today_date_new) {

                            if (hours >= fix_hr ) { // hours equal or exeed

                                if (hours == fix_hr) { // hours equal

                                    if (minutes > fix_min) { // minutes exceed
                                        $('#add_dinner').prop("disabled",true);
                                        $('#add_dinner_value').prop("disabled",true);
                                        $('.dinner').css('opacity','0.3')
                                    }
                                    else{ // minutes not exceed
                                        $('#add_dinner').prop("disabled",false);
                                        $('#add_dinner_value').prop("disabled",false);
                                        $('.dinner').css('opacity','1')  
                                    }
                                }
                                else{ // hours exeed
                                    $('#add_dinner').prop("disabled",true);
                                    $('#add_dinner_value').prop("disabled",true);
                                    $('.dinner').css('opacity','0.3')
                                }
                            } 
                            else{ // time not exeed
                                $('#add_dinner').prop("disabled",false);
                                $('#add_dinner_value').prop("disabled",false);
                                $('.dinner').css('opacity','1')
                            }
                        }
                        else{
                            $('#add_dinner').prop("disabled",false);
                            $('#add_dinner_value').prop("disabled",false);
                            $('.dinner').css('opacity','1')  
                        }
                        // Hide Sections according to order before time

                    }
                }
            });        
            // 3. Get Menu & Dessert & Price  - Dinner
        });


        

        
        // Save All Messign Data
        $("#add_messing").click(function(){

            var add_breakfast_value = $('#add_breakfast_value').val()   
            var add_lunch_value = $('#add_lunch_value').val()
            var add_dinner_value = $('#add_dinner_value').val()
    
            if (add_breakfast_value == "" && add_lunch_value == "" && add_dinner_value == "") { // Validation fail

                // Show validation error
                setTimeout(hideMsg, 3000);
                function hideMsg() { 
                    $('#error_msg').fadeOut();
                }  
                $('#error_msg').show()
            }

            else{ // Validation success
                // if (add_breakfast_value != "") {
                //     //save_breakfast();
                //     //$('.breakfast').css('opacity','0.4')
                //     //$("#add_breakfast_value").attr("placeholder", "Enter New Order Value"  );
                // }
                // if (add_lunch_value != "") {
                //     // save_lunch();
                //     // $('.lunch').css('opacity','0.4')
                //     // $("#add_lunch_value").attr("placeholder", "Enter New Order Value"  );
                // }
                // if (add_dinner_value != "") {
                //     // save_dinner();
                //     // $('.dinner').css('opacity','0.4')
                //     // $("#add_dinner_value").attr("placeholder", "Enter New Order Value"  );
                // }

                save_messing_all()
            }
        })





        // Save Mess Booking Details - All - Start
        function save_messing_all() {

            var selected_date = $('#datepicker').val()
            var add_breakfast_value = $('#add_breakfast_value').val()
            var add_lunch_value = $('#add_lunch_value').val()
            var add_dinner_value = $('#add_dinner_value').val()

            var breakfast = 0;
            var lunch = 0;
            var dinner = 0;
            var breakfast_status = 0;
            var lunch_status = 0;
            var dinner_status = 0;

            if (add_breakfast_value != "") {
                breakfast = $('#add_breakfast_value').val();
                breakfast_status = 1
            }

            if (add_lunch_value != "") {
                lunch = $('#add_lunch_value').val();
                lunch_status = 1
            }

            if (add_dinner_value != "") {
                dinner = $('#add_dinner_value').val();
                dinner_status = 1
            }


            $.ajax({
            url:"{{ url('') }}/app_mobile/save_messing_all",
            method:'POST',
            data:{ "_token": "{{ csrf_token() }}" , breakfast:breakfast , lunch:lunch , dinner:dinner , breakfast_status:breakfast_status , lunch_status:lunch_status , dinner_status:dinner_status , ajax_date_value:selected_date},
            success:function(data){

                if (data != '' ) {

                    $('#success_msg_breakfast').css('display','flex');
                    $('#success_msg_breakfast').html(data)

                    const myTimeout = setTimeout(hideMsg, 3000);
                    function hideMsg() {
                        $('#success_msg_breakfast').fadeOut();
                    }    
                    $('#add_breakfast_value').val('')
                    $('#add_lunch_value').val('')
                    $('#add_dinner_value').val('')

                }
                else{
                    $('#success_msg_breakfast').hide();
                    $('#error_msg_breakfast').show();
                    $('#error_msg_breakfast').html(data)

                    const myTimeout = setTimeout(hideMsg, 3000);
                    function hideMsg() {
                        $('#error_msg_breakfast').fadeOut();
                    } 
                }
            }
            });

            $('.status').hide()

            // Show success msg
            setTimeout(hideMsg, 3000);
            function hideMsg() { 
                $('#success_msg').fadeOut();
            }  
            $('#success_msg').show()
        }
        // Save Mess Booking Details - All - End


        $('#popup_close').on('click', function() {
            $('.popup').css({'display':'none'})
        });


        $('#today_orders').on('click', function() {
            $('.status').toggle()
            OrderStatus();
        });
        


    });
</script>




</body>
</html>