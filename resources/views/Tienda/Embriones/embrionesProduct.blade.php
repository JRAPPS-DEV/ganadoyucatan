@extends('layout')
@section('content')

<div class="productTienda-section">
    <div class="banner-product--embriones">
        <h1>Embriones</h1>
    </div>
    <div class="container-product--Main">
        <div class="route">
            <p>Inicio<span>></span></p><p>Embriones</p><span>></span><p>Nombre del producto</p>
        </div>
        <div class="information-product--container">
            <div class="container">
                <div class="parent">
                    <div class="div1">
                        @if(isset($images[0]))
                            <img class="left" onclick="swapImages('div1')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[0]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div2">
                        @if(isset($images[1]))
                        <img class="left"  onclick="swapImages('div2')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[1]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div3">
                        @if(isset($images[2]))
                        <img class="left" onclick="swapImages('div3')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[2]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div4">
                        @if(isset($images[3]))
                        <img class="left" onclick="swapImages('div4')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[3]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div5">
                        @if(isset($images[4]))
                        <img class="left" onclick="swapImages('div5')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[4]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div6">
                        @if(isset($images[5]))
                        <img class="left" onclick="swapImages('div6')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[5]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div7">
                        @if(isset($images[6]))
                        <img class="left" onclick="swapImages('div7')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[6]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div8">
                        @if(isset($images[7]))
                        <img class="left" onclick="swapImages('div8')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[7]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div9">
                        @if(isset($images[8]))
                        <img class="left" onclick="swapImages('div9')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[8]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div10">
                        @if(isset($images[9]))
                        <img class="left" onclick="swapImages('div10')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[9]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div11">
                        @if(isset($images[10]))
                        <img class="left" onclick="swapImages('div11')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[10]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div12">
                        @if(isset($images[11]))
                        <img class="left" onclick="swapImages('div11')" src="{{asset('uploads/tianguis/'.$p->imagen. '/'.$images[11]['ruta'].'.webp')}}" alt="Imagen 1">
                        @endif
                    </div>
                    <div class="div13">
                        <div class="right-container">
                            @if(isset($images[0]))
                                <img class="right" id="mainImage" src="" alt="Imagen Principal">
                                <button class="fullscreen-button" onclick="openFullscreen()">
                                    <img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/fullscreen.png" alt="fullscreen"/>
                                </button>
                                <span class="close-button" onclick="closeFullscreen()">CERRAR</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="youtube-link">

                </div>
            </div>
            <div class="information-product">
                <p class="description">description</p>
                <p class="raza">raza, ciudad</p>
                <p class="description">$1000 MXN</p>
                <p class="info">Error incidunt aliquam debitis obcaecati. Totam corrupti </p>
                <div class="contact-button">
                    <button class="mainButtonB" onclick="location.href='https://wa.me/+52'"><a href="https://wa.me/+52" style="color: white;">Contacto</a></button>
                    <a id="openModal">Hacer contacto <span>></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="description-product">
        <div class="desc-left">
            {{-- Visitas: {{$p->visits->count()}} --}}
            <p>descripcion <span> </span></p>
        </div>
        <div class="desc-right">
            <h2>Descripción del Ganado</h2>
            <div class="container-desc">
                <div class="desc1"><span>Peso: </span><p>peso</p></div>
                <div class="desc2"><span>Edad: </span><p>edad</p></div>
                <div class="desc3"><span>Raza: </span><p>raza</p></div>
                <div class="desc4"><span>Tipo: </span><p>tipo</p></div>
                <div class="desc5"><span>Rancho:</span><p>rancho</p></div>
                <div class="desc6"><span>Arete: </span><p>arete</p></div>
                <div class="desc7"><span>Certificado:</span><p>certificado</p></div>
                <div class="desc8"><span>A cargo</span><p>nombres apellidos</p></div>
            </div>
            <hr>
        {{--<h2>Reseñas del ganado</h2>
            <div class="container-reseñas">
                <div class="card-reseñas">
                    <div class="reseña">
                        <p class="reseña-description"></p>
                        <p class="reseña-name"></p>
                    </div>
                    <div class="dierecis">
                        <img src="" alt="" srcset="">
                    </div>
                </div>

            </div> --}}
        </div>
    </div>
    <div class="relationated-product">
        <p class="interest">Más ganado que te podría interesar</p>
        <div class="relationated-product-cards">
            <div class="card-relationated">
                <img class="img-products" src="" alt="" srcset="">
                <div class="card-description">
                    <div class="icons">
                        {{-- <img src="{{ asset('static/new/Iconos/pinestrella.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinmoño.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinvaca.png') }}" alt=""> --}}
                    </div>
                    <div class="card-description--info">
                        <p class="raza">raza</p>
                        <p class="description">precio</p>
                        <button class="secondaryButton" onclick="">Ver más</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--Modal Contact-->
