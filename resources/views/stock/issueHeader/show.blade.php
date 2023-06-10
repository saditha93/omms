@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $issueHeader->no }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $issueHeader->no }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View Issue Note</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Issue Order No</label>
                        <div class="col-sm-9">
                            <span>{{$issueHeader->no}}</span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3" for="sfhq">Issue Date</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$issueHeader->date}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="district">Issue No</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$issueHeader->order_no}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="establishment">Issue</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$issueHeader->establishment->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="active">Status</label>
                        <div class="col-sm-5 input-group">
                            @if($issueHeader->active == 1)
                                <mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active</mark>
                            @elseif($issueHeader->active == 2)
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Total Price</label>
                        <div class="col-sm-9">
                            <span>{{$issueHeader->total}} LKR</span>
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
@stop

