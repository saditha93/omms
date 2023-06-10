@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Expire Items</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Reports</li>
                            <li class="breadcrumb-item active">Expire Items</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title"Expire Item</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="item_id">From / To *</label>
                        <div date-rangepicker datepicker-format="yyyy/mm/dd" class="flex items-center">
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input required id="start" name="start" type="text"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Select date start">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input id="end" name="end" type="text"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="Select date end">
                            </div>
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
                                        GRN NO
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Item Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Date
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Expire Date
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Receive to
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Amount (LKR)
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Quantity
                                    </th>
                                </tr>
                                </thead>
                                <tbody id="grn">
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

    <style>
        .datepicker{
            z-index: 20000;
            left: 300px !important;
            top:100px !important;
        }
    </style>

@stop


@section('third_party_scripts')
    <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
    <script src="{{ asset('plugin/MCDatepicker/mc-calendar.min.js') }}"></script>
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
    <script src="{{ asset('plugin/jquery/jquery.js') }}"></script>
    <script>

        $("#search").click(function () {
            var start = $('#start').val();
            var end = $('#end').val();

            if (!start || !end) {
                alert("Please enter all data")
            } else {
                $.ajax({
                    url: '{{ route('ajax.getGRNExpir') }}',
                    type: 'get',
                    data: {
                        'start': start,
                        'end': end,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('#grn tr').remove();
                        $.each(response, function (key, value) {
                            $('#grn').append("<tr><th class='py-4 px-6'>" + value.header.no + "</th>\
										<th class='py-4 px-6'>" + value.item.name + "</th>\
										<th class='py-4 px-6'>" + value.header.date + "</th>\
										<th class='py-4 px-6'>" + value.expire_date + "</th>\
										<th class='py-4 px-6'>" + value.header.establishment.name + "</th>\
										<th class='py-4 px-6'>" + value.qty * value.unit_price + "</th>\
										<th class='py-4 px-6'>" + value.qty + "</th>\
										");
                        })
                    }
                });
                $.ajax({
                    url: '{{ route('ajax.getIN') }}',
                    type: 'get',
                    data: {
                        'id': id,
                        'start': start,
                        'end': end,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('#in tr').remove();
                        $.each(response, function (key, value) {
                            $('#in').append("<tr><th class='py-4 px-6'>" + value.header.no + "</th>\
										<th class='py-4 px-6'>" + value.header.date + "</th>\
										<th class='py-4 px-6'>" + value.header.establishment.name + "</th>\
										<th class='py-4 px-6'>" + value.qty + "</th>\
										");
                        })
                    }
                });
            }
        });

    </script>
@stop
