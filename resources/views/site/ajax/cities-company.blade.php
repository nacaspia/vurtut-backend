@if(!empty($allCompaniesByCity[0]))
    @foreach($allCompaniesByCity as $companyCity)
        <div class="col-md-6 col-lg-6">
            <div class="feat_property"{{-- style="min-height: 404px;max-height: 404px;!important;"--}}>

                <div class="thumb">
                    <img class="img-whp" style="width: 100%; max-height: 164px; object-fit: contain; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$companyCity['image']) }}" alt="{{ $companyCity['full_name'] }}">
                    <div class="thmb_cntnt">
                        <ul class="tag mb0">
                            @if($companyCity['is_premium'] == 1)<li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}"> PEMIUM </a></li>@endif
{{--                                <li class="list-inline-item"><a href="#">Open</a></li>--}}
                        </ul>
                        <ul class="listing_reviews">
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white total_review" href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}">({{count($companyCity['comments'])}} Rəy)</a></li>
                        </ul>
                    </div>
                </div>
                <div class="details">
                    <div class="tc_content">
{{--                        <div class="badge_icon"><a href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}"><img src="{{ asset("site/images/icons/agent1.svg") }}" alt="agent1.svg"></a></div>--}}
                        <h4>{{ $companyCity['full_name'] }}</h4>
                        <p>{{ \Illuminate\Support\Str::limit($companyCity['text'], 50, '...') }}</p>
                        @php
                            $data = $companyCity['data'];
                        @endphp
                        <ul class="prop_details mb0">
                            <li class="list-inline-item"><a href="tel:{{ $companyCity['one_phone']?? $companyCity['phone'] }}"><span class="flaticon-phone pr5"></span> {{ $companyCity['one_phone'] ?? $companyCity['phone'] }}</a></li>
                            <li class="list-inline-item"><a href="#"><span class="flaticon-pin pr5"></span>{{ $data['address'] ?? null }}</a></li>
                        </ul>
                    </div>
                    <div class="fp_footer">
                        <ul class="fp_meta float-left mb0">
                            @if(!empty($companyCity['category']['image']))
                                <li class="list-inline-item">
                                    <a href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}">
                                        <img src="{{ asset("uploads/categories/".$companyCity['category']['image']) }}" alt="{{$companyCity['category']['title'][$currentLang] ?? ''}}" style="max-height: 28px;!important;">
                                    </a>
                                </li>
                            @endif
                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}">{{$companyCity['category']['title'][$currentLang] ?? ''}}</a></li>
                        </ul>
                        <ul class="fp_meta float-right mb0">
                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}"><span class="flaticon-zoom"></span> Daha ətraflı</a></li>
                            @if(!empty(auth('user')->user()->id))
                                <li class="list-inline-item">
                                    <a href="javascript:void(0);" class="like-btn icon"
                                       data-item-id="{{ $companyCity['id'] }}"
                                       data-item-type="company"
                                       data-liked="{{ (!empty($companyCity['userLikes']['user_id']) && $companyCity['userLikes']['user_id'] == auth('user')->user()->id) ?? false }}">
                                        <span class="flaticon-love {{ (!empty($companyCity['userLikes']['user_id']) && $companyCity['userLikes']['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
