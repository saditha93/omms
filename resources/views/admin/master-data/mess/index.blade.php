@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Mess
            </div>
            <div class="card-body">
                @if(!isset($mess->id))
                    <form method="POST" action="{{route('mess.store')}}">
                @else
                    <form method="POST" action="{{route('mess.update',$mess->id)}}">
                    @method('PUT')
                @endif
                    @csrf
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="form-group">
                                <label for="estb" class="form-label">Establishment</label>
                                <select class="form-control" name="estb" id="estb" {{isset($mess->estb)?'disabled':''}}>
                                    <option value="">Select Establishment</option>
                                    @foreach($establishments as $establishment)
                                        <option {{isset($mess->estb)?$establishment->id==$mess->estb?'selected':'':''}} value="{{$establishment->id}}">{{$establishment->establishment}} / {{$establishment->abbr}}</option>
                                    @endforeach
                                </select>
                                @error('estb')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="form-label">Mess Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{isset($mess->name)?$mess->name:old('name')}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location" class="form-label">Mess Location</label>
                                <input type="text" class="form-control" name="location" id="location" placeholder="" value="{{isset($mess->location)?$mess->location:old('location')}}">
                                @error('location')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="code" class="form-label">Mess Code</label>
                                <input type="text" disabled readonly class="form-control" name="code" id="code" placeholder="" value="{{isset($mess->code)?$mess->code:''}}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                @if(!isset($mess->id))
                                <input class="btn btn-primary float-right" type="submit" value="Add Mess">
                                @else
                                <input class="btn btn-primary float-right" type="submit" value="Update Mess">
                                <a class="btn btn-secondary float-right mr-1" type="button" href="{{route('mess.index')}}">Cancel</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}


    <script>

        $( document ).ready(function() {

            $("#estb").change(function(){
                let establishmentId = this.value;

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('establishment-code')}}',
                    type: 'POST',
                    data: {establishmentId:establishmentId},
                    success: function (response) {
                        $('#code').val(response);
                    },
                    error: function (error) {
                    }
                });
            });

        });

    </script>
@endpush

