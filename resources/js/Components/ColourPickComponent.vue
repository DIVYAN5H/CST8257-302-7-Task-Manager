<script setup>

const white = "#FFFAFF";
const blue = "#8390FA";
const green = "#28a745";
const red = "#CE5374";
const yellow = "#ffc107";
const purple = "#6f42c1";

</script>

<template>
    <div class="flex transition transition-all  duration-200  h-[2.5rem]">
        <div @click="$emit('colour', white)" class=" w-1/6 tmWhite transition transition-all ease-in-out duration-300 hover:w-1/5 group">
            <!--<div class="h-full w-full flex justify-center align-items-center transition transition-all duration-100 delay-100 ease-in group-hover:opacity-100 opacity-0 text-black"> White </div>-->
        </div>
        <div @click="$emit('colour', blue)" class="w-1/6 tmBlue transition transition-all ease-in-out duration-300 hover:w-1/5 group"></div>
        <div @click="$emit('colour', green)" class=" w-1/6 tmGreen transition transition-all ease-in-out duration-300 hover:w-1/5 group"></div>
        <div @click="$emit('colour', yellow)" class="w-1/6 tmYellow transition transition-all ease-in-out duration-300 hover:w-1/5 group"></div>
        <div @click="$emit('colour', red)" class="w-1/6 tmRed transition transition-all ease-in-out duration-300 hover:w-1/5 group"></div>
        <div @click="$emit('colour', purple)" class="w-1/6 tmPurple transition transition-all ease-in-out duration-300 hover:w-1/5 group"></div>
    </div>
</template>