@if(!empty($allCompaniesByCategory[0]))
    @foreach($allCompaniesByCategory as $companyCategory)
        <div class="col-md-6 col-lg-6">
            <div class="feat_property">
                <div class="thumb">
                    <img class="img-whp" style="width: 100%; max-height: 164px; object-fit: contain; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$companyCategory['image']) }}" alt="{{ $companyCategory['full_name'] }}">
                    <div class="thmb_cntnt">
                        <ul class="tag mb0">
                            @if($companyCategory['is_premium'] == 1)<li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}"> PEMIUM </a></li>@endif
{{--                            <li class="list-inline-item"><a href="#">Open</a></li>--}}
                        </ul>
                        <ul class="listing_reviews">
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white total_review" href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}">({{count($companyCategory['comments'])}} Rəy)</a></li>
                        </ul>
                    </div>
                </div>
                <div class="details">
                    <div class="tc_content">
                        <div class="badge_icon"><a href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}"><img src="{{ asset("site/images/icons/agent1.svg") }}" alt="agent1.svg"></a></div>
                        <h4>{{ $companyCategory['full_name'] }}</h4>
                        <p>{{ \Illuminate\Support\Str::limit($companyCategory['text'], 50, '...') }}</p>
                        @php
                            $data = $companyCategory['data'];
                        @endphp
                        <ul class="prop_details mb0">
                            <li class="list-inline-item"><a href="tel:{{ $companyCategory['phone'] ?? '' }}"><span class="flaticon-phone pr5"></span> {{ $companyCategory['phone'] ?? '' }}</a></li>
                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}"><span class="flaticon-pin pr5"></span>{{ $data['address'] ?? '' }}</a></li>
                        </ul>
                    </div>
                    <div class="fp_footer">
                        <ul class="fp_meta float-left mb0">
                            @if(!empty($companyCategory['category']['image']))
                                <li class="list-inline-item">
                                    <a href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}">
                                        <img src="{{ asset("uploads/categories/".$companyCategory['category']['image']) }}" alt="{{$companyCategory['category']['title'][$currentLang]}}" style="max-height: 28px;!important;">
                                    </a>
                                </li>
                            @endif
                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}">{{ $companyCategory['category']['title'][$currentLang] ?? '' }}</a></li>
                        </ul>
                        <ul class="fp_meta float-right mb0">
                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}"><span class="flaticon-zoom"></span> Daha ətraflı</a></li>
                            @if(!empty(auth('user')->user()->id))
                                <li class="list-inline-item">
                                    <a href="javascript:void(0);" class="like-btn icon"
                                       data-item-id="{{ $companyCategory['id'] }}"
                                       data-item-type="company"
                                       data-liked="{{ (!empty($companyCategory['userLikes']['user_id']) && $companyCategory['userLikes']['user_id'] == auth('user')->user()->id) ?? false }}">
                                        <span class="flaticon-love {{ (!empty($companyCategory['userLikes']['user_id']) && $companyCategory['userLikes']['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
                                    </a>
                                    {{--                                                                    <a class="icon" href="#"><span class="flaticon-love"></span></a>--}}
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
