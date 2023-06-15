<template>
  <div class="container text-center">
    <div class="row">
           <input class="form-control" type="text" v-model="search" placeholder="Buscar usuario" style="border-radius:12px;">

    <table class=" table" style="  border: 1px solid black;
  border-collapse: collapse;">

      <tr v-for="user in filteredUsers" :key="user.id">
        <td style="border: 1px solid black;" class="col col-md-2">
          <img src="../../../public/img/person-circle.svg" alt="">
        </td>
<td style="border: 1px solid black;" class="col col-md-4">   {{ user.patient.name }}</td>
        <td style="border: 1px solid black;" class="col col-md-3" ><button style="border:none !important;" @click="chatWith(user)"><img src="../../../public/img/chat-dots-fill.svg" alt=""> Chatear</button></td>
        <td style="border: 1px solid black;" class="col col-md-3" ><button style="border:none !important;" @click="viewStats(user)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30" height="30"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M32 32c17.7 0 32 14.3 32 32V400c0 8.8 7.2 16 16 16H480c17.7 0 32 14.3 32 32s-14.3 32-32 32H80c-44.2 0-80-35.8-80-80V64C0 46.3 14.3 32 32 32zM160 224c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32s-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm128-64V320c0 17.7-14.3 32-32 32s-32-14.3-32-32V160c0-17.7 14.3-32 32-32s32 14.3 32 32zm64 32c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V224c0-17.7 14.3-32 32-32zM480 96V320c0 17.7-14.3 32-32 32s-32-14.3-32-32V96c0-17.7 14.3-32 32-32s32 14.3 32 32z"/></svg> Ver Estadisticas</button></td>
      </tr>
    </table>
    </div>

  </div>
</template>

<script>
import axios from 'axios'; 

export default {
  data() {
    return {
      users: [],
      search: ''
    }
  },
  computed: {
    filteredUsers() {
  return this.users.filter(user => user.patient.name.includes(this.search));
    }
  },
  methods: {
    viewStats(user) {
      // Lógica para ver las estadísticas del usuario
    },
    chatWith(user) {
        localStorage.setItem('patientId', user.patient.id);
        localStorage.setItem('patientName', user.patient.name);
        window.location.href = '/chat';
    }
  },
  mounted() {
    const userId = localStorage.getItem('userId');
    axios.get(`/api/doctors/${userId}/patients`)
      .then(response => {
              console.log(response.data); // Añade esta línea

        this.users = response.data;
      });
  }
}
</script>
