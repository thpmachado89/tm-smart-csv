<template>
    <nav class="container flex justify-around py-8 mx-auto bg-white border">
    <Logo />
      <div class="flex items-center space-x-8">
        <RouterLink to="/entrar">Entrar</RouterLink>
        <RouterLink to="/cadastrar">Cadastrar</RouterLink>
      </div>
    </nav>
  </template>
  
  <script>
  import { useRouter } from 'vue-router';
  export default {
    name: 'Navbar',
    setup() {
      const router = useRouter();
      const Logout = () => {
        localStorage.clear();
        router.push({ path: '/entrar' });
      };
      console.log("teste");
      return { Logout };
    },
  };
  </script>