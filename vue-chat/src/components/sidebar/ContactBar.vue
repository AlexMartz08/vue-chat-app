<template>
  <div class="h-full space-y-2 overflow-auto pt-2 xl:px-4 2xl:px-8 scrollbar">
    <ContactItem
      :key="contact.id"
      v-for="contact in contactState.contacts"
      :contact="contact"
      :item-selected="contact.id === contactState.contactSelect.id"
    />
    <!-- <template
      :key="contact.id"
      v-for="contact in contactState.contacts"
      :contact="contact"
    > -->
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
import { onBeforeMount, ref } from "vue";
import { useAuthStore } from "../../stores/authUser";
import { useContactStore } from "../../stores/contact";
import ContactItem from "./ContactItem.vue";

// const itemSelect = ref(false);

const authStore = useAuthStore();

const contactState = useContactStore();

await contactState.getContacts();

</script>
