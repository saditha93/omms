@extends('layouts.app')


@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Settings
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Change logo
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12 justify-center overflow-hidden">
                        <form action="{{ route('store-logo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <span class="sr-only">Choose File</span>
                                <input type="file" id="logo_img" name="logo_img" class="form-control"/>

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </div>
                            @error('image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </form>

                        <div class="card-body card-user-profile-picture w-25 h-25">
                            <img class="w-50" src="" id="logo_img_div" name="logo_img_div" onError="this.onerror=null;this.src='{{asset('/flat-icon/img-not-found.png')}}';">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>


        //profile picture set to card
        $("#logo_img").change(function() {

            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#logo_img_div').attr('src', e.target.result);
                };

                reader.readAsDataURL(this.files[0]); // convert to base64 string
            }

        });

    </script>

@endpush
