@extends('layout')
@section('content')
<?php
			$p = $product[0];
			$videoURL = $p['link'];
			$convertedURL = str_replace("watch?v=","embed/", $videoURL);
			$urlShared = url("/tienda/producto/".$p['idproducto']."/".$p['ruta']);
		?>
	<!-- <body>
		


{{-- 		<?php
 			include "conex.php";
 			date_default_timezone_set("America/Merida");

 			//optener ip
 			$ip = $_SERVER['REMOTE_ADDR'];
 			$id = $arrProducto['idproducto'];
 			$vend = $arrProducto['vendedorid'];

 			$sqlConsultar = $con->query("SELECT * FROM contador WHERE ip = '$ip' ORDER BY id desc");
 			$contarConsultar = $sqlConsultar->num_rows;

 			if($contarConsultar == 0) {
 				$sqlInsertar = $con->query("INSERT INTO contador (ip, fecha, idproducto, vendedorid) VALUES ('$ip', now(), '$id', '$vend')");
 			}else {
 				$row = $sqlConsultar->fetch_array();
 				$fechaRegistro = $row['fecha'];
 				$fechaActual = date("Y-m-d H:i:s");
 				$nuevaFecha = strtotime($fechaRegistro."+ 1 hour");
 				$nuevaFecha = date("Y-m-d H:i:s", $nuevaFecha);

 				if($fechaActual >= $nuevaFecha){
 					$sqlInsertar = $con->query("INSERT INTO contador (ip, fecha, idproducto, vendedorid) VALUES ('$ip', now(), '$id', '$vend')");
 						}
 			}
 			$visitas = $con->query("SELECT * FROM contador WHERE idproducto=$id");
 			$contar = $visitas->num_rows;
		?> --}}

		<hr>
		 breadcrumb
		<div class="container">
			<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg p-b-20">
				<a href="/" class="stext-109 cl8 hov-cl1 trans-04">
					Inicio
					<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
				</a>
				{{-- <a href="'/tienda/categoria/'.$rutacategoria; ?>" class="stext-109 cl8 hov-cl1 trans-04">
					<?= $arrProducto['categoria'] ?> --}}
					<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
				</a>
				<span class="stext-109 cl4">
					<?= $p['nombre'] ?>
				</span>
				<?php echo '  -'; ?>
				<span class="stext-109 cl4">
					Visitas: {{$p->visits->count()}}
				</span>
			</div>
		</div>
		 producto detalles
		<div class="container m-b-5">
			<div class="row">
			    <div class="col-md-6 tianguis-description">
					<div class="col-lg-12 m-t-8">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe width="540" height="450" class="embed-responsive-item" src="<?php echo $convertedURL; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
					<p><?= $p['estado'] ?></p>
					<h2><?= $p['nombre'] ?>  </h2>
					<P><?= $p['descripcion'];?></P>
					<div class="row">
						<p>Descripcion del ganado</p>
						<div class="col-md-6 tianguis-description--caract">
							<ul>
								<li><b>Peso: </b><?= $p['peso']?> kg <b>&nbsp;&nbsp;&nbsp;Edad: </b><?= $p['edad']?> años</li>
								<hr>
								<li><b>Raza: </b><?= $p['raza']?></li>
								<hr>
								<li><b>Tipo: </b><?= $p['tipo']?></li>
								<hr>
								<li><b>Rancho: </b><?= $p['rancho']?></li>
								<hr>
							</ul>
						</div>
						<div class="col-md-6 tianguis-description--caract">
							<ul>
								<li><b>Arete: </b><?= $p['arete'];?></li>
								<hr>
								<li><b>Certificado: </b><?= $p['certificado']; ?></li>
								<hr>
								<li><b>Vacunado: </b><?= $p['vacunado']; ?></li>
								<hr>
								<li><b>Rancho a cargo: </b><?= $p->owner->nombres?></li>
								<hr>
							</ul>
						</div>
					</div>
					<div class="row product-price">
						<div class="col-md-6"><p><b><?= number_format($p['precio']); ?></b></p></div>
						{{-- <div class="col-md-6">
							<img src="<?= base_url();?>/imagenes/<?= $num['foto'];?>" alt="imagne rancho" class="small-img" style="width: 200px;height: 60px;">
						</div> --}}
						<div class="col-md-6"><a href="https://wa.me/+52<?=$p->owner->email_user;?>" class="btn b btn-lg" style="background-color: #24d265;color: white;">Contactar vía Whats App </a></div>
					</div>
					<div class="col-lg-12 cards-back">
						<div class="cards-back--content">
							<div class="CTA-Form">
								<div class="CTA-Form--header">
									<p class="CTA-P--header">Contacta al vendedor</p>
								</div>
								{!!Form::open(['url'=> 'tienda/producto/'.$p->idproducto.'/'.$p->ruta, 'id' => 'frmContactoT'])!!}
									@csrf
          							<div class="">
          							   <input class="" type="text" id="vendedorid" name="vendedorid" value="<?= $p['vendedorid']; ?>" style="display: none;">

          							</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Nombre Completo</label>
										<input type="text" class="form-control" id="nombreContacto" name="nombreContacto" aria-describedby="emailHelp" placeholder="">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Número celular</label>
										<input type="number" class="form-control" id="emailContacto" name="emailContacto" placeholder="">
										<textarea id="mensaje" name="mensaje" style="display:none;"></textarea>
									</div>
									<button type="submit" class="btn btn-primary">Enviar</button>
								{!!Form::close()!!}
							</div>
						</div>
					</div>
				</div>
					<div class="col-md-6">
					    <div class="gallery js-flickity" style="background-color: none;">
					        <?php for ($i = 0; $i < count($images); $i++) { ?>
					            <a href="{{ asset('uploads/' . $p->carpeta . '/' . $images[$i]['img'] . '.webp') }}" class="gallery-cell" 					data-fancybox="gallery">
                		<img src="{{ asset('uploads/' . $p->carpeta . '/' . $images[$i]['img'] . '.webp') }}" class="d-block w-100" alt="Imagen">
					            </a>
					        <?php } ?>
					    </div>
					</div>
					<div id="modal" class="modal">
					    <span class="close">&times;</span>
					    <img class="modal-content" id="expandedImg">
					</div>
					<h6><i class="fas fa-eye"></i><?php //echo $contar; ?></h6>
					<div class="col-md-6">
						<div class="btn_wrap">
							<span>Compartir</span>
							<div class="container-btn">
								<div class="fb-share-button" data-href="URL_DE_TU_ARTICULO" data-layout="button" data-size="small">
  									<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$urlShared;?>&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore"><i class="fab fa-facebook-f"></i></a>
									</div>
								<a href="https://api.whatsapp.com/send?text=<?=$p['ruta'];?>%20<?=$urlShared;?>" data-action="share/whatsapp/share"><i id="whats" class="fab fa-whatsapp" style="color:#23c861;"></i></a>

                                <a href="<?=$urlShared?>">
                                    <i class="fa-solid fa-link" id="copyLinkBtn" name="testA" ></i>
                                </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



	</body>
	</html>

