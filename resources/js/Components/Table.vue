<template>
    <div class="relative overflow-x-auto rounded-lg shadow-lg w-full bg-white  ">
        <p class="p-4 bg-white flex justify-between w-full  ">
            <span class="text-xl font-semibold text-slate-800">{{
                title
            }}</span>
             <slot name="button" />
           
        </p>
        <table
            class=" w-full table-auto text-sm text-left text-gray-500 shadow-lg"
        >
            <thead
                class="text-xs text-slate-700 text-opacity-60 font-bold uppercase  bg-white border-b-2 "
            >
                <tr>
                    <th scope="col" class="px-6 py-3" v-for="(head , index) in datahead" :key="index">{{head}}</th>
                </tr>
            </thead>
            <tbody>
                <slot name="tbody" />
            </tbody>
        </table>
    </div>
</template>

<script setup>
defineProps({
    title: {
        type: String,
        require: true,
    },
    datahead:{
        type: Array,
        require: true,
    }
});
</script>
