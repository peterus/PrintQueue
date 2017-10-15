@if (Auth::guest())
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <li><a href="{{ url('/register') }}"><span class="glyphicon glyphicon-user"></span> Register</a></li>
        <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </li>
    </ul>
@else
    <ul class="nav navbar-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{ url('/projects') }}">all</a></li>
                <li role="separator" class="divider"></li>
                @foreach($menu_projects as $project_loop)
                    <li><a href="{{ url('/projects/'.$project_loop->id) }}">{{ $project_loop->name }}</a></li>
                @endforeach
            </ul>
        </li>
        <li><a href="{{ url('/printjob') }}">Print Jobs</a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Slicer <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="{{ url('/slicer') }}">all Slicer</a></li>
                <li><a href="{{ url('/slicersetting') }}">all Settings</a></li>
                <li role="separator" class="divider"></li>
                @foreach($menu_slicer as $slicer_loop)
                    <li><a href="{{ url('/slicer/'.$slicer_loop->id) }}">{{ $slicer_loop->name }}</a></li>
                @endforeach
            </ul>
        </li>
        @if(isset($menu_project))
        <li><a href="{{ url('/projects/'.$menu_project->id) }}">{{ $menu_project->name }}</a></li>
        @endif
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                </ul>
        </li>
    </ul>
@endif
