<!-- Outer Top Bar -->
<div class="user">
    <div class="icon"></div>
    <p class="officer_id" id="officer_id"></p>
</div> 
<!-- Outer Top Bar -->


<script>
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
