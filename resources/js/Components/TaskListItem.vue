<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const completed = ref(false);

const props = defineProps(["taskId", "taskDisplay", "listName", "status"]);

const form = useForm({
  listName: props.listName,
  taskId: props.taskId,
  taskDisplay: props.taskDisplay
});

const completedForm = useForm({
  status: props.status,
});

const toggleStatusAndSubmit = () => {
  completedForm.status = !completedForm.status; // Invert the status
  submitUpdateForm(); // Submit the form
};

const submitUpdateForm = () => {
  form.post('/taskUpdate', {
    preserveScroll: true,
  });
};

const submitDeleteForm = () => {
  form.post('/taskDelete', {
    preserveScroll: true,
  });
};
</script>

<template>
  <div class="w-full">
    <li class="select-none group hover:bg-white/40 py-1 w-full flex cursor-pointer">
      <div class="w-4/5">
        <form @submit.prevent="submitUpdateForm">
          <input class="w-10/12 bg-transparent border-x-0 border-y-0 border-r-0" :class="completedForm.status ? 'border-l-4 border-green-500' : ''" type="text" v-model="form.taskDisplay">
          <button v-if="form.isDirty" type="submit">
            Update
          </button>
        </form>
      </div>
      <div class="grid grid-cols-2 items-center">
        <form @submit.prevent="submitUpdateForm">
          <button type="submit" class="">
            <svg @click="toggleStatusAndSubmit" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="transparent"
              class="opacity-0 group-hover:opacity-100 w-8 h-8 pt-1">
              <!-- X -->
              <path v-if="completedForm.status"
                d="M6.99486 7.00636C6.60433 7.39689 6.60433 8.03005 6.99486 8.42058L10.58 12.0057L6.99486 15.5909C6.60433 15.9814 6.60433 16.6146 6.99486 17.0051C7.38538 17.3956 8.01855 17.3956 8.40907 17.0051L11.9942 13.4199L15.5794 17.0051C15.9699 17.3956 16.6031 17.3956 16.9936 17.0051C17.3841 16.6146 17.3841 15.9814 16.9936 15.5909L13.4084 12.0057L16.9936 8.42059C17.3841 8.03007 17.3841 7.3969 16.9936 7.00638C16.603 6.61585 15.9699 6.61585 15.5794 7.00638L11.9942 10.5915L8.40907 7.00636Z"
                fill="currentColor" />
              <!-- ✓  -->
              <path v-else d="M4.89163 13.2687L9.16582 17.5427L18.7085 8" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </form>
        <form @submit.prevent="submitDeleteForm">
          <button type="submit" class="right-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="opacity-0 group-hover:opacity-100 w-7 h-7 ">
              <!-- Trash Bin Icon -->
              <path fill-rule="evenodd"
                d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </form>

      </div>
    </li>
  </div>
</template>