<div id="modal">
    <div class="contact-form">
        <img class="contact-form-img" src="{{url('/static/new/iconos/logo-red.png')}}" alt="">
        <div class="close-menu-contact">
            <img src="https://img.icons8.com/ios-glyphs/30/000000/delete-sign.png" alt="delete-sign"/>
        </div>
        <p class="main-text">Contáctanos</p>
        <P class="secondary-text">Ponte en contacto con nosotros</P>
        <form id="frmContactoT">
            <input class="" type="text" id="vendedorid" name="vendedorid" style="display: none;">
            <hr>
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="tel" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <button class="mainButtonC" type="submit">Enviar</button>
    </div>
</div>

<!-- FullscreenModal -->
<div id="fullscreenModal" class="fullscreen hidden">
    <div class="fullscreen-content">
        <span id="closeFullscreen" class="close-btn" onclick="closeFullscreenModal()">&times;</span>

        <button id="prevImage" class="nav-btn left-btn" onclick="navigateImage(-1)">&#8249;</button>
        <img id="fullscreenImage" src="" alt="Imagen Fullscreen">
        <button id="nextImage" class="nav-btn right-btn" onclick="navigateImage(1)">&#8250;</button>

        <div class="action-buttons">
            {{-- <a href="https://wa.me/+52<?= $p->owner->telefono; ?>" class="action-btn whatsapp-btn">WhatsApp</a> //poner el numero de telefono del vendedor --}}
            <a href="mailto:ganado.yucatan@gmail.com?subject=Consulta&body=Hola,%20necesito%20información%20sobre%20los%20productos%20de%20su%20página" class="action-btn contact-btn">Contactar</a>
            {{-- <button class="action-btn contact-btn" id="openModal">Contactar</button> --}}
        </div>
    </div>
</div>

<script>
    const openModalButton = document.getElementById('openModal');
    const modal = document.getElementById('modal');
    const closeModalSpan = document.querySelector('.close-menu-contact img');
    const form = document.getElementById('frmContactoT');

    openModalButton.addEventListener('click', () => {
        modal.style.display = 'flex';
    });

    closeModalSpan.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    /*form.addEventListener('submit', (event) => {
        event.preventDefault();
        modal.style.display = 'none';
    });*/
</script>
<script>
    let currentImageIndex = 0;

    //Aquí se deben de poner las rutas de las imágenes cómo en la tienda de tianguis en la linea 266 a 274

    function swapImages(divId) {
        const clickedImage = document.querySelector('.' + divId + ' img');
        if (clickedImage) {
            const clickedImageSrc = clickedImage.src;

            currentImageIndex = images.indexOf(clickedImageSrc);
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                mainImage.src = clickedImageSrc;
            }
        }
    }


    function openFullscreen() {
        const fullscreenModal = document.getElementById('fullscreenModal');
        const fullscreenImage = document.getElementById('fullscreenImage');
        const mainImageSrc = document.getElementById('mainImage').src;

        currentImageIndex = images.indexOf(mainImageSrc);
        fullscreenImage.src = mainImageSrc;
        fullscreenModal.classList.remove('hidden');
        fullscreenModal.classList.add('visible');

        fullscreenModal.addEventListener('click', (event) => {
            if (event.target === fullscreenModal) {
                closeFullscreenModal();
            }
        });
    }

    function navigateImage(direction) {
        currentImageIndex = (currentImageIndex + direction + images.length) % images.length;

        const fullscreenImage = document.getElementById('fullscreenImage');
        if (fullscreenImage) {
            fullscreenImage.src = images[currentImageIndex];
        }
    }

    function closeFullscreenModal() {
        document.getElementById('fullscreenModal').classList.add('hidden');
    }

    function contactUser() {
        alert('Función de contacto no implementada aún.');
    }

</script>
@endsection

