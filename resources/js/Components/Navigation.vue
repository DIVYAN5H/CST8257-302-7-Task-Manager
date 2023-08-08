<script setup>

import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import UserFlyout from '@/Components/UserFlyout.vue';

const isOpen = ref(false);
console.log(isOpen);
const props = defineProps(['username', 'name', 'email', 'password']);

</script>

<template>
  <nav class="backdrop-blur-md shadow-lg bg-white/10">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

      <a href="" class="flex items-center">
        <img src="/img/Logo.png" class="h-8 mr-3" alt="TaskMaster Logo" />
        <span class="text-white self-center text-2xl font-normal whitespace-nowrap">TaskMaster

        </span>
      </a>
      <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="nav-grp">

        <div class="items-center justify-evenly hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
          <ul
            class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent">
            <li>
              <Link href="/home"
                class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded ease-in-out duration-300 border-b-4 border-transparent md:bg-transparent md:p-0 hover:border-white hover:bg-gray-100 md:hover:bg-transparent md:hover:border-white md:p-0">
              Home</Link>
            </li>    
            <li>
              <Link href="/newList"
                class="block py-2 pl-3 pr-4 text-white rounded ease-in-out duration-300 border-b-4 border-transparent hover:border-white hover:bg-gray-100 md:hover:bg-transparent md:hover:border-white md:p-0 ">
              Add List+</Link>
            </li>
          </ul>
        </div>

        <div class="flex items-center md:order-2 ml-4">
          <button @click="isOpen = !isOpen" type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0  "
            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
            data-dropdown-placement="bottom">
            <!-- <span class="sr-only">Open user menu</span> -->
            <img class="w-8 h-8 rounded-full" src="/img/pumbasa.jpg" alt="user photo">
          </button>
        </div>
      </div>
    </div>
  </nav>

  <aside
    class="transform shadow-2xl top-0 right-0 w-1/4 fixed h-full overflow-hidden rounded ease-in-out transition-all duration-300 z-30"
    :class="isOpen ? '-translate-x-0' : 'translate-x-full focus:ring-4 focus:ring-gray-300'">
    <div class="backdrop-blur bg-white/30 w-full h-10 flex content-center">
      <button class="rounded-full pl-2" @click="isOpen = !isOpen"> <svg xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 24 24" stroke-width="1.5" stroke="#BB342F" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </button>
    </div>
    <UserFlyout :username="username" :name="name" :email="email" :password="password"></UserFlyout>
  </aside>
</template>