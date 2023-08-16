@extends('layouts.plantilla')

@section('title', 'Juego 1')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/estilosJuego1.css') }}">
@endsection

@section('content')
<div x-data="{
    condition: false, 
    startX1: 0, startY1: 0, endX1: 0, endY1: 0,
    startX2: 0, startY2: 0, endX2: 0, endY2: 0,
    startX3: 0, startY3: 0, endX3: 0, endY3: 0,
    showResults: false,
    correctCount: 0,
    lineCount: 0,
    line1: false,
    line2: false,
    line3: false,
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
      { id: 'box1', isDropped: false, top: 16, left: 21, width: '5%', height: '7%' },
      { id: 'box2', isDropped: false, top: 47, left: 21, width: '5%', height: '7%' },
      { id: 'box3', isDropped: false, top: 77, left: 21, width: '5%', height: '7%' } 
    ],
    dropZones: [
      { id: 'box4', content: 'Luis', isDropped: false, isCheck: false, isCorrect: null, draggedBoxId: null, top: 14, left: 75, width: '20%', height: '10%', correctAnswer: 'box2', lineAsig: '' },
      { id: 'box5', content: 'Cumpleaños', isDropped: false, isCheck: false, isCorrect: null, draggedBoxId: null, top: 45, left: 75, width: '20%', height: '10%', correctAnswer: 'box3', lineAsig: '' },
      { id: 'box6', content: 'Casa', isDropped: false, isCheck: false, isCorrect: null, draggedBoxId: null, top: 74, left: 75, width: '20%', height: '10%', correctAnswer: 'box1', lineAsig: '' }
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

      if(dropZone.lineAsig === 'line3') {
        this.startX3 = null; 
        this.startY3 = null; 
        this.endX3 = null; 
        this.endY3 = null;
        this.line3 = false;
      } else if(dropZone.lineAsig === 'line2') {
        this.startX2 = null; 
        this.startY2 = null; 
        this.endX2 = null; 
        this.endY2 = null;
        this.line2 = false
      } else if(dropZone.lineAsig === 'line1') {
        this.startX1 = null; 
        this.startY1 = null; 
        this.endX1 = null; 
        this.endY1 = null;
        this.line1 = false
      } 

      dropZone.lineAsig = '';
      
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

    if(!this.line1) {
      if(box.id === 'box1' && dropZone.id === 'box4') {
        this.startX1 = 21; 
        this.startY1 = 19; 
        this.endX1 = 74; 
        this.endY1 = 19;
        this.line1 = true;
        dropZone.lineAsig = 'line1';
      } else if (box.id === 'box1' && dropZone.id === 'box5') {
        this.startX1 = 21; 
        this.startY1 = 19; 
        this.endX1 = 74; 
        this.endY1 = 50;
        this.line1 = true;
        dropZone.lineAsig = 'line1';
      } else if (box.id === 'box1' && dropZone.id === 'box6') {
        this.startX1 = 21; 
        this.startY1 = 19; 
        this.endX1 = 74; 
        this.endY1 = 80;
        this.line1 = true;
        dropZone.lineAsig = 'line1';
      } else if (box.id === 'box2' && dropZone.id === 'box4') {
        this.startX1 = 21; 
        this.startY1 = 50; 
        this.endX1 = 74; 
        this.endY1 = 19;
        this.line1 = true;
        dropZone.lineAsig = 'line1';
      } else if (box.id === 'box2' && dropZone.id === 'box5') {
        this.startX1 = 21; 
        this.startY1 = 50; 
        this.endX1 = 74; 
        this.endY1 = 50;
        this.line1 = true;
        dropZone.lineAsig = 'line1';
      } else if (box.id === 'box2' && dropZone.id === 'box6') {
        this.startX1 = 21; 
        this.startY1 = 50; 
        this.endX1 = 74; 
        this.endY1 = 80;
        this.line1 = true;
        dropZone.lineAsig = 'line1';
      } else if (box.id === 'box3' && dropZone.id === 'box4') {
        this.startX1 = 21; 
        this.startY1 = 80; 
        this.endX1 = 74; 
        this.endY1 = 19;
        this.line1 = true;
        dropZone.lineAsig = 'line1';
      } else if (box.id === 'box3' && dropZone.id === 'box5') {
        this.startX1 = 21; 
        this.startY1 = 80; 
        this.endX1 = 74; 
        this.endY1 = 50;
        this.line1 = true;
        dropZone.lineAsig = 'line1';
      } else if (box.id === 'box3' && dropZone.id === 'box6') {
        this.startX1 = 21; 
        this.startY1 = 80; 
        this.endX1 = 74; 
        this.endY1 = 80;
        this.line1 = true;
        dropZone.lineAsig = 'line1';
      }
    } else if(!this.line2) {
      if(box.id === 'box1' && dropZone.id === 'box4') {
        this.startX2 = 21; 
        this.startY2 = 19; 
        this.endX2 = 74; 
        this.endY2 = 19;
        this.line2 = true;
        dropZone.lineAsig = 'line2';
      } else if (box.id === 'box1' && dropZone.id === 'box5') {
        this.startX2 = 21; 
        this.startY2 = 19; 
        this.endX2 = 74; 
        this.endY2 = 50;
        this.line2 = true;
        dropZone.lineAsig = 'line2';
      } else if (box.id === 'box1' && dropZone.id === 'box6') {
        this.startX2 = 21; 
        this.startY2 = 19; 
        this.endX2 = 74; 
        this.endY2 = 80;
        this.line2 = true;
        dropZone.lineAsig = 'line2';
      } else if (box.id === 'box2' && dropZone.id === 'box4') {
        this.startX2 = 21; 
        this.startY2 = 50; 
        this.endX2 = 74; 
        this.endY2 = 19;
        this.line2 = true;
        dropZone.lineAsig = 'line2';
      } else if (box.id === 'box2' && dropZone.id === 'box5') {
        this.startX2 = 21; 
        this.startY2 = 50; 
        this.endX2 = 74; 
        this.endY2 = 50;
        this.line2 = true;
        dropZone.lineAsig = 'line2';
      } else if (box.id === 'box2' && dropZone.id === 'box6') {
        this.startX2 = 21; 
        this.startY2 = 50; 
        this.endX2 = 74; 
        this.endY2 = 80;
        this.line2 = true;
        dropZone.lineAsig = 'line2';
      } else if (box.id === 'box3' && dropZone.id === 'box4') {
        this.startX2 = 21; 
        this.startY2 = 80; 
        this.endX2 = 74; 
        this.endY2 = 19;
        this.line2 = true;
        dropZone.lineAsig = 'line2';
      } else if (box.id === 'box3' && dropZone.id === 'box5') {
        this.startX2 = 21; 
        this.startY2 = 80; 
        this.endX2 = 74; 
        this.endY2 = 50;
        this.line2 = true;
        dropZone.lineAsig = 'line2';
      } else if (box.id === 'box3' && dropZone.id === 'box6') {
        this.startX2 = 21; 
        this.startY2 = 80; 
        this.endX2 = 74; 
        this.endY2 = 80;
        this.line2 = true;
        dropZone.lineAsig = 'line2';
      }
    } else if(!this.line3) {
      if(box.id === 'box1' && dropZone.id === 'box4') {
        this.startX3 = 21; 
        this.startY3 = 19; 
        this.endX3 = 74; 
        this.endY3 = 19;
        this.line3 = true;
        dropZone.lineAsig = 'line3';
      } else if (box.id === 'box1' && dropZone.id === 'box5') {
        this.startX3 = 21; 
        this.startY3 = 19; 
        this.endX3 = 74; 
        this.endY3 = 50;
        this.line3 = true;
        dropZone.lineAsig = 'line3';
      } else if (box.id === 'box1' && dropZone.id === 'box6') {
        this.startX3 = 21; 
        this.startY3 = 19; 
        this.endX3 = 74; 
        this.endY3 = 80;
        this.line3 = true;
        dropZone.lineAsig = 'line3';
      } else if (box.id === 'box2' && dropZone.id === 'box4') {
        this.startX3 = 21; 
        this.startY3 = 50; 
        this.endX3 = 74; 
        this.endY3 = 19;
        this.line3 = true;
        dropZone.lineAsig = 'line3';
      } else if (box.id === 'box2' && dropZone.id === 'box5') {
        this.startX3 = 21; 
        this.startY3 = 50; 
        this.endX3 = 74; 
        this.endY3 = 50;
        this.line3 = true;
        dropZone.lineAsig = 'line3';
      } else if (box.id === 'box2' && dropZone.id === 'box6') {
        this.startX3 = 21; 
        this.startY3 = 50; 
        this.endX3 = 74; 
        this.endY3 = 80;
        this.line3 = true;
        dropZone.lineAsig = 'line3';
      } else if (box.id === 'box3' && dropZone.id === 'box4') {
        this.startX3 = 21; 
        this.startY3 = 80; 
        this.endX3 = 74; 
        this.endY3 = 19;
        this.line3 = true;
        dropZone.lineAsig = 'line3';
      } else if (box.id === 'box3' && dropZone.id === 'box5') {
        this.startX3 = 21; 
        this.startY3 = 80; 
        this.endX3 = 74; 
        this.endY3 = 50;
        this.line3 = true;
        dropZone.lineAsig = 'line3';
      } else if (box.id === 'box3' && dropZone.id === 'box6') {
        this.startX3 = 21; 
        this.startY3 = 80; 
        this.endX3 = 74; 
        this.endY3 = 80;
        this.line3 = true;
        dropZone.lineAsig = 'line3';
      }
    }


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
        
        if(self.correctCount === 3) {
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
        dropZone.lineAsig = '';

    
        // Mostrar nuevamente el box correspondiente en el drop-zone
        const droppedBoxElement = document.getElementById(dropZone.correctAnswer);
        if (droppedBoxElement) {
          droppedBoxElement.style.display = 'block'; // O establece el estilo adecuado para mostrar el box (por ejemplo, 'inline-block', 'flex', etc.)
        }
      });
    
      this.line1 = false;
      this.line2 = false;
      this.line3 = false;
      this.startX1 = 0; 
      this.startY1 = 0; 
      this.endX1 = 0; 
      this.endY1 = 0;
      this.startX2 = 0; 
      this.startY2 = 0; 
      this.endX2 = 0; 
      this.endY2 = 0;
      this.startX3 = 0; 
      this.startY3 = 0;
      this.endX3 = 0; 
      this.endY3 = 0;
      
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
      <h1 class="display-6 text-center py-4 col-md-12 font-bold">Juego#1 ¿Cuál con cuál?</h1>
    </div>

    <div class="container col-md-12" >
        <div class="box-container col-md-6 ">
          <div class="text-center py-4">
            <h2>Instrucciones</h2>
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

        </div>
        <div class="image-container col-md-6 ">
          <div class="timer-container">
            <p class="contador">Contador: <span id="timer" class="text-center mt-4"> 00:00</span></p>
          </div>
          <div class="image-wrapper">
  
            <div class="line-container">
              <svg class="lienzo">

                <line class="line1"
                :x1="startX1 + '%'" :y1="startY1 + '%'"
                :x2="endX1 + '%'" :y2="endY1 + '%'"
                stroke="black"
                stroke-width="3"
                ></line>

                <line class="line2"
                :x1="startX2 + '%'" :y1="startY2 + '%'"
                :x2="endX2 + '%'" :y2="endY2 + '%'"
                stroke="black"
                stroke-width="3"
                ></line>

                <line class="line3"
                :x1="startX3 + '%'" :y1="startY3 + '%'"
                :x2="endX3 + '%'" :y2="endY3 + '%'"
                stroke="black"
                stroke-width="3"
                ></line>

              </svg>
            </div>
            
            <div class="pzI-f1">
              <img src=" {{ asset('sources/j1/Casa-de-Luis.jpg') }} " alt="fragmento1" width="100" height="100">
            </div>
            <div class="pzI-f2">
              <img src=" {{ asset('sources/j1/Luis-2.jpg') }} " alt="fragmento2" width="70" height="100">
            </div>
            <div class="pzI-f3">
              <img src=" {{ asset('sources/j1/Pastel.jpg') }} " alt="fragmento1" width="100" height="100">
            </div>
            
            <template x-for="(box, index) in boxes">
              <div class="box" 
              x-bind:id="box.id" 
              x-bind:class="{ 'dropped': box.isDropped, 'selected': selectedBox === box.id }" 
              x-bind:style="{ top: box.top + '%', left: box.left + '%', width: box.width, height: box.height }"
              x-on:click="selectedBox = box.id">
              </div>
            </template>

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
