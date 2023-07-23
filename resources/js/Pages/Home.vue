<script setup>
import { Head } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
</script>

<style>
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
/*::-webkit-scrollbar-track {
  border: 1px solid rgb(184, 184, 184);
  border-radius: 10px;
  opacity: 0.5;
}*/
::-webkit-scrollbar-track {
  /*box-shadow: inset 0 0 0 2px rgb(184, 184, 184);  Creates a single-line appearance */
  background-color: transparent;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: white;
  border-radius: 10px;
  
}
</style>

<template>
    <Head title="Home">
    </Head>
    <div class="h-screen bg-cover" style="background-image: url('/img/landing-bg-day.jpg');">
      <div class="w-full">
        <Navigation></Navigation>

        <div class=" flex justify-center mt-10">
          <h1 class="text-2xl text-white">
            Welcome to your dashboard.
          </h1>
          <br>
          
        </div>
        <div  class="text-white flex justify-center">
            <p>You can manage your tasks here based on their priority</p>
          </div>

        <div class="text-2xl text-white main flex justify-between flex-row mx-56 mt-10">
            <div>
              <h1>Low</h1>
            </div>
            <div>
                <h1>Medium</h1>
            </div>
            <div>
              <h1>High</h1>
            </div>
        </div>

        <div class="main flex justify-evenly flex-row mx-5 mt-5 h-[24rem]">

          <div style="overflow: hidden; overflow-y: scroll;" class=" w-80">
            
              <div style="border: 1px solid rgb(184, 184, 184);" class="backdrop-blur bg-white/30 rounded p-2 mx-2 my-4">
                  <h1>task</h1>
                  <p>Description</p>
                  <p>Priority</p>
              </div>
              <div style="border: 1px solid rgb(184, 184, 184);" class="backdrop-blur bg-white/30 rounded p-2 mx-2 my-4">
                  <h1>task</h1>
                  <p>Description</p>
                  <p>Priority</p>
              </div>
              <div style="border: 1px solid rgb(184, 184, 184);" class="backdrop-blur bg-white/30 rounded p-2 mx-2 my-4">
                  <h1>task</h1>
                  <p>Description</p>
                  <p>Priority</p>
              </div>
              <div style="border: 1px solid rgb(184, 184, 184);" class="backdrop-blur bg-white/30 rounded p-2 mx-2 my-4">
                  <h1>task</h1>
                  <p>Description</p>
                  <p>Priority</p>
              </div>
              
              
          </div>

          <div style="overflow: hidden; overflow-y: scroll;" class=" w-80">
          
            <div style="border: 1px solid rgb(184, 184, 184);" class="backdrop-blur bg-white/30 rounded p-2 mx-2 my-4">
                  <h1>task</h1>
                  <p>Description</p>
                  <p>Priority</p>

              </div>
              <div style="border: 1px solid rgb(184, 184, 184);" class="backdrop-blur bg-white/30 rounded p-2 mx-2 my-4">
                  <h1>task</h1>
                  <p>Description</p>
                  <p>Priority</p>
              </div>
              
              
          </div>

          <div style="overflow: hidden; overflow-y: scroll;" class=" w-80">
            
            <div style="border: 1px solid rgb(184, 184, 184);" class="backdrop-blur bg-white/30 rounded p-2 mx-2 my-4">
                  <h1>task</h1>
                  <p>Description</p>
                  <p>Priorty</p>

              </div>
              <div style="border: 1px solid rgb(184, 184, 184);" class="backdrop-blur bg-white/30 rounded p-2 mx-2 my-4">
                  <h1>task</h1>
                  <p>Description</p>
                  <p>Priority</p>
              </div>
              
              
              
              
          </div>

        </div>
      </div>
    </div>
</template>