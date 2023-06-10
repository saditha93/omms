

<meta name="csrf-token" content="{{ csrf_token() }}" />       


<!-- Outer Top Bar -->
<div class="user">
    <div class="icon2"></div>
    <p class="officer_id" id="officer_id"></p>
</div> 
<!-- Outer Top Bar -->


<script>
    window.onscroll = function() {myFunction()};

    // Stick top bar when scrolling
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

        $.ajax({
        url:"{{ url('') }}/app_mobile/personal_details", 
        method:'POST',
        data:{ "_token": "{{ csrf_token() }}" },
        success:function(data){
            console.log(data)
            $("#officer_id").html(data)
        }
        });

    });
    
    
</script>

