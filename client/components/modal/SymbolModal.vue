<template>
    <modal-base :destroyed="props.destroyed">
        <div class="bg-white dark:bg-gray-800 py-8 px-4 sm:px-10">

            <label class="mt-6 block text-sm font-medium leading-5 text-gray-700 dark:text-gray-500" for="symbol_id">Symbol id</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input
                    id="symbol_id"
                    ref="input"
                    v-model="symbol.id"
                    class="form-input appearance-none block dark:bg-gray-600 w-full px-3 py-2 border border-gray-300 dark:border-gray-500 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                    :readonly="true"
                    type="text"
                >
            </div>

            <label class="mt-6 block text-sm font-medium leading-5 text-gray-700 dark:text-gray-500" for="symbol_is_active">Symbol is active</label>
            <div class="mt-1 relative rounded-md">
                <input
                    id="symbol_is_active"
                    ref="input"
                    v-model="symbol.is_active"
                    class="form-input block dark:bg-gray-600 px-3 py-2 border border-gray-300 dark:border-gray-500 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                    type="checkbox"
                >
            </div>

            <label class="mt-6 block text-sm font-medium leading-5 text-gray-700 dark:text-gray-500" for="symbol_is_future">Symbol is future</label>
            <div class="mt-1 relative rounded-md">
                <input
                    id="symbol_is_future"
                    ref="input"
                    v-model="symbol.is_future"
                    class="form-input block dark:bg-gray-600 px-3 py-2 border border-gray-300 dark:border-gray-500 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                    type="checkbox"
                >
            </div>

            <div class="mt-6">
                <span class="block w-full rounded-md shadow-sm">
                    <push-button theme="indigo" class="w-full justify-center" @click="attempt">
                        Сохранить
                        <div v-if="loading.attempt" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <icon icon="gg:spinner-two" class="w-5 h-5 text-indigo-200 animate-spin" />
                        </div>
                    </push-button>
                </span>
            </div>

        </div>
    </modal-base>
</template>


<script lang="ts" setup>
import { useNuxtApp } from '#app'
import { PushButton, ModalBase } from 'tailvue'
import { reactive, ref } from 'vue'
import { Icon } from '@iconify/vue'

const emit = defineEmits(['off'])
const off = () => emit('off')

const { $toast, $api } = useNuxtApp()

const loading = reactive({
  attempt: false,
} as Record<string, boolean>)

const props = defineProps({
    destroyed: {
        type: Function,
        required: true,
    },
    symbol: {
        type: Object,
        required: true,
    },
})

async function attempt (): Promise<void> {
    loading.attempt = true
    const result = await $api.update(`api/v1/admin/binance/symbols/${props.symbol.id}`, props.symbol)
    loading.attempt = false

    if (!result) return

    $toast.show({
        type: 'success',
        title: 'Обновили symbol',
        message: `Super!`,
        timeout: 4,
    })

    emit('off')
}
</script>
