
@extends('profile.master')

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/profile')}}/{{Auth::user()->name}}">Profile</a></li>
                <li class="breadcrumb-item"><a href="">Edit Profile</a></li>
            </ol>
        </nav>

        <div class="row justify-content-center">

            @include('profile.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{Auth::user()->name}}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="card">

                                    <p align="center">
                                        <br>
                                        <img class="rounded-circle" src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="80px" height="80px">
                                    </p>
                                    <div class="card-body">
                                        <p align="center">{{Auth::user()->name}}</p>
                                        <p align="center">
                                            <a href="{{url('/')}}/changePhoto" class="btn btn-primary" role="button">Change Image</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div style="width: 15px; height: 15px;"></div>
                            <div class="col-sm-12 col-md-12">
                                <h4 align="center"><span class="badge badge-secondary">Update Profile</span></h4>
                                <form action="{{url('/updateProfile')}}" method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">City Name</label>
                                                <input type="text" class="form-control" placeholder="City Name" name="city" value="{{$data->city}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Country Name</label>
                                                <input type="text" class="form-control" placeholder="Country Name" name="country" value="{{$data->country}}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">About</label>
                                                <textarea type="text" class="form-control" rows="4" name="about">{{$data->about}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-primary ">
                                            </div>
                                        </div>
                                    </div>
                                </form>

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

