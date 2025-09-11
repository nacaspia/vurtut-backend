<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CmsLogsHelper;
use App\Helpers\LogsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Company\SettingsRequest;
use App\Models\CmsLog;
use App\Models\Company;
use App\Models\CompanyPerson;
use App\Models\CompanyService;
use App\Models\Log;
use App\Repositories\CompanyRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CompaniesController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryImpl $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function index(Request  $request)
    {
        if (!empty($request['filter'])){
            if ($request['status'] == 'nonactive') {
                $status = 0;
            } else {
                $status = 1;
            }
            $type = $request['type'];
            $companies = Company::where(function($query) use ($status, $type) {
                $query->where('status', 'LIKE', $status)->where('type', 'LIKE', $type);
            })->get();
        } else {
            $companies = $this->companyRepository->getAll();
        }
        return view('admin.companies.index',compact('companies'));
    }

    public function logs($id)
    {
        $logs = Log::where(['obj_id'=> $id,'type' => 'company'])->get();
//            ->orderBy('id', 'DESC')
////            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s')"), 'desc')
        return view('admin.logs.logs',compact('logs'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Company $company)
    {
        //
    }

    public function edit($id)
    {
        $company = $this->companyRepository->edit($id);
        return view('admin.companies.edit',compact('company'));
    }

    public function update($id, SettingsRequest $settingsRequest)
    {
        $valdate = Validator::make($settingsRequest->all(), $settingsRequest->rules(), $settingsRequest->messages());

        if ($valdate->fails())
        {
            return redirect()->back()->with('errors', $valdate->errors());
        }
        $company = $this->companyRepository->edit($id);

        try {
            $data = [
                'website' => !empty($settingsRequest->website)? $settingsRequest->website: null,
                'instagram' => !empty($settingsRequest->instagram)? $settingsRequest->instagram: null,
                'facebook' => !empty($settingsRequest->facebook)? $settingsRequest->facebook: null,
                'address' => !empty($settingsRequest->address)? $settingsRequest->address: null,
            ];

            if($settingsRequest->hasFile('image')){
                $image_name = time().'.'.$settingsRequest->image->extension();
                $image_url = $settingsRequest->image->move(public_path('uploads/company'), $image_name);
                $image = $image_url->getFilename();
            }else{
                $image = $company->image;
                $image_name = !empty($image)? $image: NULL;
            }
            $up = Company::where('id',$company->id)->update([
                'full_name' => $settingsRequest->full_name,
                'email' => $settingsRequest->email,
                'phone' => $settingsRequest->phone,
                'text' => $settingsRequest->text,
                'status' => $settingsRequest->status,
                'image' => $image_name,
                'data' => $data
            ]);
            if (!empty($up)){
                $log = [
                    'subj_id' => $company->id,
                    'subj_table' => 'companies',
                    'actions' => 'update',
                    'type' => 'company',
                    'note' => Lang::get('admin.up_success')
                ];
                CmsLogsHelper::convert($log);
                return redirect(route('admin.companies.edit',$company['id']))->with('success', Lang::get('admin.up_success'));
            } else {
                $log = [
                    'subj_id' => $company->id,
                    'subj_table' => 'companies',
                    'actions' => 'update',
                    'type' => 'company',
                    'note' => Lang::get('admin.up_error')
                ];
                CmsLogsHelper::convert($log);
                return redirect()->back()->with('errors', Lang::get('admin.up_error'));
            }
        } catch (\Exception $exception) {
            $log = [
                'subj_id' => $company->id,
                'subj_table' => 'companies',
                'actions' => 'update',
                'type' => 'company',
                'note' => 'errors '. $exception->getMessage()
            ];
            LogsHelper::convert($log);
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            $up = $this->companyRepository->delete($id);
            if (!empty($up)){
                $log = [
                    'subj_id' => $id,
                    'subj_table' => 'companies',
                    'actions' => 'destroy',
                    'note' => Lang::get('admin.delete_success')
                ];
                CmsLogsHelper::convert($log);
                return redirect(route('admin.companies.index'))->with('success', Lang::get('admin.delete_success'));
            } else {
                $log = [
                    'subj_id' => $id,
                    'subj_table' => 'companies',
                    'actions' => 'destroy',
                    'type' => 'company',
                    'note' => Lang::get('admin.delete_error')
                ];
                CmsLogsHelper::convert($log);
                return redirect()->back()->with('errors', Lang::get('admin.delete_error'));
            }
        } catch (\Exception $exception) {
            $log = [
                'subj_id' => $id,
                'subj_table' => 'companies',
                'actions' => 'destroy',
                'type' => 'company',
                'note' => 'errors '. $exception->getMessage()
            ];
            CmsLogsHelper::convert($log);
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    //ajax
    public function companyServiceSetStatus(Request $request)
    {
        $companyId = $request->company_id;
        $company = $this->companyRepository->edit($companyId);
        if (empty($company)){
            return response()->json(['success' => false, 'error' => 'Müəssisə məlumatı tapılmadı'],422);
        }

        $id = $request->id;
        $companyService = CompanyService::where(['company_id' => $companyId, 'id' => $id])->first();
        if (empty($companyService)){
            return response()->json(['success' => false, 'error' => 'Kataloq məlumatı tapılmadı'],422);
        }

        $status = $companyService->status;
        if ($status == 0){
            $companyService->status = 1;
        } else {
            $companyService->status = 0;
        }
        $companyService->save();
        return response()->json(['success' => true, 'message' => 'Kataloq məlumatı yeniləndi'],200);
    }
    public function companyPerson(Request $request)
    {
        $companyId = $request->company_id;
        $company = $this->companyRepository->edit($companyId);
        if (empty($company)){
            return response()->json(['success' => false, 'error' => 'Müəssisə məlumatı tapılmadı'],422);
        }

        $id = $request->id;
        $companyPerson = CompanyPerson::where(['company_id' => $companyId, 'id' => $id])->first();
        if (empty($companyPerson)){
            return response()->json(['success' => false, 'error' => 'Usta məlumatı tapılmadı'],422);
        }

        $status = $companyPerson->status;
        if ($status == 0){
            $companyPerson->status = 1;
        } else {
            $companyPerson->status = 0;
        }
        $companyPerson->save();
        return response()->json(['success' => true, 'message' => 'Usta məlumatı yeniləndi'],200);
    }
}
