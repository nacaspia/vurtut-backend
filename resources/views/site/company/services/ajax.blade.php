@if(!empty($companyServices[0]))
    @foreach($companyServices as $service)
        {{--                    @dd($service[''])--}}
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="shop_grid">
                <div class="thumb">
                    <img class="img-fluid" src="{{ asset('uploads/company-services/'.$service['image']) }}" alt="1.png" style="max-height: 145px;!important;">
                </div>
                <div class="details">
                    <div class="price_content">
                        <h5 class="item-tile">{{$service['title']}}</h5>
                        <p class="price">{{$service['price']}} AZN</p>
                    </div>
                    <button class="btn btn-block btn-thm viewProductDetail" data-toggle="modal" data-target="#productInfoModal" data-category="{{$service['subCategory']['title'][$currentLang]}}" data-person="{{$service['person']['name'] ?? null}}" data-age="{{$service['person']['age'] ?? ''}}" data-experience="{{$service['person']['experience'] ?? null}}" data-person-description="{{$service['person']['description'] ?? null}}" data-name="{{$service['title']}}" data-price="{{$service['price']}}" data-description="{{$service['description']}}" data-image="{{ asset('uploads/company-services/'.$service['image']) }}">
                        <span class="flaticon-view"></span> Ətraflı
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@endif
