<!DOCTYPE html>
<html lang="en">
<head>
    @include('app_mobile/inc/links')
    <title>Extra Messing</title>
</head>
<body>

    <div class="dashboard_main">

        <div id="dashboard_main_topbar" class="dashboard_topbar dashboard_main_topbar">
            @include('app_mobile/inc/header')
        </div>


        <div  id='extra_messing' class="dashboard dashboard_messing dashboard_extra_messing">

            <div class="dashboard_in">
                
                <div class="title">
                    <div class="imgdiv">
                        <div class="imgdivin">
                            <img src="{{ asset('/app_mobile/img/extra_messing.png')}}" alt="">
                        </div>
                    </div>
                    <h1>Extra Messing</h1>
                </div>
                <div class="inputs">
                    
                    <div class="item_select_grp">

                        <div id="calander_extra_messing" class="calander">
                            <label for="datepicker" class="col-1 col-form-label">Date</label>
                            <input class="form-control" id="datepicker" type="text">
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
                                    selectedDate: new Date(),
                                    minDate: new Date(yyyy, mm-1, dd),
                                    jumpOverDisabled: false,
                                });                                            
                            </script>
                        </div>

                        <div class="item_select">
                            <label for="item_select" class="col-1 col-form-label">Item Name</label>
                            <select id="item_select" class="form-select" aria-label="Default select example">
                            </select>
                        </div>

                        <div class="item_price_div item_price_div_extra">
                            <label for="item_price" class="col-1 col-form-label">Item Price</label>
                            <p id="item_price"></p>
                        </div>

                        <div class="type_select">
                            <label for="type_select" class="col-1 col-form-label">Meal Type</label>
                            <select id="type_select" class="form-select" aria-label="Default select example">
                                <option selected>Select the Meal Type</option>
                                <option value="1">Breakfast</option>
                                <option value="2">Lunch</option>
                                <option value="3">Dinner</option>
                                <option value="4">Other</option>
                            </select>
                        </div>
                        <div class="qty_select">
                            <label for="qty_select" class="col-1 col-form-label">Quantity</label>
                            <select id="qty_select" class="form-select" aria-label="Default select example">
                                <option selected>Select the Quantity</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="total_price_div">
                            <label for="total_price" class="col-1 col-form-label">Total Price</label>
                            <p id="total_price"></p>
                        </div>
                        <div class="note_div">
                            <div class="form-group">
                                <label for="note_field">Note</label>
                                <textarea id="note_field" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <label class="success_msg _msg" for=""></label>
                        <label class="error_msg _msg" for=""></label>

                        
                        <div class="submit_button_div">
                            <input id="order_extra_messing" class="add_button btn btn-success" type="button" value="Order">
                        </div>

                    </div>
                    


                </div>





                <!-- Tea -->

                <div class="title tea_title">
                    <div class="imgdiv">
                        <div class="imgdivin">
                            <img src="{{ asset('/app_mobile/img/tea.png')}}" alt="">
                        </div>
                    </div>
                    <h1>Order Tea</h1>
                </div>
                <div class="inputs">

                    <div class="item_select_grp">

                        <div id="calander_tea" class="calander">
                            <label for="datepicker2" class="col-1 col-form-label">Date</label>
                            <input class="form-control" id="datepicker2" type="text">
                            <script>

                                //Today Date
                                var today_date2 = new Date();
                                var dd2 = String(today_date2.getDate()).padStart(2, '0');
                                var mm2 = String(today_date2.getMonth() + 1).padStart(2, '0');
                                var yyyy2 = today_date2.getFullYear();

                                const picker2 = MCDatepicker.create({
                                    el: '#datepicker2',
                                    dateFormat: 'yyyy-mm-dd',
                                    theme: {
                                        theme_color: '#000024'
                                    },
                                    selectedDate: new Date(),
                                    minDate: new Date(yyyy2, mm2-1, dd2),
                                    jumpOverDisabled: false,
                                });                                            
                            </script>
                        </div>

                        <div class="item_select">
                            <label for="item_select_tea" class="col-1 col-form-label">Item Name</label>
                            <select id="item_select_tea" class="form-select" aria-label="Default select example">
                            </select>
                        </div>

                        <div class="item_price_div item_price_div_tea">
                            <label for="tea_item_price" class="col-1 col-form-label">Item Price</label>
                            <p id="tea_item_price"></p>
                        </div>

                        <div class="type_select">
                            <label for="type_select_tea" class="col-1 col-form-label">Time</label>
                            <select id="type_select_tea" class="form-select" aria-label="Default select example">
                                <option selected>Select the Time</option>
                                <option value="1">0600 hrs</option>
                                <option value="2">1000 hrs</option>
                                <option value="3">1500 hrs</option>
                                <option value="4">Other</option>
                            </select>
                        </div>
                        <div class="qty_select">
                            <label for="qty_select_tea" class="col-1 col-form-label">Quantity</label>
                            <select id="qty_select_tea" class="form-select" aria-label="Default select example">
                                <option selected>Select the Quantity</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="total_price_div_tea">
                            <label for="total_price_tea" class="col-1 col-form-label">Total Price</label>
                            <p id="total_price_tea"></p>
                        </div>
                        <div class="note_div">
                            <div class="form-group">
                                <label for="note_field_tea">Note</label>
                                <textarea id="note_field_tea" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <label class="success_msg_tea _msg" for=""></label>
                        <label class="error_msg_tea _msg" for=""></label>

                        <div class="submit_button_div">
                            <input id="order_tea" class="add_button btn btn-success" type="button" value="Order">
                        </div>

                    </div>
                
                </div>


                <!-- Tea -->








            </div>
        </div>


        <div class="footer">
            @include('app_mobile/inc/footer')
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
        $('#datepicker2').val(today_date_new)


        // Get Item Names - Start
        function GetItemNamesFunc(){ // ok
            $.ajax({
                url:"{{ url('') }}/app_mobile/extra_messing_names",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" },
                success:function(data){
                    console.log(data)
                    $("#item_select").html(data)
                }
            });
        }
        // Get Item Names - End
        GetItemNamesFunc();


        $('.item_price_div').hide()


        var selected_item_price;
        // Get Price 
        $('#item_select').on('change', function() { // ok
            
            $('#type_select').prop('selectedIndex',0); // Reset to default
            $('#qty_select').prop('selectedIndex',0); // Reset to default
            $('.total_price_div').hide()

            $('.item_price_div_extra').css({'display':'flex'})

            var item_id = $('#item_select').val()

            $.ajax({
                url:"{{ url('') }}/app_mobile/extra_messing_price",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , item_id:item_id},
                success:function(data){
                    selected_item_price = data
                    console.log(data)
                    if (data == 'Select the Item') {
                        $('#item_price').html('N/A')
                    }
                    else{
                        $('#item_price').html( "Rs: " + parseFloat(data).toFixed(2) )
                    }
                    
                }
            });

        });


        
        // QTY Select
        $('#qty_select').on('change', function() { // 0k . but need to validate it correctly wit item_id

            var item_name = $('#item_select').val()
            var type_select = $('#type_select').val()


            if (item_name == "Select the Item") {
                $('.error_msg').show();
                $('.error_msg').html('Please Select a Item')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg').fadeOut();
                }   

                $('#qty_select').prop('selectedIndex',0); // Reset to default
            }

            
            else if (type_select == "Select the Meal Type") {
                $('.error_msg').show();
                $('.error_msg').html('Select the Meal Type')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg').fadeOut();
                }   

                $('#qty_select').prop('selectedIndex',0); // Reset to default
            }


            else{
                $('.total_price_div').css({'display':'flex'})

                var qty = $('#qty_select').val()
                var price = qty * selected_item_price

                $('#total_price').html( "(Rs. " + selected_item_price + "x" + qty + ")" + "<span>" + "Rs. " +  price.toFixed(2)  + "</span>" )
            }

        });



        // Meal Type Select
        $('#type_select').on('change', function() { // 0k . but need to validate it correctly wit item_id

            var item_name = $('#item_select').val()

            if (item_name == "Select the Item") {
                $('.error_msg').show();
                $('.error_msg').html('Please Select a Item')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg').fadeOut();
                }   

                $('#qty_select').prop('selectedIndex',0); // Reset to default
            }

        });


        // Order Button - Save data
        $("#order_extra_messing").click(function(){    
            
            var item_id = $('#item_select').val()
            var type = $('#type_select').val()
            var qty = $('#qty_select').val()
            var price = $('#price_select').val()
            var note = $('#note_field').val()
            var selected_date = $('#datepicker').val()
            
            
            if (item_id == "Select the Item") {
                $('.error_msg').show();
                $('.error_msg').html('Please Select a Item')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg').fadeOut();
                }   
            }

            else if(type == "Select the Meal Type"){
                $('.error_msg').show();
                $('.error_msg').html('Please Select a Meal Type')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg').fadeOut();
                } 
            }

            else if(qty == "Select the Quantity"){
                $('.error_msg').show();
                $('.error_msg').html('Please Select the Quantity')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg').fadeOut();
                } 
            }

            else{
                $.ajax({
                    url:"{{ url('') }}/app_mobile/extra_messing_save",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , ajax_item_id:item_id , ajax_meal_time:type , ajax_qty:qty , ajax_price:selected_item_price , ajax_date_value:selected_date , ajax_note:note},
                    success:function(data){

                        if (data == "The order has been placed successfully") {

                            $('.success_msg').show();
                            $('.success_msg').html(data)

                            const myTimeout = setTimeout(hideMsg, 3000);
                            function hideMsg() {
                                $('.success_msg').fadeOut();
                            }

                            // Validation
                            $('#item_select').prop('selectedIndex',0);
                            $('#type_select').prop('selectedIndex',0);
                            $('#qty_select').prop('selectedIndex',0);
                            $('#note_field').val('')
                            $('.total_price_div').hide()
                            $('.item_price_div').hide()

                        }
                        else{
                            $('.success_msg').hide();
                            $('.error_msg').show();
                            $('.error_msg').html(data)

                            const myTimeout = setTimeout(hideMsg, 3000);
                            function hideMsg() {
                                $('.error_msg').fadeOut();
                            } 
                        }

                    }
                });
            }

            
        });





        //// TEA ////

        // Get Tea Item Names - Start
        function GetTeaItemNamesFunc(){ // ok
            $.ajax({
                url:"{{ url('') }}/app_mobile/tea_names",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" },
                success:function(data){
                    console.log(data)
                    $("#item_select_tea").html(data)
                }
            });
        }
        GetTeaItemNamesFunc()
        // Get Tea Item Names - End




        var selected_tea_item_price = "";
        // Get Price 
        $('#item_select_tea').on('change', function() { // ok
            
            $('#type_select_tea').prop('selectedIndex',0); // Reset to default
            $('#qty_select_tea').prop('selectedIndex',0); // Reset to default
            $('.total_price_div_tea').hide()

            $('.item_price_div_tea').css({'display':'flex'})

            var item_name = $('#item_select_tea').val()

            $.ajax({
                url:"{{ url('') }}/app_mobile/tea_price",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , ajax_tea_id:item_name},
                success:function(data){
                    selected_tea_item_price = data
                    console.log(data)
                    if (data == 'Select the Item') {
                        $('#tea_item_price').html(data)
                    }
                    else{
                        $('#tea_item_price').html( "Rs: " + parseFloat(data).toFixed(2) )
                    }
                }
            });

        });



        $('#qty_select_tea').on('change', function() { // ok

            var item_name = $('#item_select_tea').val()
            var type_select = $('#type_select_tea').val()

            if (item_name == "Select the Item") {
                $('.error_msg_tea').show();
                $('.error_msg_tea').html('Please Select a Item')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg_tea').fadeOut();
                }

                $('#qty_select_tea').prop('selectedIndex',0); // Reset to default
            }

            else if (type_select == "Select the Time") {
                $('.error_msg_tea').show();
                $('.error_msg_tea').html('Select the Time')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg_tea').fadeOut();
                }   

                $('#qty_select_tea').prop('selectedIndex',0); // Reset to default
            }


            else{
                $('.total_price_div_tea').css({'display':'flex'})

                var qty = $('#qty_select_tea').val()
                var price = qty * parseInt(selected_tea_item_price)

                $('#total_price_tea').html( "(Rs. " + selected_tea_item_price + "x" + qty + ")" + "<span>" + "Rs. " +  price  + "</span>" )
            }

        });



        // Time Select
        $('#type_select_tea').on('change', function() { // 0k . but need to validate it correctly wit item_id

            var item_name = $('#type_select_tea').val()

            if (item_name == "Select the Item") {
                $('.error_msg_tea').show();
                $('.error_msg_tea').html('Please Select the Item')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg_tea').fadeOut();
                }   

                $('#type_select_tea').prop('selectedIndex',0); // Reset to default
            }

        });



        // Order Button - Save data
        $("#order_tea").click(function(){
        
            var item_name = $('#item_select_tea').val()
            var type = $('#type_select_tea').val()
            var qty = $('#qty_select_tea').val()
            var note = $('#note_field_tea').val()
            var selected_date = $('#datepicker2').val()

            if (item_name == "Select the Item") {
                $('.error_msg_tea').show();
                $('.error_msg_tea').html('Please Select the Item')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg_tea').fadeOut();
                }   
            }

            else if(type == "Select the Time"){
                $('.error_msg_tea').show();
                $('.error_msg_tea').html('Please Select a Time')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg_tea').fadeOut();
                } 
            }

            else if(qty == "Select the Quantity"){
                $('.error_msg_tea').show();
                $('.error_msg_tea').html('Please Select the Quantity')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg_tea').fadeOut();
                } 
            }

            else{
                $.ajax({
                    url:"{{ url('') }}/app_mobile/tea_save",
                    method:'POST',
                    data:{ "_token": "{{ csrf_token() }}" , ajax_item_id:item_name , ajax_type:type , ajax_qty:qty , ajax_price:selected_tea_item_price , ajax_date_value:selected_date , ajax_note:note},
                    success:function(data){
                        console.log(data)
                        if (data == "The order has been placed successfully") {

                            $('.success_msg_tea').show();
                            $('.success_msg_tea').html(data)

                            const myTimeout = setTimeout(hideMsg, 3000);
                            function hideMsg() {
                                $('.success_msg_tea').fadeOut();
                            }   
                            
                            // Validation
                            $('#item_select_tea').prop('selectedIndex',0);
                            $('#type_select_tea').prop('selectedIndex',0);
                            $('#qty_select_tea').prop('selectedIndex',0);
                            $('#note_field_tea').val('')
                            $('.total_price_div_tea').hide()
                            $('.item_price_div_tea').hide()
                        }
                        else{
                            $('.success_msg_tea').hide();
                            $('.error_msg_tea').show();
                            $('.error_msg_tea').html(data)

                            const myTimeout = setTimeout(hideMsg, 3000);
                            function hideMsg() {
                                $('.error_msg_tea').fadeOut();
                            } 
                        }

                    }
                });
            }
        });


        //// TEA ////


        
    });
</script>




</body>
</html>