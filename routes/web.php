<?php

// Landing Page
Route::view('/', 'welcome');

// Dashboard
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// Profile & Settings
Route::get('/profile', 'ProfileController@index')->name('profile')->middleware('auth');
Route::post('/personal-details', 'ProfileController@updatePersonalDetail')->name('profile.personal-details')->middleware('auth');
Route::post('/change-password', 'ProfileController@changePassword')->name('profile.change-password')->middleware('auth');

// Expenses
Route::get('expenses', 'ExpensesController@index')->name('expenses.index')->middleware('auth');
Route::get('expenses-partial', 'ExpensesController@expensesIndex')->middleware('auth');
Route::get('expenses/create', 'ExpensesController@create')->name('expenses.create')->middleware('auth');
Route::post('expenses', 'ExpensesController@store')->name('expenses.store')->middleware('auth');
Route::get('expenses/{expense}', 'ExpensesController@show')->name('expenses.show')->middleware('auth');
Route::get('expenses/{expense}/edit', 'ExpensesController@edit')->name('expenses.edit')->middleware('auth');
Route::post('expenses/{expense}', 'ExpensesController@update')->name('expenses.update')->middleware('auth');
Route::delete('expenses', 'ExpensesController@destroy')->name('expenses.delete')->middleware('auth');

// Categories
Route::get('categories', 'CategoriesController@index')->name('categories.index')->middleware('auth');
Route::post('categories', 'CategoriesController@store')->name('categories.store')->middleware('auth');
Route::put('categories/{category}', 'CategoriesController@update')->name('categories.update')->middleware('auth');
Route::delete('categories', 'CategoriesController@destroy')->name('categories.delete')->middleware('auth');

// Reports
Route::get('/reports', 'ReportsController@index')->name('reports.index')->middleware('auth');

Auth::routes();
