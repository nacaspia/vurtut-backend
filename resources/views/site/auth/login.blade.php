<div class="col-lg-12">
    <div class="login_form">
        <form  id="loginForm" action="#">
            <div class="input-group mb-2 mr-sm-2">
                <input type="text" class="form-control" id="email" name="email" placeholder="İstifadəçi adı / E-mail">
                <div class="invalid-feedback" id="emailError"></div>
            </div>
            <div class="input-group form-group mb5">
                <input type="password" class="form-control" id="password" name="password" id="exampleInputPassword1" placeholder="Şifrə">
                <div class="invalid-feedback" id="passwordError"></div>
            </div>
            <div class="form-group custom-control custom-checkbox">
                {{--<input type="checkbox" class="custom-control-input" id="exampleCheck1">
                <label class="custom-control-label" for="exampleCheck1">Şifrəyi xatırla</label>--}}
{{--                <a class="btn-fpswd float-right" href="page-my-logout.html">Şifrənizi unutmusunuz?</a>--}}
            </div>
            <button type="submit" class="btn btn-log btn-block btn-thm">Giriş edin</button>
            <div class="text-danger text-center mt-2" id="generalError"></div>
            {{--<hr>
            <div class="row mt30">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-fb btn-block"><i class="fa fa-facebook float-left mt5"></i> Facebook ilə giriş edin</button>
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-googl btn-block"><i class="fa fa-google float-left mt5"></i> Google ilə giriş edin</button>
                </div>
            </div>--}}
        </form>
    </div>
</div>
