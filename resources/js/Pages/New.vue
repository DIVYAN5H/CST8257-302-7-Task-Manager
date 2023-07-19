<script setup>
import { Head } from '@inertiajs/vue3';
</script>
<template>
    <Head title="New" ></Head>
    

    <div class="ml-7 text-4xl m-4">
      <h1>
        Add a New Task
      </h1>
    </div>

    <div class="w-1/2 bg-gray-100 drop-shadow-xl rounded mx-auto">
      <form class="rounded px-8 pt-6 pb-8 mb-4">
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
                <input class="shadow appearance-none border border-purple-500 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text">
              </div>
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                  Priority
                </label>
                <input class="shadow appearance-none border border-purple-500 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" type="text">
              </div>
              <div class="flex items-center justify-between">
                <button class="button bg-purple-400 hover:bg-yellow-300 text-black font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline" type="button">
                  Add
                </button>
              </div>
            </form>
    </div>
</template>