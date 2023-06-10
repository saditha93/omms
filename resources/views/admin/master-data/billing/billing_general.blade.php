@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                General Deductions
            </div>
            <div class="card-body">

                <form id="general_form" action="" method="POST">
                @csrf

                <div class="row">

                    <p class="general_alert general_alert_fail alert alert-danger">Please Select the Officer Name</p>
                    <p class="general_alert general_alert_success alert alert-success">General Deduction has been added Successfully</p>

                    <div class="col-md-12">
                        <div class="col-md-6 pl-0">
                            <div class="form-group">
                                <label for="officer" class="form-label">Select Date</label>
                                <input type="text" autocomplete="off" placeholder="Date" class="form-control datepicker order_date" name="order_date" id="datepicker1">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-6 m-0 float-left pl-0">
                            <div class="form-group">
                                <label for="deducation_name" class="form-label">Deduction Name</label>
                                <input id="deducation_name" name="deducation_name" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 m-0 float-left">
                            <div class="form-group">
                                <label for="deducation_value" class="form-label">Value</label>
                                <input id="deducation_value" name="deducation_value" type="number" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="col-md-6 m-0 float-left pl-0">
                            <div class="form-group">
                                <label for="officer" class="form-label">Add Members</label>
                                <div class="dropdown">
                                <a id="dropbtn" class="dropbtn">Select the Name</a>
                                <div id="myDropdown" class="dropdown-content">
                                    <input class="myInput" type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                                    <a href="#" data-value="1">- ALL THE MEMBERS -</a>
                                    @foreach($officers as $officer)
                                    <a href="#" data-value="{{$officer->email}}">{{ $officer->service_no}}  {{ $officer->name_according_to_part2}}</a>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 m-0 float-left except_list">
                            <div class="form-group">
                                <label for="officer" class="form-label">Except Members</label>
                                <div class="dropdown">
                                <a id="dropbtn2" class="dropbtn">Select the Name</a>
                                <div id="myDropdown2" class="dropdown-content">
                                    <input class="myInput" type="text" placeholder="Search.." id="myInput2" onkeyup="filterFunction2()">
                                    @foreach($officers as $officer)
                                    <a href="#" data-value="{{$officer->email}}">{{ $officer->service_no}}  {{ $officer->name_according_to_part2}}</a>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                        </div>    

                        </div>  
                        <div id="users_list" class="users_list col-md-6 pl-0"></div> 
                        <div id="users_list2" class="users_list col-md-6 pl-0"></div> 
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <button id="create_event_bill" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>


                </div>
                <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->
                </form>

            </div>

        </div>

    </div>
    
