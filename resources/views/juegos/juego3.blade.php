@extends('layouts.plantilla')

@section('title', 'Juego 3')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/estilosJuego3.css') }}">
@endsection

@section('content')
<div x-data="{
    condition: false,
    showResults: false,
    correctCount: 0,
    incorrectCount: 0,
    minutes: 0,
    seconds: 0,
    timer: null,
    startTimer: function() {
      this.timer = setInterval(() => {
        this.seconds++;
        if (this.seconds === 60) {
          this.minutes++;
          this.seconds = 0;
        }
      }, 1000);
    },
    stopTimer: function() {
      clearInterval(this.timer);
    },
    inputs: [
      { id: 'fecha_txt', inputValue: '', isCheck: false, isCorrect: null, top: 48, left: 5, width: '29%', height: '10%', placeHolder: 'Fecha', correctAnswer: '13 de Septiembre' },
      { id: 'hora_txt', inputValue: '', isCheck: false, isCorrect: null, top: 48, left: 70, width: '22%', height: '10%', placeHolder: 'Hora', correctAnswer: '11:00 pm' },
      { id: 'direccion_txt', inputValue: '', isCheck: false, isCorrect: null, top: 70, left: 36, width: '28.5%', height: '10%', placeHolder: 'Direccion', correctAnswer: 'Escuela' }     
    ],

    checkAnswers: function() {
      
      const self = this; 
    
      this.inputs.forEach(function(input) {
     
        input.isCorrect = (input.inputValue === input.correctAnswer);
        if(input.isCorrect) {
          self.correctCount++;
        } else {
          self.incorrectCount++;
        }
        self.showResults = true; 
        input.isCheck = true;
        
        if(self.correctCount === 3) {
            self.condition = true;
        } else {
            self.condition = false;
        }

        self.stopTimer();
      });
    },
    resetGame: function() {
      
      this.inputs.forEach(function(input) {
     
        input.isCheck = false;
        input.isCorrect = null;
        input.inputValue = '';
    
      });
    
      this.correctCount = 0;
      this.incorrectCount = 0;
       this.minutes = 0; // Establecer minutos a 0
  this.seconds = 0; // Establecer segundos a 0
    
      this.startTimer();
    
      this.showResults = false;
      this.condition = false;
    },
    
    startTimer: function() {

      this.timer = setInterval(() => {
        this.seconds++;
        if (this.seconds === 60) {
          this.minutes++;
          this.seconds = 0;
        }
        document.getElementById('timer').innerText = `${this.minutes.toString().padStart(2, '0')}:${this.seconds.toString().padStart(2, '0')}`;
      }, 1000);
    },
    reanudarTimer: function() {
        let startTime = (this.minutes * 60) + this.seconds;

  this.timer = setInterval(() => {
    startTime++;

    this.minutes = Math.floor(startTime / 60);
    this.seconds = startTime % 60;

    document.getElementById('timer').innerText = `${this.minutes.toString().padStart(2, '0')}:${this.seconds.toString().padStart(2, '0')}`;
  }, 1000);
    }
  }" x-init="startTimer()">

  <div class="inicial-container">
    <a href="/">Regresar</a>
    <h1 class="display-6 text-center py-4 col-md-12 font-bold">Juego#3 Escribe</h1>
  </div>


   
    <div class="container col-md-12" >
        <div class="box-container col-md-6 ">
          <div class="text-center py-4">
            <h2>Ordena la siguiente información</h2>
          </div>
          <div class="video-container">
            <video autoplay loop controls width="266" height="150">
              <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
            </video>
          </div>

          <template x-if="!showResults">
            <div class="col-lg-6 text-center mt-4" >
                <button class="btn btn-primary" x-on:click="checkAnswers()">Verificar respuestas</button>
            </div>
          </template>
          
          
          <div class="aciertosErrores col-lg-6 text-center mt-4" >
            <template x-if="showResults">
              <div>
                <button class="btn btn-danger" x-show="!condition" x-on:click="resetGame()">Reintentar</button>
                <button class="btn btn-success" x-show="condition">Terminar lección</button>
                <div class="txt-Ai">
                    <p>Aciertos: <span x-text="correctCount"></span> - Errores: <span x-text="incorrectCount"></span></p>
                </div>
                
              </div>
            </template>
          </div>    

          <div class="opciones-container">
             <p><span class="font-bold">Hora:</span> 11:00 pm</p>
             <p><span class="font-bold">Fecha:</span> 13 de Septiembre</p>
             <p><span class="font-bold">Lugar:</span> Escuela</p>
          </div>

          

        </div>
        <div class="image-container col-md-6 ">
          <div class="timer-container">
            <p class="contador">Contador: <span id="timer" class="text-center mt-4"> 00:00</span></p>
          </div>
          <div class="image-wrapper">
              <div class="inv_t1">
                  <p>Te invito a mi fiesta <br> de cumpleaños</p>
              </div>
              <div class="inv_t2">
                <p>DÍA</p>
              </div>
              <div class="inv_t3">
                <p>HORA</p>
              </div>
              <div class="inv_t4">
                <p>Te espero en</p>
              </div>
              <div class="inv_t5">
                <p>Para:</p>
              </div>
              <div class="inv_t6">
                <p>JAIME</p>
              </div>
              <div class="inv_t7">
                <p>Luis</p>
              </div>
              
              <div class="inv-f1">
                 <img src=" {{ asset('sources/j2/fragmento_1.png') }} " alt="fragmento1">
              </div>
              <div class="inv-f2_1">
                <img src=" {{ asset('sources/j2/fragmento_2.png') }} " alt="fragmento2">
             </div>
             <div class="inv-f2_2">
              <img src=" {{ asset('sources/j2/fragmento_2.png') }} " alt="fragmento2_2">
           </div>
           <div class="inv-f3">
            <img src=" {{ asset('sources/j2/fragmento_3.png') }} " alt="fragmento3">
         </div>
         <div class="inv-f4">
          <img src=" {{ asset('sources/j2/fragmento_4.png') }} " alt="fragmento4">
       </div>

             <template x-for="(input, index) in inputs">
              <input type="text" class="input_txt" 
              x-bind:id="input.id" 
              x-model="input.inputValue"
              x-bind:class="{  
                'correct': input.isCheck && input.isCorrect, 
                'incorrect': input.isCheck && !input.isCorrect 
              }" 
              x-bind:style="{ top: input.top + '%', left: input.left + '%', width: input.width, height: input.height }"
              x-bind:placeholder="input.placeHolder" >
              </div>
            </template>
          </div>
               
        </div>
    </div>
  </div>
@endsection
