@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Item to Issue Note To {{str_pad($header_id, 10, "0", STR_PAD_LEFT)}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Add Items</li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Add Item to Issue Note</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('issueDetail.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card-body">

                        <input type="hidden" name="header_id" id="header_id" value="{{ $header_id }}">
                        <input type="hidden" name="establishment_id" id="establishment_id"
                               value="{{ $establishment_id }}">

                        <div class="form-group row">
                            <label class="col-sm-3" for="category_id">Parent Category</label>
                            <div class="col-sm-9">
                                <select name="category_id" id="category_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Category</option>
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
                            <label class="col-sm-3" for="child_id">Child Category</label>
                            <div class="col-sm-9">
                                <select name="child_id" id="child_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Category</option>
                                </select>
                                @error('child_id')
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
                                        <option
                                            @selected($item->id == old('item_id')) value="{{$item->id}}">{{$item->name}}</option>
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
                            <label class="col-sm-3" for="measure_unit">Measure Unit</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="measure_unit"
                                       class="form-control   @error('qty') is-invalid @enderror" id="measure_unit"
                                       placeholder="Measure Unit" value="{{ old('measure_unit') }}">
                                @error('Measure Unit')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="avl_qty">Available Qty</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-7">
                                        <input readonly type="text" name="avl_qty"
                                               class="form-control   @error('avl_qty') is-invalid @enderror"
                                               id="avl_qty"
                                               placeholder="Available Qty" value="{{ old('avl_qty') }}">
                                    </div>
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="below_qty">Below Level</label>
                                            </div>
                                            <div class="col-9">
                                                <input readonly type="text" name="below_qty"
                                                       class="form-control   @error('below_qty') is-invalid @enderror"
                                                       id="below_qty"
                                                       placeholder="Below Level" value="{{ old('below_qty') }}">
                                            </div>
                                        </div>
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
                                                <th scope="col" class="py-3 px-6">
                                                    Expire Date
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

                        <div class="form-group row">
                            <label class="col-sm-3" for="select_grn">Select GRN To Issue Qty</label>
                            <div class="col-sm-9">
                                <select required name="select_grn" id="select_grn"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Select GRN</option>
                                </select>
                                @error('select_grn')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="qty">Issue Qty</label>
                            <div class="col-sm-9">
                                <input type="text" name="qty"
                                       class="form-control   @error('qty') is-invalid @enderror" id="qty"
                                       placeholder="Qty" value="{{ old('qty') }}">
                                @error('qty')
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
                        <button type="submit" onclick="clicked(event)"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Submit
                        </button>
                        <button type="button" id="close"
                                class=" float-right text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-700 dark:border-red-700">
                            Close GIN
                        </button>
                    </div>
                </form>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Product name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Quantity
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Unit Price
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Total Cost
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Status
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($headerItems as $headerItem)
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$headerItem->item->name}}
                                </th>
                                <td class="py-4 px-6">
                                    {{$headerItem->qty}}
                                </td>
                                <td class="py-4 px-6">
                                    {{$headerItem->unit_price}} LKR
                                </td>
                                <td class="py-4 px-6">
                                    {{$headerItem->unit_price * $headerItem->qty}} LKR
                                </td>
                                <td class="py-4 px-6">
                                    @if ($headerItem->active == 1)
                                        <mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active
                                        </mark>
                                    @else
                                        <mark class="px-2 text-white bg-danger rounded dark:bg-danger">deactivate</mark>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    <form action="{{ route('issueDetail.destroy',$headerItem->id)  }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-danger btn-xs  dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                                onclick="return confirm('Do you need to delete this');">
                                            <i class="fa fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Total Price</label>
                        <div class="col-sm-9">
                            <span>{{$header->total}} LKR</span>
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


        function clicked(e) {
            if ($('#qty').val()) {
                if (($('#avl_qty').val() - $('#below_qty').val()) < $('#qty').val()) {
                    if (!confirm('Item stock below level reach')) {
                        e.preventDefault();
                    }
                }
            }
        }

        $('#close').click(function () {
            var id = $('#header_id').val();

            $.ajax({
                url: '{{ route('ajax.closeIN') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (confirm("Are you sure you want to close?")) {
                        window.location.href = "{{ route('issueHeader.index')}}";
                    }
                    return false;
                }
            });
        });


        $('#item_id').change(function () {
            var id = $(this).val();

            $.ajax({
                url: '{{ route('ajax.getStock') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#avl_qty').val(data.qty);
                    $('#below_qty').val(data.below_qty);
                }
            });

            $.ajax({
                url: '{{ route('ajax.getItem') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#measure_unit').val(data.measure_unit.abbreviation);
                }
            });

        })

        $('#category_id').ready(function () {
            var establishment_id = $('#establishment_id').val();

            $.ajax({
                url: '{{ route('ajax.getTreeCategory') }}',
                type: 'get',
                data: {
                    'establishment_id': establishment_id,
                    'category_id': "0",
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#category_id option').remove();
                    $('#category_id').append(new Option('Choose a Category', ""));
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
                    $('#parent_id').append(new Option('Choose a Category', ""));
                    $.each(response, function (key, value) {
                        $('#parent_id').append(new Option(value.name, value.id));
                    });
                }
            });

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

        $('#parent_id').change(function () {

            var category_id = $('#parent_id').val();
            var establishment_id = $('#establishment_id').val();

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
                    $('#child_id').append(new Option('Choose a Category', ""));
                    $.each(response, function (key, value) {
                        $('#child_id').append(new Option(value.name, value.id));
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
                    $('#select_grn option').remove();
                    $.each(response, function (key, value) {
                        $('#in').append("<tr><th class='py-4 px-6'>" + value.header.order_no + "</th>\
										<th class='py-4 px-6'>" + value.header.date + "</th>\
										<th class='py-4 px-6'>" + value.qty + "</th>\
										<th class='py-4 px-6'>" + value.avl_qty + "</th>\
										<th class='py-4 px-6'>" + (value.unit_price).toLocaleString('en-US', {
                            style: 'currency',
                            currency: 'LKR'
                        }) + "</th>\
										<th class='py-4 px-6'>" + value.expire_date + "</th>\
										");

                        $('#select_grn').append(new Option(value.header.order_no + ' - ' + (value.unit_price).toLocaleString('en-US', {
                            style: 'currency',
                            currency: 'LKR'
                        }) + ' (Avl Qty - ' + value.avl_qty + ')', value.id));

                    })
                }
            });

        })

        $("#item_id").ready(function () {
            var id = $('#item_id').val();
            if (id) {
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
                        $('#select_grn option').remove();
                        $.each(response, function (key, value) {
                            $('#in').append("<tr><th class='py-4 px-6'>" + value.header.order_no + "</th>\
										<th class='py-4 px-6'>" + value.header.date + "</th>\
										<th class='py-4 px-6'>" + value.qty + "</th>\
										<th class='py-4 px-6'>" + value.avl_qty + "</th>\
										<th class='py-4 px-6'>" + (value.unit_price).toLocaleString('en-US', {
                                style: 'currency',
                                currency: 'LKR'
                            }) + "</th>\
										<th class='py-4 px-6'>" + value.expire_date + "</th>\
										");

                            $('#select_grn').append(new Option(value.header.order_no + ' - ' + (value.unit_price).toLocaleString('en-US', {
                                style: 'currency',
                                currency: 'LKR'
                            }) + ' (Avl Qty - ' + value.avl_qty + ')', value.id));

                        })
                    }
                });
            }
        })

        $('#child_id').change(function () {
            var category_id = $('#child_id').val();

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
