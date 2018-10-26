@extends('layouts.app')

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
                                    Edit

                                    Welcome to you profile!
                                    <p align="center">
                                        <img class="img-circle rounded-circle" src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="130px" height="130px"/>
                                    </p>
                                    <div class="card-body">
                                        <form action="{{url('/')}}/uploadPhoto" method="post" enctype="multipart/form-data">

                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                            <div class="custom-file">
                                                <input type="file" name="pic" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                            <br>
                                            <br>
                                            <p align="center">
                                                <input type="submit" class="btn btn-success" name="btn" value="Save Image"/>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <h4><span class="badge badge-secondary">About</span></h4>

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

