<!-- BlogPost.vue -->
<script setup>
import TaskBadge from "@/Components/TaskBadge.vue";
import TaskListItem from "./TaskListItem.vue";
import { useForm } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import { onUpdated } from "vue";

const props = defineProps([
  "listName",
  "tasks",
  "priority",
  "tasks",
  "date",
  "color",
]);
const page = usePage();
const isOpen = ref(false);
const addingTask = ref(false);

let tasks = ref(props.tasks);


onUpdated(() => {

  tasks.value = props.tasks});


const form = useForm({
  taskDisplay: null,
  listName: props.listName,
});

const submitAddTaskForm = async () => {
  try {
    const response = await form.post('/taskAdd', {
      taskDisplay: form.taskDisplay,
      listName: props.listName,
      preserveScroll: true,
    });

    form.taskDisplay = '';

  } catch (error) {
    // Handle error, if needed
    console.error(error);
  }
};

const updateTaskForm = useForm({
  taskId: null,
  taskDisplay: null,
  status: null,
});

const submitUpdateTaskForm = async (taskId) => {
  try {
    const response = await updateTaskForm.post(`/taskUpdate`, {
      taskId: updateTaskForm.taskId,
      taskDisplay: updateTaskForm.taskDisplay,
      status: updateTaskForm.status,
    });
  } catch (error) {
    // Handle error, if needed
    console.error(error);
  }
};
</script>


<template>
  <div class="w-100 bg-white/20  transition-all duration-400 ease-in-out overflow-hidden rounded-t-lg"
    :class="isOpen ? 'h-96' : 'h-16'">
    <div class="text-white">
      <div class="grid grid-cols-1">
        <div class=" bg-white/10 shadow-xl h-16">
          <TaskBadge :color="color" :date="date" :listName="listName"> {{ listName }} </TaskBadge>
        </div>
      </div>
      <div class="h-96 overflow-auto pb-20">
        <div class="transition text-sm duration-100 ease-in py-5 px-2 grid grid-cols-1">
          <ul class="list-disc">
            <div v-for="(task, taskId) in tasks" :key="taskId">
              <TaskListItem :taskId="taskId" :listName="listName" :status="task.status" :taskDisplay="task.taskDisplay">
              </TaskListItem>
            </div>
            <li @click="addingTask = !addingTask" class="hover:bg-white/20 ml-4 select-none w-fit cursor-pointer">
              Add New
            </li>
          </ul>
        </div>

        <div class="transition-all duration-200 h-8" :class="addingTask ? 'opacity-100' : 'opacity-0'">
          <form class="w-full" @submit.prevent="form.post('/taskAdd', { onSuccess: () => form.reset('taskDisplay')}), addingTask = !addingTask">
            <input type="text" class="w-2/3 h-8 mb-4 mx-8 text-white form-input rounded-md bg-white/30"
              v-model="form.taskDisplay" />
          </form>
        </div>
      </div>
    </div>
  </div>
  <div @click="isOpen = !isOpen "
    class="rounded-b-lg bg-white/20 hover:bg-white/30 mx-auto select-none  text-base cursor-pointer pt-1 mb-8">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white"
      class="w-6 h-6 w-full transtion duration-200 delay-200 ease-in-out" :class="isOpen ? 'rotate-180' : 'rotate-0'">
      <path fill-rule="evenodd"
        d="M20.03 4.72a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 11.69l6.97-6.97a.75.75 0 011.06 0zm0 6a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 111.06-1.06L12 17.69l6.97-6.97a.75.75 0 011.06 0z"
        clip-rule="evenodd" />
    </svg>
  </div>
</template>