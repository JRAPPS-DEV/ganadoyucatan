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

                <div class="form-group custom-file-upload">
                    <label for="fierro">Sube tu fierro</label>
                    <div class="file-wrapper">
                        <button type="button" class="file-btn">Seleccionar archivo</button>
                        <span class="file-name">Ningún archivo seleccionado</span>
                        <input type="file" id="fierro" name="fierro" accept="image/*" hidden>
                    </div>
                </div>

                <div class="form-group">
                    <label for="logo">Sube tu logo</label>
                    <div class="file-wrapper">
                        <button type="button" class="file-btn">Seleccionar archivo</button>
                        <span class="file-name">Ningún archivo seleccionado</span>
                        <input type="file" id="logo" name="logo" accept="image/*" hidden>
                    </div>
                </div>

                <div class="form-group">
                    <label for="tiendasDropdown">Tiendas de Interés</label>
                    <div class="custom-dropdown" id="tiendasDropdown">
                        <div class="dropdown-toggle">Selecciona tiendas de interés</div>
                        <div class="dropdown-menu">
                            <div class="dropdown-option">
                                <span>Ganado comercial</span>
                                <input type="checkbox" name="tiendas_interes[]" value="Ganado comercial">
                            </div>
                            <div class="dropdown-option">
                                <span>Ganado genético</span>
                                <input type="checkbox" name="tiendas_interes[]" value="Ganado genético">
                            </div>
                            <div class="dropdown-option">
                                <span>Subasta ganadera</span>
                                <input type="checkbox" name="tiendas_interes[]" value="Subasta ganadera">
                            </div>
                            <div class="dropdown-option">
                                <span>Embriones en venta</span>
                                <input type="checkbox" name="tiendas_interes[]" value="Embriones en venta">
                            </div>
                            <div class="dropdown-option">
                                <span>Pajillas de semen bovino</span>
                                <input type="checkbox" name="tiendas_interes[]" value="Pajillas de semen bovino">
                            </div>
                        </div>
                    </div>
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
                <div class="image-carousel">
                    <div class="carousel-images">
                        @if(isset($user) && $user->foto_fierro)
                            <img src="{{ asset('userspics/' . $user->foto_fierro) }}" alt="Fierro del usuario">
                        @else
                            <img src="{{ asset('static/new/placeholder.webp') }}" alt="Sin imagen">
                        @endif
                    </div>
                    <div class="carousel-dots">
                        <span class="dot active"></span>
                    </div>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('.dropdown-toggle');
    const menu = document.querySelector('.dropdown-menu');

    toggle.addEventListener('click', function () {
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.custom-dropdown')) {
            menu.style.display = 'none';
        }
    });

    const checkboxes = document.querySelectorAll('.dropdown-menu input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const selected = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.parentElement.querySelector('span').textContent.trim());
            toggle.textContent = selected.length > 0 ? selected.join(', ') : 'Selecciona tiendas de interés';
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('imagen');
    const fileBtn = document.querySelector('.file-btn');
    const fileName = document.querySelector('.file-name');

    fileBtn.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function () {
        fileName.textContent = this.files.length > 0 ? this.files[0].name : 'Ningún archivo seleccionado';
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const images = document.querySelectorAll('.carousel-images img');
    const dots = document.querySelectorAll('.carousel-dots .dot');
    let index = 0;

    function showImage(i) {
        images.forEach(img => img.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));

        images[i].classList.add('active');
        dots[i].classList.add('active');
    }

    function nextImage() {
        index = (index + 1) % images.length;
        showImage(index);
    }

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            index = i;
            showImage(index);
        });
    });

    showImage(index); // init
    setInterval(nextImage, 4000); // cambia cada 4 segundos
});
</script>


