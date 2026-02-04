<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';
import { Sparkles } from 'lucide-vue-next';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link :href="home()" class="flex items-center gap-2 self-center">
        <div
            class="flex aspect-square size-8 items-center justify-center rounded-md bg-sidebar-primary/10 text-sidebar-primary-foreground"
        >
            <Sparkles class="size-4 text-white dark:text-white" />
        </div>
        <div class="ml-1 grid flex-1 items-center text-left text-xl">
            <span class="mb-0.5 truncate leading-tight font-semibold text-white"
                >PokéDraw</span
            >
        </div>
    </Link>
</template>
