<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\StateRepo;
use App\Helpers\Repo\Admin\CityRepo;
use App\Models\State;
use App\Models\City;
use App\Models\Country;
use Lang;

class States extends Controller
{
    



    public function statesInfo(){

        $data['data'] = State::get();
        $data['title'] = 'state';
        $data['createPath'] = url('admin/State/viewCreateState');
        $data['deletePath'] = url('admin/State/deleteManyStates');
        return view('Admin/States/statesInfo',$data);

    }




    public function viewCreateState($id=false){
       
        $data['data'] = State::find($id);
        $data['countries'] = Country::get();
        $cities = City::count();

        if($cities == 0){
            session()->flash('warning',Lang::get('leftsidebar.create city first plz'));
            return redirect('admin/City/viewCreateCity');
        }

        return view('Admin/States/viewCreateState',$data);

    }




    public function createState(Request $request){
        
        $validated = $request->validate(StateRepo::StateCreateValidate($request));

        if(empty($validated['id'])){
            State::create($validated);
        }else{
            State::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteState($id){
        State::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyStates($ids){

        $ids = json_decode($ids);
        State::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }





    public function getCities($country_id){
        $data['status'] = true;
        $data['cities'] = City::where('country_id',$country_id)->get();

        if (count($data['cities']) == 0) {
            $data['status'] = false;
        }
        return $data;
    }









}
