<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SwiperWithProgress from "@/Components/SwiperWithProgress.vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { ref } from "vue";

let ImageSwipe = [
    {
        title: "Connectez vous",
    },
    {
        title: "Gérer vos produits",
    },
    {
        title: "Créez votre audience",
    },
];

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Me connecter" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="grid grid-cols-6 h-screen">
            <div class="hidden lg:block col-span-3 p-4">
                <SwiperWithProgress>
                    <swiper-slide
                        v-for="(item, index) in ImageSwipe"
                        :key="index"
                        class="h-full rounded-lg bg-red-500"
                    >
                        <p
                            class="font-extrabold text-transparent text-center text-8xl bg-clip-text bg-gradient-to-r from-blue-800 to-slate-500 drop-shadow-md rounded-md bg-slate-800 bg-opacity-50 p-2"
                        >
                            {{ item.title }}
                        </p>
                    </swiper-slide>
                </SwiperWithProgress>
            </div>
            <div
                class="col-span-full lg:col-span-3 flex flex-col justify-center items-center bg-gradient-to-tr from-slate-50 to-slate-200 bg-opacity-20"
            >
                <div
                    v-if="status"
                    class="mb-4 font-medium text-sm text-green-600"
                >
                    {{ status }}
                </div>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="E-mail" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
                            autofocus
                            autocomplete="store_name"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Mot de passe" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="current-password"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <Checkbox
                                v-model:checked="form.remember"
                                name="remember"
                            />
                            <span class="ml-2 text-sm text-gray-600"
                                >Se souvenir de moi</span
                            >
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            Mot de passe oublié?
                        </Link>

                        <PrimaryButton
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Connexion
                        </PrimaryButton>
                    </div>
                </form>
                
                <Link
                    :href="route('register')"
                    class="flex justify-center w-full text-sm font-bold text-slate-800 hover:text-slate-900 transition duration-500 ease-in-out pt-8"
                >
                    J'ai pas encore de boutique ?
                </Link>
            </div>
        </div>
    </AuthenticationCard>
</template>
