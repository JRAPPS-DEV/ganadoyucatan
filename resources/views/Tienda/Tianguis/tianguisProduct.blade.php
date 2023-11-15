@extends('layout')
@section('content')
@php
			$p = $product;
			$videoURL = $p['link'];
			$convertedURL = str_replace("watch?v=","embed/", $videoURL);
			$urlShared = url("/tianguis/producto/".$p['idproducto']);
@endphp
 <!-- <div class="container">
		<div class="tianguis-header">
			<h2>{{$product->nombre}}</h2>
			<hr>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="img-container">
					@if($product->imagen != null)
					<img src="{{ asset('uploads/tianguis/'.substr($product->datecreated, 0, 10).'/'.$images[0]['ruta'].'.webp')}}" class="img-fluid img-main--product" id="MainImg">
					<div class="row" style="padding: 1rem 0;">
						@php for($i = 0; $i < count($images); $i++){ @endphp
						<div class="hover-img col-sm-3" style="padding-right: 0;">
							<img src="{{ asset('uploads/tianguis/'.substr($product->datecreated, 0, 10).'/'.$images[$i]['ruta'].'.webp')}}" alt="" class="small-img">
						</div>
						@php
						}
						@endphp
					</div>
					@else
					<img src="{{ asset('uploads/'.$images[0]['ruta'])}}" class="img-fluid img-main--product" id="MainImg">
					<div class="row" style="padding: 1rem 0;">
						@php for($i = 0; $i < count($images); $i++){ @endphp
						<div class="hover-img col-sm-3" style="padding-right: 0;">
							<img src="{{ asset('uploads/'.$images[$i]['ruta'])}}" alt="" class="small-img">
						</div>
						@php
						}
						@endphp
					</div>
					@endif
				</div>
			</div>
				<div class="tianguis-description col-md-6">
					<p> {{$product->estado}}, {{$product->ciudad}}</p>
					<h2>{{$product->descripcion}}</h2>
					<div class="row">
						<p>Descripción del producto</p>
						<div class="tianguis-description--caract col-md-6">
							<ul>
								<li><b>Peso:</b> {{$product->peso}}</li>
								<hr>
								<li><b>Raza:</b> {{$product->raza}}</li>
								<hr>
								<li><b>Tipo:</b> {{$product->tipo}}</li>
								<hr>
							</ul>
						</div>
						<div class="tianguis-description--caract col-md-6">
							<ul>
								<li><b>¿Arete?:</b> {{$product->arete}}</li>
								<hr>
								<li><b>¿Certificado?:</b> {{$product->certificado}}</li>
								<hr>
								<li><b>¿Vacunado?:</b> {{$product->vacunado}}</li>
								<hr>
							</ul>
						</div>
					</div>
					<div class="product-price row">
						<div class="col-md-6"><p><b>${{$product->precio}}</b></p></div>
						<div class="col-md-6"><a href="https://wa.me/+52{{$product->numero}}" class="btn b btn-lg" style="background-color: #24d265;color: white;">Contactar vía Whats App</a></div>
						<div class="col-lg-12 m-t-8">
							<div class="embed-responsive embed-responsive-16by9">
								<iframe class="embed-responsive-item" src="<?php echo $convertedURL; ?>" frameborder="0" allow="accelerometer; autoplay;clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
						</div>
					</div>
						<div class="col">
							<div class="btn_wrap">
								<span>Compartir</span>
								<div class="container-btn">
									<div class="fb-share-button" data-href="URL_DE_TU_ARTICULO" data-layout="button" data-size="small">
	  									<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$urlShared;?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fab fa-facebook-f"></i></a>
										</div>
									<a href="https://api.whatsapp.com/send?text={{$product->ruta}}%20<?=$urlShared;?>" data-action="share/whatsapp/share"><i id="whats" class="fab fa-whatsapp" style="color:#23c861;"></i></a>

	                                <a href="<?=$urlShared?>">
	                                    <i class="fa-solid fa-link" id="copyLinkBtn" name="testA" ></i>
	                                </a>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>
		<div id="fullpage" onclick="this.style.display='none';"></div>
	<script>
		var MainImg  = document.getElementById('MainImg');
		var smallimg = document.getElementsByClassName('small-img');

		const imgs = document.querySelectorAll('.img-container img');
			const fullPage = document.querySelector('#fullpage');

		smallimg[0].onclick = function() {
			MainImg.src = smallimg[0].src;
		}
		smallimg[1].onclick = function() {
			MainImg.src = smallimg[1].src;
		}
		smallimg[2].onclick = function() {
			MainImg.src = smallimg[2].src;
		}
		smallimg[3].onclick = function() {
			MainImg.src = smallimg[3].src;
		}

		imgs.forEach(img => {
				img.addEventListener('click', function(){
					fullPage.style.backgroundImage = 'url(' + img.src + ')';
					fullPage.style.display = 'block';
				});
			});
				const copyLinkBtn = document.getElementById('copyLinkBtn');

		copyLinkBtn.addEventListener('click', (e) => {
		e.preventDefault();
		navigator.clipboard.writeText(window.location.href);
		alert('¡Enlace copiado, compártelo con tus conocidos!').then( () => {
			copyLinkBtn.removeEventListener('click');
		});
	});
