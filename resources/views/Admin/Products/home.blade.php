@extends('Admin.sidebar')
@section('main')
<style >
* {
  font-family: sans-serif;
}


.parent {
/*  display: flex;
  flex-direction: column;
  align-items: center;*/
}

.parent button {
/*  background-color: #48abe0;*/
  color: white;
  border: none;
  padding: 5px;
  font-size: 31px;
  height: 130px;
  width: 230px;
/*  box-shadow: 0 2px 4px darkslategray;
*/  cursor: pointer;
  transition: all 0.2s ease;
}

.parent button:active {
  background-color: #48abe0;
  box-shadow: 0 0 2px darkslategray;
  transform: translateY(2px);
}

.parent button:not(:first-child) {
  margin-top: 10px;
}
 /* nuevo boton */
.dropdown-container {
    position: relative;
    display: inline-block;
    text-align: center;
    margin-top: 100px;
}

.dropdown-button {
    background-color: #444;
    color: white;
    padding: 16px 24px;
    font-size: 18px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
}

.dropdown-options {
    display: none;
    position: absolute;
    top: 110%;
    left: 50%;
    transform: translateX(-50%);
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    padding: 10px 0;
    width: 260px;
    z-index: 1000;
}

.dropdown-options .option {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    text-decoration: none;
    color: black;
    border-bottom: 1px solid #eee;
}

.dropdown-options .option:hover {
    background-color: #f4f4f4;
}

.dropdown-options img {
    width: 36px;
    height: 36px;
    object-fit: cover;
    border-radius: 8px;
}
</style>

<main class="app-content" style="background: #fff;">
<div class="parent">
	<div class="container text-center" style="margin-block-start: 15%;">
{{-- 		  <div class="row">
		  	    <div class="col">
                  <button style="border-radius: 20%;"><a href="{{url('admin/products/addNewGen')}}"><img style="width: 100%;height: 100%;object-fit: cover;border-radius: 20%;" src="{{url('/static/images/genetico.png')}}"></button>
                  	<article style="  background: linear-gradient(to right, hsl(53.6, 67.5%, 49.4%), hsl(25.3, 100%, 59%));-webkit-background-clip: text;-webkit-text-fill-color: transparent;text-align: center;"></a>
                  		<h1>Ganado <br>	 Genético</h1>
                	</article>
                		  	    </div>		  	    <div class="col">
                  <button style="border-radius: 20%;"><a href="{{url('admin/products/addNewCom')}}"><img style="width: 100%;height: 100%;object-fit: cover;border-radius: 20%;" src="{{url('/static/images/tianguis.png')}}"></button>
                  	<article style="  background: linear-gradient(to right, hsl(82, 100%, 13.9%), hsl(87.3, 65.8%, 54.1%));-webkit-background-clip: text;-webkit-text-fill-color: transparent;text-align: center;"></a>
                  		<h1>Ganado comercial</h1>
                	</article>
                		  	    </div>		  	    <div class="col">
                  <button style="border-radius: 20%;"><a href="{{url('admin/products/addNewSub')}}"><img style="width: 100%;height: 100%;object-fit: cover;border-radius: 20%;" src="{{url('/static/images/subasta.png')}}"></button>
                  	<article style="  background: linear-gradient(to right, hsl(0, 80.3%, 60.2%), hsl(0, 97.5%, 31.6%));-webkit-background-clip: text;-webkit-text-fill-color: transparent;text-align: center;"></a>
                  		<h1>Subasta Ganadera</h1>
                	</article>
		  	    </div>
		  	</div> --}}
            <div class="dropdown-container">
                <button class="dropdown-button" onclick="toggleDropdown()">Elegir mercado</button>
                <div class="dropdown-options" id="dropdownMenu">
                    <a class="option" href="{{url('admin/products/addNewGen')}}">
                        <img src="{{url('/static/images/genetico.png')}}" alt="Ganado Genético">
                        <span>Ganado Genético</span>
                    </a>
                    <a class="option" href="{{url('admin/products/addNewCom')}}">
                        <img src="{{url('/static/images/tianguis.png')}}" alt="Ganado Comercial">
                        <span>Ganado Comercial</span>
                    </a>
                    <a class="option" href="{{url('admin/products/addNewSub')}}">
                        <img src="{{url('/static/images/subasta.png')}}" alt="Subasta Ganadera">
                        <span>Subasta Ganadera</span>
                    </a>
                </div>
            </div>
		  </div>
</div>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById('dropdownMenu');
            menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
        }
        window.addEventListener('click', function(e) {
            const menu = document.getElementById('dropdownMenu');
            const button = document.querySelector('.dropdown-button');
            if (!button.contains(e.target) && !menu.contains(e.target)) {
                menu.style.display = 'none';
            }
        });
        $(document).ready(function() {
            $('#subscriptionModal').modal('show');
        });
    </script>
@if(auth()->check() && auth()->user()->rolid == 0)
    <div class="modal fade" id="subscriptionModal" tabindex="-1" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="color:red; font-weight: bolder;" class="modal-title" id="subscriptionModalLabel">
                        <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                        AVISO DE SUSCRIPCIÓN VENCIDA
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Su suscripción ha vencido. Por favor, renuévela para seguir disfrutando de los beneficios que Ganado Yucatán Peninsular tiene para usted.</p>
                </div>
                <div class="modal-footer">
                    <button onclick="location.href='/suscripcion'" type="button" class="btn btn-primary" data-bs-dismiss="modal">Suscribirme</button>
                </div>
            </div>
        </div>
    </div>
@endif
</main>
@endsection