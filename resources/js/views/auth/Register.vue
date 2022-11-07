<script>
import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
  name: 'Register',
  setup() {
    const name = ref('');
    const email = ref('');
    const password = ref('');
    const password_confirmation = ref('');
    const router = useRouter();
    const validation = ref([]);

    const submit = async () => {
      await axios
        .post('/register', {
          name: name.value,
          email: email.value,
          password: password.value,
          password_confirmation: password_confirmation.value,
        })
        .then(() => {
          router.push({ path: '/entrar' });
        })
        .catch((error) => {
          validation.value = error.response.data;
        });
    };

    return {
      name,
      email,
      password,
      password_confirmation,
      submit,
      validation,
    };
  },
};
</script>

<template>
  <div class="relative flex flex-col items-center justify-center min-h-screen">
    <span class="px-2 py-2 mb-4 text-red-600 rounded shadow">
      {{ validation.message }}
    </span>
    <div class="w-full p-6 shadow bg-gray-50 lg:max-w-md">
      <h1 class="text-3xl font-semibold text-center text-purple-700">Criar conta</h1>
      <form class="space-y-4" @submit.prevent="submit">
        <div>
          <label for="name" class="block text-sm text-gray-800">Nome</label>
          <input
            v-model="name"
            name="name"
            type="text"
            class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
          />
        </div>
        <div>
          <label for="email" class="block text-sm text-gray-800">Email</label>
          <input
            v-model="email"
            name="email"
            type="email"
            class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
          />
        </div>
        <div>
          <label for="password" class="block text-sm text-gray-800"
            >Senha</label
          >
          <input
            v-model="password"
            name="password"
            type="password"
            class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
          />
        </div>
        <div>
          <label for="password" class="block text-sm text-gray-800"
            >Confirmação de senha</label
          >
          <input
            v-model="password_confirmation"
            name="password_confirmation"
            type="password"
            class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
          />
        </div>
        <div>
          <button
            class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-purple-700 rounded-md hover:bg-purple-600 focus:outline-none focus:bg-purple-600"
          >
            Cadastrar
          </button>
        </div>
      </form>
      <p class="mt-8 text-xs font-light text-center text-gray-700">
        Já possui uma conta?

        <RouterLink
          to="/entrar"
          class="font-medium text-purple-600 hover:underline">
          Entrar
        </RouterLink>
      </p>
    </div>
  </div>
</template>