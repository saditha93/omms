@extends('layouts.app')

@section('content')

    <div class="col-md-12 pt-2">
        <div class="card">
            <div class="card-header">
                Add Establishment to AHQ
            </div>
            <div class="card-body">
                @if(!isset($ahqEstb[0]->id))
                    <form method="POST" action="{{route('save-ahq-establishment')}}">
                        @else
                    <form method="POST" action="{{route('update-ahq-establishment',$ahqEstb[0]->id)}}">
                        @method('PUT')
                @endif
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="establishment" class="form-label">Establishment Name</label>
                                            <input type="text" class="form-control" name="establishment" id="establishment" value="{{isset($ahqEstb[0]->ahq_establishment)?$ahqEstb[0]->ahq_establishment:''}}">
                                            @error('establishment')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="abbr" class="form-label">Abbreviation</label>
                                            <input type="text" class="form-control" name="abbr" id="abbr" value="{{isset($ahqEstb[0]->abreviation)?$ahqEstb[0]->abreviation:''}}">
                                            @error('abbr')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if(!isset($ahqEstb[0]->id))
                                                <input class="btn btn-primary float-right" type="submit" value="Add Establishment">
                                            @else
                                                <input class="btn btn-primary float-right" type="submit" value="Update Establishment">
                                                <a class="btn btn-secondary float-right mr-1" type="button" href="{{route('ahq-establishment')}}">Cancel</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </form>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="ahqEstbTbl" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th width="90px">No</th>
                        <th>AHQ Establishment</th>
                        <th>Abbreviation</th>
                        <th width="70px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>

                    @foreach ($ahqEstablishments as $ahqEstablishment)
                        <tr id="{{$ahqEstablishment->id}}">
                            <td>{{ ++$i }}</td>
                            <td>{{ $ahqEstablishment->ahq_establishment }}</td>
                            <td>{{ $ahqEstablishment->abreviation }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('edit-ahq-establishment',$ahqEstablishment->id) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    <tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {

            $('#ahqEstbTbl').DataTable();

        });
    </script>

@endpush

@push('page_css')
    <style>
        #ahqEstbTbl_wrapper .dt-buttons{
            display: none !important;
        }
    </style>
@endpush