@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $supplier->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $supplier->name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View Supplier</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Name</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="address">Address</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->address}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="mobile">Mobile No</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->mobile}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="email">Email</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->email}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="tele">Telephone No</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->tele}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Establishment</label>
                        <div class="col-sm-9">
                            <span>{{$supplier->establishment->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="active">Status</label>
                        <div class="col-sm-5 input-group">
                            @if($supplier->active == 1)
                                <mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active</mark>
                            @else
                                <mark class="px-2 text-white bg-danger rounded dark:bg-danger">deactivate</mark>
                            @endif
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
                                        <a href="{{route('gRNHeader.show', $grnAvalable->header->id)}}">
                                            <span>{{$grnAvalable->header->order_no}}</span></a>
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
            <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>
            <script src="{{ asset('plugin/flowbite/datepicker.js') }}"></script>
            <script src="{{ asset('plugin/MCDatepicker/mc-calendar.min.js') }}"></script>
@stop

