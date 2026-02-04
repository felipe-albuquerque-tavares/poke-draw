<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';
import { Gift } from 'lucide-vue-next';
import { ref } from 'vue';
import AppLogo from '@/components/AppLogo.vue';
import { Button } from '@/components/ui/button';
import { Skeleton } from '@/components/ui/skeleton';
import { dashboard, login, register } from '@/routes';
withDefaults(
    defineProps<{
        canRegister: boolean;
    }>(),
    {
        canRegister: true,
    },
);

const pokemon = ref();
const loading = ref(false);
const error = ref();

const fetchPokemon = async () => {
    loading.value = true;
    error.value = '';

    try {
        const res = await axios.get('/api/random-pokemon');
        pokemon.value = res.data.data;
    } catch {
        error.value = 'Failed to load Pokémon';
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Home">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]"
    >
        <div class="flex w-full justify-center border-b-1">
            <header
                class="mb-6 flex w-full max-w-[335px] justify-between text-sm not-has-[nav]:hidden lg:max-w-[1450px]"
            >
                <AppLogo />
                <nav class="flex items-center justify-end gap-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                    >
                        Coleçäo
                    </Link>
                    <template v-else>
                        <Link
                            :href="login()"
                            class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                        >
                            Log in
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="register()"
                            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm leading-normal text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </header>
        </div>
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
            <main
                class="flex w-full max-w-[335px] flex-col-reverse items-center justify-center gap-6 overflow-hidden rounded-lg text-center lg:max-w-4xl lg:flex-col"
            >
                <div class="flex flex-col gap-3">
                    <h1 class="text-4xl font-bold text-white">
                        Pokémon Diário
                    </h1>
                    <h4 class="text-xl text-white">
                        Resgate um Pokémon aleatório todos os dias
                    </h4>
                </div>

                <div
                    class="flex h-full w-[270px] flex-col justify-between gap-6"
                >
                    <div
                        data-slot="menu-skeleton"
                        class="relative h-[330px] w-full"
                    >
                        <div
                            v-if="pokemon"
                            class="z-10 flex flex-col items-center justify-center rounded-xl border-2 border-white p-4 text-white capitalize drop-shadow-sm drop-shadow-white transition delay-150 duration-300 ease-in-out hover:scale-110 hover:drop-shadow-xl/70 dark:bg-[#0a0a0a]"
                        >
                            <h2>{{ pokemon.name }}</h2>
                            <img
                                class="h-48 w-48"
                                :src="pokemon.image"
                                alt="pokemon"
                            />
                            <p>{{ pokemon.types.join(', ') }}</p>
                            <p>{{ pokemon.rarity }}</p>
                        </div>
                        <div class="h-full w-full" v-else>
                            <div
                                class="absolute flex h-full w-full flex-col items-center justify-center gap-2 text-white"
                            >
                                <Gift
                                    class="h-20 w-20 animate-bounce ease-in-out"
                                />
                                O seu pokemon te espera...
                            </div>
                            <Skeleton
                                class="h-full w-full flex-1"
                                data-sidebar="menu-skeleton-text"
                            />
                        </div>
                    </div>

                    <Button
                        class="cursor-pointer"
                        :disabled="!$page.props.auth.user || loading"
                        @click="fetchPokemon"
                        >Resgatar</Button
                    >
                    <div class="text-sm text-primary" :hidden="!loading">
                        Buscando pokemon...
                    </div>
                    <div
                        class="text-sm text-primary/20"
                        :hidden="!!$page.props.auth.user"
                    >
                        É necessario se registrar para resgatar
                    </div>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
