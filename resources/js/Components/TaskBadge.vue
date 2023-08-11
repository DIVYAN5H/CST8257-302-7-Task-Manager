<script setup>
import { usePage, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps(['color', 'date', 'listName', 'completed', 'total', 'priority',]);

let priority = convertPriority(props.priority);

console.log(typeof(props.priority));

function convertPriority(priority) {
  switch (priority) {
    case '1':
      return 'Low';
    case '2':
      return 'Medium';
    case '3':
      return 'High';
    default:
      return 'Low';
  }
};

const form = useForm({
  listName: props.listName,
});

const submitDeleteForm = () => {
  form.post('/listDelete', {
    listName: props.listName,
    preserveScroll: true,
  });
};
</script>

<template>
  <div class="grid group grid-cols-8 text-xl font-bold h-full">
    <!-- <button @click="color = !color" :class=" color ? 'bg-white ring-4 ring-['+ color +']' : 'bg-black ring-4 ring-['+color+']'" class="rounded rounded-full  w-2 h-2 my-auto mr-2">
    </button> -->
    <div :style="{ backgroundColor: color }" class="h-full mr-4"></div>
    <div class="col-span-6 py-2">
      <slot></slot>
      <span class=" ml-3 h-full text-xs p-1 rounded-lg border border-white"> {{ priority }} </span>
      <hr />
      <div class="text-sm flex items-center">
        <div> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
            <path
              d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12zM11.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H12a.75.75 0 01-.75-.75V12zM12 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H12zM13.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H14a.75.75 0 01-.75-.75V10zM14 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H14z" />
            <path fill-rule="evenodd"
              d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
              clip-rule="evenodd" />
          </svg></div>
        <div class="h-full ml-1 pt-1 flex items-center font-normal"> {{ date }}</div>
        <div class="ml-2 border-l-2 pl-2 mt-1 "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
            fill="currentColor" class="w-6 h-6">
            <path
              d="M2 4.5A2.5 2.5 0 014.5 2h11a2.5 2.5 0 010 5h-11A2.5 2.5 0 012 4.5zM2.75 9.083a.75.75 0 000 1.5h14.5a.75.75 0 000-1.5H2.75zM2.75 12.663a.75.75 0 000 1.5h14.5a.75.75 0 000-1.5H2.75zM2.75 16.25a.75.75 0 000 1.5h14.5a.75.75 0 100-1.5H2.75z" />
          </svg>
        </div>
        <div v-if="total <= 0" class="h-full border-r-2 pr-2 ml-1 pt-1 flex items-center font-normal"> No Tasks </div>
        <div v-if="total > 0" class="h-full border-r-2 pr-2 ml-1 pt-1 flex items-center font-normal"> {{ parseInt((completed / total) * 100) }}% Completed</div>

      </div>
      
    </div>
    <div class="opacity-0 group-hover:opacity-100 right-0 ml-4 mt-2">
      
      <form @submit.prevent="submitDeleteForm" class="h-full">
        <button type="submit" class="">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="opacity-100 w-5 h-5">
            <!-- Trash Bin Icon -->
            <path fill-rule="evenodd"
              d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
              clip-rule="evenodd" />
          </svg>
        </button>
      </form>
    </div>
  </div>
</template>