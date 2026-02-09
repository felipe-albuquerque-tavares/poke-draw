<script lang="ts" setup>
import { useDebounceFn } from '@vueuse/core';
import axios from 'axios';
import { ref, watch } from 'vue';
import type { OptionNode } from '@/components/ui/combobox';
import { Combobox } from '@/components/ui/combobox';
import { Label } from '@/components/ui/label';

const props = defineProps({
    route: {
        type: String,
        required: true,
    },
    field: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: false,
    },
    modelValue: {
        type: String,
        default: '',
    },
});

const emit = defineEmits(['update:modelValue']);

const search = ref(props.modelValue);
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

        options.value = [
            {
                name: '',
                children: response.data.map((item: any) => ({
                    name: item[props.field],
                })),
            },
        ];
    } catch (err) {
        error.value = 'Failed to load options';
        console.error('Error fetching options:', err);
    } finally {
        loading.value = false;
    }
};

const debouncedFetch = useDebounceFn(fetchOptions, 300);

watch(search, (value) => {
    debouncedFetch(value);
    emit('update:modelValue', value);
});

watch(
    () => props.modelValue,
    (value) => {
        if (value !== search.value) {
            search.value = value;
        }
    },
);
</script>

<template>
    <div class="flex flex-col gap-2">
        <Label v-if="label" class="font-bold capitalize">
            {{ label }}
        </Label>
        <Combobox v-model="search" :options="options" :loading="loading" />
        <span v-if="error" class="text-sm text-red-500">
            {{ error }}
        </span>
    </div>
</template>