@if(Session::has('alert.success'))
    <script>
        Swal.fire('Éxito', '{{ Session::get('alert.success') }}', 'success');
    </script>
@endif -->
<div class="productTienda-section">
    <div class="banner-product--genetica">
        <h1>Ganado genético</h1>
    </div>
    <div class="container-product--Main">
        <div class="route">
            <p>Inicio<span>></span></p><p>Ganado genético</p><span>></span><p>{{$p->nombre}}</p>
        </div>
        <div class="information-product--container">
            <div class="container">
                <div class="parent">
               {{--  @if($p->link)                    
                <div class="div1">
                       <img onclick="swapImages('div1')" src="{{asset('uploads/'.$p->carpeta.'/'.$p->portada.'.webp')}}" alt="Imagen 1">
                   </div>
                @else --}}
                    <div class="div1">
                    	@if(isset($images[0]))
    						<img class="left"  onclick="swapImages('div1')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[0]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
               {{--  @endif --}}
                    <div class="div2">
                			@if(isset($images[1]))
    						<img class="left" onclick="swapImages('div2')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[1]['img'] . '.webp') }}" alt="Imagen 1">
							@endif
                    </div>
                    <div class="div3">
                			@if(isset($images[2]))
    						<img class="left" onclick="swapImages('div3')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[2]['img'] . '.webp') }}" alt="Imagen 1">
							@endif
                    </div>
                    <div class="div4">
                    <div class="right-container">
                    	{{-- @if($p->link)
                    	<iframe width="540" onclick="swapImages('div4')" height="450" class="embed-responsive-item" src="<?php echo $convertedURL; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      <button class="fullscreen-button" onclick="openFullscreen()">
                                <img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/fullscreen.png" alt="fullscreen"/>
                            </button>
                            <span class="close-button" onclick="closeFullscreen()">CERRAR</span>
                    	@else --}}
                        <img onclick="swapImages('div4')" src="{{asset('uploads/'.$p->carpeta.'/'.$p->portada.'.webp')}}" alt="Imagen 1">
                        <button class="fullscreen-button" onclick="openFullscreen()">
                                <img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/fullscreen.png" alt="fullscreen"/>
                            </button>
                            <span class="close-button" onclick="closeFullscreen()">CERRAR</span>
                        {{-- @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="information-product">
                <p class="description">{{$p->nombre}}</p>
                <p class="raza">{{$p->location->nombre}} , {{$p->ciudades->nombre}}</p>
                <p class="description">${{$p->precio}} MXN</p>
                <p class="info">{{substr($p->descripcion, 0, 50)}}</p>
                <div class="contact-button">
                    <button class="secondaryButton">Contacto</button>
                    <a id="openModal" href="#">Hacer contacto <span>></span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="description-product">
        <div class="desc-left">
        	Visitas: {{$p->visits->count()}}
            <p>{{$p->descripcion}} <span> </span></p>
        </div>
        <div class="desc-right">
            <h2>Descripción del Ganado</h2>
            <div class="container-desc">
                <div class="desc1"><span>Peso: </span><p>{{$p->peso}}</p></div>
                <div class="desc2"><span>Edad: </span><p>{{$p->edad}}</p></div>
                <div class="desc3"><span>Raza: </span><p>{{$p->raza}}</p></div>
                <div class="desc4"><span>Tipo: </span><p>{{$p->tipo}}</p></div>
                <div class="desc5"><span>Rancho:</span><p>{{$p->rancho}}</p></div>
                <div class="desc6"><span>Arete: </span><p>{{$p->arete}}</p></div>
                <div class="desc7"><span>Certificado:</span><p>{{$p->certificado}}</p></div>
                <div class="desc8"><span>A cargo</span><p>{{$p->owner->nombres}} {{$p->owner->apellidos}}</p></div>
            </div>
            <hr>
{{--             <h2>Reseñas del ganado</h2>
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
            </div> --}}
        </div>
    </div>
    <div class="relationated-product">
        <p class="interest">Más ganado que te podría interesar</p>
        <div class="relationated-product-cards">
    		@for ($index = 0; $index <= 5; $index++)
       	 		@if (isset($random[$index]))
            	<div class="card-relationated">
            	    <img class="img-products" src="{{ asset('uploads/'.$random[$index]->carpeta.'/'.$random[$index]->portada.'.webp') }}" alt="" srcset="">
            	    <div class="card-description">
            	        <div class="icons">
            	            {{-- <img src="{{ asset('static/new/Iconos/pinestrella.png') }}" alt="">
            	            <img src="{{ asset('static/new/Iconos/pinmoño.png') }}" alt="">
            	            <img src="{{ asset('static/new/Iconos/pinvaca.png') }}" alt=""> --}}
            	        </div>
            	        <div class="card-description--info">
            	            <p class="raza">{{$random[$index]->nombre}}</p>
            	            <p class="description" >{{$random[$index]->nombre}}</p>
            	            <button class="secondaryButton" onclick="location.href='/tienda/producto/{{$random[$index]->idproducto}}/{{$random[$index]->ruta}}'">Ver más</button>
            	        </div>
            	    </div>
            	</div>
        		@endif
    		@endfor
            @if (is_null($random))
        		<p>Por el momento no existen elementos para mostrar</p>
    		@endif
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
		{!!Form::open(['url'=> 'tienda/producto/'.$p->idproducto.'/'.$p->ruta, 'id' => 'frmContactoT'])!!}
		@csrf
			<input class="" type="text" id="vendedorid" name="vendedorid" value="<?= $p['vendedorid']; ?>" style="display: none;">
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
        {!!Form::close()!!}
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
