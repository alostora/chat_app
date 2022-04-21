<?php
use Illuminate\Support\Facades\Route;



Route::group(['namespace'=>'Users','middleware'=>'api_lang'],function(){
    //Un auth Routes

    //users
    Route::post('register','Users_auth@register');
    Route::post('login','Users_auth@login');
    Route::post('postForgetPass','Users_auth@postForgetPass');

    //Auth Routes
    Route::group(['middleware'=>'user_auth_api'],function(){
        //users
        Route::get('profile','Users_auth@profile');
        Route::post('updateProfile','Users_auth@updateProfile');
        Route::post('changePassword','Users_auth@changePassword');
        Route::get('logOut','Users_auth@logOut');

        //categories
        Route::get('mainTyps','Categories@mainTyps');
        Route::get('categories/{type_id}','Categories@categories');
        Route::get('subCategories/{cat_id}','Categories@subCategories');
        Route::get('items/{sub_cat_id}','Categories@items');

    });
});
