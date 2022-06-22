<template>
  <div class="backgroundGrey">
    <v-card-text class="pb-12 px-2 px-md-6">
      <v-row
        justify="space-around"
        justify-sm="center"
        align="center"
        class="mt-6"
      >
        <v-col cols="4" sm="5" class="mb-6">
          <nuxt-link to="/">
            <v-row justify="center" justify-md="start" class=" col-10 offset-md-1" >

              <img
                src="@/assets/img/logo_ipelc.png"
                alt="logo_ipelc"
                style="max-height: 90px"
                class="ml-4"
              />

            </v-row>
          </nuxt-link>
        </v-col>
        <v-col cols="6" sm="6">
          <v-row align="center" justify="center" justify-sm="end" class="mr-1 mr-md-4">
            <a href="https://www.ipelc.gob.bo/" target="_blank">
              <h2 style="display: inline; color: #377dff">ipelc.gob.bo</h2>
            </a>
            <img
              class="ml-3"
              src="@/assets/img/barra_header.png"
              alt="barra_header"
              style="height: 55px"
            />
            <div class="mt-4 mt-sm-0">
            <a href="https://www.facebook.com/ipelc.gob.bo/" target="_blank">
              <v-btn class="ml-2" icon color="blue darken-1">
                <v-icon>fa fa-facebook</v-icon>
              </v-btn>
            </a>
            <a href="https://twitter.com/ipelc_bolivia" target="_blank">
              <v-btn class="ml-2" icon color="blue darken-1">
                <v-icon>fa fa-twitter</v-icon>
              </v-btn>
            </a>
            </a>
            <a href="https://www.youtube.com/user/IPELCbolivia" target="_blank">
            <v-btn class="ml-2" icon color="blue darken-1">
              <v-icon>fa fa-youtube-play</v-icon>
            </v-btn>
            </a>
            </div>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
  </div>
</template>

<script>
export default {
  data() {
    return {
      key: ''
    }
  }
}
</script>

<style></style>
