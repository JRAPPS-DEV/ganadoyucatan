@extends('layout')

@section('content')
    <div class="carousel-container">
        <div class="image-container">
            <div class="image">
                <img src="{{ asset('static/new/background/_header-1.jpg') }}" alt="" srcset="">
            </div>
            <div class="image">
                <img src="{{ asset('static/new/background/ios_app.png') }}" alt="" srcset="">
            </div>
            <div class="image">
                <img src="{{ asset('static/new/background/android_app.png') }}" alt="" srcset="">
            </div>
        </div>
        <div class="navigation-points">
            <div class="point"></div>
            <div class="point"></div>
            <div class="point"></div>
        </div>
        <div class="social-media">
            <img class="social-icon" onclick="location.href='https://www.youtube.com/@ganadoyucatanpeninsular6593'" width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/youtube--v1.png" alt="youtube-play"/>
            <img class="social-icon" onclick="location.href='https://www.facebook.com/ganadoyucatan'" width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/facebook--v1.png" alt="facebook--v1" />
            <img class="social-icon" onclick="location.href='https://www.instagram.com/ganado_yuc/'"  width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/instagram-new--v1.png" alt="instagram-new--v1"/>
            <img class="social-icon" onclick="location.href='https://play.google.com/store/apps/details?id=ganadoyucatan.com.ganadoapp&pcampaignid=web_share'" width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/google-play--v1.png" alt="google-play--v1"/>
            <img class="social-icon" onclick="location.href='https://apps.apple.com/mx/app/ganado-app/id6738614464'" width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/apple-app-store--v2.png" alt="apple-app-store--v2"/>
        </div>
        <div class="nav-buttons-main">
            <div class="prev-button"><</div>
            <div class="next-button">></div>
            <div class="next-label ">Siguiente</div>
        </div>
    </div>
    <div class="tianguisGanadero-container">
        <div class="tianguisLeft">
            <hr>
            <h1 class="title">Ganado comercial</h1>
            <h2 class="content">Si buscas ganado, para el consumo o el sector cárnico, bienvenido a tu tienda digital.</h2>
            <button onclick="location.href='/tianguisTienda'" class="mainButton">Ver más</button>
        </div>
        <div class="tianguisRight"></div>
    </div>
    <div class="ganadoGenetico-container">
        <div class="geneticoLeft"></div>
        <div class="geneticoRight">
            <hr>
            <h1 class="title">Ganado Genético</h1>

            <h2 class="content">Si buscas ganado para mejorar el hato ganadero, bienvenido a tu tienda digital.</h2>

            <button onclick="location.href='/tienda'" class="mainButton">Ver más</button>
        </div>
    </div>
    <div class="subastaGanadera-container">
        <div class="subastaLeft">
            <hr>
            <h1 class="title">Subasta ganadera</h1>
            <h2 class="content">¿Te gustaría ofertar? Este es un espacio diseñado para todos nuestros suscriptores, busca tu oportunidad, bienvenidos a Subasta Ganadera.</h2>

            <button onclick="location.href='/subastas'" class="mainButton">Ver más</button>
        </div>
        <div class="subastaRight"></div>
    </div>
    <div class="noticias-container">
        <div class="noticiasLeft"></div>
        <div class="noticiasRight">
            <hr>
            <h1 class="title">Noticias</h1>
            <h2 class="content">El Boletín Ganadero de Yucatán</h2>
            <button onclick="location.href='/blog'" class="mainButton">Ver más</button>
        </div>
    </div>
    <div class="embriones-container">
        <div class="embrionesLeft">
            <hr>
            <h1 class="title">Embriones en venta</h1>
            <h2 class="content">Embriones bovinos de alta genética - Potencia Genética para tu Ganado</h2>

            <button onclick="location.href='/embriones'" class="mainButton">Ver más</button>
        </div>
        <div class="embrionesRight"></div>
    </div>
    <div class="pajillas-container">
        <div class="pajillasLeft"></div>
        <div class="pajillasRight">
            <hr>
            <h1 class="title">Pajillas de semen bovino</h1>
            <h2 class="content">Pajillas de Semen Bovino de alta genética - Mejora Genética Garantizada para tu Rebaño</h2>
            <button onclick="location.href='/pajillas'" class="mainButton">Ver más</button>
        </div>
    </div>
    <div class="contact">
        <div class="left-contact">
            <h1>Hacer Contacto</h1>
            <p>Somos una plataforma dedicada a brindarle servicios al sector ganadero de Yucatán, poniendo a su alcance herramientas digitales que le ayuden a promover sus ganados</p>
            <div class="social-media--contact-container">
                <img class="social-icon" onclick="location.href='https://www.youtube.com/@ganadoyucatanpeninsular6593'"  width="25" height="25" src="https://img.icons8.com/material-sharp/50/ffffff/youtube-play.png" alt="youtube-play"/>
                <img class="social-icon" onclick="location.href='https://www.facebook.com/ganadoyucatan'" width="25" height="25" src="https://img.icons8.com/windows/50/ffffff/facebook-f--v2.png" alt="facebook-f--v2"/>
                <img class="social-icon" onclick="location.href='https://www.instagram.com/ganado_yuc/'"  width="25" height="25" src="https://img.icons8.com/ios/50/ffffff/instagram-new--v1.png" alt="instagram-new--v1"/>
            </div>
            <div class="info-contact">
                <div class="info-containers">
                    <img width="35" height="35" src="https://img.icons8.com/ios/50/ffffff/marker--v1.png" alt="marker--v1"/>
                    <div class="info-right">
                        <p>Dirección</p>
                        <p>Mérida, Yucatán</p>
                    </div>
                </div>
                <div class="info-containers">
                    <img width="35" height="35" src="https://img.icons8.com/ios/50/ffffff/whatsapp--v1.png" alt="whatsapp--v1"/>
                    <div class="info-right">
                        <p>Teléfono:</p>
                        <p>9991234567</p>
                    </div>
                </div>
                <div class="info-containers">
                <img width="35" height="35" src="https://img.icons8.com/external-tanah-basah-glyph-tanah-basah/48/ffffff/external-at-digital-marketing-tanah-basah-glyph-tanah-basah.png" alt="external-at-digital-marketing-tanah-basah-glyph-tanah-basah"/>
                    <div class="info-right">
                        <p>E-Mail:</p>
                        <p>ganado.yucatan@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-contact">
        {!! Form::open(['url' => '/contactInfo', 'class' => 'sign-up-form form', 'enctype' => 'multipart/form-data']) !!}
             @csrf
            <div>
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" required class="input-with-border-bottom" placeholder="Nombre">
            </div>
            <div>
                <label for="phone">Teléfono</label>
                <input type="text" d="phone" name="phone" class="input-with-border-bottom" placeholder="Teléfono" required>
            </div>
            <div>
                <label for="message">Mensaje</label>
                <textarea type="text" id="message" name="message" rows="6" class="input-with-border-bottom" placeholder="Mensaje" required> </textarea>
            </div>
            <button type="submit">Enviar mensaje</button>
        {!! Form::close() !!}
        </div>
    </div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const images = document.querySelectorAll(".image");
        const points = document.querySelectorAll(".point");
        const prevButton = document.querySelector(".prev-button");
        const nextButton = document.querySelector(".next-button");
        let currentIndex = 0;
        const intervalTime = 10000;

        function showSlide(index) {
            images.forEach((image, i) => {
                if (i == index) {
                    image.style.display = "block";
                } else {
                    image.style.display = "none";
                }
            });
            points.forEach((point, i) => {
                if (i === index) {
                    point.classList.add("active");
                } else {
                    point.classList.remove("active");
                }
            });
        }

        showSlide(currentIndex);

        prevButton.addEventListener("click", function () {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showSlide(currentIndex);
        });

        nextButton.addEventListener("click", function () {
            currentIndex = (currentIndex + 1) % images.length;
            showSlide(currentIndex);
        });

        points.forEach((point, index) => {
            point.addEventListener("click", function () {
                currentIndex = index;
                showSlide(currentIndex);
            });
        });

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            showSlide(currentIndex);
        }, intervalTime);
    });
</script>

@endsection
