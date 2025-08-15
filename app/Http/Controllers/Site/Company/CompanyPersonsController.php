<?php

namespace App\Http\Controllers\Site\Company;

use App\Helpers\LogsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Company\CompanyPersonsRequest;
use App\Models\CompanyPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CompanyPersonsController extends Controller
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
        $query = CompanyPerson::where('company_id', $this->company->id);

        if (!empty($request->filter_status)) {
            $query->where('status', $request->filter_status);
        }
        $companyPersons = $query->orderBy('id', 'DESC')->paginate(6);

        // AJAX sorğusu gəlibsə, yalnız HTML partial qaytar
        if ($request->ajax()) {
            $html = view('site.company.persons.ajax', compact('companyPersons', 'currentLang'))->render();
            $pagination = view('site.company.persons.pagination', compact('companyPersons'))->render();
            return response()->json(['html' => $html,  'pagination' => $pagination]);
        }
        return view('site.company.persons.index',compact('currentLang','companyPersons'));
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
    public function store(CompanyPersonsRequest $companyPersonsRequest)
    {
        $valdate = Validator::make($companyPersonsRequest->all(), $companyPersonsRequest->rules(), $companyPersonsRequest->messages());
        if ($valdate->fails()) {
            return response()->json(['success' => false, 'error' => $valdate->errors()],422);
        }
        $company =  $this->company;
        try {

            if($companyPersonsRequest->hasFile('image')){
                $image_name = $companyPersonsRequest->image->getClientOriginalName();
                $image_url = $companyPersonsRequest->image->move(public_path('uploads/company-persons'), $image_name);
                $image = $image_url->getFilename();
            }

            $companyPerson = new CompanyPerson();
            $companyPerson->company_id = $company->id;
            $companyPerson->name = $companyPersonsRequest->name;
            $companyPerson->text = $companyPersonsRequest->description;
            $companyPerson->image = $image_name ?? null;
            $companyPerson->status = 0;
            $companyPerson->save();

            $log = [
                'obj_id' => $company->id,
                'subj_id' => $companyPerson->id,
                'subj_table' => 'company_persons',
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
                'subj_table' => 'company_persons',
                'actions' => 'store',
                'type' => 'company',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return response()->json(['success' => false, 'message' => Lang::get('site.error_up')],422);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyPerson  $companyPerson
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyPerson $companyPerson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyPerson  $companyPerson
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyPerson $companyPerson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyPerson  $companyPerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyPerson $companyPerson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyPerson  $companyPerson
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyPerson $companyPerson)
    {
        //
    }
}
