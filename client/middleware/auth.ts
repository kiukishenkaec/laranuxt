import {defineNuxtRouteMiddleware, useNuxtApp} from '#app'

export default defineNuxtRouteMiddleware(to => {
  const { $api } = useNuxtApp()

  if (  $api &&
        to.path !== $api.config.redirect.logout &&
        to.path !== '/invalid' &&
        $api.loggedIn.value === false
  )
    //console.log($api.loggedIn.value, $api.config.redirect.logout, to.path)
        //alert(JSON.stringify( $api.config.redirect))
  return navigateTo($api.config.redirect.logout)

})
