@extends('header')
@section('title', 'Pago -')
@section('content')
<style>
    body{
        background: url('static/new/background/_bkg.jpg');
    }
    .pago-container {
        max-width: 100vw; /* ocupa todo el ancho de la ventana */
        margin: 150px auto;
        padding: 40px;
        background: #f9f9f9;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', sans-serif;
        color: #3e5b29;
        text-align: center;
    }

    .pago-container h2 {
        font-size: 32px;
        margin-bottom: 40px;
    }

    .carrusel-wrapper {
        overflow: hidden;
        position: relative;
        display: flex;
        justify-content: center;
    }

    .carrusel {
        display: flex;
        flex-wrap: nowrap;
        animation: scroll 40s linear infinite;
        align-items: center;
        justify-content: center;
    }

    .paquete {
        flex: 0 0 380px;       /* más ancho */
        max-width: 380px;
        background: #fff;
        border: 2px solid #dd9f50;
        border-radius: 12px;
        padding: 30px;         /* más espacio interno */
        margin: 0 20px;        /* más espacio entre cards */
        box-sizing: border-box;
        text-align: left;
        min-height: 400px;     /* más alto */
    }
    .paquete {
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .paquete:hover {
        transform: scale(1.03);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    .paquete h3 {
        font-size: 22px;
        margin-bottom: 10px;
    }
    .titulo-premium {
        color: #dd9f50;
    }
    .titulo-normal {
        color: #3e5b29;
    }

    .paquete .precio {
        font-size: 18px;
        margin-bottom: 15px;
    }

    .paquete ul {
        padding-left: 20px;
        margin-bottom: 0;
    }

    .paquete ul li {
        margin-bottom: 8px;
        font-size: 15px;
    }

    .highlight {
        color: #dd9f50;
        font-weight: bold;
    }

    .btn-continue {
        margin-top: 40px;
        background-color: #32ee3b;
        color: #fff;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .btn-continue:hover {
        background-color: #28c630;
    }

    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .paquete {
            flex: 0 0 80%;
        }
    }
    /* Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 500px;
        text-align: left;
        font-family: 'Segoe UI', sans-serif;
    }

    .modal-content h3 {
        margin-top: 0;
        color: #3e5b29;
    }

    .modal-content label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
    }

    .modal-content input,
    .modal-content textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        margin-top: 5px;
    }

    .modal-content button {
        margin-top: 20px;
        background-color: #32ee3b;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        cursor: pointer;
    }

    .modal-content button:hover {
        background-color: #28c630;
    }
</style>
<!-- Modal -->
<div id="paqueteModal" class="modal" onclick="cerrarModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <h3>Formulario de contacto</h3>
    <form method="POST" action="{{ route('guardar.contacto') }}">
        @csrf

        <input type="hidden" id="paquete" name="paquete">

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="rancho">Rancho</label>
        <input type="text" id="rancho" name="rancho" required>

        <label for="ubicacion">Ubicación</label>
        <input type="text" id="ubicacion" name="ubicacion" required>

        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

        <button type="submit">Enviar</button>
    </form>

    </div>
</div>

<div class="pago-container">
    <h2>Selecciona tu paquete de donación</h2>

    <div class="carrusel-wrapper">
        <div class="carrusel" id="carrusel">
            <!-- Paquetes (duplicados para loop infinito visual) -->
            @php
                $paquetes = [
                    [
                        'nombre' => 'Donación Básica',
                        'precio' => '$300',
                        'items' => [
                            'Posicionamiento del terreno versión web',
                            '2 tipos de interés',
                            'Redes sociales',
                            'Panel administrativo',
                            'APP móvil',
                        ]
                    ],
                    [
                        'nombre' => 'Donación Media',
                        'precio' => '$450',
                        'items' => [
                            'Posicionamiento del terreno versión web',
                            '3 tipos de interés',
                            'Redes sociales',
                            'Panel administrativo',
                            'APP móvil',
                        ]
                    ],
                    [
                        'nombre' => 'Donación Premium',
                        'precio' => '$850',
                        'items' => [
                            'Posicionamiento en APP y web',
                            'Todos los tipos de paneles',
                            'Redes sociales',
                            'Panel administrativo web',
                            'APP móvil',
                        ]
                    ],
                    [
                        'nombre' => 'Donación Especial',
                        'precio' => '$900',
                        'items' => [
                            'Posicionamiento móvil y APP',
                            'Tiendas de alta genetica',
                            'Redes sociales adicionales (compañas)',
                            'Panel administrativo',
                            'APP móvil',
                            'Video YouTube comercializador',
                            'Diseño especial para alta genetica',
                        ]
                    ],
                ];
                $duplicados = array_merge($paquetes, $paquetes); // duplicado para loop visual
            @endphp

            @foreach ($duplicados as $paquete)
            @php
            $colorTitulo = match ($paquete['nombre']) {
                'Donación Especial' => '#dd9f50',
                'Donación Premium' => '#b32e3b',
                'Donación Básica' => '#7d5a34',
                default => '#3e5b29',
            };

            @endphp
            <div class="paquete">
                <h3 style="color: {{ $colorTitulo }}">{{ $paquete['nombre'] }}</h3>
        
                    <p class="precio"><span class="highlight">{{ $paquete['precio'] }}</span> MXN mensual</p>
                    <ul>
                        @foreach ($paquete['items'] as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
            <br>
            <br>
    <a href="/" class="btn-continue">Ir al inicio</a>
</div>
<script>
    function abrirModal(nombrePaquete = '') {
        document.getElementById('paqueteModal').style.display = 'flex';
        document.getElementById('paquete').value = nombrePaquete;
    }

    function cerrarModal(event) {
        if (event.target.id === 'paqueteModal') {
            document.getElementById('paqueteModal').style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.paquete').forEach(card => {
            const nombre = card.querySelector('h3')?.innerText || '';
            card.addEventListener('click', () => abrirModal(nombre));
        });
    });

</script>

@endsection
