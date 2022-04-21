<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\SizeRepo;
use App\Helpers\Repo\Admin\MainTypeRepo;
use App\Models\Size;
use App\Models\Main_type;

class Sizes extends Controller
{
    

    public function sizesInfo(){
        $data['data'] = Size::get();
        $data['title'] = 'size';
        $data['createPath'] = url('admin/Size/viewCreateSize');
        $data['deletePath'] = url('admin/Size/deleteManySizes');
        return view('Admin/Sizes/sizesInfo',$data);
    }




    public function viewCreateSize($id=false){
        $data['types'] = Main_type::get();
        $data['data'] = Size::find($id);
        return view('Admin/Sizes/viewCreateSize',$data);
    }




    public function createSize(Request $request){

        $validated = $request->validate(SizeRepo::SizeCreateValidate($request));

        if(empty($validated['id'])){
            Size::create($validated);
        }else{
            Size::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteSize($id){
        Size::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManySizes($ids){
        $ids = json_decode($ids);
        Size::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }





}
