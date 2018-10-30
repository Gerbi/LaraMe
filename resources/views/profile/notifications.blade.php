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
                        @foreach($notes as $note)

                            <div class="row">
                                <ul>
                                    <li>
                                        <p><a style="font-weight: bold; color: green;" href="{{$note->name}}"></a></p>

                                    </li>

                                </ul>


                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
