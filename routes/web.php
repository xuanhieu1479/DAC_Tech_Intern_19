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

// Route::view('/', 'home');

Route::view('/', 'home');

Route::get('/login', 'loginController@showLogin');

Route::post('/login', 'loginController@doLogin');

Route::get('/logout', 'logoutController@doLogout');

Route::view('/profile', 'profile');

Route::post('/add_product', 'addProductController@addProduct');

Route::post('/create_group', 'createGroupController@createGroup');

Route::view('/group', 'group');

Route::get('/group?name={group_name}', function() {
    return view('group');
});

Route::post('/update_leader', 'updateGroupController@updateLeader');

Route::post('/add_member', 'updateGroupController@addMember');

Route::post('/remove_member', 'updateGroupController@removeMember');

Auth::routes();
