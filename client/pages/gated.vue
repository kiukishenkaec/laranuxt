<template>
  <div class="flex flex-col items-center justify-center">
    <span class="text-xs p-2"> $api.$user </span>
    <pre class="text-xs p-4 bg-gray-200 dark:bg-gray-700 rounded-md max-w-md overflow-hidden"> {{ $api.$user }} </pre>
  </div>
</template>


<script lang="ts" setup>
import { useNuxtApp } from '#app'
import { definePageMeta } from "#imports";
definePageMeta({
    middleware: 'auth',
})

const { $crumbs } = useNuxtApp()


$crumbs.set([
    { name: 'Главная', to: '/' },
    { name: 'Закрытый', to: '/gated' },
])


</script>
