@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $gRNHeader->no }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $gRNHeader->no }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View GRN</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Bill No</label>
                        <div class="col-sm-9">
                            <span>{{$gRNHeader->no}}</span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3" for="sfhq">GRN Date</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$gRNHeader->date}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="district">GRN No</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$gRNHeader->order_no}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="establishment">Establishment</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$gRNHeader->establishment->name}}</span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3" for="tele">Supplier</label>
                        <div class="col-sm-5 input-group">
                            <a href="{{route('supplier.show', $gRNHeader->supplier->id)}}">
                                <span>{{$gRNHeader->supplier->name}}</span></a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="mobile">Remark</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$gRNHeader->remarks}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="active">Status</label>
                        <div class="col-sm-5 input-group">
                            @if($gRNHeader->active == 1)
                                <mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active</mark>
                            @elseif($gRNHeader->active == 2)
                                <mark class="px-2 text-white bg-danger rounded dark:bg-danger">close</mark>
                           @else
                                <mark class="px-2 text-white bg-danger rounded dark:bg-danger">deactivate</mark>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Product name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Measure Unit
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
                                    {{$headerItem->item->measure_unit->abbreviation}}
                                    ({{$headerItem->item->measure_unit->size}} {{$headerItem->item->measure_unit->size_type}})
                                </td>
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

