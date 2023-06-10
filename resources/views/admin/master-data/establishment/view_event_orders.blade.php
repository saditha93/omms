@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
               View Event Order
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="">
                    @csrf

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ahq_estb" class="form-label">AHQ Establishment</label>
                                <input readonly type="text" class="form-control" name="ahq_estb" id="ahq_estb" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="event" class="form-label">Event Name</label>
                                <input readonly type="text" class="form-control" name="event" id="event" value="">
                                <input type="hidden" class="form-control" name="eventId" id="eventId" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="place" class="form-label">Event Place</label>
                                <input readonly type="text" class="form-control" name="place" id="place" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="eventDate">Event Date</label>
                                <input readonly type="text" autocomplete="off" class="form-control datepicker" id="eventDate" name="eventDate">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contact_person">Contact Person Name</label>
                                <input readonly type="text" autocomplete="off" class="form-control" id="contact_person" name="contact_person">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="rank">Rank</label>
                                <input readonly type="text" autocomplete="off" class="form-control" id="rank" name="rank">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="appointment">Appointment</label>
                                <input readonly type="text" autocomplete="off" class="form-control" id="appointment" name="appointment">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input readonly type="text" autocomplete="off" class="form-control" id="contact_number" name="contact_number">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="order_details">Event Order Details</label>
                                <textarea readonly class="form-control" id="order_details" name="order_details" rows="8"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="special_remarks">Special Remarks</label>
                                <textarea class="form-control" id="special_remarks" name="special_remarks" rows="8"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" id="eventOrderDecline" class="btn btn-warning float-right mt-5 ">Decline Order</button>
                                <button type="button" id="eventOrderApprove" class="btn btn-primary float-right mt-5 mr-2">Approve Order</button>
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

                <table id="viewEventOrderTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Establishment</th>
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
                            <td>{{ $eventOrder->ahq_establishment }}</td>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        //dtaTable
        $('#viewEventOrderTbl').DataTable({
        });


        $(document).ready(function () {

            $('#eventOrderDecline').attr('disabled','disabled');
            $('#eventOrderApprove').attr('disabled','disabled');

            $('#viewEventOrderTbl .btn-event-order-view').on('click', function () {

                let rowId = $(this).closest('tr').attr('id');
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: 'view-requested-event-orders',
                    type: 'POST',
                    data: {rowId:rowId },
                    success: function (response) {

                        if (response[0].status == 0)
                        {
                            $('#eventOrderDecline').removeAttr('disabled');
                            $('#eventOrderApprove').removeAttr('disabled');
                        }
                        else
                        {
                            $('#eventOrderDecline').attr('disabled','disabled');
                            $('#eventOrderApprove').attr('disabled','disabled');
                        }

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



            $('#eventOrderDecline').on('click', function () {

                let status = 'decline';
                Swal.fire({
                    title: 'Decline event order request?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateEventOrderStatus(status);
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            });

            $('#eventOrderApprove').on('click', function () {

                let status = 'approve';
                Swal.fire({
                    title: 'Approve event order request?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: 'No',
                    customClass: {
                        actions: 'my-actions',
                        cancelButton: 'order-1 right-gap',
                        confirmButton: 'order-2',
                        denyButton: 'order-3',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateEventOrderStatus(status);

                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                })
            });


            function updateEventOrderStatus(status) {

                let specialRem = $('#special_remarks').val();
                let eventId = $('#eventId').val();

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: 'update-event-order-status',
                    type: 'POST',
                    data: {status:status, specialRem:specialRem,eventId:eventId},
                    success: function (response) {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Order status updated!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function(){
                            location.reload()
                        }, 1500);

                    },
                });

            }

        });

    </script>
@endpush