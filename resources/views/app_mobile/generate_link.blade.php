<!DOCTYPE html>
<html lang="en">
<head>
    @include('app_mobile/inc/links')
    <title>Generate Link</title>
</head>

<body>

<label for="id">UN-O</label>
<input id="id" type="text" value="">

<label for="enumber">P-E</label>
<input id="enumber" type="text" value="">

<p class="txt"></p>

<button id="submit" type="button">Generate</button>



<script>
    
    $("#submit").click(function(){   
    
        var id = $('#id').val()
        var enumber = $('#enumber').val()

        $.ajax({
            url:"{{ url('') }}/app_mobile/gen_func",
            method:'POST',
            data:{ "_token": "{{ csrf_token() }}" , id:id , enumber:enumber },
            success:function(data){
                // console.log(data)
                $(".txt").html(data)
            }
        });

    })
</script>
</body>
</html>