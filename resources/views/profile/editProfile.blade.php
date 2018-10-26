
@extends('profile.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{Auth::user()->name}}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="card">
                                    <br>
                                    <h3>Edit Profile</h3>
                                    <p align="center">
                                        <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="80px" height="80px">

                                    </p>
                                    <div class="card-body">
                                        <p align="center"></p>

                                        <p align="center">
                                            <a href="{{url('/')}}/changePhoto" class="btn btn-primary" role="button">Change Image</a>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <h4><span class="badge badge-secondary">About</span></h4>
                                <input type="text" name="city" value="{{Auth::user()->city}}">

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

