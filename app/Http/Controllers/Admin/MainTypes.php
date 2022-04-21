<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\MainTypeRepo;
use App\Models\Main_type;

class MainTypes extends Controller
{
    




    public function mainTypesInfo(){
        $data['data'] = Main_type::get();
        $data['title'] = 'main_type';
        $data['createPath'] = url('admin/Main_type/viewCreateMainType');
        $data['deletePath'] = url('admin/Main_type/deleteManyMainTypes');
        return view('Admin/MainTypes/mainTypesInfo',$data);
    }




    public function viewCreateMainType($id=false){
        $data['data'] = Main_type::find($id);
        return view('Admin/MainTypes/viewCreateMainType',$data);
    }




    public function createMainType(Request $request){

        $validated = $request->validate(MainTypeRepo::MainTypeCreateValidate($request));

        if(empty($validated['id'])){
            Main_type::create($validated);
        }else{
            Main_type::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteMainType($id){
        Main_type::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyMainTypes($ids){
        $ids = json_decode($ids);
        Main_type::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }










}
