
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projects <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="/projects">all</a></li>
        <li role="separator" class="divider"></li>
        @foreach($menu_projects as $project)
            <li><a href="/projects/{!! $project->id !!}">{!! $project->name !!}</a></li>
        @endforeach
    </ul>
</li>
<li><a href="/printjob">Print Jobs</a></li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Slicer <span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="/slicer">all Slicer</a></li>
        <li><a href="/slicersetting">all Settings</a></li>
        <li role="separator" class="divider"></li>
        @foreach($menu_slicer as $slicer)
            <li><a href="/slicer/{!! $slicer->id !!}">{!! $slicer->name !!}</a></li>
        @endforeach
    </ul>
</li>
