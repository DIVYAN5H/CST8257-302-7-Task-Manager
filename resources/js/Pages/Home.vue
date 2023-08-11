<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import Navigation from "@/Components/Navigation.vue";
import Popop from "@/Components/Popup.vue";
import TaskComponent from "@/Components/TaskComponent.vue";
import NewList from "@/Components/NewList.vue";

const page = usePage();
const username = ref(page.props.username);
let name = ref(page.props.name);
const addingList = ref(false);
let lists = ref(JSON.parse(page.props.lists));
//var tasksCompleted = getCompletedTasks(page.props.lists);
var tasksCompleted = ref(page.props.completedTasks);


function sortListsByPriority() {

  if(true) {
  var object = JSON.parse(page.props.lists);
  if(object != null) {
  var key = Object.entries(object);
  key.sort((a, b) => b[1].priority - a[1].priority);
  //return Object.fromEntries(key);
  lists.value = Object.fromEntries(key);
  }
  else{
    return [];
  }
}
}

function sortListsByName() {
  var object = JSON.parse(page.props.lists);
  if(object != null) {
  var key = Object.entries(object);
  key.sort((a, b) => a[1] - (b[1]));
  //return Object.fromEntries(key);
  lists.value = Object.fromEntries(key);
  }
}

onUpdated(() => {
  console.log('onUpdated')
  lists.value = JSON.parse(page.props.lists);
  //lists.value = sortListsByPriority(page.props.lists);
  tasksCompleted = ref(page.props.completedTasks);
  name.value = page.props.name;
});

onMounted(() => {
  sortListsByPriority(page.props.lists);});
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
  /* Creates a single-line appearance */
  box-shadow: inset 0 0 0 2px rgb(184, 184, 184);
  background-color: transparent;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: rgb(141, 141, 141);
  border-radius: 10px;
}
</style>

<template>
  <Head title="Home"> </Head>
  <Transition>
    <div class="bg-texture-6 h-fit min-h-screen scroll-smooth">
      <div class="w-full">
        <Navigation :username="username" :name="name" :email="page.props.email" :tasksCompleted="tasksCompleted">
        </Navigation>
        
        <div class="flex justify-center mt-10">
          <h1 class="text-2xl text-white">
            Welcome to your dashboard, {{ $page.props.name }}.
          </h1>
          <br />
        </div>

        <div class="text-white flex justify-center">
          <p>You can manage your tasks here based on their priority</p>
        </div>
        
        <div class=" transition transition-all duration-200 w-100 justify-center md:ml-10 lg:ml-10 md:justify-start lg:justify-start flex text-white">
          
          <button @click="sortListsByName" class="button py-2 px-4  rounded-full border m-2"> By Name </button>
          <button @click="sortListsByPriority" class="button py-2 px-4  rounded-full border m-2"> By Priority </button>
        </div>
        <div class="flex w-full grow justify-center px-10 mt-5">
          <div class="grid grow w-100 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1  gap-4">
            <div  v-for="(list, listName) in lists" :key="listName">
              <TaskComponent :listName="listName" :color="list.color" :priority="list.priority" :date="list.date"
              :tasks="list.tasks">
            </TaskComponent>
            </div>
            <Transition enter-from-class="opacity-0 delay-500 duration-300" leave-to-class="opacity-0"
              enter-active-class="transition delay-200 duration-300" leave-active-class="transition duration-100">
              <button v-if="!addingList" @click="addingList = !addingList"
                class="rounded-lg backdrop-blur w-100 bg-white/10 hover:bg-white/40 hover:border-solid group border-dashed border-2 transition-all duration-400 ease-in-out overflow-hidden h-24">
                <div class="w-full h-full grid justify-items-center content-center">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="white"
                    class="transtion-all duration-200 border-white/20 ease-out w-8 h-8 group-hover:h-16 group-hover:w-16">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg>
                </div>
              </button>
            </Transition>
            <Transition 
              enter-from-class="opacity-0 delay-400" 
              leave-to-class="opacity-0 translate-x-full"
              enter-active-class="transition delay-200 duration-300" 
              leave-active-class="transition duration-100">
              <div v-if="addingList" >
                <NewList @close="addingList = !addingList" @addedNewList="addingList = !addingList"> </NewList>
              </div>
            </Transition>

          </div>
          <div>
            <h1></h1>
          </div>

        </div>
      </div>
    </div>
  </Transition>
</template>

<script>
import { ref } from "vue";
import { onMounted } from "vue";
import { onUnmounted } from "vue";
import { onUpdated } from "vue";
import { onBeforeMount } from "vue";

export default {
  setup() {
    return {
      Popop,
    };
  },
};
</script>