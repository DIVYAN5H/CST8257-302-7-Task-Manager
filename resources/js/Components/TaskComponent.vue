<!-- BlogPost.vue -->
<script setup>
import TaskBadge from '@/Components/TaskBadge.vue';
import TaskListItem from './TaskListItem.vue';
import { useForm } from '@inertiajs/vue3';
import { usePage } from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'
import { ref } from 'vue';
import { onUpdated } from 'vue';


const props = defineProps(['title', 'body', 'priority', 'taskID'])
const page = usePage();
const isOpen = ref(false);
const addingTask = ref(false);

let tasks = ref(props.body)

onUpdated(() => tasks.value = props.body);

const id = props.taskID;


const form = useForm({
    id: props.taskID,
    task: null,
    title: props.title,
})




</script>


<template>
    <div class="backdrop-blur w-[38.8rem] bg-white/20 rounded-t-lg  transition-all duration-400 ease-in-out overflow-hidden"
        :class="isOpen ? 'h-96' : 'h-20'">
        <div class="text-white">
            <div class="grid grid-cols-1">
                <div class="bg-white/50 h-full rounded-t-lg px-3">
                    <TaskBadge :colour="'bg-white' "> {{ title }} </TaskBadge>

                </div>
            </div>

            <div class="transition text-sm duration-100 ease-in py-5 px-8 grid grid-cols-1">
                <ul class="list-disc">
                    <div v-for="(task, taskName) in tasks" :key="taskName">
                        <TaskListItem :id="id" :subtaskId="taskName" :title="title" > {{ task }} </TaskListItem>
                    </div>
                    <li @click="addingTask = !addingTask" class="hover:bg-white/20 select-none w-fit cursor-pointer"> Add New </li>
                </ul>

            </div>
            
            <div class="transition-all duration-200 h-8"
                :class="addingTask ? 'opacity-100' : 'opacity-0'">
                <form class="w-full" @submit.prevent="form.post('/taskUpdate')">
                    <input type="text" class="w-1/2 h-8 mb-4 mx-8 text-black form-input" v-model="form.task">
                </form>
            </div>
        </div>
    </div>

    <div @click="isOpen = !isOpen"
        class="bg-white/20 hover:bg-white/30 mx-auto select-none rounded-b-lg text-base cursor-pointer pt-2 mb-8">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
            class="w-6 h-6 w-full transtion duration-200  delay-200 ease-in-out" :class="isOpen ? 'rotate-180' : 'rotate-0'">
            <path fill-rule="evenodd"
                d="M20.03 4.72a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 11.69l6.97-6.97a.75.75 0 011.06 0zm0 6a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 111.06-1.06L12 17.69l6.97-6.97a.75.75 0 011.06 0z"
                clip-rule="evenodd" />
        </svg>
    </div>
</template>