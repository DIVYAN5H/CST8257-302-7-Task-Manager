<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
const show = ref(true)
</script>

<template>
  <Transition>
    <div v-if="show" class="bg-gradient-to-r from-violet-500 to-fuchsia-500 h-screen">
      <Navigation></Navigation>
        <Link @click="show = !show" href="/landing" as="button" type="button" class="rounded-full bg-violet-600 h-12 focus:ring focus:ring-violet-300 w-48 mx-auto text-white "> AAAA </Link>
    </div>
  </Transition>
</template>
