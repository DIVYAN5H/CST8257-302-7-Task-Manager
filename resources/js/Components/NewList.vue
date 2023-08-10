<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import Navigation from "@/Components/Navigation.vue";
import ColourPickComponent from "./ColourPickComponent.vue";

const page = usePage();
const user = page.props.user;
const email = page.props.email
const name = page.props.name;
const password = page.props.password

console.log(password);

function setColour(colour) {
    form.color = colour;
};

const form = useForm({
    list: null,
    color: null,
    priority: null,
    date: null,
});
</script>
<template>
    <form @submit.prevent="form.post('/newList')" class="text-white transition-all">
        <div class="bg-white/20 h-auto w-100 p-4 rounded-t-lg">
            <div class="grid justify-center grid-cols-3 md:grid-cols-3 sm:grid-cols-1 gap-4 mx-4">
                <div class="col-span-2">
                    <label class="block text-sm font-bold my-1" for="title">
                        List Name
                    </label>
                    <input v-model="form.list" name="list"
                        class="rounded rounded-md shadow appearance-none w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="list" type="text" />
                </div>
                <div class="col-span-1">
                    <label class="block  text-sm font-bold my-1" for="description">
                        Priority
                    </label>
                    <select v-model="form.priority" name="priority"
                        class="rounded-md shadow appearance-none w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
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
                        class="rounded-md w-full shadow appearance-none text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="date" />
                </div>
                <div class="col-span-1 group">
                    <label class="block text-sm font-bold mb-2" for="description">
                        Color
                    </label>
                    <div class="relative">
                        <input v-model="form.color" disabled type="color" name="color" id="color"
                            class="rounded-full h-10 z-10 w-full h-2/3 shadow appearance-none text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                        <ColourPickComponent class="opacity-0 scale-0 absolute inset-0 z-0 transition duration-200 group-hover:opacity-100 group-hover:scale-100"
                            @colour="setColour"></ColourPickComponent>
                    </div>

                </div>
                <div class="col-span-1">


                </div>

                <div class="col-span-4">

                    <button @click="$emit('addedNewList')" type="submit" :disabled="form.processing"
                        class="button w-full  rounded-full border mb-2">
                        Add List
                    </button>
                </div>
            </div>



        </div>
    </form>
    <button @click="$emit('close')" class="hover:bg-white/60 rounded-b-lg bg-white/10 w-full transition duration-200"> Cancel </button>


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