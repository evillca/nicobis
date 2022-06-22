<template>
  <v-app>
    <v-row align="space-around">
      <v-col cols="12" class="pa-0 ma-0">
        <v-row class="ma-0 pa-0">
          <v-col cols="12" class="ma-0 pa-0">
            <Header></Header>
          </v-col>
        </v-row>
        <v-row class="ma-0 pa-0">
          <v-col cols="12" class="ma-0 pa-0">
            <Nuxt />
          </v-col>
        </v-row>
        <v-row class="ma-0 pa-0">
          <v-col cols="12" class="ma-0 pa-0">
            <Footer></Footer>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-app>
</template>

<script>
import Header from '../components/layout/Header.vue'
import Footer from '../components/layout/Footer.vue'

export default {
  components: {
    Header,
    Footer
  },
  data() {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      items: [
        {
          icon: 'mdi-apps',
          title: 'Welcome',
          to: '/'
        },
        {
          icon: 'mdi-chart-bubble',
          title: 'Inspire',
          to: '/inspire'
        }
      ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: 'Vuetify.js'
    }
  }
}
</script>
