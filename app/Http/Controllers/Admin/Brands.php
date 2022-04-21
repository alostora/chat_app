<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\BrandRepo;
use App\Models\Brand;
use File;
use Lang;

class Brands extends Controller
{
        




    public function brandsInfo(){
        $data['data'] = Brand::get()->makeHidden('image_path');
        $data['title'] = 'brand';
        $data['createPath'] = url('admin/Brand/viewCreateBrand');
        $data['deletePath'] = url('admin/Brand/deleteManyBrands');
        return view('Admin/Brands/brandsInfo',$data);
    }





    public function viewCreateBrand($id = false){
        $data['data'] = Brand::where('id',$id)->first();
        return view('Admin/Brands/viewCreateBrand',$data);
    }





    public function createBrand(Request $request){

        $validated = $request->validate(BrandRepo::BrandCreateValidate());
        $destinationPath = public_path('Admin_uploads/brands/');

        if (empty($validated['id'])) {
            if ($request->hasFile('brandImage')) {
                $validated['brandImage'] = BrandRepo::imageHandle($request->file('brandImage'),$destinationPath);
            }
            Brand::create($validated);
            session()->flash('warning',Lang::get('leftsidebar.Created'));
        }else{
            $brand = Brand::find($validated['id']);
            $validated['brandImage'] = $brand->brandImage;
            if ($request->hasFile('brandImage')) {
                File::delete($destinationPath . $validated['brandImage']);
                $validated['brandImage'] = BrandRepo::imageHandle($request->file('brandImage'),$destinationPath);
            }
            Brand::where('id',$validated['id'])->update($validated);
            session()->flash('warning',Lang::get('leftsidebar.Updated'));
        }
        return redirect('admin/Brand/brandsInfo');
    }





    public function deleteBrand($id){
        $brand =Brand::where('id',$id)->first();
        $destinationPath = public_path('Admin_uploads/brands/');                 
        File::delete($destinationPath . $brand->brandImage );
        $brand->delete();
        session()->flash('warning',Lang::get('leftsidebar.Deleted'));
        return back();
    }





    public function deleteManyBrands($ids){
        $ids = json_decode($ids);
        $brands = Brand::whereIn('id',$ids)->get();
        $destinationPath = public_path('Admin_uploads/brands/');                 
        foreach($brands as $brand){
            File::delete($destinationPath . $brand->brandImage );
            $brand->delete();
        }
        session()->flash('warning','Done');
        return back();
    }





}
