<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import Navigation from "@/Components/Navigation.vue";
import Popop from "@/Components/Popup.vue";
import TaskComponent from "@/Components/TaskComponent.vue";
import NewList from "@/Components/NewList.vue";

// Define the sorting function
const sortListsByPriority = (unSortedLists) => {
  const listsArray = Object.entries(unSortedLists.value);
  listsArray.sort((a, b) => b[1].priority - a[1].priority);
  return Object.fromEntries(listsArray);
};


const page = usePage();
const username = page.props.username;
const name = page.props.name;
const addingList = ref(false);
let lists = ref(JSON.parse(page.props.lists));
var tasksCompleted = 0;



onUpdated(() => {
  lists.value = JSON.parse(page.props.lists);
  if (page.props.lists != "null" && Object.entries(page.props.lists).length > 0) {

    console.log('hello');
    lists = sortListsByPriority(lists);

    Object.entries(lists).forEach((list) => {
      if (list[1].tasks) {
        //if list have no task
        Object.entries(list[1].tasks).forEach((task) => {
          if (task[1].status) {
            tasksCompleted++;
          }
        });
      }
    });

  }

  console.log('hello again');
  console.log(lists);
});
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
    <div class="bg-texture-2 h-fit min-h-screen scroll-smooth">
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

        <div class="flex justify-center">
          <div class="main flex justify-between flex-row mt-10">
            <div>
              <div v-for="(list, listName) in lists" :key="listName">
                <TaskComponent :listName="listName" :color="list.color" :priority="list.priority" :date="list.date"
                  :tasks="list.tasks">
                </TaskComponent>
              </div>
              <Transition
              enter-from-class="opacity-0 delay-400"
              leave-to-class="opacity-0"
              enter-active-class="transition delay-200 duration-300"
              leave-active-class="transition duration-100">
              <button v-if="!addingList" @click="addingList = !addingList"
                class="backdrop-blur w-[40rem] bg-white/10 hover:bg-white/40 group border-dashed border-2 transition-all duration-400 ease-in-out overflow-hidden h-24">
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
              leave-to-class="opacity-0"
              enter-active-class="transition delay-200 duration-300"
              leave-active-class="transition duration-0">
              <div v-if="addingList">
                <NewList @close="addingList = !addingList"> </NewList>
              </div>
              </Transition>

            </div>
            <div>
              <h1></h1>
            </div>
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

export default {
  setup() {
    return {
      Popop,
    };
  },
};
</script>