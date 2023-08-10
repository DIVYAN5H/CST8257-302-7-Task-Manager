<script setup>
import { usePage, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps(['color','date', 'listName']);

const page = usePage();


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

<div class="flex text-4xl font-bold">
    <!-- <button @click="color = !color" :class=" color ? 'bg-white ring-4 ring-['+ color +']' : 'bg-black ring-4 ring-['+color+']'" class="rounded rounded-full  w-2 h-2 my-auto mr-2">
    </button> -->
    <div
      :style="{ border: '5px solid'+ color }"
      class="rounded rounded-full w-5 h-5 my-auto mr-5"
    ></div>
<slot></slot>
<div class="text-base my-2 pl-4 absolute right-5 mr-3 ">Due: {{ date }} </div>
<form @submit.prevent="submitDeleteForm" class="h-full my-2">
        <button type="submit" class="absolute my-2 right-0">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="opacity-100 w-7 h-7 pb-2"
          >
            <!-- Trash Bin Icon -->
            <path
              fill-rule="evenodd"
              d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
              clip-rule="evenodd"
            />
          </svg>
        </button>
      </form>
</div>


</template>