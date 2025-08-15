@if(!empty($companyPersons[0]))
    @foreach($companyPersons as $persons)
        {{--                    @dd($service[''])--}}
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="shop_grid">
                <div class="thumb">
                    <img class="img-fluid" src="{{ asset('uploads/company-persons/'.$persons['image']) }}" alt="1.png" style="max-height: 145px;!important;">
                </div>
                <div class="details">
                    <div class="price_content">
                        <h5 class="item-tile">{{$persons['name']}}</h5>
                    </div>
                    <button class="btn btn-block btn-thm viewProductDetail" data-toggle="modal" data-target="#productInfoModal" data-name="{{$persons['name']}}" data-description="{{$persons['text']}}" data-image="{{ asset('uploads/company-persons/'.$persons['image']) }}">
                        <span class="flaticon-view"></span> Ətraflı
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@endif
