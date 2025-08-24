<?php

namespace App\Http\Controllers\Site\User;
use App\Helpers\LogsHelper;
use App\Helpers\User\UserPostHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\UserPostRequest;
use App\Models\UserPost;
use App\Repositories\User\UserPostRepositoryImpl;
use Illuminate\Support\Facades\Lang;

class UserPostController extends Controller
{
    protected $userPostRepository;
    protected $user;

    public function __construct(UserPostRepositoryImpl $userPostRepository)
    {
        $this->user = auth('user')->user();
        $this->userPostRepository = $userPostRepository;
    }

    public function index()
    {
        $userPost =$this->userPostRepository->getAll($this->user->id);
        return view('site.user.user-post.index', compact('userPost'));
    }

    public function create()
    {
        return view('site.user.user-post.create');
    }

    public function store(UserPostRequest $userPostRequest)
    {
        try {
            $image = NULL;
            $data = UserPostHelper::data($userPostRequest,$image);
            $userPost = $this->userPostRepository->create($data);
            if ($userPost) {
                $companyLog = [
                    'obj_id' => $this->user->id,
                    'subj_id' => $userPost->id,
                    'subj_table' => 'user_posts',
                    'actions' => 'store',
                    'type' => 'user',
                    'note' => Lang::get('site.success_add')
                ];
                LogsHelper::convert($companyLog);
                return redirect()->back()->with('success', Lang::get('site.success_add'));
            } else {
                $companyLog = [
                    'obj_id' => $this->user->id,
                    'subj_id' => NULL,
                    'subj_table' => 'user_posts',
                    'actions' => 'store',
                    'type' => 'user',
                    'note' => Lang::get('site.error_add')
                ];
                LogsHelper::convert($companyLog);
                return redirect()->back()->with('errors', Lang::get('site.error_add'));
            }
        } catch (\Exception $exception) {
            $companyLog = [
                'obj_id' => $this->user->id,
                'subj_id' => NULL,
                'subj_table' => 'user_posts',
                'actions' => 'store',
                'type' => 'user',
                'note' => Lang::get('site.error_add. '.$exception->getMessage())
            ];
            LogsHelper::convert($companyLog);
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    public function show(UserPost $userPost)
    {
        //
    }

    public function edit($id)
    {
        $companyPost = CompanyCatalog::where([ 'id' => $id,'company_id' => $this->user->id])->first();
        return view('site.user.post.edit',compact('companyPost'));
    }

    public function update($companyPostRequest, $id)
    {
        if ($companyPostRequest['type'] == 'delete'){
            return self::destroy($id);
        }
        try {
            $companyPost = CompanyPost::where([ 'id' => $id,'company_id' => $this->company->id])->first();
            $data = CompanyPostHelper::data($companyPostRequest,$companyPost['image']);
            $companyPost = $this->companyPostRepository->update($id, $data);
//            dd($companyPost);
            if ($companyPost) {
                $companyLog = [
                    'obj_id' => $this->company->id,
                    'subj_id' => $id,
                    'subj_table' => 'company_posts',
                    'actions' => 'companyPostUpdate',
                    'type' => 'company',
                    'note' => Lang::get('site.success_up')
                ];
                LogsHelper::convert($companyLog);
                return redirect()->back()->with('success', Lang::get('site.success_up'));
            } else {
                $companyLog = [
                    'obj_id' => $this->company->id,
                    'subj_id' => $id,
                    'subj_table' => 'company_posts',
                    'actions' => 'companyPostUpdate',
                    'type' => 'company',
                    'note' => Lang::get('site.error_up')
                ];
                LogsHelper::convert($companyLog);
                return redirect()->back()->with('erro1rs', Lang::get('site.error_up'));
            }
        } catch (\Exception $exception) {
            $companyLog = [
                'obj_id' => $this->company->id,
                'subj_id' => $id,
                'subj_table' => 'company_posts',
                'actions' => 'companyPostUpdate',
                'type' => 'company',
                'note' => Lang::get('site.error_up. '.$exception->getMessage())
            ];
            LogsHelper::convert($companyLog);
            return redirect()->back()->with('errors','errossrs '. $exception->getMessage());
        }
    }

    public function destroy($id, UserPostRequest $userPostRequest)
    {
        $data = $this->userPostRepository->delete($id);
        return redirect()->back()->with('success', Lang::get('site.success_delete'));
    }
}
