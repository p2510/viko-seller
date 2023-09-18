<script setup>
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ActionButton from "@/Components/ActionButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
// props
const props=defineProps({
    category: Array|Object,
});
// useForm

const form = useForm({
    name: props.category.name,
    description: props.category.description,
});

const submit = () => {
    form.put(route("category.update",props.category.name));
};
</script>

<template>
    <AppLayout title="Gérer mes catégories">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gérer Mes Catégories / Modifier 
            </h2>
        </template>
        <div class="py-4">
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-14">
                <button></button>
                <div class="max-w-4xl mx-auto gap-12 w-full p-4">
                    
                    <section class="space-y-6">
                       
                        <form
                            @submit.prevent="submit"
                            class="  px-2 py-4 flex flex-col gap-2"
                        >
                            <input
                                required
                                v-model="form.name"
                                type="text"
                                class="rounded-md  outline-2 outline-slate-200"
                                placeholder="Nom de catégorie"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                            <textarea
                                required
                                v-model="form.description"
                                rows="4"
                                placeholder="Description"
                                class="rounded-md  outline-2 outline-slate-200"
                            ></textarea>
                            <InputError
                                class="mt-2"
                                :message="form.errors.description"
                            />
                            <div class="flex justify-center">
                                <PrimaryButton
                                    class="border-none"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    >Modifier</PrimaryButton
                                >
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        
    
    </AppLayout>
</template>
