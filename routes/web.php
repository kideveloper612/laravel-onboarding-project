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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


//User Route
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
Route::resource('user', 'UserController');
Route::resource('build', 'BuildController');

Route::put('/formEdit/{user}', 'UserController@update') -> name('formEdit');
Route::get('/formBuild', 'BuildController@index') -> name('formBuild');
Route::post('/formSave', 'BuildController@store') -> name('formSave');