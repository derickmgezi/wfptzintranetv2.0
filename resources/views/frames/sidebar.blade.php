
<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
    <ul class="nav nav-pills flex-column">
        <!--        <li class="nav-item">
                    <a class="nav-link {{((Request::is('home'))? 'active':'')}}" href="{{URL::to('/home')}}">
                        <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> PI <span class="sr-only">(current)</span>
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
                <li class="nav-item">
                    <a class="nav-link {{((Request::is('it'))? 'active':'')}}" href="{{URL::to('/it')}}">
                        <i class="fa fa-desktop fa-lg" aria-hidden="true"></i> IT
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{((Request::is('finance'))? 'active':'')}}" href="{{URL::to('/finance')}}">
                        <i class="fa fa-money fa-lg" aria-hidden="true"></i> Finance
                    </a>
                </li>
        -->     
        @if(Auth::user()->title != 'Administrator')
        <li class="nav-item">
            <a class="nav-link">
                {{Form::open(array('url' => '/search','class' => 'form-inline mt-2 mt-md-0','role' => 'form'))}}
                <div class="input-group {{ old('search')?'has-success':'' }}">
                    <input type="text" name="search" value="{{ old('search') }}" class="form-control form-control-sm form-control-success" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-success btn-sm" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                {{Form::close()}}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="http://newgo.wfp.org/collection/integrated-road-map-irm">
                <i class="fa fa-flag-o fa-lg" aria-hidden="true"></i> IRM
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="http://newgo.wfp.org/documents/tanzania-country-strategic-plan-2017-2021">
                <i class="fa fa-flag-checkered fa-lg" aria-hidden="true"></i> Tanzania CSP
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{((Request::is('internaldirectory'))? 'active':'')}}" href="{{URL::to('/internaldirectory')}}">
                <i class="fa fa-phone-square fa-lg" aria-hidden="true"></i> Phone Directory
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <a class="nav-link nav-link-collapse collapsed dropdown-toggle" data-toggle="collapse" href="#collapseSites">
                <i class="fa fa-globe fa-lg" aria-hidden="true"></i> <span class="nav-link-text">WFP Sites</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseSites" style="padding-left: 0;list-style: none;">
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="http://go.wfp.org" style="padding-left: 2em;"><i class="fa fa-sign-out fa-lg" aria-hidden="true"></i> NewGo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="http://mfapps.wfp.org" style="padding-left: 2em;"><i class="fa fa-paper-plane fa-lg" aria-hidden="true"></i> WINGSII</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="http://welearn.wfp.org" style="padding-left: 2em;"><i class="fa fa-leanpub fa-lg" aria-hidden="true"></i> WeLearn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="http://pace.wfp.org" style="padding-left: 2em;"><i class="fa fa-tachometer fa-lg" aria-hidden="true"></i> PACE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="http://mail.wfp.org" style="padding-left: 2em;"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i> WebMail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="http://info.wfp.org" style="padding-left: 2em;"><i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> INFO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="http://manuals.wfp.org" style="padding-left: 2em;"><i class="fa fa-book fa-lg" aria-hidden="true"></i> WFP Manuals</a>
                </li>
                <!--                <li class="nav-item">
                                    <a class="nav-link nav-link-collapse collapsed dropdown-toggle" data-toggle="collapse" href="#collapseMulti2" href="#" style="padding-left: 2em;">
                                        Login Page
                                    </a>
                                    <ul class="sidenav-third-level collapse" id="collapseMulti2" style="padding-left: 0;list-style: none;">
                                        <li>
                                            <a class="nav-link" href="#" style="padding-left: 3em;">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a class="nav-link" href="#" style="padding-left: 3em;">Third Level Item</a>
                                        </li>
                                    </ul>
                                </li>-->
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{((Request::is('feedback'))? 'active':'')}}" href="{{URL::to('/feedback')}}">
                <i class="fa fa-comments-o fa-lg" aria-hidden="true"></i> Feedback
            </a>
        </li>
        @if(Request::is('search'))
        <li class="nav-item">
            <a class="nav-link {{((Request::is('search'))? 'active':'')}}" href="#">
                <i class="fa fa-list fa-lg" aria-hidden="true"></i> Results
            </a>
        </li>
        @endif
        @else
        <li class="nav-item">
            <a class="nav-link {{((Request::is('manage'))? 'active':'')}}" href="{{URL::to('/manage')}}">
                <i class="fa fa-users fa-lg" aria-hidden="true"></i> Users
            </a>
        </li>
        @endif
    </ul>
</nav>
