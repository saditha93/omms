@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> {{ $establishment->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item ">{{ $establishment->name }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">View Establishment</div>
                    <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-sm btn-dark">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Name</label>
                        <div class="col-sm-9">
                            <span>{{$establishment->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="name">Code</label>
                        <div class="col-sm-9">
                            <span>{{$establishment->code}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="sfhq">SFHQ</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$establishment->sfhq->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="district">District</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$establishment->district->district_name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="address">Address</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$establishment->address}}</span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3" for="tele">Telephone No</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$establishment->tele}}</span>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-3" for="mobile">Mobile No</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$establishment->mobile}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="email">Email</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$establishment->email}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="mobile">In charge</label>
                        <div class="col-sm-5 input-group">
                            <span>{{$establishment->incharge->name}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3" for="active">Status</label>
                        <div class="col-sm-5 input-group">
                            @if($establishment->active == 1)
                                <mark class="px-2 text-white bg-green-600 rounded dark:bg-green-500">active</mark>
                            @else
                                <mark class="px-2 text-white bg-danger rounded dark:bg-danger">deactivate</mark>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection


@section('third_party_stylesheets')
@stop

