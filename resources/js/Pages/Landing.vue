<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import { useForm } from '@inertiajs/vue3';
import LoginView from '@/Components/LoginView.vue';
import Register from "@/Components/Register.vue";

const show = ref(true);

const page = usePage();
const users = page.props.user;

console.log(show);

</script>

<template>
  <Head title="Landing">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </Head>
    <div appear class="grid h-screen font-Poppins bg-texture-3">
      <Transition>
        <div v-if="show == true">
          <LoginView @transition="show = !show"></LoginView>
        </div>
      </Transition>
      <Transition>
        <div v-if="show == false"> 
          <Register> </Register>  
        </div>
      </Transition>
    </div>
</template>
