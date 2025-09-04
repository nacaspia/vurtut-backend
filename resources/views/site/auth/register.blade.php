<div class="col-lg-12">
    <div class="sign_up_form">
        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="user-register-tab" data-toggle="pill" href="#user-register" role="tab" aria-controls="user-register" aria-selected="true">Müştəri</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="company-register-tab" data-toggle="pill" href="#company-register" role="tab" aria-controls="company-register" aria-selected="false">Biznes müəssisəsi</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="user-register" role="tabpanel" aria-labelledby="user-register-tab">
                <form id="userRegister" action="#">
                    <div class="text-danger text-center mt-2" id="generalUserRegisterError"></div>
                    <div class="text-success text-center mt-2" id="generalUserRegisterSuccess"></div>
                    <input type="hidden" id="type_user" name="type" value="user">
                    <div class="form-group input-group">
                        <input type="text" class="form-control" id="full_name_user" name="full_name" placeholder="Ad/Soyad">
                        <div class="invalid-feedback" id="fullNameUserError"></div>
                    </div>
                    <div class="form-group input-group">
                        <input type="email" class="form-control" id="email_user" name="email" placeholder="E-poçt ünvanı">
                        <div class="invalid-feedback" id="emailUserError"></div>
                    </div>
                    <div class="form-group input-group">
                        <input type="text" class="form-control" id="phone_user" name="phone" placeholder="Əlaqə nömrəsi">
                        <div class="invalid-feedback" id="phoneUserError"></div>
                    </div>
                    <div class="form-group input-group mb20">
                        <input type="password" class="form-control" id="password_user" name="password" placeholder="Şifrə">
                        <div class="invalid-feedback" id="passwordUserError"></div>
                    </div>
                    <button type="submit" id="userRegisterBtn" class="btn btn-log btn-block btn-thm">Qeydiyyat olun</button>
                   {{-- <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route('site.social.redirect', ['provider'=>'facebook','type'=>'user']) }}" class="btn btn-block btn-fb"><i class="fa fa-facebook float-left mt5"> Facebook ilə giriş edin</i></a>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('site.social.redirect', ['provider'=>'google','type'=>'user']) }}" class="btn btn-block btn-googl"><i class="fa fa-google float-left mt5"></i> Google ilə giriş edin</a>
                        </div>
                    </div>--}}
                </form>
            </div>
            <div class="tab-pane fade" id="company-register" role="tabpanel" aria-labelledby="company-register-tab">
                <form id="companyRegister" action="#">
                    <div class="text-danger text-center mt-2" id="generalCompanyRegisterError"></div>
                    <div class="text-success text-center mt-2" id="generalCompanyRegisterSuccess"></div>
                    <input type="hidden" id="type_company" name="type" value="company">
                    <div class="form-group input-group">
                        <input type="text" class="form-control" id="full_name_company" name="full_name" placeholder="Müəssisənizin adı">
                        <div class="invalid-feedback" id="fullNameCompanyError"></div>
                    </div>
                    <div class="form-group input-group">
                        <input type="email" class="form-control" id="email_company" name="email" placeholder="E-poçt ünvanı">
                        <div class="invalid-feedback" id="emailCompanyError"></div>
                    </div>
                    <div class="form-group input-group">
                        <input type="text" class="form-control" id="phone_company" name="phone" placeholder="Əlaqə nömrəsi">
                        <div class="invalid-feedback" id="phoneCompanyError"></div>
                    </div>
                    <div class="form-group input-group mb20">
                        <input type="password" class="form-control" id="password_company" name="password" placeholder="Şifrə">
                        <div class="invalid-feedback" id="passwordCompanyError"></div>
                    </div>
                    <button type="submit" id="companyRegisterBtn" class="btn btn-log btn-block btn-thm">Qeydiyyat olun</button>
                    {{--<hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route('site.social.redirect', ['provider'=>'facebook','type'=>'company']) }}" class="btn btn-block btn-fb"><i class="fa fa-facebook float-left mt5"> Facebook ilə giriş edin</i></a>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('site.social.redirect', ['provider'=>'google','type'=>'company']) }}" class="btn btn-block btn-googl"><i class="fa fa-google float-left mt5"></i> Google ilə giriş edin</a>
                        </div>
                    </div>--}}
                </form>
            </div>
        </div>
    </div>
</div>
