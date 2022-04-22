<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Helpers\Repo\Admin\RoleRepo;

class Roles extends Controller
{
    



    public function rolesInfo(){
        $data['data'] = Role::get();
        $data['title'] = 'role';
        $data['createPath'] = url('admin/Role/viewCreateRole');
        $data['deletePath'] = url('admin/Role/deleteManyRoles');
        return view('Admin/Roles/rolesInfo',$data);
    }




    public function viewCreateRole($id=false){
        $data['data'] = Role::find($id);
        return view('Admin/Roles/viewCreateRole',$data);
    }




    public function createRole(Request $request){

        $validated = $request->validate(RoleRepo::RoleCreateValidate($request));

        if(empty($validated['id'])){
            Role::create($validated);
        }else{
            Role::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteRole($id){
        Role::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyRoles($ids){
        $ids = json_decode($ids);
        Role::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }




}
