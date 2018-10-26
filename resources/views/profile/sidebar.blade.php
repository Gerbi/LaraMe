<div class="col-md-3">
    <div class="card">
        <div class="card-header">Sidebar - Quick Links</div>
        <div class="card-body">
            @if(Auth::check())
                <ul>
                    <li>
                        <a href="{{ url('/profile') }}/{{Auth::user()->slug}}">
                            <img src="{{Config::get('../')}}/public/img/{{Auth::user()->pic}}"
                                 width="32" style="margin:5px"/>
                            {{Auth::user()->name}}</a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>



