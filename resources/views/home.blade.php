@include('frames/header')
<div class="container-fluid">
    <div class="row">

        @include('frames/sidebar')

        <div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3" id="app">

            <!--            @include('components/pi/picarousel')-->

            <!-- Marketing messaging and featurettes
            ================================================== -->
            <!-- Wrap the rest of the page in another container to center all the content. -->

            <div class="container-fluid marketing">                        

                <div class="row">
                    <div class="col-md-9">
                        {{-- @if($news->count() != 0)
                        <div class="justify-content-start">
                            <h2 class="mr-3">
                                <span class="small h4">WFP Updates</span>
                                <span class="smaller font-weight-bold text-primary">posted recently</span>
                            </h2>
                        </div>

                        <div class="row no-gutters align-items-stretch">
                            <div v-clock v-for="news_update in news" v-on:mouseover="changenewscolor(news_update.id)"
                                v-on:mouseleave="changebacknewscolor(news_update.id)" class="col-md-4 p-1">
                                <div v-if="showNewsBlock == news_update.id"
                                    class="card card-inverse card-primary h-100">
                                    <a :href="{{ json_encode(URL::to('read_update')) }} + '/' + news_update.id">
                                        <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('imagecache/original/thumbnails')) }} + '/' + news_update.image" alt="Card image cap">
                                    </a>
                                    <transition name="news-block-appear" enter-active-class="animated flipInX" leave-active-class="animated flipOutX">
                                        <!-- <div v-if="showNewsBlock == news_update.id" class="card-block"> -->
                                        <div class="card-block">
                                            <a :href="{{ json_encode(URL::to('read_update')) }} + '/' + news_update.id" class="card-text text-white">
                                                <strong v-if="news_update.header.length > 45" v-html="news_update.header.substring(0,45) + '...'"></strong>
                                                <strong v-else v-html="news_update.header"></strong>
                                            </a>
                                        </div>
                                    </transition>
                                </div>
                                <div v-clock v-else class="card card-primary card-outline-primary h-100">
                                    <a href="{{URL::to('/news')}}">
                                        <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('imagecache/original/thumbnails')) }} + '/' + news_update.image" alt="Card image cap">
                                    </a>
                                    <transition name="news-block-appear" enter-active-class="animated flipInX"
                                        leave-active-class="animated flipOutX">
                                        <!-- <div v-if="showNewsBlock == news_update.id" class="card-block"> -->
                                        <div class="card-block">
                                            <a href="{{URL::to('/news')}}" class="card-text text-primary">
                                                <strong v-if="news_update.header.length > 45" v-html="news_update.header.substring(0,45) + '...'"></strong>
                                                <strong v-else v-html="news_update.header"></strong>
                                            </a>
                                        </div>
                                    </transition>
                                </div>
                            </div>

                        </div>
                        @endif

                        @if($stories->count() != 0)
                        <div class="justify-content-start">
                            <h2 class="mr-3 mt-3">
                                <span class="small">Stori Yangu</span>
                                <span class="smaller font-weight-bold text-primary">posted recently</span>
                            </h2>
                        </div>

                        <div class="row no-gutters align-items-stretch">
                            <div v-clock v-for="story in stories" v-on:mouseover="changestorycolor(story.id)" v-on:mouseleave="changebackstorycolor(story.id)" class="col-md-4 p-1">
                                <div v-if="showStoryBlock == story.id" class="card card-inverse card-primary h-100">
                                    <a :href="{{ json_encode(URL::to('storiyangu')) }} + '/' + story.id">
                                        <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('imagecache/original/thumbnails')) }} + '/' + story.image" alt="Card image cap">
                                    </a>
                                    <transition name="story-block-appear" enter-active-class="animated flipInX" leave-active-class="animated flipOutX">
                                        <!-- <div v-if="showStoryBlock == story.id" class="card-block"> -->
                                        <div class="card-block">
                                            <a :href="{{ json_encode(URL::to('storiyangu')) }} + '/' + story.id" class="card-text text-white">
                                                <strong v-if="story.caption.length > 45" v-html="story.caption.substring(0,45) + '...'"></strong>
                                                <strong v-else v-html="story.caption"></strong>
                                            </a>
                                        </div>
                                    </transition>
                                </div>
                                <div v-clock v-else class="card card-primary card-outline-primary h-100">
                                    <a href="{{URL::to('/storiyangu')}}">
                                        <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('imagecache/original/thumbnails')) }} + '/' + story.image" alt="Card image cap">
                                    </a>
                                    <transition name="story-block-appear" enter-active-class="animated flipInX" leave-active-class="animated flipOutX">
                                        <!-- <div v-if="showStoryBlock == story.id" class="card-block"> -->
                                        <div class="card-block">
                                            <a href="{{URL::to('/storiyangu')}}" class="card-text text-primary">
                                                <strong v-if="story.caption.length > 45" v-html="story.caption.substring(0,45) + '...'"></strong>
                                                <strong v-else v-html="story.caption"></strong>
                                            </a>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                        @endif --}}

                        @if($updates->count() != 0)
                        <div class="justify-content-start">
                            <h2 class="mr-3">
                                <span class="small">WFP Updates</span>
                                <span class="smaller font-weight-bold text-primary">posted recently</span>
                            </h2>
                        </div>

                        <div class="row no-gutters">
                            <div class="col-md-4 p-1 d-flex align-items-stretch" v-clock v-for="update in updates" v-on:mouseover="changeupdatecolor(update.id)" v-on:mouseleave="changebackupdatecolor(update.id)">
                                <div v-if="update.caption">
                                    <div v-if="showUpdateBlock == update.id" class="card card-inverse card-primary h-100">
                                        <a :href="{{ json_encode(URL::to('storiyangu')) }} + '/' + update.id">
                                            <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('imagecache/original/thumbnails')) }} + '/' + update.image" alt="Card image cap">
                                        </a>
                                        <transition name="update-block-appear" enter-active-class="animated flipInX" leave-active-class="animated flipOutX">
                                            <!-- <div v-if="showUpdateBlock == update.id" class="card-block"> -->
                                            <div class="card-block">
                                                <a :href="{{ json_encode(URL::to('storiyangu')) }} + '/' + update.id" class="card-text text-white">
                                                    <strong v-if="update.caption.length > 45" v-html="update.caption.substring(0,45) + '...'"></strong>
                                                    <strong v-else v-html="update.caption"></strong>
                                                </a>
                                            </div>
                                        </transition>
                                    </div>
                                    <div v-clock v-else class="card card-primary card-outline-primary h-100">
                                        <a href="{{URL::to('/storiyangu')}}">
                                            <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('imagecache/original/thumbnails')) }} + '/' + update.image" alt="Card image cap">
                                        </a>
                                        <transition name="update-block-appear" enter-active-class="animated flipInX" leave-active-class="animated flipOutX">
                                            <!-- <div v-if="showUpdateBlock == update.id" class="card-block"> -->
                                            <div class="card-block">
                                                <a href="{{URL::to('/storiyangu')}}" class="card-text text-primary">
                                                    <strong v-if="update.caption.length > 45" v-html="update.caption.substring(0,45) + '...'"></strong>
                                                    <strong v-else v-html="update.caption"></strong>
                                                </a>
                                            </div>
                                        </transition>
                                    </div>
                                </div>
                                <div v-else>
                                    <div v-if="showUpdateBlock == update.id" class="card card-inverse card-primary h-100">
                                        <a :href="{{ json_encode(URL::to('read_update')) }} + '/' + update.id">
                                            <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('imagecache/original/thumbnails')) }} + '/' + update.image" alt="Card image cap">
                                        </a>
                                        <transition name="update-block-appear" enter-active-class="animated flipInX" leave-active-class="animated flipOutX">
                                            <!-- <div v-if="showUpdateBlock == update.id" class="card-block"> -->
                                            <div class="card-block">
                                                <a :href="{{ json_encode(URL::to('read_update')) }} + '/' + update.id" class="card-text text-white">
                                                    <strong v-if="update.header.length > 45" v-html="update.header.substring(0,45) + '...'"></strong>
                                                    <strong v-else v-html="update.header"></strong>
                                                </a>
                                            </div>
                                        </transition>
                                    </div>
                                    <div v-clock v-else class="card card-primary card-outline-primary h-100">
                                        <a href="{{URL::to('/news')}}">
                                            <img class="card-img-top img-fluid" :src="{{ json_encode(URL::to('imagecache/original/thumbnails')) }} + '/' + update.image" alt="Card image cap">
                                        </a>
                                        <transition name="update-block-appear" enter-active-class="animated flipInX" leave-active-class="animated flipOutX">
                                            <!-- <div v-if="showUpdateBlock == update.id" class="card-block"> -->
                                            <div class="card-block">
                                                <a href="{{URL::to('/news')}}" class="card-text text-primary">
                                                    <strong v-if="update.header.length > 45" v-html="update.header.substring(0,45) + '...'"></strong>
                                                    <strong v-else v-html="update.header"></strong>
                                                </a>
                                            </div>
                                        </transition>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="alert alert-success mb-4" role="alert">
                            <h4 class="alert-heading">Welcome to WFP Updates Page</h4>
                            <strong>Currently</strong> no updates or stories have been posted yet.
                        </div>
                        @endif
                    </div>

                    <div class="col-md-3">
                        {{-- <div class="justify-content-start">
                            <h2 class="mr-3">
                                <span class="small">Links</span>
                                <span class="smaller font-weight-bold text-primary">WFP favorites</span>
                            </h2>
                        </div>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/Transport-Request/'.encrypt('https://humanitarianbooking.wfp.org/en/explore/country/tz/?service=UN+Driver+Hub'))}}">
                                <i class="fa fa-car"aria-hidden="true"></i>&nbsp;Transport Request
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/NewGo/'.encrypt('https://newgo.wfp.org'))}}">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;NewGo
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/SelfService/'.encrypt('https://selfservice.go.wfp.org'))}}">
                                <i class="fa fa-server" aria-hidden="true"></i>&nbsp;Self Service
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/WINGSII/'.encrypt('https://mfapps.wfp.org'))}}">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;WINGSII
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/DSA-Rates/'.encrypt('https://newgo.wfp.org/documents/daily-subsistence-allowance-dsa?country=tanzania-united-rep-of-shilling#block--dsa-rates'))}}">
                                <i class="fa fa-bar-chart"aria-hidden="true"></i>&nbsp;DSA Rates
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/UN-Exchange-Rate/'.encrypt('https://treasury.un.org/operationalrates/OperationalRates.php#T'))}}">
                                <i class="fa fa-exchange"aria-hidden="true"></i>&nbsp;UN Exchange Rate
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/Security-Clearance/'.encrypt('https://trip.dss.un.org/dssweb/WelcometoUNDSS/tabid/105/Default.aspx?returnurl=%2fdssweb%2f'))}}">
                                <i class="fa fa-shield"aria-hidden="true"></i>&nbsp;Security Clearance
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/PACE/'.encrypt('https://pace.wfp.org'))}}">
                                <i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;PACE
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/WeLearn/'.encrypt('https://welearn.wfp.org'))}}">
                                <i class="fa fa-leanpub"aria-hidden="true"></i>&nbsp;WeLearn
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/Reset-Password/'.encrypt('https://password.go.wfp.org/'))}}">
                                <i class="fa fa-key"aria-hidden="true"></i>&nbsp;Change Password
                            </a>
                        </div> --}}

                        <div class="justify-content-start">
                            <h2 class="mr-3">
                                <span class="small">Links</span>
                                <span class="smaller font-weight-bold text-primary">my favorites</span>
                            </h2>
                        </div>
                        <div class="list-group">
                            @if($links->count() >= 5)
                                @foreach($links as $link)
                                    @foreach($accessed_links as $accessed_link)
                                        @if($accessed_link->action_details == $link->action_details)
                                        <a class="list-group-item list-group-item-action active mb-1" @if($accessed_link->link_type == "External")target="_blank"@endif href="{{URL::to($accessed_link->link_accessed)}}">
                                            <?php 
                                                $strings_to_be_replace = array("Redirected ", "to ", " Page", " displayed", "Accessed ", "");
                                                $link->action_details = str_replace($strings_to_be_replace, "", $link->action_details);
                                            ?>
                                            {{ $link->action_details }}
                                        </a>
                                        @endif
                                    @endforeach
                                @endforeach
                            @else
                            <a class="list-group-item list-group-item-action active mb-1" href="{{URL::to('/internaldirectory')}}">
                                Telephone Directory
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/NewGo/'.encrypt('http://go.wfp.org'))}}">
                                WFPgo
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" target="_blank" href="{{URL::to('/external_link/WINGSII/'.encrypt('http://mfapps.wfp.org'))}}">
                                WINGSII
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" href="{{URL::to('/mediaalerts')}}">
                                News Alerts
                            </a>
                            <a class="list-group-item list-group-item-action active mb-1" href="{{URL::to('/resource#sop')}}">
                                Resources
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Three columns of text below the carousel -->
                <hr class="featurette-divider">

                <!-- FOOTER -->
                @include('frames/footer')

