<script setup>

defineProps(['username']);

</script>

<template>
    <div class="h-screen text-white w-full bg-texture-1">
        <div class="grid-cols-1 mx-auto w-full h-full py-16">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-48 h-48 mx-auto border-4 rounded-full p-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
            <div class="mx-auto text-center text-2xl w-full pt-4">
                {{ username }}
            </div>
            <div class="text-center text-sm">
                0 Tasks Completed
            </div>
            <div id="userInfoSection">
                <div class="grid-cols-1 text-lg w-1/2 mx-auto py-16">
                    <div> Email:  </div>
                    <div> Username: </div>
                    <div> c </div>
                </div>
            </div>
        </div>

    </div>
</template>