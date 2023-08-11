<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref, onUpdated, onMounted } from 'vue';

const props = defineProps(['errors']);

let errors = props.errors;

onUpdated(() => {
console.log('Inside Register: ', errors);
console.log('Inside Register 2: ', props.errors);
errors = props.errors;

});

const form = useForm({
  username: null,
  password: null,
  email: null,
  name: null
})
</script>

<template>
    <div class="py-5 px-5 my-auto w-1/3 bg-white rounded-md h-screen min-w-max">
        <div>
            <img style="width: 50px" src="/img/Logo.png" alt="" />
        </div>
        <div class="text-3xl mb-10 my-10 mx-auto text-center">Register</div>
        <form @submit.prevent="form.post('/register',{
        oonSuccess: () => $emit('transition')})">
            <div class="grid grid-cols-1 w-2/3 mx-auto">
                <div class="grid grid-cols-1">
                    <label class="ml-2" for="username"> Username </label>
                    <input type="text" name="username"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-1 w-full rounded-full"
                        placeholder="Username" id="username" v-model="form.username" />
                        <div v-if="errors.username" class="text-xs text-red-900 px-2 mb-2">{{ errors.username }}</div>
                </div>
                <div class="grid mx-auto w-full grid-cols-1">
                    <label class="ml-2" for="password"> Password </label>
                    <input type="password" name="password"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                        id="pass" placeholder="••••••••••" v-model="form.password" />
                        <div v-if="errors.password" class="text-xs text-red-900 px-2 mb-2">{{ errors.password }}</div>
                </div>
                <div class="grid grid-cols-1">
                    <label class="ml-2" for="name"> Name </label>
                    <input type="text" name="name"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                        placeholder="J. Smith" id="name" v-model="form.name" />
                        <div v-if="errors.name" class="text-xs text-red-900 px-2 mb-2">{{ errors.name }}</div>
                </div>
                <div class="grid grid-cols-1">
                    <label class="ml-2" for="email"> Email </label>
                    <input type="email" name="email"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                        placeholder="js@email.com" id="email" v-model="form.email" />
                        <div v-if="errors.email" class="text-xs text-red-900 px-2 mb-2">{{ errors.email }}</div>
                </div>
                
                <div class="grid w-full grid-cols-2 w-full">
                    <div class="mb-4 text-right text-sm">
                        <a @click="$emit('transition')">
                            <span class=" cursor-pointer italic"> Back To Login </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 w-full mx-auto mb-10">
                <button type="submit" class="rounded-full bg-violet-600 h-12 focus:ring focus:ring-violet-300 w-48 mx-auto text-white"  :disabled="form.processing">Login</button>
            </div>
        </form>
    </div>
</template>