<?php

namespace App\Http\Controllers\Site\User;

use App\Events\ReservationCreated;
use App\Helpers\LogsHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Requests\Site\ChangePasswordRequest;
use App\Http\Requests\Site\User\SettingsRequest;
use App\Models\City;
use App\Models\CompanyCommit;
use App\Models\Country;
use App\Models\FcmToken;
use App\Models\Log;
use App\Models\Reservation;
use App\Models\User;
use App\Models\UserLike;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class UserController extends Controller
{
    protected $user;
    protected $currentLang;
    public function __construct()
    {
        $this->currentLang = Lang::getLocale();
        $this->user = auth('user')->user();
    }

    public function index()
    {
        $currentLang = $this->currentLang;
        $user = User::where(['id' => $this->user->id])->with('userLikes')->first();
        if ($user['country_id'] == null && $user['city_id'] == null) {
            return self::settings();
        }
        return view('site.user.home', compact('currentLang','user'));
    }

    public function settings()
    {
        $user =  $this->user;
        $currentLang = $this->currentLang;
        $countries = Country::where('status',1)->whereNotNull('name->'.$this->currentLang)->orderBy('name->'.$this->currentLang,'ASC')->get();
        return view('site.user.settings',compact('user','currentLang','countries'));
    }

    public function announcements()
    {
        $logs = Log::where(['user_id' => $this->user->id])
            ->whereDate('created_at', Carbon::today())
            ->whereIn('subj_table',['company_commits','reservations'])
            ->whereIn('action',['reviewReply','reservationUpdate'])
            ->with(['objCompany','user'])
            ->orderBy('created_at','DESC')->get();
        return view('site.user.announcements',compact('logs'));
    }

    public function favorites()
    {
        $currentLang = $this->currentLang;
        /*$likeCompanies = Company::select([
            'companies.*',
            'user_likes.user_id AS user_id',
            'user_likes.item_id AS company_id',
        ])->join('user_likes','user_likes.item_id','=','companies.id')->
        where(['user_likes.user_id'=>$this->user->id, 'user_likes.item_type' => 'company', 'companies.status'=>1])->
        orderBy('user_likes.id','DESC')->get();*/
        $likeCompanies = User::where(['id' => $this->user->id])->with('userLikes')->first();
        return view('site.user.favorites',compact('currentLang','likeCompanies'));
    }

    public function review()
    {
        return view('site.user.review');
    }

    public function reservation()
    {
        $currentLang = $this->currentLang;
        $companies = Company::where(['status' => 1])
            ->whereHas('userReservation', function ($q) {
                $q->where('user_id', $this->user->id);
            })
            ->with(['userReservation' => function ($q) {
                $q->where('user_id', $this->user->id);
            }])->get();

        return view('site.user.reservation',compact('currentLang','companies'));
    }

    public function logout()
    {
        auth('user')->logout(); // Logout the user
        \Session::forget('user_data');
        return redirect()->route('site.index')->with('success', __('site.success_logout'));
    }

    //ajax
    public function cities(Request $request) {
        if ($request->ajax() && $request->country_id != null) {
            $currentLang = $this->currentLang;
            $cities = City::where(['country_id' => $request->country_id ,'status' => 1])->whereNull('sub_region_id')->whereNotNull('name->'.$this->currentLang)->with('subRegions')->orderBy('name->'.$this->currentLang,'ASC')->get();
            if (!empty($cities)) {
                return ['success' => true, 'cities' => $cities, 'currentLang' => $currentLang];
            } else {
                return ['success' => false, 'cities' => [], 'currentLang' => $currentLang];
            }
        }
        return ['success' => false, 'cities' => [], 'currentLang' => ''];
    }

    public function settingsUpdate($id,SettingsRequest $settingsRequest) {
        $valdate = Validator::make($settingsRequest->all(), $settingsRequest->rules(), $settingsRequest->messages());
        if ($valdate->fails()) {
            return response()->json(['success' => false, 'error' => $valdate->errors()],422);
        }
        try {
            $user =  $this->user;
            if (!empty($settingsRequest->country_id)) {
                $country = Country::where(['id' => $settingsRequest->country_id])->first();
                $countryId = $country->id;;
            }else {
                $countryId = $user->country_id;
            }

            $subRegionId = null;
            if (!empty($settingsRequest->city_id)) {
                $city = City::where(['country_id' => $countryId, 'id' => $settingsRequest->city_id])->first();
                if (!empty($city->id) && !empty($city->sub_region_id)) {
                    $cityId = $city->sub_region_id;
                    $subRegionId = $city->id;
                }else{
                    $cityId = $city->id;
                }
            }else {
                $cityId = $user->city_id;
                $subRegionId = $user->sub_region_id ?? null;
            }
//            dd($settingsRequest->hasFile('image'));
            if($settingsRequest->hasFile('image')){
//                $image_name = time().'.'.$settingsRequest->image->extension();
                $image_name = $settingsRequest->image->getClientOriginalName();
                $image_url = $settingsRequest->image->move(public_path('uploads/user'), $image_name);
                $image = $image_url->getFilename();
            }else{
                $image_name = !empty($user->image)? $user->image: NULL;
            }

            $data = [
            /*    'gender' => !empty($settingsRequest->gender)? $settingsRequest->gender: null,
                'address' => !empty($settingsRequest->address)? $settingsRequest->address: null
            */];
            $up = User::where('id',$user->id)->update([
                'country_id' => $countryId,
                'city_id' => $cityId,
                'sub_region_id' => $subRegionId,
                'full_name' => $settingsRequest->full_name,
                'email' => $settingsRequest->email,
                'phone' => $settingsRequest->phone,
                'bio' => $settingsRequest->bio ?? '',
                'image' => $image_name,
                'data' => $data
            ]);
            if (!empty($up)){
                $log = [
                    'obj_id' => $user->id,
                    'subj_id' => $user->id,
                    'subj_table' => 'users',
                    'actions' => 'settingsUpdate',
                    'type' => 'user',
                    'note' => Lang::get('site.success_up')
                ];
                LogsHelper::convert($log);
                return response()->json(['success' => true, 'message' =>Lang::get('site.success_up')],200);
            } else {
                $log = [
                    'obj_id' => $user->id,
                    'subj_id' => $user->id,
                    'subj_table' => 'users',
                    'actions' => 'settingsUpdate',
                    'type' => 'user',
                    'note' => Lang::get('site.error_up')
                ];
                LogsHelper::convert($log);
                return response()->json(['success' => false, 'message' => Lang::get('site.error_up')],422);
            }
        } catch (\Exception $exception) {
            $log = [
                'obj_id' => $user->id,
                'subj_id' => $user->id,
                'subj_table' => 'users',
                'actions' => 'settingsUpdate',
                'type' => 'user',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => Lang::get('site.error_up')],422);
        }
    }
    public function settingsPasswordUpdate($id,ChangePasswordRequest $changePasswordRequest) {
        $valdate = Validator::make($changePasswordRequest->all(), $changePasswordRequest->rules(), $changePasswordRequest->messages());
        if ($valdate->fails()) {
            return response()->json(['success' => false, 'error' => $valdate->errors()],422);
        }
        try {
            $user =  $this->user;
            if (!Hash::check($changePasswordRequest->old_password, $user->password)) {
                return response()->json(['errors' => ['old_password' => ['Mövcud şifrə yanlışdır.']]], 422);
            }

            $user->password = Hash::make($changePasswordRequest->new_password);
            $user->save();
            $log = [
                'obj_id' => $user->id,
                'subj_id' => $user->id,
                'subj_table' => 'users',
                'actions' => 'settingsPasswordUpdate',
                'type' => 'user',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' => "Şifrə yeniləndi"],200);

        } catch (\Exception $exception) {
            $log = [
                'obj_id' => $user->id,
                'subj_id' => $user->id,
                'subj_table' => 'users',
                'actions' => 'settingsPasswordUpdate',
                'type' => 'user',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => Lang::get('site.error_up')],422);
        }
    }

    public function like(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|string',
        ]);

        $like = UserLike::firstOrCreate([
            'user_id' => auth('user')->user()->id,
            'item_id' => $request->item_id,
            'item_type' => $request->item_type,
        ]);

        return response()->json(['success' => true, 'message' => 'Liked successfully!']);
    }

    public function unlike(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer',
            'item_type' => 'required|string',
        ]);

        UserLike::where(['user_id' => auth('user')->user()->id, 'item_id' => $request->item_id, 'item_type' => $request->item_type,])->delete();

        return response()->json(['success' => true, 'message' => 'Unliked successfully!']);
    }

    public function reservationSend(Request $request) {
        $request->validate([
            'date' => 'required|date',
            'full_name' => 'required|string',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
//            'place_count' => 'required|integer',
            'person_count' => 'required|integer',
            'text' => 'required|string|max:65535',
        ],[
            '*.required' => 'Bu xana vacibdir'
        ]);

        try {
            // Məsələn: User modeli
            $userTimezone = $this->user->timezone ?? config('app.timezone');

            $reservation = new Reservation();
            $reservation->company_id = $request->company_id;
            $reservation->user_id = $this->user->id;
            $reservation->date = $request->date;
            $reservation->full_name = $request->full_name;
            $reservation->phone = $request->phone;
            $reservation->place_count = $request->place_count ?? 0;
            $reservation->person_count = $request->person_count;
            $reservation->text = $request->text;
            $reservation->created_at = date('Y-m-d H:i:s',strtotime($userTimezone));;
            $reservation->save();

            $token = FcmToken::where(['company_id' => $reservation->company_id])->orderBy('id','DESC')->first();

            // Firebase Messaging instance
//            try {
                if (!empty($token)) {
                    // Firebase obyekti yaradılır
                    $factory = (new Factory)
                        ->withServiceAccount('/var/www/vurtut-backend/config/firebase_credentials.json')
                        ->withDatabaseUri('https://vurtut-default-rtdb.firebaseio.com');

                    $messaging = $factory->createMessaging(); // <-- createMessaging istifadə olunur

                    // Mesaj hazırla
                    $message = CloudMessage::withTarget('token', $token['token'])
                        ->withNotification(
                            Notification::create(
                                'Yeni rezervasiya',
                                "{$reservation->full_name} rezervasiya etdi."
                            )
                        );

                    // Mesajı göndər
                    $result = $messaging->send($message);
                }

            /*} catch (\Kreait\Firebase\Exception\MessagingException $e) {
                return response()->json([
                    'success' => false,
                    'error' => 'Firebase Messaging xətası: '.$e->getMessage(),
                ], 500);

            } catch (\Kreait\Firebase\Exception\FirebaseException $e) {
                return response()->json([
                    'success' => false,
                    'error' => 'Firebase ümumi xətası: '.$e->getMessage(),
                ], 500);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'error' => 'Server xətası: '.$e->getMessage(),
                ], 500);
            }*/

            $log = [
                'obj_id' => $this->user->id,
                'company_id' => $request->company_id,
                'subj_id' => $reservation->id,
                'subj_table' => 'reservations',
                'actions' => 'reservationSend',
                'type' => 'user',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' => 'Resarvasiya qeydə alındı.'],200);

        } catch (\Exception $exception) {
            $log = [
                'obj_id' => $this->user->id,
                'company_id' => $request->company_id,
                'subj_id' => null,
                'subj_table' => 'reservations',
                'actions' => 'reservationSend',
                'type' => 'user',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => Lang::get('site.error_up')],422);
        }

    }

    public function reviewSend(Request $request) {
        $request->validate([
            'commit' => 'required|string',
        ],[
            '*.required' => 'Bu xana vacibdir'
        ]);

        try {
            // Məsələn: User modeli
            $userTimezone = $this->user->timezone ?? config('app.timezone');
            $companyCommit = new CompanyCommit();
            $companyCommit->company_id = $request->company_id;
            $companyCommit->user_id = $this->user->id;
            $companyCommit->cleanliness = $request->cleanliness ?? 0;
            $companyCommit->comfort = $request->comfort ?? 0;
            $companyCommit->staf = $request->staff ?? 0;
            $companyCommit->facilities = $request->facilities ?? 0;
            $companyCommit->comment = $request->commit;
            $companyCommit->created_at = date('Y-m-d H:i:s',strtotime($userTimezone));
            $companyCommit->save();

            $log = [
                'obj_id' => $this->user->id,
                'company_id' => $request->company_id,
                'subj_id' => $companyCommit->id,
                'subj_table' => 'company_commits',
                'actions' => 'reviewSend',
                'type' => 'user',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' =>Lang::get('site.success_up')],200);

        } catch (\Exception $exception) {
            $log = [
                'obj_id' => $this->user->id,
                'company_id' => $request->company_id ?? null,
                'subj_id' => $request->company_id ?? null,
                'subj_table' => 'company_commits',
                'actions' => 'reviewSend',
                'type' => 'user',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => Lang::get('site.error_up')],422);
        }

    }
}
