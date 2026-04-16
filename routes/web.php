<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
=======
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route; Use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\logincontroller;

route::get('/listbarang/{id}/{nama}', [ListBarangController::class, 'tampilkan']);
route::get('/dashboard', [DashboardController::class, 'index']);
route::get('/login', [logincontroller::class, 'index']);

route::prefix('admin')->group (function () {
    Route::get('/dashboard', function () {
        return 'Dashboard Admin';
    });
    Route::get('/users', function () {
        return 'Admin users';
});
});

Route::get('/user/{id}', function ($id) {
return 'User dengan ID' . $id;
});
Route::get('/welcome', function () {
return view('welcome');
});

Route::get('/', [HomeController::class, 'index']); Route::get('/contact', [HomeController::class, 'contact']);
>>>>>>> 531705cc4511e78551d08d553492eff02c759fcf
