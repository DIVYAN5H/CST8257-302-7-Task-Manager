<script setup>

import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import UserFlyout from '@/Components/UserFlyout.vue';

const isOpen = ref(false);
const props = defineProps(['username', 'name', 'email', 'tasksCompleted']);

</script>

<template>
  <nav class="backdrop-blur-md shadow-lg bg-white/10">
    <div class="max-w-screen w-screen flex items-center justify-between mx-auto p-4">

      <a href="" class="flex items-center">
        <img src="/img/Logo.png" class="h-8 mr-3" alt="TaskMaster Logo" />
        <span class="text-white self-center text-2xl font-normal whitespace-nowrap">TaskMaster

        </span>
      </a>
      <button @click="isOpen = !isOpen" type="button" class=" mr-3 text-sm bg-gray-800 rounded-full md:mr-0  "
            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
            data-dropdown-placement="bottom">
            <!-- <span class="sr-only">Open user menu</span> -->
            <img class="w-8 h-8 rounded-full" src="/img/pumbasa.jpg" alt="user photo">
          </button>

    </div>
  </nav>

  <aside
    class="transform shadow-2xl top-0 right-0 w-full md:w-1/2 lg:w-1/4 fixed h-full overflow-hidden rounded ease-in-out transition-all duration-300 z-30"
    :class="isOpen ? '-translate-x-0' : 'translate-x-full focus:ring-4 focus:ring-gray-300'">
    <div class="backdrop-blur bg-white/30 w-full h-16 flex content-center">
      <button class="rounded-full pl-2" @click="isOpen = !isOpen"> <svg xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 24 24" stroke-width="1.5" stroke="#BB342F" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
    </div>
    <UserFlyout :tasksCompleted="tasksCompleted" :username="username" :name="name" :email="email"></UserFlyout>
  </aside>
</template>