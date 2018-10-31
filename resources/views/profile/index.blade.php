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

            @foreach($userData as $uData)

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{$uData->name}}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="card">
                                    <p align="center">
                                        <br>
                                        <br>
                                        <img class="rounded-circle" src="{{url('../')}}/public/img/{{$uData->pic}}" width="80px" height="80px">

                                    </p>
                                    <div class="card-body">
                                        <p align="center">{{$uData->city}} - {{$uData->country}}</p>
                                            @if ($uData->user_id == Auth::user()->id)
                                            <p align="center">
                                                <a href="{{url('/editProfile')}}" class="btn btn-primary" role="button">Edit Profile</a>
                                            </p>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <h4><span class="badge badge-secondary">About</span></h4>
                                <p>{{$uData->about}}</p>

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
            @endforeach
        </div>
    </div>
@endsection
