<template>
  <div class="border max-h-screen">
    <!-- user -->
    <UserNav />

    <!-- contactos  -->

    <Suspense>
      <ContactBar />
      <template #fallback>
        <ContactSkeleton />
      </template>
    </Suspense>
  </div>
</template>

<script setup>
import ContactBar from "./ContactBar.vue";
import UserNav from "./UserNav.vue";
import ContactSkeleton from "../skeleton/ContactSkeleton.vue";
</script>
