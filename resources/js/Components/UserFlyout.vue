<script setup>
import { useForm } from '@inertiajs/vue3';
<<<<<<< HEAD
const props = defineProps(['username', 'email', 'name', 'password']);
=======
const props = defineProps(['username', 'email', 'name', 'tasksCompleted']);
>>>>>>> 714bc1379e1f1c96cfd512223007722f33c88757


const email = props.email


const form = useForm({
 loggingOut: true,
 name: props.name,
 password: ''
});

const initials = getInitials(form.name);

function getInitials(name) {

  const words = name.trim().split(/\s+/);
  const initials = words.map(word => word.charAt(0).toUpperCase());
  const initialsString = initials.join('');

  return initialsString;
}
</script>

<template>
    <div class="h-screen text-white w-full bg-texture-1 overflow-hidden">
        <div class="grid-cols-1 mx-auto w-full h-full py-16 overflow-hidden">
            <div>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-48 h-48 mx-auto border-4 rounded-full p-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg> -->
                <div fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-48 h-48 mx-auto border-4 rounded-full p-2 flex justify-center content-center">
                    <h1 class="text-8xl p-10">{{ initials }}</h1>
                </div>
            </div>
            <div class="mx-auto text-center text-2xl w-full pt-4">
                {{ name }}
            </div>
            <div class="text-center text-sm">
                {{ tasksCompleted }} Tasks Completed
            </div>
            <div id="userInfoSection" class="grid grid-cols-2">
                <div class="grid-cols-1 text-lg w-1/2 mx-auto py-16">
                    <div class="mb-4 mt-2"> Name: </div>
                    <div> Password: </div>
                </div>
                <div class="grid-cols-1 text-lg w-1/2 py-16">
                <form @submit.prevent="form.post('/userUpdate')">
                    <input type="text" name="name" v-model="form.name" class="bg-transparent rounded-full w-40 mb-1">
                    <input type="text" name="password" v-model="form.password" placeholder="password" class="bg-transparent rounded-full w-40">
                    <!-- <div> {{ email }}</div>
                    <div>{{ username }}</div> -->
                    <button type="submit" class="grid-cols-1 rounded-full bg-white/30 p-3 border hover:bg-white/40"> Update </button>
                </form>
                </div>
            </div>
            <form @submit.prevent="form.post('/logout1')" class="w-100 mx-auto flex ">
                <button type="submit" class="w-1/2 mx-auto rounded-full bg-white/30 p-3 border hover:bg-white/40"> Logout </button>
            </form>
        </div>
    </div>
</template>