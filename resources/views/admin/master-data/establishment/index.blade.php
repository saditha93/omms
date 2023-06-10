@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Establishment
            </div>
            <div class="card-body">
                @if(!isset($establishment->id))
                    <form method="POST" action="{{route('establishment.store')}}">
                        @else
                    <form method="POST" action="{{route('establishment.update',$establishment->id)}}">
                        @method('PUT')
                        @endif
                        @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="establishment" class="form-label">Establishment Name</label>
                                            <input type="text" class="form-control" name="establishment" id="establishment" value="{{isset($establishment->establishment)?$establishment->establishment:old('establishment')}}">
                                            @error('establishment')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="abbr" class="form-label">Abbreviation</label>
                                            <input type="text" class="form-control" name="abbr" id="abbr" value="{{isset($establishment->abbr)?$establishment->abbr:old('abbr')}}">
                                            @error('abbr')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!isset($establishment->id))
                                                <input class="btn btn-primary float-right" type="submit" value="Add Establishment">
                                            @else
                                                <input class="btn btn-primary float-right" type="submit" value="Update Establishment">
                                                <a class="btn btn-secondary float-right mr-1" type="button" href="{{route('establishment.index')}}">Cancel</a>
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
@endpush

