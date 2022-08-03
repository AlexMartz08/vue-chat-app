<template>
  <div
    class="flex p-6 rounded-3xl hover:bg-gray-100 transition-all"
    :class="{ 'bg-gray-100': itemSelected }"
    @click="handleClick(contact)"
  >
    <img
      src="@/assets/profile.jpg"
      alt="image profile"
      width="64"
      height="64"
      class="block object-cover rounded-full flex-none"
    />

    <div class="flex-1 ml-4">
      <h2 class="mb-2">{{ contact.name }}</h2>
    </div>
    <div class="flex flex-col items-center gap-3">
      <span class="font-light">12:50</span>
      <span
        class="flex justify-center items-center bg-emerald-500 rounded-full text-white w-6 h-6 text-xs truncate"
        >2</span
      >
    </div>
  </div>
</template>

<script setup>
import { useContactStore } from "../../stores/contact";

defineProps({
  contact: {
    required: true,
    type: Object,
  },
  itemSelected: {
    default: false,
    type: Boolean,
  },
});

// console.log(itemSelected);
const contactState = useContactStore();

function handleClick(contact) {
  // contactState.getMessage(id);
  contactState.getContactId(contact);
}
</script>
