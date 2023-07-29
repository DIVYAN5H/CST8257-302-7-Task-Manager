<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import { useForm } from '@inertiajs/vue3';

const show = ref(true);

const page = usePage();
const users = page.props.user;

console.log(users);

const form = useForm({
  user: null,
  password: null,
})

// const csrfToken = ref(document.head.querySelector('meta[name="csrf-token"]').content);

// function submitForm() {

//     fetch('/login', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': csrfToken.value,
//         },
//         body: JSON.stringify(form),
//     }).then()
// }
</script>

<template>
  <Head title="Landing"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </Head>
  <Transition>
    <div
      v-if="show"
      appear
      class="grid h-screen font-Poppins bg-cover"
      style="background-image: url('/img/landing-bg-day.jpg')"
    >
      <div
        class="py-5 px-5 my-auto w-1/3 bg-white rounded-md h-screen min-w-max"
      >
        <div>
          <img style="width: 50px" src="/img/Logo.png" alt="" />
        </div>
<!-- 
        <form @submit.prevent="form.post('/home')">
          us: <input type="text" v-model="form.user">
          pw: <input type="password" v-model="form.password">
          <button type="submit" :disabled="form.processing">Login</button>
        </form> -->
        
        <div class="text-3xl mb-10 my-10 mx-auto text-center">Welcome!</div>
        <form @submit.prevent="form.post('/home')">
          <div class="grid grid-cols-1 w-2/3 mx-auto">
            <div class="grid grid-cols-1">
              <label class="ml-2" for="username"> Username </label>
              <input
                type="text"
                name="username"
                class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                placeholder="CoolDude2003"
                id="username"
                v-model="form.user"
              />
            </div>
            <div class="grid mx-auto w-full grid-cols-1">
              <label class="ml-2" for="pass"> Password </label>
              <input
                type="password"
                name="password"
                class="form-input h-12 border-violet-600 border-4 mx-auto px-3 py-1 mb-3 w-full rounded-full"
                id="pass"
                placeholder="••••••••••"
                v-model="form.password"
              />
            </div>
            <div class="grid w-full grid-cols-2 w-full">
              <div class="mb-4 min-w-max">
                <input
                  type="checkbox"
                  class="form-checkbox ml-5"
                  id="remember"
                />
                <label for="remember" class="ml-2 mb-4 text-sm">
                  Remember Me
                </label>
              </div>
              <div class="mb-4 text-right text-sm">
                <a href="/test2">
                  <span class="italic"> Forgot Password? </span>
                </a>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-1 w-full mx-auto mb-10">
            <button type="submit" :disabled="form.processing">Login</button>
            <Link
              type="submit"
              :disabled="form.processing"
              as="button"
              class="rounded-full bg-violet-600 h-12 focus:ring focus:ring-violet-300 w-48 mx-auto text-white"
            >
              Login</Link
            >
          </div>
        </form> 
        <hr class="mb-10" />
        <div class="text-center mx-auto mt-3 italic font-thin">
          No account? No worries.
        </div>
        <div class="mx-auto w-full grid">
          <button
            class="mx-auto w-48 hover:bg-violet-600/50 form-input rounded-full"
          >
            Join Now
          </button>
        </div>
      </div>
    </div>
  </Transition>
</template>
