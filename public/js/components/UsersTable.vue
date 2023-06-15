<template>
  <div>
    <input type="text" v-model="search" placeholder="Buscar usuario">
    <table>
      <tr v-for="user in filteredUsers" :key="user.id">
        <td><img :src="user.profile_picture" alt="User Profile Picture"></td>
        <td>{{ user.name }}</td>
        <td><button @click="viewStats(user)">Ver estadísticas</button></td>
        <td><button @click="chatWith(user)">Chatear</button></td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      search: ''
    }
  },
  computed: {
    filteredUsers() {
      return this.users.filter(user => user.name.includes(this.search));
    }
  },
  methods: {
    viewStats(user) {
      // Lógica para ver las estadísticas del usuario
    },
    chatWith(user) {
      // Lógica para chatear con el usuario
    }
  },
  mounted() {
    axios.get('/api/users')
      .then(response => {
        this.users = response.data;
      });
  }
}
</script>
