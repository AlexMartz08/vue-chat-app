<template>
  <div
    class="flex flex-col border col-span-2 max-h-screen bg-gray-100 bg-gradient-to-r from-gray-300 to-blue-100"
  >
    <!-- contact -->
    <MessageContact />

    <!-- chats -->
    <MessageList />

    <!-- message form -->
    <MessageForm />
  </div>
</template>

<script setup>
import MessageContact from "./MessageContact.vue";
import MessageForm from "./MessageForm.vue";
import MessageList from "./MessageList.vue";
</script>
