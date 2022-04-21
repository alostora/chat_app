<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\CityRepo;
use App\Models\City;
use App\Models\Country;
use Lang;

class Cities extends Controller
{
    



    public function citiesInfo(){

        $data['data'] = City::get();
        $data['title'] = 'city';
        $data['createPath'] = url('admin/City/viewCreateCity');
        $data['deletePath'] = url('admin/City/deleteManyCities');
        return view('Admin/Cities/citiesInfo',$data);

    }




    public function viewCreateCity($id=false){
       
        $data['data'] = City::find($id);
        $data['countries'] = Country::get();

        if (!count($data['countries'])) {
            session()->flash('warning',Lang::get('leftsidebar.create country first plz'));
            return redirect('admin/Country/viewCreateCountry');
        }

        return view('Admin/Cities/viewCreateCity',$data);

    }




    public function createCity(Request $request){
        
        $validated = $request->validate(CityRepo::CityCreateValidate($request));

        if(empty($validated['id'])){
            City::create($validated);
        }else{
            City::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteCity($id){
        City::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyCities($ids){

        $ids = json_decode($ids);
        City::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }





}
