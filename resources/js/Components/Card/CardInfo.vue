<script setup>
defineProps({
    title: {
        type: String,
        require: true,
    },
    icon: {
        type: Object,
        require: true,
    },
});
</script>

<template>
    <div class="rounded-lg p-2 text-white">
        <p class="flex items-center gap-2">
            <component :is="icon" class="p-2"></component>
            <span class="text-semibold">{{ title }}</span>
        </p>
        <p class="p-4 flex justify-center text-3xl font-bold">
            <slot />
        </p>
    </div>
</template>
