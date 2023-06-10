<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-users.css') }}" rel="stylesheet">

    <script src="{{ asset('js/js.cookie.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <title>User Login</title>
</head>
<body>


    <div class="main_cintainer">
        <div class="login">
                <div class="logo">
                    <img src="{{ asset('img/jimmy.png') }}" alt="SLSC Logo">
                    <h5>Login</h5>
                    <h6>Officers' Mess</h6>
                </div>

                <label class="success_msg _msg success_msg_login" for=""></label>
                <label class="error_msg _msg error_msg_login" for=""></label>

                <div class="fields">
                    <div class="un">
                        <label for="username">Officer Number</label>
                        <input name="username" class="form-control" placeholder="O/XXXXX" id="username" type="text" value="">
                    </div>
                    <div class="pass">
                        <label for="password">Password</label>
                        <input password="password" class="form-control" placeholder="Enter Password" id="password" type="password" value="">
                    </div>
                    <div class="rememberme">
                        <input class="form-check-input" type="checkbox" value="" id="remember_me">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>
                    <div class="login_button">
                        <input id="submit_login" class="btn btn-primary" type="button" value="Login">
                    </div>
                </div>
        </div>

        <div class="copyrights">
            <p>Software Solution by Dte of IT - SL Army</p>
        </div>

    </div>




<!-- Login Process -->
<script type="text/javascript">
  
  $(document).ready(function() {

    var officernumber = Cookies.get('OfficerNumberCookie') // get Officer number from Cookie 

    if (officernumber == undefined ) { // no cookie
        console.log('no cookie')
    }
    else{ // have cookie
        console.log('have cookie')

        var LastlyClosedPage = Cookies.get('PageCookie') // get Officer number from Cookie 

        if (LastlyClosedPage == "messing") {
            window.location.href = "'/public/messing' ?>";
        }
        else if (LastlyClosedPage == "extra_messing") {
            window.location.href = "'/public/extra_messing' ?>";
        }
        else if (LastlyClosedPage == "bar") {
            window.location.href = "'/public/bar' ?>";
        }
        else if (LastlyClosedPage == "tea") {
            window.location.href = "'/public/tea' ?>";
        }
        else if (LastlyClosedPage == "canteen") {
            window.location.href = "'/public/canteen' ?>";
        }
        else if (LastlyClosedPage == "mess_bill") {
            window.location.href = "'/public/mess_bill' ?>";
        }
        else if (LastlyClosedPage == "summary") {
            window.location.href = "'/public/summary' ?>";
        }
        else{
            window.location.href = "'/public/dashboard' ?>";
        }

        //Cookies.remove('OfficerNumberCookie')
    }


    $("#submit_login").click(function(){

        // temp
        window.location.href = "{{ route('users.dashboard') }}";


        var remember_me_status = ""
        if ($('#remember_me').prop("checked") == true) {
            remember_me_status = 'true'
        }
        else{
            remember_me_status = 'false'
        }

        var username = $("#username").val();
        var password = $("#password").val();

        $.ajax({
            url:"/public/GetLoginData",
            method:'POST',
            dataType:'json',
            data:{ajax_username:username , ajax_password : password },
            success:function(data){

                console.log(data)

                if( data == "" || data == "fail"){ // Login fail
                    $('.error_msg').show();
                    $('.error_msg').html('Login Fail. Please Try Again')
                    const myTimeout = setTimeout(hideError, 3000);
                    function hideError() {
                        $('.error_msg').fadeOut();
                    }
                }
                else{ // Login success

                    if (remember_me_status == "true") {
                        Cookies.set('OfficerIDCookie', data.pid); 
                        Cookies.set('OfficerNumberCookie', data.offr_number); 
                        Cookies.set('OfficerRankCookie', data.rank); 
                        Cookies.set('OfficerNameCookie', data.name); 
                        Cookies.set('RememberMeStatus', 'true'); 
                    }
                    else{
                        Cookies.set('OfficerIDCookie', data.pid); 
                        Cookies.set('OfficerNumberCookie', data.offr_number); 
                        Cookies.set('OfficerRankCookie', data.rank); 
                        Cookies.set('OfficerNameCookie', data.name); 
                        Cookies.set('RememberMeStatus', 'false'); 
                    }

                    $('.success_msg').show();
                    $('.success_msg').html('Login Success');
                    window.location.href = "'/public/dashboard' ?>";

                }
            }
            
        });
    });

    $('.copyrights').click(function(){
        $("#username").val('C/34575') 
        $("#password").val('Abcde@123')
    })

  });

</script>
<!-- Login Process -->



</body>
</html>