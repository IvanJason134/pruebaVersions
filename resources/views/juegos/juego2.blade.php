@extends('layouts.plantilla')

@section('title', 'Juego 2')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/estilosJuego2.css') }}">
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
    boxes: [
      { id: 'box1', content: '05:00 PM', isDropped: false },
      { id: 'box2', content: '5 FEBRERO', isDropped: false },
      { id: 'box3', content: 'Luis', isDropped: false },
      { id: 'box4', content: 'JAIME', isDropped: false },
      { id: 'box5', content: 'Independencia #10', isDropped: false }
    ],
    dropZones: [
      { id: 'box6', content: '', isDropped: false, isCheck: false, isCorrect: null, draggedBoxId: null, top: 48, left: 5.5, width: '28.5%', height: '15%', correctAnswer: 'box2' },
      { id: 'box7', content: '', isDropped: false, isCheck: false, isCorrect: null, draggedBoxId: null, top: 48, left: 70, width: '22%', height: '15%', correctAnswer: 'box1' },
      { id: 'box8', content: '', isDropped: false, isCheck: false, isCorrect: null, draggedBoxId: null, top: 26, left: 35.5, width: '28.5%', height: '10%', correctAnswer: 'box4' },
      { id: 'box9', content: '', isDropped: false, isCheck: false, isCorrect: null, draggedBoxId: null, top: 72.5, left: 27, width: '45.5%', height: '8%', correctAnswer: 'box5' },
      { id: 'box10', content: '', isDropped: false, isCheck: false, isCorrect: null, draggedBoxId: null, top: 90, left: 38, width: '23.5%', height: '8%', correctAnswer: 'box3' }
    ],
    selectedBox: null,
    findBoxById: function(boxes, boxId) {
      return boxes.find((box) => box.id === boxId);
    },
    findDropZoneById: function(dropZones, dropZoneId) {
      return dropZones.find((dropZone) => dropZone.id === dropZoneId);
    },

   clearDropZoneContent: function(dropZone) {
  const box = this.findBoxById(this.boxes, dropZone.draggedBoxId);

  if (box) {
    box.isDropped = false;
    dropZone.isDropped = false;
    dropZone.draggedBoxId = null;
    dropZone.content = '';

    // Mostrar nuevamente el box correspondiente en el drop-zone
    const droppedBoxElement = document.getElementById(box.id);
    if (droppedBoxElement) {
      droppedBoxElement.style.display = 'block'; // O establece el estilo adecuado para mostrar el box (por ejemplo, 'inline-block', 'flex', etc.)
    }
  }
},

    clearSelectedBox: function(boxes, selectedBoxId) {
      const selectedBox = this.findBoxById(boxes, selectedBoxId);
      if (selectedBox) {
        selectedBox.isDropped = false;
      }
    },

    setDropZoneContent: function(dropZoneId) {
  const box = this.findBoxById(this.boxes, this.selectedBox);
  const dropZone = this.findDropZoneById(this.dropZones, dropZoneId);

  if (!dropZone.isCheck) {
    if (dropZone.isDropped) {
      this.clearDropZoneContent(dropZone);
      this.clearSelectedBox(this.boxes, this.selectedBox);
      dropZone.isCheck = false;
    }
  }

  if (box && dropZone && !dropZone.isDropped) { // Agregar condición para verificar si el dropZone no contiene contenido
    this.clearDropZoneContent(dropZone);
    this.clearSelectedBox(this.boxes, this.selectedBox);

    box.isDropped = true;
    dropZone.isDropped = true;
    dropZone.draggedBoxId = this.selectedBox;

    dropZone.content = box.content;

    // Ocultar el box correspondiente en el drop-zone
    const droppedBoxElement = document.getElementById(box.id);
    if (droppedBoxElement) {
      droppedBoxElement.style.display = 'none';
    }
  }

  this.selectedBox = null;
},
    checkAnswers: function() {
      
      const self = this; 
    
      this.dropZones.forEach(function(dropZone) {
        const box = self.findBoxById(self.boxes, dropZone.draggedBoxId); 
        
        dropZone.isCorrect = (box && box.id === dropZone.correctAnswer);
        if(dropZone.isCorrect) {
          self.correctCount++;
        } else {
          self.incorrectCount++;
        }
        self.showResults = true; 
        dropZone.isCheck = true;
        
        if(self.correctCount === 5) {
            self.condition = true;
        } else {
            self.condition = false;
        }

        self.stopTimer();
      });
    },
    resetGame: function() {
      this.boxes.forEach(function(box) {
        box.isDropped = false;
      });
    
      this.dropZones.forEach(function(dropZone) {
        dropZone.isDropped = false;
        dropZone.isCheck = false;
        dropZone.isCorrect = null;
        dropZone.draggedBoxId = null;
        dropZone.content = '';
    
        // Mostrar nuevamente el box correspondiente en el drop-zone
        const droppedBoxElement = document.getElementById(dropZone.correctAnswer);
        if (droppedBoxElement) {
          droppedBoxElement.style.display = 'block'; // O establece el estilo adecuado para mostrar el box (por ejemplo, 'inline-block', 'flex', etc.)
        }
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
    <h1 class="display-6 text-center py-4 col-md-12 font-bold">Juego#2 Pon en su lugar</h1>
  </div>
    
    <div class="container col-md-12" >
      
        <div class="box-container col-md-6 ">
          <div class="text-center py-3 pb-1">
            <h2>Instrucciones</h2>
          </div>
          <div class="video-container">
            <video autoplay loop controls width="266" height="150">
              <source src=" {{ asset('sources/videoEj.mp4') }} " type="video/mp4">
            </video>
          </div>
          <template x-for="(box, index) in boxes">
            <div class="box" x-bind:id="box.id" x-bind:class="{ 'dropped': box.isDropped, 'selected': selectedBox === box.id }" x-text="box.content" x-on:click="selectedBox = box.id"></div>
          </template>

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
                <p>Te espero en mi casa, calle</p>
              </div>
              <div class="inv_t5">
                <p>Para</p>
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

            <template x-for="(dropZone, index) in dropZones">
              <div class="drop-zone" x-bind:id="dropZone.id" x-bind:class="{ 
                'initial': !dropZone.isDropped, 
                'has-content': dropZone.isDropped, 
                'correct': dropZone.isCheck && dropZone.isCorrect, 
                'incorrect': dropZone.isCheck && !dropZone.isCorrect 
              }" x-bind:style="{ top: dropZone.top + '%', left: dropZone.left + '%', width: dropZone.width, height: dropZone.height }" x-on:click="setDropZoneContent(dropZone.id)">
                <span x-text="dropZone.content"></span>
              </div>
            </template>
          </div>
                  
        </div>
      
    </div>
  </div>
@endsection
