@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Issue Note {{$issueHeader->order_no}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">issue</li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{$issueHeader->order_no}}</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('issueHeader.update',$issueHeader->id)  }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-3" for="no">Issue Order No</label>
                            <div class="col-sm-9">
                                <input type="text" name="no"
                                       class="form-control   @error('no') is-invalid @enderror" id="no"
                                       placeholder="GRN Order No" value="{{ $issueHeader->no}}">
                                @error('no')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="date">Issue Date</label>
                            <div class="col-sm-9">
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input required datepicker datepicker-format="yyyy/mm/dd" type="text" id="date"
                                           name="date"
                                           value="{{$issueHeader->date}}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Select date">
                                </div>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="service_no">Issue To</label>
                            <div class="col-sm-9">
                                <input type="text" name="service_no"
                                       class="form-control   @error('service_no') is-invalid @enderror" id="service_no"
                                       placeholder="Service No" value="{{$issueHeader->service_no}}">
                                @error('service_no')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3" for="remarks">Issue Reason</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="remarks"
                                          class="form-control   @error('remarks') is-invalid @enderror"
                                          id="remarks"
                                          placeholder="Remark"> {{$issueHeader->remarks}}</textarea>
                                @error('remarks')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3" for="active">Active</label>
                            <div class="col-sm-9">
                                <label class="inline-flex relative items-center mb-4 cursor-pointer">
                                    @if($issueHeader->active == 1)
                                        <input checked type="checkbox" name="active" value="1"
                                               class="sr-only peer">
                                    @else
                                        <input type="checkbox" name="active" value="1"
                                               class="sr-only peer">
                                    @endif
                                    <div
                                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                </label>
                                @error('active')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                            Submit
                        </button>
                    </div>
                </form>
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
    <script src="{{ asset('plugin/jquery/jquery.js') }}"></script>
    <script>

        box = document.getElementById('service_no');
        box.addEventListener('keyup', (e) => {
            var newDate = new Date();
            var newString = "Issue to " + box.value + " on " + newDate.toLocaleString() + " for "
            $('#remarks').val(newString);
        });

        $('#establishment_id').change(function () {
            var id = $(this).val();

            $.ajax({
                url: '{{ route('ajax.getSupplier') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#supplier_id option').remove();
                    $.each(response, function (key, value) {
                        $('#supplier_id').append(new Option(value.name, value.id));
                    });
                }
            });
        })

        $('#establishment_id').ready(function () {
            var id = $(this).val();

            $.ajax({
                url: '{{ route('ajax.getSupplier') }}',
                type: 'get',
                data: {
                    'id': id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#supplier_id option').remove();
                    $.each(response, function (key, value) {
                        $('#supplier_id').append(new Option(value.name, value.id));
                    });
                }
            });
        })
    </script>
@stop
