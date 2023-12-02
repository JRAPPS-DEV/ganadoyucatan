@extends('header')
@section('title', 'Registrarse -')
@section('content')
    <!-- <link rel="stylesheet" type="text/css" href="{{url('/static/css/singUp.css') }}"> -->
    <link rel="stylesheet" href="{{url('/static/new/css/register.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <!-- @if(Session::has('message'))
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
    <div class="container_login sign-up-mode">
        <div class="forms-container" id=registro role="tabpanel" aria-labelledby="profile-tab">
            <div class="signin-signup">
            {!! Form::open(['url' => '/register', 'class' => 'sign-up-form form', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                {{-- <form id="formRegister" action="{{url('/register')}}" class="sign-up-form form" enctype="multipart/form-data"> --}}
                    <h2 class="title">Te damos la bienvenida Ganadero</h2>
                    <h3 class="subtitle">Disfruta de los beneficios de tu <br> suscripción anual</h3>
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="valid validText" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-phone"></i>
                        <input type="validNumber" class="valid"  id="telefono" name="telefono" placeholder="Telefono" required>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" class="valid" id="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <div class="input-field">
                        <i class="fa fa-id-card-o"></i>
                        <input type="text" class="valid"  id="txtaso" name="txtaso" placeholder="Asociación" required>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-location-dot"></i>
                        <select  class="custom-select" id="intEstado" name="intEstado" placeholder="Ubicación" >
                            <option selected value="1">Yucatan</option>
                            <option value="2">Campeche</option>
                            <option value="3">Quintana Roo</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <i class="fa fa-id-card-o"></i>
                        <input type="file" class="valid" id="imagen" name="imagen" placeholder="imagen" >
                        </div>
                    <button class="btn-solid" type="submit">
                        <div>
                            <p>Entra</p>
                        </div>
                    </button>

                    <p class="social-text">Visítanos en nuestras redes:</p>

                    <div class="social-media">
                        <a href="https://www.facebook.com/ganadoyucatan" class="social-icon">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="https://instagram.com/ganado_yuc" class="social-icon">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <!-- <a href="#" class="social-icon">
                            <i class="fa-brands fa-"></i>
                        </a>
                    </div>
                    {!! Form::close() !!}
                {{-- </form> --}}
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-content">
                <div class="content">

                </div>
                <img src="./assets/img/undraw_join_re_w1lh.svg" alt="" class="image">
            </div>

            <div class="panel right-content">
                <div class="content">
                    <h3>¿Ya estás registrado?</h3>
                    <p>Da click aquí para subir tus productos y ver las solicitudes de compras</p>
                    <button class="btn transparent" onclick="location.href='{{url('/login')}}'" id="sign-in-btn">Inicia sesión</button>
                </div>
                <img src="https://ganadoyucatan.com/assets/img/stylized-cow-line-art.svg" alt="" class="image">
            </div>
        </div>

    </div> -->

    <div class="container-register">
        <div class="register-form">
            <img onclick="location.href='https://ganadoyucatan.com/'" src="{{url('/static/new/iconos/logo-red.png')}}" alt="">
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
                    <label for="ubicacion">Ubicación</label>
                    <select type="text" id="intEstado" name="intEstado" placeholder="Ubicación">
                        <option selected value="1">Yucatan</option>
                        <option value="2">Campeche</option>
                        <option value="3">Quintana Roo</option>
                    </select>
                </div>
                <div class="checkbox-privacidad">
                <input type="checkbox" id="politicasPrivacidad" required>
                    <label for="politicasPrivacidad">Acepto las <a href="/politicaPrivacidad" class="privacy-policy-link">políticas de privacidad</a></label>
                </div>
                <button class="mainButton" type="submit">Entrar</button>
            {!! Form::close() !!}
        </div>
    </div>



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
