<template>
    <nav class="container flex justify-around py-8 mx-auto bg-white border">
    <Logo />
      <div class="flex items-center space-x-8">
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/csv">CSV</RouterLink>
        <button @click="Logout">Logout</button>
      </div>
    </nav>
  </template>
  
  <script>
  import { useRouter } from 'vue-router';
  export default {
    name: 'NavbarLogged',
    setup() {
      const router = useRouter();
      const Logout = () => {
        localStorage.clear();
        window.location.href = "/entrar";
      };
      return { Logout };
    },
  };
  </script>