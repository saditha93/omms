@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Event Billing
            </div>
            
            <div class="card-body">

                <form id="event_form" action="" method="POST">
                @csrf
                    <div class="row">
                    <p class="event_alert event_alert_fail alert alert-danger">Please Select the Officer Name</p>
                    <p class="event_alert event_alert_success alert alert-success">The event has been added Successfully</p>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="officer" class="form-label">Select Date</label>
                                <input type="text" autocomplete="off" placeholder="Date" class="form-control datepicker order_date" name="order_date" id="datepicker1">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event_name" class="form-label">Event Name</label>
                                <input id="event_name" name="event_name" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <!-- <div class="col-md-6 pl-0"> -->
                                <div class="form-group">
                                    <label for="details" class="form-label">Event Details</label>
                                    <textarea id="details" name="details" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            <!-- </div>  -->
                        </div>
                
                        <div class="col-md-12">
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="officer" class="form-label">Add Event Members</label>
                                    <div class="dropdown">
                                    <a class="dropbtn">Select the Name</a>
                                    <div id="myDropdown" class="dropdown-content">
                                        <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                                        @foreach($officers as $officer)
                                        <a href="#" data-value="{{$officer->email}}">{{ $officer->service_no}}  {{ $officer->name_according_to_part2}}</a>
                                        @endforeach
                                    </div>
                                    </div>

                                    <!-- <label for="officer" class="form-label">Add Event Members</label>
                                    <select id="officer" class="select2-single form-control" name="officer">
                                        <option value="select">Select the name</option>
                                        @foreach($officers as $officer)
                                            <option value="{{$officer->email}}">{{ $officer->name_according_to_part2}}</option>
                                        @endforeach
                                    </select> -->
                                    
                                </div>
                            </div>  
                            <div id="users_list" class="col-md-6 pl-0">
                                
                            </div> 
                        </div>







                
                        <div class="col-md-12">
                            <div class="col-md-6 pl-0">
                                <div class="form-group">
                                    <label for="billing_value" class="form-label">Billing Value Per Person</label>
                                    <input id="billing_value" name="billing_value" type="number" placeholder="" class="form-control">
                                </div>
                            </div> 
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <button id="create_event_bill" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </form>
                                
            </div>      

        </div>

    </div>
    

@endsection
@push('scripts')    
<script src="{{asset('/js/datepicker/datepicker.js')}}"></script>
<script>


    // Calander
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
    // Calander



    // Search Dropdown List
    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            } else {
            a[i].style.display = "none";
            }
        }
    }

    $(".dropbtn").click(function(){
        document.getElementById("myDropdown").classList.toggle("show");
        $("#myInput").val('');
    });
    // Search Dropdown List




    // Dynamic Name Select
    const selectedUsers = [];


    $("#myDropdown a").click(function(e){
        var selectedOfficerEnum = $(this).attr("data-value")
        var selectedOfficerName = this.innerHTML

        if (selectedUsers.includes(selectedOfficerEnum)) {
            $('.event_alert_fail').show()
            $('.event_alert_fail').html('The Name is Already Selected')
            setTimeout(hideMsg, 1500);
            function hideMsg() { 
                $('.event_alert_fail').fadeOut()
            }   
        }
        else{
            selectedUsers.push(selectedOfficerEnum)
            $('#users_list').append("<div class='user_div'><span id='user'>" + selectedOfficerName + "</span><input type='text' name='user[]' id='user_hidden' value='" + selectedOfficerEnum + "'><span id='close_user'>x</span></div>")
        }

        document.getElementById("myDropdown").classList.toggle("show");
    });

        
    $("body").on("click","#close_user",function(e){
        $(this).parents('.user_div').remove();
        var removedUser = $(this).siblings('#user_hidden').val();
        console.log(removedUser)
        selectedUsers.pop(removedUser)
    });
    // const selectedUsers = [];



    // $("select#officer").change(function(){
    //     var selectedOfficerEnum = $('#officer option:selected').val()
    //     var selectedOfficerName = $('#officer option:selected').text()

    //     if (selectedUsers.includes(selectedOfficerEnum)) {
    //         $('.event_alert_fail').show()
    //         $('.event_alert_fail').html('The Name is Already Selected')
    //         setTimeout(hideMsg, 1500);
    //         function hideMsg() { 
    //             $('.event_alert_fail').fadeOut()
    //         }   
    //     }
    //     else{
    //         selectedUsers.push(selectedOfficerEnum)
    //         $('#users_list').append("<div class='user_div'><span id='user'>" + selectedOfficerName + "</span><input type='text' name='user[]' id='user_hidden' value='" + selectedOfficerEnum + "'><span id='close_user'>x</span></div>")
    //     }
        
    // });
        
    // $("body").on("click","#close_user",function(e){
    //     $(this).parents('.user_div').remove();
    //     var removedUser = $(this).siblings('#user_hidden').val();
    //     console.log(removedUser)
    //     selectedUsers.pop(removedUser)
    // });

    // Dynamic Name Select


    
    // Save Event Details
    $("body").on("submit","#event_form",function(e){

        var event_name = $("#event_name").val();
        var details = $("#details").val();
        var officer = $("#officer").val();
        var billing_value = $("#billing_value").val();

        if (event_name == "" || details == "" || billing_value == "" || officer == "select") {
            $('.event_alert_fail').show()
            $('.event_alert_fail').html('Please Insert all the Details')
            setTimeout(hideMsg, 1500);
            function hideMsg() { 
                $('.event_alert_fail').fadeOut()
            }  
        }

        else{

            var form = $("#event_form");

            $.ajax({
                type: "POST",
                url:"{{ url('') }}/admin/billing_event_save",
                data: form.serialize(),
            }).done(function (data) {

                $('.event_alert_success').show()
                setTimeout(hideMsg, 3000);
                function hideMsg() { 
                    $('.event_alert_success').fadeOut()
                }
                $("#event_name").val('');
                $("#details").val('');
                $("#billing_value").val('');
                $('#users_list').html('')
                $('#officer').prop('selectedIndex',0);

                selectedUsers.length = 0
                            
            });
        }

        event.preventDefault();
    });
    // Save Event Details


</script>

@endpush
@push('page_css')
@endpush