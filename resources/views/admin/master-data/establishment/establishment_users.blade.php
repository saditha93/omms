@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Add AHQ Establishment User
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="">
                    @csrf
                    <div class="row">

                        <div class="col-md-3 offset-md-8">
                            <div class="form-group">
                                <label for="officer_number" class="form-label">Officer Number</label>
                                <input placeholder="O/12345" type="text" class="form-control" name="officer_number" id="officer_number" value="">
                                @error('officer_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-1 mt-4 pt-2">
                            <div class="form-group">
                                <input class="btn btn-primary float-right" type="button" value="Search" id="o_number_search">
                            </div>
                        </div>
                    </div>
                </form>


                <form id="formOfficerToAhqEstb" method="POST" action="{{route('add-officer-to-ahq-estb')}}">
                    @csrf
                    <div class="row mt-5">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input readonly type="text" class="form-control" name="full_name" id="full_name" value="">
                            </div>
                            @error('full_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="e_number" class="form-label">E-Number</label>
                                <input readonly type="text" class="form-control" name="e_number" id="e_number" value="">
                            </div>
                            @error('e_number')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="service_number" class="form-label">Service Number</label>
                                <input readonly type="text" class="form-control" name="service_number" id="service_number" value="{{old('service_number')}}">
                                @error('service_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rank" class="form-label">Rank</label>
                                <input readonly type="text" class="form-control" name="rank" id="rank" value="">
                                @error('rank')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name_acco_part2" class="form-label">Name According to Part2</label>
                                <input readonly type="text" class="form-control" name="name_acco_part2" id="name_acco_part2" value="">
                                @error('name_acco_part2')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="regiment" class="form-label">Regiment</label>
                                <input readonly type="text" class="form-control" name="regiment" id="regiment" value="">
                                @error('regiment')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="unit" class="form-label">Unit</label>
                                <input readonly type="text" class="form-control" name="unit" id="unit" value="">
                                @error('unit')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nic" class="form-label">NIC</label>
                                <input readonly type="text" class="form-control" name="nic" id="nic" value="">
                                @error('nic')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="establishment" class="form-label">Establishment</label>
                                    <select class="form-control" name="establishment" id="establishment">
                                        <option value="">Select Establishment</option>
                                        @foreach($establishments as $establishment)
                                            <option value="{{$establishment->id}}">{{$establishment->ahq_establishment}} / {{$establishment->abreviation}}</option>
                                        @endforeach
                                    </select>
                                    @error('establishment')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="form-label">User Name</label>
                                    <input type="text" class="form-control" name="username" id="username" value="">
                                    @error('username')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" value="">
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="">
                                    @error('confirm_password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right mt-5 ">Add Establishment User</button>
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

                <table id="estbUsersTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Establishment</th>
                        <th>Abbreviation</th>
                        <th>User Name</th>
                        <th>Rank</th>
                        <th>Assigned User</th>
                        <th>Regiment</th>
                        <th>Unit</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach ($establishmentsUsers as $establishmentsUser)
                        <tr id="{{$establishmentsUser->id}}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $establishmentsUser->ahq_establishment }}</td>
                            <td>{{ $establishmentsUser->abreviation }}</td>
                            <td>{{ $establishmentsUser->name }}</td>

                            <td>{{ $establishmentsUser->rank }}</td>
                            <td>{{ $establishmentsUser->name_accdng_to_part_2 }}</td>
                            <td>{{ $establishmentsUser->regiment }}</td>
                            <td>{{ $establishmentsUser->unit }}</td>
                            {{--<td style="width: 86px">--}}
{{--                                <a class="btn btn-dark btn-sm btn-default" href="{{route('update-meal-order-time',$orderTime->id)}}"><i class="fas fa-edit"></i></a>--}}
                            {{--</td>--}}
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        //dtaTable
        $('#estbUsersTbl').DataTable({
        });




        $('#o_number_search').on('click', function () {

                    let officer_number = $('#officer_number').val();

                    $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    url: '{{route('get-officer-to-establishment')}}',
                    type: 'POST',
                    data: {officer_number:officer_number },
                    success: function (response) {

                        $("#formOfficerToAhqEstb")[0].reset();

                        $('#full_name').val(response['person'][0]['full_name']);
                        $('#e_number').val(response['person'][0]['eno']);
                        $('#service_number').val(response['person'][0]['service_no']);
                        $('#rank').val(response['person'][0]['rank']);
                        $('#name_acco_part2').val(response['person'][0]['name_according_to_part2']);
                        $('#regiment').val(response['person'][0]['regiment']);
                        $('#unit').val(response['person'][0]['unit']);
                        $('#nic').val(response['person'][0]['nic']);
                    },
                    error: function (error) {

                        $("#formOfficerToAhqEstb")[0].reset();

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: error.responseText,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });

        });

    </script>
@endpush