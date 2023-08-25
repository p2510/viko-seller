<template>
    <Head title="Créer une nouvelle boutique chez ViKo" />
    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="grid grid-cols-6">
            <div class="hidden lg:block col-span-3 p-4">
                <SwiperWithProgress>
                    <swiper-slide
                        v-for="(item, index) in ImageSwipe"
                        :key="index"
                        class="h-full rounded-lg swipe"
                        :style="'background-image:url(' + item.url + ');'"
                    >
                        <p
                            class="font-extrabold text-transparent text-center text-8xl bg-clip-text bg-gradient-to-r from-blue-800 to-white/30 drop-shadow-md rounded-md bg-slate-800 bg-opacity-50 p-2"
                        >
                            {{ item.title }}
                        </p>
                    </swiper-slide>
                </SwiperWithProgress>
            </div>
            <div class="col-span-full lg:col-span-3">
                <Link
                    :href="route('login')"
                    class="flex justify-end w-full text-sm font-bold text-slate-800 hover:text-slate-900 transition duration-500 ease-in-out p-4"
                >
                    J'ai déjà une boutique ?
                </Link>

                <p class="text-3xl font-extrabold pl-4 pt-8 pb-2">
                    Créer une nouvelle boutique
                </p>
                <p class="text-md opacity-70 pl-4 pb-10">
                    Commençons ensemble une aventure ...
                </p>
                
                <form
                    @submit.prevent="submit"
                    class="grid grid-cols-4 gap-4 p-2"
                >
                    <div class="col-span-2">
                        <InputLabel
                            for="name"
                            value="Quel est le nom de votre boutique ? "
                        />
                        <TextInput
                            id="store_name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="col-span-2">
                        <InputLabel
                            for="manager_name"
                            value="Quel est le nom du gérant ? "
                        />
                        <TextInput
                            id="name"
                            v-model="form.manager_name"
                            type="text"
                            class="mt-1 block w-full"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.manager_name" />
                    </div>
                    <div class="col-span-2">
                        <InputLabel for="adress" value="Où êtes vous situé ? " />
                        <TextInput
                            id="adress"
                            v-model="form.adress"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            
                        />
                        <InputError class="mt-2" :message="form.errors.adress" />
                    </div>

                    <div class="col-span-2">
                        <InputLabel
                            for="category"
                            value="Choisissez une catégorie "
                        />
                        <TextInput
                            id="category"
                            v-model="form.category"
                            type="text"
                            class="mt-1 block w-full"
                
                        />
                        <InputError class="mt-2" :message="form.errors.category" />
                    </div>
                    <div class="col-span-2">
                        <InputLabel
                            for="phone"
                            value="Votre numéro de téléphone (10 chiffres)"
                        />
                        <TextInput
                            id="phone"
                            v-model="form.phone"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            placeholder="Ex : 0101233378"
                           
                        />
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                    <div class="col-span-2">
                        <InputLabel for="email" value="Votre adresse e-mail" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="mt-1 block w-full"
                            required
                            autocomplete="email"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="col-span-2">
                        <InputLabel for="password" value="Votre mot de passe" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="new-password"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>

                    <div class="col-span-2">
                        <InputLabel
                            for="password_confirmation"
                            value="Confirmez le mot de passe"
                        />
                        <TextInput
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            required
                            autocomplete="new-password"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.password_confirmation"
                        />
                    </div>

                    <div class="col-span-full">
                        <InputLabel
                            for="location"
                            value="Décrivez le postion exacte de boutique ( min : 20 catarères )"
                        />
                        <textarea
                            v-model="form.location"
                            rows="3"
                            class="w-full border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm"
                            placeholder="Ex : Rue des Perles, Cocody, Abidjan, près ... "
                        >
                        </textarea>
                        <InputError
                            class="mt-2"
                            :message="form.errors.description"
                        />
                    </div>
                    <div class="col-span-full">
                        <InputLabel
                            for="description"
                            value="Décrivez votre boutique ( min : 20 catarères )"
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

                    <div
                   
                        v-if="
                            $page.props.jetstream
                                .hasTermsAndPrivacyPolicyFeature
                        "
                        class="col-span-full"
                    >
                        <InputLabel for="terms">
                            <div class="flex items-center">
                                <Checkbox
                                    id="terms"
                                    v-model:checked="form.terms"
                                    name="terms"
                                    required
                                />

                                <div class="ml-2">
                                    je suis d'accord avec les
                                    <a
                                        target="_blank"
                                        :href="route('terms.show')"
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        >Conditions d'utilisation</a
                                    >
                                    et la
                                    <a
                                        target="_blank"
                                        :href="route('policy.show')"
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        >politique de confidentialité</a
                                    >
                                </div>
                            </div>
                            <InputError
                                class="mt-2"
                                :message="form.errors.terms"
                            />
                        </InputLabel>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                           Soumettre
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticationCard>
</template>

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
        url: "http://127.0.0.1:8000/storage/img/img1.webp",
        title: "Devenez propriétaire",
    },
    {
        url: "http://127.0.0.1:8000/storage/img/img2.webp",
        title: "Vendez rapidement ",
    },
    {
        url: "http://127.0.0.1:8000/storage/img/img3.webp",
        title: "Diversifiez vous",
    },
];
const form = useForm({
    name: "",
    manager_name: "",
    phone: "",
    adress: "",
    location: "",
    category: "",
    description: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>
<style scoped>
.swipe {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>
