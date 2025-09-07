@if(!empty($allCompaniesByTrends[0]))
    @foreach($allCompaniesByTrends as $companyCity)
        <div class="col-md-6 col-lg-6">
            <div class="feat_property"{{-- style="min-height: 404px;max-height: 404px;!important;"--}}>
                <div class="thumb">
                    <img class="img-whp" style="width: 100%; max-height: 164px; object-fit: contain; border-radius: 8px; background-color: #f9f9f9;!important;" src="{{ asset("uploads/company/".$companyCity['image']) }}" alt="{{ $companyCity['full_name'] }}">
                    <div class="thmb_cntnt">
                        <ul class="tag mb0">
                            @if($companyCity['is_premium'] == 1)<li class="list-inline-item"><a href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}"> PEMIUM </a></li>@endif
                        </ul>

                        @if(!empty($companyCity['comments']))
                            <ul class="listing_reviews">
                                <div class="list-inline-item sspd_review">
                                        <?php
                                        $comments = $companyCity['comments'];

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
                <div class="details">
                    <div class="tc_content">
                        <h4>
                            <a href="{{ route('site.companyDetails',['slug' => $companyCity['slug']]) }}">
                                {{ $companyCity['full_name'] }}
                            </a>
                        </h4>
                        <p>{{ \Illuminate\Support\Str::limit($companyCity['text'], 50, '...') }}</p>
                        @php
                            $data = $companyCity['data'];
                        @endphp
                        <ul class="prop_details mb0">
                            <li class="list-inline-item"><a href="tel:{{ $companyCity['social']['one_phone'] ?? null }}"><span class="flaticon-phone pr5"></span> {{ $companyCategory['social']['one_phone'] ?? null }}</a></li>
                            <li class="list-inline-item"><a><span class="flaticon-pin pr5"></span>{{ $data['address'] ?? null }}</a></li>
                        </ul>
                    </div>
                    <div class="fp_footer">
                        <ul class="fp_meta float-left mb0">
                            @if(!empty($companyCity['category']['image']))
                                <li class="list-inline-item">
                                    <a href="{{ route('site.category',['categorySlug' => $companyCity['category']['slug'][$currentLang]]) }}">
                                        <img src="{{ asset("uploads/categories/".$companyCity['category']['image']) }}" alt="{{$companyCity['category']['title'][$currentLang] ?? ''}}" style="max-height: 28px;!important;">
                                    </a>
                                </li>
                            @endif
                            <li class="list-inline-item"><a href="{{ route('site.category',['categorySlug' => $companyCity['category']['slug'][$currentLang]]) }}">{{$companyCity['category']['title'][$currentLang] ?? ''}}</a></li>
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
