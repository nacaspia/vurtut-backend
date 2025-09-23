<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyCatalog;
use App\Models\CompanyCategory;
use App\Models\Country;
use App\Models\ServiceType;
use App\Models\StaticPage;
use App\Models\User;
use App\Models\UserLike;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $currentLang;

    protected $companyId;
    public function __construct()
    {
        $this->currentLang = 'az';
    }

    public function index() {
        $currentLang = $this->currentLang;
        $categories = Category::
            whereNull(['parent_id'])->where(['status' => 1])
            ->orderBy('title->'.$this->currentLang,'ASC')->get();
        $mainCategories = Category::
            whereNull(['parent_id'])
            ->whereHas('companiesIsPremium') // yalnız premium elanları olanları gətirir
            ->with('companies','companiesIsPremium')->where(['status' => 1])
            ->orderBy('title->'.$this->currentLang,'ASC')->get();

        $allCompaniesIsPremium = Company::where(['is_premium'=>1, 'status'=>1])->whereNotNull(['image','category_id','country_id','city_id'])->orderBy('id','DESC')->get();
        $cities = City::whereNotNull(['image'])
            ->whereNull(['sub_region_id'])
            ->with('companies')->where(['status' => 1])
            ->orderBy('name->'.$this->currentLang,'ASC')->get();
        return view('site.home',compact('mainCategories','categories','allCompaniesIsPremium','cities', 'currentLang'));
    }

    public function trends(Request $request,$slug)
    {
        //premium //visit //loved //rating //shared - is status
        $currentLang = $this->currentLang;
        $mainCategories = Category::whereNull(['parent_id'])->where(['status' => 1])->orderBy('title->' . $this->currentLang, 'ASC')->get();
        $cities = City::whereNull(['sub_region_id'])->where([ 'status' => 1])->orderBy('name->' . $this->currentLang, 'ASC')->get();
        $serviceTypes = ServiceType::where(['status' => 1])->orderBy('name->' . $this->currentLang, 'ASC')->get();
        $title = '';
        if ($slug == 'premium') {
            $title = 'Premium';
            $query = Company::where(['is_premium' => 1, 'status' => 1]);
        }elseif ($slug == 'visit') {
            $title = 'Ən çox ziyarət edilənlər';
            $query = Company::where('reads','>', 5)->where([ 'status' => 1]);
        }elseif ($slug == 'loved') {
            $title = 'Ən çox sevilənlər';
            $query = Company::where('reads','>', 5)->where([ 'status' => 1])->has('userLikes', '>', 5);
        }elseif ($slug == 'rating') {
            $title = 'Ən çox reytinq yığanlar';
            $query = Company::with('comments')->where([ 'status' => 1])->has('comments', '>', 5);
        }elseif ($slug == 'shared') {
            $title = 'Ən çox paylaşılanlar';
            $query = Company::where('share','>', 5)->where([ 'status' => 1]);
        }else{
            $query = Company::where([ 'status' => 1]);
        }

        $query->whereNotNull(['image','category_id','country_id','city_id']);
        // 🔍 Filtrlər (AJAX və normal üçün eyni)
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }



        if ($request->filled('city_id') && $request->filled('sub_region_id')) {
            $query->where('sub_region_id', $request->sub_region_id);
        }else{
            if ($request->filled('city_id')) {
                $query->where('city_id', $request->city_id);
            }
        }


        if ($request->filled('mobile_city_id') && $request->filled('mobile_sub_region_id')) {
            $query->where('sub_region_id', $request->mobile_sub_region_id);
        }else{
            if ($request->filled('mobile_city_id')) {
                $query->where('city_id', $request->mobile_city_id);
            }
        }

        if ($request->filled('service_type')) {
            $serviceTypes = $request->service_type; // array
            $query->where(function ($q) use ($serviceTypes) {
                foreach ($serviceTypes as $type) {
                    if (!empty($type)) {
                        // burada hər hansı biri tapılsa kifayətdir
                        $q->orWhereRaw("JSON_CONTAINS(service_type, '\"$type\"')");
                    }
                }
            });
        }

        $allCompaniesByTrends = $query->orderBy('is_premium','DESC')->orderBy('id', 'DESC')->limit(5)->get();

        // 🔁 AJAX cavabı (yalnız şirkət hissəsi render olunur)
        if ($request->ajax()) {
            $html = view('site.ajax.trends-company', compact('allCompaniesByTrends', 'currentLang'))->render();
            $pagination = view('site.ajax.trends-company', compact('allCompaniesByTrends', 'currentLang'))->render();
            return response()->json([
                'html' => $html,
            ]);
        }

        // 🌐 Tam səhifə yüklənməsi
        return view('site.trends',compact('allCompaniesByTrends','slug','mainCategories','cities', 'serviceTypes', 'currentLang','title'));
    }

    public function city(Request $request, $citySlug, $subRegionSlug = null)
    {
        $currentLang = $this->currentLang;
        $mainCategories = Category::whereNull(['parent_id'])->where(['status' => 1])->orderBy('title->' . $this->currentLang, 'ASC')->get();
        $serviceTypes = ServiceType::where(['status' => 1])->orderBy('name->' . $this->currentLang, 'ASC')->get();
        $subRegions = [];
        $city = null;

        if (!empty($citySlug) && empty($subRegionSlug)) {
            $city = City::where(['slug->' . $currentLang => $citySlug, 'status' => 1])->first();
            $subRegions = City::where(['sub_region_id' => $city['id'], 'status' => 1])->orderBy('name->' . $this->currentLang, 'ASC')->get();
            $query = Company::where(['city_id' => $city['id'], 'status' => 1]);
        } elseif (!empty($citySlug) && !empty($subRegionSlug)) {

            $city = City::where(['slug->' . $currentLang => $subRegionSlug, 'status' => 1])->first();
            $query = Company::where(['city_id' => $city['sub_region_id'], 'sub_region_id' => $city['id'], 'status' => 1]);
        } else {
            $query = Company::where(['status' => 1]);
        }

        $query->whereNotNull(['image','category_id','country_id','city_id']);
        // 🔍 Filtrlər (AJAX və normal üçün eyni)
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('sub_region_id')) {
            $query->where('sub_region_id', $request->sub_region_id);
        }

        if ($request->filled('service_type')) {
            $serviceTypes = $request->service_type; // array
            $query->where(function ($q) use ($serviceTypes) {
                foreach ($serviceTypes as $type) {
                    if (!empty($type)) {
                        // burada hər hansı biri tapılsa kifayətdir
                        $q->orWhereRaw("JSON_CONTAINS(service_type, '\"$type\"')");
                    }
                }
            });
        }

        $allCompaniesByCity = $query->orderBy('is_premium','DESC')->orderBy('id', 'DESC')->paginate(10);

        // 🔁 AJAX cavabı (yalnız şirkət hissəsi render olunur)
        if ($request->ajax()) {
            $html = view('site.ajax.cities-company', compact('allCompaniesByCity', 'currentLang'))->render();
            $pagination = view('site.ajax.cities-company', compact('allCompaniesByCity', 'currentLang'))->render();
            return response()->json([
                'html' => $html,
//                'pagination' => $pagination,
            ]);
        }

        // 🌐 Tam səhifə yüklənməsi
        return view('site.city', compact('currentLang', 'mainCategories', 'serviceTypes', 'subRegions', 'city', 'allCompaniesByCity'));
    }

    public function category(Request $request, $categorySlug)
    {
        $currentLang = $this->currentLang;
        $serviceTypes = ServiceType::where(['status' => 1])->orderBy('name->' . $this->currentLang, 'ASC')->get();
        $cities = City::where([ 'status' => 1])->orderBy('name->' . $this->currentLang, 'ASC')->get();

        if (!empty($categorySlug)) {
            $mainCategory = Category::whereNull(['parent_id'])->where(['status' => 1,'slug->'.$this->currentLang => $categorySlug])->first();
            $query = Company::where(['category_id' => $mainCategory['id'], 'status' => 1]);
        } else {
            $query = Company::where(['status' => 1]);
        }

        $query->whereNotNull(['image','category_id','country_id','city_id']);
        // 🔍 Filtrlər (AJAX və normal üçün eyni)
        if ($request->filled('search')) {
            $query->where('full_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('subregion_id')) {
            $query->where('sub_region_id', $request->subregion_id);
        }

        if ($request->filled('service_type')) {
            $serviceTypes = $request->service_type; // array
            $query->where(function ($q) use ($serviceTypes) {
                foreach ($serviceTypes as $type) {
                    if (!empty($type)) {
                        // burada hər hansı biri tapılsa kifayətdir
                        $q->orWhereRaw("JSON_CONTAINS(service_type, '\"$type\"')");
                    }
                }
            });
        }

        $allCompaniesByCategory = $query->orderBy('is_premium','DESC')->orderBy('id', 'DESC')->paginate(10);

        // 🔁 AJAX cavabı (yalnız şirkət hissəsi render olunur)
        if ($request->ajax()) {
            $html = view('site.ajax.categories-company', compact('allCompaniesByCategory', 'currentLang'))->render();
            $pagination = view('site.ajax.categories-company', compact('allCompaniesByCategory', 'currentLang'))->render();
            return response()->json([
                'html' => $html,
//                'pagination' => $pagination,
            ]);
        }

        // 🌐 Tam səhifə yüklənməsi
        return view('site.category', compact('currentLang', 'cities', 'serviceTypes', 'allCompaniesByCategory', 'mainCategory'));
    }

    public function companyDetails($slug) {
        $currentLang = $this->currentLang;
        $company = Company::with('category', 'comments','posts')->whereNotNull(['image','slug'])->where(['slug' => $slug, 'status' => 1])->first();
        if (empty($company)) {
            return redirect()->back();
        }
        $this->companyId = $company->id;
        $serviceTypes = ServiceType::where(['status' => 1])->orderBy('name->' . $this->currentLang, 'ASC')->get();
        $categories = Category::whereNotNull(['sub_category_id'])->where(['status' => 1])
            ->whereHas('companyServices', function ($q) {
                $q->where('company_id', $this->companyId)
                    ->where('status', 1);
            })
            ->with(['companyServices' => function ($q) {
                $q->where('company_id', $this->companyId)->where('status', 1);
            }])->
            orderBy('title->' . $this->currentLang, 'ASC')->get();
//        dd($categories);
        $sessionKey = 'viewed_company_' . $company->id;
        if (!session()->has($sessionKey)) {
            $company->increment('reads');
            session()->put($sessionKey, true);
        }
        return view('site.company-detail',compact('currentLang', 'company','serviceTypes','categories'));
    }

    public function map()
    {
        $currentLang = $this->currentLang;
        $mainCategory = Category::with('mapCompanies','mapCompany')->whereNull(['parent_id'])->where(['status' => 1])->get();
        return view('site.map',compact('currentLang', 'mainCategory'));
    }

    public function news()
    {
        return view('site.news');
    }
    public function newsDetails($slug)
    {
        return view('site.news-details');
    }

    public function catalogues(Request $request)
    {
        $query = CompanyCatalog::query();
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $catalogues = $query->paginate(10);
        if ($request->ajax()) {
            return view('site.ajax.catalog', compact('catalogues'))->render();
        }
        $categories = Category::with('companies')->where('status', 1)->whereNull('parent_id')->get();
        $companies = Company::with('catalogues')->whereNotNull('image')->where('status', 1)->get();
        return view('site.catalogues',compact('catalogues','categories','companies'));
    }

    public function catalogDetails($id){
        $categories = Category::with('companies')->where('status', 1)->whereNull('parent_id')->get();
        $companies = Company::with('catalogues')->whereNotNull('image')->where('status', 1)->get();
        $catalog = CompanyCatalog::with('company')->where(['id' => $id])->first();
        return view('site.catalogues-details',compact('catalog','categories','companies'));
    }

    public function companies(Request $request)
    {
        $query = Company::with('category', 'subCategory', 'country', 'mainCities', 'subRegion')
            ->whereNotNull('image')
            ->where(['status' => 1]);

        if ($request->has('company_name') && !empty($request->company_name)) {
            $query->where('full_name', 'like', '%' . $request->company_name . '%');
        }

        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('country_id') && !empty($request->country_id)) {
            $query->where('country_id', $request->country_id);
        }


        if ($request->has('city_id') && !empty($request->city_id)) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->has('sub_region_id') && !empty($request->sub_region_id)) {
            $query->where('sub_region_id', $request->sub_region_id);
        }

        $companies = $query->paginate(9);
        if ($request->ajax()) {
            return view('site.ajax.company', compact('companies'))->render();
        }
        $categories = Category::with('companies')->where('status', 1)->whereNull('parent_id')->get();
        $countries = Country::where('status', 1)->get();

        return view('site.companies', compact('companies', 'categories', 'countries'));
    }

    public static function isOpen($company)
    {
        $company = auth('company')->user();
        $is_24_7 = json_decode($company['data'])->is_24_7 ?? null;
        $start_time = json_decode($company['data'])->start_time ?? null;
        $end_time = json_decode($company['data'])->end_time ?? null;
        $working_days = json_decode($company['data'])->working_days ?? null;

        if ($is_24_7) {
            return true; // 7/24 açıqdır
        }

        $currentDay = now()->format('l'); // Cari gün (e.g., Monday)
        $currentTime = now()->format('H:i'); // Cari vaxt (e.g., 10:30)

        // Günlük və həftəlik yoxlama
        if (in_array(lcfirst($currentDay), $working_days)) {
            return $currentTime >= $start_time && $currentTime <= $end_time;
        }
        return false; // Bağlıdır
    }


    public function search(Request $request)
    {
        $currentLang = $this->currentLang;
        $query = Company::whereNotNull('image')
            ->where(['status' => 1]);

        if ($request->has('q') && !empty($request->q)) {
            $query->where('full_name', 'like', '%' . $request->q . '%')
                ->orWhere('data->address', 'like', '%' . $request->q . '%')
                ->orWhere('text', 'like', '%' . $request->q . '%');
        }

        if ($request->has('address') && !empty($request->address)) {
            $query->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(data, '$.address'))) LIKE LOWER(?)", ["%$request->address%"]);
        }

        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('city_id') && !empty($request->city_id)) {
            $query->where('city_id', $request->city_id);
        }
        $companies = $query->orderBy('is_premium','DESC')->orderBy('id', 'DESC')->get();
        $mainCategories = Category::whereNull(['parent_id'])
            ->where(['status' => 1])
            ->orderBy('title->'.$this->currentLang,'ASC')->get();

        $cities = City::whereNotNull(['image'])
            ->whereNull(['sub_region_id'])
            ->with('companies')->where(['status' => 1])
            ->orderBy('name->'.$this->currentLang,'ASC')->get();
        return view('site.search',compact('currentLang','companies','mainCategories','cities'));
    }

    public function soon() {
        return view('components.site.soon');
    }


    public function about() {
        $currentLang = $this->currentLang;
        $staticPage = StaticPage::where('type','about')->first();
        $cityCount = City::where('status',1)->count();
        $companyCount = Company::where('status',1)->count();
        $userCount = User::where('status',1)->count();
        return view('site.about',compact('currentLang','staticPage', 'cityCount', 'companyCount', 'userCount'));
    }

    public function faqs() {
        $currentLang = $this->currentLang;
        $staticPage = StaticPage::where('type','faqs')->first();
        return view('site.faqs',compact('currentLang','staticPage'));
    }

    public function career() {
        return view('site.career');
    }

    public function howWeWork() {
        $currentLang = $this->currentLang;
        $staticPage = StaticPage::where('type','how-we-work')->first();
        return view('site.how-we-work',compact('currentLang','staticPage'));
    }

    public function termsOfUse() {
        $currentLang = $this->currentLang;
        $staticPage = StaticPage::where('type','terms-of-use')->first();
        return view('site.terms-of-use',compact('currentLang','staticPage'));
    }

    public function privacyPolicy() {
        $currentLang = $this->currentLang;
        $staticPage = StaticPage::where('type','privacy-policy')->first();
        return view('site.privacy-policy',compact('currentLang','staticPage'));
    }

    public function services() {
        return view('site.services');
    }

    public function contact() {
        return view('site.contact');
    }

    public function notFound() {
        return view('components.site.404');
    }

}
