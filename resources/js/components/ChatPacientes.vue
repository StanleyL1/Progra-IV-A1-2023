<template>
  <div id="appPaciente" class="container m-0">
    <div class="row">

      <div class="col col-12">
        <div class="chat-container">
          <div class="chat-header fondo1 text-white p-3 d-flex justify-content-between align-items-center ">
            <div>
              <img src="../../../public/img/person-circle.svg" alt="">
               {{userName}}
            </div>

          </div>
                 <div id="cameraModal" class="modal" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Camera</h5>
            <button type="button" class="btn-close" @click="closeCameraModal"></button>
          </div>
  <div class="modal-body">
    <video id="video" width="500" height="500" autoplay></video>
    <canvas id="canvas" style="display: none;"></canvas> <!-- Agrega esta línea -->
  </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" @click="takePhoto">Take Photo</button>
            <button type="button" class="btn btn-secondary" @click="closeCameraModal">Close</button>
          </div>
        </div>
      </div>
    </div>

<div id="imageModal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <img :src="selectedImage" style="width: 100%; height: auto;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="closeImageModal">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="documentModal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <iframe id="modalDocument" style="width: 100%; height: 500px;"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="closeDocModal">Close</button>
      </div>
    </div>
  </div>
</div>

          <div class="chat-messages p-3">
<ul id="ltsMensajes" class="list-unstyled">
  <li v-for="msg in messages" :key="msg._id" :class="{'chat-message-emisor': msg.from === userId, 'chat-message-receptor': msg.from !== userId}">
    <div class="chat-bubble p-2 mb-1">
      <span class="chat-user font-weight-bold"></span>
      <span v-if="isMediaUrl(msg.message)">
        <audio controls v-if="msg.message.startsWith('data:audio')" :src="msg.message"></audio> 
        <img v-else-if="msg.message.startsWith('data:image')" :src="msg.message" alt="Uploaded file" @click="openImageModal(msg.message)">
<div v-if="msg.message.startsWith('data:application/pdf')">
  <iframe :src="msg.message" style="width: 100%; height: 500px;"></iframe>
  <button class="btn" @click="openDocModal(msg.message)">Ver</button>
</div>
</span>
      <span v-else>
        {{ msg.message }}
      </span>
    </div>
  </li>
</ul>
          </div>
          <div class="chat-input p-3  fondo1">
            <form id="frmChat" v-on:submit.prevent="sendMessage" class="d-flex fondo1">
              <div class="input-group">
<label class="btn">
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-paperclip" viewBox="0 0 16 16">
    <path d="M4.5 3a2.5 2.5 0 0 1 5 0v9a1.5 1.5 0 0 1-3 0V5a.5.5 0 0 1 1 0v7a.5.5 0 0 0 1 0V3a1.5 1.5 0 1 0-3 0v9a2.5 2.5 0 0 0 5 0V5a.5.5 0 0 1 1 0v7a3.5 3.5 0 1 1-7 0V3z"/>
  </svg>
<input type="file" @change="onFileChange" accept="audio/*,image/*,.pdf" style="display: none;">
</label>
                <input type="text" v-model="newMessage.message" required placeholder="Escribe aqui tu mensaje." class="form-control mr-2 col-md-6"/>
                <div class=" col  btn-group fondo1" role="group" aria-label="Basic example">
  <button type="submit" class="btn"><svg  xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="m3 bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
</svg></button>
  <button type="button" class="btn " @click="toggleRecording"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-mic-fill" viewBox="0 0 16 16">
  <path d="M5 3a3 3 0 0 1 6 0v5a3 3 0 0 1-6 0V3z"/>
  <path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5z"/>
</svg></button>
<button type="button" class="btn " @click="showEmojiPicker">  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-emoji-smile-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zM4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8z"/>
</svg></button>
  <button type="button" class="btn" @click="openCameraModal"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-camera-fill" viewBox="0 0 16 16">
  <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
  <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
</svg></button>
                </div>                  
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<style scoped>
.chat-messages img {
  max-width: 200px;
  height: auto;
}

.container {
  max-width: 100%;
}
.emoji-picker {
  position: fixed;
  right: 0;
  top: 0;
  width: 300px;
  height: 100%;
  transform: translateY(100%);
  transition: transform 0.3s ease-out;
}
.emoji-mart-emoji {
  width: 20px;
  height: 20px;
}

