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

            <form method="POST" action="{{route('bar.update',$bar->id)}}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="officer" class="form-label">Respective Officers : </label>
                                @foreach($officers as $officer)
                                    @if($officer->email == $bar->officer_id)
                                        <input readonly type="hidden" id="officer" class="form-control" name="officer"
                                               value="{{$officer->email}}">{{ $officer->name_according_to_part2 .' - '. $officer->service_no}}
                                    @endif
                                @endforeach
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
                                    <input type="date" id="order_dt" class="form-control" name="order_dt"
                                           value="{{$bar->order_dt}}">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    @foreach($selectCat as $select)
                                        @if($select->id == $bar->category)
                                            <input readonly type="text" id="category" class="form-control"
                                                   name="category"
                                                   value="{{$select->name}}">
                                        @endif
                                    @endforeach
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="item">Item</label>
                                    @foreach($items as $item)
                                        @if($item->id == $bar->item)
                                            <input readonly type="text" id="item" class="form-control" name="item"
                                                   value="{{$item->name}}">
                                        @endif
                                    @endforeach
                                    @error('item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="measure">Measure</label>
                                    @foreach($measureUnits as $measureUnit)
                                        @if($measureUnit->id == $bar->measure)
                                            <input readonly type="text" id="measure" class="form-control" name="measure"
                                                   value="{{$measureUnit->name}}">
                                        @endif
                                    @endforeach
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
                                    <input readonly type="text" class="form-control" name="qty" id="qty"
                                           value="{{$bar->qty}}">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" id="price"
                                           value="{{$bar->price}}">
                                </div>
                            </div>
                            <div class=" col-md-10">
                                <div class="form-group p-1">
                                    <button type="submit"
                                            class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                        Update Order
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="avl_qty">Available Qty</label>
                                <input readonly type="text" class="form-control" name="avl_qty" id="avl_qty"
                                       value="{{$value}}">
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
@stop

@push('scripts')
    <script src="{{ asset('plugin/flowbite/flowbite.js') }}"></script>

    <script>

        $(document).ready(function () {

            $('#officer').ready(function () {
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
    </script>

@endpush

