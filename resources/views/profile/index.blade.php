@extends('profile.master')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/profile')}}/{{Auth::user()->name}}">Profile</a></li>
            </ol>
        </nav>

        <div class="row justify-content-center">

            @include('profile.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{Auth::user()->name}}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="card">

                                    <p align="center">
                                        <br>
                                        <br>
                                        <img class="rounded-circle" src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="80px" height="80px">

                                    </p>
                                    <div class="card-body">
                                        <p align="center">{{$data->city}} - {{$data->country}}</p>

                                            <p align="center">
                                                <a href="{{url('/editProfile')}}" class="btn btn-primary" role="button">Edit Profile</a>
                                            </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <h4><span class="badge badge-secondary">About</span></h4>
                                <p>{{$data->about}}</p>

                            </div>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
