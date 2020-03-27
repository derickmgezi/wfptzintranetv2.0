<div class="row mt-3">
    <div class="col-2">
        <ul class="nav nav-pills flex-column" role="tablist" style="position: sticky;top: 80px;">
            @if($news_search_results->isNotEmpty())
            <li class="nav-item card" style="margin-bottom: 2.5px">
                <a class="nav-link active justify-content-start" data-toggle="pill" role="tab" href="#updates">
                    Updates
                    <span class="float-right badge badge-pill badge-danger"><i class="fa fa-search"
                            aria-hidden="true"></i> {{ $news_search_results_count }}</span>
                </a>
            </li>
            @endif
            @if($story_search_results->isNotEmpty())
            <li class="nav-item card" style="margin-bottom: 2.5px">
                <a class="nav-link" data-toggle="pill" role="tab" href="#stories">
                    Stories
                    <span class="float-right badge badge-pill badge-danger"><i class="fa fa-search"
                            aria-hidden="true"></i> {{ $story_search_results_count }}</span>
                </a>
            </li>
            @endif
            @if($media_alert_search_results->isNotEmpty())
            <li class="nav-item card" style="margin-bottom: 2.5px">
                <a class="nav-link" data-toggle="pill" role="tab" href="#media">
                    Media
                    <span class="float-right badge badge-pill badge-danger"><i class="fa fa-search"
                            aria-hidden="true"></i> {{ $media_alert_search_results_count }}</span>
                </a>
            </li>
            @endif
            @if($resource_search_results->isNotEmpty())
            <li class="nav-item card" style="margin-bottom: 2.5px">
                <a class="nav-link" data-toggle="pill" role="tab" href="#resources">
                    Resources
                    <span class="float-right badge badge-pill badge-danger"><i class="fa fa-search"
                            aria-hidden="true"></i> {{ $resource_search_results_count }}</span>
                </a>
            </li>
            @endif
            @if($phone_directory_search_results->isNotEmpty())
            <li class="nav-item card" style="margin-bottom: 2.5px">
                <a class="nav-link" data-toggle="pill" role="tab" href="#directory">
                    Directory
                    <span class="float-right badge badge-pill badge-danger"><i class="fa fa-search"
                            aria-hidden="true"></i> {{ $phone_directory_search_results_count }}</span>
                </a>
            </li>
            @endif
        </ul>
    </div>

    <!-- Tab panes -->
    <div class="col-10 tab-content card border-right-0 border-bottom-0 border-top-0">
        @if($news_search_results->isNotEmpty())
        <div class="tab-pane fade show active" id="updates" role="tabpanel">
            <div class="row no-gutters">
                @foreach($news_search_results as $news_search_result)
                <div class="col-4 p-1">
                    <div class="card card-inverse card-primary">
                        <div class="caption">
                            <a href="{{ URL::to('read_update/'.$news_search_result->id) }}">
                                <img src="{{url('/storage/thumbnails/'.$news_search_result->image)}}" class="img-fluid rounded" />
                                <h2>{{ substr(strip_tags($news_search_result->header),0,65) }}{{ strlen(strip_tags($news_search_result->header)) > 65 ? "...":"" }}</h2>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @if($story_search_results->isNotEmpty())
        <div class="tab-pane fade" id="stories" role="tabpanel">
            <div class="tab-pane fade show active" id="updates" role="tabpanel">
                <div class="row no-gutters">
                    @foreach($story_search_results as $story_search_result)
                    <div class="col-4 p-1">
                        <div class="card card-inverse card-primary">
                            <div class="caption">
                                <a href="{{ URL::to('storiyangu/'.$story_search_result->id) }}">
                                    <img src="{{url('/storage/thumbnails/'.$story_search_result->image)}}"
                                        class="img-fluid rounded" />
                                    <h2>{{ substr(strip_tags($story_search_result->caption),0,65) }}{{ strlen(strip_tags($story_search_result->caption)) > 65 ? "...":"" }}
                                    </h2>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @if($media_alert_search_results->isNotEmpty())
        <div class="tab-pane fade" id="media" role="tabpanel">
            <div id="media-alert-accordion" role="tablist" aria-multiselectable="true">
                @foreach($media_alert_search_results as $media_alert_search_result)
                <?php $date = new Jenssegers\Date\Date($media_alert_search_result->date); ?>
                <div class="card mb-1">
                    <div class="card-header" role="tab" id="heading{{ $media_alert_search_result->id }}">
                        <h5 class="mb-0">
                            <div class="d-flex">
                                @if($media_alert_search_result->type == 'Link')
                                <span><i class="fa fa-external-link p-1 text-primary" aria-hidden="true"></i></span>
                                @else
                                <span><i class="fa fa-newspaper-o p-1  text-primary" aria-hidden="true"></i></span>
                                @endif
                                <a data-toggle="collapse" data-parent="#media-alert-accordion"
                                    href="#collapse{{ $media_alert_search_result->id }}" aria-expanded="true"
                                    aria-controls="collapse{{ $media_alert_search_result->id }}">
                                    <small>{{ $media_alert_search_result->header }}</small>
                                    <!-- <small class="font-weight-bold">{{ $media_alert_search_result->header }}</small> -->
                                </a>
                            </div>
                            <span
                                class="badge badge-primary smaller font-italic">{{ $media_alert_search_result->source }}</span>
                            @if(Auth::user()->department == "Comms")
                            <div class="float-right">
                                <a v-on:click="editModal({{$media_alert_search_result}})" role="button"
                                    class="text-warning" data-toggle="modal" data-target="#edit-media-alert-modal">
                                    <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                </a>
                                <a v-on:click="deleteModal({{$media_alert_search_result}})" role="button"
                                    class="text-danger" data-toggle="modal" data-target="#delete-media-alert-modal">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </div>
                            @endif
                        </h5>
                    </div>
                    <div id="collapse{{ $media_alert_search_result->id }}" class="collapse" role="tabpanel"
                        aria-labelledby="heading{{ $media_alert_search_result->id }}">
                        @if($media_alert_search_result->type == 'Image')
                        <a role="button" v-on:click="showModal({{$media_alert_search_result}})" data-toggle="modal"
                            data-target="#media-alert-modal">
                            <img class="img-fluid img-responsive img-thumbnail w-100"
                                src="{{ URL::to('imagecache/original/'.$media_alert_search_result->mediacontent) }}"
                                alt="Image Alt">
                        </a>
                        @elseif($media_alert_search_result->type == 'Link')
                        <div class="">
                            <!-- <iframe class="embed-responsive-item" src="{{ $media_alert_search_result->mediacontent }}">
                                    alternative content for browsers which do not support iframe.
                                </iframe> -->
                            <a class="badge badge-success m-3" target="_blank"
                                href='{{ $media_alert_search_result->mediacontent }}'>
                                {{ substr(strip_tags($media_alert_search_result->mediacontent),0,40) }}{{ strlen(strip_tags($media_alert_search_result->mediacontent)) > 40 ? "...":"" }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @if($resource_search_results->isNotEmpty())
        <div class="tab-pane fade" id="resources" role="tabpanel">
            <?php
            $resource_types = $resource_search_results->unique('resource_type');
            ?>
            @foreach($resource_types as $resource_type)
            <h4 class="text-primary">{{ $resource_type->resource_type }}</h4>
            <?php
                $resources = $resource_search_results->where('resource_type',$resource_type->resource_type);
                ?>
            @foreach($resources as $resource)
            &nbsp;&nbsp;<i @if($resource->external_link == "Yes") class="fa fa-link" @else class="fa fa-file-text"
                @endif aria-hidden="true"></i>
            <?php $date = new Jenssegers\Date\Date($resource->updated_at); ?>
            <a class="text-muted font-italic" data-delay="300" data-trigger="hover" data-container="body"
                data-toggle="popover" data-trigger="focus" data-placement="right" data-html="true" title="Updated by"
                data-content="{{ App\user::find($resource->edited_by)->firstname." ".App\user::find($resource->edited_by)->secondname }}<br>{{ $date->ago() }}"
                @if($resource->external_link == "Yes") target="_blank"
                href="{{URL::to('/resource/'.$resource->resource_type.'/'.$resource->external_link.'/'.encrypt($resource->resource_location))}}"
                @else
                href="{{URL::to('/resource/'.$resource->resource_type.'/'.$resource->external_link.'/'.$resource->resource_location)}}"
                @endif>{{$resource->resource_name}}</a>
            <br>
            @endforeach
            @endforeach
        </div>
        @endif
        @if($phone_directory_search_results->isNotEmpty())
        <div class="tab-pane fade" id="directory" role="tabpanel">
            <table class="table table-striped table table-sm">
                <thead class="thead-inverse">
                    <tr>
                        <th class="text-center">
                            <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i> User
                        </th>
                        <th class="text-center">
                            <i class="fa fa-address-card-o fa-lg" aria-hidden="true"></i> Role
                        </th>
                        <th class="text-center">
                            <i class="fa fa-home" aria-hidden="true"></i> Duty Station
                        </th>
                        <th class="text-center">
                            <i class="fa fa-phone fa-lg" aria-hidden="true"></i> Extension
                        </th>
                        <th class="text-center">
                            <i class="fa fa-mobile fa-lg" aria-hidden="true"></i> Office Mobile
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($phone_directory_search_results as $phone_directory_search_result)
                    <tr>
                        <td class="text-center"><em>{{ $phone_directory_search_result->name }}</em></td>
                        <td class="text-center"><em>{{ $phone_directory_search_result->function }}</em></td>
                        <td class="text-center"><em>{{ $phone_directory_search_result->location }}</em></td>
                        <td class="text-center"><em>{{ $phone_directory_search_result->ext_no }}</em></td>
                        <td class="text-center"><em>{{ $phone_directory_search_result->number }}</em></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>