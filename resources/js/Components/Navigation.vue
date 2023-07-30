<script setup>

import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import UserFlyout from '@/Components/UserFlyout.vue';

const isOpen = ref(false);
console.log(isOpen);

defineProps(['username', 'name', 'email']);

</script>

<template>
  <nav class="backdrop-blur-lg shadow-lg bg-white/10 h-10">
    <div class="w-1/2 absolute top-0 left-0 h-full">
      <div class="w-1/6 h-full pl-5">
        <div class="text-white flex text-2xl font-normal whitespace-nowrap h-full"> 
          <img src="/img/Logo.png" class="h-full"
            alt="TaskMaster Logo" />
          <div class="mt-1 h-full">TaskMaster </div>
        </div>
      </div>
    </div>
    <div>
      <button @click="isOpen = !isOpen" type="button"
        class="mr-6 absolute inset-y-0 right-6 top-0 text-sm rounded-full md:mr-0  " id="user-menu-button"
        aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full inline" src="/img/pumbasa.jpg" alt="user photo">
      </button>
    </div>



  </nav>

  <aside
    class="transform shadow-2xl top-0 right-0 w-1/4 fixed h-full rounded overflow-auto ease-in-out transition-all duration-300 z-30"
    :class="isOpen ? '-translate-x-0' : 'translate-x-full focus:ring-4 focus:ring-gray-300'">
    <div class="backdrop-blur bg-white/30 w-full h-10">
      <button class="rounded-full" @click="isOpen = !isOpen"> <svg xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 24 24" stroke-width="1.5" stroke="#BB342F" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
    </div>
    <UserFlyout :username="username" :name="name" :email="email"></UserFlyout>
  </aside>
</template>