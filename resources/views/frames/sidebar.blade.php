
<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link {{((Request::is('home'))? 'active':'')}}" href="{{URL::to('/home')}}">
                <i class="fa fa-globe fa-lg" aria-hidden="true"></i> PI <span class="sr-only">(current)</span>
            </a>
        </li>
        @if(Request::is('news'))
        <li class="nav-item">
            <a class="nav-link {{((Request::is('news'))? 'active':'')}}" href="#">
                <i class="fa fa-newspaper-o fa-lg" aria-hidden="true"></i> News Post
            </a>
        </li>
        @endif
        @if(Request::is('previous'))
        <li class="nav-item">
            <a class="nav-link {{((Request::is('previous'))? 'active':'')}}" href="#">
                <i class="fa fa-calendar fa-lg" aria-hidden="true"></i> News Calender
            </a>
        </li>
        @endif
<!--        <li class="nav-item">
            <a class="nav-link {{((Request::is('it'))? 'active':'')}}" href="#">
                <i class="fa fa-desktop fa-lg" aria-hidden="true"></i> IT
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{((Request::is('finance'))? 'active':'')}}" href="#">
                <i class="fa fa-university fa-lg" aria-hidden="true"></i> Finance
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{((Request::is('admin'))? 'active':'')}}" href="#">
                <i class="fa fa-arrows-alt fa-lg" aria-hidden="true"></i> Administration
            </a>
        </li>-->
        <li class="nav-item">
            <a class="nav-link {{((Request::is('internaldirectory'))? 'active':'')}}" href="{{URL::to('/internaldirectory')}}">
                <i class="fa fa-phone-square fa-lg" aria-hidden="true"></i> Phone Directory
            </a>
        </li>
        @if(Request::is('search'))
        <li class="nav-item">
            <a class="nav-link {{((Request::is('search'))? 'active':'')}}" href="#">
                <i class="fa fa-list fa-lg" aria-hidden="true"></i> Results
            </a>
        </li>
        @endif
    </ul>
</nav>
