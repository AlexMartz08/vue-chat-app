<template>
  <div
    v-if="message.sender_id === userStore.user.id"
    class="bg-emerald-500 text-white w-fit my-4 p-4 max-w-3xl rounded-l-3xl rounded-br-3xl ml-auto break-words"
  >
    {{ message.text }}
    <!-- <span class="block text-right">time</span> -->
  </div>
  <div
    v-else
    class="bg-white text-gray-800 w-fit max-w-3xl my-4 p-4 rounded-r-3xl rounded-bl-3xl break-words"
  >
    {{ message.text }}
    <!-- <span class="block">time</span> -->
  </div>
</template>

<script setup>
import { useAuthStore } from "../../stores/authUser";

defineProps({
  message: {
    required: true,
    type: Object,
  },
});

const userStore = useAuthStore();
</script>
