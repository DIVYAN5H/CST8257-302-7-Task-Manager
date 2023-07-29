<script setup>
import { usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { useForm } from '@inertiajs/vue3';


const page = usePage();
const users = page.props.user;

const form = useForm({
  user: null,
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
        <form @submit.prevent="form.post('/register')">
            <div class="grid grid-cols-1 w-2/3 mx-auto">
                <div class="grid grid-cols-1">
                    <label class="ml-2" for="username"> Username </label>
                    <input type="text" name="username"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                        placeholder="Username" id="username" v-model="form.user" />
                </div>
                <div class="grid mx-auto w-full grid-cols-1">
                    <label class="ml-2" for="pass"> Password </label>
                    <input type="password" name="password"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                        id="pass" placeholder="••••••••••" v-model="form.password" />
                </div>
                <div class="grid grid-cols-1">
                    <label class="ml-2" for="username"> Name </label>
                    <input type="text" name="username"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                        placeholder="J. Smith" id="name" v-model="form.name" />
                </div>
                <div class="grid grid-cols-1">
                    <label class="ml-2" for="username"> Email </label>
                    <input type="text" name="username"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                        placeholder="js@email.com" id="email" v-model="form.email" />
                </div>
                
                <div class="grid w-full grid-cols-2 w-full">
                    <div class="mb-4 text-right text-sm">
                        <button @click="$emit('transition')">
                            <span class="italic"> Back To Login </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 w-full mx-auto mb-10">
                <button type="submit" class="rounded-full bg-violet-600 h-12 focus:ring focus:ring-violet-300 w-48 mx-auto text-white" @click="$emit('transition')" :disabled="form.processing">Login</button>
            </div>
        </form>
    </div>
</template>