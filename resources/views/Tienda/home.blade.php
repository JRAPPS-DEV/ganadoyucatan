@extends('layout')

@section('content')
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
                        {{-- <h3>Filtrar por preferencia</h3>
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
                                <p id="min-value">$20000</p> {{-- TODO cambiar el valor de minimo --}}
                                </div>

                                <div>
                                <label>Max</label>
                                <p id="max-value">$50000</p> {{-- TODO cambiar el valor de maximo --}}
                                </div>
                            </div>

                            <div class="range-slider">
                                <div class="range-fill"></div>
                                <input type="range" class="min-price" value="200000" min="20000" max="500000" step="10000" /> {{--TODO cambiar el valor de minimo, maximo, y step (de cuánto en cuánto se moverán los valores). Value (valor por defecto del min) --}}
                                <input type="range" class="max-price" value="300000" min="20000" max="500000" step="10000" /> {{--TODO cambiar el valor de minimo, maximo, y step (de cuánto en cuánto se moverán los valores). Value (valor por defecto del max) --}}

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
                                    <p class="raza" >${{$p->precio}}</p>
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
                    <button class="warningButton" id="openModal" style="margin-left: 2rem;">Solicitar <br>publicidad</button>
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
                                    <p class="raza" >${{$p->precio}}</p>
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
  const savedScrollPosition = localStorage.getItem('scrollPosition');
  if (savedScrollPosition) {
    setTimeout(() => {
        window.scrollTo({
            top: parseInt(savedScrollPosition),
            behavior: 'smooth'
        });
    }, 100);
    localStorage.removeItem('scrollPosition');
  }
  const minInput = document.querySelector(".min-price");
  const maxInput = document.querySelector(".max-price");
  const minValue = document.getElementById("min-value");
  const maxValue = document.getElementById("max-value");
  const rangeFill = document.querySelector(".range-fill");

  const minRange = parseInt(minInput.min);
  const maxRange = parseInt(maxInput.max);

  function getQueryParam(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
  }

  const savedMinPrice = getQueryParam("min_price");
  const savedMaxPrice = getQueryParam("max_price");

    if (savedMinPrice) minInput.value = savedMinPrice;
    if (savedMaxPrice) maxInput.value = savedMaxPrice;


  function validateRange() {
    let minPrice = parseInt(minInput.value);
    let maxPrice = parseInt(maxInput.value);

    if (minPrice > maxPrice) {
      let tempValue = maxPrice;
      maxPrice = minPrice;
      minPrice = tempValue;
    }

    const minPercentage = ((minPrice - minRange) / (maxRange - minRange)) * 100;
    const maxPercentage = ((maxPrice - minRange) / (maxRange - minRange)) * 100;

    rangeFill.style.left = `${minPercentage}%`;
    rangeFill.style.width = `${maxPercentage - minPercentage}%`;

    minValue.innerHTML = `$${minPrice}`;
    maxValue.innerHTML = `$${maxPrice}`;
  }

  minInput.addEventListener("input", validateRange);
  maxInput.addEventListener("input", validateRange);

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
    var maxPriceInput = document.querySelector('.max-price');
    var buscarFitlro = document.getElementById('filterButton');

    buscarFitlro.addEventListener('click', function() {
        actualizarFiltros();
    });

    function actualizarFiltros() {
        localStorage.setItem('scrollPosition', window.scrollY);
        var estadoId = estadosSelect.options[estadosSelect.selectedIndex].getAttribute('data-estado-id');
        var ciudadId = ciudadesSelect.value ? ciudadesSelect.value : null;
        var lisTipo = lisTipoSelect.value ?  lisTipoSelect.value : null;
        var minPrice = minPriceInput.value ? minPriceInput.value : null;
        var maxPrice = maxPriceInput.value ? maxPriceInput.value : null;

        queryEstado = estadoId ? 'estado_id=' + estadoId : '';
        queryCiudad = ciudadId ? '&ciudad_id=' + ciudadId : '';
        queryTipo = lisTipo ? '&lisTipo=' + lisTipo : '';
        queryMin = minPrice ? '&min_price=' + minPrice : '';
        queryMax = maxPrice ? '&max_price=' + maxPrice : '';

        window.location.href = '/tienda?' + queryEstado + queryCiudad + queryTipo + queryMin + queryMax; //+  +  '&min_price=' + minPrice + '&max_price=' + maxPrice;
    }
});

    // carrusel de publicidad
document.addEventListener("DOMContentLoaded", function () {
    const publicidadContainer = document.querySelector(".publicidad-container");
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
