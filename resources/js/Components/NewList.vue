<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import Navigation from "@/Components/Navigation.vue";

const page = usePage();
const user = page.props.user;
const email = page.props.email
const name = page.props.name;
const password = page.props.password

console.log(password);


const form = useForm({
  list: null,
  color: null,
  priority: null,
  date: null,
});
</script>
<template>
    <button @click="$emit('close')"> Close </button>

      <form @submit.prevent="form.post('/newList')" class="px-8 pt-6 pb-8 text-white transition-all">
        <div class="mb-6">
          <label class="block  text-sm font-bold mb-2" for="title">
            List Name
          </label>
          <input
            v-model="form.list"
            name="list"
            class="shadow appearance-none border border-purple-500 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="list"
            type="text"
          />
        </div>


        <div class="mb-6 flex justify-start">
          <div >

            <label
              class="block  text-sm font-bold mb-2"
              for="description"
            >
              Priority
            </label>
            <select
              v-model="form.priority"
              name="priority"
              class=" shadow appearance-none w-44 border border-purple-500 rounded-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="priority"
            >
              <option value="1">Low</option>
              <option selected value="2">Medium</option>
              <option value="3">High</option>
            </select>
          </div>
          <div>

            <label
              class="block ml-10  text-sm font-bold mb-2"
              for="description"
            >
              Due Date
            </label>
            <input
              type="date"
              v-model="form.date"
              name="date"
              placeholder="dd-mm-yy"
              class="w-full shadow appearance-none ml-10 border border-purple-500 rounded-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="date"
            />
          </div>

            
          
        </div>

        <!-- Need Date input with name="date"-->

        <div class="mb-8">
          <label
            class="block  text-sm font-bold mb-2"
            for="description"
          >
            Color
          </label>
          <input
            v-model="form.color"
            type="color"
            name="color"
            id="color"
            style="border-radius: 15px; resize: none; scrollbar-width: none"
            class="colorstyle shadow p-1 w-44 appearance-none border border-purple-500 rounded-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          />
        </div>

        <div class="flex items-center justify-center">
          <button
            type="submit"
            :disabled="form.processing"
            class="button py-2 px-4 w-1/3 rounded-full border"
          >
            Add task
          </button>
        </div>
      </form>


</template>