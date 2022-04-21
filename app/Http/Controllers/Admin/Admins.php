<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\AdminRepo;
use App\Models\Admin;
use App\Models\User;
use Auth;
use Hash;
use Lang;

class Admins extends Controller
{
    



    public function login(){
        return view('Admin/layouts/login');
    }




    public function doLogin(Request $request){

        $validated = $request->validate(AdminRepo::AdminLoginValidate());

        if(Auth::guard('admin')->attempt($validated)){
            return redirect('admin');
        }else{
            return redirect('admin/login');
        }
    }




    public function dashboard(){
        $data['admins'] = Admin::count();
        $data['users'] = User::count();
        return view('Admin/layouts/dashboard',$data);
    }




    public function adminInfo(){
        $data['data'] = Admin::get();
        $data['title'] = 'admin';
        $data['createPath'] = url('admin/Admin/viewCreateAdmin');
        $data['deletePath'] = url('admin/Admin/deleteManyAdmins');
        return view('Admin/Admin/adminInfo',$data);
    }




    public function viewCreateAdmin($id=false){
        $data['data'] = Admin::find($id);
        return view('Admin/Admin/viewCreateAdmin',$data);
    }




    public function createAdmin(Request $request){

        $validated = $request->validate(AdminRepo::AdminCreateValidate($request));
        unset($validated['confirmPassword']);
        $validated['password'] = Hash::make($validated['password']);

        if(empty($validated['id'])){
            Admin::create($validated);
        }else{
            Admin::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteAdmin($id){
        Admin::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyAdmins($ids){
        $ids = json_decode($ids);
        Admin::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }





    public function logOut(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }






}
