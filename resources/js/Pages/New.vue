<script setup>
import { Head } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
</script>
<template>
    <Head title="New" ></Head>
    
    <div class="flex justify-start flex-col items-center h-screen bg-cover" style="background-image: url('/img/landing-bg-day.jpg');">
      <div class="w-full">
        <Navigation></Navigation>
      </div>
    <div class="text-4xl text-white py-10">
      <h1>
        Add a New Task
      </h1>
    </div>

    <div style="border: 1px solid rgb(184, 184, 184);" class="w-2/5 backdrop-blur-lg bg-white/30 drop-shadow-xl rounded-lg ">
      <form class=" px-8 pt-6 pb-8">
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                  Title
                </label>
                <input class="shadow appearance-none border border-purple-500 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text">
              </div>
              
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                  Description
                </label>
                <textarea name="des" id="description" cols="30" rows="2" style="border-radius: 15px; resize: none;scrollbar-width: none ;" class="shadow appearance-none border border-purple-500 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                </textarea>               
              </div>

              <div class="mb-6 flex justify-start">
                

                <div>
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                      Start date
                  </label>
                  <input type="date" class="shadow appearance-none border border-purple-500 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start date">
                </div>

                <div class="pl-8">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                      Due date
                  </label>
                  <input type="date" class="shadow appearance-none border border-purple-500 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="start date">
                </div>
             </div>

             <div class="mb-6">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Priority
                  </label>
                  <select class="shadow appearance-none border border-purple-500 rounded-full w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="priority">
                    <option value="0">Select</option>
                    <option value="low">Low</option>
                    <option value="mid">Medium</option>
                    <option value="high">High</option>
                  </select>
                </div>

              <div class="flex items-center justify-between">
                <button class="button py-2 px-4 rounded-full focus:outline-none focus:shadow-outline" type="button">
                  Add Task
                </button>
              </div>
            </form>
    </div>
  </div>
</template>