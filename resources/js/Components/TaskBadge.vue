<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
defineProps(['colour']);

const page = usePage();
const colour = ref('true');


</script>

<template>

<div class="flex text-4xl font-bold">
    <button @click="colour = !colour" :class=" colour ? 'bg-white ring-4 ring-green-500' : 'bg-black ring-4 ring-green-500'" class="rounded rounded-full  w-2 h-2 my-auto mr-2">
    </button>
<slot></slot>
<div class="text-base my-1 pl-4 absolute right-0 mr-3 "> Due: 10/23/23 </div>
</div>


</template>