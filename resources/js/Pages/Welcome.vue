<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Viko - bienvenue sur l'espace des vendeur " />

    <div
        class="relative h-screen bg-center bg-gradient-to-tr from-slate-800 to-slate-900 pb-20"
    >
        <div class="sm:flex sm:justify-around py-8">
            <Link
                :href="route('welcome')"
                class="text-white sm:text-lg font-bold"
            >
                ViKo
            </Link>

            <div v-if="canLogin" class=" ">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="ml-4 font-semibold text-slate-800 bg-slate-100 p-4 rounded-full shadow-md hover:bg-slate-200 transition duration-300 ease-in-out"
                    >Ma boutique</Link
                >

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="text-white font-semibold hover:text-slate-100 dark:text-gray-400 dark:hover:text-white "
                        >Connexion</Link
                    >
                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="ml-4 font-semibold text-slate-800 bg-slate-100 p-4 rounded-full shadow-md hover:bg-slate-200 transition duration-300 ease-in-out"
                        >Créer une boutique</Link
                    >
                </template>
            </div>
        </div>
        <h3
            class="py-20 mx-auto max-w-5xl font-extrabold text-transparent text-center text-8xl bg-clip-text bg-gradient-to-r from-white to-yellow-600"
        >
            Gérer votre boutique <br />
            <span>Avec </span> <span>ViKo</span>
        </h3>
    </div>
</template>

<style></style>
