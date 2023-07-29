<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import { useForm } from '@inertiajs/vue3';
import LoginView from '@/Components/LoginView.vue'

const show = ref(true);

const page = usePage();
const users = page.props.user;

console.log(users);

const form = useForm({
  user: null,
  password: null,
})
</script>

<template>
  <Head title="Landing">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </Head>
  <Transition>
    <div v-if="show" appear class="grid h-screen font-Poppins bg-texture-3">
      <LoginView></LoginView>
    </div>
  </Transition>
</template>
