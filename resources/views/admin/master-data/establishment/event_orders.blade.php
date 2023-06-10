@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
               Place Event Order
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{route('save-event-order-data')}}">
                    @csrf

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event" class="form-label">Event Name</label>
                                <input type="text" class="form-control" name="event" id="event" value="">
                                @error('event')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="place" class="form-label">Event Place</label>
                                <input type="text" class="form-control" name="place" id="place" value="">
                                @error('place')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="eventDate">Event Date</label>
                                <input type="text" autocomplete="off" class="form-control datepicker" id="eventDate" name="eventDate">
                                @error('eventDate')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="order_details">Event Order Details</label>
                                <textarea class="form-control" id="order_details" name="order_details" rows="8"></textarea>
                                @error('order_details')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contact_person">Contact Person Name</label>
                                <input type="text" autocomplete="off" class="form-control" id="contact_person" name="contact_person">
                                @error('contact_person')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rank">Rank</label>
                                <input type="text" autocomplete="off" class="form-control" id="rank" name="rank">
                                @error('rank')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="appointment">Appointment</label>
                                <input type="text" autocomplete="off" class="form-control" id="appointment" name="appointment">
                                @error('appointment')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                               <label for="contact_number">Contact Number</label>
                               <input type="text" autocomplete="off" class="form-control" id="contact_number" name="contact_number">
                               @error('contact_number')
                               <span class="text-danger">{{$message}}</span>
                               @enderror
                           </div>
                       </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="special_remarks">Special Remarks</label>
                                <textarea readonly class="form-control" id="special_remarks" name="special_remarks" rows="8"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary float-right mt-5 btn-request-order">Request Order</button>
                                <button style="display: none" type="button" class="btn btn-primary float-right mt-5 btn-new-request-order">New Order Request</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <table id="estbOrdersTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($eventOrders as $eventOrder)
                    <tr id="{{$eventOrder->id}}">
                    <td>{{ ++$i }}</td>
                    <td>{{ $eventOrder->event_name }}</td>
                    <td>{{ $eventOrder->event_date }}</td>
                        <td>@if( $eventOrder->status==1)Approved @elseif( $eventOrder->status==2)Declined @else Pending @endif</td>
                    <td style="width: 86px">
                    <a class="btn btn-dark btn-sm btn-default btn-event-order-view">View</a>
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
    <script src="{{asset('/js/datepicker/datepicker.js')}}"></script>
    <script>

        //dtaTable
        $('#estbOrdersTbl').DataTable({
        });


        $(document).ready(function () {

            $('.datepicker').datepicker({
                format: 'YYYY-MM-DD',
                autoclose: true,
                // endDate: '0d'
            })
                .datepicker("setDate",new Date()).on('keypress keydown paste change', function (e) {
                $('.datepicker').datepicker('hide');
            });

        });


        $('#estbOrdersTbl .btn-event-order-view').on('click', function () {

            let rowId = $(this).closest('tr').attr('id');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: 'json',
                url: 'view-requested-event-orders',
                type: 'POST',
                data: {rowId:rowId },
                success: function (response) {

                    console.log(response)

                        $('.btn-request-order').hide();
                        $('.btn-new-request-order').show();

                    $('#event').val(response[0].event_name);
                    $('#eventId').val(response[0].id);
                    $('#place').val(response[0].event_place);
                    $('#eventDate').val(response[0].event_date);
                    $('#contact_person').val(response[0].contact_person);
                    $('#rank').val(response[0].contact_person_rank);
                    $('#appointment').val(response[0].contact_person_appoinment);
                    $('#contact_number').val(response[0].contact_person_contact_no);
                    $('#order_details').val(response[0].event_order_details);
                    $('#ahq_estb').val(response[0].ahq_establishment);
                    $('#special_remarks').val(response[0].special_remarks);
                },
            });

        });

        $('.btn-new-request-order').on('click', function () {
            location.reload()
        });

    </script>
@endpush