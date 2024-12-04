<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Menggunakan Auth bawaan dari template Laravel Jetstream
Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
// Menggunakan Auth bawaan dari template Laravel Jetstream

// Route Company dan anak route nya hanya bisa diakses oleh User dengan Role Superadmin
    Route::get('/company/{contains?}', function (Request $request, $contains = null){
        return view('company-layout', ['contains' => $contains]);
    })->name('company')->middleware(RoleMiddleware::class.':Superadmin');
// Route Company dan anak route nya hanya bisa diakses oleh User dengan Role Superadmin

// Route Employee dan anak route nya hanya bisa diakses oleh User dengan Role Superadmin 
    Route::prefix('/employee')->group(function () {
        Route::get('/', function () {
            return view('employee-layout');
        })->name('employee')->middleware(RoleMiddleware::class.':Superadmin');
        Route::get('/transfer', function () {
            return view('employee-layout', ['submenu' => 'Employee Transfer']);
        })->name('employee transfer')->middleware(RoleMiddleware::class.':Superadmin');
    });
// Route Employee dan anak route nya hanya bisa diakses oleh User dengan Role Superadmin

// Route approval line dan anak route nya hanya bisa diakses oleh User dengan Role Superadmin
    Route::prefix('/approval-line')->group(function () {
        Route::get('/', function () {
            return view('approval-line-layout');
        })->name('approval line')->middleware(RoleMiddleware::class.':Superadmin');
    });
// Route approval line dan anak route nya hanya bisa diakses oleh User dengan Role Superadmin

    Route::prefix('/FPK')->group(function () {
       Route::get('/', function () {
            return view('fpk-layout');
       })->name('FPK Main')->middleware(RoleMiddleware::class.':Superadmin,HR,Employee'); // Role Kandidat tidak boleh mengakses FPK
       
       Route::get('/form/{cursorId?}', function (?int $cursorId = null) {
            return view('fpk-layout', ['submenu' => 'FPK Submission', 'cursorId' => $cursorId]);
       })->name('FPK Submission')->middleware(RoleMiddleware::class.':HR'); // Hanya HR Unit yang boleh mengajukan, mengedit, dan menghapus FPK
    });

});
