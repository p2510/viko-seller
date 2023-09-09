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
import { ref } from "vue";
import "animate.css";

// thead table
let dataThead = [
    "Nom",
    "photo",
    "Marque",
    "Catégorie",
    "prix",
    "prix promotion",
    "quantité",
    "En promotion",
    "Action",
];

// props
const props = defineProps({
    categories: Array,
    products: Array,
    urlPhoto: String,
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
};

let hiddenForm = ref(false);

const submit = () => {
    form.post(route("product.store"));
};
</script>

<template>
    <AppLayout title="Gérer mes produits" class="relative">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gérer Mes produits
            </h2>
        </template>

        <transition
            mode="out-in"
            enter-active-class="animate__animated animate__slideInRight"
            leave-active-class="animate__animated animate__slideOutRight"
        >
            <div class="w-full h-full bg-white fixed z-30" v-if="hiddenForm">
                <div class="w-full fixed bg-slate-50 p-4 flex justify-between">
                    <h5>
                        <p
                            class="text-slate-800 text-opacity-80 text-2xl font-medium"
                        >
                            Ajout Produit
                        </p>
                        <span
                            class="text-slate-800 text-opacity-70 text-sm font-medium"
                            >Ajoutez votre produit et les informations
                            nécessaires à partir d'ici</span
                        >
                    </h5>
                    <div>
                        <button
                            @click="hiddenForm = !hiddenForm"
                            class="bg-white p-2 shadow-md bg-opacity-80 hover:bg-red-400 hover:bg-opacity-50 transition ease-in-out duration-500 text-white rounded-full mb-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6 text-red-500"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="py-4 overflow-y-auto h-3/4 mt-24">
                    <div class="max-w-9xl mx-auto sm:px-6 lg:px-14">
                        <div class="max-w-7xl mx-auto gap-12 w-full p-4">
                            <section class="space-y-6">
                                <AlertSuccess
                                    v-if="$page.props.flash.message"
                                    class="mt-10"
                                >
                                    {{ $page.props.flash.message }}
                                </AlertSuccess>
                                <AlertWarning
                                    v-if="$page.props.flash.update"
                                    class="mt-10"
                                >
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
                                                v-for="(
                                                    category, index
                                                ) in categories"
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
                                            :class="{
                                                'opacity-25': form.processing,
                                            }"
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
                                            Pour créer un produit, veuillez
                                            créer au moins une catégorie. Les
                                            catégories aident à organiser nos
                                            produits et améliorent leur
                                            visibilité dans les résultats de
                                            recherche.
                                        </p>
                                    </template>
                                </RequireBefore>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        <div class="py-4">
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-14">
                <div class="w-full flex justify-end">
                    <button
                        @click="hiddenForm = !hiddenForm"
                        class="bg-emerald-600 bg-opacity-80 hover:bg-opacity-70 transition ease-in-out duration-500 p-4 text-white rounded-md mb-4"
                    >
                        Ajouter un produit
                    </button>
                </div>
                

                <div class="max-w-9xl mx-auto gap-12 w-full p-4">
                    <div class="grid grid-cols-4 gap-12 p-4">
                        <section class="col-span-full space-y-6 w-full">
                            <!--table oder-->
                            <Table
                                v-if="products.length !== 0"
                                title="Liste de mes produits"
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
                                        v-for="(product, index) in products"
                                        :key="index"
                                        class="bg-white dark:bg-gray-800 dark:border-gray-700"
                                    >
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {{ product.name }}
                                        </th>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            <img
                                                :src="
                                                    urlPhoto +
                                                    '/' +
                                                    product.first_photo.name
                                                "
                                                :alt="product.name"
                                                class="w-16 h-16"
                                            />
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {{ product.brand }}
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {{ product.category_name }}
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {{ product.price }} F
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {{ product.sale_price }} F
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            {{ product.quantity }}
                                        </td>
                                        <td
                                            v-if="product.on_sale"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            Oui
                                        </td>
                                        <td
                                            v-else
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        >
                                            Non
                                        </td>
                                        <td
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                        >
                                            <ActionButton
                                                deletelink="product.destroy"
                                                :deleteid="product.name"
                                                :updatelink="
                                                    route(
                                                        'product.edit',
                                                        product.name
                                                    )
                                                "
                                            />
                                        </td>
                                    </tr>
                                </template>
                            </Table>
                            <NotResult v-else
                                >Nous n'avez pas encore de produits enregistrés
                            </NotResult>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
