<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  username: null,
  password: null,
})
</script>

<template>
    <div class="py-5 px-5 my-auto w-1/3 bg-white rounded-md h-screen min-w-max">
        <div>
            <img style="width: 50px" src="/img/Logo.png" alt="" />
        </div>

        <div class="text-3xl mb-10 my-10 mx-auto text-center">Welcome!</div>
        <form @submit.prevent="form.post('/home')">
            <div class="grid grid-cols-1 w-2/3 mx-auto">
                <div class="grid grid-cols-1">
                    <label class="ml-2" for="username"> Username </label>
                    <input type="text" name="username"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                        placeholder="Username" id="username" v-model="form.username" />
                </div>
                <div class="grid mx-auto w-full grid-cols-1">
                    <label class="ml-2" for="pass"> Password </label>
                    <input type="password" name="password"
                        class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                        id="pass" placeholder="••••••••••" v-model="form.password" />
                </div>
                <!-- <div class="grid w-full grid-cols-2 w-full">
                    <div class="mb-4 min-w-max">
                        <input type="checkbox" class="form-checkbox ml-5" id="remember" />
                        <label for="remember" class="ml-2 mb-4 text-sm">
                            Remember Me
                        </label>
                    </div>
                    <div class="mb-4 text-right text-sm">
                    </div>
                </div> -->
            </div>
            <div class="grid grid-cols-1 w-full mx-auto mb-10">
                <button  class="rounded-full bg-violet-600 h-12 focus:ring focus:ring-violet-300 w-48 mx-auto text-white" type="submit"  :disabled="form.processing">Login</button>

            </div>
        </form>
        <hr class="mb-10" />
        <div class="text-center mx-auto mt-3 italic font-thin">
            No account? No worries.
        </div>
        <div class="mx-auto w-full grid">
            <button @click="$emit('transition')" class="mx-auto w-48 hover:bg-violet-600/50 form-input rounded-full">
                Join Now
            </button>
        </div>
    </div>
</template>