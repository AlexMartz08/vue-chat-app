<template>
  <!-- grid -->
  <div
    v-if="authStore.isLogged"
    class="grid grid-cols-3 min-h-screen max-w-screen-2xl m-auto box-border overflow-hidden rounded-3xl border bg-white"
  >
    <!-- grid item -->
    <SideBar />
    <template v-if="isContactExist">
      <!-- messages  -->
      <MessageBoard />
    </template>
    <template v-else>
      <div class="border col-span-2 h-full">
        <div
          class="flex flex-col justify-center items-center space-x-2 mb-10 h-full gap-4"
        >
          <img
            class="block h-24 w-24 object-cover rounded-full shadow-xl shadow-emerald-500/50"
            src="@/assets/iconVue.png"
            alt=""
          />
          <h1 class="text-4xl italic font-extralight">My Vue Chat</h1>
          <div class="flex gap-2 items-center text-slate-600 font-light">
            <span class="text-2xl">select a contact to start chatting!</span>
            <font-awesome-icon :icon="['far', 'comments']" size="2x" />
          </div>
        </div>
      </div>
    </template>
  </div>
</template>

<script setup>
import SideBar from "../components/sidebar/SideBar.vue";
import MessageBoard from "../components/message/MessageBoard.vue";
import { useAuthStore } from "../stores/authUser";
import { onBeforeMount, computed } from "vue";
import { useContactStore } from "../stores/contact";
// import ky from "ky";

const authStore = useAuthStore();

// obtener usuarios
const contactState = useContactStore();
// const access_token = localStorage.getItem("access_token");

onBeforeMount(() => {
  authStore.getAuthUser();
});

const isContactExist = computed(() => {
  return Object.keys(contactState.contactSelect.value).length;
})
</script>
