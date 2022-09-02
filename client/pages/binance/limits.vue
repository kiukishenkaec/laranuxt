<template>
    <div>
        <h1>Привет</h1>
        <pre>{{book}}</pre>
    </div>
</template>


<script setup lang="ts">
import {ref} from "vue";
import Binance from 'binance-api-node'

const client = Binance()

const book = ref(undefined)

book.value = await client.futuresBook({symbol:'BTCUSDT'})

console.log()

</script>

<style scoped>

</style>
