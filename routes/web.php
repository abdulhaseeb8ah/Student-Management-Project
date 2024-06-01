<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

Route::get('/sidebar-items/{role}', [SidebarController::class, 'getSidebarItems'])->name('sidebar.items');

Route::get('/admin/{pageName}', [AdminController::class, 'loadPage']);
Route::get('/faculty/{pageName}', [FacultyController::class, 'loadPage']);
Route::get('/student/{pageName}', [StudentController::class, 'loadPage']);

Route::get('/dashboard', function () {
    $role = session('role');
    return view('dashboard', compact('role'));
})->middleware('auth');

Route::get('/admin/RegistrationRequest', 'AdminController@index');
Route::post('/admin/ProcessRequest', [AdminController::class, 'processRequest']);
Route::post('/admin/UserStatus', [AdminController::class, 'UserStatus']);
Route::post('/admin/showUsersStatus', [AdminController::class, 'showUsersStatus']);

Route::post('/admin/AddCourse', [CourseController::class, 'store']);
Route::post('/admin/AssignCourse', [CourseController::class, 'assign']);

Route::middleware('auth')->group(function () {
    Route::post('/faculty/getstudents', [MarksController::class, 'getStudents'])->name('get-students');
    Route::post('/faculty/uploadmarks', [MarksController::class, 'uploadMarks'])->name('upload-marks');
});
Route::get('/student/viewMarks', [MarksController::class, 'viewMarks']);
Route::post('/student/registerCourse', [CourseController::class, 'registerCourse']);

Route::post('/faculty/getstudents', [AttendanceController::class, 'getStudents'])->name('get.students');
Route::post('/faculty/uploadattendance', [AttendanceController::class, 'uploadAttendance'])->name('upload.attendance.post');

Route::post('/student/viewAttendance', [AttendanceController::class, 'viewAttendance']);