@extends('layouts.plantilla')

@section('title', 'Juego 4')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/estilosJuego4.css') }}">
@endsection

@section('content')
<div x-data="{
    
    condition: false,
    showResults: false,
    correctCount: 0,
    nPregunta: 0,
    incorrectCount: 0,
    minutes: 0,
    seconds: 0,
    lastOption: null,
    timer: null,
    yesLocked: false,
    noLocked: false,
    
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
    
    verificarRespuesta: function(idB) {
        if(this.nPregunta === 0) {
            if(idB === 'b1') {
                this.incorrectCount++;
                this.lastOption = false;
            } else if(idB === 'b2') {
                this.correctCount++;
                this.lastOption = true;
            }
        } else if(this.nPregunta === 1) {
            if(idB === 'b1') {
                this.correctCount++;
                this.lastOption = true;
            } else if(idB === 'b2') {
                this.incorrectCount++;
                this.lastOption = false;
            }
        } else if(this.nPregunta === 2) {
            if(idB === 'b1') {
                this.incorrectCount++;
                this.lastOption = false;
            } else if(idB === 'b2') {
                this.correctCount++;
                this.lastOption = true;
            }
        } else if(this.nPregunta === 3) {
            if(idB === 'b1') {
                this.incorrectCount++;
                this.lastOption = false;
            } else if(idB === 'b2') {
                this.correctCount++;
                this.lastOption = true;
            }
        }
    },
    
    checkAnswers: function() {
        
        const self = this; 
        
        self.showResults = true; 
        
        if(self.correctCount === 4) {
            self.condition = true;
        } else {
            self.condition = false;
        }

        self.stopTimer();
    
    },

    sumarPregunta: function() {
        this.nPregunta++;
        this.yesLocked = false;
        this.noLocked = false;

        
    },

    restarPregunta: function() {
        this.nPregunta--;
        this.yesLocked = false;
        this.noLocked = false;
        if(this.lastOption) {
            this.correctCount--;
        } else {
            this.incorrectCount--;
        }
    },

    resetGame: function() {
        this.correctCount = 0;
        this.nPregunta = 0;
        this.incorrectCount = 0;
        this.minutes = 0; // Establecer minutos a 0
        this.seconds = 0; // Establecer segundos a 0
        this.yesLocked = false;
        this.noLocked = false;
        this.lastOption = null;
        
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
    <h1 class="display-6 text-center py-4 col-md-12 font-bold">Juego#4 Respóndeme</h1>
  </div>

    
    
    <div class="container col-md-12" >
        
        <div class="image-container col-md-6 ">
            
            <div class="timer-container">
                <p class="contador">Contador: <span id="timer" class="text-center mt-4"> 00:00</span></p>
            </div>
            
            <div class="image-wrapper">
                <div class="inv_t1">
                    <p>LOS<span class="LM font-bold">  XV</span>AÑOS <br>DE MARÍA</p>
                </div>
                <div class="inv_t2">
                    <p>Jaime acompáñame a celebrar mis XV primaveras <br> en presencia de mis familiares y amigos.</p>
                </div>
                <div class="inv_t3">
                    <p>A partir de las 11 a.m. en el salón de fiestas <br> Calle Francisco I Madero 123, Col. Centro</p>
                </div>
                {{-- <div class="inv_t4">
                    <p>Te espero en mi casa, calle</p>
                </div>
                <div class="inv_t5">
                    <p>Para</p>
                </div> --}}
                
                 <div class="inv-f1">
                    <img class="img" src=" {{ asset('sources/j4/fragmento_1.png') }} " alt="fragmento1" >
                </div>
                <div class="inv-f2">
                    <img class="img" src=" {{ asset('sources/j4/fragmento_2.png') }} " alt="fragmento2" >
                </div>
                <div class="inv-f3">
                    <img class="img" src=" {{ asset('sources/j4/fragmento_3.png') }} " alt="fragmento3">
                </div>
                <div class="inv-f4">
                    <img class="img" src=" {{ asset('sources/j4/fragmento_5.png') }} " alt="fragmento4">
                </div>
                {{-- <div class="inv-f4">
                    <img src=" {{ asset('sources/j2/fragmento_4.png') }} " alt="fragmento4">
                </div>  --}}
                
                {{-- <template x-for="(dropZone, index) in dropZones">
                    <div class="drop-zone" x-bind:id="dropZone.id" x-bind:class="{ 
                        'initial': !dropZone.isDropped, 
                        'has-content': dropZone.isDropped, 
                        'correct': dropZone.isCheck && dropZone.isCorrect, 
                        'incorrect': dropZone.isCheck && !dropZone.isCorrect }" 
                        x-bind:style="{ top: dropZone.top + '%', left: dropZone.left + '%', width: dropZone.width, height: dropZone.height }" x-on:click="setDropZoneContent(dropZone.id)">
                        <span x-text="dropZone.content"></span>
                    </div>
                </template> --}}
            </div>
        </div>
        
        <div class="box-container col-md-6 ">

            <div class="tittle-container">
                <div class="text-center py-2 pb-2">
                    <template x-if="nPregunta === 0">
                        <h2>¿La fiesta es una boda?</h2>
                    </template>
                    <template x-if="nPregunta === 1">
                        <h2>¿La fiesta son 15 años?</h2>
                    </template>
                    <template x-if="nPregunta === 2">
                        <h2>¿La fiesta es en la escuela?</h2>
                    </template>
                    <template x-if="nPregunta === 3">
                        <h2>¿La fies es a las 5?</h2>
                    </template>
                </div>
            </div>

            <template x-if="nPregunta === 0">

                <div class="video-container">
                    <video autoplay loop controls width="266" height="150">
                        <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                    </video>
                </div>
            
            </template>

            <template x-if="nPregunta === 0">

                <div class="options-container">
    
                    <div class="option-yes">
                        <button class="btn btnOp btn-primary" x-on:click="yesLocked = true; noLocked = false; verificarRespuesta('b1')" x-bind:disabled="yesLocked">Si</button>
                        <video autoplay loop controls width="266" height="150">
                            <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                        </video>
                    </div>
    
                    <div class="option-no">
                        <button class="btn btnOp btn-primary" x-on:click="yesLocked = false; noLocked = true; verificarRespuesta('b2')" x-bind:disabled="noLocked">No</button>
                        <video autoplay loop controls width="266" height="150">
                            <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                        </video>
                    </div>
    
                </div>

            </template>

            <template x-if="nPregunta === 1">

                <div class="video-container">
                    <video autoplay loop controls width="266" height="150">
                        <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                    </video>
                </div>
            
            </template>

            <template x-if="nPregunta === 1">

                <div class="options-container">
    
                    <div class="option-yes">
                        <button class="btn btnOp btn-primary" x-on:click="yesLocked = true; noLocked = false; verificarRespuesta('b1')" x-bind:disabled="yesLocked">Si</button>
                        <video autoplay loop controls width="266" height="150">
                            <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                        </video>
                    </div>
    
                    <div class="option-no">
                        <button class="btn btnOp btn-primary" x-on:click="yesLocked = false; noLocked = true; verificarRespuesta('b2')" x-bind:disabled="noLocked">No</button>
                        <video autoplay loop controls width="266" height="150">
                            <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                        </video>
                    </div>
    
                </div>

            </template>

            <template x-if="nPregunta === 2">

                <div class="video-container">
                    <video autoplay loop controls width="266" height="150">
                        <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                    </video>
                </div>
            
            </template>

            <template x-if="nPregunta === 2">

                <div class="options-container">
    
                    <div class="option-yes">
                        <button class="btn btnOp btn-primary" x-on:click="yesLocked = true; noLocked = false; verificarRespuesta('b1')" x-bind:disabled="yesLocked">Si</button>
                        <video autoplay loop controls width="266" height="150">
                            <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                        </video>
                    </div>
    
                    <div class="option-no">
                        <button class="btn btnOp btn-primary" x-on:click="yesLocked = false; noLocked = true; verificarRespuesta('b2')" x-bind:disabled="noLocked">No</button>
                        <video autoplay loop controls width="266" height="150">
                            <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                        </video>
                    </div>
    
                </div>

            </template>

            <template x-if="nPregunta === 3">

                <div class="video-container">
                    <video autoplay loop controls width="266" height="150">
                        <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                    </video>
                </div>
            
            </template>

            <template x-if="nPregunta === 3">

                <div class="options-container">
    
                    <div class="option-yes">
                        <button class="btn btnOp btn-primary" x-on:click="yesLocked = true; noLocked = false; verificarRespuesta('b1')" x-bind:disabled="yesLocked">Si</button>
                        <video autoplay loop controls width="266" height="150">
                            <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                        </video>
                    </div>
    
                    <div class="option-no">
                        <button class="btn btnOp btn-primary" x-on:click="yesLocked = false; noLocked = true; verificarRespuesta('b2')" x-bind:disabled="noLocked">No</button>
                        <video autoplay loop controls width="266" height="150">
                            <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
                        </video>
                    </div>
    
                </div>

            </template>

            

            

            <div class="fot-container">
                <template x-if="!showResults">
                    <div class="btnAntSig" >
                        
                        <div class="Ant-container">
                            <template x-if="nPregunta > 0">
                                <button class="btn  btn-primary" x-on:click="restarPregunta()">Estado Anterior</button>
                            </template>
                        </div>
                       
                        <div class="Sig-container">
                            <template x-if="nPregunta < 3">
                                <button class="btn btn-primary" x-on:click="sumarPregunta()">Siguiente Estado</button>
                            </template> 
                            <template x-if="nPregunta === 3">
                                <div class="btnVerificar col-lg-6 text-center" >
                                    <button class="btn btn-primary" x-on:click="checkAnswers()">Verificar respuestas</button>
                                </div>
                            </template>
                        </div>
                        
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
            </div>

        </div>
        
    </div>

</div>

@endsection
