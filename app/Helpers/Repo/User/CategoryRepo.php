<?php

namespace App\Helpers\Repo\User;
use App\Helpers\Repo\Repo;
use App\Models\Question;

class CategoryRepo extends Repo{




    public static function CategoryRows($categories){

        if (!empty($categories)) {
            foreach($categories as $c_key=>$cat){
                $cat->categoryImage = \URL::to('Admin_uploads/categories/'.$cat->categoryImage);
            }
        }
        $categories = array_values($categories->toArray());
        return $categories;
        
    }

}