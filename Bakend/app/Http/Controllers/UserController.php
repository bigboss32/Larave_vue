<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Hash;
use \stdClass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $existen= User::find($id);
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
            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $existen= User::find($id);
       
        if(isset($existen)){
            $existen->name=$request->name;
            $existen->email=$request->email;
            $existen->password=Hash::make($request->password);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $existen= User::find($id);
                
        if(isset($existen)){
           
           $respuesta= User::destroy($id);
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

    public function obtenerProyectosUsuario($id_proyecto)
    {
       
        $user = User::findOrFail($id_proyecto);
        $proyectos = $user->proyectos()->withPivot('rol')->get();
    
        return response()->json($proyectos);
    }

}
