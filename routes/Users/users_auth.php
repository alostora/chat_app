<?php
use Illuminate\Support\Facades\Route;



Route::group(['namespace'=>'Users','middleware'=>'api_lang'],function(){
    //Un auth Routes

    //users
    Route::post('register','Users_auth@register');
    Route::post('login','Users_auth@login');
    Route::post('postForgetPass','Users_auth@postForgetPass');
    Route::get('logOut','Users_auth@logOut');

    //Auth Routes
    Route::group(['middleware'=>'user_auth_api'],function(){

        //users
        Route::get('profile','Users_auth@profile');
        Route::post('updateProfile','Users_auth@updateProfile');
        Route::post('changePassword','Users_auth@changePassword');


        Route::group(['namespace'=>'Chat'],function(){

            Route::get('langs','Chats@langs');
            Route::post('createLang','Chats@createLang');
            Route::post('changeLoginStatus','Chats@changeLoginStatus');
            Route::post('getUsers','Chats@getUsers');
            Route::get('getUserProfile/{user_id}','Chats@getUserProfile');
            Route::post('blockUser','Chats@blockUser');
            Route::post('reportUser','Chats@reportUser');
            

            Route::get('chatRoom/{room_id}','Messages@chatRoom');
            Route::get('allChatRooms','Messages@allChatRooms');
            Route::post('sendMessage','Messages@sendMessage');
            Route::get('readMessages/{room_id}','Messages@readMessages');
            Route::get('typingNow/{to_user_id}','Messages@typingNow');
            Route::post('translateMessage','Messages@translateMessage');
            Route::post('deleteMessage','Messages@deleteMessage');
        });

    });


});
