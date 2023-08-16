@extends('layouts.plantilla')

@section('title', 'Home')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/estilosHome.css') }}">
@endsection

@section('content')
<header>
    <h1>Juegos</h1>
</header>
<hr>
<div>
    <nav class="et-a">
        <a href="juego1">1. ¿Cuál con cuál?</a>
        <a href="juego2">2. Pon en su lugar</a>
        <a href="juego3">3. Escribe</a>
        <a href="juego4">4. Respóndeme</a>
        {{-- <a href="./Juegos/J5-ELH/juego5E1.html">5. Escribir la hora</a>
        <a href="./Juegos/J6-CUPO/juego6E1.html">6. Cambio uno por otro</a>
        <a href="./Juegos/J7-CESL/juego7.html">7. Coloca en su lugar</a>
        <a href="./Juegos/J8-Escribe/juego8.html">8. Escribe</a> --}}
    </nav>
</div>

<footer>
</footer>
@endsection

