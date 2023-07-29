<!-- BlogPost.vue -->
<script setup>
defineProps(['title', 'body', 'priority'])

</script>

<template>
    <div  class="backdrop-blur w-[18.8rem] bg-white/30 rounded p-2 mx-2 my-4 box-borders">
        <div class="text-white ">
            <h4> {{ title }} </h4>
            <span> {{ body }} </span>
        </div>


    </div>

</template>