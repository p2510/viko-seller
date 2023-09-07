<template>
    <div class="flex flex-col items-center justify-center ">
        <NotResultIcon class="w-48 h-48 sm:w-96 sm:h-96" />
        <p class="">
            <slot></slot>
            <span>😢</span>
        </p>
    </div>
</template>

<script setup>
import NotResultIcon from "@/Components/Icon/NotResultIcon.vue";
</script>
