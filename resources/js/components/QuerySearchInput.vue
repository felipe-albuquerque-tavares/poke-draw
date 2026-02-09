<script lang="ts" setup>
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { useDebounceFn } from '@vueuse/core';
import { Combobox, OptionNode } from '@/components/ui/combobox';
import { ref, watch } from 'vue';
import axios from 'axios';

const props = defineProps({
    route: {
        type: String,
        required: true,
    },
    field: {
        type: String,
        required: true,
    },
    lable: {
        type: String,
        required: false,
    },
});

const search = ref('');
const options = ref<OptionNode[]>([]);
const loading = ref(false);
const error = ref<string | null>(null);

const fetchOptions = async (value: string) => {
    if (!value) {
        options.value = [];
        return;
    }

    loading.value = true;
    error.value = null;

    try {
        const response = await axios.get(`/api/${props.route}`, {
            params: {
                [props.field]: value,
            },
        });

        options.value = response.data;
    } catch {
        error.value = 'Failed to load';
    } finally {
        loading.value = false;
    }
};

const debouncedFetch = useDebounceFn(fetchOptions, 300);

watch(search, (value) => {
    debouncedFetch(value);
});
</script>
<template>
    <div class="flex flex-col gap-2">
        <Label for="field" class="font-bold capitalize">{{ lable }}</Label>
        <Combobox v-model="search" :options="options" :loading="loading" />
        <span v-if="error" class="text-sm text-red-500">
            {{ error }}
        </span>
    </div>
</template>
