@if(!empty($companyPersons[0]))
    @foreach($companyPersons as $persons)
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="shop_grid">
                <div class="thumb">
                    <img class="img-fluid" src="{{ asset('uploads/company-persons/'.$persons['image']) }}" alt="1.png" style="max-height: 145px;!important;">
                </div>
                <div class="details">
                    <div class="price_content">
                        <h5 class="item-tile">{{$persons['name']}}</h5>
                    </div>
                    <button class="btn btn-block btn-thm viewProductDetail" data-toggle="modal" data-target="#productInfoModal{{$persons['id']}}">
                        <span class="flaticon-view"></span> Ətraflı
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="productInfoModal{{$persons['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 500px;">
                <div class="modal-content">
                    <input type="hidden" id="selectedPersonId">
                    <div class="modal-header">
                        <h5 class="modal-title">Məlumat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <img src="{{ asset('uploads/company-persons/'.$persons['image']) }}" alt="Şəkli" class="img-fluid rounded mt-2" style="max-height: 150px;!important;">
                            </div>
                            <div class="col-lg-6 col-xl-6">
                                <p><strong>Ustanın Adı:</strong> <span id="infoName">{{$persons['name']}}</span></p>
                                <p><strong>Ustanın Yaşı:</strong> <span id="infoAge">{{$persons['age']}}</span></p>
                                <p><strong>Ustanın Təcrübəsi:</strong> <span id="infoExperience">{{$persons['experience']}}</span></p>
                                <p><strong>Ətraflı məlumat:</strong> <span id="infoDescription">{{$persons['text']}}</span></p>

                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#productDeleteModal{{$persons['id']}}">
                                    Sil
                                </button>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#productEditModal{{$persons['id']}}" style="border-radius:12px;">
                                    Düzənlə
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade sign_up_modal bd-example-modal-lg" id="productEditModal{{$persons['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 450px; width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Bağla">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="productEditForm{{$persons['id']}}" enctype="multipart/form-data">
                            <input type="hidden" id="editId{{$persons['id']}}" value="{{$persons['id']}}">
                            <div class="form-group">
                                <label for="editName{{$persons['id']}}">Ustanın Adı</label>
                                <input type="text" class="form-control" id="editName{{$persons['id']}}" name="name" value="{{$persons['name']}}">
                                <div class="invalid-feedback" id="nameEditError{{$persons['id']}}"></div>
                            </div>
                            <div class="form-group">
                                <label for="editImage{{$persons['id']}}">Ustanın şəkili</label>
                                <input type="file" class="form-control" id="editImage{{$persons['id']}}" name="image" accept="image/*" value="{{$persons['image']}}">
                                <div class="invalid-feedback" id="imageEditError{{$persons['id']}}"></div>
                            </div>
                            <div class="form-group">
                                <label for="editAge{{$persons['id']}}">Ustanın yaşı</label>
                                <input type="text" class="form-control" id="editAge{{$persons['id']}}" name="age" value="{{$persons['age']}}">
                                <div class="invalid-feedback" id="ageEditError{{$persons['id']}}"></div>
                            </div>
                            <div class="form-group">
                                <label for="editExperience{{$persons['id']}}">Ustanın təcrübəsi</label>
                                <input type="text" class="form-control" id="editExperience{{$persons['id']}}" name="experience" value="{{$persons['experience']}}">
                                <div class="invalid-feedback" id="experienceEditError{{$persons['id']}}"></div>
                            </div>
                            <div class="form-group">
                                <label for="editDescription{{$persons['id']}}">Ətraflı məlumat</label>
                                <textarea class="form-control" id="editDescription{{$persons['id']}}" name="description" rows="3">{{$persons['text']}}</textarea>
                                <div class="invalid-feedback" id="descriptionEditError{{$persons['id']}}"></div>
                            </div>
                            <button type="submit" id="serviceEditButton{{$persons['id']}}" class="btn btn-success">Yadda saxla</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="productDeleteModal{{ $persons['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <form action="{{ route('site.company-persons.destroy', $persons['id']) }}" method="POST" style="display:inline;">
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
