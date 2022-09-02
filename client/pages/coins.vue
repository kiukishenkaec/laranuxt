<template>
    <div class="overflow-x-auto relative">

        <symbol-modal
            :symbol="symbol"
            v-if="modal"
            :destroyed="off"
            @off="off"
        />

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
</template>


<script setup lang="ts">
import { useNuxtApp } from '#app'
// eslint-disable-next-line @typescript-eslint/no-unused-vars
const { $api, $crumbs} = useNuxtApp()
$crumbs.set([
  {
    name: 'Coins',
    to: '/coins',
  },
])
import {onMounted, ref} from "vue";
import TableSceleton from "../components/table/TableSceleton";
import SymbolModal from "../components/modal/SymbolModal";
import EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import type { Header, Item, ClickRowArgument } from "vue3-easy-data-table";

const modal = ref(false)
const symbol = ref(undefined)
const emit = defineEmits(['off'])

const items = ref<Item[]|undefined>(undefined)
type ClickRowArgument = Item & {
    isSelected?: boolean,
    indexInCurrentPage?: number,
}
const itemsSelected = ref<Item[]>([]);
const headers: Header[] = [
    { text: "Id", value: "id", sortable: true },
    { text: "first_code", value: "first_code", sortable: true },
    { text: "last_code", value: "last_code", sortable: true },

    { text: "Close", value: "close", sortable: true },
    { text: "Open", value: "open", sortable: true },

    { text: "high", value: "high", sortable: true },
    { text: "low", value: "low", sortable: true },

    { text: "Quote Volume", value: "quoteVolume", sortable: true },
    { text: "volume", value: "volume", sortable: true },

    { text: "5 мин", value: "history_5_min.close", sortable: true },
    { text: "15 мин", value: "history_15_min.close", sortable: true },
    { text: "30 мин", value: "history_30_min.close", sortable: true },
    { text: "60 мин", value: "history_60_min.close", sortable: true },
    { text: "240 мин", value: "history_240_min.close", sortable: true },
    { text: "1440 мин", value: "history_1440_min.close", sortable: true },
];



const symbols = async (): Promise<api.MetApiResponse> => (await $api.get('/api/v1/binance/symbols')).data
const get = async () => items.value = await symbols()


get()

onMounted(() => {
    $api.setEcho()

    $api.$echo.channel(`symbols`).listen('SymbolStatusUpdated', (data) => {
        setSymbolFromWs(data.symbol);
    })
    .listen('SymbolDepthCacheUpdated', (data) => {
        console.log(data);
    })
})




const showModal = (item: ClickRowArgument) => {
    modal.value = true
    symbol.value = item
}


const off = () => {
    const index = items.value.findIndex(v => v.id === symbol.value.id)
    items.value[index] = symbol.value;
    modal.value = false
    emit('off')
}


function setSymbolFromWs(symbol){
    const index = items.value.findIndex(v => v.id === symbol.id)

    console.log(items.value[index], symbol)
    items.value[index].close = symbol.close
    items.value[index].open = symbol.open
    items.value[index].high = symbol.high
    items.value[index].low = symbol.low
    items.value[index].quoteVolume = symbol.quoteVolume
    items.value[index].volume = symbol.volume

    items.value[index].history_5_min.close = symbol.history_5_min.close
    items.value[index].history_15_min.close = symbol.history_15_min.close
    items.value[index].history_30_min.close = symbol.history_30_min.close
    items.value[index].history_60_min.close = symbol.history_60_min.close
    items.value[index].history_240_min.close = symbol.history_240_min.close
    items.value[index].history_1440_min.close = symbol.history_1440_min.close

}

</script>

<style scoped>

</style>
