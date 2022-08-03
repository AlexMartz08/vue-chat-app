<template>
  <Menu as="div" class="relative inline-block text-left">
    <div>
      <MenuButton
        class="flex-inline w-12 h-12 justify-center items-center rounded-full px-3 py-3 bg-gray-100 text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100"
      >
        <font-awesome-icon icon="ellipsis-vertical" size="lg" />
      </MenuButton>
    </div>

    <transition
      enter-active-class="transition ease-out duration-100"
      enter-from-class="transform opacity-0 scale-95"
      enter-to-class="transform opacity-100 scale-100"
      leave-active-class="transition ease-in duration-75"
      leave-from-class="transform opacity-100 scale-100"
      leave-to-class="transform opacity-0 scale-95"
    >
      <MenuItems
        class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
      >
        <div class="py-1">
          <MenuItem v-slot="{ active }">
            <div
              @click="handleClick"
              :class="[
                active ? 'bg-emerald-100 text-gray-900' : 'text-gray-700',
                'block px-4 py-2 text-sm',
              ]"
            >
              Sign out
            </div>
          </MenuItem>
        </div>
      </MenuItems>
    </transition>
  </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import router from "../router";
import { useAuthStore } from "../stores/authUser";
const autState = useAuthStore();
function handleClick() {
  localStorage.removeItem("access_token");
  router.push("/login");
  autState.$reset();
}
</script>
