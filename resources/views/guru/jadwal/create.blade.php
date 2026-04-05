@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Create Jadwal</div>
                    <div class="card-body">
                        <a href="{{ url('/guru/jadwal') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        
                        <form method="POST" action="{{ url('/guru/jadwal') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('guru.jadwal.form', ['formMode' => 'create', 'jam' => $jam, 'hari' => $hari])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection