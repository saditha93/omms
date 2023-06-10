<!DOCTYPE html>
<html lang="en">
<head>
    @include('app_mobile/inc/links')
    <title>Mess Bill</title>
</head>
<body>

    <div class="dashboard_main">
        <div id="dashboard_main_topbar" class="dashboard_topbar dashboard_main_topbar">
            @include('app_mobile/inc/header')
        </div>


        <div id='mess_bill' class="dashboard dashboard_messing">

            <div class="dashboard_in">
                
                <div class="title">
                    <div class="imgdiv">
                        <div class="imgdivin">
                            <img src="{{ asset('app_mobile/img/bill.png')}}" alt="">
                        </div>
                    </div>
                    <h1>Mess Bill</h1>
                </div>
                <div class="inputs">
                    
                    <div class="item_select_grp">

                        <div class="calander_in">
                            <div class="calander calander_mess_bill calander_mess_bill1">
                                <label for="date" class="col-1 col-form-label">Date From</label>
                                <input class="form-control" id="datepicker" type="text">
                                <script>
                                    const picker = MCDatepicker.create({
                                        el: '#datepicker',
                                        dateFormat: 'yyyy-mm-dd',
                                        theme: {
                                            theme_color: '#000024'
                                        },
                                        selectedDate: new Date()
                                    });   
                            </script>
                            </div>

                            <div class="calander calander_mess_bill calander_mess_bill2">
                                <label for="date" class="col-1 col-form-label">Date To</label>
                                <input class="form-control" id="datepicker2" type="text">
                                <script>
                                    const picker2 = MCDatepicker.create({
                                        el: '#datepicker2',
                                        dateFormat: 'yyyy-mm-dd',
                                        theme: {
                                            theme_color: '#000024'
                                        },
                                        selectedDate: new Date()
                                    });   
                            </script>
                            </div>

                            <div class="calander_mess_bill_btn">
                                <input id="mess_bill_search_btn" class="add btn btn-success" type="button" value="Search">
                            </div>

                        </div>


                        <div id="mess_bill_report_div">

                        </div>


                    </div>
                    
                    <label id="success_msg_dinner" class="success_msg _msg" for=""></label>
                    <label id="error_msg_dinner" class="error_msg _msg" for=""></label>


                </div>
            </div>
        </div>


        <div class="footer">
            @include('app_mobile/inc/footer')
        </div>
        

    </div>


              

<script type="text/javascript">

    $(document).ready(function() {

        $("#mess_bill_search_btn").click(function(){

            var date1  = $('#datepicker').val()
            var date2  = $('#datepicker2').val()

            if (date1 == "" || date2 == "") {
                $('.error_msg').show();
                $('.error_msg').html('Please Select the Date')

                const myTimeout = setTimeout(hideMsg, 1200);
                function hideMsg() {
                    $('.error_msg').fadeOut();
                }
            }

            else{

                function GetMessBillDataFunc(date1 , date2){
                    // 1. Get Summary for Messing 
                    $.ajax({
                        url:"{{ url('') }}/app_mobile/mess_bill_func",
                        method:'POST',
                        data:{ "_token": "{{ csrf_token() }}" , ajax_date1:date1 , ajax_date2:date2},
                        success:function(data){
                            console.log(data)
                            if (data == null) {
                                console.log('Summary Report is not Available')
                            }
                            else{
                                $('#mess_bill_report_div').html(data);
                            }
                        }
                    });
                }

                GetMessBillDataFunc(date1 , date2);

                $('.mess_bill_dwn').show()
            }

        });

    });
</script>




</body>
</html>