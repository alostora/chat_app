<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main_type;
use App\Models\Category;
use App\Models\S_category;
use App\Models\Item;


class Categories extends Controller
{


  public function mainTyps(){
    $types = Main_type::get();
    $data['status'] = true;
    $data['types'] = $types->makeHidden('operations');
    return $data;
  }





  public function categories($type_id){
    $categories = Category::where('type_id',$type_id)->get();
    $data['status'] = true;
    $data['categories'] = $categories->makeHidden(['image_url','operations'])->makeVisible(['image_path','type_id']);
    return $data;
  }





  public function subCategories($cat_id){
    $categories = S_category::where('cat_id',$cat_id)->get();
    $data['status'] = true;
    $data['sub_categories'] = $categories->makeHidden(['image_url','operations'])->makeVisible('image_path');
    return $data;
  }




  public function items($sub_cat_id){
    $items = Item::where('sub_cat_id',$sub_cat_id)->get();
    $data['status'] = true;
    $data['items'] = $items->makeHidden(['image_url','operations'])->makeVisible('image_path');
    return $data;
  }




}
