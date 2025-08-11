<?php

namespace App\Http\Controllers\Site\Company;

use App\Helpers\LogsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Company\ServicesRequest;
use App\Models\Category;
use App\Models\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    protected $company;
    public function __construct()
    {
        $this->currentLang = 'az';
        $this->company = auth('company')->user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currentLang = $this->currentLang;
        $mainCompaniesCategory = Category::whereNull('sub_category_id')->where(['status' => 1,'parent_id' => $this->company->category_id])->get();
        $query = CompanyService::with('subCategory')->where('company_id', $this->company->id);

        if (!empty($request->filter_category_id)) {
            $query->where('parent_category_id', $request->filter_category_id);
        }

        if (!empty($request->filter_sub_category_id)) {
            $query->where('sub_category_id', $request->filter_sub_category_id);
        }

        $companyServices = $query->orderBy('id', 'DESC')->paginate(1);

        // AJAX sorğusu gəlibsə, yalnız HTML partial qaytar
        if ($request->ajax()) {
            $html = view('site.company.services.ajax', compact('companyServices', 'currentLang'))->render();
            $pagination = view('site.company.services.pagination', compact('companyServices'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
            ]);
        }
        return view('site.company.services.index',compact('currentLang','mainCompaniesCategory','companyServices'));
    }

    public function subCategories(Request $request)
    {
        if ($request->ajax() && $request->category_id != null) {
            $currentLang = $this->currentLang;
            $subCompaniesCategory = Category::where(['status' => 1, 'parent_id' => $this->company->category_id,'sub_category_id' => $request->category_id])->get();
            if (!empty($subCompaniesCategory)) {
                return ['success' => true, 'subCompaniesCategory' => $subCompaniesCategory, 'currentLang' => $currentLang];
            } else {
                return ['success' => false, 'subCompaniesCategory' => [], 'currentLang' => $currentLang];
            }
        }
        return ['success' => false, 'subCompaniesCategory' => [], 'currentLang' => ''];
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicesRequest $servicesRequest)
    {
        $valdate = Validator::make($servicesRequest->all(), $servicesRequest->rules(), $servicesRequest->messages());
        if ($valdate->fails()) {
            return response()->json(['success' => false, 'error' => $valdate->errors()],422);
        }
        $company =  $this->company;
        try {
            if (!empty($servicesRequest->category_id)) {
                $category = Category::where(['parent_id' => $company->category_id,'id' => $servicesRequest->category_id])->first();
                $categoryId = $category->id;;
            }else {
                $categoryId = $company->category_id;
            }

            if (!empty($servicesRequest->category_id)) {
                $subCategory = Category::where(['parent_id' => $company->category_id, 'sub_category_id' => $categoryId, 'id' => $servicesRequest->sub_category_id])->first();
                $subCategoryId = $subCategory->id;;
            }else {
                $subCategoryId = $company->sub_category_id;
            }

            if($servicesRequest->hasFile('image')){
//                $image_name = time().'.'.$servicesRequest->image->extension();
                $image_name = $servicesRequest->image->getClientOriginalName();
                $image_url = $servicesRequest->image->move(public_path('uploads/company-services'), $image_name);
                $image = $image_url->getFilename();
            }

            $companyService = new CompanyService;
            $companyService->company_id = $company->id;
            $companyService->parent_category_id = $categoryId;
            $companyService->sub_category_id = $subCategoryId;
            $companyService->title = $servicesRequest->product_name;
            $companyService->description = $servicesRequest->description;
            $companyService->price = $servicesRequest->price;
            $companyService->image = $image_name ?? null;
            $companyService->status = 0;
            $companyService->save();

            $log = [
                'obj_id' => $company->id,
                'subj_id' => $companyService->id,
                'subj_table' => 'company_services',
                'actions' => 'store',
                'type' => 'company',
                'note' => Lang::get('site.success_up')
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => true, 'message' =>Lang::get('site.success_up')],200);
        } catch (\Exception $exception) {
            $log = [
                'obj_id' => $company->id,
                'subj_id' => null,
                'subj_table' => 'company_services',
                'actions' => 'store',
                'type' => 'company',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => $exception->getMessage() /*Lang::get('site.error_up')*/],422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyService  $companyService
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyService $companyService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyService  $companyService
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyService $companyService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyService  $companyService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyService $companyService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyService  $companyService
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyService $companyService)
    {
        //
    }
}
