<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyCommit;
use App\Models\FcmToken;
use Illuminate\Http\Request;

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

        $request->validate([
            'token' => 'required|string'
        ]);
        $user_id = auth('user')->check() ? auth('user')->id() : null;
        $company_id = auth('company')->check() ? auth('company')->id() : null;

        if ($user_id == null && $company_id == null) {
            return response()->json(['success' => false, 'error' => 'Token is required'], 422);
        }

        // Əgər token artıq varsa, yenilə, yoxsa əlavə et
        FcmToken::updateOrCreate(['user_id' => $user_id,'company_id' => $company_id,'token' => $request->token]);
        return response()->json(['success' => true, 'message' => 'token saved successfully'], 200);
    }
}
