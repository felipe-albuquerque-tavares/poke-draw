<script setup>
import TableComponent from '@/components/Table.vue';

defineProps({
    data: {
        type: Array,
        required: true,
    },
});

const headers = ['Foto', 'Nome', 'Raridade', 'Tipo'];
</script>

<template>
    <table-component :headers="headers" :data="data">
        <template #column0="{ entity }">
            <img class="h-18 w-18" :src="entity.image" alt="pokemon" />
        </template>

        <template #column1="{ entity }">
            {{ entity.name }}
        </template>

        <template #column2="{ entity }">
            {{ entity.rarity }}
        </template>

        <template #column3="{ entity }">
            <ul>
                <li v-for="(type, i) in entity.types" :key="`${type}-${i}`">
                    {{ type }}
                </li>
            </ul>
        </template>
    </table-component>
</template>
