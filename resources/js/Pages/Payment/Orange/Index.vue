<script setup>
import Table from "@/Components/Table.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import AlertSuccess from "@/Components/AlertSuccess.vue";
import AlertWarning from "@/Components/AlertWarning.vue";

// props
const props = defineProps({
    url: String,
    phone: String | Number,
});
// useForm

const form = useForm({
    phone: props.phone?.phone,
});

const submit = () => {
    form.post(route("orange.store"));
};
const update = () => {
    form.put(route("orange.update", props.phone?.id));
};
const deleteForm = (id) => {
    form.delete(route("orange.destroy", id));
};
</script>

<template>
    <AppLayout title="Configurer mon compte orange">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Configuration De Compte Orange Money
            </h2>
        </template>
        <div class="py-4">
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-14">
                <div class="flex justify-center w-full">
                    <img
                        :src="url"
                        alt="Le logo de Orange"
                        class="w-36 h-36 sm:w-52 sm:h-52 lg:w-96 lg:h-96"
                    />
                </div>
                <h3
                    class="text-center text-lg sm:text-2xl lg:text-4xl font-semibold"
                >
                    {{ form.phone }}
                </h3>

                <div class="max-w-4xl mx-auto gap-12 w-full p-4">
                    <AlertSuccess
                        v-if="$page.props.flash.message"
                        class="mt-10"
                    >
                        {{ $page.props.flash.message }}
                    </AlertSuccess>
                    <AlertWarning v-if="$page.props.flash.update" >
                        {{ $page.props.flash.update }}
                    </AlertWarning>
                    <section class="space-y-6">
                        <form
                            v-if="props.phone"
                            @submit.prevent="update"
                            class="px-2 py-4 flex flex-col gap-2"
                        >
                            <InputLabel for="phone" value="Votre numéro orange money" />

                            <TextInput
                                id="phone"
                                v-model="form.phone"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="Exemple : 0101233378 "
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.phone"
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
                        <form
                            v-else
                            @submit.prevent="submit"
                            class="px-2 py-4 flex flex-col gap-2"
                        >
                            <InputLabel for="phone" value="Votre numéro orange" />

                            <TextInput
                                id="phone"
                                v-model="form.phone"
                                type="text"
                                class="mt-1 block w-full"
                                required
                                autofocus
                                placeholder="Exemple : 0101233378 "
                            />

                            <InputError
                                class="mt-2"
                                :message="form.errors.phone"
                            />

                            <div class="flex justify-center">
                                <PrimaryButton
                                    class="border-none"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    >Valider</PrimaryButton
                                >
                            </div>
                        </form>
                    </section>
                    <form
                        v-if="props.phone"
                        @submit.prevent="deleteForm(props.phone.id)"
                    >
                        <div class="flex justify-start w-full">
                            <DangerButton
                                type="submit"
                                class="border-none py-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                >Supprimer</DangerButton
                            >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
