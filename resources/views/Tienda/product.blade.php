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
                    <div class="div1">
                    	@if(isset($images[0]))
    						<img class="left"  onclick="swapImages('div1')" src="{{asset('uploads/'.$p->carpeta.'/'.$p->portada.'.webp')}}" alt="Imagen 1">
						@endif
                    </div>
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
						@if(isset($images[3]))
						<img class="left" onclick="swapImages('div4')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[3]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
					<div class="div5">
						@if(isset($images[4]))
						<img class="left" onclick="swapImages('div5')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[4]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
					<div class="div6">
						@if(isset($images[5]))
						<img class="left" onclick="swapImages('div6')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[5]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
					<div class="div7">
						@if(isset($images[6]))
						<img class="left" onclick="swapImages('div7')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[6]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
					<div class="div8">
						@if(isset($images[7]))
						<img class="left" onclick="swapImages('div8')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[7]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
					<div class="div9">
						@if(isset($images[8]))
						<img class="left" onclick="swapImages('div9')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[8]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
					<div class="div10">
						@if(isset($images[9]))
						<img class="left" onclick="swapImages('div10')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[9]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
					<div class="div11">
						@if(isset($images[10]))
						<img class="left" onclick="swapImages('div11')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[10]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
					<div class="div12">
						@if(isset($images[10]))
						<img class="left" onclick="swapImages('div12')" src="{{ asset('uploads/' . $p->carpeta . '/' . $images[11]['img'] . '.webp') }}" alt="Imagen 1">
						@endif
                    </div>
                    <div class="div13">
						<div class="right-container">
                            <img class="right" id="mainImage" src="{{ asset('uploads/' . $p->carpeta . '/' . $p->portada . '.webp') }}" alt="Imagen Principal">
                            <button class="fullscreen-button" onclick="openFullscreen()">
								<img width="24" height="24" src="https://img.icons8.com/fluency-systems-regular/48/fullscreen.png" alt="fullscreen"/>
							</button>
							<span class="close-button" onclick="closeFullscreen()">CERRAR</span>
						</div>
                    </div>
                </div>
				<div class="youtube-link">
					@if(count($video) > 0)
					<video width="500" height="500" controls>
					  	<source src="{{asset('uploads/videos/'.$video[0]->ruta)}}" type="video/mp4">
					  		<source src="movie.ogg" type="video/ogg">
						Your browser does not support the video tag.
					</video>
					@endif
				</div>
				{{-- <div class="youtube-link">
					@if($p->link)
						<iframe width="100%" height="250" class="embed-responsive-item" src="<?php echo $convertedURL; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					@endif
				</div> --}}
            </div>
            <div class="information-product">
			    <p class="description">{{$p->nombre}}</p>
			    <p class="raza">{{$p->location->nombre}} , {{$p->ciudades->nombre}}</p>
			    <p class="description">${{$p->precio}} MXN</p>
			    <p class="info">{{substr($p->descripcion, 0, 50)}}</p>
			    
			    <div class="contact-button">
				    @if($p->permitir_contacto_personal && $p->owner && $p->owner->email_user)
				        {{-- Mostrar contacto directo cuando el vendedor lo permite --}}
				        <a href="https://wa.me/+52{{ $p->owner->email_user }}"
				           style="
				               display: inline-block;
				               background-color: var(--red-subasta);
				               color: #fff;
				               padding: 12px 20px;
				               border-radius: 999px;
				               text-decoration: none;
				               font-weight: 600;
				               text-align: center;
				           ">
				            <i class="fab fa-whatsapp"></i> Contactar al {{ $p->owner->email_user }}
				        </a>
				    @endif
					<div class="contact-button">
					    {{-- Mostrar modal de contacto cuando el vendedor NO permite contacto directo --}}
					    <a id="openModal" href="#"
					       style="display: inline-block;background-color: var(--red-subasta);color: #fff;padding: 12px 20px;border-radius: 999px;text-decoration: none;font-weight: 600;text-align: center;
					       ">
					        Hacer contacto a traves de la plataforma
					    </a>
					</div>
			    </div>
			</div>
        </div>
    </div>
    <style>
	    .review-form {
	        margin-top: 20px;
	        padding: 20px;
	        background: #f9f9f9;
	        border-radius: 12px;
	        box-shadow: 0 0 8px rgba(0,0,0,0.05);
	    }
	    .review-form h3 {
	        margin-bottom: 15px;
	        color: #333;
	    }
	    .review-form input,
	    .review-form textarea {
	        width: 100%;
	        padding: 10px 12px;
	        margin-bottom: 12px;
	        border: 1px solid #ccc;
	        border-radius: 6px;
	        font-size: 15px;
	    }
	    .review-form button {
	        background-color: #4CAF50;
	        color: #fff;
	        border: none;
	        padding: 10px 20px;
	        font-size: 15px;
	        border-radius: 6px;
	        cursor: pointer;
	    }
	    .review-form button:hover {
	        background-color: #45a049;
	    }

	    .stars {
	        display: flex;
	        flex-direction: row-reverse;
	        justify-content: flex-end;
	        margin-bottom: 12px;
	    }
	    .stars input { display: none; }
	    .star {
	        font-size: 28px;
	        color: #ccc;
	        cursor: pointer;
	        transition: color 0.2s;
	        margin-left: 5px;
	    }
	    .star.checked {
	        color: #f0c040;
	    }

	    .review {
	        margin-bottom: 18px;
	        padding-bottom: 12px;
	        border-bottom: 1px solid #e3e3e3;
	    }
	</style>
	<div class="description-product">
		<div class="desc-left">
		    <p><strong>Visitas:</strong> {{ $p->visits->count() }}</p>
		    <p>{{ $p->descripcion }}</p>

		    {{-- FORM DE RESEÑA --}}
		    <div class="review-form">
		        <h3>Deja tu reseña</h3>
		        @if(session('success'))
		            <p style="color:green">{{ session('success') }}</p>
		        @endif
		        <form action="{{ route('reviews.store', ['product' => $p->idproducto]) }}" method="POST">
		            @csrf

		            {{-- Honeypot anti-spam --}}
		            <input type="text" name="website" style="display:none">

		            {{-- Estrellas --}}
		            <div class="stars" id="starWrapper">
		                @for($i=5;$i>=1;$i--)
		                    <label class="star" data-value="{{ $i }}">&#9733;</label>
		                    <input type="radio" name="estrellas" value="{{ $i }}">
		                @endfor
		            </div>

		            <input type="text"  name="nombre"   placeholder="Tu nombre" required>
		            <input type="text"  name="telefono" placeholder="Teléfono (opcional)">
		            <input type="text"  name="rancho"   placeholder="Rancho (opcional)">
		            <textarea name="mensaje" rows="4" placeholder="Cuéntanos tu experiencia..." required></textarea>

		            <button type="submit">Enviar reseña</button>
		        </form>
		    </div>

		    {{-- LISTA DE RESEÑAS --}}
		    <div style="margin-top: 30px;">
		        <h3>Reseñas ({{ $p->reviews->count() }})</h3>
		        @forelse($p->reviews as $r)
		            <div class="review">
		                <div>
		                    @for($i=1;$i<=5;$i++)
		                        <span style="color:{{ $i <= $r->estrellas ? '#f0c040':'#ccc' }}">&#9733;</span>
		                    @endfor
		                    <strong>{{ $r->nombre }}</strong>
		                    <small>· {{ $r->created_at->diffForHumans() }}</small>
		                </div>
		                <p>{{ $r->mensaje }}</p>
		                @if($r->rancho || $r->telefono)
		                    <small>
		                        @if($r->rancho) Rancho: {{ $r->rancho }} @endif
		                        @if($r->telefono) · Tel: {{ $r->telefono }} @endif
		                    </small>
		                @endif
		            </div>
		        @empty
		            <p>(Aún sin reseñas)</p>
		        @endforelse
		    </div>
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
            	            <p class="description" >{{$random[$index]->precio}}</p>
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
	            <label for="perfil_comprador">Selecciona tu perfil: <span style="color: red;">*</span></label>
	            <select id="perfil_comprador" name="perfil_comprador" required>
	                <option value="">-- Seleccionar --</option>
	                <option value="particular">Particular</option>
	                <option value="emprendedor_ganadero">Emprendedor Ganadero</option>
	                <option value="intermediario">Intermediario</option>
	                <option value="productor_ganadero">Productor Ganadero</option>
	            </select>
	        </div>
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Teléfono:</label>
                <input type="tel" id="phone" name="phone">
            </div>   
	        <div class="form-group checkbox-group">
	            <label>
	                <input type="checkbox" id="requiere_factura" name="requiere_factura" value="1">
	                Requiero factura
	            </label>
	        </div>
	        <!-- Rancho (solo visible para ciertos perfiles) -->
	        <div class="form-group" id="div_rancho" style="display: none;">
	            <label for="rancho">Rancho:</label>
	            <input type="text" id="rancho" name="rancho" placeholder="Nombre del rancho">
	        </div>

	        <!-- Nombre de Asociación (solo para Productor Ganadero) -->
	        <div class="form-group" id="div_asociacion" style="display: none;">
	            <label for="nombre_asociacion">Nombre de la Asociación: <span style="color: red;">*</span></label>
	            <input type="text" id="nombre_asociacion" name="nombre_asociacion">
	        </div>
	        <!-- RFC (solo si requiere factura) -->
	        <div class="form-group" id="div_rfc" style="display: none;">
	            <label for="rfc">RFC: <span style="color: red;">*</span></label>
	            <input type="text" id="rfc" name="rfc" maxlength="13" placeholder="Ej: XAXX010101000">
	        </div>
	        <div class="form-group">
                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>        
            <div class="form-group checkbox-group">
	            <label>
	                <input type="checkbox" id="pregunta_incluye_envio" name="pregunta_incluye_envio" value="1">
	                ¿Incluye envío?
	            </label>
	        </div>
            <button class="mainButtonC" type="submit">Enviar</button>
        {!!Form::close()!!}
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
            <a href="https://wa.me/1234567890" target="_blank" class="action-btn whatsapp-btn">WhatsApp</a>
            <a href="mailto:ganado.yucatan@gmail.com?subject=Consulta&body=Hola,%20necesito%20información%20sobre%20los%20productos%20de%20su%20página" class="action-btn contact-btn">Contactar</a>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const perfilSelect = document.getElementById('perfil_comprador');
    const divRancho = document.getElementById('div_rancho');
    const divAsociacion = document.getElementById('div_asociacion');
    const divRfc = document.getElementById('div_rfc');
    const requiereFactura = document.getElementById('requiere_factura');
    const nombreAsociacion = document.getElementById('nombre_asociacion');

    // Manejar cambios en el perfil
    perfilSelect.addEventListener('change', function() {
        const perfil = this.value;
        
        // Mostrar/ocultar campo rancho
        if (['emprendedor_ganadero', 'intermediario', 'productor_ganadero'].includes(perfil)) {
            divRancho.style.display = 'block';
        } else {
            divRancho.style.display = 'none';
            document.getElementById('rancho').value = '';
        }
        
        // Mostrar/ocultar campo asociación
        if (perfil === 'productor_ganadero') {
            divAsociacion.style.display = 'block';
            nombreAsociacion.required = true;
        } else {
            divAsociacion.style.display = 'none';
            nombreAsociacion.required = false;
            nombreAsociacion.value = '';
        }
    });

    // Manejar checkbox de factura
    requiereFactura.addEventListener('change', function() {
        const rfcInput = document.getElementById('rfc');
        if (this.checked) {
            divRfc.style.display = 'block';
            rfcInput.required = true;
        } else {
            divRfc.style.display = 'none';
            rfcInput.required = false;
            rfcInput.value = '';
        }
    });

    // Validación de RFC
    document.getElementById('rfc').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
});
</script>

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
    const images = [
        @if(isset($images[0]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $p->portada . '.webp') }}",
        @endif
        @if(isset($images[1]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[1]['img'] . '.webp') }}",
        @endif
        @if(isset($images[2]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[2]['img'] . '.webp') }}",
        @endif
        @if(isset($images[3]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[3]['img'] . '.webp') }}",
        @endif
        @if(isset($images[4]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[4]['img'] . '.webp') }}",
        @endif
        @if(isset($images[5]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[5]['img'] . '.webp') }}",
        @endif
        @if(isset($images[6]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[6]['img'] . '.webp') }}",
        @endif
        @if(isset($images[7]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[7]['img'] . '.webp') }}",
        @endif
        @if(isset($images[8]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[8]['img'] . '.webp') }}",
        @endif
        @if(isset($images[9]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[9]['img'] . '.webp') }}",
        @endif
        @if(isset($images[10]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[10]['img'] . '.webp') }}",
        @endif
        @if(isset($images[11]))
        "{{ asset('uploads/' . $p->carpeta . '/' . $images[11]['img'] . '.webp') }}",
        @endif
        "{{ asset('uploads/' . $p->carpeta . '/' . $p->portada . '.webp') }}"
    ];

    function swapImages(divId) {
        var clickedImageSrc = document.querySelector('.' + divId + ' img').src;
        document.getElementById('mainImage').src = clickedImageSrc;
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

    function closeFullscreenModal() {
        document.getElementById('fullscreenModal').classList.add('hidden');
    }

    function navigateImage(direction) {
        currentImageIndex = (currentImageIndex + direction + images.length) % images.length;
        document.getElementById('fullscreenImage').src = images[currentImageIndex];
    }

    function contactUser() {
        alert('Función de contacto no implementada aún.');
    }
    ///resenas 
    document.addEventListener('DOMContentLoaded', () => {
        const wrapper = document.getElementById('starWrapper');
        wrapper?.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', () => {
                const val = star.dataset.value;
                wrapper.querySelector(`input[value="${val}"]`).checked = true;
                wrapper.querySelectorAll('.star').forEach(s => {
                    s.classList.toggle('checked', s.dataset.value <= val);
                });
            });
        });
    });
</script>
@endsection
