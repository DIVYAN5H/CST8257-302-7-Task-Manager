<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import Navigation from "@/Components/Navigation.vue";
import Popop from "@/Components/Popup.vue";
import TaskComponent from "@/Components/TaskComponent.vue";

// Define the sorting function
const sortListsByPriority = (unSortedLists) => {
  const listsArray = Object.entries(unSortedLists.value);
  listsArray.sort((a, b) => b[1].priority - a[1].priority);
  return Object.fromEntries(listsArray);
};


const page = usePage();
const username = page.props.username;
const name = page.props.name;
let lists = ref(JSON.parse(page.props.lists));
var tasksCompleted = 0;



onUpdated(() => {
  lists.value = JSON.parse(page.props.lists);
  if (page.props.lists != "null" && Object.entries(page.props.lists).length > 0) {
  lists = ref(JSON.parse(page.props.lists));
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
        <Navigation
          :username="username"
          :name="name"
          :email="page.props.email"
          :tasksCompleted="tasksCompleted"
        ></Navigation>


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
                <TaskComponent
                  :listName="listName"
                  :color="list.color"
                  :priority="list.priority"
                  :date="list.date"
                  :tasks="list.tasks"
                >
                </TaskComponent>
              </div>
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