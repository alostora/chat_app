<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\UserRepo;
use App\Models\User;
use App\Models\Chat\User_lang;
use App\Models\Lang as Langs;
use Lang;

class Users extends Controller
{



    public function userInfo(){

        $data['data'] = User::get()->makeHidden(['langauges','country_key','bio','']);
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





    public function fakeUsers(){
        $langs = ['it'=>'italy','en'=>'english','sp'=>'spanish','ch'=>'china','ar'=>'arabic'];
        $users = User::get();

        $type = 'study';
        $gender = 'male';

        foreach($langs as $code=>$lang){
            $lang = Langs::create([
                "langName"=>$lang,
                "langCode"=>$code,
                
            ]);

            if (!empty($users)) {
                foreach($users as $user){
                    $type =  $type == 'study' ? 'teach' : 'study';
                    $gender =  $gender == 'male' ? 'female' : 'male';
                    User_lang::create([
                        'user_id' => $user->id,
                        'lang_id' => $lang->id,
                        "type"=>$type,
                    ]);
                    $user->country = $lang->langName;
                    $user->country_key = $lang->langCode;
                    $user->gender = $gender;
                    $user->birthDate = '1988-05-20';
                    $user->bio = 'bio bio bio';
                    $user->save();
                }
            }
        }


    }





}
