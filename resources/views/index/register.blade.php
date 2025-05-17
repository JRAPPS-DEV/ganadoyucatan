@extends('header')
@section('title', 'Registrarse -')
@section('content')
    <link rel="stylesheet" href="{{url('/static/new/css/register.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    @if(Session::has('message'))
            <div class="alert alert-{{Session::get('typealert')}}" style="display:none;">
                {{Session::get('message')}}
                @if ($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                    <li> {{ $error }} </li>
                    @endforeach
                </ul>
                @endif
                <script >
                    $('.alert').slideDown();
                    setTimeout(function(){ $('.alert').slideUp(); }, 5000);
                </script>
            </div>
    @endif

    <div class="container-register">
        <div class="register-form">
            <img onclick="location.href=`https://ganadoyucatan.com/`" src="{{url('/static/new/Iconos/logo-red.png')}}" alt="">
            <p class="main-text">TE DAMOS LA BIENVENIDA <br>GANADERO</p>
            <P class="secondary-text">Disfuta de los beneficios de tu suscripción anual</P>
             {!! Form::open(['url' => '/register', 'class' => 'sign-up-form form', 'enctype' => 'multipart/form-data', 'id' => 'formRegister']) !!}
                @csrf
                <hr>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="number" id="telefono" name="telefono" placeholder="Telefono">
                </div>
                <div class="form-group">
                    <label for="telefono">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Contraseña">
                </div>
                    <div class="form-group">
                      <label class="control-label" for="estados">Estado:</label>
                      <select class="form-control" name="estados" id="estados">
                          <option value=""></option>
                      </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="ciudades">Ciudad:</label>
                        <select  class="form-control" name="ciudades" id="ciudades">
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="comisarias">Comisarias:</label>
                        <select class="form-control"  name="comisarias" id="comisarias">
                        </select>
                    </div>
                <div class="form-group">
                    <label for="nombre_rancho">Nombre del Rancho</label>
                    <input type="text" id="nombre_rancho" name="nombre_rancho" placeholder="Nombre del rancho">
                </div>

                <div class="form-group">
                    <label for="imagen">Sube tu fierro</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="logo">Sube tu logo</label>
                    <input type="file" id="logo" name="logo" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="tipo_explotacion">Tipo de Explotación</label>
                    <select id="tipo_explotacion" name="tipo_explotacion">
                        <option value="Ganado genético">Ganado genético</option>
                        <option value="Ganado de engorda">Ganado de engorda</option>
                        <option value="Alta genética">Alta genética</option>
                        <option value="Ganado comercial">Ganado comercial</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mercado_destino">Mercado Destino</label>
                    <select id="mercado_destino" name="mercado_destino">
                        <option value="Local">Local</option>
                        <option value="Nacional">Nacional</option>
                        <option value="Exportación">Exportación</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="numero_registro_union">Número de Registro de Unión</label>
                    <input type="text" id="numero_registro_union" name="numero_registro_union" placeholder="Número de Registro">
                </div>
                <div class="form-group">
                    <label for="numero_registro_union">Registro de asociacion</label>
                    <input type="text" id="registro_asociacion" name="registro_asociacion" placeholder="Número de Registro">
                </div>

                {{-- <div class="form-group">
                    <label for="tamano_ato">Tamaño del Ato Ganadero</label>
                    <input type="number" id="tamano_ato" name="tamano_ato" placeholder="Número de cabezas de ganado">
                </div>

                <div class="form-group">
                    <label for="tipo_produccion">Tipo de Producción</label>
                    <select id="tipo_produccion" name="tipo_produccion">
                        <option value="Carne">Carne</option>
                        <option value="Leche">Leche</option>
                        <option value="Doble propósito">Doble propósito</option>
                    </select>
                </div> --}}

                <div class="form-group">
                    <label for="rfc">RFC</label>
                    <input type="text" id="rfc" name="rfc" placeholder="RFC">
                </div>

                <div class="checkbox-privacidad">
                <input type="checkbox" id="politicasPrivacidad" required>
                    <label for="politicasPrivacidad">Acepto las <a href="/politicaPrivacidad" class="privacy-policy-link">políticas de privacidad</a></label>
                </div>
                <button class="mainButton" type="submit">Entrar</button>
            {!! Form::close() !!}
        </div>
    </div>


    <script src="{{url('/static/js/locationRegister.js') }}" ></script>
<script>
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container   = document.querySelector(".container_login");

    sign_up_btn.addEventListener("click", () =>{
        container.classList.add("sign-up-mode");
    });

    sign_in_btn.addEventListener("click", () =>{
        container.classList.remove("sign-up-mode");
    });
</script>
