<script setup>
import CardInfo from "@/Components/Card/CardInfo.vue";
import Table from "@/Components/Table.vue";
import BeginPremium from "@/Components/Card/BeginPremium.vue";
import Shop from "@/Components/Icon/Shop.vue";
import Banknote from "@/Components/Icon/Banknote.vue";
import Video from "@/Components/Icon/Video.vue";
import Dropshipper from "@/Components/Icon/Dropshipper.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

let dataThead = ["Nom", "Prix", "Disponible"];
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-9xl mx-auto sm:px-6 lg:px-14">
                <div class="grid grid-cols-12 gap-12 w-full p-4">
                    <section class="col-span-9 space-y-6">
                        <!--card info-->
                        <div class="flex w-full gap-4 py-4">
                            <CardInfo
                                bg-opacity-70
                                title="Chiffre d'affaire"
                                :icon="Banknote"
                                class="basis-1/3 full bg-violet-500 bg-opacity-70 drop-shadow-lg"
                            >
                                250.000 F
                            </CardInfo>
                            <CardInfo
                                title="Commandes"
                                :icon="Shop"
                                class="basis-1/3 full bg-blue-500 bg-opacity-70 drop-shadow-lg"
                            >
                                140
                            </CardInfo>
                            <CardInfo
                                title="Dropshipper"
                                :icon="Dropshipper"
                                class="basis-1/3 full bg-green-500 bg-opacity-70 drop-shadow-lg"
                            >
                                20
                            </CardInfo>
                        </div>
                        <!--table oder-->
                        <Table title="Commandes" :datahead="dataThead">
                            <template #button>
                                <PrimaryButton> Partager </PrimaryButton>
                            </template>
                            <template #tbody>
                                <tr
                                    class="bg-white dark:bg-gray-800 dark:border-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-bold text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        Apple MacBook Pro 17"
                                    </th>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        Silver
                                    </td>
                                    <td
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        Laptop
                                    </td>
                                </tr>
                            </template>
                        </Table>
                    </section>
                    <section class="space-y-4 col-span-3">
                        <BeginPremium></BeginPremium>
                        <div class="rounded-lg p-2 bg-white">
                            <div class="flex items-center gap-2">
                                <div
                                    class="bg-violet-700 bg-opacity-70 p-2 rounded-full"
                                >
                                    <Video class="text-white" />
                                </div>
                                <p
                                    class="text-extrabold text-lg text-slate-900"
                                >
                                    Service client
                                </p>
                            </div>
                            <div class="flex gap-2 mt-2 mb-6">
                                <span
                                    class="bg-slate-400 bg-opacity-30 pt-1 px-2 rounded-full text-slate-700 font-semibold text-sm"
                                    >De 08h00
                                </span>
                                <span
                                    class="bg-slate-400 bg-opacity-30 pt-1 px-2 rounded-full text-slate-700 font-semibold text-sm"
                                    >À 16h00
                                </span>
                            </div>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                Démarrer
                            </button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
