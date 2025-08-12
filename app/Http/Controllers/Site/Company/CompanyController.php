<?php

namespace App\Http\Controllers\Site\Company;

use App\Helpers\LogsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ChangePasswordRequest;
use App\Http\Requests\Site\Company\SettingsRegisterRequest;
use App\Http\Requests\Site\Company\SettingsRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyCommit;
use App\Models\Country;
use App\Models\Log;
use App\Models\Reservation;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    protected $company;
    public function __construct()
    {
        $this->currentLang = 'az';
        $this->company = auth('company')->user();
    }

    public function index()
    {
        $company = $this->company;
        if ($company['category_id'] == null && $company['country_id'] == null && $company['city_id'] == null) {
            return self::settings();
        }
        $currentLang = $this->currentLang;
        $company = Company::with('category', 'comments','posts','companyReservation')->whereNotNull('image')->where(['id' => $this->company->id])->first();
        $companyCategories = [];
        if (!empty($company['catalogues'][0])) {
            $companyCategories = CompanyCategory::with('catalogies')->where(['company_id' => $company['id']])->get();
        }

        $serviceTypes = ServiceType::where(['status' => 1])->orderBy('name->' . $this->currentLang, 'ASC')->get();
        return view('site.company.home',compact('currentLang','company','companyCategories','serviceTypes'));
    }

    public function settings() {
        $currentLang = $this->currentLang;
        $company = Company::with('category','country','mainCities','subRegion')->find($this->company->id);
        $mainCompanies = Company::where(['status' => 1,'category_id' => $company['category_id']])->where('id','!=',$this->company->id)->whereNull('parent_id')->get();
        $categories = Category::where('status',1)->whereNull('parent_id')->get();
        $countries = Country::where('status',1)->get();
        $serviceTypes = ServiceType::where(['status' => 1])->orderBy('name->' . $this->currentLang, 'ASC')->get();
        return view('site.company.settings',compact('currentLang','company','mainCompanies','categories','countries','serviceTypes'));
    }

    public function announcements() {
        $currentLang = $this->currentLang;
        $logs = Log::where(['company_id' => $this->company->id])
            ->whereDate('created_at', Carbon::today())
            ->whereIn('subj_table',['company_commits','reservations'])
            ->whereIn('action',['reviewSend','reservationSend'])
            ->with(['objUser','company'])
            ->orderBy('created_at','DESC')->get();
        return view('site.company.announcements',compact('currentLang','logs'));
    }

    public function reservation()
    {
        $currentLang = $this->currentLang;
        $users = User::where(['status' => 1])
            ->whereHas('companyReservation', function ($q) {
                $q->where('company_id', $this->company->id);
            })
            ->with(['companyReservation' => function ($q) {
                $q->where('company_id', $this->company->id)
                    ->where('date', '>=', Carbon::now());
            }])->get();

        return view('site.company.reservation',compact('currentLang','users'));
    }

    public function statistics() {
        $company = Company::with('category', 'comments','posts','companyReservation')->find($this->company->id);
        return view('site.company.statistics',compact('company'));
    }

    public function logout()
    {
        auth('company')->logout(); // Logout the user
        \Session::forget('company_data');
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
        $company = $this->company;
        try {
            if (!empty($settingsRequest->parent_id) && $settingsRequest->parent_id != 01) {
                $companyId = Company::where(['id' => $settingsRequest->parent_id])->first();
                $parentId = $companyId->id;;
            }else {
                $parentId = $company->parent_id;
            }

            if (!empty($settingsRequest->category_id)) {
                $category = Category::where(['id' => $settingsRequest->category_id])->first();
                $categoryId = $category->id;;
            }else {
                $categoryId = $company->category_id;
            }

            if (!empty($settingsRequest->country_id)) {
                $country = Country::where(['id' => $settingsRequest->country_id])->first();
                $countryId = $country->id;;
            }else {
                $countryId = $company->country_id;
            }

            $subRegionId = null;
            if (!empty($settingsRequest->city_id)) {
                $city = City::where(['country_id' => $countryId, 'id' => $settingsRequest->city_id])->first();
                if (!empty($city->id) && !empty($city->sub_region_id)) {
                    $cityId = $city->sub_region_id;
                    $subRegionId = $city->id;
                }else{
                    $cityId = $city->sub_region_id;
                }
            }else {
                $cityId = $company->city_id;
                $subRegionId = $company->sub_region_id ?? null;
            }

            if($settingsRequest->hasFile('image')){
//                $image_name = time().'.'.$settingsRequest->image->extension();
                $image_name = $settingsRequest->image->getClientOriginalName();
                $image_url = $settingsRequest->image->move(public_path('uploads/company'), $image_name);
                $image = $image_url->getFilename();
            }else{
                $image_name = !empty($company->image)? $company->image: NULL;
            }

            $social = [
                'one_phone' => $settingsRequest->one_phone,
                'two_phone' => $settingsRequest->two_phone,
                'one_email' => $settingsRequest->one_email,
                'facebook' => $settingsRequest->facebook,
                'tiktok' => $settingsRequest->tiktok,
                'instagram' => $settingsRequest->instagram,
                'linkedin' => $settingsRequest->linkedin,
            ];
            Company::where('id',$company->id)->update([
                'parent_id' => $parentId ?? null,
                'type' => $parentId? 'branch': 'main',
                'category_id' => $categoryId,
                'country_id' => $countryId,
                'city_id' => $cityId,
                'sub_region_id' => $subRegionId,
                'full_name' => $settingsRequest->full_name,
                'slug' => Str::slug($settingsRequest->full_name),
                'text' => $settingsRequest->bio ?? '',
                'image' => $image_name,
                'social' => $social,
                'time' => $settingsRequest['hours'],
                'service_type' => $settingsRequest['services'],
            ]);
            $log = [
                'obj_id' => $company->id,
                'subj_id' => $company->id,
                'subj_table' => 'companies',
                'actions' => 'settingsUpdate',
                'type' => 'company',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' =>Lang::get('site.success_up')],200);
        } catch (\Exception $exception) {
            $log = [
                'obj_id' => $company->id,
                'subj_id' => $company->id,
                'subj_table' => 'companies',
                'actions' => 'settingsUpdate',
                'type' => 'company',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' =>  Lang::get('site.error_up')],422);
        }
    }
    public function settingsRegister($id,SettingsRegisterRequest $settingsRegisterRequest) {
        $valdate = Validator::make($settingsRegisterRequest->all(), $settingsRegisterRequest->rules(), $settingsRegisterRequest->messages());
        if ($valdate->fails()) {
            return response()->json(['success' => false, 'error' => $valdate->errors()],422);
        }

        $company =  $this->company;
        try {
            $data = [
                'address' => $settingsRegisterRequest->address,
                'lat' => $settingsRegisterRequest->latitude ?? null,
                'lng' => $settingsRegisterRequest->longitude ?? null,
            ];
            $company->data = $data;
            $company->email = $settingsRegisterRequest->email;
            $company->phone = $settingsRegisterRequest->phone;
            $company->save();
            $log = [
                'obj_id' => $company->id,
                'subj_id' => $company->id,
                'subj_table' => 'companies',
                'actions' => 'settingsRegister',
                'type' => 'company',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' => "Məlumat yeniləndi"],200);

        } catch (\Exception $exception) {
            $log = [
                'obj_id' => $company->id,
                'subj_id' => $company->id,
                'subj_table' => 'companies',
                'actions' => 'settingsRegister',
                'type' => 'company',
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
        $company =  $this->company;
        try {
            if (!Hash::check($changePasswordRequest->old_password, $company->password)) {
                return response()->json(['errors' => ['old_password' => ['Mövcud şifrə yanlışdır.']]], 422);
            }

            $company->password = Hash::make($changePasswordRequest->new_password);
            $company->save();
            $log = [
                'obj_id' => $company->id,
                'subj_id' => $company->id,
                'subj_table' => 'companies',
                'actions' => 'settingsPasswordUpdate',
                'type' => 'company',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' => "Şifrə yeniləndi"],200);

        } catch (\Exception $exception) {
            $log = [
                'obj_id' => $company->id,
                'subj_id' => $company->id,
                'subj_table' => 'companies',
                'actions' => 'settingsPasswordUpdate',
                'type' => 'company',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => Lang::get('site.error_up')],422);
        }
    }

    public function reservationUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_text' => 'required|string|max:1000',
        ],[
            'company_text.required' => Lang::get('site.company_text_required'),
            'company_text.max' => Lang::get('site.company_text_max'),
            'company_text.string' => Lang::get('site.company_text_string'),
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()],422);
        }

        $company =  $this->company;
        $reservationId = $request->reservation_id;
        $company_text = $request->company_text;

        try {
            $reservation = Reservation::where(['id' => $reservationId, 'company_id' => $company->id])->first();
            if (!$reservation) {
                return response()->json(['success' => false, 'errors' => "Məlumat tapılmadı yenidən yoxlanış edin!"],422);
            }

            $reservation->company_text = $company_text;
            $reservation->status = $request->status;
            $reservation->save();
            $log = [
                'user_id' => $reservation->user_id,
                'obj_id' => $company->id,
                'subj_id' => $reservationId,
                'subj_table' => 'reservations',
                'actions' => 'reservationUpdate',
                'type' => 'company',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' => "Məlumat uğurla yeniləndi!"],200);

        } catch (\Exception $exception) {
            $log = [
                'user_id' => $reservation->user_id ?? null,
                'obj_id' => $company->id,
                'subj_id' => $reservationId,
                'subj_table' => 'reservations',
                'actions' => 'reservationUpdate',
                'type' => 'company',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => Lang::get('site.error_up')],422);
        }
    }

    public function reviewSend(Request $request) {
        $request->validate([
            'reply' => 'required|string',
        ],[
            '*.required' => 'Bu xana vacibdir'
        ]);

        try {
            $mainCommit  = CompanyCommit::where(['id' => $request->comment_id])->whereNull('committer_id')->first();
            if (empty($mainCommit)) {
                return response()->json(['success' => false, 'message' =>Lang::get('site.error_up')],422);
            }
            $companyCommit = new CompanyCommit();
            $companyCommit->user_id = $mainCommit->user_id;
            $companyCommit->company_id = $this->company->id;
            $companyCommit->committer_id = $mainCommit->id;
            $companyCommit->cleanliness = 0;
            $companyCommit->comfort =  0;
            $companyCommit->staf =  0;
            $companyCommit->facilities = 0;
            $companyCommit->comment = $request->reply;
            $companyCommit->save();

            $log = [
                'user_id' => $companyCommit->user_id ?? null,
                'obj_id' => $this->company->id,
                'subj_id' => $companyCommit->id,
                'subj_table' => 'company_commits',
                'actions' => 'reviewReply',
                'type' => 'company',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' =>Lang::get('site.success_up')],200);

        } catch (\Exception $exception) {
            $log = [
                'user_id' => $request->user_id ?? null,
                'obj_id' => $this->company->id,
                'subj_id' => $request->company_id ?? null,
                'subj_table' => 'company_commits',
                'actions' => 'reviewReply',
                'type' => 'company',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => $exception->getMessage() /*Lang::get('site.error_up')*/],422);
        }

    }
}
