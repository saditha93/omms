@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Stock
            </div>
            <div class="card-body">

                    <form method="POST" action="{{route('category.store')}}">

                    </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card-header">
            Bar Items
        </div>
        <div class="card">
            <div class="card-body">
                <table id="apiBarTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        {{--<th>Item COde</th>--}}
                        <th>Status</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($barItems->items as $barItem)
                            <tr>
                                <td>{{$barItem->name}}</td>
{{--                                <td>{{$barItem->code}}</td>--}}
                                <td>{{$barItem->stock->qty >= 1?'Available':'Not available'}}</td>
                                <td>{{$barItem->stock->qty}}</td>
                                <td>{{$barItem->price}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Canteen Items
            </div>
            <div class="card-body">
                <table id="apiCanteenTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        {{--<th>Item COde</th>--}}
                        <th>Status</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($canteenItems->items as $canteenItem)
                        <tr>
                            <td>{{$canteenItem->name}}</td>
{{--                            <td>{{$canteenItem->code}}</td>--}}
                            <td>{{$canteenItem->stock->qty >=1?'Available':'Not available'}}</td>
                            <td>{{$canteenItem->stock->qty}}</td>
                            <td>{{$canteenItem->price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            $('#apiBarTbl').DataTable({
            });
            $('#apiCanteenTbl').DataTable();
        });
    </script>

@endpush

