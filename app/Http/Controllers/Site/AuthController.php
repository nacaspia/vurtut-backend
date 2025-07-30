<?php

namespace App\Http\Controllers\Site;
use App\Helpers\Company\Tokenizer;
use App\Helpers\LogsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;
use App\Notifications\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

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
            //şirkət yoxlanışı
            $companyEmail = Company::where('email',$registerRequest->email)->first();
            $companyPhone = Company::where('phone',$registerRequest->phone)->first();

            if ($type=='company'){
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

                $company = new Company();
//                $company->category_id = $registerRequest->category_id;
//                $company->parent_id = !empty($registerRequest->parent_id)??null;
//                $company->type = !empty($registerRequest->parent_id)? 'branch': 'main';
                $company->full_name = $registerRequest->full_name;
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
                        'subject' => "Qeydiyyat tamamlandı",
                        'url' => /*config('app.frontend_url').*/'vurtut.test/company/accept/'.$token_send.'/'.$company->id,
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
                if (!empty($companyEmail) || !empty($companyPhone)) {
                    $companyLog = [
                        'subj_id' => !empty($companyEmail)? $companyEmail->id: $companyPhone->id,
                        'subj_table' => 'companies',
                        'actions' => 'register',
                        'type' => 'company',
                        'note' => Lang::get('site.has_company_account')
                    ];
                    LogsHelper::convert($companyLog);
                    return response()->json(['success' => false, 'errors' => Lang::get('site.has_user_account')], 422);
                }
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
                        'subject' => "Qeydiyyat tamamlandı",
                        'url' => /*config('app.frontend_url').*/'vurtut.test/user/accept/'.$token_send.'/'.$user->id,
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
                if (!empty($user['country_id']) && !empty($user['city_id'])) {
                    $route = route('site.company.index');
                } else {
                    $route = route('site.company.settings');
                }
                return response()->json(['success' => true, 'message' =>Lang::get('site.success_login'), 'route' => $route],200);
            }elseif (!empty(auth('user')->attempt($loginState)) && auth('user')->user()->status ==1) {
                $user = auth('user')->user();
                if (!empty($user['country_id']) && !empty($user['city_id'])) {
                    $route = route('site.user.index');
                } else {
                    $route = route('site.user.settings');
                }
                return response()->json(['success' => true, 'message' =>Lang::get('site.success_login'), 'route' => $route],200);
            } else {
                return response()->json(['success' => false,'message' => Lang::get('site.error_login')],422);
            }
        }
    }
}
