<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionLabel;
use Illuminate\Support\Facades\Artisan;
use \Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',['roles'=>$roles]);

    }


    public function create()
    {
        $role = null;
        $permissionLabels = PermissionLabel::with('permissions')->orderBy('id','DESC')->get();
        return view('admin.roles.create_edit',['permissionLabels' => $permissionLabels,'role' => $role]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'role'=>'required',
            'permissions' => 'required'
        ]);

        try {

            $role = Role::firstOrCreate(['name' => $request->role,'guard_name' => 'admin']);
            $role->syncPermissions($request->permissions);

            DB::commit();
            $messages = 'Veriler kayedildi.';

            return redirect()->back()->with('messages', $messages);

        } catch (\Exception $e) {
            DB::rollBack();
            $messages = $e->getMessage();

            return redirect()->back()->with('errors', $messages);
        }
    }


    public function show(Role $role)
    {
        //
    }


    public function edit($id)
    {
        try{
            $role = Role::where('id',$id)->first();
            $permissionLabels = PermissionLabel::with('permissions')->orderBy('id','DESC')->get();

            $permissionsSelected = $role->permissions()->get();


            $data = [];
            foreach ($permissionsSelected as $permission){
                $data[] = $permission->name;
            }

            return view('admin.roles.create_edit',['role' => $role,'permissionLabels' => $permissionLabels,'selectedPermissions' => $data]);

        }catch (\Throwable $exception){
            return redirect()->back()->with('fail',$exception->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'required'
        ]);

        try {
            if(empty($request->permissions)){
                return redirect()->back()->with('errors','Check your role permissions.');
            }

            $role = Role::findOrFail($id);
            $role->syncPermissions($request['permissions']);

            $messages = 'Veriler kayedildi.';
            DB::commit();
            return redirect()->back()->with('messages', $messages);

        } catch (\Exception $e) {
            DB::rollBack();
            $messages = $e->getMessage();

            return redirect()->back()->with('errors', $messages);
        }
    }

    public function destroy(Role $role)
    {
        //
    }
}
