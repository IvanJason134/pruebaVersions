<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JuegoController extends Controller
{
    public function juego1(){
        return view('juegos.juego1');
    }

    public function juego2(){
        return view('juegos.juego2');
    }

    public function juego3(){
        return view('juegos.juego3');
    }

    public function juego4(){
        return view('juegos.juego4');
    }
}
