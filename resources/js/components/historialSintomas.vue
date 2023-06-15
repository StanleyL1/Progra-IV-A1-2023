<template>
  <div class="container text-center">
    <div class="row">
      <input class="form-control" type="text" v-model="search" placeholder="Buscar usuario" style="border-radius:12px;">

      <table class="table" style="border: 1px solid black; border-collapse: collapse;">
        <tr v-for="user in paginatedData" :key="user.id">
          <td style="border: 1px solid black;" class="col col-md-2">
            <img src="../../../public/img/person-circle.svg" alt="">
          </td>
          <td style="border: 1px solid black;" class="col col-md-4">{{ user.patient.name }}</td>
          <td style="border: 1px solid black;" class="col col-md-3">
            <button style="border:none !important;" @click="chatWith(user)">
              <img src="../../../public/img/chat-dots-fill.svg" alt=""> Chatear
            </button>
          </td>
          <td style="border: 1px solid black;" class="col col-md-3">
            <button style="border:none !important;" @click="viewStats(user)">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="30" height="30">
                <!-- Aquí va el contenido de tu SVG -->
              </svg> Ver Estadisticas
            </button>
          </td>
        </tr>
      </table>

      <pagination :data="users" @pagination-change-page="getResults"></pagination>
    </div>
  </div>
</template>

<script>
import axios from 'axios'; 
import Pagination from 'vue-pagination-3';

export default {
  components: {
    Pagination
  },
  data() {
    return {
      users: [],
      search: '',
      page: 1
    }
  },
  computed: {
    filteredUsers() {
      return this.users.filter(user => user.patient.name.includes(this.search));
    },
    paginatedData() {
      return this.filteredUsers.slice((this.page - 1) * 10, this.page * 10);
    }
  },
  methods: {
    getResults(page = 1) {
      axios.get(`/api/doctors/${userId}/patients?page=${page}`)
        .then(response => {
          this.users = response.data;
          this.page = page;
        });
    },
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
    this.getResults();
  }
}
</script>
