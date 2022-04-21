<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\CountryRepo;
use App\Models\Country;
use File;
use Lang;

class Countries extends Controller
{
    



    public function countriesInfo(){
        $data['data'] = Country::get()->makeHidden('image_path');
        $data['title'] = 'country';
        $data['createPath'] = url('admin/Country/viewCreateCountry');
        $data['deletePath'] = url('admin/Country/deleteManyCountries');
        return view('Admin/Countries/countriesInfo',$data);
    }





    public function viewCreateCountry($id = false){
        $data['data'] = Country::where('id',$id)->first();
        return view('Admin/Countries/viewCreateCountry',$data);
    }





    public function createCountry(Request $request){

        $validated = $request->validate(CountryRepo::CountryCreateValidate());
        $destinationPath = public_path('Admin_uploads/countries/');

        if (empty($validated['id'])) {
            if ($request->hasFile('countryFlag')) {
                $validated['countryFlag'] = CountryRepo::imageHandle($request->file('countryFlag'),$destinationPath);
            }
            Country::create($validated);
            session()->flash('success',Lang::get('leftsidebar.Created'));
        }else{
            $country = Country::find($validated['id']);
            $validated['countryFlag'] = $country->countryFlag;
            if ($request->hasFile('countryFlag')) {
                File::delete($destinationPath . $validated['countryFlag']);
                $validated['countryFlag'] = CountryRepo::imageHandle($request->file('countryFlag'),$destinationPath);
            }
            Country::where('id',$validated['id'])->update($validated);
            session()->flash('success',Lang::get('leftsidebar.Updated'));
        }
        return redirect('admin/Country/countriesInfo');
    }





    public function deleteCountry($id){
        $country =Country::where('id',$id)->first();
        $destinationPath = public_path('Admin_uploads/countries/');                 
        File::delete($destinationPath . $country->countryFlag );
        $country->delete();
        session()->flash('warning',Lang::get('leftsidebar.Deleted'));
        return back();
    }





    public function deleteManyCountries($ids){
        $ids = json_decode($ids);
        $data = Country::whereIn('id',$ids)->get();
        $destinationPath = public_path('Admin_uploads/countries/');                 
        foreach($data as $dataa){
            File::delete($destinationPath . $dataa->countryFlag );
            $dataa->delete();
        }
        session()->flash('warning','Done');
        return back();
    }



}