.emoji-picker.open {
  transform: translateX(10);
}
.fondo1{
  background-color: #1A2B4C;
}
.chat-container {
  margin-top: 0 !important;
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  height:510px; /* Adjust this value as needed */  
}

.chat-header {
  flex-shrink: 0;
}

.chat-messages {
  flex-grow: 1;
  overflow-y: auto;
}

.chat-message-emisor .chat-bubble {
  margin-left: auto;
  background-color: #DCF8C6;
  text-align: end; 

}

.chat-message-receptor .chat-bubble {
  margin-right: auto;
  background-color: #FFFFFF; /* Color de fondo para los mensajes del receptor */
}

.chat-bubble {
  background: #f8f8f8;
  border-radius: 10px;
  position: relative;
  width: fit-content;
  height: fit-content;
    max-width: 40%;
  margin: 8px;
  padding: auto;
   word-wrap: break-word; /* Esto hará que las palabras largas se rompan y pasen a la siguiente línea */
  /* o puedes usar */
  overflow-wrap: break-word; /* Esto también hará que las palabras largas se rompan y pasen a la siguiente línea */
}

.chat-bubble::after {
  content: "";
  position: absolute;
  left: -10px;
  top: 50%;
  width: 0;
  height: 0;
  border: 10px solid transparent;
  border-right-color: #f8f8f8;
  border-left: 0;
  border-right: 10px solid #f8f8f8;
  margin-top: -10px;
  margin-left: -10px;
}

.chat-user {
  font-weight:bold;
  margin-bottom: 5px;
  display: block;
}

.chat-time {
  font-size: 0.8rem;
}

.chat-input {
  flex-shrink: 0;
}
</style>

<script>
import { v4 as uuidv4 } from 'uuid';
import alertify from 'alertifyjs';
import 'alertifyjs/build/css/alertify.css';
import io from 'socket.io-client';
import axios from 'axios';
import { EmojiButton } from '@joeattardi/emoji-button';


// Convertir blob a base64
function blobToBase64(blob) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onloadend = () => resolve(reader.result);
    reader.onerror = reject;
    reader.readAsDataURL(blob);
  });
}

// Convertir base64 a blob
function base64ToBlob(base64) {
  const byteString = atob(base64.split(',')[1]);
  const mimeString = base64.split(',')[0].split(':')[1].split(';')[0];
  const arrayBuffer = new ArrayBuffer(byteString.length);
  const uint8Array = new Uint8Array(arrayBuffer);
  for (let i = 0; i < byteString.length; i++) {
    uint8Array[i] = byteString.charCodeAt(i);
  }
  return new Blob([arrayBuffer], { type: mimeString });
}

export default {
  components: {
  },  
  data() {
    return {
          isImageModalOpen: false,
    selectedImage: null,
      isRecording: false,
      mediaRecorder: null,
      recordedBlobs: [],
      userId: localStorage.getItem('userId'),
      userName: localStorage.getItem('userName'), 
      doctor_Id: localStorage.getItem('doctor_id'),
      doctorName: localStorage.getItem('doctorName'), 
      chatId: '',
      newMessage: {
        messageId:'',
        from: localStorage.getItem('userId'),
        fromName: localStorage.getItem('userName'), 
        to: localStorage.getItem('doctorId'),
        toName: localStorage.getItem('doctorName'), 
        message: '',
        status: '', 
        fecha:new Date(),
      },
      messages: [],
      socket: null,
    };
  },
  created() {
    this.getAssignedDoctorId().then(() => {
      this.chatId = 'chat_' + this.doctor_Id + '_' + this.userId;
      this.newMessage.from = this.userId;
      this.newMessage.to = this.doctor_Id;

      this.socket = io('http://localhost:3000');

      this.socket.emit('userConnected', { userId: this.userId, chatId: this.chatId });

      this.socket.on('messages', (messages) => {
        this.messages = messages;
      });

      this.socket.on('newMessage', async (message) => {
        if (this.isAudioUrl(message.message)) {
          const blob = base64ToBlob(message.message);
          const url = URL.createObjectURL(blob);
          message.message = url;
        }
        this.messages.push(message);
        this.socket.emit('messageReceived', { messagesId: message.messageId });
      });

      this.obtenerHistorial();

      this.socket.on('chat', chat => {
        this.messages.push(chat);
      });

    });
  },
  methods: {
openDocModal(documentSrc) {
  // Asignar la fuente del documento al iframe dentro del modal
  document.getElementById('modalDocument').src = documentSrc;
  
  // Mostrar el modal
  document.getElementById('documentModal').style.display = 'block';
},

  closeDocModal() {
  document.getElementById('documentModal').style.display = 'none';
  
  // Eliminar la fuente del documento del iframe
  document.getElementById('modalDocument').src = '';
  },

   openImageModal(imageUrl) {
  const modal = document.getElementById('imageModal');
  this.selectedImage=imageUrl ;
  modal.style.display = 'block';
},

  closeImageModal() {
  const modal = document.getElementById('imageModal');
  this.selectedImage = null;
  modal.style.display = 'none';
  },

    startCamera() {
      navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
          const video = document.getElementById('video');
          video.srcObject = stream;
          video.play();
        })
        .catch((err) => {
          console.error("Error accessing the camera", err);
        });
    },

