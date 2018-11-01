<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

        <!-- Scripts -->
        {{--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>--}}
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #ddd;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">DASHBOARD</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="container">
                <div id="app">
                    @{{msg}} <small style="color: green;">@{{ content }}</small>
                    <form   action="" method="post" enctype="multipart/form-data" v-on:submit.prevent="addPost">
                        <textarea name="" id="" cols="30" rows="10" v-model="content"></textarea>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                @foreach($posts as $post)
                <div class="row" style="background-color: #fff">
                    <div class="col-md-2">
                        <img src="{{url('../')}}/public/img/{{$post->pic}}" style="width: 100px; margin: 10px;"  alt="" class="rounded-circle">
                    </div>
                    <div class="col-md-10">
                        <h3>{{ucwords($post->name)}}</h3>
                        <p><i class="fas fa-globe-americas"></i> {{$post->city}} | {{$post->country}}</p>

                    </div>
                    <p class="col-md-12" style="color: #333;">
                        {{$post->content}}
                    </p>
                </div>

            @endforeach
            </div>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
