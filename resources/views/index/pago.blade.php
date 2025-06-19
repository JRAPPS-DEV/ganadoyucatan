@extends('header')
@section('title', 'Pago -')
@section('content')
<style>
    .pago-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 40px;
        background: #f9f9f9;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', sans-serif;
        text-align: center;
        color: #3e5b29;
    }

    .pago-container h2 {
        font-size: 28px;
        color: #3e5b29;
        margin-bottom: 20px;
    }

    .pago-container p {
        font-size: 16px;
        margin-bottom: 25px;
    }

    .pago-container ul {
        text-align: left;
        background: #fff;
        border: 1px solid #dd9f50;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .pago-container ul li {
        margin-bottom: 10px;
        font-size: 16px;
        color: #3e5b29;
    }

    .btn-continue {
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

    .highlight {
        color: #dd9f50;
        font-weight: bold;
    }

</style>

<div class="pago-container">
    <h2>¡Gracias por registrarte!</h2>
    <p>Para <span class="highlight">activar tu cuenta</span>, realiza un depósito o transferencia a la siguiente cuenta:</p>

    <ul>
        <li><strong>Banco:</strong> BBVA</li>
        <li><strong>Número de cuenta:</strong> <span class="highlight">0123456789</span></li>
        <li><strong>CLABE:</strong> <span class="highlight">012345678901234567</span></li>
        <li><strong>Titular:</strong> Juan Rivas</li>
    </ul>

    <p>Una vez que se confirme tu pago, <strong>tu cuenta será activada manualmente</strong>.</p>
    
    <a href="/" class="btn-continue">Ir al inicio</a>
</div>
@endsection
