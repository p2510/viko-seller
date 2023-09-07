<template>
    <div class="flex w-full gap-x-4">
        <Link
            :href="props.updatelink"
            class="bg-slate-800 text-white p-2 rounded-lg hover:bg-slate-700 transition ease-in-out duration-300"
        >
            Modifier
        </Link>
        <button
            @click="deleteData"
            class="bg-red-800 text-white p-2 rounded-lg hover:bg-red-700 transition ease-in-out duration-300"
        >
            Supprimer
        </button>
    </div>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    updatelink: {
        type: String,
        require:true,
    },
    deletelink: {
        type: String,
        require:true,

    },
    deleteid: {
        type: String,
        require:true,

    },

});

let form = useForm({});

const deleteData = () => {
    form.delete(route(props.deletelink, props.deleteid));

    //form.delete(route("category.destroy", deletelink));
};
</script>

<style></style>
