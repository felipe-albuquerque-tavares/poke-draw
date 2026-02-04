<style>
table {
    border-collapse: collapse;
    width: 100%;
    table-layout: fixed !important;
    white-space: normal;
    word-wrap: break-word;
    max-height: 100%;
}

.table-wrapper {
    height: 100%;
    width: 100%;
    overflow: auto;
}

td {
    padding: 2px;
    text-align: center;
    border-bottom: 1px solid rgb(0, 0, 0);
    justify-items: center;
}

.header-item {
    padding: 10px 20px;
    font-size: 12px;
    background-color: rgb(0, 0, 0);
    text-transform: uppercase;
}

.table-rows:nth-child(odd) {
    background-color: rgb(49, 49, 49);
}

.table-rows:nth-child(n):hover {
    background-color: rgb(75, 75, 75);
}

.sticky-header {
    position: sticky;
    top: 0;
    z-index: 10;
    background-color: black;
}
</style>

<script lang="ts" setup>
defineProps({
    headers: {
        type: Array,
        required: true,
    },
    data: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th
                        v-for="(header, i) in headers"
                        :key="`${header}-${i}`"
                        class="header-item sticky-header"
                    >
                        {{ header }}
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr
                    v-for="(entity, rowIndex) in data"
                    :key="rowIndex"
                    class="table-rows"
                >
                    <td
                        v-for="(_, colIndex) in headers"
                        :key="`cell-${rowIndex}-${colIndex}`"
                    >
                        <slot :name="`column${colIndex}`" :entity="entity" />
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
