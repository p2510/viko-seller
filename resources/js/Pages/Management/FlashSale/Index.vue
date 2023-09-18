<script setup>
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ActionButton from "@/Components/ActionButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import AlertSuccess from "@/Components/AlertSuccess.vue";
import AlertWarning from "@/Components/AlertWarning.vue";
import NotResult from "@/Components/NotResult.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
let dataThead = ["Titre", "Date début ", "Date de fin", "Action"];
// props
defineProps({
    data: Array,
});
// useForm

const form = useForm({
    title: "",
    start_at: "",
    end_at: "",
});

const submit = () => {
    form.post(route("flashsale.store"));
};
</script>

<template>
    <AppLayout title="Gérer mes ventes flash">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gérer Mes Ventes Flash
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
                            class="px-2 py-4 grid grid-cols-12 gap-2"
                        >
                            <div class="col-span-full sm:col-span-2">
                                <InputLabel
                                    for="title"
                                    value="Quel est titre de la vente flash ?"
                                />
                                <TextInput
                                    id="title"
                                    v-model="form.title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.title"
                                />
                            </div>
                            <div class="col-span-full sm:col-span-6">
                                <InputLabel
                                    for="start_at"
                                    value="La date de début "
                                />
                                <TextInput
                                    id="start_at"
                                    v-model="form.start_at"
                                    type='datetime-local'
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.start_at"
                                />
                            </div>
                            <div class="col-span-full sm:col-span-6">
                                <InputLabel
                                    for="end_at"
                                    value="La date de fin"
                                />
                                <TextInput
                                    id="end_at"
                                    v-model="form.end_at"
                                    type="datetime-local"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.end_at"
                                />
                            </div>
                            <div
                                class="col-span-full flex w-full items-center justify-center mt-4"
                            >
                                <PrimaryButton
                                
                                    :class="{
                                        'opacity-25': form.processing,
                                    }"
                                    :disabled="form.processing"
                                >
                                    Enregistrer
                                </PrimaryButton>
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
                        <Table
                            v-if="data.length !== 0"
                            title="Liste de mes catégories"
                            :datahead="dataThead"
                            class="w-full table-auto"
                        >
                            <template #button>
                                <Link
                                    :href="route('flashsale.index')"
                                    class="bg-slate-800 text-white p-2 rounded-lg hover:bg-slate-700 transition ease-in-out duration-300"
                                >
                                    Exporter
                                </Link>
                            </template>
                            <template #tbody>
                                <tr
                                    v-for="(item, index) in data"
                                    :key="index"
                                    class="bg-white dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{item.title}}
                                    </th>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ item.start_at }}
                                    </td>
                                    
                                    <td
                                        
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ item.end_at}}
                                    </td>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                    >
                                        <ActionButton
                                            deletelink="category.destroy"
                                            :deleteid="item.id"
                                            :updatelink="
                                                route(
                                                    'category.edit',
                                                    item.id
                                                )
                                            "
                                        />
                                    </td>
                                </tr>
                            </template>
                        </Table>
                        <NotResult v-else
                            >Nous n'avez pas encore de ventes flash enregistrées
                        </NotResult>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
