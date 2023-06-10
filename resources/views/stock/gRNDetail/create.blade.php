@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Item to GRN {{str_pad($header_id, 10, "0", STR_PAD_LEFT)}}</h1>
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
                    <div class="card-title">Add Item to GRN</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('gRNDetail.store') }}"
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
                                <select required required name="item_id" id="item_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">Choose a Item</option>
                                    @foreach($items as $item)
                                        <option @selected($item->id == old('item_id')) value="{{$item->id}}
                                            ">{{$item->name}}</option>
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
                            <label class="col-sm-3" for="avl_qty">Available Qty</label>
                            <div class="col-sm-9">
                                <input readonly type="text" name="avl_qty"
                                       class="form-control   @error('avl_qty') is-invalid @enderror" id="avl_qty"
                                       placeholder="Available Qty" value="{{ old('avl_qty') }}">
                                @error('avl_qty')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="qty">Qty</label>
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
                            <label class="col-sm-3" for="unit_price">Unit Price</label>
                            <div class="col-sm-9">
                                <input type="text" name="unit_price"
                                       class="form-control   @error('unit_price') is-invalid @enderror" id="unit_price"
                                       placeholder="Unit Price" value="{{ old('unit_price') }}">
                                @error('unit_price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="expire_date">Expire Date</label>
                            <div class="col-sm-9">
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="expire_date" value="{{ old('expire_date') }}"
                                           name="expire_date"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date">
                                </div>
                                @error('expire_date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="manufacture_date">Manufacture Date</label>
                            <div class="col-sm-9">
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input required type="text" value="{{ old('manufacture_date') }}"
                                           id="manufacture_date"
                                           name="manufacture_date"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date">
                                </div>
                                @error('manufacture_date')
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
                        <button type="button" id="close"
                                class=" float-right text-white bg-red-800 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-700 dark:border-red-700">
                            Close GRN
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
                                Price (LKR)
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Amount (LKR)
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Expire Date
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Manufacture Date
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
                                    {{number_format((float)$headerItem->unit_price, 2, '.', '')}}
                                </td>
                                <td class="py-4 px-6">
                                    {{number_format((float)$headerItem->qty * $headerItem->unit_price, 2, '.', '')}}
                                </td>
                                <td class="py-4 px-6">
                                    {{$headerItem->expire_date}}
                                </td>
                                <td class="py-4 px-6">
                                    {{$headerItem->manufacture_date}}
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
                                    <form action="{{ route('gRNDetail.destroy',$headerItem->id)  }}" method="POST"
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

        const picker1 = MCDatepicker.create({
            el: '#expire_date',
            dateFormat: 'YYYY/MM/DD',
            bodyType: 'inline',
            autoClose: true,
            closeOnBlur: true,
            minDate: new Date(),
            theme: {
                theme_color: '#151414',
                active_text_color: 'rgb(0, 0, 0)'
            }
        });

        const picker2 = MCDatepicker.create({
            el: '#manufacture_date',
            dateFormat: 'YYYY/MM/DD',
            bodyType: 'inline',
            autoClose: true,
            closeOnBlur: true,
            maxDate: new Date(),
            theme: {
                theme_color: '#151414',
                active_text_color: 'rgb(0, 0, 0)'
            }
        });

        $('#close').click(function () {
            var id = $('#header_id').val();

            $.ajax({
                url: '{{ route('ajax.closeGRN') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (confirm("Are you sure you want to close?")) {
                        window.location.href = "{{ route('gRNHeader.index')}}";
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
                    $('#child_id option').remove();
                    $('#parent_id option').remove();
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
                    $('#child_id option').remove();
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
