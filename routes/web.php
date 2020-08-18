<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes();


//User Route
Route::get('', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/formselect', 'HomeController@formselect')->name('formselect');
Route::post('/sectionSelect', 'SectionController@show') -> name('sectionSelect');
Route::post('/sectionStore', 'SectionController@store') -> name('sectionStore');
// Route::get('/dashboard', 'DashboardController@show') -> name('dashboard');
Route::get('/dashboard', 'HomeController@index') -> name('dashboard');



/**
 *Admin Route
 */
//Destroy submission
Route::delete('/home/delete/{id}', 'HomeController@destroy');
Route::get('/usermanagement', 'UserController@index') -> name('usermanagement');
Route::get('/userEditData/{id}', 'UserController@show');
Route::patch('/formUpdate/{post}', 'UserController@userUpdate');
Route::delete('/user/delete/{id}', 'UserController@destroy');
Route::resource('phones', 'PhoneController');
Route::resource('user', 'UserController');
Route::resource('build', 'BuildController');

Route::get('/readphone', 'PhoneController@show') -> name('readphone');
Route::post('/addphone', 'PhoneController@create') -> name('addphone');
Route::patch('/updatephone', 'PhoneController@update') -> name('updatephone');
Route::delete('/deletephone', 'PhoneController@destroy') -> name('deletephone');

Route::put('/formEdit/{user}', 'UserController@update') -> name('formEdit');
Route::get('/formBuild', 'BuildController@index') -> name('formBuild');
Route::post('/formSave', 'BuildController@store') -> name('formSave');

Route::post('/linksave', 'DashboardController@Link') -> name('linksave');
Route::post('/addlinksave', 'DashboardController@AddLink') -> name('addlinksave');
Route::get('/linkremovelist', 'DashboardController@linkRemoveList') -> name('linkremovelist');
Route::post('/linkremove', 'DashboardController@linkRemove') -> name('linkremove');
Route::get('/export/excel', 'DashboardController@exportExcel') -> name('export.excel');

Route::get('/usersort', 'DashboardController@userSortting') -> name('usersort');

