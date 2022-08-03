<template>
  <div class="flex px-8 py-9 border-b bg-white">
    <div class="relative flex-shrink-0">
      <img
        src="@/assets/profile.jpg"
        alt="image profile"
        width="48"
        height="48"
        class="block object-cover rounded-full"
      />
      <span
        class="block absolute bg-green-600 border-2 border-white w-3 h-3 inset-x-9 inset-y-10 rounded-full"
      ></span>
    </div>
    <div class="flex-1 ml-4">
      <h2 class="mb-2">{{ contactState.contactSelect.name }}</h2>
      <span class="text-sm text-gray-500">last seen</span>
    </div>
    <div class="flex items-center space-x-2">
      <ButtonIcon>
        <font-awesome-icon icon="plus" />
      </ButtonIcon>
      <ButtonIcon>
        <font-awesome-icon :icon="['far', 'bell']" />
      </ButtonIcon>
      <DropDownMenu />
    </div>
  </div>
</template>

<script setup>
import DropDownMenu from "../DropDownMenu.vue";
import ButtonIcon from "../ButtonIcon.vue";
import { useContactStore } from "../../stores/contact";

const contactState = useContactStore();
</script>
