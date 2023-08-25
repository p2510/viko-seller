<script setup>
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: "PUT",
    name: props.user.name,
    manager_name: props.user.manager_name,
    email: props.user.email,
    phone: props.user.phone,
    adress: props.user.adress,
    category: props.user.category,
    location: props.user.location,
    description: props.user.description,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route("user-profile-information.update"), {
        errorBag: "updateProfileInformation",
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route("current-user-photo.destroy"), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title> Information de boutique </template>

        <template #description>
            Mettez à jour les informations de votre boutique comme l'adresse
            e-mail de votre compte , le logo ...
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="col-span-6 sm:col-span-4"
            >
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                />

                <InputLabel for="photo" value="Votre logo" />

                <!-- Current Profile Photo -->
                <div v-show="!photoPreview" class="mt-2">
                    <img
                        :src="user.profile_photo_url"
                        :alt="user.name"
                        class="rounded-full h-20 w-20 object-cover"
                    />
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="
                            'background-image: url(\'' + photoPreview + '\');'
                        "
                    />
                </div>

                <SecondaryButton
                    class="mt-2 mr-2"
                    type="button"
                    @click.prevent="selectNewPhoto"
                >
                    Sélectionnez un nouveau logo
                </SecondaryButton>

                <SecondaryButton
                    v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Supprimer le logo
                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="name" value="Nom de la boutique" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>
            <!-- manager_name -->
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="manager_name" value="Nom du gérant" />
                <TextInput
                    id="manager_name"
                    v-model="form.manager_name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="manager_name"
                />
                <InputError :message="form.errors.manager_name" class="mt-2" />
            </div>
            <!-- Email -->
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="email" value="E-mail" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError :message="form.errors.email" class="mt-2" />

                <div
                    v-if="
                        $page.props.jetstream.hasEmailVerification &&
                        user.email_verified_at === null
                    "
                >
                    <p class="text-sm mt-2">
                        Votre adresse e-mail n'est pas vérifiée.

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            @click.prevent="sendEmailVerification"
                        >
                            Cliquez ici pour renvoyer l'e-mail de vérification.
                        </Link>
                    </p>

                    <div
                        v-show="verificationLinkSent"
                        class="mt-2 font-medium text-sm text-green-600"
                    >
                        Un nouveau lien de vérification a été envoyé à votre
                        adresse e-mail adresse.
                    </div>
                </div>
            </div>
            <!-- phone -->
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="phone" value="Téléphone" />
                <TextInput
                    id="phone"
                    v-model="form.phone"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="phone"
                />
                <InputError :message="form.errors.phone" class="mt-2" />
            </div>
            <!-- adress -->
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="adress" value="Adresse" />
                <TextInput
                    id="adress"
                    v-model="form.adress"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="adress"
                />
                <InputError :message="form.errors.adress" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-3">
                <InputLabel for="category" value="Choisissez une catégorie " />
                <TextInput
                    id="category"
                    v-model="form.category"
                    type="text"
                    class="mt-1 block w-full"
                />
                <InputError class="mt-2" :message="form.errors.category" />
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
                <InputError class="mt-2" :message="form.errors.description" />
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
                <InputError class="mt-2" :message="form.errors.description" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Enrégistré.
            </ActionMessage>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Enregistrer
            </PrimaryButton>
        </template>
    </FormSection>
</template>
