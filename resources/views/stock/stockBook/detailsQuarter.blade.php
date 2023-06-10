@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Stock Book To ({{ $begin->format("Y-m-d")}} - {{$end->format("Y-m-d")}})</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">Stock Book</li>
                            <li class="breadcrumb-item active">Stock Book</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div class=" col-md-12">

            <div class="card">

                <div class="card-header">
                    <div class="card-title"> Stock Book</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="" method="get">
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-3" for="item_id">Item</label>
                            <div class="col-sm-9">
                                <select name="item_id" id="item_id"
                                        class="bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected value="">All</option>
                                    @foreach($itemNames as $item)
                                        <option
                                            @selected($item->id == $select_id) value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('item_id')
                                <span class="invalid-feedback" role="alert">
{{--                                        <strong>{{ $message }}</strong>--}}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input hidden id="establishment_id" name="establishment_id" type="text"
                               value="{{$establishment_id}}"/>

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
                                           value="{{$begin->format("Y-m-d")}}"
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
                                    <input required id="end" name="end" type="text" value="{{$end->format("Y-m-d")}}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date end">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 offset-10">
                                <button type="submit"
                                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">Stocks Book</div>
                    <div class="card-tools">
                        {{--                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>--}}
                    </div>
                </div>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full table-bordered overlay-wrapper text-bold text-center">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th rowspan="3" scope="col" class="py-3 px-6">
                                No
                            </th>
                            <th rowspan="3" scope="col" class="py-3 px-6">
                                Item
                            </th>
                                <?php $count = 0; ?>
                            @for($i = $begin; $i <= $end; $i->modify('+1 day'))
                                    <?php $count++ ?>
                                <th scope="col" colspan="3" class="py-3 px-6">
                                    {{ $i->format("Y-m-d")}}
                                </th>
                            @endfor
                        </tr>

                        <tr>
                            @for($i = 1; $i <= $count; $i++)
                                <th scope="col" class="py-3 px-6">
                                    Receive Qty
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Issue Qty
                                </th>
                                <th scope="col" class="py-3 px-6 bg-green">
                                    Balance
                                </th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody>
                            <?php $j = 1 ?>
                        @foreach($items as $item)
                            <tr class="bg-white dark:bg-gray-800">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$j++}}
                                </th>
                                <td class="py-4 px-6">
                                    {{$item->item->name}}
                                </td>

                                    <?php
                                    $bal_qty = $balanceQty->where('item_id', $item->item->id)->first()->balance_qty ?? 0;
                                    $days = '-' . $count . ' ' . 'day';
                                    $start = $begin->modify($days); ?>

                                @for($i = $start; $i <= $end; $i->modify('+1 day'))

                                        <?php $thatDate = $stockBooks->where('item_id', $item->item->id)->where('date', $i->format("Y-m-d"))->first();
                                        if (isset($thatDate->balance_qty)) {
                                            $bal_qty = $thatDate->balance_qty;
                                        }
                                        ?>

                                    <td class="py-4 px-6">
                                        {{$thatDate->receive_qty ?? 0}}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{$thatDate->issue_qty ?? 0}}
                                    </td>
                                    <td class="py-4 px-6  bg-green">
                                        {{$thatDate->balance_qty ?? $bal_qty}}
                                    </td>

                                @endfor
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugin/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/select2-bootstrap4-theme/select2-bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('plugin/flowbite/flowbite.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('plugin/MCDatepicker/mc-calendar.min.css') }}"/>

    <style>
        .datepicker {
            z-index: 20000;
        }
    </style>

@stop

@section('third_party_scripts')
    <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
    <script src="{{ asset('plugin/MCDatepicker/mc-calendar.min.js') }}"></script>
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
@stop
