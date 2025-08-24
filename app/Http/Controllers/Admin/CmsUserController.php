<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CmsLogsHelper;
use App\Helpers\CmsUserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CmsUserRequest;
use App\Models\CmsLog;
use App\Models\CmsUser;
use App\Repositories\CmsUserRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Role;

class CmsUserController extends Controller
{
    protected $cmsUserRepository;

    public function __construct(CmsUserRepositoryImpl $cmsUserRepository)
    {
        $this->cmsUserRepository = $cmsUserRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms_users = $this->cmsUserRepository->getAll();
        return view('admin.cms-users.index',compact('cms_users'));
    }

    public function logs($id)
    {
        $logs = CmsLog::where('cms_user_id', $id)->get();
//            ->orderBy('id', 'DESC')
////            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s')"), 'desc')
        return view('admin.logs.cms-logs',compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.cms-users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CmsUserRequest $cmsUserRequest)
    {
        try {
            $user = NULL;
            $data = CmsUserHelper::data($cmsUserRequest,$user);
            $cmsUser = $this->cmsUserRepository->create($data);
            if (isset($cmsUserRequest->role) && !empty($cmsUserRequest->role)) {
                $cmsUser->assignRole($cmsUserRequest->role);
            }
            $log = [
                'subj_id' => $cmsUser->id,
                'subj_table' => 'cms_users',
                'actions' => 'store',
                'note' => 'add_success ',
            ];
            CmsLogsHelper::convert($log);
            DB::commit();
            return redirect()->back()->with('success', 'Məlumatınız əlavə edildi.');
        }catch (\Exception $e){
            $log = [
                'subj_id' => null,
                'subj_table' => 'cms_users',
                'actions' => 'store',
                'note' => 'add_error '.$e->getMessage(),
            ];
            CmsLogsHelper::convert($log);
            DB::rollBack();
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CmsUser  $cmsUser
     * @return \Illuminate\Http\Response
     */
    public function show(CmsUser $cmsUser)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CmsUser  $cmsUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cmsUser = CmsUser::where('id',$id)->first();
        $roles = Role::all();
        return view('admin.cms-users.edit',compact('roles','cmsUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CmsUser  $cmsUser
     * @return \Illuminate\Http\Response
     */
    public function update(CmsUserRequest $cmsUserRequest, $id)
    {
        try {
            $cmsUser = CmsUser::where('id',$id)->first();
            $data = CmsUserHelper::data($cmsUserRequest,$cmsUser);
            $this->cmsUserRepository->update($id,$data);
            if (isset($cmsUserRequest->role) && !empty($cmsUserRequest->role)) {
                DB::table('model_has_roles')->where('model_id',$id)->delete();
                $cmsUser->assignRole($cmsUserRequest->role);
            }
            $log = [
                'subj_id' => $cmsUser->id,
                'subj_table' => 'cms_users',
                'actions' => 'store',
                'note' => 'add_success ',
            ];
            CmsLogsHelper::convert($log);
            DB::commit();
            return redirect()->back()->with('success', 'Məlumatınız əlavə edildi.');
        }catch (\Exception $e){
            $log = [
                'subj_id' => null,
                'subj_table' => 'cms_users',
                'actions' => 'store',
                'note' => 'add_error '.$e->getMessage(),
            ];
            CmsLogsHelper::convert($log);
            DB::rollBack();
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CmsUser  $cmsUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cms_user = CmsUser::where('id',$id)->first();
            if ($this->cmsUserRepository->delete($cms_user['id'])) {
                return redirect()->back()->with('success', Lang::get('admin.delete_success'));
            }
        } catch (\Exception $exception) {

            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }
}
