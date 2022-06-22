<template>
  <div class="backgroundGray">
    <v-card-text>
      <v-row
        justify="center"
        justify-md="space-around"
        align="center"
        class="py-2 mx-0 my-4"
      >
        <v-col cols="12" md="4" class="mb-3">
          <nuxt-link to="/">
          <v-row justify="center">
            <img
              src="@/assets/img/logo_ipelc.png"
              alt="logo_ipelc"
              style="max-width: 100px"
            />
          </v-row>
          </nuxt-link>

        </v-col>
        <v-col cols="5" md="4">
          <v-row
            class="primary--text flex-column"
            justify="start"
            align="center"
          >
          <a href="https://prensa.ipelc.gob.bo/Institutos-de-lengua-y-culturas" target="_blank">
            <v-btn small class="title font-weight-bold text-capitalize" text color="primary">
              Nosotros
            </v-btn>
          </a>
          <a href="https://www.ipelc.gob.bo/page/contactanos/" target="_blank">
            <v-btn small class="title font-weight-bold text-capitalize" text color="primary">
              Contacto
            </v-btn>
          </a>
          <a href="https://ipelc.gob.bo/" target="_blank">
            <v-btn small class="title font-weight-bold text-capitalize" text color="primary">
              Web IPLC
            </v-btn>
          </a>
          </v-row>
        </v-col>
        <v-col cols="7" md="3">
          <v-row align="center" justify="center" justify-sm="end" class="mr-2">
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
      <v-row>
        <div class="barra-footer"></div>
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

<style>
.barra-footer {
  background: url('../../assets/img/barra_footer.png');
  background-size: auto;
  height: 10px;
  width: 100%;
}
</style>
