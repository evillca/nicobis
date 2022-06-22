<template>
  <div>
    <v-row justify="center" class="pa-0">
      <v-col
        cols="12"
        sm="6"
        class="primary mx-0 px-0"
        style="height: 225px; margin-top: -12px"
      >
        <v-row align="center" justify="end" class="pa-4" style="height: 100%">
          <span
            class="text-h2 text-md-h1 white--text font-weight-bold text-right mt-4 mr-6"
            >{{ titulo }}</span
          >
        </v-row>
      </v-col>

      <v-col cols="12" sm="6" class="ma-0 pa-0">
        <v-row justify="center" align="center">
          <v-col cols="12" class="px-0 mx-0">
            <v-row>
              <v-col cols="1" class="px-0 mx-0">
                <v-row justify="center" align="center" class="px-0 mx-0">
                  <div
                    style="
                      height: 225px;
                      overflow: hidden;
                      background: silver;
                      z-index: 100;
                      padding-left: -120px;
                    "
                  >
                    <img
                      src="@/assets/img/barra_vertical.png"
                      style="height: 305px; width: 38px; background-size: cover"
                    />
                  </div>
                </v-row>
              </v-col>
              <v-col cols="11" class="px-0 mx-0" style="background: grey">
                <v-row justify="start" align="center" class="px-0 mx-0">
                  <div
                    style="
                      height: 225px;
                      background: silver;
                      margin-left: -25px;
                      display: flex;
                      align-items: center;
                      width: 100%;
                    "
                    class="over"
                  >
                    <img
                      :src="filesUrl + imgBanner"
                      style="width: 100%; background-size: cover"
                      alt=""
                    />
                  </div>
                </v-row>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <!-- Barra de filtros -->
    <div class="backgroundGrey">
      <br />
      <v-row class="offset-md-1 pt-4 mt-0 px-4" justify="start" align="start">
        <v-col cols="9" sm="7" md="8">
          <v-text-field
            v-model="cadenaBusqueda"
            dense
            rounded
            outlined
            placeholder="Escribe lo que estás buscando"
            background-color="white"
            height="32">
          </v-text-field>
        </v-col>
        <v-col cols="3" sm="1">
          <v-btn
            color="#377dff"
            class="white--text"
            rounded
            style="margin-left: -110px"
            height="39"
            @click="filtrar"
          >
            <span class="font-weight-regular mx-3">Buscar </span>
          </v-btn>
        </v-col>
      </v-row>
     <!-- Botones filtros categorias -->
    <v-row
      class="offset-md-1 pt-0 pb-4 mt-0 px-4"
      justify="start"
      align="center"
    >
      <v-col class="mt-0 pt-0">
        <span v-for="(item, index) in categoriasList" :key="index">
          <span v-if="estaEnFiltros(item)">
            <v-btn
              rounded
              color="#edf4db"
              depressed
              style="border: 1px solid lightgrey"
              class="py-5"
              @click="quitarDeFiltros(item)"
            >
              <span class="font-weight-regular text-capitalize">
                {{ item.nombre_categoria }} X
              </span>
            </v-btn>
          </span>
          <span v-if="!estaEnFiltros(item)">
            <v-btn
              rounded
              depressed
              style="border: 1px solid lightgrey"
              class="py-5 grey--text"
              @click="agregarAFiltros(item)"
            >
              <span class="font-weight-regular text-capitalize">
                {{ item.nombre_categoria }} +
              </span>
            </v-btn>
          </span>
        </span>
      </v-col>
    </v-row>
    </div>
    <br />
    <!-- Contenido -->
    <v-card-text>
      <v-row>
        <v-col cols="11">
          <v-row justify="center" justify-md="start" class="my-6">
            <v-col
              v-for="(item, index) in contenidoList"
              :key="index"
              cols="12"
              md="6"
              class="animate__animated animate__fadeIn"
            >
              <v-row>
                <v-col cols="12" offset-md="2" md="8">
                  <v-row
                    align="start"
                    class="mb-6"
                    justify="center"
                    justify-md="start"
                  >
                    <v-col cols="10" offset="1" offset-md="0" md="7">
                      <v-row>
                        <v-col cols="12">
                          <nuxt-link
                            :to="`/material/${item.slug_objeto_digital}`"
                          >
                            <div
                              style="
                                width: 100%;
                                height: 240px;
                                border-radius: 20px;
                              "
                              class="over"
                            >
                              <img
                                :src="
                                  filesUrl + item.ruta_portada_objeto_digital
                                "
                                alt=""
                                style="
                                  height: 100%;
                                  background-size: cover;
                                  border-radius: 20px;
                                "
                              />
                            </div>
                          </nuxt-link>
                        </v-col>
                      </v-row>
                    </v-col>
                    <v-col cols="10" offset="2" offset-md="0" md="5">
                      <div class="ml-6">
                        <v-row align="start" justify="start" class="mt-0 pt-0"
                          ><v-chip class="black white--text">
                            <span class="font-weight-bold">
                              {{ item.slug_categoria }}
                            </span>
                          </v-chip></v-row
                        >
                        <v-row align="start" justify="start" class="mt-6">
                          <nuxt-link
                            :to="`/material/${item.slug_objeto_digital}`"
                          >
                            <span
                              class="primary--text text-h5 mt-2 font-weight-bold"
                            >
                              {{ item.titulo }}
                            </span>
                          </nuxt-link>
                        </v-row>
                        <v-row align="start" justify="start" class="mt-3">
                          <small>
                            <span class="textoCortado">
                              {{ item.resumen }}
                            </span>
                          </small>
                        </v-row>
                        <v-row class="mt-4">
                          <v-btn-toggle multiple rounded>
                            <v-btn
                              depressed
                              outlined
                              rounded
                              color="primary"
                              @click="verDetalle(item.slug_objeto_digital)"
                            >
                              <v-icon color="primary" small class="ml-2">
                                fa fa-eye</v-icon
                              >
                            </v-btn>
                            <v-btn depressed outlined rounded color="primary" @click="descargar(item)">
                              <v-icon color="primary" small class="ml-2">
                                fa fa-download</v-icon
                              >
                            </v-btn>
                          </v-btn-toggle>
                        </v-row>
                      </div>
                    </v-col>
                  </v-row>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="1"></v-col>
      </v-row>
    </v-card-text>

    <!-- Paginador -->
   <v-card-text>
      <v-row justify="start" v-if="paginadoSize>0">
        <v-col cols="11" offset="1">
          <v-btn
            v-if="current_section != 0"
            class="mr-2"
            :color="'grey'"
            style="border-radius: 10px; padding: 27px 10px"
            depressed
            @click="reducirSeccion()"
          >
            <span class="text-h4 white--text">&lt;</span>
          </v-btn>
          <span v-for="(item, index) in current_section + 3" :key="index">
            <v-btn
              v-if="index < 3 && 3 * current_section + (index + 1) <= paginadoSize"
              class="mr-2"
              :color=" 3 * current_section + (index + 1) == current_page ? 'primary' : 'grey'"
              style="border-radius: 10px; padding: 27px 10px"
              depressed
              @click="getPage(3 * current_section + (index + 1))"
            >
              <span class="text-h4 white--text">{{
                3 * current_section + (index + 1)
              }}</span>
            </v-btn>
          </span>
          <v-btn
            v-if="current_section < maxSections"
            class="mr-2"
            :color="'grey'"
            style="border-radius: 10px; padding: 27px 10px"
            depressed
            @click="aumentarSeccion()"
          >
            <span class="text-h4 white--text">&gt;</span>
          </v-btn>
        </v-col>
      </v-row>
    </v-card-text>
  </div>
