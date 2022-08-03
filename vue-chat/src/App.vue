<template>
  <div class="bg-gray-100">
    <RouterView />
  </div>
</template>

<script setup>
import { RouterView } from "vue-router";
//pusher y laravel echo
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Echo = new Echo({
  broadcaster: "pusher",
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  forceTLS: true,
});
</script>
