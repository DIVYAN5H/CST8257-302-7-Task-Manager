<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { ref, onUpdated } from "vue";
import LoginView from '@/Components/LoginView.vue';
import Register from "@/Components/Register.vue";


const page = usePage();
let show = ref(page.props.show);
const props = defineProps( 'errors' );
const errors1 = ref(page.props.errors);
console.log(props.errors);
console.log(errors1);


onUpdated(() => {

  console.log(page.props.show);

});


</script>

<template>
  <Head title="Landing">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </Head>
  <div appear class="grid h-screen font-Poppins bg-texture-3">
    <Transition name="fade" mode="out-in">
      <div class="transform top-0 left-0 w-full fixed overflow-auto ease-in-out transition-all duration-500 z-30"
        :class="show ? 'translate-x-50' : '-translate-x-full'">
        <LoginView @transition="show = !show"></LoginView>
      </div>
    </Transition>
    <Transition name="fade1" mode="out-in">
      <div class="transform top-0 left-0 w-full fixed overflow-auto ease-in-out transition-all duration-500 z-30"
        :class="show ? '-translate-x-full' : 'translate-x-50'">
        <Register :errors="page.props.errors" @transition="show = !show"> </Register>
      </div>
    </Transition>
  </div>
</template>
