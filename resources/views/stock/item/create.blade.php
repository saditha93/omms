@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Item </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Items</li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Item</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('stockItem.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

                        @can('super-admin')
                            <div class="form-group row">
                                <label class="col-sm-3" for="establishment_id">Establishment</label>
                                <div class="col-sm-9">
                                    <select required name="establishment_id" id="establishment_id"
                                            class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected value="">Choose a Establishment</option>
                                        @foreach($establisments as $establisment)
                                            <option
                                                @selected($establisment->id == old('establishment_id')) value="{{$establisment->id}}">{{$establisment->name}}</option>
                                        @endforeach
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
                                    @foreach($categories as $category)
                                        @if($category->code != 'bar_item')
                                            <option
                                                @selected($category->id == old('category_id')) value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                    @endforeach
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
                                    @foreach($categories as $category)
                                        <option
                                            @selected($category->id == old('parent_id')) value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
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
                                    @foreach($categories as $category)
                                        <option
                                            @selected($category->id == old('child_id')) value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
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
                                    @foreach($categories as $category)
                                        <option
                                            @selected($category->id == old('sub_child_id')) value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
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
                                       placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="code">Item Code</label>
                            <div class="col-sm-8">
                                <input readonly type="text" name="code"
                                       class="form-control   @error('code') is-invalid @enderror" id="code"
                                       placeholder="Code" value="{{ old('code') }}">
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
                                    <option selected value="">Choose a measure unit</option>
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
                                    @if(old('active'))
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

        function Random() {
            return Math.floor(Math.random() * 1000000000);
        }

        $('#code').ready(function () {
            document.getElementById('code').value = Random();
        })

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

        $('#establishment_id').ready(function () {
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
                    $('#category_id').append(new Option('Stock', ''));
                    $.each(response, function (key, value) {
                        if (value.code != 'bar_item') {
                            $('#category_id').append(new Option(value.name, value.id));
                        }
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
                    $.each(response, function (key, value) {
                        $('#measure_unit_id').append(new Option(value.name, value.id));
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
                    $.each(response, function (key, value) {
                        $('#measure_unit_id').append(new Option(value.name, value.id));
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
                    $.each(response, function (key, value) {
                        $('#measure_unit_id').append(new Option(value.name, value.id));
                    });
                }
            });
        })

        ///////////////////////////////////////////////////////////////////////////////////////////////End Measuer Unit ////////////////////////////////


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
                    $.each(response, function (key, value) {
                        $('#measure_unit_id').append(new Option(value.abbreviation, value.id));
                    });
                }
            });
        })

        $('#establishment_id').ready(function () {
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
                    $.each(response, function (key, value) {
                        $('#measure_unit_id').append(new Option(value.abbreviation, value.id));
                    });
                }
            });
        })

    </script>
@stop
