<script setup>
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ActionButton from "@/Components/ActionButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import AlertSuccess from "@/Components/AlertSuccess.vue";
import AlertWarning from "@/Components/AlertWarning.vue";
import NotResult from  "@/Components/NotResult.vue";
let dataThead = ["Nom", "Crée le ", "Mise à jour le ", "Action"];
// props
defineProps({
    categories: Array,
});
// useForm

const form = useForm({
    name: "",
    description: "",
});

const submit = () => {
    form.post(route("category.store"));
};
</script>

<template>
    <AppLayout title="Gérer mes catégories">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gérer Mes Catégories
            </h2>
        </template>
        <div class="py-4">
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-14">
                <div class="max-w-4xl mx-auto gap-12 w-full p-4">
                    <section class="space-y-6">
                        <AlertSuccess v-if="$page.props.flash.message">
                            {{ $page.props.flash.message }}
                        </AlertSuccess>
                        <AlertWarning v-if="$page.props.flash.update">
                            {{ $page.props.flash.update }}
                        </AlertWarning>
                        <form
                            @submit.prevent="submit"
                            class="px-2 py-4 flex flex-col gap-2"
                        >
                            <input
                                required
                                v-model="form.name"
                                type="text"
                                class="rounded-md outline-2 outline-slate-200"
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
                                class="rounded-md outline-2 outline-slate-200"
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
                                    >Enregistrer</PrimaryButton
                                >
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <div class="py-1">
            <div
                class="md:max-w-6xl lg:max-w-9xl md:mx-auto w-full sm:px-6 lg:px-14"
            >
                <div class="grid grid-cols-4 gap-12 p-4">
                    <section class="col-span-full space-y-6 w-full">
                        <!--table oder-->
                        <Table v-if="categories.length!==0"
                            title="Liste de mes catégories"
                            :datahead="dataThead"
                            class="w-full table-auto"
                        >
                            <template #button>
                                <Link
                                    :href="route('category.index')"
                                    class="bg-slate-800 text-white p-2 rounded-lg hover:bg-slate-700 transition ease-in-out duration-300"
                                >
                                    Exporter
                                </Link>
                            </template>
                            <template #tbody>
                                <tr
                                    v-for="(category, index) in categories"
                                    :key="index"
                                    class="bg-white dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ category.name }}
                                    </th>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ category.created_at }}
                                    </td>
                                    <td
                                        v-if="category.updated_at"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ category.updated_at }}
                                    </td>
                                    <td
                                        v-else
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ category.created_at }}
                                    </td>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                    >
                                        <ActionButton
                                            deletelink="category.destroy"
                                            :deleteid="category.name"
                                            :updatelink="
                                                route(
                                                    'category.edit',
                                                    category.name
                                                )
                                            "
                                        />
                                    </td>
                                </tr>
                            </template>
                        </Table>
                        <NotResult 
                        v-else
                            >Nous n'avez pas encore de catégories enregistrées </NotResult
                        >
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
