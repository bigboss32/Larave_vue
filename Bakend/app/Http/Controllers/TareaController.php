<?php

namespace App\Http\Controllers;
use App\Models\Proyecto;
use App\Models\Tarea;


use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function crearTarea(Request $request)
    {
        // Buscar el proyecto por su ID
      
        $proyecto = $request->input('proyecto_id');
        $proyecto = Proyecto::findOrFail($proyecto);

        // Crear una nueva instancia de Tarea y asignar los valores del Request
        $tarea = new Tarea();
        $tarea->título = $request->input('título');
        $tarea->descripción = $request->input('descripción');

        // Guardar la tarea en el proyecto
        $proyecto->tareas()->save($tarea);

        return response()->json(['message' => 'Tarea creada exitosamente']);
    }

    public function actualizarTarea(Request $request, $tareaId)
{
    // Buscar la tarea por su ID
    $tarea = Tarea::findOrFail($tareaId);

    // Actualizar los campos de la tarea con los datos del Request
    $tarea->título = $request->input('título');
    $tarea->descripción = $request->input('descripción');

    // Guardar los cambios en la base de datos
    $tarea->save();

    return response()->json(['message' => 'Tarea actualizada exitosamente']);
}
public function eliminartarea( $tareaId)
{
    $existen= Tarea::find($tareaId);
                
    if(isset($existen)){
       
       $respuesta= Tarea::destroy($tareaId);
        if($respuesta){
            return response()->json([
                'data'=>$existen,
                'mensaage'=>'fue eliminado',


            ]);
        }
    }else{
        return response()->json([
            'error'=>true,
            'mensaage'=>'no existe',


        ]);
    }
}
}

