<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyCommit;
use App\Models\FcmToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller {
    public function parentCategories(Request $request) {
        $category_id = $request->category_id;
        $parentCategories = Category::where('parent_id',$category_id)->where('status',1)->whereNotNull('parent_id')->get();
        if (!empty($parentCategories[0])){
            return response()->json(['success' => true, 'parentCategories' => $parentCategories],200);
        }else{
            return response()->json(['success' => false, 'parentCategories' => null],422);
        }
    }

    public function mainCities(Request $request) {
        $country_id = $request->country_id;
        $mainCities = City::where('country_id',$country_id)->whereNull('sub_region_id')->where('status',1)->get();
        if (!empty($mainCities[0])){
            return response()->json(['success' => true, 'mainCities' => $mainCities],200);
        }else{
            return response()->json(['success' => false, 'mainCities' => null],422);
        }
    }

    public function parentCities(Request $request) {
        $city_id = $request->city_id;
        $parentCities = City::where('sub_region_id',$city_id)->whereNotNull('sub_region_id')->where('status',1)->get();
        if (!empty($parentCities[0])){
            return response()->json(['success' => true, 'parentCities' => $parentCities],200);
        }else{
            return response()->json(['success' => false, 'parentCities' => null],422);
        }
    }
    public function companyShare(Request $request) {
        $company = Company::find($request->company_id);
        if ($company) {
            $company->increment('share');
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Not found'], 404);
    }

    public function mapAjax() {
        $mainCategory = Category::with('mapCompanies')->whereNull(['parent_id'])->where(['status' => 1])->get();
        return response()->json($mainCategory);
    }

    public function saveToken(Request $request) {
        $valdate = Validator::make([
            'token' => $request->token,
            'userId' => $request->userId,
            'type' => $request->type
        ], [
            'token' => 'required|string|unique:fcm_tokens,token',
            'userId' => 'required|integer',
            'type' => 'required|string'
        ], [
            '*.required' => Lang::get('site.required'),
        ]);

        if ($valdate->fails())
        {
            return response()->json(['success' => false,'errors' => $valdate->errors()], 422);
        }

        $user_id = null;
        $company_id = null;
        if ($request->type == 'company') {
            $company = Company::where(['id' => $request->userId])->first();
            if (empty($company)) {
                return response()->json(['success' => false, 'error' => "User can't login"], 422);
            }
            $company_id = $company->id;
        }elseif ($request->type == 'user') {
            $user = User::where(['id' => $request->userId])->first();

            if (empty($user)) {
                return response()->json(['success' => false, 'error' => "User can't login"], 422);
            }
            $user_id = $user->id;
        }

        if ($user_id == null && $company_id == null) {
            return response()->json(['success' => false, 'error' => "User can't login"], 422);
        }

        // Əgər token artıq varsa, yenilə, yoxsa əlavə et
        FcmToken::updateOrCreate(['user_id' => $user_id,'company_id' => $company_id,'token' => $request->token]);
        return response()->json(['success' => true, 'message' => 'token saved successfully'], 200);
    }
}
