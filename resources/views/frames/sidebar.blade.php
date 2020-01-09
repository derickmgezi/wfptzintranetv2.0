
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
                @if(Request::is('conferencereservation'))
                <li class="nav-item">
                    <a class="nav-link {{((Request::is('conferencereservation'))? 'active':'')}}" href="#">
                        <i class="fa fa-calendar fa-lg" aria-hidden="true"></i> News Calendar
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
        <!-- <li class="nav-item">
            <a class="nav-link" target="_blank" href="http://newgo.wfp.org/collection/integrated-road-map-irm">
                <i class="fa fa-flag-o fa-lg" aria-hidden="true"></i> IRM
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="http://newgo.wfp.org/documents/tanzania-country-strategic-plan-2017-2021">
                <i class="fa fa-flag-checkered fa-lg" aria-hidden="true"></i> Tanzania CSP
            </a>
        </li>
        <li class="nav-item faa-horizontal animated-hover">
            <a class="nav-link" target="_blank" href="{{URL::to('/external_link/Mission-Calendar/'.encrypt('https://docs.google.com/spreadsheets/d/1YNeP4ltjH2tELuwxS_50cJYkAGbGhxCicmmrFnRGOO8/edit?usp=sharing'))}}">
                <i class="fa fa-calendar" aria-hidden="true"></i> Mission Calendar
            </a>
        </li> -->
        <li class="nav-item faa-horizontal animated-hover">
            <a class="nav-link" target="_blank" href="{{URL::to('/external_link/Mission-Calendar/'.encrypt('https://wfp.sharepoint.com/sites/TANZANIASHAREFOLDERS/Lists/WFP%20TZ%20Missions%20Calendar/calendar.aspx'))}}">
                <i class="fa fa-calendar" aria-hidden="true"></i> Mission Calendar
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link faa-horizontal animated-hover {{((Request::is('internaldirectory'))? 'active':'')}}" href="{{URL::to('/internaldirectory')}}">
                <i class="fa fa-address-book-o {{((Request::is('internaldirectory'))? 'faa-tada animated':'')}}" aria-hidden="true"></i> Phone Directory
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link faa-horizontal animated-hover {{((Request::is('resource'))? 'active':'')}}" href="{{URL::to('/resource')}}">
                <i class="fa fa-file-text {{((Request::is('resource'))? 'faa-tada animated':'')}}" aria-hidden="true"></i> Resources
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link faa-horizontal animated-hover {{((Request::is('conferencereservation'))? 'active':'')}}" href="{{URL::to('/conferencereservation')}}">
                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Conference Reservation
            </a>
        </li>
        <li class="nav-item faa-horizontal animated-hover">
            <a class="nav-link" target="_blank" href="{{URL::to('/external_link/Transport-Request/'.encrypt('https://humanitarianbooking.wfp.org/en/explore/country/tz/?service=UN+Driver+Hub'))}}">
                <i class="fa fa-car" aria-hidden="true"></i> Transport Request
            </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right">
            <a class="nav-link nav-link-collapse collapsed dropdown-toggle faa-horizontal animated-hover" data-toggle="collapse" href="#collapseSites">
                <i class="fa fa-external-link" aria-hidden="true"></i> <span class="nav-link-text">WFP Sites</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseSites" style="padding-left: 0;list-style: none;">
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{URL::to('/external_link/NewGo/'.encrypt('http://go.wfp.org'))}}" style="padding-left: 2em;"><i class="fa fa-sign-out" aria-hidden="true"></i> NewGo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{URL::to('/external_link/WINGSII/'.encrypt('http://mfapps.wfp.org'))}}" style="padding-left: 2em;"><i class="fa fa-paper-plane" aria-hidden="true"></i> WINGSII</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{URL::to('/external_link/WeLearn/'.encrypt('http://welearn.wfp.org'))}}" style="padding-left: 2em;"><i class="fa fa-leanpub" aria-hidden="true"></i> WeLearn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{URL::to('/external_link/PACE/'.encrypt('http://pace.wfp.org'))}}" style="padding-left: 2em;"><i class="fa fa-tachometer" aria-hidden="true"></i> PACE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{URL::to('/external_link/WebMail/'.encrypt('http://outlook.office365.com'))}}" style="padding-left: 2em;"><i class="fa fa-envelope" aria-hidden="true"></i> WebMail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{URL::to('/external_link/SelfService/'.encrypt('https://selfservice.go.wfp.org'))}}" style="padding-left: 2em;"><i class="fa fa-server" aria-hidden="true"></i> SelfService</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{URL::to('/external_link/WFP-INFO/'.encrypt('http://info.wfp.org'))}}" style="padding-left: 2em;"><i class="fa fa-info-circle" aria-hidden="true"></i> INFO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="{{URL::to('/external_link/WFP-Manuals/'.encrypt('http://manuals.wfp.org'))}}" style="padding-left: 2em;"><i class="fa fa-book" aria-hidden="true"></i> WFP Manuals</a>
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
        <li class="nav-item faa-horizontal animated-hover">
            <a class="nav-link" target="_blank" href="{{URL::to('/external_link/DSA-Rates/'.encrypt('http://newgo.wfp.org/documents/daily-subsistence-allowance-dsa?country=tanzania-united-rep-of-shilling#block--dsa-rates'))}}">
                <i class="fa fa-bar-chart" aria-hidden="true"></i> DSA Rates
            </a>
        </li>
        <li class="nav-item faa-horizontal animated-hover">
            <a class="nav-link" target="_blank" href="{{URL::to('/external_link/UN-Exchange-Rate/'.encrypt('https://treasury.un.org/operationalrates/OperationalRates.php#T'))}}">
                <i class="fa fa-exchange" aria-hidden="true"></i> UN Exchange Rate
            </a>
        </li>
        <li class="nav-item faa-horizontal animated-hover">
            <a class="nav-link" target="_blank" href="{{URL::to('/external_link/Security-Clearance/'.encrypt('https://trip.dss.un.org/dssweb/WelcometoUNDSS/tabid/105/Default.aspx?returnurl=%2fdssweb%2f'))}}">
                <i class="fa fa-shield" aria-hidden="true"></i> Security Clearance
            </a>
        </li>
        <li class="nav-item faa-horizontal animated-hover">
            <a class="nav-link" target="_blank" href="{{URL::to('/external_link/Reset-Password/'.encrypt('https://password.go.wfp.org/'))}}">
                <i class="fa fa-key" aria-hidden="true"></i> Change Password
            </a>
        </li>
        <li class="nav-item faa-horizontal animated-hover">
            <a class="nav-link {{((Request::is('feedback'))? 'active':'')}}" href="{{URL::to('/feedback')}}">
                <i class="fa fa-comments-o {{((Request::is('feedback'))? 'faa-tada animated':'')}}" href="{{URL::to('/feedback')}}" aria-hidden="true"></i> Feedback
            </a>
        </li>
        @if(Request::is('search'))
        <li class="nav-item">
            <a class="nav-link {{((Request::is('search'))? 'active':'')}}" href="#">
                <i class="fa fa-list {{((Request::is('search'))? 'faa-tada animated':'')}}" aria-hidden="true"></i> Results
            </a>
        </li>
        @endif
        @else
        <li class="nav-item">
            <a class="nav-link {{((Request::is('manage'))? 'active':'')}}" href="{{URL::to('/manage')}}">
                <i class="fa fa-users {{((Request::is('manage'))? 'faa-tada animated':'')}}" href="{{URL::to('/manage')}}" aria-hidden="true"></i> Users
            </a>
        </li>
        @endif
    </ul>
</nav>
