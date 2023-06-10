@extends('layouts.app')


@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Settings
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Set Meal Order Time
            </div>
            <div class="card-body">
                @if(!isset($updateOrderTime[0]->id))
                <form method="POST" action="{{route('save-meal-order-time')}}">
                    @else
                <form method="POST" action="{{route('update-order-times',$updateOrderTime[0]->id)}}">
                    @method('PUT')
                    @endif
                    @csrf
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="time_breakfast" class="form-label">Breakfast order before</label>
                                <div class="input-group clockpicker">
                                    <input type="text" autocomplete="off" id="time_breakfast" name="time_breakfast" class="form-control" value="{{isset($updateOrderTime[0]->for_breakfast)?$updateOrderTime[0]->for_breakfast:''}}">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="time_lunch" class="form-label">Lunch Order Before</label>
                                <div class="input-group clockpicker">
                                    <input type="text" autocomplete="off" id="time_lunch" name="time_lunch" class="form-control" value="{{isset($updateOrderTime[0]->for_lunch)?$updateOrderTime[0]->for_lunch:''}}">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="time_dinner" class="form-label">Dinner Order Before</label>
                                <div class="input-group clockpicker">
                                    <input type="text" autocomplete="off" id="time_dinner" name="time_dinner" class="form-control" value="{{isset($updateOrderTime[0]->for_dinner)?$updateOrderTime[0]->for_dinner:''}}">
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                                @error('service_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">

                           @if(!isset($exitTime->id))
                            <div class="form-group">
                                @if(!isset($updateOrderTime[0]->id))
                                <button type="submit" class="btn btn-primary float-right mt-5">Save Time Data</button>
                                @else
                                    <input class="btn btn-primary float-right" type="submit" value="Update Time">
                                    <a class="btn btn-secondary float-right mr-1" type="button" href="{{route('meal-time')}}">Cancel</a>
                                @endif
                            </div>
                            @endif

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <table id="mealOderTimeTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Breakfast</th>
                        <th>Lunch</th>
                        <th>Dinner</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($orderTimes as $orderTime)
                        <tr id="{{$orderTime->id}}">
                            <td>{{ $orderTime->for_breakfast }}</td>
                            <td>{{ $orderTime->for_lunch }}</td>
                            <td>{{ $orderTime->for_dinner }}</td>
                            <td style="width: 86px">
                                <a class="btn btn-dark btn-sm btn-default" href="{{route('update-meal-order-time',$orderTime->id)}}"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>



            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script src="{{ asset('/js/clock-picker/jquery-clockpicker.min.js') }}"></script>

    <script>


        $('.clockpicker').clockpicker({
            align: 'left',
            donetext: 'Done'
        });


        //dtaTable
        $('#mealOderTimeTbl').DataTable({
        });

    </script>
@endpush