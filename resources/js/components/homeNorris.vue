<template>
  <div class="container text-center">
    <div class="container">
      <!-- Contenido principal de la página -->
      <div class="hero-section">
    <div class="hero-image col-lg-6">
        <img src="../../img/norris.jpg" alt="Imagen de ejemplo" class="img-fluid">
    </div>
    <div class="hero-text">
        <p class="h2">Bienvenid@s</p>
        <p>Hola, soy norris tu asistente virtual, mi objetivo es ayudar a personas con enfermedad obstructiva cronica</p>
    </div>
</div>

    </div>
  </div>
</template>

<script>
import axios from 'axios'; 

export default {
  data() {
    return {
      doctorId: '',
      doctorName: '',
    }
  },
  methods: {
    getDoctorData() {
      const userId = localStorage.getItem('userId');
      axios.get(`/api/patients/${userId}/doctors`)
        .then(response => {
          this.doctorId = response.data[0].doctor_id;
          this.doctorName = response.data[0].doctorName;
          localStorage.setItem('doctor_id', this.doctorId);
          localStorage.setItem('doctorName', this.doctorName);
        })
        .catch(error => {
          console.error(error);
        });
    }
  },
  mounted() {
    this.getDoctorData();
  }
}
</script>
