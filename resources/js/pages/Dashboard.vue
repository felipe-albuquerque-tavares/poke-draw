<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, onMounted } from 'vue';
import PokemonList from '@/components/PokemonList.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Coleção',
        href: dashboard().url,
    },
];
const pokemons = ref([]);
const loading = ref(true);
const error = ref();

onMounted(async () => {
    try {
        const response = await axios.get('/api/pokemons');
        pokemons.value = response.data;
    } catch {
        error.value = 'Failed to load pokemons';
    } finally {
        loading.value = false;
    }
});
</script>

<template>
    <Head title="Coleção" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4"
        >
            <div class="flex h-[55vh]">
                <div class="flex flex-1 flex-col border">
                    <PokemonList class="flex-1" :data="pokemons" />
                </div>
            </div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-2">
                <div class="flex h-[32vh]">
                    <div class="flex flex-1 flex-col border">
                        <PokemonList class="flex-1" :data="pokemons" />
                    </div>
                </div>
                <div class="flex h-[32vh]">
                    <div class="flex flex-1 flex-col border">
                        <PokemonList class="flex-1" :data="pokemons" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
