<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\S_categoryRepo;
use App\Helpers\Repo\Admin\CategoryRepo;
use App\Models\S_category;
use App\Models\Category;
use File;
use Lang;

class S_categories extends Controller
{
        




    public function s_categoriesInfo(){
        $data['data'] = S_category::get()->makeHidden('image_path');
        $data['title'] = 's_category';
        $data['createPath'] = url('admin/S_category/viewCreateS_category');
        $data['deletePath'] = url('admin/S_category/deleteManyS_categories');
        
        return view('Admin/S_categories/s_categoriesInfo',$data);
    }





    public function viewCreateS_category($id = false){
        $data['data'] = S_category::where('id',$id)->first();
        $data['categories'] = Category::get();

        return view('Admin/S_categories/viewCreateS_category',$data);
    }





    public function createS_category(Request $request){

        $validated = $request->validate(S_categoryRepo::CategoryCreateValidate());
        $destinationPath = public_path('Admin_uploads/s_categories/');

        if (empty($validated['id'])) {
            if ($request->hasFile('categoryImage')) {
                $validated['categoryImage'] = S_categoryRepo::imageHandle($request->file('categoryImage'),$destinationPath);
            }
            S_category::create($validated);
            session()->flash('warning',Lang::get('leftsidebar.Created'));
        }else{
            $category = S_category::find($validated['id']);
            $validated['categoryImage'] = $category->categoryImage;
            if ($request->hasFile('categoryImage')) {
                File::delete($destinationPath . $validated['categoryImage']);
                $validated['categoryImage'] = S_categoryRepo::imageHandle($request->file('categoryImage'),$destinationPath);
            }
            S_category::where('id',$validated['id'])->update($validated);
            session()->flash('warning',Lang::get('leftsidebar.Updated'));
        }
        return redirect('admin/S_category/s_categoriesInfo');
    }





    public function deleteS_category($id){
        $category =S_category::where('id',$id)->first();
        $destinationPath = public_path('Admin_uploads/s_categories/');                 
        File::delete($destinationPath . $category->categoryImage );
        $category->delete();
        session()->flash('warning',Lang::get('leftsidebar.Deleted'));
        return back();
    }





    public function deleteManyS_categories($ids){
        $ids = json_decode($ids);
        $data = S_category::whereIn('id',$ids)->get();
        $destinationPath = public_path('Admin_uploads/s_categories/');                 
        foreach($data as $dataa){
            File::delete($destinationPath . $dataa->categoryImage );
            $dataa->delete();
        }
        session()->flash('warning','Done');
        return back();
    }





}
