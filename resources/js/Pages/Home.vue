<script setup>
import { Head } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
</script>
<template>
    <Head title="Home">
    </Head>
    <div class="h-screen bg-cover" style="background-image: url('/img/purple nature bg.jpg');">
      <div class="w-full">
        <Navigation></Navigation>
      </div>
    </div>
</template>