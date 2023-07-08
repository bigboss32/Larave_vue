<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\Tarea;
class ProyectoController extends Controller
{
    public function index()
    {
        return Proyecto::all();
    }

    public function store(Request $request){
        $inputs=$request->input();
        $respuesta= Proyecto::create($inputs);
        return $respuesta;
    }

    public function show($id){
        $existen= Proyecto::find($id);
        if(isset($existen)){
            return response()->json([
                'data'=>$existen,
                'mensaage'=>'en contrado',


            ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'mensaage'=>'no existe',
    
    
                ]);
            }}



    public function update(Request $request, $id){
       
       $existen= Proyecto::find($id);
       
        if(isset($existen)){
            $existen->título=$request->título;
            $existen->descripción=$request->descripción;
        
            if($existen->save()){
                return response()->json([
                    'data'=>$existen,
                    'mensaage'=>'actualizado',
    
    
                ]);
            }
        }else{
            return response()->json([
                'error'=>true,
                'mensaage'=>'no existe',


            ]);
        }
        
            }

            public function destroy($id){
       
                $existen= Proyecto::find($id);
                
                 if(isset($existen)){
                    
                    $respuesta= Proyecto::destroy($id);
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

                     public function asignarProyecto(Request $request)
                     {
                      
                         $userId = $request->input('user_id');
                         $proyectoId = $request->input('proyecto_id');
                         $rol = $request->input('rol');
                 
                         $user = User::find($userId);
                         $proyecto = Proyecto::find($proyectoId);
                 
                         // Asignar el proyecto al usuario en la tabla pivote
                         $user->proyectos()->attach($proyecto, ['rol' => $rol]);
                 
                         return response()->json(['message' => 'Proyecto asignado al usuario exitosamente']);
                     }

                     public function obtenerUsuariosProyecto( $id_user)
                     {
                         
                         $proyecto = Proyecto::findOrFail($id_user);
                         $user = $proyecto->user;
                 
                         return response()->json($user);
                     }

                     public function obtenerTareas($id_proyecto)
                     {

                        
                        if (!Proyecto::where('id', $id_proyecto)->exists()) {
                            return response()->json(['message' => 'Proyecto no encontrado'], 404);
                        }

                        
                         $proyecto = Proyecto::findOrFail($id_proyecto);
                         $tareas = $proyecto->tareas;
                 
                         return response()->json($tareas);
                     }
                     public function elminarusariodeunrpoyceto($id_user,$id_proyecto){
                        // Obtener el proyecto y el usuario específicos
                            $proyecto = Proyecto::find($id_proyecto);
                            $user = User::find($id_user);

                            // Verificar si el proyecto y el usuario existen
                            if ($proyecto && $user) {
                                // Eliminar la relación entre el usuario y el proyecto
                                $proyecto->user()->detach($user->id);

                                // Realizar otras operaciones o retornar una respuesta exitosa
                                return response()->json(['message' => 'La relación se ha eliminado correctamente'], 200);
                            } else {
                                // Retornar una respuesta de error si el proyecto o el usuario no existen
                                return response()->json(['message' => 'El proyecto o el usuario no existen'], 404);
                            }
                     }


}
