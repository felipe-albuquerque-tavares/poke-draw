<script setup lang="ts">
import { Sparkles } from 'lucide-vue-next';
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

defineProps<Props>();
</script>

<template>
    <div
        className="w-10 h-10 rounded-xl bg-primary/20 flex items-center justify-center"
    >
        <Sparkles className="w-5 h-5 text-primary" />
    </div>
</template>
