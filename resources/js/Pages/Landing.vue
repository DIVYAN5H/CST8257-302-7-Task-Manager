<script setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Landing" />

    <div class="grid h-screen" style="background-image: url('/img/landing-bg-day.jpg');">
        <div class="py-6 px-5 mx-auto my-auto w-1/4 bg-white rounded-md">
            <div class="text-5xl mb-2 mx-auto text-center">Welcome</div>
            <hr class="h-1 mb-8 bg-gray-200 border-0 rounded dark:bg-gray-700">
            <form>
                <div class="grid grid-cols-1">
                    <div class="grid grid-cols-1">
                        <label class="ml-5" for="email"> Email </label>
                        <input type="email" class="form-input px-3 py-1 mb-3 rounded-full"
                            placeholder="example@example.com" id="email">
                    </div>
                    <div class="grid grid-cols-1">
                        <label class="ml-5" for="pass"> Password </label>
                        <input type="password" class="form-input px-3 py-1 mb-3 rounded-full" id="pass" placeholder="********">
                    </div>
                </div>
                <div class="grid grid-cols-1 w-full mx-auto mb-4">
                    <button class="rounded-full bg-pink-500 focus:ring focus:ring-violet-300 w-48 mx-auto h-8">Login</button>
                </div>
                <div class="mb-4">
                    <input type="checkbox" class="form-checkbox ml-5" id="remember"> <label for="remember" class="ml-2 mb-4 text-sm"> Remember Me </label> 
                </div>
            </form>
            <hr>
            <div class="text-center mx-auto mt-3 italic font-thin"> Don't have an account?</div>
            <div class="mx-auto w-full grid"> <button class="mx-auto w-48"> Join Now </button> </div>
        </div>
    </div>
</template>