<script setup>
import { Head } from '@inertiajs/vue3';
import Navigation from '@/Components/Navigation.vue';
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <Head title="New" ></Head>
    
    <div class="flex justify-start flex-col items-center h-screen bg-cover" style="background-image: url('/img/purple nature bg.jpg');">
      <div class="w-full">
        <Navigation></Navigation>
      </div>
    <div class="text-4xl text-white py-10">
      <h1>
        Add a New Task
      </h1>
    </div>

    <div class="w-2/5 backdrop-blur-lg bg-white/30 drop-shadow-xl rounded-lg new-box-border">
      <form action="{{ url('addTest') }}" method="POST" class=" px-8 pt-6 pb-8">
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                  List Name
                </label>
                <input name="list" class="shadow appearance-none border border-purple-500 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text">
              </div>
              
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                  Task
                </label>
                <input name="task" id="description" cols="30" rows="2" style="border-radius: 15px; resize: none;scrollbar-width: none ;" class="shadow appearance-none border border-purple-500 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">             
              </div>
              

              <!--<div class="mb-6 flex justify-start">
                

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
             </div>-->

             <div class="mb-6">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Priority
                  </label>
                  <select name="priority" class="shadow appearance-none border border-purple-500 rounded-full w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="priority">
                    <option value="0">Select</option>
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                  </select>
                </div>

              <div class="flex items-center justify-between">
                
                <Link @click="show = !show" as="button" type="button" class="button py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                  Add Task
                </Link>
                
              </div>
            </form>
    </div>
  </div>
</template>