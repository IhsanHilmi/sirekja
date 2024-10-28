<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/company/{contains?}', function (Request $request, $contains = null){
        return view('company-layout', ['contains' => $contains]);
    })->name('company');

    Route::prefix('/employee')->group(function () {
        
        Route::get('/', function () {
            return view('employee-layout');
        })->name('employee');

        Route::get('/transfer', function () {
            return view('employee-layout', ['submenu' => 'Employee Transfer']);
        })->name('employee transfer');

    });

    Route::prefix('/approval-line')->group(function () {
        Route::get('/', function () {
            return view('approval-line-layout');
        })->name('approval line');
    });

    Route::prefix('/FPK')->group(function () {
       Route::get('/', function () {
            return view('fpk-layout');
       })->name('FPK Main');
       Route::get('/form/{cursorId?}', function (?int $cursorId = null) {
            return view('fpk-layout', ['submenu' => 'FPK Submission', 'cursorId' => $cursorId]);
       })->name('FPK Submission');
    });
});