</template>

<script>
export default {
  data() {
    return {
      scrollTo : 0,
      categoriasList: [],
      contenidoList: [],
      titulo: '',
      filesUrl: `${this.$config.baseURLFiles}/`,
      imgBanner: '',
      cadenaBusqueda: '',
      toggleFiltros: [],
      downloadUrl: '',
      paginadoSize: 0,
      current_page: 1,
      current_section: 0,
      maxSections: 0,
      filtroCategorias: []
    }
  },
  mounted() {
    this.listarCabecera()
    this.listarCategorias()
    this.cadenaBusqueda = this.$route.query.search
      ? this.$route.query.search
      : ''

    if(this.$route.query.categorias){
      console.log(this.$route.query.categorias);
      this.filtroCategorias.push(this.$route.query.categorias)
    }

    this.listarContenido()
    this.maxSections = parseInt(this.paginadoSize / 3)
  },
  methods: {
    async listarCabecera() {
      await this.$axios
        .get(`/culturas/${this.$route.params.id}`)
        .then((response) => {
          console.log(response.data.data)
          this.titulo = response.data.data[0].nombre_cultura
          this.imgBanner = response.data.data[0].ruta_imagen_listado_cultura
            ? response.data.data[0].ruta_imagen_listado_cultura
            : response.data.data[0].ruta_imagen_home_cultura
          console.log(response)
        })
        .catch((error) => {
          console.log(error)
        })
    },
    async listarContenido() {
      let params = {
        culturas: this.$route.params.id,
        page: this.current_page
      }
      if (this.cadenaBusqueda !== '') {
        params = { ...params, search: this.cadenaBusqueda }
      }
     if (this.filtroCategorias.length > 0) {
        params = { ...params, categorias: this.filtroCategorias.toString() }
      }
      await this.$axios
        .get(`/objetos`, { params })
        .then((response) => {
          this.contenidoList = response.data.data.data
        // Paginado
          let totalPages = parseInt(
            response.data.data.total / response.data.data.per_page
          )
          if (response.data.data.total % response.data.data.per_page !== 0) {
            totalPages++
          }
          this.paginadoSize = totalPages

          this.maxSections = parseInt(this.paginadoSize / 3)
          this.$vuetify.goTo(this.scrollTo)
        })
        .catch((error) => {
          console.log(error)
        })
    },
    async listarCategorias() {
      console.log(`Listando categorias`)
      await this.$axios
        .get('/categorias/')
        .then((response) => {
          this.categoriasList = response.data.data
        })
        .catch((error) => {
          console.log(error)
        })
    },
    filtrar() {
      this.current_page = 1;
      this.current_section = 0;
      this.listarContenido()
    },
    getPage(page) {
      this.current_page = page
      this.listarContenido()
    },
    verDetalle(elem) {
      this.$router.push(`/material/${elem}`)
    },
    descargar(elem) {
      try {
        const dataFile = JSON.parse(elem.detalle_archivo)
        this.downloadUrl = this.filesUrl + dataFile[0]?.url

         if (dataFile[0]?.url !== '-') {
          console.log(`Descargando...`)
          console.log(this.downloadUrl)
          window.open(this.downloadUrl, '_blank')
        } else {
          this.$toast.error(`No se encontró el recurso`)
        }
      } catch (error) {
        console.log(error)
        this.$toast.error(`Ocurrió un error al descargar`)
      }
    },
    reducirSeccion() {
      if (this.current_section > 0) {
         this.current_section--
        this.current_page = 3 * this.current_section + 1;
         this.listarContenido();
      }
    },
    aumentarSeccion() {
      this.current_section++
      this.current_page = 3 * this.current_section + 1;
      this.listarContenido();
    },
    estaEnFiltros(elem) {
      let flag = false
      this.filtroCategorias.forEach((cat) => {
        if (cat === elem.slug_categoria) {
          flag = true
        }
      })
      return flag
    },
    agregarAFiltros(elem) {
      this.filtroCategorias.push(elem.slug_categoria)
      this.filtrar()
    },
    quitarDeFiltros(elem) {
      this.filtroCategorias.forEach((item, index) => {
        if (item === elem.slug_categoria) {
          this.filtroCategorias.splice(index, 1)
        }
      })
      this.filtrar()
    }
  }
}
</script>

<style></style>
