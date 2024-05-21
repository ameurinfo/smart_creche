<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StaffController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/children/meals', [ChildrenController::class, 'createMeals'])->name('children.createMeals');
Route::post('/children/meals', [ChildrenController::class, 'storeMeals'])->name('children.storeMeals');
Route::get('/children/sleep', [ChildrenController::class, 'createSleep'])->name('children.createSleep');
Route::post('/children/sleep', [ChildrenController::class, 'storeSleep'])->name('children.storeSleep');
Route::resource('children',ChildrenController::class);

// Attendance routes
Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store'); 
Route::get('/attendance/departure', [AttendanceController::class, 'showDepartureForm'])->name('attendance.departure.form');
Route::post('/attendance/departure', [AttendanceController::class, 'storeDeparture'])->name('attendance.departure');
Route::get('/attendance/tracking', [AttendanceController::class, 'tracking'])->name('attendance.tracking');
Route::get('/export-pdf', [AttendanceController::class, 'exportPdf'])->name('attendance.exportPdf');
//Route::get('/export-pdf/{student}/{year}', [AttendanceController::class, 'exportPdfCalendar'])->name('attendance.exportPdf');
Route::post('upload-image', [AttendanceController::class,'storageImage'])->name('attendance.storeimage');


// Staff routes
Route::resource('staff', StaffController::class);