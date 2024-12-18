@extends('layout')

@section('content')
	<!-- <section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="row">
				<div class="col-md-3 p-t-84">
					<span>Filtro avanzado</span>
					<form class="tianguis-form" method="get" action="/tianguis/testT" >
						<div class="row">
							<div class="col filter-tianguis">
								<label for="estados">Estado</label>
								<select id="estados">
									<option value="" selected disabled hidden>Estado</option>
								</select>
								<input style="display:none;" type="text" id="estado1" name="estado1">
								<br>
							</div>
							<div class="w-100"></div>
							<div class="col filter-tianguis">
								<label for="ciudades">Ciudad:</label>
								<select id="ciudades">
									<option value="" selected disabled hidden>Ciudad</option>
								</select>
							</div>
							<div class="w-100"></div>
							<div class="col filter-tianguis">
								<select class="form-control selectpicker" id="lisTipo" name="lisTipo" >
									<option value="" selected disabled hidden>Seleccione un tipo</option>
									<option value="Destetes">Destetes</option>
									<option value="Novillas">Novillas</option>
									<option value="Ternero">Ternero</option>
									<option value="Toro de engorda">Toro de engorda</option>
									<option value="Vaca de engorda">Vaca de engorda</option>
									<option value="Vaquillona">Vaquillona</option>
									<option value="Vaquillonas preñadas">Vaquillonas preñadas</option>
									<option value="Ganado para matadero">Ganado para matadero</option>
									<option value="Vaca terminada<">Vaca terminada</option>
									<option value="Toro terminado">Toro terminado</option>
									<option value="Novillonas de registro">Novillonas de registro</option>
									<option value="Novillonas preñada">Novillonas preñadas</option>
									<option value="Toro para cebar">Toro para cebar</option>
									<option value="Vaca para cebar">Vaca para cebar</option>
									<option value="Vaca Semiterminada">Vaca Semiterminada</option>
									<option value="Toro Semiterminado">Toro Semiterminado</option>
								</select>
							</div>
							<div class="w-100"></div>
							<div class="col filter-tianguis">
								<input type="number" class="form-control" name="price" id="price" placeholder="Precio mínimo">
							</div>
							<input style="display:none;" type="text" id="ciudad1" name="ciudad1">
							<div class="w-100"></div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<button type="submit" class="btn btn-dark btn-sm btn-block">
									Enviar
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-9">
					<div class="bg0 p-t-23 p-b-140">
						<div class="container">
							<div class="p-b-10 p-t-23">
								<h3 class="ltext-103 cl5">
									Ganado Genético Peninsular
								</h3>
							</div>
							<hr>
							<div class="row">
								@foreach($products as $p)
									<div class="col-md-4">
										<div class="card mb-3">
											<img class="card-img-top" src="{{asset('uploads/'.$p->carpeta.'/'.$p->portada.'.webp')}}" alt="FotoProducto">
											<p id="counting"></p>
											<div class="card-body card-premium">
												<h5 class="card-title">{{$p->raza}}</h5>
												<p  class="card-location">{{$p->categoria}}</p>
												<p  class="card-text">{{$p->nombre}}</p>
												<div class="row">
													<div class="col-sm price">
														<p><?= number_format($p->precio) ?></p>
													</div>
													<div class="col-sm">
														<a onclick="countingClicks()" href="<?= '/tienda/producto/'.$p->idproducto.'/'.$p->ruta; ?>" class="btn btn-primary btn-lg">Ver más</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									@endforeach
							</div>
							<!-- Load more
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->

    <!--
        TODO Nueva sección de tienda
    -->
    <div class="tienda-section">
		<div class="banner-main-genetico">
			<img class="icon-banner" src="{{ asset('static/new/Iconos/geneticoMoño.png') }}" alt="">
			<h1>GANADO GENÉTICO</h1>
			<p>Las mejores razas del sureste las encuentras aquí</p>
            <p>Bienvenido Ganadero</p>
		</div>
		<div class="container-tienda">
			<div class="filtro-container">
                <div class="filtro-container-info">
                    <h2>Filtro</h2>
                    <hr>
                    <form class="tianguis-form" action="/tianguis/testT" method="get"></form>
                    <div class="filtro-container-down">
{{--                         <h3>Filtrar por preferencia</h3>
                        <div class="filter-preference">
                            <img src="{{ asset('static/new/Iconos/vacanegra.png') }}" alt="">
                            <div class="text-input-container">
                                <p>Ganado comercial</p>
                                <input type="radio" class="radio-input" id="opcion1" name="opcion" value="opcion1">
                            </div>
                        </div>
                        <div class="filter-preference">
                            <img src="{{ asset('static/new/Iconos/estrellanegro.png') }}" alt="">
                            <div class="text-input-container">
                                <p>Destacado</p>
                                <input type="radio" class="radio-input" id="opcion1" name="opcion" value="opcion1">
                            </div>
                        </div>
                        <div class="filter-preference">
                            <img src="{{ asset('static/new/Iconos/relojnegro.png') }}" alt="">
                            <div class="text-input-container">
                                <p>Urgente</p>
                                <input type="radio" class="radio-input" id="opcion1" name="opcion" value="opcion1">
                            </div>
                        </div> --}}
                        <hr>
                        <h3>Filtrar por locación</h3>
                        <div class="label-dropdown">
                            <select id="estados">
                                <option value="" selected disabled hidden>Estado</option>
                                @foreach($estados as $e)
                                	<option value="{{$e->id}}" data-estado-id="{{$e->id}}">{{$e->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="label-dropdown">
                            <select id="ciudades">
								<option value="" selected disabled hidden>Ciudad</option>
							</select>
                        </div>
                        <div class="label-dropdown">
                            <select class="form-control selectpicker" id="lisTipo" name="lisTipo" >
								<option value="" selected disabled hidden>Seleccione un tipo</option><option value="Toro">Toro</option>
                              <option value="Torete">Torete</option>
                              <option value="Novillonas de registro puro">Novillonas de registro puro</option>
                              <option value="Destetes de resgistro puro">Destetes de resgistro puro </option>
                              <option value="Semental joven">Semental joven</option>
                              <option value="Semental">Semental</option>
							</select>
                        </div>
                        <hr>
                        <div class="card">
                            <h4>Rango de precio: $</h4>

                            <div class="price-content">
                                <div>
                                <label>Min</label>
                                <p id="min-value">$20000</p>
                                </div>

                                <div>
                                <label>Max</label>
                                <p id="max-value">$50000</p>
                                </div>
                            </div>

                            <div class="range-slider">
                                <div class="range-fill"></div>
                                <input type="range" class="min-price" value="200000" min="20000" max="500000" step="10000" />
                                <input type="range" class="max-price" value="300000" min="20000" max="500000" step="10000" />
                            </div>
                        </div>
                        <div class="align-center">
                            <button id="filterButton" class="mainButtonB">Buscar</button>
                        </div>
                    </div>
                </div>
			</div>
            <div class="container-cards">
                <p class="title-container--cards">Publicaciones destacadas</p>
                <div class="container-destacadas">
    			@for ($index = 0; $index <= 2; $index++)
       	 			@if (isset($random[$index]))
                    	<div class="card-tianguis">
                    	    <img class="img-products" src="{{asset('uploads/'.$random[$index]->carpeta.'/'.$random[$index]->portada.'.webp')}}" alt="" srcset="">
                    	    <div class="card-description">
                    	        <div class="icons">
                    	            {{-- <img src="{{ asset('static/new/Iconos/reloj-verde.png') }}" alt="">
                    	            <img src="{{ asset('static/new/Iconos/estrella-verde.png') }}" alt="">
                    	            <img src="{{ asset('static/new/Iconos/vaca-verde.png') }}" alt=""> --}}
                    	        </div>
                    	        <div class="card-description--info">
                    	            <p class="raza">{{$random[$index]->nombre}}</p>
                    	            <p class="description" >{{substr($random[$index]->descripcion, 0, 15)}}</p>
                    	            <button class="buttonTienda" onclick="location.href='/tienda/producto/{{$random[0]->idproducto}}/{{$random[0]->ruta}}'">Ver más</button>
                    	        </div>
                    	        <div class="card-description--footer">
                    	            <p>{{$random[$index]->location->nombre}} , {{$random[$index]->ciudades->nombre}}</p>
                    	        </div>
                    	    </div>
                    	</div>
                    @endif
                @endfor
                <div class="publicidad-container">
                    <hr>
                    <h1 class="content-publicidad">Espacio <br>publicitario</h1>
                    <button class="secondaryButton" id="openModal" style="margin-left: 2rem;">Solicitar <br>publicidad</button>
                </div>
                <p class="title-container--cards">Ganado genético</p>
                <div class="container-normal">
                    @foreach($products as $p)
                        <div class="card-tianguis--normal">
                            <img class="img-products" src="{{asset('uploads/'.$p->carpeta.'/'.$p->portada.'.webp')}}" alt="" srcset="">
                            <div class="card-description">
                                <div class="icons">
                                    {{-- <img src="{{ asset('static/new/Iconos/relojDorado.png') }}" alt="">
                                    <img src="{{ asset('static/new/Iconos/vacaDorada.png') }}" alt="">
                                    <img src="{{ asset('static/new/Iconos/estrellaDorada.png') }}" alt=""> --}}
                                </div>
                                <div class="card-description--info">
                                    <p class="raza">{{$p->raza}}</p>
                                    <p class="description" >{{$p->nombre}}</p>
                                    <button class="buttonTienda" onclick="location.href='<?= '/tienda/producto/'.$p->idproducto.'/'.$p->ruta; ?>'">Ver más</button>
                                </div>
                                <div class="card-description--footer">
                                    <p>{{$p->location->nombre}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
        {!! Form::open(['url' => '/contactInfo', 'id' => 'frmContactoT', 'enctype' => 'multipart/form-data']) !!}
             @csrf
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
            <button class="mainButtonC" type="submit">Enviar mensaje</button>
        {!! Form::close() !!}
		</form>
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
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const inputElements = document.querySelectorAll(".range-slider input");
  const minValue = document.getElementById("min-value");
  const maxValue = document.getElementById("max-value");
  const rangeFill = document.querySelector(".range-fill");

  // Function to validate range and update the fill color on slider
  function validateRange() {
    const minPrice = parseInt(inputElements[0].value);
    const maxPrice = parseInt(inputElements[1].value);

    if (minPrice > maxPrice) {
      const tempValue = maxPrice;
      maxPrice = minPrice;
      minPrice = tempValue;
    }

    const minPercentage = ((minPrice) / 500) * 100;
    const maxPercentage = ((maxPrice) / 500) * 100;

    rangeFill.style.left = minPercentage + "%";
    rangeFill.style.width = maxPercentage - minPercentage + "%";

    minValue.innerHTML = "$" + minPrice;
    maxValue.innerHTML = "$" + maxPrice;
  }

  // Add an event listener to each input element
  inputElements.forEach((element) => {
    element.addEventListener("input", validateRange);
  });

  // Initial call to validateRange
  validateRange();
});
/*select ciudades*/
document.addEventListener('DOMContentLoaded', function(){
    var estadoSelected = document.getElementById('estados');
    var ciudadesSelect = document.getElementById('ciudades');

    estadoSelected.addEventListener('change', function(){
        var estadoId = this.options[this.selectedIndex].getAttribute('data-estado-id');

        getCiudades(estadoId, function (ciudades) {
            ciudadesSelect.innerHTML = '<option value="" selected disabled hidden>Ciudad</option>';
            ciudades.forEach(function (ciudad) {
                var option = document.createElement('option');
                option.value = ciudad.id;
                option.text = ciudad.nombre;
                ciudadesSelect.add(option);
            });
            ciudadesSelect.removeAttribute('disabled');
        });
    });
	function getCiudades(estadoId, callback){
		fetch('/get-ciudades-by-estado/' + estadoId).then(response => response.json()).then(data => callback(data)).catch(error => console.error("Error al obtener ciudades", error));
	}
	var estadosSelect = document.getElementById('estados');
	var ciudadesSelect = document.getElementById('ciudades');
	var lisTipoSelect = document.getElementById('lisTipo');
	var minPriceInput = document.querySelector('.min-price');
	//var maxPriceInput = document.getElementById("max-value");
	var buscarFitlro = document.getElementById('filterButton');

	buscarFitlro.addEventListener('click', function() {
		actualizarFiltros();
	});

	function actualizarFiltros() {
    	var estadoId = estadosSelect.options[estadosSelect.selectedIndex].getAttribute('data-estado-id');
    	var ciudadId = ciudadesSelect.value ? ciudadesSelect.value : null;
    	var lisTipo = lisTipoSelect.value ?  lisTipoSelect.value : null;
    	var minPrice = minPriceInput.value ? minPriceInput.value : null;
    	//var maxPrice = maxPriceInput.value ? maxPriceInput : null;
    	queryEstado = '';
    	queryCiudad = '';
    	queryTipo = '';
    	queryMin = '';
    	queryMax = '';
    	if(estadoId != null){
    		queryEstado = 'estado_id=' + estadoId;
    	}
    	if(ciudadId != null){
    		queryCiudad = '&ciudad_id=' + ciudadId;
    	}
    	if(lisTipo != null){
    		queryTipo = '&lisTipo=' + lisTipo;
    	}if(minPrice != null){
    		queryMin = '&min_price=' + minPrice;
    	}/*if(maxPrice != null){
    		queryMax = '&max_price=' + maxPrice;
    	}*/

		window.location.href = '/tienda?' + queryEstado + queryCiudad + queryTipo + queryMin + queryMax; //+  +  '&min_price=' + minPrice + '&max_price=' + maxPrice;
	}
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const inputElements = document.querySelectorAll(".range-slider input");
  const minValue = document.getElementById("min-value");
  const maxValue = document.getElementById("max-value");
  const rangeFill = document.querySelector(".range-fill");

  function validateRange() {
    const minPrice = parseInt(inputElements[0].value);
    const maxPrice = parseInt(inputElements[1].value);

    if (minPrice > maxPrice) {
      const tempValue = maxPrice;
      maxPrice = minPrice;
      minPrice = tempValue;
    }


    const minPercentage = ((minPrice - 20000) / 480000) * 100;
    const maxPercentage = ((maxPrice - 20000) / 480000) * 100;

    rangeFill.style.left = minPercentage + "%";
    rangeFill.style.width = maxPercentage - minPercentage + "%";

    minValue.innerHTML = "$" + minPrice;
    maxValue.innerHTML = "$" + maxPrice;
  }

  inputElements.forEach((element) => {
    element.addEventListener("input", validateRange);
  });

  validateRange();
});
</script>


@endsection
