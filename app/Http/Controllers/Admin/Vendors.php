<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\VendorRepo;
use App\Models\Vendor;
use Lang;
use Hash;

class Vendors extends Controller
{



    public function vendorInfo(){

        $data['data'] = Vendor::get();
        $data['title'] = 'vendor';
        $data['createPath'] = url('admin/Vendor/viewCreateVendor');
        $data['deletePath'] = url('admin/Vendor/deleteManyVendors');
        return view('Admin/Vendor/vendorInfo',$data);

    }




    public function viewCreateVendor($id=false){
       
        $data['data'] = Vendor::find($id);
        return view('Admin/Vendor/viewCreateVendor',$data);

    }




    public function createVendor(Request $request){

        $validated = $request->validate(VendorRepo::VendorCreateValidate($request));
        unset($validated['confirmPassword']);
        $validated['password'] = Hash::make($validated['password']);
        if(empty($validated['id'])){
            Vendor::create($validated);
        }else{
            Vendor::where('id',$validated['id'])->update($validated);
        }

        session()->flash('success','Done');
        return back();

    }




    public function deleteVendor($id){
        Vendor::where('id',$id)->delete();
        session()->flash('warning','Done');
        return back();
    }





    public function deleteManyVendors($ids){

        $ids = json_decode($ids);
        Vendor::destroy($ids);
        session()->flash('warning','Done');
        return back();
    }





}
