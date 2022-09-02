import { defineNuxtPlugin, useNuxtApp, useRuntimeConfig } from '#app'
import Api from '~/lib/api'

export default defineNuxtPlugin(() => {
  const config = useRuntimeConfig()
  const { $toast } = useNuxtApp()
  return {
    provide: {
      api: new Api({
          fetchOptions: {
            baseURL: config.public.apiURL,
          },
          apiURL: config.public.apiURL,
          webURL: config.public.webURL,
          redirect: {
            logout: '/',
            login: '/home',
          },

          echoConfig: {
            //broadcaster: 'pusher',
            wsHost: '127.0.0.1',
            wsPort: 6001,
            forceTLS: false,
            encrypted: true,
            disableStats: true,
            enabledTransports: ['ws'/*, 'wss'*/],
            pusherAppKey: config.public.pusherAppKey,
            pusheAppCluster: config.public.pusherAppCluster,
          },

        }, $toast),
    },
  }
})

declare module '#app' {
  interface NuxtApp {
    $api: Api
  }
}
