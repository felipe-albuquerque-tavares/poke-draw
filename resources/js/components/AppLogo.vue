<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';
</script>

<template>
    <Link :href="home()" class="flex items-center gap-2 self-center">
        <div
            class="flex aspect-square items-center justify-center rounded-md text-sidebar-primary-foreground"
        >
            <AppLogoIcon />
        </div>
        <div class="ml-1 grid flex-1 items-center text-left text-xl">
            <span class="mb-0.5 truncate leading-tight font-semibold text-white"
                >PokéDraw</span
            >
        </div>
    </Link>
</template>
