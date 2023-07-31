<!-- BlogPost.vue -->
<script setup>
import TaskBadge from '@/Components/TaskBadge.vue';
import { ref } from 'vue';

const completed=ref(false);

defineProps(['title', 'body', 'priority'])

</script>

<template>
    <div class="backdrop-blur w-[18.8rem] bg-white/20 rounded-lg  mb-8 ">
        <div class="text-white ">
            <div class="grid grid-cols-1"> 
                <div class="bg-white/50 h-full rounded-t-lg px-3">
                    <TaskBadge :colour="'bg-white'"> {{ title }}  </TaskBadge>
                </div>


            </div>
            <div class="text-xs pl-4 mt-1"> Due: 10/23/23 </div>
            <div @click="completed = !completed" :class="completed ? 'line-through' : '' " class="hover:bg-white/30 select-none rounded-b-lg text-base cursor-pointer pl-4"> {{ body }} </div>

        </div>


    </div>

</template>