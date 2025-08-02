@if(!empty($allCompaniesByTrends[0]))
    @foreach($allCompaniesByTrends as $companyByTrends)
        <div class="col-lg-12">
            <div class="feat_property list">
                <div class="thumb">
                    <img class="img-whp" src="{{ asset("uploads/company/".$companyByTrends['image']) }}" alt="{{ $companyByTrends['full_name'] }}">
                    <div class="thmb_cntnt">
                        <ul class="tag mb0">
                            @if($companyByTrends['is_premium'] == 1)<li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyByTrends['slug']]) }}"> PEMIUM </a></li>@endif
{{--                                <li class="list-inline-item"><a href="#">Open</a></li>--}}
                        </ul>
                        <ul class="listing_reviews">
                            <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white" href="#"><span class="fa fa-star"></span></a></li>
                            <li class="list-inline-item"><a class="text-white total_review" href="{{ route('site.companyDetails',['slug' => $companyByTrends['slug']]) }}">({{count($companyByTrends['comments'])}} Rəy)</a></li>
                        </ul>
                    </div>
                </div>
                <div class="details">
                    <div class="tc_content">
                        <h4>{{ $companyByTrends['full_name'] }}</h4>
                        <p><img class="list_simg rounded-circle mr5" src="{{ asset("site/images/icons/agent1.svg") }}" alt="agent1.svg"> {{ \Illuminate\Support\Str::limit($companyByTrends['text'], 50, '...') }}</p>
                        @php
                            $data = $companyByTrends['data'];
                        @endphp
                        <ul class="prop_details mb0 mt15">
                            <li class="list-inline-item"><a href="tel:{{ $companyByTrends['phone'] ?? '' }}"><span class="flaticon-phone pr5"></span> {{ $companyByTrends['phone'] ?? '' }}</a></li>
                            <li class="list-inline-item"><a href="#"><span class="flaticon-pin pr5"></span>{{ $data['address'] ?? '' }}</a></li>
                        </ul>
                    </div>
                    <div class="fp_footer">
                        <ul class="fp_meta float-left mb0">
                            @if(!empty($companyByTrends['category']['image']))
                                <li class="list-inline-item">
                                    <a href="{{ route('site.companyDetails',['slug' => $companyByTrends['slug']]) }}">
                                        <img src="{{ asset("uploads/categories/".$companyByTrends['category']['image']) }}" alt="{{$companyByTrends['category']['title'][$currentLang] ?? ''}}" style="max-height: 28px;!important;">
                                    </a>
                                </li>
                            @endif
                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyByTrends['slug']]) }}">{{ $companyByTrends['category']['title'][$currentLang] ?? '' }}</a></li>
                        </ul>
                        <ul class="fp_meta float-right mb0">
                            <li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyByTrends['slug']]) }}"><span class="flaticon-zoom"></span></a></li>
                            @if(!empty(auth('user')->user()->id))
                                <li class="list-inline-item">
                                    <a href="javascript:void(0);" class="like-btn icon"
                                       data-item-id="{{ $companyByTrends['id'] }}"
                                       data-item-type="company"
                                       data-liked="{{ (!empty($companyByTrends['userLikes']['user_id']) && $companyByTrends['userLikes']['user_id'] == auth('user')->user()->id) ?? false }}">
                                        <span class="flaticon-love {{ (!empty($companyByTrends['userLikes']['user_id']) && $companyByTrends['userLikes']['user_id'] == auth('user')->user()->id)? 'active' : '' }}"></span>
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
