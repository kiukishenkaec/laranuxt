<template>
    <div class="overflow-x-auto relative">
        <div id="row-clicked"></div>
        <table-sceleton v-if="!items"></table-sceleton>

        <easy-data-table v-else
             v-model:items-selected="itemsSelected"
            :headers="headers"
            :items="items"
             @click-row="showRow"
            buttons-pagination
            :loading="false"
        />
    </div>
</template>


<script setup lang="ts">
import { useNuxtApp } from '#app'
// eslint-disable-next-line @typescript-eslint/no-unused-vars
const { $api, $crumbs } = useNuxtApp()
$crumbs.set([
  {
    name: 'Coins',
    to: '/coins',
  },
])
import { ref } from "vue";
import TableSceleton from "../components/table/TableSceleton";
import EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import type { Header, Item, ClickRowArgument } from "vue3-easy-data-table";

type ClickRowArgument = Item & {
    isSelected?: boolean,
    indexInCurrentPage?: number,
}

const itemsSelected = ref<Item[]>([]);

const symbols = async (): Promise<api.MetApiResponse> => await $api.get('/api/v1/binance/symbols')

const headers: Header[] = [
    { text: "Id", value: "id", sortable: true },
    { text: "first_code", value: "first_code", sortable: true },
    { text: "last_code", value: "last_code", sortable: true },

    { text: "Close", value: "close", sortable: true },
    { text: "Open", value: "open", sortable: true },


    { text: "high", value: "high", sortable: true },
    { text: "low", value: "low", sortable: true },
    { text: "", value: "", sortable: true },

    { text: "Quote Volume", value: "quoteVolume", sortable: true },
    { text: "volume", value: "volume", sortable: true },


    { text: "5 мин", value: "history_5_min.close", sortable: true },
    { text: "15 мин", value: "history_15_min.close", sortable: true },
    { text: "30 мин", value: "history_30_min.close", sortable: true },
    { text: "60 мин", value: "history_60_min.close", sortable: true },
    { text: "240 мин", value: "history_240_min.close", sortable: true },
    { text: "1440 мин", value: "history_1440_min.close", sortable: true },
];

const items = ref<Item[]|undefined>(undefined)
//let items = (await symbols()).data;

const get = async () => items.value = (await symbols()).data
get()


const showRow = (item: ClickRowArgument) => {
    document.getElementById('row-clicked').innerHTML = JSON.stringify(item);
};

</script>

<style scoped>

</style>
