<script setup>
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ActionButton from "@/Components/ActionButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import AlertSuccess from "@/Components/AlertSuccess.vue";
import AlertWarning from "@/Components/AlertWarning.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import NotResult from "@/Components/NotResult.vue";
import RequireBefore from "@/Components/RequireBefore.vue";
import { Switch } from "@headlessui/vue";
import Uploader from "vue-media-upload";
// props
const props = defineProps({
    categories: Array,
});
// useForm
const form = useForm({
    name: "",
    price: "",
    sale_price: "",
    brand: "",
    category_id: "",
    quantity: "",
    description: "",
    on_sale: false,
    media: [],
});

let changeMedia = (media) => {
    form.media = media;
    console.log(form.media);
};

const submit = () => {
    form.post(route("product.store"));
};
</script>

<template>
    <AppLayout title="Gérer mes produits">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gérer Mes produits
            </h2>
        </template>
        <div class="py-4">
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-14">
                <div class="max-w-7xl mx-auto gap-12 w-full p-4">
                    <section class="space-y-6">
                        <AlertSuccess v-if="$page.props.flash.message">
                            {{ $page.props.flash.message }}
                        </AlertSuccess>
                        <AlertWarning v-if="$page.props.flash.update">
                            {{ $page.props.flash.update }}
                        </AlertWarning>

                        <form
                            v-if="categories.lengt !== 0"
                            @submit.prevent="submit"
                            class="px-2 py-4 grid grid-cols-12 gap-2"
                        >
                            <h3
                                class="col-span-full my-4 text-slate-800 text-xl md:text-3xl font-medium"
                            >
                                Étape 1
                                <span class="font-normal text-sm">
                                    (Informations du produits)</span
                                >
                            </h3>

                            <div class="col-span-full sm:col-span-4">
                                <InputLabel
                                    for="name"
                                    value="Quel est le nom du produit ? "
                                />
                                <TextInput
                                    id="store_name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>
                            <div class="col-span-full sm:col-span-4">
                                <InputLabel
                                    for="price"
                                    value="Quel est le prix  ? "
                                />
                                <TextInput
                                    id="price"
                                    v-model="form.price"
                                    type="number"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.price"
                                />
                            </div>
                            <div class="col-span-full sm:col-span-4">
                                <InputLabel
                                    for="sale_price"
                                    value="Quel est le prix en cas de promotion ? "
                                />
                                <TextInput
                                    id="sale_price"
                                    v-model="form.sale_price"
                                    type="number"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.sale_price"
                                />
                            </div>
                            <div class="col-span-full sm:col-span-4">
                                <InputLabel
                                    for="brand"
                                    value="Quel est la marque ? "
                                />
                                <TextInput
                                    id="brand"
                                    v-model="form.brand"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.brand"
                                />
                            </div>
                            <div class="col-span-full sm:col-span-4">
                                <InputLabel
                                    for="quantity"
                                    value="Quel est la quantité actuelle ? "
                                />
                                <TextInput
                                    id="quantity"
                                    v-model="form.quantity"
                                    type="number"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.quantity"
                                />
                            </div>
                            <div class="col-span-full sm:col-span-4">
                                <InputLabel
                                    for="category"
                                    value="Choisissez une catégorie ? "
                                />
                                <select
                                    v-model="form.category_id"
                                    class="w-full mt-1 block border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                                    id="category_id"
                                    required
                                >
                                    <option
                                        v-for="(category, index) in categories"
                                        :key="index"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.category_id"
                                />
                            </div>
                            <div class="col-span-full sm:col-span-4">
                                <InputLabel
                                    for="on_sale"
                                    value="Ce produit est-il en promotion ? "
                                />

                                <div class="mt-1">
                                    <Switch
                                        v-model="form.on_sale"
                                        :class="
                                            form.on_sale
                                                ? 'bg-blue-900'
                                                : 'bg-red-700'
                                        "
                                        class="relative inline-flex h-[38px] w-[74px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                    >
                                        <span class="sr-only"
                                            >Mettre le produit en
                                            promotion</span
                                        >
                                        <span
                                            aria-hidden="true"
                                            :class="
                                                form.on_sale
                                                    ? 'translate-x-9'
                                                    : 'translate-x-0'
                                            "
                                            class="pointer-events-none inline-block h-[34px] w-[34px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
                                        />
                                    </Switch>
                                </div>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.on_sale"
                                />
                            </div>

                            <div class="col-span-full sm:col-span-8">
                                <InputLabel
                                    for="description"
                                    value="Décrivez votre produit ( min : 20 catarères )"
                                />
                                <textarea
                                    v-model="form.description"
                                    rows="5"
                                    class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                                >
                                </textarea>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.description"
                                />
                            </div>
                            <h3
                                class="col-span-full my-4 text-slate-800 text-xl md:text-3xl font-medium"
                            >
                                Étape 2
                                <span class="font-normal text-sm">
                                    (Ajoutez des photos)</span
                                >
                            </h3>
                            <div class="col-span-full">
                                <Uploader
                                    server="/api/upload"
                                    @change="changeMedia"
                                />
                            </div>

                            <div
                                class="col-span-full flex w-full items-center justify-center mt-4"
                            >
                                <PrimaryButton
                                    class=""
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Enregistrer
                                </PrimaryButton>
                            </div>
                        </form>
                        <RequireBefore
                            v-else
                            :url="route('category.index')"
                            name="Créer une catégorie"
                        >
                            <template #title>
                                <p>Vous n'avez pas de catégorie</p>
                            </template>
                            <template #description>
                                <p>
                                    Pour créer un produit, veuillez créer au
                                    moins une catégorie. Les catégories aident à
                                    organiser nos produits et améliorent leur
                                    visibilité dans les résultats de recherche.
                                </p>
                            </template>
                        </RequireBefore>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
