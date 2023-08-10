<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import Navigation from "@/Components/Navigation.vue";

const page = usePage();
const user = page.props.user;
const email = page.props.email
const name = page.props.name;
const password = page.props.password

console.log(password);


const form = useForm({
    list: null,
    color: null,
    priority: null,
    date: null,
});
</script>
<template>
    <form @submit.prevent="form.post('/newList')" class="text-white transition-all">
        <div class="bg-white/20 h-auto w-100 p-4 rounded-lg">
            <div class="grid justify-center grid-cols-3 md:grid-cols-3 sm:grid-cols-1 gap-4 mx-4">
                <div class="col-span-2">
                    <label class="block text-sm font-bold my-1" for="title">
                        List Name
                    </label>
                    <input v-model="form.list" name="list"
                        class="rounded-full shadow appearance-none w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="list" type="text" />
                </div>
                <div class="col-span-1">
                    <label class="block  text-sm font-bold my-1" for="description">
                        Priority
                    </label>
                    <select v-model="form.priority" name="priority"
                        class="rounded-full shadow appearance-none w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="priority">
                        <option value="1">Low</option>
                        <option selected value="2">Medium</option>
                        <option value="3">High</option>
                    </select>
                </div>
                <div class="col-span-2">

                    <label class="block text-sm font-bold mb-2" for="description">
                        Due Date
                    </label>
                    <input type="date" v-model="form.date" name="date" placeholder="dd-mm-yy"
                    class="rounded-full w-full shadow appearance-none text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="date" />
                </div>
                <div class="col-span-1">
                    <label class="block  text-sm font-bold mb-2" for="description">
                        Color
                    </label>
                    <input v-model="form.color" type="color" name="color" id="color"
                  
                    class="rounded-full h-9 p-1 w-full h-2/3 shadow appearance-none text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </div>
                <div class="col-span-1">

                    <button @click="$emit('close')" class="button w-full  rounded-full border"> Close </button>
                </div>
                <div class="col-span-2">
                    
                    <button @click="$emit('addedNewList')" type="submit" :disabled="form.processing" class="button w-full  rounded-full border mb-2">
                    Add List
                </button>
            </div>
        </div>

        
    </div>
    </form>


    <!--







        <div class="mb-6">
            <label class="block  text-sm font-bold mb-2" for="title">
                List Name
            </label>
            <input v-model="form.list" name="list"
                class="shadow appearance-none border border-purple-500 rounded-full w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="list" type="text" />
        </div>


        <div class="mb-6 flex justify-start">
            <div>

                <label class="block  text-sm font-bold mb-2" for="description">
                    Priority
                </label>
                <select v-model="form.priority" name="priority"
                    class=" shadow appearance-none w-44 border border-purple-500 rounded-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="priority">
                    <option value="1">Low</option>
                    <option selected value="2">Medium</option>
                    <option value="3">High</option>
                </select>
            </div>
            <div>

                <label class="block ml-10  text-sm font-bold mb-2" for="description">
                    Due Date
                </label>
                <input type="date" v-model="form.date" name="date" placeholder="dd-mm-yy"
                    class="w-full shadow appearance-none ml-10 border border-purple-500 rounded-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="date" />
            </div>



        </div>



        <div class="mb-8">
            <label class="block  text-sm font-bold mb-2" for="description">
                Color
            </label>
            <input v-model="form.color" type="color" name="color" id="color"
                style="border-radius: 15px; resize: none; scrollbar-width: none"
                class="colorstyle shadow p-1 w-44 appearance-none border border-purple-500 rounded-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>

        <div class="flex items-center justify-center">
            <button type="submit" :disabled="form.processing" class="button py-2 px-4 w-1/3 rounded-full border">
                Add List
            </button>
        </div>
    </form>
-->
</template>