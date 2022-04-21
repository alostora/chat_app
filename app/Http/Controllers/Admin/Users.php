<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\UserRepo;
use App\Models\User;
use Lang;

class Users extends Controller
{



    public function userInfo(){

        $data['data'] = User::get();
        $data['title'] = 'user';
        $data['createPath'] = url('admin/User/viewCreateUser');
        $data['deletePath'] = url('admin/User/deleteManyUsers');
        return view('Admin/User/userInfo',$data);

    }




    public function viewCreateUser($id=false){
       
        $data['data'] = User::find($id);
        return view('Admin/User/viewCreateUser',$data);

    }




    public function createUser(Request $request){

        $validated = $request->validate(UserRepo::UserCreateValidate($request));
        unset($validated['confirmPassword']);
        if(empty($validated['id'])){
            User::create($validated);
        }else{
            User::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteUser($id){
        User::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyUsers($ids){

        $ids = json_decode($ids);
        User::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }





}
