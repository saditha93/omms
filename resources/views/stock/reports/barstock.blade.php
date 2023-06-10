@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category And Establishment wise stock</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Reports</li>
                            <li class="breadcrumb-item active">Category And Establishment wise stock</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Category And Establishment wise stock</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="category_id">Item Category</label>
                        <div class="col-sm-9">
                            <select required multiple id="category_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-dark-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-dark-500 dark:focus:border-dark-500">
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
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
                        <label class="col-sm-3" for="establishment_id">Location</label>
                        <div class="col-sm-9">
                            <select required name="establishment_id" id="establishment_id"
                                    class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($establisments as $establisment)
                                    <option value="{{$establisment->id}}">{{$establisment->name}}</option>
                                @endforeach
                            </select>
                            @error('establishment_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" id="search"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Search
                        </button>
                    </div>

                    <div class="row">
                        <div class="col overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        NO
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Item Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Item Code
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Establishment
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Quantity
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="cat_stock">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
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

    <script>

        $(document).ready(function () {
            $('#category_id').select2();
        });

        $("#search").click(function () {
            var category_id = $('#category_id').val();
            var establishment_id = $('#establishment_id').val();

            if (!category_id) {
                alert("Please enter all data")
            } else {
                $.ajax({
                    url: '{{ route('ajax.getCatEstStock') }}',
                    type: 'get',
                    data: {
                        'category_ids': category_id,
                        'bar': 1,
                        'establishment_id': establishment_id,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        var i = 1;
                        $('#cat_stock tr').remove();
                        $.each(response, function (key, value) {
                            $('#cat_stock').append("<tr><th class='py-4 px-6'>" + i++ + "</th>\
										<th class='py-4 px-6'>" + value.name + "</th>\
										<th class='py-4 px-6'>" + value.code + "</th>\
										<th class='py-4 px-6'>" + value.establishment.name + "</th>\
										<th class='py-4 px-6'>" + value.stock.qty + "</th>\
										");
                        })
                    }
                });
            }
        });

    </script>
@stop
