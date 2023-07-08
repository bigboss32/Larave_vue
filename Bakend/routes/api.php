<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\TareaController;

Route::post('v1/iniciar-sesion', [AuthController::class, 'login']);


    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource("v1/usuarios", UserController::class)->except(['create', 'edit']);
       
        Route::post("v1/asignarProyecto", [ProyectoController::class,'asignarProyecto']);
        Route::get("v1/obtenerUsuariosProyecto/{id_proyecto}", [ProyectoController::class,'obtenerUsuariosProyecto']);
        Route::get("v1/obtenerTareas/{id_proyecto}", [ProyectoController::class,'obtenerTareas']);
        Route::delete("v1/elminarusariodeunrpoyceto/{userId}/{proyectoId}", [ProyectoController::class,'elminarusariodeunrpoyceto']);
    
    
        Route::get("v1/obtenerProyectosUsuario/{id_user}", [UserController::class,'obtenerProyectosUsuario']);
        Route::post("v1/crearTarea", [TareaController::class,'crearTarea']);
        Route::delete("v1/eliminartarea/{tareaId}", [TareaController::class,'eliminartarea']);
        Route::put('v1/actualizarTarea/{tareaId}', [TareaController::class, 'actualizarTarea']);
        Route::apiResource("v1/proyecto", ProyectoController::class);
        Route::get('/v1/logout', [AuthController::class, 'cerrarSesion']);
    });