takePhoto() {
  const canvas = document.getElementById('canvas');
  const context = canvas.getContext('2d');
  const video = document.getElementById('video');

  // Ajustar el tamaño del lienzo para que coincida con el tamaño del video
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;

  context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
  const data = canvas.toDataURL('image/png');
  this.newMessage.message = data;
  this.sendMessage();
},

openCameraModal() {
  const modal = document.getElementById('cameraModal');
  modal.style.display = 'block';
  this.startCamera();
},
closeCameraModal() {
  const modal = document.getElementById('cameraModal');
  modal.style.display = 'none';
},

onFileChange(e) {
  let files = e.target.files || e.dataTransfer.files;
  if (!files.length)
    return;
  let reader = new FileReader();

  // Verificar el tipo de archivo
  if (files[0].type.startsWith('video/')) {
    alert('No se permiten videos');
    return;
  }

  reader.onload = (e) => {
    this.newMessage.message = e.target.result; // Aquí se guarda el archivo como una cadena Base64 en el mensaje
    this.sendMessage(); // Aquí se envía el mensaje después de leer el archivo
  };
  reader.readAsDataURL(files[0]);
},

     showEmojiPicker() {
      const picker = new EmojiButton();
      const trigger = document.querySelector('.bi-emoji-smile-fill');

      picker.on('emoji', selection => {
        this.newMessage.message += selection.emoji;
      });

      picker.togglePicker(trigger);
    },
isMediaUrl(url) {
  if (typeof url !== 'string') {
    return false;
  }

  if (url.startsWith('blob:') || url.startsWith('data:')) {
    return true;
  }

  // Extraer el tipo de archivo de la cadena Base64
  let fileType = url.split(';')[0];

  if (fileType.startsWith('data:audio')) {
    return true;
  } else if (fileType.startsWith('data:image')) {
    return true;
  } else if (fileType.startsWith('data:application/pdf')) {
    return true;
  } 

  return false;
},
    toggleRecording() {
      if (this.isRecording) {
        this.stopRecording();
      } else {
        this.startRecording();
      }
      this.isRecording = !this.isRecording;
    },
    startRecording() {
      navigator.mediaDevices.getUserMedia({ audio: true, video: false })
        .then(stream => {
          this.mediaRecorder = new MediaRecorder(stream);
          this.mediaRecorder.ondataavailable = event => {
            if (event.data && event.data.size > 0) {
              this.recordedBlobs.push(event.data);
            }
          };
          this.mediaRecorder.start();
        });
    },
    stopRecording() {
      this.mediaRecorder.stop();

this.mediaRecorder.ondataavailable = async (e) => {
        // Convertir el blob a base64
        const audioBase64 = await blobToBase64(e.data);
        // Enviar la cadena base64 como el mensaje
        this.newMessage.message = audioBase64;
        this.sendMessage();
      };
    },
    sendMessage() {
      if (this.newMessage.message != '') {
        this.newMessage.messageId =uuidv4();
        this.newMessage.chatId = this.chatId;
        this.newMessage.fromName = this.userName;
        this.newMessage.toName = this.doctorName;
        this.messages.push({ ...this.newMessage });
        this.socket.emit('chat', this.newMessage);
        this.newMessage.message = '';
      } else {
        alert('Por favor escriba un mensaje');
      }
    },
    obtenerHistorial() {
      this.socket.emit('historial', { userId: this.userId, chatId: this.chatId });
      this.socket.on('historial', chats => {
        this.messages = chats;
      });
    },
    async getAssignedDoctorId() {
      try {
        const response = await axios.get('api/assignedDoctor/' + this.patientId);
        this.doctorId = response.data.doctorId;
        localStorage.setItem('doctorId', this.doctorId);
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>