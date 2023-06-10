@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Item </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Items</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit {{ $item->name }}</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('stockItem.update',$item->id) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        @can('super-admin')
                            <div class="form-group row">
                                <label class="col-sm-3" for="establishment_id">Establishment</label>
                                <div class="col-sm-9">
                                    <select required name="establishment_id" id="establishment_id"
                                            class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @if(isset($item->establishment->id))
                                            @foreach($establisments as $establisment)
                                                <option
                                                    @selected($item->establishment->id == $establisment->id)  value="{{$establisment->id}}">{{$establisment->name}}</option>
                                            @endforeach
                                        @else
                                            <option selected value="">Choose a Establishment</option>
                                            @foreach($establisments as $establisment)
                                                <option value="{{$establisment->id}}">{{$establisment->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('establishment_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        @endcan

                        <div class="form-group row">
                            <label class="col-sm-3" for="category_id">Parent Category</label>
                            <div class="col-sm-9">
                                <select name="category_id" id="category_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value=" ">Stock</option>
                                    @if(isset($parentCategories))
                                        @foreach($parentCategories as $categoryItem)
                                                <option
                                                    @selected($parentid == $categoryItem->id)  value="{{$categoryItem->id}}">{{$categoryItem->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="parent_id">Sub Category</label>
                            <div class="col-sm-9">
                                <select name="parent_id" id="parent_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Category</option>
                                    @if(isset($subCategories))
                                        @foreach($subCategories as $categoryItem)
                                            <option
                                                @selected(isset($subCategory->id) && $subCategory->id == $categoryItem->id)  value="{{$categoryItem->id}}">{{$categoryItem->name}}</option>
                                        @endforeach
                                    @endif

                                </select>
                                @error('parent_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="child_id">Child Category</label>
                            <div class="col-sm-9">
                                <select name="child_id" id="child_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Category</option>
                                    @if(isset($childCategories))
                                        @foreach($childCategories as $categoryItem)
                                            <option
                                                @selected(isset($childCategory->id) && $childCategory->id == $categoryItem->id) value="{{$categoryItem->id}}">{{$categoryItem->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('child_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="sub_child_id">Sub Child Category</label>
                            <div class="col-sm-9">
                                <select name="sub_child_id" id="sub_child_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Category</option>
                                    @if(isset($subchildCategories))
                                        @foreach($subchildCategories as $categoryItem)
                                            <option
                                                @selected(isset($subchildCategory->id) && $subchildCategory->id == $categoryItem->id) value="{{$categoryItem->id}}">{{$categoryItem->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('sub_child_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="name">Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="name"
                                       class="form-control   @error('name') is-invalid @enderror" id="name"
                                       placeholder="Name" value="{{ $item->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="code">Item Code</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="code"
                                       class="form-control   @error('code') is-invalid @enderror" id="code"
                                       placeholder="Code" value="{{ $item->code }}">
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="measure_unit_id">Measure Unit</label>
                            <div class="col-sm-9">
                                <select required name="measure_unit_id" id="measure_unit_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @if($item->measure_unit->id)
                                        @foreach($measureUnits as $measureUnit)
                                            <option
                                                @selected($item->measure_unit->id == $measureUnit->id) value="{{$measureUnit->id}}">{{$measureUnit->name}} - {{ $measureUnit->size}} {{ $measureUnit->size_type }}</option>
                                        @endforeach
                                    @else
                                        <option selected>Choose a measure unit</option>
                                        @foreach($measureUnits as $measureUnit)
                                            <option value="{{$measureUnit->id}}">{{$measureUnit->name}} - {{ $measureUnit->size}} {{ $measureUnit->size_type }}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="active">Active</label>
                            <div class="col-sm-9">
                                <label class="inline-flex relative items-center mb-4 cursor-pointer">
                                    @if($item->active == 1)
                                        <input checked type="checkbox" name="active" value="1"
                                               class="sr-only peer">
                                    @else
                                        <input type="checkbox" name="active" value="1"
                                               class="sr-only peer">
                                    @endif
                                    <div
                                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                </label>
                                @error('active')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                    </div>

                    <div class="card-footer">
                        <button type="submit"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('plugin/MCDatepicker/mc-calendar.min.css') }}"/>
@stop

@section('third_party_scripts')
    <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
    <script src="{{ asset('plugin/MCDatepicker/mc-calendar.min.js') }}"></script>
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
    <script src="{{ asset('plugin/jquery/jquery.js') }}"></script>
    <script>

        $('#establishment_id').change(function () {
            var establishment_id = $('#establishment_id').val();
            var category_id = $('#category_id').val();

            $.ajax({
                url: '{{ route('ajax.getTreeCategory') }}',
                type: 'get',
                data: {
                    'establishment_id': establishment_id,
                    'category_id': 0,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#category_id option').remove();
                    $('#parent_id option').remove();
                    $('#child_id option').remove();
                    $('#sub_child_id option').remove();
                    $('#category_id').append(new Option('Stock', 0));
                    $.each(response, function (key, value) {
                        $('#category_id').append(new Option(value.name, value.id));
                    });
                }
            });
        })

        $('#category_id').change(function () {
            var establishment_id = $('#establishment_id').val();
            var category_id = $('#category_id').val();

            $.ajax({
                url: '{{ route('ajax.getTreeCategory') }}',
                type: 'get',
                data: {
                    'establishment_id': establishment_id,
                    'category_id': category_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#parent_id option').remove();
                    $('#child_id option').remove();
                    $('#sub_child_id option').remove();
                    $('#parent_id').append(new Option('Choose a Category', ""));
                    $.each(response, function (key, value) {
                        $('#parent_id').append(new Option(value.name, value.id));
                    });
                }
            });
        })

        $('#parent_id').change(function () {
            var establishment_id = $('#establishment_id').val();
            var category_id = $('#parent_id').val();

            $.ajax({
                url: '{{ route('ajax.getTreeCategory') }}',
                type: 'get',
                data: {
                    'establishment_id': establishment_id,
                    'category_id': category_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#child_id option').remove();
                    $('#sub_child_id option').remove();
                    $('#child_id').append(new Option('Choose a Category', ""));
                    $.each(response, function (key, value) {
                        $('#child_id').append(new Option(value.name, value.id));
                    });
                }
            });
        })

        $('#child_id').change(function () {
            var establishment_id = $('#establishment_id').val();
            var category_id = $('#child_id').val();

            $.ajax({
                url: '{{ route('ajax.getTreeCategory') }}',
                type: 'get',
                data: {
                    'establishment_id': establishment_id,
                    'category_id': category_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#sub_child_id option').remove();
                    $('#sub_child_id option').remove();
                    $('#sub_child_id').append(new Option('Choose a Category', ""));
                    $.each(response, function (key, value) {
                        $('#sub_child_id').append(new Option(value.name, value.id));
                    });
                }
            });
        })

        $('#establishment_id').change(function () {
            var id = $(this).val();

            $.ajax({
                url: '{{ route('ajax.getCategory') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#categories option').remove();
                    $.each(response, function (key, value) {
                        $('#categories').append(new Option(value.name, value.id));
                    });
                }
            });
        })

        $('#establishment_id').change(function () {
            var id = $(this).val();

            $.ajax({
                url: '{{ route('ajax.getMeasureUnit') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#measure_unit_id option').remove();
                    $.each(response, function (key, data) {
                        if (data.size == null) {
                            $('#measure_unit_id').append(new Option(data.name, data.id));
                        } else {
                            $('#measure_unit_id').append(new Option(data.name + ' (' + data.size + ' ' + data.size_type + ')', data.id));
                        }
                    });
                }
            });
        })

        ////////////////////////////////////////////////////////Messuer Unit load //////////////////////////////

        $('#category_id').change(function () {
            var category_id = $('#category_id').val();
            $.ajax({
                url: '{{ route('ajax.getMesCategory') }}',
                type: 'get',
                data: {
                    'category_id': category_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#measure_unit_id option').remove();
                    $.each(response, function (key, data) {
                        if (data.size == null) {
                            $('#measure_unit_id').append(new Option(data.name, data.id));
                        } else {
                            $('#measure_unit_id').append(new Option(data.name + ' (' + data.size + ' ' + data.size_type + ')', data.id));
                        }
                    });
                }
            });
        })

        $('#parent_id').change(function () {
            var category_id = $('#parent_id').val();
            $.ajax({
                url: '{{ route('ajax.getMesCategory') }}',
                type: 'get',
                data: {
                    'category_id': category_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#measure_unit_id option').remove();
                    $.each(response, function (key, data) {
                        if (data.size == null) {
                            $('#measure_unit_id').append(new Option(data.name, data.id));
                        } else {
                            $('#measure_unit_id').append(new Option(data.name + ' (' + data.size + ' ' + data.size_type + ')', data.id));
                        }
                    });
                }
            });
        })

        $('#child_id').change(function () {
            var category_id = $('#child_id').val();
            $.ajax({
                url: '{{ route('ajax.getMesCategory') }}',
                type: 'get',
                data: {
                    'category_id': category_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#measure_unit_id option').remove();
                    $.each(response, function (key, data) {
                        if (data.size == null) {
                            $('#measure_unit_id').append(new Option(data.name, data.id));
                        } else {
                            $('#measure_unit_id').append(new Option(data.name + ' (' + data.size + ' ' + data.size_type + ')', data.id));
                        }
                    });
                }
            });
        })

        ///////////////////////////////////////////////////////////////////////////////////////////////End Measuer Unit ////////////////////////////////

    </script>
@stop
