<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* ROLES */
Route::get('role', [RoleController::class, 'get']);

/* AREAS */
Route::get('area', [AreaController::class, 'get']);
Route::get('area/{areaId}', [AreaController::class, 'getById']);
Route::post('area', [AreaController::class, 'create']);
Route::put('area/{areaId}', [AreaController::class, 'update']);
Route::delete('area/{areaId}', [AreaController::class, 'delete']);

/* FIELDS */
Route::get('field', [FieldController::class, 'get']);
Route::get('field/{fieldId}', [FieldController::class, 'getById']);
Route::post('field', [FieldController::class, 'create']);
Route::put('field/{fieldId}', [FieldController::class, 'update']);
Route::delete('field/{fieldId}', [FieldController::class, 'delete']);

/* USERS */
Route::get('user', [UserController::class, 'get']);
Route::get('user/{userId}', [UserController::class, 'getById']);
Route::post('user', [UserController::class, 'create']);
Route::put('user/{userId}', [UserController::class, 'update']);
Route::delete('user/{userId}', [UserController::class, 'delete']);
