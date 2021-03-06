@extends('profile.master')

@section('content')

    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href=""></a>Requests</li>
            </ol>
        </nav>

        <div class="row justify-content-center">

            @include('profile.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{Auth::user()->name}}</div>

                    <div class="card-body">
                        @if ( session()->has('msg') )
                            <p class="alert alert-success">
                                {{ session()->get('msg') }}
                            </p>
                        @endif
                        @foreach($FriendRequests as $uList)

                            <div class="row">
                                <div class="col-md-2 pull-left">
                                    <img src="{{url('../')}}/public/img/{{$uList->pic}}" width="80px" height="80px" class="rounded-circle"/>
                                </div>

                                <div class="col-md-7 pull-left">
                                    <h3 style="margin:0px;"><a href="">{{ucwords($uList->name)}}</a></h3>

                                    <p><b>Gender:</b> {{$uList->gender}}</p>
                                    <p><b>Email:</b> {{$uList->email}}</p>

                                </div>

                                <div class="col-md-3 pull-right">
                                    <br>
                                    <p align="center">
                                        <a href="{{url('/accept')}}/{{$uList->name}}/{{$uList->id}}"  class="btn btn-outline-primary btn-sm">Confirm</a>
                                        <a href="{{url('/requestRemove')}}/{{$uList->id}}"  class="btn btn-outline-danger btn-sm">Remove</a>
                                    </p>

                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