</script>-->
<div class="productTienda-section">
    <div class="banner-product--tienda">
        <h1>TIANGUIS GANADERO</h1>
    </div>
    <div class="container-product--Main">
        <div class="route">
            <p>Inicio<span>></span></p><p>Tianguis ganadero</p><span>></span><p>Nombre del producto</p>
        </div>
        <div class="information-product--container">
            <div class="container">
            <div class="parent">
                    <div class="div1">
                        <img class="left" onclick="swapImages('div1')" src="https://images.pexels.com/photos/15835031/pexels-photo-15835031/free-photo-of-nieve-ciudad-coches-carretera.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load" alt="Imagen 1">
                    </div>
                    <div class="div2">
                        <img class="left" onclick="swapImages('div2')" src="https://images.pexels.com/photos/36347/cow-pasture-animal-almabtrieb.jpg?auto=compress&cs=tinysrgb&w=400" alt="Imagen 1">
                    </div>
                    <div class="div3">
                        <img class="left" onclick="swapImages('div3')" src="https://images.pexels.com/photos/19010243/pexels-photo-19010243/free-photo-of-nieve-amanecer-paisaje-puesta-de-sol.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load" alt="Imagen 1">
                    </div>
                    <div class="div4">
                        <div class="right-container">
                            <img class="right"onclick="swapImages('div4')" src="https://images.pexels.com/photos/13633065/pexels-photo-13633065.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Imagen 1">
                            <button class="fullscreen-button" onclick="openFullscreen()">
                                <img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/fullscreen.png" alt="fullscreen"/>
                            </button>
                            <span class="close-button" onclick="closeFullscreen()">CERRAR</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="information-product">
                <p class="description">Novillona Brahman Rojo con registro Genelógico</p>
                <p class="raza">Panaba, Yucatán</p>
                <p class="description">$160,000.00 MXN</p>
                <p class="info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et aliquid molestiae error quidem, nesciunt esse praesentium reiciendis nam iusto quasi asperiores harum, inventore culpa ex perferendis cupiditate dolorum reprehenderit quisquam.</p>
                <div class="contact-button">
                    <button class="mainButtonB">Contacto</button>
                    <a id="openModal" href="#">Hacer contacto <span>></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="description-product">
        <div class="desc-left">
            <p>Descripción del ganado <span> ></span></p>
        </div>
        <div class="desc-right">
            <h2>Descripción del Ganado</h2>
            <div class="container-desc">
                <div class="desc1"><span>Peso: </span><p>0kg</p></div>
                <div class="desc2"><span>Edad: </span><p>6meses</p></div>
                <div class="desc3"><span>Raza: </span><p>Brahman Rojo</p></div>
                <div class="desc4"><span>Tipo: </span><p>Simbra</p></div>
                <div class="desc5"><span>Rancho:</span><p>Ganaderia el pedregal</p></div>
                <div class="desc6"><span>Arete: </span><p>Con Arete</p></div>
                <div class="desc7"><span>Certificado:</span><p>Certificado</p></div>
                <div class="desc8"><span>A cargo</span><p>David Dominguez</p></div>
            </div>
            <hr>
            <h2>Reseñas del ganado</h2>
            <div class="container-reseñas">
                <div class="card-reseñas">
                    <div class="reseña">
                        <p class="reseña-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, numquam quibusdam! Ullam maxime repudiandae veritatis tenetur unde neque, consectetur totam alias sint necessitatibus cum, dolorem laboriosam aperiam modi quam debitis.</p>
                        <p class="reseña-name">-Roberto Pérez</p>
                    </div>
                    <div class="dierecis">
                        <!-- <img src="" alt="" srcset=""> -->
                    </div>
                </div>

                <div class="card-reseñas">
                    <div class="reseña">
                        <p class="reseña-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, numquam quibusdam! Ullam maxime repudiandae veritatis tenetur unde neque, consectetur totam alias sint necessitatibus cum, dolorem laboriosam aperiam modi quam debitis.</p>
                        <p class="reseña-name">-Roberto Pérez</p>
                    </div>
                    <div class="dierecis">
                        <!-- <img src="" alt="" srcset=""> -->
                    </div>
                </div>

                <div class="card-reseñas">
                    <div class="reseña">
                        <p class="reseña-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, numquam quibusdam! Ullam maxime repudiandae veritatis tenetur unde neque, consectetur totam alias sint necessitatibus cum, dolorem laboriosam aperiam modi quam debitis.</p>
                        <p class="reseña-name">-Roberto Pérez</p>
                    </div>
                    <div class="dierecis">
                        <!-- <img src="" alt="" srcset=""> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="relationated-product">
        <p class="interest">Más ganado que te podría interesar</p>
        <div class="relationated-product-cards">
            <div class="card-relationated">
                <img class="img-products" src="https://images.pexels.com/photos/36347/cow-pasture-animal-almabtrieb.jpg?auto=compress&cs=tinysrgb&w=400" alt="" srcset="">
                <div class="card-description">
                    <div class="icons">
                        <img src="{{ asset('static/new/Iconos/pinestrella.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinmoño.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinvaca.png') }}" alt="">
                    </div>
                    <div class="card-description--info">
                        <p class="raza">Toros para semental</p>
                        <p class="description" >Novillas para empadre</p>
                        <button class="secondaryButton" onclick="location.href='/tianguisTienda'">Ver más</button>
                    </div>
                    <!-- <div class="card-description--footer">
                        <p>Yucatán, Panaba</p>
                    </div> -->
                </div>
            </div>

            <div class="card-relationated">
                <img class="img-products" src="https://images.pexels.com/photos/36347/cow-pasture-animal-almabtrieb.jpg?auto=compress&cs=tinysrgb&w=400" alt="" srcset="">
                <div class="card-description">
                    <div class="icons">
                        <img src="{{ asset('static/new/Iconos/pinestrella.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinmoño.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinvaca.png') }}" alt="">
                    </div>
                    <div class="card-description--info">
                        <p class="raza">Toros para semental</p>
                        <p class="description" >Novillas para empadre</p>
                        <button class="secondaryButton" onclick="location.href='/tianguisTienda'">Ver más</button>
                    </div>
                    <!-- <div class="card-description--footer">
                        <p>Yucatán, Panaba</p>
                    </div> -->
                </div>
            </div>

            <div class="card-relationated">
                <img class="img-products" src="https://images.pexels.com/photos/36347/cow-pasture-animal-almabtrieb.jpg?auto=compress&cs=tinysrgb&w=400" alt="" srcset="">
                <div class="card-description">
                    <div class="icons">
                        <img src="{{ asset('static/new/Iconos/pinestrella.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinmoño.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinvaca.png') }}" alt="">
                    </div>
                    <div class="card-description--info">
                        <p class="raza">Toros para semental</p>
                        <p class="description" >Novillas para empadre</p>
                        <button class="secondaryButton" onclick="location.href='/tianguisTienda'">Ver más</button>
                    </div>
                    <!-- <div class="card-description--footer">
                        <p>Yucatán, Panaba</p>
                    </div> -->
                </div>
            </div>

            <div class="card-relationated">
                <img class="img-products" src="https://images.pexels.com/photos/36347/cow-pasture-animal-almabtrieb.jpg?auto=compress&cs=tinysrgb&w=400" alt="" srcset="">
                <div class="card-description">
                    <div class="icons">
                        <img src="{{ asset('static/new/Iconos/pinestrella.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinmoño.png') }}" alt="">
                        <img src="{{ asset('static/new/Iconos/pinvaca.png') }}" alt="">
                    </div>
                    <div class="card-description--info">
                        <p class="raza">Toros para semental</p>
                        <p class="description" >Novillas para empadre</p>
                        <button class="secondaryButton" onclick="location.href='/tianguisTienda'">Ver más</button>
                    </div>
                    <!-- <div class="card-description--footer">
                        <p>Yucatán, Panaba</p>
                    </div> -->
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
        <form action="contact-form" id="form-contact-group">
            <hr>
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" required>
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
        </form>
    </div>
</div>
<script>
    const openModalButton = document.getElementById('openModal');
    const modal = document.getElementById('modal');
    const closeModalSpan = document.querySelector('.close-menu-contact img');
    const form = document.getElementById('form-contact-group');

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

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        modal.style.display = 'none';
    });
</script>
<script>
    function swapImages(divId) {
        var clickedImageSrc = document.querySelector('.' + divId + ' img').src;
        var largeImageSrc = document.querySelector('.div4 img').src;

        document.querySelector('.' + divId + ' img').src = largeImageSrc;
        document.querySelector('.div4 img').src = clickedImageSrc;
    }

    function openFullscreen() {
        var fullscreenImage = document.createElement('img');
        fullscreenImage.classList.add('fullscreen-image');
        fullscreenImage.classList.add('active');
        fullscreenImage.src = document.querySelector('.div4 img').src;
        fullscreenImage.onclick = closeFullscreen;

        document.body.appendChild(fullscreenImage);
    }

    function closeFullscreen() {
        var fullscreenImage = document.querySelector('.fullscreen-image');
        if (fullscreenImage) {
            fullscreenImage.remove();
        }
    }
</script>
@endsection
