<script>
import { RouterLink, RouterView } from 'vue-router';

export default {
  name: 'App',
  setup() {
    let loggedUser = '';
    if(localStorage.getItem('token') != undefined && localStorage.getItem('token') != ""){
      loggedUser = localStorage.getItem('token');
    }

    return {
      loggedUser
    };
  },
};
</script>

<template>
  <div v-if="loggedUser">
    <NavbarLogged />
  </div>
  <div v-else>
    <Navbar />
  </div>
  <RouterView />
</template>