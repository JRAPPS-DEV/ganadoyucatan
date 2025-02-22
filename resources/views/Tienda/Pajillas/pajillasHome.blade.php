@extends('layout')
@section('content')
<head>
	<title>Pajillas de semen bovino - Ganado Yucatán</title>
</head>

	<!-- //TODO Nueva sección de tienda -->
	<div class="tienda-section">
		<div class="banner-main-pajillas">
			<img class="icon-banner" src="{{ asset('static/new/Iconos/tianguis.png') }}" alt="">
			<h1>Pajillas de semen bovino</h1>
			<p>Pajillas de Semen Bovino de alta genética- Mejora Genética Garantizada para tu Rebaño</p>
		</div>
		<div class="container-tienda">
			<div class="filtro-container">
                <div class="filtro-container-info">
                    <h2>Filtro</h2>
                    <hr>
                    <form class="tianguis-form" action="/tianguis/testT" method="get"></form>
                    <div class="filtro-container-down">
                        <h3>Filtrar por preferencia</h3>
                        <hr>
                        <h3>Filtrar por locación</h3>
                        <div class="label-dropdown">
                            <select id="estados">
                                <option value="" selected disabled hidden>Estado</option>
                                {{-- @foreach($estados as $e)
                                	<option value="{{$e->id}}" data-estado-id="{{$e->id}}">{{$e->nombre}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="label-dropdown">
                            <select id="ciudades">
								<option value="" selected disabled hidden>Ciudad</option>
							</select>
                        </div>
                        <div class="label-dropdown">
                            <select class="form-control selectpicker" id="lisTipo" name="lisTipo" >
								<option value="" selected disabled hidden>Seleccione un tipo</option>
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
                                <option value="Toro Castrado">Toro Castrado</option>
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
{{--                 <div class="container-destacadas">
                    @foreach($products as $p)
                    <div class="card-tianguis">
                        @php
                            $portada = $p->imagenes->first()->url_imagen ?? 'https://via.placeholder.com/400';
                        @endphp
                        <img class="img-products" src="{{ asset('storage/' . $portada) }}" alt="Imagen de {{ $p->nombre }}">
                        <div class="card-description">
                            <div class="icons">
                                <img src="{{ asset('static/new/Iconos/reloj-verde.png') }}" alt="">
                                <img src="{{ asset('static/new/Iconos/estrella-verde.png') }}" alt="">
                                <img src="{{ asset('static/new/Iconos/vaca-verde.png') }}" alt="">
                            </div>
                            <div class="card-description--info">
                                <p class="raza">{{ $p->raza }}</p>
                                <p class="description">{{ $p->nombre }}</p>
                                <p class="precio">${{ number_format($p->precio, 2) }}</p>
                                <a href="{{ route('pajilla.detalle', $p->idproducto) }}">
                                    <button class="buttonTienda">Ver más</button>
                                </a>
                            </div>
                            <div class="card-description--footer">
                                <p>{{ $p->location->nombre }}, {{ $p->rancho }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div> --}}

                <div class="publicidad-container">
                    <hr>
                    <h1 class="content-publicidad">Espacio <br>publicitario</h1>
                    <button class="warningButton" id="openModal" style="margin-left: 2rem;">Solicitar <br>publicidad</button>
                </div>

                <p class="title-container--cards">Pajillas en venta</p>
                <div class="container-normal">
                    @foreach($products as $p)
                    <div class="card-tianguis--normal">
                        @php
                            $portada = $p->imagenes->first()->url_imagen ?? 'https://via.placeholder.com/400';
                        @endphp
                        <img class="img-products" src="{{ asset('uploads/pajilla/' . $portada) }}" alt="Imagen de {{ $p->nombre }}">
                        <div class="card-description">
                            <div class="icons">
                                <img src="{{ asset('static/new/Iconos/reloj-verde.png') }}" alt="">
                                <img src="{{ asset('static/new/Iconos/estrella-verde.png') }}" alt="">
                                <img src="{{ asset('static/new/Iconos/vaca-verde.png') }}" alt="">
                            </div>
                            <div class="card-description--info">
                                <p class="raza">{{ $p->raza }}</p>
                                <p class="description">{{ $p->nombre }}</p>
                                <p class="precio">${{ number_format($p->precio, 2) }}</p>
                                <a href="{{ route('pajilla.detalle', $p->idproducto) }}">
                                    <button class="buttonTienda">Ver más</button>
                                </a>
                            </div>
                            <div class="card-description--footer">
                                <p>{{ $p->location->nombre }}, {{ $p->rancho }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
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
    </div>
</div>
<!-- <script>
	const minPriceHandle = document.querySelector('.min-price-handle');
	const maxPriceHandle = document.querySelector('.max-price-handle');
	const priceLine = document.querySelector('.price-line');
	const minPriceLabel = document.getElementById('min-price');
	const maxPriceLabel = document.getElementById('max-price');

    const filtroContainerInfo = document.querySelector('.filtro-container-info');
    const scrollThreshold = 200;

	let isDraggingMin = false;
	let isDraggingMax = false;

	minPriceHandle.addEventListener('mousedown', () => {
		isDraggingMin = true;
	});

	maxPriceHandle.addEventListener('mousedown', () => {
		isDraggingMax = true;
	});

	document.addEventListener('mouseup', () => {
		isDraggingMin = false;
		isDraggingMax = false;
	});

	document.addEventListener('mousemove', (e) => {
		if (isDraggingMin || isDraggingMax) {
			const priceFilterRect = priceLine.getBoundingClientRect();
			const mouseX = e.clientX - priceFilterRect.left;
			const priceRange = priceFilterRect.width;

			if (isDraggingMin) {
				const minPrice = (mouseX / priceRange) * 1000; // Adjust the maximum value as needed
                if(minPrice >=0 && minPrice <= 1004){
                    minPriceLabel.textContent = Math.round(minPrice);
                    minPriceHandle.style.left = `${mouseX}px`;
                }
			} else if (isDraggingMax) {
				const maxPrice = (mouseX / priceRange) * 1000; // Adjust the maximum value as needed
                if(maxPrice >= 0 && maxPrice <= 1004){
                    maxPriceLabel.textContent = Math.round(maxPrice);
                    maxPriceHandle.style.right = `${priceRange - mouseX}px`;
                }
			}
		}
	});

</script> -->
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
    //var maxPriceInput = document.querySelector('.max-price');
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

        window.location.href = '/tianguisTienda?' + queryEstado + queryCiudad + queryTipo + queryMin + queryMax; //+  +  '&min_price=' + minPrice + '&max_price=' + maxPrice;
    }
});


    // carrusel de publicidad
    document.addEventListener("DOMContentLoaded", function () {
        const publicidadContainer = document.querySelector(".publicidad-container");
        console.log(publicidadContainer);
        if (!publicidadContainer) {
            console.error("Element with class 'publicidad-container' not found.");
            return;
        }
        const backgrounds = [
            "/static/new/background/_espacio-publicitario.jpg",
            "/static/new/colaboradores/publi_1.jpg",
            "/static/new/colaboradores/publi_2.jpg",
            "/static/new/colaboradores/publi_3.jpg",
            "/static/new/colaboradores/publi_4.jpg",
        ];
        let currentIndex = 0;
        const intervalTime = 10000;

        function changeBackground() {
            publicidadContainer.style.backgroundImage = `url('${backgrounds[currentIndex]}')`;
            currentIndex = (currentIndex + 1) % backgrounds.length;
        }

        setInterval(changeBackground, intervalTime);
    });
</script>


@endsection



