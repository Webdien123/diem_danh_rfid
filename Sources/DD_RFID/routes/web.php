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
    return view('home');
})->name('home');

Route::get('login', function() {
    return view('login');
})->name('login');

Route::get('admin', function() {
    return view('admin');
})->name('admin');

Route::get('chart', function() {
    return view('sub_views.chart');
})->name('chart');

Route::get('event', function() {
    return view('sub_views.event');
})->name('event');

Route::get('student', function() {
    return view('sub_views.student');
})->name('student');

Route::get('staff', function() {
    return view('sub_views.staff');
})->name('staff');

Route::get('blade', function () {
    return view('orther_views.s');
});
