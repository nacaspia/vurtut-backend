<?php

namespace App\Http\Controllers\Site;
use App\Helpers\Company\Tokenizer;
use App\Helpers\LogsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ChangePasswordRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyToken;
use App\Models\User;
use App\Models\UserToken;
use App\Notifications\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register()
    {
        if (!empty(auth('company')->user()->id)){
            return redirect(route('site.company.index'));
        }
        $categories = Category::whereNull('parent_id')->where('status',1)->get();
        $companies = Company::where(['status' => 1,'parent_id' => 0])->get();
        return view('site.auth.register',compact('categories','companies'));
    }

    public function registerAccept(RegisterRequest $registerRequest)
    {
        $valdate = Validator::make($registerRequest->all(), $registerRequest->rules(), $registerRequest->messages());
        if ($valdate->fails()) {
            return response()->json(['success' => false,'errors' => $valdate->errors()], 422);
        }

        try {
            $type = $registerRequest->type;
            if (!in_array($type,['user','company'])) {
                return response()->json(['success' => false,'errors' => 'Seçim səhfdir.'], 422);
            }

            //istifadəçi yoxlanışı
            $userEmail = User::where('email',$registerRequest->email)->first();
            $userPhone = User::where('phone',$registerRequest->phone)->first();
            if (!empty($userEmail) || !empty($userPhone)) {
                $companyLog = [
                    'obj_id' => !empty($userEmail) ? $userEmail->id : $userPhone->id,
                    'subj_id' => !empty($userEmail) ? $userEmail->id : $userPhone->id,
                    'subj_table' => 'users',
                    'actions' => 'register',
                    'type' => 'users',
                    'note' => Lang::get('site.has_user_account')
                ];
                LogsHelper::convert($companyLog);
                return response()->json(['success' => false, 'errors' => Lang::get('site.has_user_account')], 422);
            }

            //şirkət yoxlanışı
            $companyEmail = Company::where('email',$registerRequest->email)->first();
            $companyPhone = Company::where('phone',$registerRequest->phone)->first();
            if (!empty($companyEmail) || !empty($companyPhone)) {
                $companyLog = [
                    'subj_id' => !empty($companyEmail)? $companyEmail->id: $companyPhone->id,
                    'subj_table' => 'companies',
                    'actions' => 'register',
                    'type' => 'company',
                    'note' => Lang::get('site.has_company_account')
                ];
                LogsHelper::convert($companyLog);
                return response()->json(['success' => false, 'errors' => Lang::get('site.has_company_account')], 422);
            }

            if ($type=='company'){


                $company = new Company();
                $company->category_id = null;
                $company->full_name = $registerRequest->full_name;
                $company->slug = Str::slug($registerRequest->slug);
                $company->phone = $registerRequest->phone;
                $company->email = $registerRequest->email;
                $company->password = Hash::make($registerRequest->password);
                $company->status = 0;
                $company->save();

                if (!empty($company)){
                    $token = new Tokenizer();
                    $token_send = $token->run($company->id, $registerRequest->header('client'));
                    $mail_data = [
                        'id' => $company->id,
                        'full_name' => $company->full_name,
                        'phone' => $company->phone,
                        'email' => $company->email,
                        'password' => $registerRequest->password,
                        'subject' => "Qeydiyyat tamamlandı",
                        'url' => 'https://vurtut.com/company/accept/'.$token_send.'/'.$company->id,
                        'dedicated'=>'register'
                    ];
                    Notification::route('mail', $mail_data['email'])->notify(new Mail($mail_data));
                    $companyLog = [
                        'obj_id' => $company->id,
                        'subj_id' => $company->id,
                        'subj_table' => 'company',
                        'actions' => 'register',
                        'type' => 'company',
                        'note' =>  $company->full_name.' - '.Lang::get('site.has_register_email'),
                    ];
                    LogsHelper::convert($companyLog);
                    return response()->json(['success' => true,'message' =>  Lang::get('site.has_register_email')], 200);
                }
            }elseif ($type=='user'){

                $user = new User();
                $user->bio = '';
                $user->full_name = $registerRequest->full_name;
                $user->phone = $registerRequest->phone;
                $user->email = $registerRequest->email;
                $user->password = Hash::make($registerRequest->password);
                $user->status = 0;
                $user->save();

                if (!empty($user)){
                    $token = new \App\Helpers\User\Tokenizer();
                    $token_send = $token->run($user->id, $registerRequest->header('client'));
                    $mail_data = [
                        'id' => $user->id,
                        'full_name' => $user->full_name,
                        'phone' => $user->phone,
                        'email' => $user->email,
                        'password' => $registerRequest->password,
                        'subject' => "Qeydiyyat tamamlandı",
                        'url' => 'https://vurtut.com/user/accept/'.$token_send.'/'.$user->id,
                        'dedicated'=>'register'
                    ];
                    Notification::route('mail', $mail_data['email'])->notify(new Mail($mail_data));
                    $log = [
                        'obj_id' => $user->id,
                        'subj_id' => $user->id,
                        'subj_table' => 'users',
                        'actions' => 'register',
                        'type' => 'users',
                        'note' =>  $user->full_name.' - '.Lang::get('site.has_register_email'),
                    ];
                    LogsHelper::convert($log);
                    return response()->json(['success' => true,'message' =>  Lang::get('site.has_register_email')], 200);
                }

            }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'errors' => 'Xətta baş verdi. Biraz sonra yoxlayın.'], 422);
        }
    }

    public function userAccept($token,$id){
        $user = User::select(['users.*', 'ut.user_id','ut.token'])->
        join('user_tokens AS ut','ut.user_id','=','users.id')->
        where(['users.id' => $id,'users.status' => 0,'ut.token' => $token])->first();
        if (empty($user->id)) {
            $data = ['success' => false,'errors' => Lang::get('site.not_account')];
            return view('site.auth.status-accept',compact('data'));
        }

        $up = User::select(['users.*', 'ut.user_id','ut.token'])->
        join('user_tokens AS ut','ut.user_id','=','users.id')->
        where(['users.id' => $id,'users.status' => 0,'ut.token' => $token])->
        update(['status' => 1]);

        if (!empty($up)) {
            $log = [
                'obj_id' => $user->id,
                'subj_id' => $user->id,
                'subj_table' => 'users',
                'actions' => 'userAccept',
                'type' => 'users',
                'note' =>  $user->full_name.' - '.Lang::get('site.your_account_has_been_verified'),
            ];
            LogsHelper::convert($log);
            $data = ['success' => true,'message' =>  Lang::get('site.your_account_has_been_verified')];
            return view('site.auth.status-accept',compact('data'));
        } else {
            $log = [
                'obj_id' => $user->id,
                'subj_id' => $user->id,
                'subj_table' => 'users',
                'actions' => 'userAccept',
                'type' => 'users',
                'note' =>  $user->full_name.' - '.Lang::get('site.your_account_has_not_been_verified'),
            ];
            LogsHelper::convert($log);
            $data = ['success' => false,'errors' => Lang::get('site.your_account_has_not_been_verified')];
            return view('site.auth.status-accept',compact('data'));
        }
    }

    public function companyAccept($token,$id){
        $company = Company::select(['companies.*', 'ct.company_id','ct.token'])->
            join('company_tokens AS ct','ct.company_id','=','companies.id')->
            where(['companies.id' => $id,'companies.status' => 0,'ct.token' => $token])->first();

        if (empty($company->id)) {
            $data = ['success' => false,'errors' => Lang::get('site.not_account')];
            return view('site.auth.status-accept',compact('data'));
        }

        $up = Company::select(['companies.*', 'ct.company_id','ct.token'])->
        join('company_tokens AS ct','ct.company_id','=','companies.id')->
        where(['companies.id' => $id,'companies.status' => 0,'ct.token' => $token])->
        update(['status' => 1]);

        if (!empty($up)) {
            $log = [
                'obj_id' => $company->id,
                'subj_id' => $company->id,
                'subj_table' => 'companies',
                'actions' => 'companyAccept',
                'type' => 'company',
                'note' =>  $company->full_name.' - '.Lang::get('site.your_account_has_been_verified'),
            ];
            LogsHelper::convert($log);

            $data = ['success' => true,'message' => Lang::get('site.your_account_has_been_verified')];
            return view('site.auth.status-accept',compact('data'));
        } else {
            $log = [
                'obj_id' => $company->id,
                'subj_id' => $company->id,
                'subj_table' => 'companies',
                'actions' => 'companyAccept',
                'type' => 'company',
                'note' =>  $company->full_name.' - '.Lang::get('site.your_account_has_not_been_verified'),
            ];
            LogsHelper::convert($log);
            $data = ['success' => false,'errors' => Lang::get('site.your_account_has_not_been_verified')];
            return view('site.auth.status-accept',compact('data'));
        }

    }

    public function loginAccept(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $valdate = Validator::make([
            'email' => $email,
            'password' => $password
        ], [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            '*.required' => Lang::get('site.required'),
            'email.email' => Lang::get('site.email_format'),
            'password.min' => Lang::get('site.min_password')
        ]);

        if ($valdate->fails())
        {
            return response()->json(['success' => false,'errors' => $valdate->errors()], 422);
        }elseif ($valdate->passes()) {
            $loginState = [
                'email' => $email,
                'password' => $password,
                'status' => 1
            ];
            if (!empty(auth('company')->attempt($loginState)) && auth('company')->user()->status == 1) {
                $user = auth('company')->user();
                $userToken = CompanyToken::where(['company_id' => $user['id']])->orderBy('created_at', 'desc')->first();
                if (!empty($user['country_id']) && !empty($user['city_id'])) {
                    $route = route('site.company.index');
                } else {
                    $route = route('site.company.settings');
                }

                return response()->json(['success' => true, 'message' =>Lang::get('site.success_login'), 'token' => $userToken['token'], 'user_id' => $user['id'],'type' => 'company', 'route' => $route],200);
            }elseif (!empty(auth('user')->attempt($loginState)) && auth('user')->user()->status ==1) {
                $user = auth('user')->user();
                $userToken = UserToken::where(['user_id' => $user['id']])->orderBy('created_at', 'desc')->first();
                if (!empty($user['country_id']) && !empty($user['city_id'])) {
                    $route = route('site.user.index');
                } else {
                    $route = route('site.user.settings');
                }
                return response()->json(['success' => true, 'message' =>Lang::get('site.success_login'), 'token' => $userToken['token'], 'user_id' => $user['id'],'type' => 'user', 'route' => $route],200);
            } else {
                return response()->json(['success' => false,'message' => Lang::get('site.error_login')],422);
            }
        }
    }

    public function forgotStatus(Request $request)
    {
        $email = $request->email;
        $valdate = Validator::make([
            'email' => $email
        ], [
            'email' => 'required|email'
        ], [
            '*.required' => Lang::get('site.required'),
            'email.email' => Lang::get('site.email_format')
        ]);

        if ($valdate->fails())
        {
            return response()->json(['success' => false,'errors' => $valdate->errors()], 422);
        }elseif ($valdate->passes()) {
            //istifadəçi yoxlanışı
            $userEmail = User::where('email',$email)->first();
            //şirkət yoxlanışı
            $companyEmail = Company::where('email',$email)->first();
            if (empty($userEmail) && empty($companyEmail)) {
                return response()->json(['success' => false, 'errors' => 'Belə istifadəçi tapılmadı'], 422);
            }
            $id =$companyEmail->id ?? $userEmail->id;
            $mail_data = [
                'id' => $companyEmail->id ?? $userEmail->id,
                'full_name' => $companyEmail->full_name ?? $userEmail->full_name,
                'phone' => $companyEmail->phone ?? $userEmail->phone,
                'email' => $companyEmail->email ?? $userEmail->email,
                'subject' => "Şifrənizi yeniləyin",
                'url' => 'http://vurtut.test/forgot-password?id='.$id.'&email='.$email,
                'dedicated'=>'forgot-password'
            ];
            Notification::route('mail', $mail_data['email'])->notify(new Mail($mail_data));
            return response()->json(['success' => true, 'message' =>'Zəhmət olmasa şifrəni yeniləmək üçün e-poçtunuzu yoxlayın'],200);
        }
    }

    public function forgotPassword(Request $request) {
        $id = $request->id;
        $email = $request->email;

        //istifadəçi yoxlanışı
        $userEmail = User::where(['id' => $id, 'email' => $email])->first();
        //şirkət yoxlanışı
        $companyEmail = Company::where(['id' => $id, 'email' => $email])->first();

        if (empty($userEmail) && empty($companyEmail)) {
            return response()->json(['success' => false, 'errors' => 'Belə istifadəçi tapılmadı'], 422);
        }
        $data = $userEmail ?? $companyEmail;
        return view('site.auth.new-password',compact('data'));
    }

    public function forgotSetPassword(Request $changePasswordRequest) {
        $valdate = Validator::make($changePasswordRequest->all(), [
//            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'conf_new_password' => 'required_with:new_password|same:new_password|min:6',
        ], [
            '*.required' => Lang::get('site.required'),
        ]);
        if ($valdate->fails()) {
            return response()->json(['success' => false, 'error' => $valdate->errors()],422);
        }
        $id = $changePasswordRequest->id;
        $email = $changePasswordRequest->email;

        //istifadəçi yoxlanışı
        $userEmail = User::where(['id' => $id, 'email' => $email])->first();
        //şirkət yoxlanışı
        $companyEmail = Company::where(['id' => $id, 'email' => $email])->first();

        try {
            if (empty($userEmail) && empty($companyEmail)) {
                return response()->json(['success' => false, 'errors' => 'Belə istifadəçi tapılmadı'], 422);
            }

            $data = $userEmail ?? $companyEmail;
            $data->password = Hash::make($changePasswordRequest->new_password);
            $data->save();
            $log = [
                'obj_id' => $data->id,
                'subj_id' => $data->id,
                'subj_table' => $userEmail? 'users' : 'companies',
                'actions' => 'forgotSetPassword',
                'type' =>  $userEmail? 'users' : 'companies',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' => "Şifrə yeniləndi"],200);

        } catch (\Exception $exception) {
            $log = [
                'obj_id' => $data->id,
                'subj_id' => $data->id,
                'subj_table' => $userEmail? 'users' : 'companies',
                'actions' => 'forgotSetPassword',
                'type' =>  $userEmail? 'users' : 'companies',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => Lang::get('site.error_up')],422);
        }
    }

}
