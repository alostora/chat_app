<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\MeasurUnitRepo;
use App\Models\Measur_unit;

class MeasurUnits extends Controller
{
    
    
    public function measurUnitsInfo(){
        $data['data'] = Measur_unit::get();
        $data['title'] = 'measur_unit';
        $data['createPath'] = url('admin/Measur_unit/viewCreateMeasurUnit');
        $data['deletePath'] = url('admin/Measur_unit/deleteManyMeasurUnits');
        return view('Admin/MeasurUnits/measurUnitsInfo',$data);
    }




    public function viewCreateMeasurUnit($id=false){
        $data['data'] = Measur_unit::find($id);
        return view('Admin/MeasurUnits/viewCreateMeasurUnit',$data);
    }




    public function createMeasurUnit(Request $request){

        $validated = $request->validate(MeasurUnitRepo::MeasurUnitCreateValidate($request));

        if(empty($validated['id'])){
            Measur_unit::create($validated);
        }else{
            Measur_unit::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteMeasurUnit($id){
        Measur_unit::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyMeasurUnits($ids){
        $ids = json_decode($ids);
        Measur_unit::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }





}
