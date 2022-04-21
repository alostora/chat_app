<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lang;
use App\Helpers\Repo\Admin\LangRepo;

class Langs extends Controller
{
    
    public function langsInfo(){
        $data['data'] = Lang::get();
        $data['title'] = 'lang';
        $data['createPath'] = url('admin/Lang/viewCreateLang');
        $data['deletePath'] = url('admin/Lang/deleteManyLangs');
        return view('Admin/Langs/langsInfo',$data);
    }




    public function viewCreateLang($id=false){
        $data['data'] = Lang::find($id);
        return view('Admin/Langs/viewCreateLang',$data);
    }




    public function createLang(Request $request){

        $validated = $request->validate(LangRepo::LangCreateValidate($request));

        if(empty($validated['id'])){
            Lang::create($validated);
        }else{
            Lang::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteLang($id){
        Lang::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyLangs($ids){
        $ids = json_decode($ids);
        Lang::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }


}
