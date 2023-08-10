<script setup>

const white = "#ffffff";
const blue = "#007bff";
const green = "#28a745";
const red = "#dc3545";
const yellow = "#ffc107";
const purple = "#6f42c1";

</script>

<template>
    <div class="grid grid-cols-6 w-1/3 h-[3rem]">
        <div @click="$emit('colour', white)" class="col-span-1 tmWhite"></div>
        <div @click="$emit('colour', blue)" class="col-span-1 tmBlue"></div>
        <div @click="$emit('colour', green)" class="col-span-1 tmGreen"></div>
        <div @click="$emit('colour', yellow)" class="col-span-1 tmYellow"></div>
        <div @click="$emit('colour', red)" class="col-span-1 tmRed"></div>
        <div @click="$emit('colour', purple)" class="col-span-1 tmPurple"></div>
    </div>
</template>