<?php

namespace App\Http\Controllers\Site\Company;

use App\Helpers\Company\CatalogsHelper;
use App\Helpers\Company\CompanyPostHelper;
use App\Helpers\LogsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Company\CompanyPostRequest;
use App\Models\CompanyPost;
use App\Repositories\Company\CompanyPostRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class CompanyPostController extends Controller
{
    protected $companyPostRepository;
    protected $company;

    public function __construct(CompanyPostRepositoryImpl $companyPostRepository)
    {
        $this->company = auth('company')->user();
        $this->companyPostRepository = $companyPostRepository;
    }

    public function index()
    {
        $companyPosts = $this->companyPostRepository->getAll($this->company->id);
        $company = $this->company;
        return view('site.company.company-post.index', compact('companyPosts','company'));
    }

    public function create()
    {
        return view('site.company.company-post.create');
    }

    public function store(CompanyPostRequest $companyPostRequest)
    {
        try {
            $image = NULL;
            $data = CompanyPostHelper::data($companyPostRequest,$image);
            $companyPost = $this->companyPostRepository->create($data);
            $companyLog = [
                'obj_id' => $this->company->id,
                'subj_id' => $companyPost->id,
                'subj_table' => 'company_posts',
                'actions' => 'store',
                'type' => 'company',
                'note' => Lang::get('site.success_add')
            ];
            LogsHelper::convert($companyLog);
            return response()->json(['success' => true, 'message' => Lang::get('site.success_add')],200);
        } catch (\Exception $exception) {
            $companyLog = [
                'obj_id' => $this->company->id,
                'subj_id' => NULL,
                'subj_table' => 'company_posts',
                'actions' => 'store',
                'type' => 'company',
                'note' => Lang::get('site.error_add. '.$exception->getMessage())
            ];
            LogsHelper::convert($companyLog);
            return response()->json(['success' => false, 'errors' => Lang::get('site.errors_add')],422);
        }
    }

    public function show(CompanyPost $post)
    {
        //
    }

    public function edit($id)
    {
        $companyPost = CompanyCatalog::where([ 'id' => $id,'company_id' => $this->company->id])->first();
        return view('site.company.company-post.edit',compact('companyPost'));
    }

    public function update(CompanyPostRequest $companyPostRequest, $id)
    {
        if ($companyPostRequest['type'] == 'delete'){
            return self::destroy($id);
        }
    }

    public function destroy($id, CompanyPostRequest $request)
    {
        $company = CompanyPost::where('id',$id)->first();
        if (empty($company)){
            return response()->json(['success' => false, 'errors' => Lang::get('site.errors_delete')],422);
        }
        CompanyPost::where('id',$id)->delete();
        $this->companyPostRepository->delete($id);
        return response()->json(['success' => true, 'message' => Lang::get('site.success_delete')],200);
    }
}
