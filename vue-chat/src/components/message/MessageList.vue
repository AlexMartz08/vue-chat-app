<template>
  <div
    class="flex-1 overflow-auto pt-8 px-8 scrollbar scroll-smooth"
    ref="down"
  >
    <MessageItem
      :key="message.id"
      :message="message"
      v-for="message in messageState.messages"
    />
  </div>
</template>

<style>
.scrollbar::-webkit-scrollbar {
  width: 16px;
  height: 16px;
}

.scrollbar::-webkit-scrollbar-track {
  border-radius: 100vh;
  background: #f1f5f9;
}

.scrollbar::-webkit-scrollbar-thumb {
  background: #e2e8f0;
  border-radius: 100vh;
  border: 3px solid #f8fafc;
}

.scrollbar::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
</style>

<script setup>
// import { onBeforeMount, watchEffect } from "vue";
// import ky from "ky";
import { onUpdated, ref, watchEffect } from "vue";
import { useContactStore } from "../../stores/contact";
import { useMessageStore } from "../../stores/messages";
import MessageItem from "./MessageItem.vue";

// import { onBeforeMount, watchEffect } from "vue";
// const messages = ref([]);
const contactState = useContactStore();
const messageState = useMessageStore();

const down = ref(null);

// const access_token = localStorage.getItem("access_token");
onUpdated(() => {
  down.value.scroll({
    top: down.value.scrollHeight,
    behavior: "smooth",
  });
  // down.value.scrollIntoView();
});

watchEffect((onCleanup) => {
  window.Echo.channel("messages").listen("SendMessage", function ({ message }) {
    // setMessages([...messages, message]);
    messageState.messages.push(message);
    messageState.getLastMessage(message);
  });

  onCleanup(() => {
    window.Echo.channel("messages").stopListening("SendMessage");
    window.Echo.leaveChannel("messages");
  });
});

watchEffect(async () => {
  messageState.getMessage(contactState.contactSelect.id);
  // const { data } = await ky
  //   .get(
  //     `http://localhost:8000/api/messages/user/${contactState.contactSelect.id}`,
  //     {
  //       headers: {
  //         Authorization: `Bearer ${access_token}`,
  //       },
  //     }
  //   )
  //   .json();

  // messages.value = data;
  // console.log(messages.value);
});
</script>
