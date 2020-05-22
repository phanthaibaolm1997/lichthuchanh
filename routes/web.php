<?php

use Illuminate\Support\Facades\Route;


// Public Router
Route::get('/home', 'IndexController@goBackHome')->name('backhome');
Route::get('/', 'IndexController@getIndex')->name('home');
Route::get('/login-admin', 'LoginController@getLoginAdmin')->name('login');
Route::post('/login-admin', 'LoginController@postLoginAdmin')->name('admin.login.post');
 Route::get('logout/', 'LoginController@logout')->name('logout');

//Cán bộ Router
Route::group(['prefix'=>'can-bo'],function(){
	Route::get('/dang-ky-lich', 'IndexController@getDKL')->name('canbo.dangkylich');
	Route::post('/dang-ky-lich', 'IndexController@postDKL')->name('dangkylich');
	Route::get('/quan-ly-dang-ky', 'IndexController@getQLDK')->name('canbo.quanlydk');
	Route::post('/update-messenger', 'IndexController@postMessenger')->name('canbo.messenger');
	Route::get('/delete-tkb', 'IndexController@deleteTKB')->name('canbo.tkb.delete');
});
//Admin Router
Route::group(['prefix'=>'admin'],function(){
	Route::get('/', 'AdminController@getIndex')->name('admin');
	Route::get('/auto', 'SapLichController@autoScheduling');
	Route::get('/thoi-khoa-bieu', 'AdminController@getTKBAdmin')->name('admin.thoikhoabieu');
	Route::post('/change-lich', 'AdminController@postChangeLich')->name('admin.changelich');
	Route::group(['prefix'=>'hoc-phan'],function(){
		Route::get('/', 'AdminController@getHocPhan')->name('admin.hocphan');
		Route::post('/add-lhp', 'AdminController@postLHP')->name('admin.post.dangkylophocphan');
		Route::post('/edit-lhp', 'AdminController@editLHP')->name('admin.edit.lophocphan');
		Route::get('/delete-lhp/{cb_id}/{hp_id}/{namhoc}/{hocky}/{sttl}', 'AdminController@deleteLHP')->name('admin.delete.lophocphan');
		Route::post('/add-hp', 'AdminController@postHP')->name('admin.post.hocphan');
		Route::post('/edit-hp', 'AdminController@editHP')->name('admin.edit.hocphan');
		Route::get('/delete-hp/{id}', 'AdminController@deleteHP')->name('admin.delete.hocphan');
	});
	
	Route::group(['prefix'=>'phan-mem'],function(){
		Route::get('/', 'AdminController@getPhanMem')->name('admin.phanmem');
		Route::post('/', 'AdminController@postPhanMem')->name('admin.phanmem.add');
		Route::post('/version', 'AdminController@postPhanMemVer')->name('admin.phanmemversion.add');
		Route::post('/edit', 'AdminController@postPhanMemEdit')->name('admin.phanmem.edit');
		Route::get('/delete/{pm_id}', 'AdminController@delPhanMem')->name('admin.phanmem.delete');
		Route::get('/delete-version/{pm_id}/{ver_ma}', 'AdminController@delPhanMemVersion')->name('admin.phanmemversion.delete');
	});

	Route::group(['prefix'=>'phong'],function(){
		Route::get('/', 'AdminController@getPhong')->name('admin.phong');
		Route::get('/{id}', 'AdminController@getDetailPhong')->name('admin.phong.detail');
		Route::post('/', 'AdminController@postPhong')->name('admin.phong.add');
		Route::post('/edit', 'AdminController@editPhong')->name('admin.phong.edit');
		Route::post('/add-software', 'AdminController@addSoftware')->name('admin.phongdetail.add');
		Route::get('/delete-software/{phong}/{version}/{phanmem}', 'AdminController@delSoftware');
	});
	Route::group(['prefix'=>'ajax'],function(){
		Route::get('/get-version', 'AdminController@ajaxGetVersion');
	});
	Route::group(['prefix'=>'can-bo'],function(){
		Route::get('/', 'AdminController@getCanBo')->name('admin.canbo');
		Route::post('/', 'AdminController@postCanBo')->name('admin.canbo.add');
		Route::post('/edit', 'AdminController@editCanBo')->name('admin.canbo.edit');
		Route::post('/change-pwd', 'AdminController@changePWD')->name('admin.canbo.changepwd');
		Route::get('/delete-cb/{id}', 'AdminController@deleteCB');
	});
	
});

