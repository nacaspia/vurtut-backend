<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermissionLabel;
use App\Models\Permisson;
use App\Repositories\PermissionRepositoryImpl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
/*
    protected $permissionRepositoryImpl;

    public function __construct(PermissionRepositoryImpl $permissionRepositoryImpl)
    {
        $this->permissionRepositoryImpl = $permissionRepositoryImpl;
    }*/

    public function index()
    {
        $permissionLabels = PermissionLabel::with('permissions')/*->orderBy('label','ASC')*/->get();
        return view('admin.permissions.index', compact('permissionLabels'));
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
    public function store(Request $request)
    {
        app()['cache']->forget('spatie.permission.cache');
        $request->validate([
            'label' => 'required',
            'permissions' => 'required'
        ]);


        try {
            $label = $request->label;
            $checkLabelNameExistOrNot = PermissionLabel::where(['label' => $label])->first();

            if(!$checkLabelNameExistOrNot){
                $permissionLabel = PermissionLabel::create(['label' => $label]);
            }else{
                $permissionLabel = PermissionLabel::where(['label' => $label])->first();
            }

            $permissions = explode(',',$request->permissions);
            foreach ($permissions as $permission){
                $permissionExist = Permission::where(['name' => trim($permission)])->first();
                if(!empty($permissionExist)){
                    continue;
                }else {
                    Permission::create(['name' => $permission, 'guard_name' => 'admin', 'label' => $permissionLabel->label]);
                }
            }

            DB::commit();
            $messages = 'Veriler kayedildi.';
            return redirect()->back()->with('success', $messages);
        } catch (\Exception $e) {
            DB::rollBack();
            $messages = $e->getMessage();
            return redirect()->back()->with('errors', $messages);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permisson  $permisson
     * @return \Illuminate\Http\Response
     */
    public function show(Permisson $permisson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permisson  $permisson
     * @return \Illuminate\Http\Response
     */
    public function edit(Permisson $permisson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permisson  $permisson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permisson $permisson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permisson  $permisson
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permisson $permisson)
    {
        //
    }
}
