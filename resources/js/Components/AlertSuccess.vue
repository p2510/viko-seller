<template>
    <div
        class="flex justify-between py-4 px-8 bg-[#98f5e1] text-[#236c5b]"
        v-if="visibiliy"
    >
        <p class="font-sans"><slot /></p>
        <button class="font-bold" @click="hidden">&#10005;</button>
    </div>
</template>
<script setup>
import { ref } from "vue";
let visibiliy = ref(true);
let hidden = () => (visibiliy.value = false);
</script>
