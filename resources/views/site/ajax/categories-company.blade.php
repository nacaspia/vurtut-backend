@if(!empty($allCompaniesByCategory[0]))
    @foreach($allCompaniesByCategory as $companyCategory)
        <div class="col-md-6 col-lg-6">
            <div class="feat_property" style="height: 464px;">
                <div class="thumb">
                    <img class="img-whp" style="width: 100%; max-height: 163px; object-fit: cover; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$companyCategory['image']) }}" alt="{{ $companyCategory['full_name'] }}">
                    <div class="thmb_cntnt">
                        <ul class="tag mb0">
                            @if($companyCategory['is_premium'] == 1)<li class="list-inline-item" style="background: radial-gradient(47.12% 309% at 47.12% 40.18%, rgba(254, 255, 134, 0.7) 0%, rgba(251, 206, 61, 0.7) 50.48%, rgba(132, 77, 32, 0.7) 100%); border:none !important;"><a href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}" > Premium </a></li>@endif
{{--                            <li class="list-inline-item"><a href="#">Open</a></li>--}}
                        </ul>

                        @if(!empty($companyCategory['comments']))
                            <ul class="listing_reviews">
                                <div class="list-inline-item sspd_review">
                                        <?php
                                        $comments = $companyCategory['comments'];

                                        $avgCleanliness = round($comments->avg('cleanliness'), 1);
                                        $avgComfort = round($comments->avg('comfort'), 1);
                                        $avgStaff = round($comments->avg('staf'), 1);
                                        $avgFacilities = round($comments->avg('facilities'), 1);
                                        $overallAverage = round(collect([
                                            $avgCleanliness, $avgComfort, $avgStaff, $avgFacilities
                                        ])->filter()->avg(), 2);

                                        $reviewCount = $comments->count();
                                        ?>
                                    @php
                                        $categories = [
                                            'Təmizlik' => $avgCleanliness,
                                            'Heyət' => $avgStaff,
                                            'Rahatlıq' => $avgComfort,
                                            'İmkanlar' => $avgFacilities,
                                        ];

                                        // ümumi cəm
                                        $totalScore = array_sum($categories);

                                        // neçə kateqoriya varsa
                                        $count = count($categories);

                                        // orta qiymət
                                        $averageScore = $count > 0 ? $totalScore / $count : 0;
                                    @endphp

                                    <div class="rating-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star{{ $i <= round($averageScore) ? '' : '-o' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="details" style="display: flex; flex-direction: column; justify-content: space-between; gap: 20px;">
                    <div class="tc_content" style="height: 158px;">
                        <h4><a  href="{{ route('site.companyDetails',['slug' => $companyCategory['slug']]) }}">{{ $companyCategory['full_name'] }}</a></h4>
                        <p>{{ \Illuminate\Support\Str::limit($companyCategory['text'], 50, '...') }}</p>
                        @php
                            $data = $companyCategory['data'];
                        @endphp
                        <ul class="prop_details mb0" style="min-height: 60px; display: flex; flex-direction: column; ">
                            <li class="list-inline-item"><a href="tel:{{ $companyCategory['social']['one_phone'] ?? null }}"><span class="flaticon-phone pr5"></span> {{ $companyCategory['social']['one_phone'] ?? null }}</a></li>
                            <li class="list-inline-item"><a><span class="flaticon-pin pr5"></span>{{ $data['address'] ?? '' }}</a></li>
                        </ul>
                    </div>
                    <div class="fp_footer" style="width: 100%; display: flex; justify-content: space-between; ">
                        <ul class="fp_meta float-left mb0">
                            @if(!empty($companyCategory['category']['image']))
                                <li class="list-inline-item">
                                    <a href="{{ route('site.category',['categorySlug' => $companyCategory['category']['slug'][$currentLang]]) }}">
                                        <img src="{{ asset("uploads/categories/".$companyCategory['category']['image']) }}" alt="{{$companyCategory['category']['title'][$currentLang]}}" style="max-height: 28px;!important;">
                                    </a>
                                </li>
                            @endif
                            <li class="list-inline-item"><a href="{{ route('site.category',['categorySlug' => $companyCategory['category']['slug'][$currentLang]]) }}">{{ $companyCategory['category']['title'][$currentLang] ?? '' }}</a></li>
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
