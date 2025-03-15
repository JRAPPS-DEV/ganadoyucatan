<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth;
use App\Models\Persona;
use Carbon\Carbon;
class ConnectController extends Controller
{   
    public function getLogin(){
        return view('index.login');
    }
    public function postLogin(Request $request){
        $rules = [
            'email' => 'required',
            'password' => 'required|min:6'
        ];
        $messages = [
            'email.required' => 'Numero  requerido',
            'password.required' => 'Por favor escriba una contrasena',
            'password.min' => 'La contrasena debe contener al menos 6 caracteres'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producdio un error')->with('typealert', 'danger');
        else:   

        if (Auth::attempt(['email_user' => $request->input('email'), 'password' => $request->input('password')])) {
            $userId = Auth::id();
            $currentDateTime = Carbon::now();
            Persona::where('idpersona', $userId)->update(['ult_vez' => $currentDateTime]);
            return redirect('/admin/products/home');
        } else {
            return back()->with('message', 'Usuario o contraseña incorrecta')->with('typealert', 'danger');
        }  
        endif;
    }
    public function getLogout(){
        Auth::logout();
        return redirect('/');
    }
    public function getRegister(){
        return view('index.register');
    }
    public function postRegister(Request $request){
        $rules = [
            'nombre' => 'required',
            'telefono' => 'required|numeric|unique:persona,email_user|min:10',
            'password' => 'required:min:6',
        ];
        $messages = [
            'nombre.required' => 'Nombre requerido',
            'telefono.required' => 'Número es necesario',
            'telefono.numeric' => 'Número en formato incorrecto',
            'telefono.unique' => 'Ya existe un usuario con ese número registrado',
            'telefono.min' => 'Numero con almenos 10 digitos',
            'password.required' => 'Por favor escriba una contrasena',
            'password.min' => 'La contrasena debe contener al menos 6 caracteres',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se ha producdio un error')->with('typealert', 'danger');
        }else{
            $user = new Persona;
            $user->nombres = e($request->input('nombre'));
            $user->nombre_rancho = e($request->input('nombre_rancho'));
            $user->telefono = e($request->input('telefono'));
            $user->email_user = e($request->input('telefono'));
            $user->password = Hash::make($request->input('password'));
            $user->tipo_explotacion = e($request->input('tipo_explotacion'));
            $user->numero_registro_union = e($request->input('numero_registro_union'));
            $user->tamano_ato = e($request->input('tamano_ato'));
            $user->tipo_produccion = e($request->input('tipo_produccion'));
            $user->registro_asociacion = e($request->input('registro_asociacion'));
            $user->rfc = e($request->input('rfc'));
            $user->mercado_destino = e($request->input('mercado_destino'));
            $user->municipio = e($request->input('municipio'));
            $user->rolid = '6';
            $user->estado = e($request->input('intEstado'));
            $user->datecreated = now();
            $user->updated_at = now();
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreArchivo = e($request->input('telefono')) . '_fierro.webp';
                $imgWebp = imagecreatefromstring(file_get_contents($imagen->getRealPath()));
                imagewebp($imgWebp, 'userspics/' . $nombreArchivo);
                $user->foto_fierro = $nombreArchivo;
            } else {
                $user->foto_fierro = null;
            }
            if($user->save()){
                if(Auth::attempt(['email_user' => $request->input('telefono'), 'password' => $request->input('password')], true)){
                   return redirect('/admin/products/home');
                }
            }else{
                return back()->with('message', 'Se ha producdio un al registrarse')->with('typealert', 'danger');
            }  
        }
    }

}
