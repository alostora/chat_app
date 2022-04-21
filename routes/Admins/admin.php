<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'lang'],function(){

	Route::get('lang/{lang}',function($lang){
		session(['lang'=>$lang]);
		session()->flash('success',Lang::get('leftsidebar.Done'));
		return back();
	});


	Route::get('login','Admins@login');
	Route::post('doLogin','Admins@doLogin');



	Route::group(['middleware'=>'admin_auth'],function(){
		
		Route::get('logOut','Admins@logOut');
		Route::get('/','Admins@dashboard');

		Route::group(['prefix'=>'Admin'],function(){
			//admins
			Route::get('adminInfo','Admins@adminInfo');
			Route::get('viewCreateAdmin/{id?}','Admins@viewCreateAdmin');
			Route::post('createAdmin','Admins@createAdmin');
			Route::get('deleteAdmin/{id}','Admins@deleteAdmin');
			Route::get('deleteManyAdmins/{ids}','Admins@deleteManyAdmins');
			
			//permissions
			Route::group(['prefix'=>'Permission'],function(){
				Route::get('permissionsInfo','Permissions@permissionsInfo');
				Route::get('viewCreatePermission/{id?}','Permissions@viewCreatePermission');
				Route::post('createPermission','Permissions@createPermission');
				Route::get('deletePermission/{id}','Permissions@deletePermission');
				Route::get('deleteManyPermission/{id}','Permissions@deleteManyPermission');
			
			});

			//roles
			Route::group(['prefix'=>'Role'],function(){
				Route::get('rolesInfo','Roles@rolesInfo');
				Route::get('viewCreateRole/{id?}','Roles@viewCreateRole');
				Route::post('createRole','Roles@createRole');
				Route::get('deleteRole/{id}','Roles@deleteRole');
				Route::get('deleteManyRole/{id}','Roles@deleteManyRole');
			
			});
		});


		//users
		Route::group(['prefix'=>'User'],function(){
			Route::get('userInfo','Users@userInfo');
			Route::get('viewCreateUser/{id?}','Users@viewCreateUser');
			Route::post('createUser','Users@createUser');
			Route::get('deleteUser/{id}','Users@deleteUser');
			Route::get('deleteManyUsers/{ids}','Users@deleteManyUsers');
		});


		//vendros
		Route::group(['prefix'=>'Vendor'],function(){
			Route::get('vendorInfo','Vendors@vendorInfo');
			Route::get('viewCreateVendor/{id?}','Vendors@viewCreateVendor');
			Route::post('createVendor','Vendors@createVendor');
			Route::get('deleteVendor/{id}','Vendors@deleteVendor');
			Route::get('deleteManyVendors/{ids}','Vendors@deleteManyVendors');
		});


		//main types
		Route::group(['prefix'=>'Main_type'],function(){
			Route::get('mainTypesInfo','MainTypes@mainTypesInfo');
			Route::get('viewCreateMainType/{id?}','MainTypes@viewCreateMainType');
			Route::post('createMainType','MainTypes@createMainType');
			Route::get('deleteMainType/{id}','MainTypes@deleteMainType');
			Route::get('deleteManyMainTypes/{ids}','MainTypes@deleteManyMainTypes');
		});


		//sizes
		Route::group(['prefix'=>'Size'],function(){
			Route::get('sizesInfo','Sizes@sizesInfo');
			Route::get('viewCreateSize/{id?}','Sizes@viewCreateSize');
			Route::post('createSize','Sizes@createSize');
			Route::get('deleteSize/{id}','Sizes@deleteSize');
			Route::get('deleteManySizes/{ids}','Sizes@deleteManySizes');
		});


		//measur_unets
		Route::group(['prefix'=>'Measur_unit'],function(){
			Route::get('measurUnitsInfo','MeasurUnits@measurUnitsInfo');
			Route::get('viewCreateMeasurUnit/{id?}','MeasurUnits@viewCreateMeasurUnit');
			Route::post('createMeasurUnit','MeasurUnits@createMeasurUnit');
			Route::get('deleteMeasurUnit/{id}','MeasurUnits@deleteMeasurUnit');
			Route::get('deleteManyMeasurUnits/{ids}','MeasurUnits@deleteManyMeasurUnits');
		});



		//langs
		Route::group(['prefix'=>'Lang'],function(){
			Route::get('langsInfo','Langs@langsInfo');
			Route::get('viewCreateLang/{id?}','Langs@viewCreateLang');
			Route::post('createLang','Langs@createLang');
			Route::get('deleteLang/{id}','Langs@deleteLang');
			Route::get('deleteManyLangs/{ids}','Langs@deleteManyLangs');
		});


		//categories
		Route::group(['prefix'=>'Category'],function(){
			Route::get('categoriesInfo','Categories@categoriesInfo');
			Route::get('viewCreateCategory/{id?}','Categories@viewCreateCategory');
			Route::post('createCategory','Categories@createCategory');
			Route::get('deleteCategory/{id}','Categories@deleteCategory');
			Route::get('deleteManyCategories/{ids}','Categories@deleteManyCategories');
		});


		//sub categories
		Route::group(['prefix'=>'S_category'],function(){
			Route::get('s_categoriesInfo','S_categories@s_categoriesInfo');
			Route::get('viewCreateS_category/{id?}','S_categories@viewCreateS_category');
			Route::post('createS_category','S_categories@createS_category');
			Route::get('deleteS_category/{id}','S_categories@deleteS_category');
			Route::get('deleteManyS_categories/{ids}','S_categories@deleteManyS_categories');
		});
		

		//generalSetting
		Route::group(['prefix'=>'Setting'],function(){
			Route::get('generalSetting','Settings@generalSetting');
			Route::get('viewCreateSetting/{id?}','Settings@viewCreateSetting');
			Route::post('createSetting','Settings@createSetting');
			Route::get('deleteSetting/{id}','Settings@deleteSetting');
			Route::get('deleteManySettings/{ids}','Settings@deleteManySettings');
		});


		//countries
		Route::group(['prefix'=>'Country'],function(){
			Route::get('countriesInfo','Countries@countriesInfo');
			Route::get('viewCreateCountry/{id?}','Countries@viewCreateCountry');
			Route::post('createCountry','Countries@createCountry');
			Route::get('deleteCountry/{id}','Countries@deleteCountry');
			Route::get('deleteManyCountries/{ids}','Countries@deleteManyCountries');
		});


		//cities
		Route::group(['prefix'=>'City'],function(){
			Route::get('citiesInfo','Cities@citiesInfo');
			Route::get('viewCreateCity/{id?}','Cities@viewCreateCity');
			Route::post('createCity','Cities@createCity');
			Route::get('deleteCity/{id}','Cities@deleteCity');
			Route::get('deleteManyCities/{ids}','Cities@deleteManyCities');
		});


		//stats
		Route::group(['prefix'=>'State'],function(){
			Route::get('statesInfo','States@statesInfo');
			Route::get('viewCreateState/{id?}','States@viewCreateState');
			Route::post('createState','States@createState');
			Route::get('deleteState/{id}','States@deleteState');
			Route::get('deleteManyStates/{ids}','States@deleteManyStates');
			Route::get('getCities/{city_id}','States@getCities');
		});


		//brands
		Route::group(['prefix'=>'Brand'],function(){
			Route::get('brandsInfo','Brands@brandsInfo');
			Route::get('viewCreateBrand/{id?}','Brands@viewCreateBrand');
			Route::post('createBrand','Brands@createBrand');
			Route::get('deleteBrand/{id}','Brands@deleteBrand');
			Route::get('deleteManyBrands/{ids}','Brands@deleteManyBrands');
		});


		//colors
		Route::group(['prefix'=>'Color'],function(){
			Route::get('colorsInfo','Colors@colorsInfo');
			Route::get('viewCreateColor/{id?}','Colors@viewCreateColor');
			Route::post('createColor','Colors@createColor');
			Route::get('deleteColor/{id}','Colors@deleteColor');
			Route::get('deleteManyColors/{ids}','Colors@deleteManyColors');
		});


		//items
		Route::group(['prefix'=>'Item'],function(){
			Route::get('itemsInfo','Items@itemsInfo');
			Route::get('viewCreateItem/{id?}','Items@viewCreateItem');
			Route::post('createItem','Items@createItem');
			Route::post('createItemImages','Items@createItemImages');
			Route::get('deleteItem/{id}','Items@deleteItem');
			Route::get('deleteManyItems/{ids}','Items@deleteManyItems');
			Route::get('removedFile/{id}','Items@removedFile');
			Route::get('getSizes/{sub_cat_id}','Items@getSizes');
		});





	});
});


