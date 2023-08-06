<script setup>
import { Head, usePage, router } from '@inertiajs/vue3';
import { ref, reactive, onUnmounted } from 'vue';
import Navigation from '@/Components/Navigation.vue';
import Popop from '@/Components/Popup.vue';
import TaskComponent from '@/Components/TaskComponent.vue';

const showPopup = ref(false);
const show = ref(false);

const page = usePage();
const users = page.props.user;
const name = page.props.name;

let lists = ref(JSON.parse(page.props.lists));

const props = defineProps(['lists'])

onUpdated(() => lists.value = JSON.parse(page.props.lists));

// Define the sorting function
const sortListsByPriority = () => {
  const listsArray = Object.entries(lists.value);
  listsArray.sort((a, b) => b[1].priority - a[1].priority);
  lists.value = Object.fromEntries(listsArray);
};

onUpdated(() => {
  sortListsByPriority();
});

sortListsByPriority();
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
  <Head title="Home">
  </Head>
  <Transition>
    <div class="bg-texture-2 h-fit min-h-screen scroll-smooth">
      <div class="w-full">
        <Navigation :username="users" :name="name" :email="page.props.email"></Navigation>




        <!--This is a popup that will show up when a user clicks a task so tehy can add more subtasks???-->

        <!-- <div v-if="showPopup" class="popup">
          <Popup class="popup-box box-borders" v-if="showPopup">
            <h1 class="text-xl">The task opened!</h1>

            <ul>
              <li class="my-3">
                <div class="flex items-center pl-4 border border-gray-200 rounded-full ">
                  <input id="bordered-checkbox-2" type="checkbox" value="" name="bordered-checkbox"
                    class="w-4 h-4 text-blue-600 bg-blue rounded ">
                  <label for="bordered-checkbox-2" class="w-full py-2 text-sm font-medium text-white">Lorem ipsum dolor
                    sit
                    amet consectet</label>
                </div>
              </li>
              <li class="my-3">
                <div class="flex items-center pl-4 border border-gray-200 rounded-full ">
                  <input id="bordered-checkbox-2" type="checkbox" value="" name="bordered-checkbox"
                    class="w-4 h-4 text-blue-600 bg-blue rounded ">
                  <label for="bordered-checkbox-2" class="w-full py-2 text-sm font-medium text-white">Lorem ipsum dolor
                    sit
                    amet consectetur a</label>
                </div>
              </li>
              <li class="my-3">
                <div class="flex items-center pl-4 border border-gray-200 rounded-full ">
                  <input id="bordered-checkbox-2" type="checkbox" value="" name="bordered-checkbox"
                    class="w-4 h-4 text-blue-600 bg-blue rounded ">
                  <label for="bordered-checkbox-2" class="w-full py-2 text-sm font-medium text-white">Lorem ipsum dolor
                    sit
                    amet consec</label>
                </div>
              </li>
            </ul>

            <button class="button py-2 px-4 mr-2 rounded-full focus:outline-none focus:shadow-outline">
              +
            </button>

            <button @click="showPopup = false"
              class="button py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
              Close
            </button>

          </Popup>
        </div> -->

        <!--------------------------------------------------------------------------------->


        <div class=" flex justify-center mt-10">
          <h1 class="text-2xl text-white">
            Welcome to your dashboard, {{ $page.props.name }}.
          </h1>
          <br>

        </div>

        <div class="text-white flex justify-center">
          <p>You can manage your tasks here based on their priority </p>
        </div>

        <div class="flex justify-center">
          <div class="main flex justify-between flex-row mt-10">

            <div>
              <div v-for="(list, listName) in lists" :key="listName">
                  <TaskComponent :listName="listName" :color="list.color" :priority="list.priority" :date="list.date" :body="list.tasks"> </TaskComponent>
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

import { ref } from 'vue';
import { onMounted } from 'vue';
import { onUnmounted } from 'vue';
import { onUpdated } from 'vue';


export default {
  setup() {

    return {
      Popop
    }
  }
}
</script>