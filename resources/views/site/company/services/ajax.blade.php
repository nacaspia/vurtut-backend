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
                    <button class="btn btn-block btn-thm viewProductDetail" data-toggle="modal" data-target="#productInfoModal{{$service['id']}}">
                        <span class="flaticon-view"></span> Ətraflı
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade sign_up_modal bd-example-modal-lg" id="productInfoModal{{$service['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 500px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <img src="{{ asset('uploads/company-services/'.$service['image']) }}" alt="Şəkli" class="img-fluid rounded mt-2" style="max-height: 150px;!important;">
                                @if(!empty($service['person']))
                                <img src="{{ asset('uploads/company-persons/'.$service['person']['image']) }}" alt="Şəkli" class="img-fluid rounded mt-2" style="max-height: 150px;!important;">
                                @endif
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <p><strong>Kateqoriya:</strong> <span>{{$service['subCategory']['title'][$currentLang]}}</span></p>
                                <p><strong>Xidmətin Adı:</strong> <span>{{$service['title']}}</span></p>
                                <p><strong>Qiymət:</strong> <span>{{$service['price']}}</span></p>
                                <p><strong>Xidmətin Təsvir:</strong> <br><span>{{$service['description']}}</span></p>
                                @if(!empty($service['person']) && !empty($company['category']) && $company['category']['is_persons'] ==true)
                                    <p><strong>Ustanın Adı:</strong> <span id="infoPerson">{{$service['person']['name'] ?? null}}</span></p>
                                    <p><strong>Ustanın Yaşı:</strong> <span id="infoPersonAge">{{$service['person']['age'] ?? null}}</span></p>
                                    <p><strong>Ustanın Təcrübəsi:</strong> <span id="infoPersonExperience">{{$service['person']['experience'] ?? null}}</span></p>
                                    <p><strong>Ətraflı məlumat:</strong> <span id="infoPersonDescription">{{$service['person']['text'] ?? null}}</span></p>
                                @endif
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#productDeleteModal{{$service['id']}}">
                                    Sil
                                </button>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#productEditModal{{$service['id']}}" style="border-radius:12px;">
                                    Düzənlə
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade sign_up_modal bd-example-modal-lg" id="productEditModal{{$service['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 450px; width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  id="productEditForm{{$service['id']}}" enctype="multipart/form-data">
                            <input type="hidden" id="editId{{$service['id']}}" value="{{$service['id']}}">
                            <input type="hidden" id="edit_category_id" name="edit_category_id" value="{{ $subCompaniesCategory[0]['sub_category_id'] }}">
                            <div class="form-group">
                                <label for="sub_category_id">Kateqoriyalar</label>
                                <select class="form-control" id="edit_sub_category_id" name="edit_sub_category_id">
                                    <option value="">Kateqoriya seçin</option>
                                    @if(!empty($subCompaniesCategory[0]))
                                        @foreach($subCompaniesCategory as $subCategory)
                                            <option value="{{$subCategory['id']}}" @if($subCategory['id'] == $service['sub_category_id']) selected @endif>{{ $subCategory['title'][$currentLang] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback" id="editsubCategoryError"></div>
                            </div>
                            @if(!empty($company['category']) && $company['category']['is_persons'] ==true)
                                <div class="form-group">
                                    <label for="edit_person_id">Ustalar</label>
                                    <select class="form-control" id="edit_person_id" name="edit_person_id">
                                        <option value="">Usta seçin</option>
                                        @if(!empty($companyPersons[0]))
                                            @foreach($companyPersons as $companyPerson)
                                                <option value="{{$companyPerson['id']}}" @if($companyPerson['id'] == $service['person_id']) selected @endif>{{ $companyPerson['name'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback" id="editPersonError"></div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="edit_product_name">Xidmətin Adı</label>
                                <input type="text" class="form-control" id="edit_product_name" name="edit_product_name" value="{{$service['title']}}">
                                <div class="invalid-feedback" id="editproductNameError"></div>
                            </div>

                            <div class="form-group">
                                <label for="edit_price">Qiymət (AZN)</label>
                                <input type="number" class="form-control" id="edit_price" name="edit_price" min="0" step="0.01" value="{{$service['price']}}">
                                <div class="invalid-feedback" id="editpriceError"></div>
                            </div>

                            <div class="form-group">
                                <label for="edit_image">Şəkil yüklə</label>
                                <input type="file" class="form-control" id="edit_image" name="edit_image" accept="image/*">
                                <div class="invalid-feedback" id="editimageError"></div>
                            </div>

                            <div class="form-group">
                                <label for="description">Xidmətin  Təsvir</label>
                                <textarea class="form-control" id="edit_description" name="edit_description" rows="3" placeholder="Ətraflı haqqında məlumat...">{{$service['description']}}</textarea>
                                <div class="invalid-feedback" id="editdescriptionError"></div>
                            </div>
                            <button type="submit" id="serviceEditButton" class="btn btn-success">Yadda saxla</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="productDeleteModal{{ $service['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md mt-5" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-exclamation-triangle text-danger"></i> Məlumatın silinməsi
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body text-center">
                        <p class="mb-3">Bu ustanı silmək istədiyinizə əminsiniz?</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Vaz keç
                        </button>
                        <form action="{{ route('site.company-services.destroy', $service['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Təsdiqlə
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
