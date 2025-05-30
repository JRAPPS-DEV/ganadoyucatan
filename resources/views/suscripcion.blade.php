@extends('layout')

@section('content')
<div class="productTienda-section">
    <div class="container-product--Main">
        <div class="route">
            <p>Inicio<span>></span><p>Suscripción</p>
        </div>
        {{-- <div class="container-payment">
            <div class="container-vaquita">
                <p>Ganadero, estás a un paso de formar parte de esta plataforma y comenzar a ganar</p>
                <img src="{{url('/static/new/iconos/vecteezy_cow-png-with-ai-generated_24589338_145.png')}}" alt="">
            </div>
            <div class="suscription">
                <p>Suscripción</p>
                <p> $199.00</p>
            </div>
            <div class="payment-detail">
                <p style="margin: 1rem 0rem;">Detalles de pago</p>
                <p>Depósito en OXXO:</p>
                <hr>
                <div class="card-details">
                    <img width="100" height="100" src="https://img.icons8.com/ios/100/bank-card-back-side--v1.png" alt="bank-card-back-side--v1"/>
                    <p style="font-weight: bold;">4217-4700-0525-7791</p>
                </div>
                <hr>
                <p>Transferencias:</p>
                <hr>
                <div class="card-details">
                    <img width="100" height="100" src="https://img.icons8.com/ios/100/cell-phone.png" alt="cell-phone"/>
                    <div style="width: 100%;">
                        <p style="font-weight: bold;">646910146401888213</p>
                        <p>CLABE Interbancaria</p>
                    </div>
                </div>
                <hr>
            </div>
        </div> --}}
        <section class="subscription-plans">
            <h2>Planes de Suscripción</h2>
            <div class="plans-grid">
                <!-- Plan Básico -->
                <div class="plan-card">
                <h3>Básico</h3>
                <p class="price">$300 <span>/ mes</span></p>
                <ul>
                    <li>Posicionamiento Web del Rancho</li>
                    <li>2 Tiendas de Interés</li>
                    <li>Redes Sociales</li>
                    <li>Panel Administrativo</li>
                    <li>App Móvil</li>
                </ul>
                <a href="#" class="cta-button">Suscribirse</a>
                </div>

                <!-- Plan Medio -->
                <div class="plan-card">
                <h3>Medio</h3>
                <p class="price">$450 <span>/ mes</span></p>
                <ul>
                    <li>Posicionamiento Web del Rancho</li>
                    <li>3 Tiendas de Interés</li>
                    <li>Redes Sociales</li>
                    <li>Panel Administrativo</li>
                    <li>App Móvil</li>
                </ul>
                <a href="#" class="cta-button">Suscribirse</a>
                </div>

                <!-- Plan Premium -->
                <div class="plan-card">
                <h3>Premium</h3>
                <p class="price">$650 <span>/ mes</span></p>
                <ul>
                    <li>Posicionamiento Web y App del Rancho</li>
                    <li>Todas las Tiendas Disponibles</li>
                    <li>Redes Sociales</li>
                    <li>Panel Administrativo</li>
                    <li>App Móvil</li>
                </ul>
                <a href="#" class="cta-button">Suscribirse</a>
                </div>

                <!-- Plan Especial -->
                <div class="plan-card plan-featured">
                <h3>Especial</h3>
                <p class="price">$900 <span>/ mes</span></p>
                <ul>
                    <li>Posicionamiento Web y App del Rancho</li>
                    <li>Todas las Tiendas + Alta Genética</li>
                    <li>Redes Sociales + Campañas</li>
                    <li>Panel Administrativo</li>
                    <li>App Móvil</li>
                    <li>Video Comercial en YouTube</li>
                    <li>Diseños Especiales de Alta Genética</li>
                </ul>
                <a href="#" class="cta-button">Suscribirse</a>
                </div>
            </div>
        </section>

        <section id="subscription-steps" class="subscription-steps hidden">
            <h2>¿Cómo completar tu suscripción?</h2>
            <ol>
                <li>
                    <strong>Paso 1:</strong> Realiza el depósito en cualquier OXXO a la cuenta:
                    <div class="highlighted">2242-1709-1003-7406</div>
                </li>
                <li>
                    <strong>Paso 2:</strong> Toma una foto del comprobante y envíala a nuestro WhatsApp:
                    <div class="highlighted">
                        <a href="https://wa.me/5219992359443" target="_blank">Enviar comprobante vía WhatsApp</a>
                    </div>
                </li>
                <li>
                    <strong>Paso 3:</strong> Confirmaremos tu suscripción y recibirás tu acceso personalizado.
                </li>
            </ol>
        </section>
    </div>
</div>

<script>
  const ctaButtons = document.querySelectorAll('.cta-button');
  const stepsSection = document.getElementById('subscription-steps');

  ctaButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      stepsSection.classList.remove('hidden');
      stepsSection.scrollIntoView({ behavior: 'smooth' });
    });
  });
</script>

@endsection
