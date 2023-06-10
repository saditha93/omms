<!DOCTYPE html>
<html lang="en">
<head>
    @include('app_mobile/inc/links')
    <title>App Dashboard</title>
</head>
<body>

    <div class="dashboard_main">

        <div id="dashboard_main_topbar" class="dashboard_topbar dashboard_main_topbar">
            @include('app_mobile/inc/header-dashboard')
        </div>

        <div class="dashboard">

            <div class="dashboard_in">

                <div class="welcome">
                    <h1 class="welcome_h1"><span>Welcome to <span></span> Officers' Mess</span></h1>
                </div>

                <div class="sec_main">
                    <div id="messing" class="sec">
                        <div class="img">
                            <img src="{{ asset('/app_mobile/img/messing.png')}}" alt="" oncontextmenu="return false;">
                        </div>
                        <div class="txt">
                            <p>Messing</p>
                        </div>
                    </div>
                    <div id="extra_messing" class="sec">
                        <div class="img">
                            <img src="{{ asset('/app_mobile/img/extra_messing.png')}}" alt="" oncontextmenu="return false;">
                        </div>
                        <div class="txt">
                            <p>Extra Messing</p>
                        </div>
                    </div>
                </div>

                <div class="sec_main">
                    <div id="bar" class="sec">
                        <div class="img">
                            <img src="{{ asset('/app_mobile/img/bar.png')}}" alt="" oncontextmenu="return false;">
                        </div>
                        <div class="txt">
                            <p>Bar</p>
                        </div>
                    </div>
                    <div id="bill" class="sec">
                        <div class="img">
                            <img src="{{ asset('/app_mobile/img/bill.png')}}" alt="" oncontextmenu="return false;">
                        </div>
                        <div class="txt">
                            <p>Mess Bill</p>
                        </div>
                    </div>
                </div>

                <div class="sec_main">
                    <div id="history" class="sec">
                        <div class="img">
                            <img src="{{ asset('/app_mobile/img/history.png')}}" alt="" oncontextmenu="return false;">
                        </div>
                        <div class="txt">
                            <p>Order Summary</p>
                        </div>
                    </div>
                    <div id="Other" class="sec">
                        <div class="img">
                            <img src="{{ asset('/app_mobile/img/other.png')}}" alt="" oncontextmenu="return false;">
                        </div>
                        <div class="txt">
                            <p>News Forum</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="copyrights">
            <!-- <p>Software Solution by Dte of IT - SL Army</p> -->
            <p></p>
        </div>

        <div class="internet_connection_status">
            <div>
                <img src="{{ asset('/app_mobile/img/loader.gif')}}" alt="" oncontextmenu="return false;">
                <p>Please Connect to the Internet</p>
                <input id="check_connection" class="btn btn-primary" type="button" value="Ok">
            </div>
        </div>

    </div>



<!-- Link Pages -->
<script type="text/javascript">

    window.onscroll = function() {myFunction()};

        var header = document.getElementById("dashboard_main_topbar");
        var sticky = header.offsetTop;

        function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
        } else {
            header.classList.remove("sticky");
        }
    }

  
    $(document).ready(function() {
        console.log('first')

        //Set Mess Name
        var mess_name = Cookies.get('mess_name') 
        $('.welcome_h1 > span > span').text(mess_name)
    


        var redirect_link = ''

        // Check internet connection
        function chkInternetStatus(redirect_link) {
            if(navigator.onLine) {  // Online
                $('.internet_connection_status').hide()
                //Cookies.set('PageCookie', redirect_link); 
                window.location.href = "" + "{{ url('') }}" + "/app_mobile/" + redirect_link
            } else { // Offline
                $('.internet_connection_status').css('display','flex')
            }
        }

        

        // Get Personal Details

        // Get Personal Details



        // Messing Link
        $("#messing").click(function(){
            redirect_link = 'messing'
            chkInternetStatus(redirect_link)
        });

        // Extra Messing Link
        $("#extra_messing").click(function(){
            redirect_link = 'extra_messing'
            chkInternetStatus(redirect_link)
        });

        // Bar Link
        $("#bar").click(function(){
            redirect_link = 'bar'
            chkInternetStatus(redirect_link)
        });

        // Tea Link
        $("#tea").click(function(){
            redirect_link = 'tea'
            chkInternetStatus(redirect_link)
        });

        // Canteen Link
        $("#canteen").click(function(){
            redirect_link = 'canteen'
            chkInternetStatus(redirect_link)
        });
    
        // Mess Bill
        $("#bill").click(function(){
            redirect_link = 'mess_bill'
            chkInternetStatus(redirect_link)
        });

        // Order History
        $("#history").click(function(){
            redirect_link = 'summary'
            chkInternetStatus(redirect_link)
        });


        // Ok button inside Check Internet Msg
        $("#check_connection").click(function(){
            chkInternetStatus(redirect_link)
        });


  });

</script>


</body>
</html>