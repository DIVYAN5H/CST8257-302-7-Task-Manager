<script setup>
import { ref } from 'vue';
const completed = ref(false);
</script>

<template>


<li class="select-none cursor-pointer" @click="completed = !completed" :class="completed ? 'line-through' : ''"> <slot class="select-none"></slot></li>

</template>