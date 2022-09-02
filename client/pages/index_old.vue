<template>
    <div class="mx-auto container p-2 lg:p-8 flex flex-col">

    <symbol-modal
        :symbol="symbol"
        v-if="modal"
        :destroyed="off"
        @off="off"
    />

    <div class="text-center mt-4" v-if="!$api.guest()">
        <div class="overflow-x-auto relative">
            <div id="row-clicked"></div>
                <table-sceleton v-if="!items"></table-sceleton>

                <easy-data-table v-else
                     v-model:items-selected="itemsSelected"
                     :headers="headers"
                     :items="items"
                     @click-row="showModal"
                     buttons-pagination
                     :loading="false"
                />
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useNuxtApp } from '#app'
// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { ref } from "vue";
import EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import type { Header, Item, ClickRowArgument } from "vue3-easy-data-table";
import TableSceleton from "../components/table/TableSceleton";
import SymbolModal from "../components/modal/SymbolModal";

const { $api, $crumbs } = useNuxtApp()

const modal = ref(false)
const symbol = ref(undefined)

$crumbs.set([{
    name: 'Symbols',
    to: '/',
}])

const itemsSelected = ref<Item[]>([]);

type ClickRowArgument = Item & {
    isSelected?: boolean,
    indexInCurrentPage?: number,
}

const emit = defineEmits(['off'])

const symbols = async (): Promise<api.MetApiResponse> => await $api.get('/api/v1/binance/symbols')

const headers: Header[] = [
    { text: "Id", value: "id", sortable: true },
    { text: "first_code", value: "first_code", sortable: true },
    { text: "last_code", value: "last_code", sortable: true },
    { text: "Active", value: "is_active", sortable: true },
    { text: "Future", value: "is_future", sortable: true },
];

const items = ref<Item[]|undefined>(undefined)
const get = async () => items.value = (await symbols()).data
get()

const showModal = (item: ClickRowArgument) => {
    modal.value = true
    symbol.value = item
}

const off = () => {
    const index = items.value.findIndex(v => v.id === symbol.value.id)
    items.value[index] = symbol.value;
    console.log(index, items.value[index])
    modal.value = false
    emit('off')
}

</script>


