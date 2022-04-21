<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\ColorRepo;
use App\Models\Color;

class Colors extends Controller
{
    




    public function colorsInfo(){
        $data['data'] = Color::get();
        $data['title'] = 'color';
        $data['createPath'] = url('admin/Color/viewCreateColor');
        $data['deletePath'] = url('admin/Color/deleteManyColors');
        return view('Admin/Colors/colorsInfo',$data);
    }




    public function viewCreateColor($id=false){
        $data['data'] = Color::find($id);
        return view('Admin/Colors/viewCreateColor',$data);
    }




    public function createColor(Request $request){

        $validated = $request->validate(ColorRepo::ColorCreateValidate($request));

        if(empty($validated['id'])){
            Color::create($validated);
        }else{
            Color::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteColor($id){
        Color::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyColors($ids){
        $ids = json_decode($ids);
        Color::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }










}
