<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Repo\Admin\CategoryRepo;
use App\Helpers\Repo\Admin\MainTypeRepo;
use App\Models\Category;
use App\Models\Main_type;
use File;
use Lang;

class Categories extends Controller
{
        




    public function categoriesInfo(){
        $data['data'] = Category::get();
        $data['title'] = 'category';
        $data['createPath'] = url('admin/Category/viewCreateCategory');
        $data['deletePath'] = url('admin/Category/deleteManyCategories');
        return view('Admin/Categories/categoriesInfo',$data);
    }





    public function viewCreateCategory($id = false){
        $data['data'] = Category::where('id',$id)->first();
        $data['types'] = Main_type::get();
        return view('Admin/Categories/viewCreateCategory',$data);
    }





    public function createCategory(Request $request){

        $validated = $request->validate(CategoryRepo::CategoryCreateValidate());
        $destinationPath = public_path('Admin_uploads/categories/');

        if (empty($validated['id'])) {
            if ($request->hasFile('categoryImage')) {
                $validated['categoryImage'] = CategoryRepo::imageHandle($request->file('categoryImage'),$destinationPath);
            }
            Category::create($validated);
            session()->flash('warning',Lang::get('leftsidebar.Created'));
        }else{
            $category = Category::find($validated['id']);
            $validated['categoryImage'] = $category->categoryImage;
            if ($request->hasFile('categoryImage')) {
                File::delete($destinationPath . $validated['categoryImage']);
                $validated['categoryImage'] = CategoryRepo::imageHandle($request->file('categoryImage'),$destinationPath);
            }
            Category::where('id',$validated['id'])->update($validated);
            session()->flash('warning',Lang::get('leftsidebar.Updated'));
        }
        return redirect('admin/Category/categoriesInfo');
    }





    public function deleteCategory($id){
        $category =Category::where('id',$id)->first();
        $destinationPath = public_path('Admin_uploads/categories/');                 
        File::delete($destinationPath . $category->categoryImage );
        $category->delete();
        session()->flash('warning',Lang::get('leftsidebar.Deleted'));
        return back();
    }





    public function deleteManyCategories($ids){
        $ids = json_decode($ids);
        $cats = Category::whereIn('id',$ids)->get();
        $destinationPath = public_path('Admin_uploads/categories/');                 
        foreach($cats as $cat){
            File::delete($destinationPath . $cat->categoryImage );
            $cat->delete();
        }
        session()->flash('warning','Done');
        return back();
    }





}
