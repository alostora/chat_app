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
			Route::get('adminInfo','Admins@adminInfo')->middleware('permissions:Admin,view');
			Route::get('viewCreateAdmin/{id?}','Admins@viewCreateAdmin')->middleware('permissions:Admin,create');
			Route::post('createAdmin','Admins@createAdmin')->middleware('permissions:Admin,create');
			Route::get('deleteAdmin/{id}','Admins@deleteAdmin')->middleware('permissions:Admin,delete');
			Route::get('deleteManyAdmins/{ids}','Admins@deleteManyAdmins')->middleware('permissions:Admin,delete');
			
		});
		
		//permissions
		Route::group(['prefix'=>'Permission'],function(){
			Route::get('permissionsInfo','Permissions@permissionsInfo')->middleware('permissions:Permission,view');
			Route::get('viewCreatePermission/{id?}','Permissions@viewCreatePermission')->middleware('permissions:Permission,create');
			Route::post('createPermission','Permissions@createPermission')->middleware('permissions:Permission,create');
			Route::get('deletePermission/{id}','Permissions@deletePermission')->middleware('permissions:Permission,delete');
			Route::get('deleteManyPermission/{id}','Permissions@deleteManyPermission')->middleware('permissions:Permission,delete');
		
		});

		//roles
		Route::group(['prefix'=>'Role'],function(){
			Route::get('rolesInfo','Roles@rolesInfo')->middleware('permissions:Role,view');
			Route::get('viewCreateRole/{id?}','Roles@viewCreateRole')->middleware('permissions:Role,create');
			Route::post('createRole','Roles@createRole')->middleware('permissions:Role,create');
			Route::get('deleteRole/{id}','Roles@deleteRole')->middleware('permissions:Role,delete');
			Route::get('deleteManyRole/{id}','Roles@deleteManyRole')->middleware('permissions:Role,delete');
		
		});


		//users
		Route::group(['prefix'=>'User'],function(){
			Route::get('userInfo','Users@userInfo')->middleware('permissions:User,view');
			Route::get('viewCreateUser/{id?}','Users@viewCreateUser')->middleware('permissions:User,create');
			Route::post('createUser','Users@createUser')->middleware('permissions:User,create');
			Route::get('deleteUser/{id}','Users@deleteUser')->middleware('permissions:User,delete');
			Route::get('deleteManyUsers/{ids}','Users@deleteManyUsers')->middleware('permissions:User,delete');
		});


		//vendros
		Route::group(['prefix'=>'Vendor'],function(){
			Route::get('vendorInfo','Vendors@vendorInfo')->middleware('permissions:Vendor,view');
			Route::get('viewCreateVendor/{id?}','Vendors@viewCreateVendor')->middleware('permissions:Vendor,create');
			Route::post('createVendor','Vendors@createVendor')->middleware('permissions:Vendor,create');
			Route::get('deleteVendor/{id}','Vendors@deleteVendor')->middleware('permissions:Vendor,delete');
			Route::get('deleteManyVendors/{ids}','Vendors@deleteManyVendors')->middleware('permissions:Vendor,delete');
		});


		//main types
		Route::group(['prefix'=>'Main_type'],function(){
			Route::get('mainTypesInfo','MainTypes@mainTypesInfo')->middleware('permissions:Main_type,view');
			Route::get('viewCreateMainType/{id?}','MainTypes@viewCreateMainType')->middleware('permissions:Main_type,create');
			Route::post('createMainType','MainTypes@createMainType')->middleware('permissions:Main_type,create');
			Route::get('deleteMainType/{id}','MainTypes@deleteMainType')->middleware('permissions:Main_type,delete');
			Route::get('deleteManyMainTypes/{ids}','MainTypes@deleteManyMainTypes')->middleware('permissions:Main_type,delete');
		});


		//sizes
		Route::group(['prefix'=>'Size'],function(){
			Route::get('sizesInfo','Sizes@sizesInfo')->middleware('permissions:Size,view');
			Route::get('viewCreateSize/{id?}','Sizes@viewCreateSize')->middleware('permissions:Size,create');
			Route::post('createSize','Sizes@createSize')->middleware('permissions:Size,create');
			Route::get('deleteSize/{id}','Sizes@deleteSize')->middleware('permissions:Size,delete');
			Route::get('deleteManySizes/{ids}','Sizes@deleteManySizes')->middleware('permissions:Size,delete');
		});


		//measur_unets
		Route::group(['prefix'=>'Measur_unit'],function(){
			Route::get('measurUnitsInfo','MeasurUnits@measurUnitsInfo')->middleware('permissions:Measur_unit,view');
			Route::get('viewCreateMeasurUnit/{id?}','MeasurUnits@viewCreateMeasurUnit')->middleware('permissions:Measur_unit,create');
			Route::post('createMeasurUnit','MeasurUnits@createMeasurUnit')->middleware('permissions:Measur_unit,create');
			Route::get('deleteMeasurUnit/{id}','MeasurUnits@deleteMeasurUnit')->middleware('permissions:Measur_unit,delete');
			Route::get('deleteManyMeasurUnits/{ids}','MeasurUnits@deleteManyMeasurUnits')->middleware('permissions:Measur_unit,delete');
		});




		//categories
		Route::group(['prefix'=>'Category'],function(){
			Route::get('categoriesInfo','Categories@categoriesInfo')->middleware('permissions:Category,view');
			Route::get('viewCreateCategory/{id?}','Categories@viewCreateCategory')->middleware('permissions:Category,create');
			Route::post('createCategory','Categories@createCategory')->middleware('permissions:Category,create');
			Route::get('deleteCategory/{id}','Categories@deleteCategory')->middleware('permissions:Category,delete');
			Route::get('deleteManyCategories/{ids}','Categories@deleteManyCategories')->middleware('permissions:Category,delete');
		});


		//sub categories
		Route::group(['prefix'=>'S_category'],function(){
			Route::get('s_categoriesInfo','S_categories@s_categoriesInfo')->middleware('permissions:S_category,view');
			Route::get('viewCreateS_category/{id?}','S_categories@viewCreateS_category')->middleware('permissions:S_category,create');
			Route::post('createS_category','S_categories@createS_category')->middleware('permissions:S_category,create');
			Route::get('deleteS_category/{id}','S_categories@deleteS_category')->middleware('permissions:S_category,delete');
			Route::get('deleteManyS_categories/{ids}','S_categories@deleteManyS_categories')->middleware('permissions:S_category,delete');
		});
		

		//generalSetting
		Route::group(['prefix'=>'Setting'],function(){
			Route::get('generalSetting','Settings@generalSetting')->middleware('permissions:Setting,view');
			Route::get('viewCreateSetting/{id?}','Settings@viewCreateSetting')->middleware('permissions:Setting,create');
			Route::post('createSetting','Settings@createSetting')->middleware('permissions:Setting,create');
			Route::get('deleteSetting/{id}','Settings@deleteSetting')->middleware('permissions:Setting,delete');
			Route::get('deleteManySettings/{ids}','Settings@deleteManySettings')->middleware('permissions:Setting,delete');
		});


		//countries
		Route::group(['prefix'=>'Country'],function(){
			Route::get('countriesInfo','Countries@countriesInfo')->middleware('permissions:Country,view');
			Route::get('viewCreateCountry/{id?}','Countries@viewCreateCountry')->middleware('permissions:Country,create');
			Route::post('createCountry','Countries@createCountry')->middleware('permissions:Country,create');
			Route::get('deleteCountry/{id}','Countries@deleteCountry')->middleware('permissions:Country,delete');
			Route::get('deleteManyCountries/{ids}','Countries@deleteManyCountries')->middleware('permissions:Country,delete');
		});


		//cities
		Route::group(['prefix'=>'City'],function(){
			Route::get('citiesInfo','Cities@citiesInfo')->middleware('permissions:City,view');
			Route::get('viewCreateCity/{id?}','Cities@viewCreateCity')->middleware('permissions:City,create');
			Route::post('createCity','Cities@createCity')->middleware('permissions:City,create');
			Route::get('deleteCity/{id}','Cities@deleteCity')->middleware('permissions:City,delete');
			Route::get('deleteManyCities/{ids}','Cities@deleteManyCities')->middleware('permissions:City,delete');
		});


		//stats
		Route::group(['prefix'=>'State'],function(){
			Route::get('statesInfo','States@statesInfo')->middleware('permissions:State,view');
			Route::get('viewCreateState/{id?}','States@viewCreateState')->middleware('permissions:State,create');
			Route::post('createState','States@createState')->middleware('permissions:State,create');
			Route::get('deleteState/{id}','States@deleteState')->middleware('permissions:State,delete');
			Route::get('deleteManyStates/{ids}','States@deleteManyStates')->middleware('permissions:State,delete');
			//cities //without middleware ajax request
			Route::get('getCities/{city_id}','States@getCities');
		});


		//brands
		Route::group(['prefix'=>'Brand'],function(){
			Route::get('brandsInfo','Brands@brandsInfo')->middleware('permissions:Brand,view');
			Route::get('viewCreateBrand/{id?}','Brands@viewCreateBrand')->middleware('permissions:Brand,create');
			Route::post('createBrand','Brands@createBrand')->middleware('permissions:Brand,create');
			Route::get('deleteBrand/{id}','Brands@deleteBrand')->middleware('permissions:Brand,delete');
			Route::get('deleteManyBrands/{ids}','Brands@deleteManyBrands')->middleware('permissions:Brand,delete');
		});


		//colors
		Route::group(['prefix'=>'Color'],function(){
			Route::get('colorsInfo','Colors@colorsInfo')->middleware('permissions:Color,view');
			Route::get('viewCreateColor/{id?}','Colors@viewCreateColor')->middleware('permissions:Color,create');
			Route::post('createColor','Colors@createColor')->middleware('permissions:Color,create');
			Route::get('deleteColor/{id}','Colors@deleteColor')->middleware('permissions:Color,delete');
			Route::get('deleteManyColors/{ids}','Colors@deleteManyColors')->middleware('permissions:Color,delete');
		});


		//items
		Route::group(['prefix'=>'Item'],function(){
			Route::get('itemsInfo','Items@itemsInfo')->middleware('permissions:Item,view');
			Route::get('viewCreateItem/{id?}','Items@viewCreateItem')->middleware('permissions:Item,create');
			Route::post('createItem','Items@createItem')->middleware('permissions:Item,create');
			Route::get('deleteItem/{id}','Items@deleteItem')->middleware('permissions:Item,delete');
			Route::get('deleteManyItems/{ids}','Items@deleteManyItems')->middleware('permissions:Item,delete');
			//item_images
			Route::post('createItemImages','Items@createItemImages')->middleware('permissions:Item_image,create');
			Route::get('removedFile/{id}','Items@removedFile')->middleware('permissions:Item_image,delete');
			//sizes //without middleware ajax request
			Route::get('getSizes/{sub_cat_id}','Items@getSizes');
		});





	});
});


