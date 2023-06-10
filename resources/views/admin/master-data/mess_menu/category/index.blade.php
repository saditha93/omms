@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Serving Category
            </div>
            <div class="card-body">
                @if(!isset($category->id))
                    <form method="POST" action="{{route('category.store')}}">
                        @else
                    <form method="POST" action="{{route('category.update',$category->id)}}">
                @method('PUT')
                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(\Illuminate\Support\Facades\Auth::user()->user_type ==1)
                                            <label for="name" class="form-label">Category Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{isset($category->category_name)?$category->category_name:old('name')}}">
                                            @endif
                                                @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!isset($category->id))
                                                @if(\Illuminate\Support\Facades\Auth::user()->user_type ==1)
                                                <input class="btn btn-primary float-right" type="submit" value="Add Category">
                                                @endif
                                            @else
                                                @if(\Illuminate\Support\Facades\Auth::user()->user_type ==1)
                                                <input class="btn btn-primary float-right" type="submit" value="Update Category">
                                                @endif
                                                <a class="btn btn-secondary float-right mr-1" type="button" href="{{route('category.index')}}">Cancel</a>
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

