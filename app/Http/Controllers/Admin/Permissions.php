<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Helpers\Repo\Admin\PermissionRepo;
use App\Models\Migration;
use App\Models\Migration_role;
use App\Models\Role;

class Permissions extends Controller
{
    

    public function permissionsInfo(){
        $data['data'] = Permission::get();
        $data['title'] = 'permission';
        $data['createPath'] = url('admin/Admin/Permission/viewCreatePermission');
        $data['deletePath'] = url('admin/Admin/Permission/deleteManyPermission');
        return view('Admin/Permission/permissionsInfo',$data);
    }





    public function viewCreatePermission($id = false){
        $data['data'] = Permission::find($id);
        $data['migrations'] = Migration::get();
        $data['roles'] = Role::get();

        $selected_roles = Migration_role::where('permission_id',$id)->get();

        if (!empty($data['migrations'])) {
            foreach($data['migrations'] as $mig){
                if (!empty($data['roles'])) {
                    foreach($data['roles'] as $role){
                        if (!empty($selected_roles)) {
                            foreach($selected_roles as $select_role){
                                if ($select_role->migration_id == $mig->id && $select_role->role_id == $role->id) {
                                    $data['selected'][$mig->name][$role->id] = 'selected';
                                }
                            }
                        }
                    }
                }
            }
        }

        return view('Admin/Permission/viewCreatePermission',$data);
    }






    public function createPermission(Request $request){

        $validated = $request->validate(PermissionRepo::PermissionCreateValidate($request));
        $permission = permission::find($validated['id']);

        if(empty($permission)){
            $permission = permission::create($validated);
        }else{
            $permission->permissionName = $validated['permissionName'];
            $permission->permissionNameAr = $validated['permissionNameAr'];
            $permission->save();
        }

        Migration_role::where('permission_id',$permission->id)->delete();
        if (!empty($request->permissions) && is_array($request->permissions)) {
            foreach($request->permissions as $perm){
                $str = explode(':', $perm);
                $data['migration_id'] = $str[0];
                $data['role_id'] = $str[1];
                $data['permission_id'] = $permission->id;
                Migration_role::create($data);
            }
        }

        session()->flash('success','Done');
        return back();
    }







    public function deletePermission($id){
        Permission::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }







    public function deleteManyPermission($ids){
        $ids = json_decode($ids);
        Permission::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }












}
