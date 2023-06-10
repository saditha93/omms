@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $stock->item->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $stock->item->name }}</li>
                            <li class="breadcrumb-item ">Stock</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View Stock</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Name</label>
                        <div class="col-sm-9">
                            <span>{{$stock->item->name}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Measure Unit</label>
                        <div class="col-sm-9">
                            <span>{{$stock->item->measure_unit->name . ' (' . $stock->item->measure_unit->size . '' . $stock->item->measure_unit->size_type . ')'}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Establishment</label>
                        <div class="col-sm-9">
                            <span>{{$establishment->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Qty</label>
                        <div class="col-sm-9">
                            <span>{{$stock->qty}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Re-Order level</label>
                        <div class="col-sm-9">
                            <span>{{$stock->below_qty}}</span>
                        </div>
                    </div>

                </div>

                <div class="row">
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
                            <tbody>
                            @foreach($grnAvalables as $grnAvalable)
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        {{$grnAvalable->header->order_no}}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{$grnAvalable->header->date}}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{$grnAvalable->qty}}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        {{$grnAvalable->avl_qty}}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        RS {{$grnAvalable->unit_price}}
                                    </th>
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
@stop

