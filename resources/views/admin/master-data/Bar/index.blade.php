@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Bar Orders
                <div class="card-tools">
                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                </div>
            </div>

            <form method="POST" action="{{route('save-bar-orders')}}">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="officer" class="form-label">Respective Officers</label>
                                <select multiple id="officer"
                                        class="select2-single form-control" name="officers[]">
                                    <option value="">Select the name</option>
                                    @foreach($officers as $officer)
                                        <option
                                            value="{{$officer->email}}">{{ $officer->name_according_to_part2 .' - '. $officer->service_no}}</option>
                                    @endforeach
                                </select>
                                @error('officer')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="order_dt">Order Date</label>
                                    <input type="date" id="order_dt" class="form-control" name="order_dt">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="category" id="category">
                                        <option value="">Choose a Category</option>
                                        @foreach($barCats as $barCat)
                                            <option value="{{$barCat->id}}">{{$barCat->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="sub_category">Sub Category</label>
                                    <select class="form-control" name="sub_category" id="sub_category">
                                    </select>
                                    @error('sub_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="item">Item</label>
                                    <select class="form-control" name="item" id="item">
                                    </select>
                                    @error('item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div>
                                    <div class="flex items-center">
                                        <input id="link-checkbox" checked type="checkbox" value=""
                                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="link-checkbox"
                                               class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Use
                                            Same Measure Unit</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row col-md-10">
                                <div class="form-group">
                                    <label for="measure">Measure</label>
                                    <select class="form-control" name="measure" id="measure">
                                        @foreach($measureUnits as $measureUnit)
                                            <option value="{{$measureUnit->id}}">{{$measureUnit->abbreviation}}
                                                ({{$measureUnit->size}} {{$measureUnit->size_type}})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('measure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="text" class="form-control" name="qty" id="qty">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" name="price" id="price">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group p-1">
                                    <button type="submit"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                        Create Order
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="avl_qty">Available Qty</label>
                                <input readonly type="text" class="form-control" name="avl_qty" id="avl_qty">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="pricegrn">GRN One Unit Price</label>
                                <input readonly type="text" class="form-control" name="pricegrn" id="pricegrn">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="cell-border" id="barOrdersDt"
                       style="width:100%">
                    <thead>
                    <tr>
                        <th style="width: 50px">Serial</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Item</th>
                        <th>Measure</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
    <script src="{{ asset('plugin/datatable/jquery.validate.js') }}" defer></script>
    <script src="{{ asset('plugin/datatable/jquery.dataTables.min.js') }}" defer></script>
    <script src="{{ asset('plugin/datatable/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('plugin/datatable/dataTables.bootstrap4.min.js') }}" defer></script>
    <script src="{{ asset('plugin/datatable/dataTables.buttons.min.js') }}" defer></script>
    <script src="{{ asset('plugin/vendor/datatables/buttons.server-side.js') }}" defer></script>
@stop

@push('scripts')
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugin/datatable/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/datatable/dataTables.bootstrap4.min.css') }}">
    <script>

        $(document).ready(function () {
            $('#officer').select2();
        });

        $(document).ready(function () {

            $(function () {
                var $checkbox = $("#link-checkbox");
                $checkbox.on("change", function () {
                    if (this.checked && $('#item').val()) {
                        $.ajax({
                            url: '{{ route('get-bar-measures') }}',
                            type: 'post',
                            data: {
                                'item_id': $('#item').val(),
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                $('#measure option').remove();
                                $.each(response, function (key, value) {
                                    if (value.size_type) {
                                        $('#measure').append(new Option(value.abbreviation + ' (' + value.size + ' ' + value.size_type + ')', value.id));
                                    } else {
                                        $('#measure').append(new Option(value.abbreviation, value.id));
                                    }
                                });
                            },
                        });
                    } else {
                        if ($('#category').val()) {
                            var cat = $('#category').val()
                        }
                        if ($('#sub_category').val()) {
                            var cat = $('#sub_category').val()
                        }
                        if (cat) {
                            $.ajax({
                                url: '{{ route('get-bar-measures') }}',
                                type: 'post',
                                data: {
                                    'catId': cat,
                                    '_token': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (response) {
                                    $('#measure option').remove();
                                    $.each(response, function (key, value) {
                                        if (value.size_type) {
                                            $('#measure').append(new Option(value.abbreviation + ' (' + value.size + ' ' + value.size_type + ')', value.id));
                                        } else {
                                            $('#measure').append(new Option(value.abbreviation, value.id));
                                        }
                                    });

                                },
                            });
                        }
                    }
                });
            });

            $('#category').on('change', function () {
                let catId = $('#category').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-bar-items')}}',
                    type: 'POST',
                    data: {catId: catId},
                    success: function (response) {
                        $('#item option').remove();
                        $('#avl_qty').val('');
                        $('#item').append(new Option('Choose a Item', ""));
                        $.each(response, function (key, value) {
                            var val = value.name + ' - ' + value.measure_unit.abbreviation + ' (' + value.measure_unit.size + ' ' + value.measure_unit.size_type + ')';
                            $('#item').append(new Option(val, value.id));
                        });
                    },
                    error: function (error) {
                    }
                });
                //measures
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-bar-measures')}}',
                    type: 'POST',
                    data: {catId: catId},
                    success: function (response) {
                        $('#measure option').remove();
                        $.each(response, function (key, value) {
                            if (value.size_type) {
                                $('#measure').append(new Option(value.abbreviation + ' (' + value.size + ' ' + value.size_type + ')', value.id));
                            } else {
                                $('#measure').append(new Option(value.abbreviation, value.id));
                            }
                        });
                    },
                    error: function (error) {
                    }
                });
                $.ajax({
                    url: '{{ route('ajax.getTreeCategory') }}',
                    type: 'get',
                    data: {
                        'category_id': catId,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('#sub_category option').remove();
                        $('#sub_category').append(new Option('Choose a Category', ""));
                        $.each(response, function (key, value) {
                            $('#sub_category').append(new Option(value.name, value.id));
                        });
                    }
                });
            });

            $('#category').ready(function () {
                let catId = $('#category').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-bar-items')}}',
                    type: 'POST',
                    data: {catId: catId},
                    success: function (response) {
                        $('#item option').remove();
                        $('#item').append(new Option('Choose a Item', ""));
                        $.each(response, function (key, value) {
                            var val = value.name + ' - ' + value.measure_unit.abbreviation + ' (' + value.measure_unit.size + ' ' + value.measure_unit.size_type + ')';
                            $('#item').append(new Option(val, value.id));
                        });
                    },
                    error: function (error) {
                    }
                });

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-bar-measures')}}',
                    type: 'POST',
                    data: {catId: catId},
                    success: function (response) {
                        $('#measure option').remove();
                        $.each(response, function (key, value) {
                            if (value.size_type) {
                                $('#measure').append(new Option(value.abbreviation + ' (' + value.size + ' ' + value.size_type + ')', value.id));
                            } else {
                                $('#measure').append(new Option(value.abbreviation, value.id));
                            }
                        });
                    },
                    error: function (error) {
                    }
                });
            });

            $('#sub_category').on('change', function () {
                let catId = $('#sub_category').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-bar-items')}}',
                    type: 'POST',
                    data: {catId: catId},
                    success: function (response) {
                        $('#item option').remove();
                        $('#avl_qty').val('');
                        $('#item').append(new Option('Choose a Item', ""));
                        $.each(response, function (key, value) {
                            var val = value.name + ' - ' + value.measure_unit.abbreviation + ' (' + value.measure_unit.size + ' ' + value.measure_unit.size_type + ')';
                            $('#item').append(new Option(val, value.id));
                        });
                    },
                    error: function (error) {
                    }
                });
                //measures
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-bar-measures')}}',
                    type: 'POST',
                    data: {catId: catId},
                    success: function (response) {
                        $('#measure option').remove();
                        $.each(response, function (key, value) {
                            if (value.size_type) {
                                $('#measure').append(new Option(value.abbreviation + ' (' + value.size + ' ' + value.size_type + ')', value.id));
                            } else {
                                $('#measure').append(new Option(value.abbreviation, value.id));
                            }
                        });
                    },
                    error: function (error) {
                    }
                });
            });

            $('#item').on('change', function () {
                let id = $('#item').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-bar-qty')}}',
                    type: 'POST',
                    data: {id: id},
                    success: function (response) {
                        if ($('#link-checkbox')[0].checked) {
                            $.ajax({
                                url: '{{ route('get-bar-measures') }}',
                                type: 'post',
                                data: {
                                    'item_id': id,
                                    '_token': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (response) {
                                    $('#measure option').remove();
                                    $.each(response, function (key, value) {
                                        if (value.size_type) {
                                            $('#measure').append(new Option(value.abbreviation + ' (' + value.size + ' ' + value.size_type + ')', value.id));
                                        } else {
                                            $('#measure').append(new Option(value.abbreviation, value.id));
                                        }
                                    });

                                },
                            });
                        } else {
                            if ($('#category').val()) {
                                var cat = $('#category').val()
                            }
                            if ($('#sub_category').val()) {
                                var cat = $('#sub_category').val()
                            }
                            $.ajax({
                                url: '{{ route('get-bar-measures') }}',
                                type: 'post',
                                data: {
                                    'catId': cat,
                                    '_token': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (response) {

                                    $('#measure option').remove();
                                    $.each(response, function (key, value) {
                                        if (value.size_type) {
                                            $('#measure').append(new Option(value.abbreviation + ' (' + value.size + ' ' + value.size_type + ')', value.id));
                                        } else {
                                            $('#measure').append(new Option(value.abbreviation, value.id));
                                        }
                                    });

                                },
                            });
                        }
                        $('#avl_qty').val(response[1]);
                        $('#pricegrn').val(response[2]);
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            });

            $('#officer').on('change', function () {
                $('#barOrdersDt').DataTable().destroy();
                officerBarOrders();
            });
            $('#officer').ready(function () {
                $('#barOrdersDt').DataTable().destroy();
                officerBarOrders();
            });

            function officerBarOrders() {
                let officer_id = $('#officer').val();
                $('#barOrdersDt').DataTable({
                    serverSide: true,
                    ajax: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{url("admin/officer-respective-bar-orders")}}',
                        type: "POST",
                        data: {officer_id: officer_id},
                        dataType: "json",
                    },
                    columns: [
                        {
                            "data": null, "render": function (data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {data: 'name_according_to_part2', name: 'name_according_to_part2'},
                        {data: 'catName', name: 'catName'},
                        {data: 'itemName', name: 'itemName'},
                        {data: 'measureNAme', name: 'measureNAme'},
                        {data: 'qty', name: 'qty'},
                        {data: 'price', name: 'price'},
                        {data: 'order_dt', name: 'order_dt'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            }
        });

        $("#item,#measure,#qty").change(function () {
            if ($('#item').val() && $('#measure').val() && $('#qty').val()) {

                $.ajax({
                    url: '{{ route('ajax.getPrice') }}',
                    type: 'get',
                    data: {
                        'measure': $('#measure').val(),
                        'item': $('#item').val(),
                        'qty': $('#qty').val(),
                        'avl_qty': $('#avl_qty').val(),
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('#price').val(response);
                    },
                });
            }
        });


    </script>

@endpush

