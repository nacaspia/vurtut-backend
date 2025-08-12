<form action="{{ route('site.search') }}" method="GET">
    <div class="container small-container">
        <div class="header-search-input-wrap fl-wrap">
            <!-- header-search-input -->
            <div class="header-search-input">
                <label><i class="fal fa-keyboard"></i></label>
                <input type="text" placeholder="Axtarın" name="q" value="{{ !empty($_GET['q'])? $_GET['q']: null}}"/>
            </div>
            <!-- header-search-input end -->
            <!-- header-search-input -->
            <div class="header-search-input location autocomplete-container">
                <label><i class="fal fa-map-marker"></i></label>
                <input type="text" placeholder="Ünvana görə axtarış" name="address" class="autocomplete-input" id="autocompleteid2" value="{{ !empty($_GET['address'])? $_GET['address']: null}}"/>
                <a href="#"><i class="fal fa-dot-circle"></i></a>
            </div>
            <!-- header-search-input end -->
            <!-- header-search-input -->
            <div class="header-search-input header-search_selectinpt">
                <select data-placeholder="Kateqoriya" name="category_id" class="chosen-select no-radius">
                    <option value="">Bütün kateqoriya</option>
                    @if(!empty($categories[0]))
                        @foreach($categories as $category)
                            <option value="{{$category['id']}}" @if(!empty($_GET['category_id']) && (int)$_GET['category_id'] ==$category['id']) selected @endif>{{$category['title']['az']}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
           {{-- <div class="header-search-input header-search_selectinpt">
                <select data-placeholder="Kateqoriya" name="company_category_id" class="chosen-select no-radius">
                    <option value="">Bütün qiymətləndirmə</option>
                    <option value="">@lang('site.cleanliness')</option>
                    <option value="">@lang('site.comfort')</option>
                    <option value="">@lang('site.staf')</option>
                    <option value="">@lang('site.facilities')</option>
                </select>
            </div>--}}
            <!-- header-search-input end -->
            <button class="header-search-button green-bg" onclick="window.location.href='listing.html'"><i
                    class="far fa-search"></i> Axtar
            </button>
        </div>
        <div class="header-search_close color-bg"><i class="fal fa-long-arrow-up"></i></div>
    </div>
</form>
