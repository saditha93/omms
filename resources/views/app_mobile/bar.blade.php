<!DOCTYPE html>
<html lang="en">
<head>
    @include('app_mobile/inc/links')
    <title>Bar</title>
</head>
<body>

    <div class="dashboard_main">

        <div id="dashboard_main_topbar" class="dashboard_topbar dashboard_main_topbar">
            @include('app_mobile/inc/header')
        </div>


        <div id='bar' class="dashboard dashboard_messing">

            <div class="dashboard_in">
                
                <div class="title">
                    <div class="imgdiv">
                        <div class="imgdivin">
                            <img src="{{ asset('app_mobile/img/bar.png')}}" alt="">
                        </div>
                    </div>
                    <h1>Search Liquors</h1>
                </div>
                <div class="inputs">
                    
                    <div class="item_select_grp">

                        <div id="calander_bar" class="calander">
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
                            <label for="item_select" class="col-1 col-form-label">Brand</label>
                            <select id="item_select" class="form-select" aria-label="Default select example">
                            </select>
                        </div>
                        <div class="qty_select qty_select_bar">
                            <label for="date" class="col-1 col-form-label">No of Shots</label>
                            <select id="qty_select" class="form-select" aria-label="Default select example">
                                <option selected>Select the Shots</option>
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

                        <div class="availablility">
                            <div class="available">
                                <p>Availability</p>
                                <span id="available"></span>
                            </div>
                            <div class="shot_size">
                                <p>Capacity</p>
                                <span id="shot_size"></span>
                            </div>
                            <div class="price_per_shot">
                                <p>Price</p>
                                <span id="price_per_shot"></span>
                            </div>
                        </div>

                    </div>
                    
                    <label class="success_msg _msg" for=""></label>
                    <label class="error_msg _msg" for=""></label>

                    <!-- <div class="submit_button_div">
                        <input id="order_bar" class="add_button btn btn-success" type="button" value="Order">
                    </div> -->

                </div>



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
        function GetLiquorNamesFunc(){ // ok
            $.ajax({
                url:"{{ url('') }}/app_mobile/bar_item_names",
                method:'POST',
                data:{ "_token": "{{ csrf_token() }}" , today_date:today_date_new },
                success:function(data){
                    $("#item_select").html(data)
                }
            });
        }
        // Get Item Names - End
        GetLiquorNamesFunc();



        // Get Liquor Details and Set to the Fields
        $('#item_select').on('change', function() { // ok

            var item_id = $('#item_select').val()
 
            $.ajax({
                url:"{{ url('') }}/app_mobile/bar_item_prices",
                method:'POST',
                dataType:'json',
                data:{ "_token": "{{ csrf_token() }}" , ajax_item_id:item_id},
                success:function(data){
                    if (data.qty <= "0" || data.qty == undefined ) {
                        $('#available').html('No')
                    }
                    else{
                        $('#available').html('Yes')
                    }

                    $('#shot_size').html(data.abbreviation)

                    $('#price_per_shot').html("Rs: " + (Math.round(data.unit_price)).toFixed(2) )
                }
            });

        });



    });
</script>


</body>
</html>