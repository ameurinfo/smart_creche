<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfilesController;

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
    return redirect('login');
}); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/profiles', [ProfilesController::class, 'show'])->name('profiles.show');
    Route::patch('/profiles/{id}', [ProfilesController::class, 'update'])->name('profiles.update');
    Route::patch('/profilesImage/{id}', [ProfilesController::class, 'updateImage'])->name('profiles.updateImage');

    Route::get('/video-chat', function () {
        $active_menu = '';
        $active_supmenu = '';
        return view('videoChat.index',compact('active_menu','active_supmenu'));
    })->name('video-chat');
    // roles routes
    Route::resource('roles', RoleController::class);

    // users routes
    Route::post('parents/storeAjax', [UserController::class, 'newParent'])->name('parents.storeAjax');
    Route::resource('users', UserController::class);

    // children routes
    Route::get('/children/meals', [ChildrenController::class, 'createMeals'])->name('children.createMeals');
    Route::post('/children/meals', [ChildrenController::class, 'storeMeals'])->name('children.storeMeals');
    
    Route::get('/children/psychologyfollowup', [ChildrenController::class, 'indexPsychologyFollowUp'])->name('children.indexPsychologyFollowUp');
    Route::get('/children/psychologyfollowup/{id}', [ChildrenController::class, 'showPsychologyFollowUp'])->name('children.showPsychologyFollowUp');
    Route::get('/children/psychologyfollowup/create/{id}', [ChildrenController::class, 'createPsychologyFollowUp'])->name('children.createPsychologyFollowUp');
    Route::post('/children/psychologyfollowup/{id}', [ChildrenController::class, 'storePsychologyFollowUp'])->name('children.storePsychologyFollowUp');
    
    Route::get('/children/behaviormodification', [ChildrenController::class, 'indexBehaviorModification'])->name('children.indexBehaviorModification');
    Route::get('/children/behaviormodification/{id}', [ChildrenController::class, 'showBehaviorModification'])->name('children.showBehaviorModification');
    Route::get('/children/behaviormodification/create/{id}', [ChildrenController::class, 'createBehaviorModification'])->name('children.createBehaviorModification');
    Route::post('/children/behaviormodification/{id}', [ChildrenController::class, 'storeBehaviorModification'])->name('children.storeBehaviorModification');
    
    Route::get('/children/cumulativerecord', [ChildrenController::class, 'indexCumulativeRecord'])->name('children.indexCumulativeRecord');
    Route::get('/children/cumulativerecord/{id}', [ChildrenController::class, 'showCumulativeRecord'])->name('children.showCumulativeRecord');
    Route::get('/children/cumulativerecord/create/{id}', [ChildrenController::class, 'createCumulativeRecord'])->name('children.createCumulativeRecord');
    Route::post('/children/cumulativerecord/{id}', [ChildrenController::class, 'storeCumulativeRecord'])->name('children.storeCumulativeRecord');
    
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

    Route::resource('staff', StaffController::class);

    // notifications routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/markAsRead/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});

/* Route::get('/video-chat', [VideoChatController::class,'index'])->name('video-chat');
Route::post('/token', [VideoChatController::class,'generateToken'])->name('token');
 */

require __DIR__.'/auth.php';
