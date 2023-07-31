<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
defineProps(['colour']);

const page = usePage();
const colour = ref('true');


</script>

<template>

<div class="flex text-lg font-bold">
    <button @click="colour = !colour" :class=" colour ? 'bg-white ring-2 ring-green-500' : 'bg-black'" class="rounded rounded-full  w-2 h-2 my-auto mr-2">
    </button>
<slot></slot>
</div>


</template>