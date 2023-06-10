<!DOCTYPE html>
<html lang="en">
<head>
    @include('app_mobile/inc/links')
    <title>Select the Mess</title>
</head>
<body>

    <div class="dashboard_main">

        <div id='select_mess' class="dashboard dashboard_messing">

            <div class="dashboard_in">
                
                <div class="title">
                    <div class="imgdiv">
                        <div class="imgdivin">
                            <img src="{{ asset('app_mobile/img/mess_select.png')}}" alt="">
                        </div>
                    </div>
                    <h1>Messes</h1>
                </div>
                <div class="inputs messing_inputs">
                    <div class="no_mess_div">
                        <p></p>
                    </div>
                    <div class="search_fields">
                        <div class="calander mess_select_div">
                            <select id="mess_select" class="form-select mess_select" aria-label="Default select example"></select>
                        </div>

                        <div class="search_dv">
                            <input id="search" class="add btn btn-success" type="button" value="Enter to the Mess">
                        </div>

                        <label class="error_msg select_mess_error _msg" for=""></label>

                    </div>


                </div>
            </div>

        </div>

        

        <div class="footer">
            @include('app_mobile/inc/footer')
        </div>

    </div>                       




<script type="text/javascript">

    $(document).ready(function() {


        $("#check_connection").click(function(){
            if(navigator.onLine) {  // Online
                $('.internet_connection_status').hide()
            } else { // Offline
                $('.internet_connection_status').css('display','flex')
            }
        })
        


        // if (navigator.onLine) {
        // // online
        // console.log("Online");
        // } else {
        // // offline
        // console.log("Offline");
        // }


        // Check internet connection
        // function chkInternetStatus() {
        //     if(navigator.onLine) {  // Online
        //         $('.internet_connection_status').hide()
        //         console.log('online')
        //         //Cookies.set('PageCookie', 'dashboard'); 
        //         // window.location.href = "{{ url('') }}" + "/user/" + 'dashboard'
        //     } else { // Offline
        //         $('.internet_connection_status').css('display','flex')
        //         console.log('Offline')

        //     }
        // }


        $('#dashboard_main_topbar').hide()

        $.ajax({
            url:"{{ url('') }}/app_mobile/user_authenticate",
            method:'POST',
            data:{ "_token": "{{ csrf_token() }}" , enum:"{{$enum}}" , id:"{{$id}}" , auth:"{{$auth}}" },
            success:function(data){
                console.log(data)
                if (data == undefined || data == "" || data == "Authentication fail" || data == "No data" ) { // No any mess assigned
                    
                    $('.search_fields').hide()
                    $('.no_mess_div').show()
                    $('.no_mess_div > p').html('You have not enrolled in an Officer Mess. Please contact the respective Mess Manager.')
                    console.log('No cookie, Session Expired.')
                }
                else{
                    $('.no_mess_div').hide()
                    $('.search_fields').show()
                    $("#mess_select").html(data)
                }
            }
        });


        

        $("#search").click(function(){
   
            if(navigator.onLine) {  // Online

                $('.internet_connection_status').hide()
        


                var mess_name = $('#mess_select').find('option:selected').text()

                Cookies.set('mess_name', mess_name ); 

                var selected_mess = $('#mess_select').find('option:selected').text()

                if (  selected_mess == 'Select the Mess' || selected_mess == '' ) { // Search without selecting a Mess
                    
                    $('._msg').show()
                    $('.select_mess_error').html('Please Select the Mess')

                    setTimeout(hideMsg, 2000);
                    function hideMsg() {
                        $('._msg').hide()
                    }
                }
                else{ // Search After selecting a Mess
                    $('._msg').hide()

                    var mess_id = $('#mess_select').val()

                    // Set Mess ID to Cookie
                    $.ajax({
                        url:"{{ url('') }}/app_mobile/set_mess_id",
                        method:'POST',
                        data:{ "_token": "{{ csrf_token() }}" , mess_id:mess_id },
                        success:function(data){
                        }
                    });

                    window.location.href = "{{ url('') }}/app_mobile/dashboard";
                }

            } else { // Offline
                $('.internet_connection_status').css('display','flex')
                console.log('Offline')
            }








        });


    });
</script>


</body>
</html>