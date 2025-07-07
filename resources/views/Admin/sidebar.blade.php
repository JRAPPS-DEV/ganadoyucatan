<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="GanadoYucatan">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Ganado Yucatan">
    <meta name="theme-color" content="#009688">
    <meta name="google-adsense-account" content="ca-pub-5420632641336498">
    <title>Ganado Yucatan </title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('/static/css/admin/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{url('/static/css/admin/bootstrap/bootstrap.min.css') }}">   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="{{url('/static/css/admin/bootstrap/bootstrap-select.min.css') }}"> --}}  
    <link rel="stylesheet" type="text/css" href="{{url('/static/css/admin/jquery-ui.min.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{url('/static/css/admin/style.css')}}">
    <script src="https://kit.fontawesome.com/e9dc34ceb0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{url('/static/css/admin/bootstrap/bootstrap.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5420632641336498"
     crossorigin="anonymous"></script>
    <meta name="user-id" content="{{ auth()->id() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
  </head>
    <style >
        .app-menu__item{
            text-decoration: none;
        }
    </style>
  <body class="app sidebar-mini">
    @livewireScripts
    {{-- <script src="{{ mix('js/support-chat.js') }}"></script> --}} 
      {{-- modal para recomendaciones --}}
<div class="modal fade" id="recomendacionesModal" tabindex="-1" aria-labelledby="recomendacionesModalLAbel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color:red; font-weight: bolder;" class="modal-title" id="recomendacionesModalLAbel">
                TU SEGURIDAD ES LO MÁS IMPORTANTE PARA GANADO YUCATÁN
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Recomendaciones para vendedores: 
                <li> Antes de trasladar tu ganado, asegúrate que el comprador formalice la compra.</li>
                <li> No te preocupes por el traslado, eso es responsabilidad del comprador. </li>
                <li> Es tu responsabilidad verificar la forma de pago y realizar el cobro de la venta. </li>
                <li> Es importante tener una báscula al momento de la entrega del producto. </li>
                <li> Presenta la documentación de los animales a tu comprador.</li>
                <li> El trato de la venta es de manera directa con el comprador, nosotros no somos los intermediarios y no nos hacemos responsables de los factores externos.</li>
                <li>Importante la actualización de los siguientes datos: asociación ganadera, identificación de la Sagarpa, número de asociado, nombre de rancho, registro fierro y Registro Federal de Contribuyente (RFC). En caso de no cumplir con lo establecido, habrá una suspensión de cuenta. </li>
                <li>Les recomendamos, tener un punto medio como son los centros de acopio.</li>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
      <div id="divLoading" >
      <div>
        
      </div>
    </div>
      <header class="app-header">
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fas fa-bars"></i></a>
      <!-- Navbar Right Menu-->
      {{-- <ul class="app-nav"> <button id="startSupportChatButton">Iniciar Conversación de Soporte</button> --}}
        <!-- User Menu-->
        <a id="subscriptionWarning" class="alert alert-warning" role="alert" style="display: none;"></a>
        <button type="button" class="btn" style="background-color: #d79e46;border-color: #d79e46;margin-left: 78%;" data-bs-toggle="modal" data-bs-target="#recomendacionesModal">
            Recomendaciones ganaderas
        </button>
        <a onmouseover="this.style.background='rgba(188, 184, 144, .10)';" onmouseout="this.style.background='#f6f6f6';" href="{{url('/admin/products/home')}}" style="color: #000000;margin-block-start: 1%;margin-inline-end: 1%;text-decoration: none;">Inicio&nbsp;&nbsp;<i class="fa-solid fa-house" ></i></a>
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i style="color: #000000" class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">          
            <li><a class="dropdown-item" href="{{url('/admin/users/profile')}}"><i class="fa fa-user fa-lg"></i> Ajustes de Perfil
            </a></li>
            <li><a class="dropdown-item" href="{{url('/logout')}}"><i class="fa fa-sign-out fa-lg"></i> Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul>
    </header> @if(Session::has('message'))
    <div class="container">
            <div class="alert alert-{{Session::get('typealert')}}" style=       "display:none;">
                {{Session::get('message')}}
                @if ($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                    <li> {{ $error }} </li>
                    @endforeach
                </ul>
                @endif
                <script >
                    $('.alert').slideDown();
                    setTimeout(function(){$('.alert').slideUp();},10000);
                </script>
            </div>
        </div>
    @endif
<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <img class="app-sidebar__user-avatar" src="{{url('/static/images/logo.svg')}}" alt="Logo" style="width: 350px;margin-inline-start: -50px;margin-bottom: -45px;margin-top: -55px;" >
      <div class="app-sidebar__user"><img style="margin-inline-start: 35%;" class="app-sidebar__user-avatar" src="{{url('/')}}/userspics/{{Auth::user()->foto}}" alt="User Image">
        <div>
          <p class="app-sidebar__user-name" style="margin-inline-start: 25%;">{{Auth::user()->nombres}}</p>
          
        </div>
      </div>
      <ul class="app-menu">
        <li>
            <a class="app-menu__item" href="{{url('/tienda')}}" target="_blank">
                <i class="app-menu__icon fa fas fa-globe" aria-hidden="true"></i>
                <span class="app-menu__label">Catálogo</span>
            </a>
        </li>
        <?php if(Auth::user()->rolid == '1'){ ?>
        <li>
            <a class="app-menu__item" href="{{url('/admin/users')}}">
                <i class="fa fa-user fa-lg" aria-hidden="true"></i>
                <span class="app-menu__label">Usuarios</span>
            </a>
        </li>
        <?php } ?>
        <?php if(Auth::user()->rolid == '1' || Auth::user()->rolid == '6'){ ?>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-archive" aria-hidden="true"></i>
                <span class="app-menu__label">Tu tienda</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
{{--                 <?php if(Auth::user()->rolid == '1' || Auth::user()->rolid == '6'){ ?>
                <li><a class="treeview-item" href="{{url('/admin')}}/products/addNewGen"><i class="icon fa fa-circle-o"></i> Ganado Genético
                </a></li>
                <?php } ?>
                <?php if(Auth::user()->rolid == '1' || Auth::user()->rolid == '6'){ ?>
                <li><a class="treeview-item" href="{{url('/admin')}}/products/addNewCom"><i class="icon fa fa-circle-o"></i> Ganado Comercial
                </a></li>
                <?php } ?><?php if(Auth::user()->rolid == '1' || Auth::user()->rolid == '6'){ ?>
                <li><a class="treeview-item" href="{{url('/admin')}}/products/addNewSub"><i class="icon fa fa-circle-o"></i> Subasta Ganadera
                </a></li>
                <?php } ?>
                <?php if(Auth::user()->rolid == '1'){ ?> --}}
                <li><a class="treeview-item" href="{{url('/admin')}}/products/getAllGanado"><i class="icon fa fa-circle-o"></i> Panel Ganadero</a></li>
{{--                 <?php } ?> --}}
@php
    $tiendas = array_map('trim', explode(',', Auth::user()->tipo_explotacion ?? ''));
@endphp
               <?php if(Auth::user()->rolid == '1' || Auth::user()->rolid == '6'){ ?>
                @if( in_array('Pajillas de semen bovino', $tiendas) )
                    <li>
                        <a class="treeview-item"
                           href="{{ url('/admin/products/addNewPajilla') }}">
                            <i class="icon fa fa-circle-o"></i> Pajillas
                        </a>
                    </li>
                @endif
                <?php } ?> 
                <?php if(Auth::user()->rolid == '1' || Auth::user()->rolid == '6'){ ?>
                @if( in_array('Embriones en venta', $tiendas) )
                    <li>
                        <a class="treeview-item"
                           href="{{ url('/admin/products/addNewEmbrion') }}">
                            <i class="icon fa fa-circle-o"></i> Embriones
                        </a>
                    </li>
                @endif
                <?php } ?>
{{--                 <?php if(Auth::user()->rolid == '1'){ ?>
                <li><a class="treeview-item" href="{{url('/admin')}}/products/TianguisAdmin"><i class="icon fa fa-circle-o"></i> Tianguis Ganadero</a></li>
                <?php } ?> --}}
{{--                 <?php if(Auth::user()->rolid == '1'){ ?>
                <li><a class="app-menu__item" href="{{url('/admin')}}/expo">
                <i class="fa fa-star" aria-hidden="true"></i><span class="app-menu__label">Exposicon</span></a></li><?php } ?> --}}
            </ul>
        </li>
        <?php } ?>
        <li>
            <a class="app-menu__item" href="{{url('/admin')}}/mensajes">
                <i class="app-menu__icon fas fa-envelope" aria-hidden="true"></i>
                <span class="app-menu__label">Mensajes <span class="position-absolute top-0 start-95 translate-middle badge rounded-pill bg-danger">{{$unreadMsg }}</span></span>
            </a>
        </li>
        <?php if(Auth::user()->rolid == '1'){ ?>
        <li>
            <a class="app-menu__item" href="{{url('/admin')}}/contactos">
                <i class="app-menu__icon fas fa-envelope" aria-hidden="true"></i>
                <span class="app-menu__label">Contactos Subs <span class="position-absolute top-0 start-95 translate-middle badge rounded-pill bg-danger">{{$unreadMsg }}</span></span>
            </a>
        </li>
        <?php } ?>
        <?php if(Auth::user()->rolid == '1'){ ?>
        <li>
            <a class="app-menu__item" href="{{url('/admin')}}/posts">
                <i class="app-menu__icon fas fa-envelope" aria-hidden="true"></i>
                <span class="app-menu__label">Blog </span>
            </a>
        </li>
        <?php } ?>        

        <li>
            <a class="app-menu__item" href="{{url('/logout')}}">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Cerrar Sesión</span>
            </a>
        </li>
      </ul>
    </aside>
    <script src="{{url('/static/js/admin/jquery-3.3.1.min.js')}}"></script>
    <script src="{{url('/static/js/admin/popper.min.js')}}"></script>
    <script src="{{url('/static/js/admin/bootstrap.min.js')}}"></script>
    <script src="{{url('/static/js/admin/main.js')}}"></script>

<script>
document.addEventListener('DOMContentLoaded', function(){
    var subscriptionWarning = document.getElementById('subscriptionWarning');
    var fechaDePago = new Date('{{Auth::user()->updated_at}}'); 
    console.log('Fecha de pago: ' + fechaDePago);
    var today = new Date();
    console.log('Fecha actual: ' + today);
    var differenceInDays = Math.floor((today - fechaDePago) / (1000 * 60 * 60 * 24));
    console.log('REsultado operacion: ' + differenceInDays);   
    if (differenceInDays <= 31 && differenceInDays >= 26) {
        console.log('activar recordatorio');
        subscriptionWarning.textContent = 'En ' + Math.floor(31 - differenceInDays) + ' días vence tu suscripción. Favor de renovarla.';
        subscriptionWarning.style.display = 'block';
    }
});
/*en mantenimiento */
document.addEventListener('DOMContentLoaded', function () {
    const startChatButton = document.getElementById('startSupportChatButton');
    if (!startChatButton) {
        console.error('El botón de inicio de chat no se encontró en el DOM.');
        return;
    }

    startChatButton.addEventListener('click', () => {
        const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
        if (!csrfTokenMeta) {
            console.error('El meta tag CSRF token no se encontró en el DOM.');
            return;
        }

        axios.post('/support-conversations', { 
            _token: csrfTokenMeta.getAttribute('content')
        })
        .then(response => {
            window.location.href = '/support/conversations/' + response.data.conversation_id;
        })
        .catch(error => {
            console.error(error);
            alert('Hubo un error al iniciar la conversación.');
        });
    });
});


Echo.private('admin-channel')
    .listen('ConversationStarted', (e) => {
        alert(`Nueva conversación iniciada: ${e.conversationId}`);
        // agregar la ventana para chat, diseño y todo 
    });

</script>
    @section('main')
    @show   
  </body>