<div class="col-md-3">
    <div class="card">
        {{--<div class="card-header">Sidebar - Quick Links</div>--}}
        <div class="card-body">
            @if(Auth::check())
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center pt-0" href="{{ url('/profile') }}/{{Auth::user()->slug}}" aria-hidden="true">
                            <img class="rounded-circle" src="{{Config::get('../')}}/public/img/{{Auth::user()->pic}}"
                                 width="32" height="32" style="margin:5px"/>
                            <span>{{Auth::user()->name}}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center pt-0" href="{{url('/friends')}}">
                            <i class="fas fa-user-friends fa-2x"></i>
                            Friends </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>



