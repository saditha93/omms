<!DOCTYPE html>
<html lang="en">
<head>
    @include('app_mobile/inc/links')
    <title>Summary</title>
</head>
<body>


<div class="dashboard_main">

    <div id="dashboard_main_topbar" class="dashboard_topbar dashboard_main_topbar">
        @include('app_mobile/inc/header')
    </div>

    <div id='summary' class="dashboard dashboard_messing dashboard_messing_summary">

        <div class="dashboard_in">
            
            <div class="title">
                <div class="imgdiv">
                    <div class="imgdivin">
                        <img src="{{ asset('app_mobile/img/history.png')}}" alt="">
                    </div>
                </div>
                <h1>Daily Summary<span id="date_now"></span></h1>
            </div>
            <div class="inputs">

            <!-- <input id="screenshot" class="add btn btn-success" type="button" value="Screenshot"> -->

                <div class="date_selector">
                    <div id='calander_summary' class="calander">
                        <label for="date" class="col-1 col-form-label">Select Date</label>
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
                    <div class="summary_search_btn_dv">
                        <input id="summary_search_btn" class="add btn btn-success" type="button" value="Search">
                    </div>
                </div>

                <div class="_sum messing_sum">
                    <h2>Messing</h2>
                    <div class="details">
                        <div id="messing_sum_content"></div>
                    </div>
                </div>

                <div class="_sum extra_messing_sum">
                    <h2>Extra Messing</h2>
                    <div class="details">
                        <div id="extra_messing_sum_content"></div>
                    </div>
                </div>                
    
                <div class="_sum tea_sum">
                    <h2>Tea</h2>
                    <div class="details">
                        <div id="tea_sum_content"></div>
                    </div>
                </div>

                <div class="_sum bar_sum">
                    <h2>Bar</h2>
                    <div class="details">
                        <div id="bar_sum_content"></div>
                    </div>
                </div>

         
                <label class="success_msg _msg" for=""></label>
                <label class="error_msg _msg" for=""></label>

                <!-- <div class="submit_button_div submit_button_div_summary">
                    <input id="close_button" class="close_button btn btn-danger" type="button" value="Close">
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

    //Today Date
    var today_date = new Date();
    var dd = String(today_date.getDate()).padStart(2, '0');
    var mm = String(today_date.getMonth() + 1).padStart(2, '0');
    var yyyy = today_date.getFullYear();
    today_date_new = yyyy + "-" + mm + "-" + dd ;

    $('#date_now').html("("+ yyyy + "-" + mm + "-" + dd + ")")


    GetSummaryfor_Messing()
    GetSummaryfor_ExtraMessing()
    GetSummaryfor_Tea()
    GetSummaryfor_Bar()


    $("#summary_search_btn").click(function(){ 
        var date_value = $('#datepicker').val()
        //console.log(date_value)
        today_date_new = date_value

        $('#date_now').html("("+today_date_new+")")

        GetSummaryfor_Messing()
        GetSummaryfor_ExtraMessing()
        GetSummaryfor_Tea()
        GetSummaryfor_Bar()

    });



    function GetSummaryfor_Messing(){ // 1 Messing
        // 1. Get Summary for Messing 
        $.ajax({
            url:"{{ url('') }}/app_mobile/summery_messing",
            method:'POST',
            //dataType:'json',
            data:{ "_token": "{{ csrf_token() }}" , ajax_today_date:today_date_new},
            success:function(data){
                console.log(data)
                if (data == null) {
                    console.log('Summary Report is not Available')
                }
                else{
                    $('#messing_sum_content').html(data)
                }
            }
        });
    }



    function GetSummaryfor_ExtraMessing(){ // 2 ExtraMessing
        // 2. Get Summary for Extra Messing 
        $.ajax({
            url:"{{ url('') }}/app_mobile/summery_extra_messing",
            method:'POST',
            //dataType:'json',
            data:{ "_token": "{{ csrf_token() }}" , ajax_today_date:today_date_new},
            success:function(data){
                //console.log(data)
                if (data == null) {
                    console.log('Summary Report is not Available')
                }
                else{
                    $('#extra_messing_sum_content').html(data )
                }
            }
        });
    }


    function GetSummaryfor_Tea(){ // 3 Tea
        // 3. Get Summary for Tea
        $.ajax({
            url:"{{ url('') }}/app_mobile/summery_tea",
            method:'POST',
            //dataType:'json',
            data:{ "_token": "{{ csrf_token() }}" ,  ajax_today_date:today_date_new},
            success:function(data){
                //console.log(data)
                if (data == null) {
                    console.log('Summary Report is not Available')
                }
                else{
                    $('#tea_sum_content').html(data)
                }
            }
        });
    }



    function GetSummaryfor_Bar(){ // 3 Tea
        // 3. Get Summary for Tea
        $.ajax({
            url:"{{ url('') }}/app_mobile/summery_bar",
            method:'POST',
            //dataType:'json',
            data:{ "_token": "{{ csrf_token() }}" ,  today_date:today_date_new},
            success:function(data){
                console.log(data)
                if (data == null) {
                    console.log('Summary Report is not Available')
                }
                else{
                    $('#bar_sum_content').html(data)
                }
            }
        });
    }


    $('.input-group-append').click(function(){
        $('.datepicker-dropdown').hide()
    })


    });
</script>




</body>
</html>