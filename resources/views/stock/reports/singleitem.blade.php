@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Current stock of a item </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Reports</li>
                            <li class="breadcrumb-item active">Current stock of a item</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Current stock of a item</div>
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
                                <option selected value="">Choose a Item</option>
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

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Name</label>
                        <div class="col-sm-9">
                            <span id="name"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="code">Item Code</label>
                        <div class="col-sm-5 input-group">
                            <span id="code"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="establishment">Establishment</label>
                        <div class="col-sm-9">
                            <span id="establishment"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="category">Categories</label>
                        <div class="col-sm-5 input-group">
                            <span id="category"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="measure_unit">Measure Unit</label>
                        <div class="col-sm-5 input-group">
                            <span id="measure_unit"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="stock">Available Qty</label>
                        <div class="col-sm-5 input-group">
                            <span id="stock"></span>
                        </div>
                    </div>

                    <div class="row avl_qty" style="display: none">
                        <div class="col overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Good Receive No
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Good Receive Date
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Received Qty
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Available Qty
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Unit Price
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="in">

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
    <script src="{{ asset('plugin/jquery/jquery.js') }}"></script>
    <script>

        $('#item_id').change(function () {
            var id = $(this).val();

            $.ajax({
                url: '{{ route('ajax.getItem') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data)
                    if (typeof data.name !== 'undefined') {
                        $('#name').text(data.name);
                        $('#code').text(data.code);
                        $('#stock').text(data.stock.qty + " " + data.measure_unit.abbreviation);
                        $('#establishment').text(data.establishment.name);

                        const category = data.categories.map((x) => x.name);
                        let result = '';
                        if (category.length === 1) {
                            result = category[0];
                        } else {
                            const lastName = category.pop();
                            result = category.join(', ') + ' and ' + lastName;
                        }
                        $('#category').text(result);
                        $('#measure_unit').text(data.measure_unit.abbreviation);
                    } else {
                        $('#name').text("");
                        $('#code').text("");
                        $('#stock').text("");
                        $('#establishment').text("");
                        $('#category').text("");
                        $('#measure_unit').text("");
                    }
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

        $("#item_id").change(function () {
            var id = $('#item_id').val();
            $.ajax({
                url: '{{ route('ajax.grnAvalable') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#in tr').remove();
                    console.log(response.length)
                    if (response.length > 0) {
                        $(".avl_qty").css("display", "block");
                    } else {
                        $(".avl_qty").css("display", "none");
                    }
                    $.each(response, function (key, value) {
                        $('#in').append("<tr><th class='py-4 px-6'>" + value.header.order_no + "</th>\
										<th class='py-4 px-6'>" + value.header.date + "</th>\
										<th class='py-4 px-6'>" + value.qty + "</th>\
										<th class='py-4 px-6'>" + value.avl_qty + "</th>\
										<th class='py-4 px-6'>" + (value.unit_price).toLocaleString('en-US', {
                            style: 'currency',
                            currency: 'LKR'
                        }) + "</th>\
										");
                    })
                }
            });
        });

    </script>
@stop
