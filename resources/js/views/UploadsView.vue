<template>
    <div class="home">
      <div>
        <h2 class="text-2xl font-bold text-purple-700 text-center mt-5">
          Upload de Arquivo: {{ $route.params.id }}
        </h2>  
      </div>
    </div>
  </template>
  
  
  <script>
  // @ is an alias to /src
  // import '../assets/tailwind.css';
  import '@/assets/tailwind.css';
  import Pusher from 'pusher-js' // import Pusher
  
  export default {

    created () {

      this.subscribe()

    },

    name: 'Uploads',

    setup(){

      var pusher = new Pusher("7b3702a5d9470d4f46ca", {
        cluster: "us2",
      });

      var channel = pusher.subscribe("upload-csv");

      channel.bind("status-import", (data) => {
        // Method to be dispatched on trigger.
        console.log(data);
      });

    },
    
    methods: {
    subscribe () {
        let pusher = new Pusher('7b3702a5d9470d4f46ca', { cluster: 'us2' })
        pusher.subscribe('upload-csv')
        pusher.bind('status-import', data => {
          console.log("push:");
          console.log(data);
        })
      }
    }
  };
  </script>