@endsection
@push('scripts')    

    <script src="{{asset('/js/datepicker/datepicker.js')}}"></script>
    <script>



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



    // Search Dropdown List 1
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
    $("#dropbtn").click(function(){
        document.getElementById("myDropdown").classList.toggle("show");
        $("#myInput").val('');
    });
    // Search Dropdown List 1



    // Search Dropdown List 2
    function filterFunction2() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown2");
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
    $("#dropbtn2").click(function(){
        document.getElementById("myDropdown2").classList.toggle("show");
        $("#myInput2").val('');
    });
    // Search Dropdown List 2
















    var selectedUsers = [];
    var selectedUsers2 = [];

    // 1st myDropdown Function
    $("#myDropdown a").click(function(e){

        var selectedOfficerEnum = $(this).attr("data-value")
        var selectedOfficerName = this.innerHTML
        console.log(selectedUsers)
        console.log(selectedUsers2)

        selectedUsers2 = [];

        $('#users_list2').html('')

        if (selectedOfficerEnum == 1) { // When select all the members
            $('#users_list').html("<div class='user_div'><span id='user'>" + selectedOfficerName + "</span><input type='text' name='user[]' id='user_hidden' value='" + selectedOfficerEnum + "'><span id='close_user' class='close_user'>x</span></div>")
            selectedUsers.length = 0
            selectedUsers.push('1')

            $('.except_list').show();

            selectedUsers2 = [];
        }
        else{ // When select a single member         

            $('.except_list').hide();
            
            if (selectedUsers.includes(selectedOfficerEnum)) { // Member alredy selected
                $('.general_alert_fail').show()
                $('.general_alert_fail').html('The Name is Already Selected')
                setTimeout(hideMsg, 1500);
                function hideMsg() { 
                    $('.general_alert_fail').fadeOut()
                }   
            }
            else{  // Add members
                if ($('#users_list:contains("- ALL THE MEMBERS -")').length > 0) { // If ALL THE MEMBERS name exists

                    $('#users_list').html('') // Clear ALL THE MEMBERS name
                    selectedUsers2 = [];

                    // Add selected member name. 1st time
                    $('#users_list').append("<div class='user_div'><span id='user'>" + selectedOfficerName + "</span><input type='text' name='user[]' id='user_hidden' value='" + selectedOfficerEnum + "'><span id='close_user' class='close_user'>x</span></div>")

                } else {
                    // Add selected member name. 2nd time and upwords
                    selectedUsers.push(selectedOfficerEnum)
                    $('#users_list').append("<div class='user_div'><span id='user'>" + selectedOfficerName + "</span><input type='text' name='user[]' id='user_hidden' value='" + selectedOfficerEnum + "'><span id='close_user' class='close_user'>x</span></div>")
                }

            }
        }

        document.getElementById("myDropdown").classList.toggle("show");
    });
    // Close button  
    $("body").on("click","#close_user",function(e){
        $(this).parents('.user_div').remove();
        var removedUser = $(this).siblings('#user_hidden').val();
        selectedUsers.pop(removedUser)
    });
    // Close button  
    // 1st myDropdown Function














    // 2nd myDropdown2 Function
    $("#myDropdown2 a").click(function(e){

        var selectedOfficerEnum = $(this).attr("data-value")
        var selectedOfficerName = this.innerHTML
        console.log(selectedUsers)
        console.log(selectedUsers2)

        if (selectedUsers2.includes(selectedOfficerEnum)) { // Member alredy selected
            $('.general_alert_fail').show()
            $('.general_alert_fail').html('The Name is Already Selected')
            setTimeout(hideMsg, 1500);
            function hideMsg() { 
                $('.general_alert_fail').fadeOut()
            }   
        }
        else{  // New member. Show him
            selectedUsers2.push(selectedOfficerEnum)

            $('#users_list2').show();

            $('#users_list2').append("<div class='user_div'><span id='user'>" + selectedOfficerName + "</span><input type='text' name='user2[]' id='user_hidden' value='" + selectedOfficerEnum + "'><span id='close_user2' class='close_user'>x</span></div>")
        }

        document.getElementById("myDropdown2").classList.toggle("show");
    });
    // Close button  
    $("body").on("click","#close_user2",function(e){
        $(this).parents('.user_div').remove();
        var removedUser2 = $(this).siblings('#user_hidden').val();
        selectedUsers2.pop(removedUser2)
    });
    // Close button  
    // 2nd myDropdown2 Function
















    
    // Save or Submit Data
    $("body").on("submit","#general_form",function(e){

        var deducation_name = $("#deducation_name").val();
        var deducation_value = $("#deducation_value").val();

        if (deducation_name == "" || deducation_value == "" ) {
            $('.general_alert_fail').show()
            $('.general_alert_fail').html('Please Insert all the Details')
            setTimeout(hideMsg, 1500);
            function hideMsg() { 
                $('.general_alert_fail').fadeOut()
            }  
        }
        else{
            var form = $("#general_form");

            $.ajax({
                type: "POST",
                url:"{{ url('') }}/admin/general_deduction_save",
                data: form.serialize(),
            }).done(function (data) {

                $('.general_alert_success').show()
                setTimeout(hideMsg, 3000);
                function hideMsg() { 
                    $('.general_alert_success').fadeOut()
                }
                $("#deducation_name").val('');
                $("#deducation_value").val('');
                $('#users_list').html('')
                $('#users_list2').html('')

                selectedUsers.length = 0

            });
        }
        event.preventDefault();

    });
    // Save or Submit Data

    </script>

@endpush

@push('page_css')

@endpush

