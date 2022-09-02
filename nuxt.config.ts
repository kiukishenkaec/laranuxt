import { defineNuxtConfig } from 'nuxt'

import { fileURLToPath } from 'url'
import { resolve } from 'pathe'
const resolvePath = (...paths: string[]) => resolve(fileURLToPath(new URL('./', import.meta.url)), ...paths)


export default defineNuxtConfig({
    ssr:false,
    alias: {
        public: resolvePath('client/public/'),
    },
    build: {
        transpile: ['primevue'],
    },
    css: [
        'primevue/resources/themes/saga-blue/theme.css',
        'primevue/resources/primevue.css',
        'primeflex/primeflex.css',
        'primeicons/primeicons.css',
        'prismjs/themes/prism-coy.css',
        '~/assets/styles/layout.scss',
        '~/assets/demo/flags/flags.css',
    ],
    dir: {
        public: resolvePath('client/public/'),
    },
    srcDir: 'client/',

    experimental: {
        reactivityTransform: true,
        viteNode: false,
    },
    meta: {
        title: process.env.npm_package_name || '',
        meta: [
            { charset: 'utf-8' },
            { name: 'viewport', content: 'width=device-width, initial-scale=1' },
            { hid: 'description', name: 'description', content: process.env.npm_package_description || '' },
        ],
        link: [
            { rel: 'icon', href: '/favicon.ico' },
            { rel: 'stylesheet', href: '/themes/lara-light-indigo/theme.css', id: "theme-link" },
        ],
    },


    /**
     * @see https://v3.nuxtjs.org/api/configuration/nuxt.config#modules
     */
    modules: [
        '@pinia/nuxt',
        '@vueuse/nuxt',
    ],

    head: undefined,

    /*modules: [
        '@vueuse/nuxt',
        'nuxt-windicss',
        '@tailvue/nuxt',
    ],*/

    /*
    ** Auto import components
    ** See https://nuxtjs.org/api/configuration-components
    */
    /*components: [
        '~/components',
        '~/components/contact',
        '~/components/layout',
        '~/components/header',
        '~/components/transition',
    ],*/




    /**
    * @see https://v3.nuxtjs.org/guide/features/runtime-config#exposing-runtime-config
    */
    runtimeConfig: {
        public: {
            webURL: process.env.WEB_URL || 'http://localhost',
            apiURL: process.env.API_URL || 'http://localhost:8000',
            pusherAppKey: process.env.PUSHER_APP_KEY,
            pusherAppCluster: process.env.PUSHER_APP_CLUSTER,
        },
    },

    nitro: {
        preset: 'vercel',
    },

    vite: {
        clearScreen: true,
        logLevel: 'info',
    },


    /**
    * WindiCSS configuration
    * @see https://github.com/windicss/nuxt-windicss
    */
    windicss: {
        analyze: false,
    },

})
