<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps(['color']);

const page = usePage();


</script>

<template>

<div class="flex text-4xl font-bold">
    <!-- <button @click="color = !color" :class=" color ? 'bg-white ring-4 ring-['+ color +']' : 'bg-black ring-4 ring-['+color+']'" class="rounded rounded-full  w-2 h-2 my-auto mr-2">
    </button> -->
    <div
      :style="{ border: '5px solid'+ color }"
      class="rounded rounded-full w-5 h-5 my-auto mr-5"
    ></div>
<slot></slot>
<div class="text-base my-1 pl-4 absolute right-0 mr-3 "> Due: 10/23/23 </div>
</div>


</template>