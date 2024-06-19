<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::get('/', function () {
//     return view('welcome');
// });

//Login
Route::get('/', [LoginController::class, 'index'])->name('login.index');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//Usuários
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}/password', [UserController::class, 'editPassword'])->name('users.edit.password');
Route::put('/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.update.password');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Cursos
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

// Aulas
Route::get('/lessons/{course}', [LessonController::class, 'index'])->name('lessons.index');
Route::get('/lessons/{course}/create', [LessonController::class, 'create'])->name('lessons.create');
Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
Route::get('/lessons-show/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');



