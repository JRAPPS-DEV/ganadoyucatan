<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Hash, Auth;
use App\Models\Persona;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class APIAuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|numeric|unique:persona,email_user|min:10',
            'password' => 'required']);
        
        $user = new Persona;
        $user->nombres = $request->name;
        $user->email_user = $request->email;
        $user->password = Hash::make($request->password);
        $user->rolid = '6';
        $user->datecreated =  date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->estado = '1'; //e($request->input('intEstado'));
        $user->foto = null;
        $user->save();
        $credentials = ['email_user' => $request->email, 'password' => $request->password];
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Error al generar token'], 401);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Error de autenticación', 'message' => $e->getMessage()], 500);
        }

        return response()->json(['token' => $token]);
    }
    public function login(Request $request){
        $rules = [
            'email' => 'required',
            'password' => 'required|min:6',
        ];
        $messages = [
            'email.required' => 'Cuenta erronea y requerida',
            'password.required' => 'Por favor escribe una contraseña',
            'password.min' => 'La contraseña debe contener al menos 6 caracteres',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $credentials = ['email_user' => $request->get('email'),'password' => $request->get('password'),
        ];
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                dd($token);
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }
            $userId = Auth::id();
            if (!$userId) {
                //dd("Error de autenticación: Usuario no encontrado o credenciales incorrectas.");
                return response()->json(['error' => 'Error de autenticación'], 500);
            }
            $currentDateTime = Carbon::now();
            Persona::where('idpersona', $userId)->update(['ult_vez' => $currentDateTime]);
        } catch (JWTException $e) {
            dd("JWT Error: " . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor', 'exception' => $e->getMessage()], 500);
        }
        
        return response()->json(compact('token'));
    }
    public function logout(Request $request){
        try {
            $token = JWTAuth::getToken();
            if (!$token) {
                return response()->json(['error' => 'Token no proporcionado'], 400);
            }

            JWTAuth::invalidate($token);
            return response()->json(['message' => 'Cierre de sesión exitoso']);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Fallo al cerrar sesión, intente nuevamente'], 500);
        }
    }
public function deleteAccount(Request $request) {
    try {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
        $user->delete();
        JWTAuth::invalidate(JWTAuth::parseToken());

        return response()->json(['message' => 'Cuenta eliminada correctamente'], 200);
    } catch (JWTException $e) {
        return response()->json(['error' => 'Error al cerrar sesión o eliminar cuenta'], 500);
    } catch (\Exception $e) {
        return response()->json(['error' => 'No se pudo eliminar la cuenta'], 500);
    }
}




}
