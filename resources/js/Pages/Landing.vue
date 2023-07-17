<script setup>
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <Head title="Landing">

    </Head>




    <div class="grid h-screen font-Poppins bg-cover" style="background-image: url('/img/landing-bg-day.jpg');">
        <div class="py-20 px-5 my-auto w-1/3 bg-white rounded-md h-screen min-w-max">
            <div class="text-3xl mb-10 my-10 mx-auto text-center">Welcome!</div>
            <form>
                <div class="grid grid-cols-1 w-2/3 mx-auto">
                    <div class="grid grid-cols-1">
                        <label class="ml-2" for="email"> Email </label>
                        <input type="email"
                            class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                            placeholder="example@example.com" id="email">
                    </div>
                    <div class="grid mx-auto w-full grid-cols-1">
                        <label class="ml-2" for="pass"> Password </label>
                        <input type="password"
                            class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                            id="pass" placeholder="••••••••••">
                    </div>
                    <div class="grid w-full grid-cols-2 w-full">
                    <div class="mb-4 min-w-max">
                        <input type="checkbox" class="form-checkbox ml-5" id="remember"> <label for="remember"
                            class="ml-2 mb-4 text-sm"> Remember Me </label>
                    </div>
                    <div class="mb-4 text-right text-sm">
                        <a href="/test2"> <span class="italic"> Forgot Password? </span> </a>
                    </div>
                </div>
                </div>
                <div class="grid grid-cols-1 w-full mx-auto mb-10">
                    <Link href="/test2" as="button" type="button" class="rounded-full bg-violet-600 h-12 focus:ring focus:ring-violet-300 w-48 mx-auto text-white">Login</Link>
                </div>

            </form>
            <hr class="mb-10">
            <div class="text-center mx-auto mt-3 italic font-thin"> No account? No worries.</div>
            <div class="mx-auto w-full grid"> <button class="mx-auto w-48 hover:bg-violet-600/50 form-input rounded-full"> Join Now </button>
            </div>
        </div>
    </div>
</template>