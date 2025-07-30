<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CmsLogsHelper;
use App\Helpers\LogsHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\SettingsRequest;
use App\Models\Log;
use App\Models\User;
use App\Repositories\UserRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryImpl $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        if (!empty($request['filter'])){
            if ($request['status'] == 'nonactive') {
                $status = 0;
            } else {
                $status = 1;
            }

            $users = User::where(function($query) use ($status) {
                $query->where('status', 'LIKE', $status);
            })->get();
        } else {
            $users = $this->userRepository->getAll();
        }
        return view('admin.users.index',compact('users'));
    }

    public function logs($id)
    {
        $logs = Log::where(['obj_id'=> $id,'type' => 'users'])->get();

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

    public function show($id)
    {
    }

    public function edit($id)
    {
        $user = $this->userRepository->edit($id);
        return view('admin.users.edit',compact('user'));
    }

    public function update($id, SettingsRequest $settingsRequest)
    {
        $valdate = Validator::make($settingsRequest->all(), $settingsRequest->rules(), $settingsRequest->messages());

        if ($valdate->fails())
        {
            return redirect()->back()->with('errors', $valdate->errors());
        }
        $user = $this->userRepository->edit($id);

        try {
            $data = [
                'gender' => !empty($settingsRequest->gender)? $settingsRequest->gender: null,
                'address' => !empty($settingsRequest->address)? $settingsRequest->address: null
            ];

            if($settingsRequest->hasFile('image')){
                $image_name = time().'.'.$settingsRequest->image->extension();
                $image_url = $settingsRequest->image->move(public_path('uploads/user'), $image_name);
                $image = $image_url->getFilename();
            }else{
                $image = $user->image;
                $image_name = !empty($image)? $image: NULL;
            }
            $up = User::where('id',$user->id)->update([
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
                    'subj_id' => $user->id,
                    'subj_table' => 'users',
                    'actions' => 'update',
                    'type' => 'user',
                    'note' => Lang::get('admin.up_success')
                ];
                CmsLogsHelper::convert($log);
                return redirect(route('admin.users.edit',$user['id']))->with('success', Lang::get('admin.up_success'));
            } else {
                $log = [
                    'subj_id' => $user->id,
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
                'subj_id' => $user->id,
                'subj_table' => 'companies',
                'actions' => 'update',
                'type' => 'company',
                'note' => 'errors '. $exception->getMessage()
            ];
            CmsLogsHelper::convert($log);
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            $up = $this->userRepository->delete($id);
            if (!empty($up)){
                $log = [
                    'subj_id' => $id,
                    'subj_table' => 'users',
                    'actions' => 'destroy',
                    'note' => Lang::get('admin.delete_success')
                ];
                CmsLogsHelper::convert($log);
                return redirect(route('admin.users.index'))->with('success', Lang::get('admin.delete_success'));
            } else {
                $log = [
                    'subj_id' => $id,
                    'subj_table' => 'users',
                    'actions' => 'destroy',
                    'note' => Lang::get('admin.delete_error')
                ];
                CmsLogsHelper::convert($log);
                return redirect()->back()->with('errors', Lang::get('admin.delete_error'));
            }
        } catch (\Exception $exception) {
            $log = [
                'subj_id' => $id,
                'subj_table' => 'users',
                'actions' => 'destroy',
                'note' => 'errors '. $exception->getMessage()
            ];
            CmsLogsHelper::convert($log);
            return redirect()->back()->with('errors','errors '. $exception->getMessage());
        }
    }
}
