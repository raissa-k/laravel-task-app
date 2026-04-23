<?php

use App\Http\Controllers\Api\TaskApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskApiController::class, 'index']);
Route::get('/tasks', [TaskApiController::class, 'index']);
Route::get('/tasks/{task}', [TaskApiController::class, 'show']);
