<!-- BlogPost.vue -->
<script setup>
import TaskBadge from '@/Components/TaskBadge.vue';
import TaskListItem from './TaskListItem.vue';
import { useForm } from '@inertiajs/vue3';
import { usePage } from "@inertiajs/vue3";
import { ref } from 'vue';


const props = defineProps(['title', 'body', 'priority', 'taskID'])
const page = usePage();
const isOpen = ref(false);
const addingTask = ref(false);

const id = props.taskID;

console.log(id);

const form = useForm({
  id:  props.taskID,
  task: null,
  title: props.title,
})




</script>


<template>
    <div class="backdrop-blur w-[18.8rem] bg-white/20 rounded-lg  transition-all duration-400 ease-in-out mb-8"
        :class="isOpen ? 'h-96' : 'h-20'">
        <div class="text-white">
            <div class="grid grid-cols-1">
                <div class="bg-white/50 h-full rounded-t-lg px-3">
                    <TaskBadge :colour="'bg-white'"> {{ title }} </TaskBadge>
                </div>


            </div>
            <div class="text-xs pl-4 mt-1"> Due: 10/23/23 </div>
            <div @click="isOpen = !isOpen" 
            :class="completed ? 'line-through' : ''"
                class="hover:bg-white/30 mt-2 mx-auto select-none rounded-b-lg text-base cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 w-full transtion duration-200 ease-in-out"
                    :class="isOpen ? 'rotate-180' : 'rotate-0'">
                    <path fill-rule="evenodd"
                        d="M20.03 4.72a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 11.69l6.97-6.97a.75.75 0 011.06 0zm0 6a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 111.06-1.06L12 17.69l6.97-6.97a.75.75 0 011.06 0z"
                        clip-rule="evenodd" />
                </svg>

                

            </div>
            <div class="transition text-sm duration-100 ease-in py-5 px-8 grid grid-cols-1"
                :class="isOpen ? 'opacity-100' : 'opacity-0'">
                <ul class="list-disc">
                    <div v-for="(task, taskName) in body" :key="taskName">
                        <TaskListItem > {{ task }} </TaskListItem>
                    </div>

                </ul>
                <button @click="addingTask = true"> Add </button>
                <div v-if="addingTask">
                    <form @submit.prevent="form.post('/taskUpdate')">
                        <input type="text" class="full w-full text-black" v-model="form.task">
                        <input type="submit" :disabled="form.processing"> Submit
                    </form>
                </div>

            </div>
        </div>


    </div>
</template>