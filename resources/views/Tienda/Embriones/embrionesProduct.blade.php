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
                    @foreach($embrion->imagenes as $index => $imagen)
                        <div class="div{{ $index + 1 }}">
                            <img class="left" onclick="swapImages('div{{ $index + 1 }}')" 
                                 src="{{ asset('storage/' . $imagen->url_imagen) }}" 
                                 alt="Imagen {{ $index + 1 }}">
                        </div>
                    @endforeach

                    <div class="div13">
                        <div class="right-container">
                            @if($embrion->imagenes->isNotEmpty())
                                <img class="right" id="mainImage" src="{{ asset('storage/' . $embrion->imagenes->first()->url_imagen) }}" alt="Imagen Principal">
                                <button class="fullscreen-button" onclick="openFullscreen()">
                                    <img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/fullscreen.png" alt="fullscreen"/>
                                </button>
                                <span class="close-button" onclick="closeFullscreen()">CERRAR</span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($embrion->videos->isNotEmpty())
                    <div class="youtube-link">
                        @foreach($embrion->videos as $video)
                            <iframe width="560" height="315" src="{{ $video->url_video }}" frameborder="0" allowfullscreen></iframe>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="information-product">
                <p class="description">{{ $embrion->descripcion }}</p>
                <p class="raza">{{ $embrion->raza }}, {{ $embrion->location->nombre ?? 'Ubicación no disponible' }}</p>
                <p class="description">${{ number_format($embrion->precio, 2) }} MXN</p>
                <p class="info">Stock disponible: {{ $embrion->stock }}</p>
                <div class="contact-button">
                    <button class="mainButtonB" onclick="location.href='https://wa.me/+52'">
                        <a href="https://wa.me/+52" style="color: white;">Contacto</a>
                    </button>
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
                <div class="desc1"><span>Peso: </span><p>{{ $embrion->peso ?? 'No disponible' }}</p></div>
                <div class="desc2"><span>Edad: </span><p>{{ $embrion->edad ?? 'No disponible' }}</p></div>
                <div class="desc3"><span>Raza: </span><p>{{ $embrion->raza }}</p></div>
                <div class="desc4"><span>Tipo: </span><p>{{ $embrion->tipo ?? 'No disponible' }}</p></div>
                <div class="desc5"><span>Rancho:</span><p>{{ $embrion->rancho }}</p></div>
                <div class="desc6"><span>Arete: </span><p>{{ $embrion->arete ?? 'No disponible' }}</p></div>
                <div class="desc7"><span>Certificado:</span><p>{{ $embrion->certificado ? 'Sí' : 'No' }}</p></div>
                <div class="desc8"><span>A cargo</span><p>{{ $embrion->vendedorid ?? 'No disponible' }}</p></div>
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
            @foreach(App\Models\Embrion::inRandomOrder()->take(4)->get() as $relacionado)
                <div class="card-relationated">
                    <img class="img-products" src="{{ $relacionado->imagenes->first() ? asset('storage/' . $relacionado->imagenes->first()->url_imagen) : asset('default-image.jpg') }}" alt="{{ $relacionado->nombre }}">
                    <div class="card-description">
                        <div class="card-description--info">
                            <p class="raza">{{ $relacionado->raza }}</p>
                            <p class="description">${{ number_format($relacionado->precio, 2) }} MXN</p>
                            <a href="{{ route('embrion.detalle', $relacionado->idproducto) }}">
                                <button class="secondaryButton">Ver más</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
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

