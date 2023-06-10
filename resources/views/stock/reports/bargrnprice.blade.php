@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Last GRN Price report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Reports</li>
                            <li class="breadcrumb-item active">Last GRN Price report</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Last GRN Price report</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="category_id">Parent Category</label>
                        <div class="col-sm-9">
                            <select name="category_id" id="category_id"
                                    class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a Category</option>
                                @foreach($parentCat as $item)
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
                        <label class="col-sm-3" for="parent_id">Sub Category</label>
                        <div class="col-sm-9">
                            <select name="parent_id" id="parent_id"
                                    class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="">Choose a Category</option>
                            </select>
                            @error('parent_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="item_id">Item</label>
                        <div class="col-sm-9">
                            <select required name="item_id" id="item_id"
                                    class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="0">All</option>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('item_id')
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
                                        GRN No
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        GRN Date
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Receive to
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Item Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Purchase Quantity
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Unit Price(LKR)
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Total(LKR)
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Supplier Name
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="grnprice">
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
    {{--    <script src="{{ asset('plugin/jquery/jquery.js') }}"></script>--}}
    <script>

        $("#search").click(function () {
            var id = $('#item_id').val();

            if (!id) {
                alert("Please enter all data")
            } else {
                $.ajax({
                    url: '{{ route('ajax.getGRNPrice') }}',
                    type: 'get',
                    data: {
                        'id': id,
                        'bar': 1,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        var i = 1;
                        $('#grnprice tr').remove();
                        $.each(response, function (key, value) {
                            $('#grnprice').append("<tr><th class='py-4 px-6'>" + i++ + "</th>\
										<th class='py-4 px-6'>" + value.header.no + "</th>\
										<th class='py-4 px-6'>" + value.header.date + "</th>\
										<th class='py-4 px-6'>" + value.header.establishment.name + "</th>\
										<th class='py-4 px-6'>" + value.item.name + "</th>\
										<th class='py-4 px-6'>" + value.qty + "</th>\
										<th class='py-4 px-6'>" + (value.unit_price).toLocaleString('en-US', {
                                style: 'currency',
                                currency: 'LKR'
                            }) + "</th>\
										<th class='py-4 px-6'>" + (value.qty * value.unit_price).toLocaleString('en-US', {
                                style: 'currency',
                                currency: 'LKR'
                            }) + "</th>\
										<th class='py-4 px-6'>" + value.header.supplier.name + "</th>\
										");
                        })
                    }
                });
            }
        });

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
                    $('#parent_id').append(new Option('Choose a Category', ""));
                    $.each(response, function (key, value) {
                        $('#parent_id').append(new Option(value.name, value.id));
                    });
                }
            });
        })

        $('#parent_id').change(function () {
            var category_id = $('#parent_id').val();

            $.ajax({
                url: '{{ route('ajax.getCatStock') }}',
                type: 'get',
                data: {
                    'id': category_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#item_id option').remove();
                    $('#item_id').append(new Option('Choose a Item', ""));
                    $.each(response, function (key, value) {
                        $('#item_id').append(new Option(value.name, value.id));
                    });
                }
            });
        })


    </script>
@stop
