<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import Navigation from '@/Components/Navigation.vue';
import Popop from '@/Components/Popup.vue';
import TaskComponent from '@/Components/TaskComponent.vue';

const showPopup = ref(false);
const show = ref(true);

const page = usePage();
const users = page.props.user;
const name = page.props.name;
const tasks = JSON.parse(page.props.tasks);

console.log(name);
console.log(tasks);
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
  <Transition>
    <div class="h-screen bg-texture-2">
      <div class="w-full">
      <Navigation :username = name></Navigation>




      <!--This is a popup that will show up when a user clicks a task so tehy can add more subtasks???-->

      <div v-if="showPopup" class="popup">
        <Popup class="popup-box box-borders" v-if="showPopup">
          <h1 class="text-xl">The task opened!</h1>

          <ul>
            <li class="my-3">
              <div class="flex items-center pl-4 border border-gray-200 rounded-full ">
                <input id="bordered-checkbox-2" type="checkbox" value="" name="bordered-checkbox"
                  class="w-4 h-4 text-blue-600 bg-blue rounded ">
                <label for="bordered-checkbox-2" class="w-full py-2 text-sm font-medium text-white">Lorem ipsum dolor sit
                  amet consectet</label>
              </div>
            </li>
            <li class="my-3">
              <div class="flex items-center pl-4 border border-gray-200 rounded-full ">
                <input id="bordered-checkbox-2" type="checkbox" value="" name="bordered-checkbox"
                  class="w-4 h-4 text-blue-600 bg-blue rounded ">
                <label for="bordered-checkbox-2" class="w-full py-2 text-sm font-medium text-white">Lorem ipsum dolor sit
                  amet consectetur a</label>
              </div>
            </li>
            <li class="my-3">
              <div class="flex items-center pl-4 border border-gray-200 rounded-full ">
                <input id="bordered-checkbox-2" type="checkbox" value="" name="bordered-checkbox"
                  class="w-4 h-4 text-blue-600 bg-blue rounded ">
                <label for="bordered-checkbox-2" class="w-full py-2 text-sm font-medium text-white">Lorem ipsum dolor sit
                  amet consec</label>
              </div>
            </li>
          </ul>

          <button class="button py-2 px-4 mr-2 rounded-full focus:outline-none focus:shadow-outline">
            +
          </button>

          <button @click="showPopup = false" class="button py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
            Close
          </button>

        </Popup>
      </div>

      <!--------------------------------------------------------------------------------->


      <div class=" flex justify-center mt-10">
        <h1 class="text-2xl text-white">
          Welcome to your dashboard, {{ $page.props.name }}.
        </h1>
        <br>

      </div>

      <div class="text-white flex justify-center">
        <p>You can manage your tasks here based on their priority</p>
      </div>

      <div class="main flex justify-between flex-row mx-56 mt-10">

        <div>
          <div v-for="(list, listName) in tasks" :key="listName">
            <div v-for="(task, taskId) in list" :key="taskId">
              <ul>
                <TaskComponent :title=listName :body=task.task> </TaskComponent>
              </ul>
            </div>

          </div>

        </div>
        <div>
          <h1>AAAA</h1>
        </div>
      </div>

      <div class="main text-white flex justify-evenly flex-row mx-5 mt-5 h-[24rem]">


        <div id="low" style="overflow: hidden; overflow-y: scroll;" class=" w-80">
          <!--<Link @click="show = true" as="button" type="div"
            class="backdrop-blur w-[18.8rem] bg-white/30 rounded p-2 mx-2 my-4 box-borders">
          Task Number 1
          </Link>-->
          <button @click="showPopup = true"
            class="backdrop-blur w-[18.8rem] bg-white/30 rounded p-2 mx-2 my-4 box-borders high-box">
            Task 2
          </button>
        </div>


        <div id="mid" style="overflow: hidden; overflow-y: scroll;" class=" w-80">
          <!--<Link @click="show = true" as="button" type="div"
            class="backdrop-blur w-[18.8rem] bg-white/30 rounded p-2 mx-2 my-4 box-borders">
          Task Number 1
          </Link>-->
          <button @click="showPopup = true"
            class="backdrop-blur w-[18.8rem] bg-white/30 rounded p-2 mx-2 my-4 box-borders mid-box">
            Task 2
          </button>
        </div>


        <div id="high" style="overflow: hidden; overflow-y: scroll;" class=" w-80">

          <!--<Link @click="show = true" as="button" type="div"
            class="backdrop-blur w-[18.8rem] bg-white/30 rounded p-2 mx-2 my-4 box-borders">

          Task Number 1
          </Link>-->
          <button @click="showPopup = true"
            class="backdrop-blur w-[18.8rem] bg-white/30 rounded p-2 mx-2 my-4 box-borders low-box">
            Task 2
          </button>



        </div>



      </div>
      </div>
  </div>
  </Transition>

</template>

<script>

import { ref } from 'vue';

export default {
  setup() {

    return {
      Popop
    }
  }
}
</script>