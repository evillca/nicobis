<template>
  <v-container fluid class="backgroundGrey">
    <!-- Banner Buscador -->
    <v-row style="height: 63vh" align="center">
      <v-card-text>
        <v-row justify="center" align="end">
          <v-col cols="12" class="animate__animated animate__fadeIn">
            <v-row
              class="font-weight-bold primary--text text-principal pl-3"
              justify="center"
            >
              Biblioteca Virtual de lenguas
            </v-row>
          </v-col>
          <v-col cols="12" class="pt-0 animate__animated animate__fadeIn">
            <div
              class="text-center font-weight-bold primary--text text-principal"
            >
              y culturas de Bolivia
            </div>
          </v-col>
          <p class="text-h6 text-md-h5 text-center">
            <span class="font-weight-regular" style="letter-spacing: -1px">
              Encuentra lo que estás buscando
            </span>
          </p>

          <v-col cols="12" class="mt-2">
            <v-row justify="start" justify-sm="center" align="start">
              <v-col cols="5" sm="3" md="2" offset-md="1">
                <v-select
                  v-model="filtroList"
                  height="48"
                  dense
                  :items="categoriasList"
                  item-text="nombre_categoria"
                  item-value="slug_categoria"
                  placeholder="buscar todo"
                  outlined
                  no-data-text="Datos no disponibles"
                  style="
                    border-top-left-radius: 35px;
                    border-bottom-left-radius: 35px;
                  "
                  background-color="#EDF4FF"
                  :menu-props="{ bottom: true, offsetY: true }"

                >
                  <template #prepend-inner>
                    <v-icon v-if="filtroList.length==0" class="mt-0"> mdi-filter-variant </v-icon>
                  </template>
                  <template slot="selection" slot-scope="data">
                    <v-icon class="mx-3" small>fa {{ data.item.icono_categoria }}</v-icon
                    >
                    {{ data.item.nombre_categoria }}
                  </template>
                  <template slot="item" slot-scope="data">
                    <v-icon class="mx-3" small>fa {{ data.item.icono_categoria }}</v-icon>
                    {{ data.item.nombre_categoria }}
                  </template>
                </v-select>

              </v-col>
              <img
                class="mt-3"
                src="@/assets/img/barra_vertical.png"
                alt=""
                style="
                  width: auto;
                  height: 48px;
                  margin-left: -14px;
                  z-index: 100;
                "
              />

              <v-col cols="6" sm="5" md="3" style="margin-left: -14px">
                <v-text-field
                  v-model="cadenaBusqueda"
                  height="48"
                  dense
                  outlined
                  placeholder="Escribe lo que estás buscando"
                  background-color="#fff"
                  :error-messages="
                    filtroClick && cadenaBusqueda == '' && filtroList.length < 1
                      ? 'Escribe o selecciona algo para buscar'
                      : ''
                  "
                  style="
                    border-top-right-radius: 35px;
                    border-bottom-right-radius: 35px;
                  "
                  @keydown.enter="filtrar"
                >
                </v-text-field>
              </v-col>
              <v-col cols="2" sm="2" style="margin-left: -4.5em">
                <v-btn
                  color="#377dff"
                  class="white--text"
                  rounded
                  height="48"
                  @click="filtrar"
                >
                  <span class="font-weight-regular mx-0 mx-md-4"> Buscar </span>
                </v-btn>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-card-text>
    </v-row>
    <!-- Materiales -->
    <v-row align="start" class="mt-12 pt-12 mb-6">
      <v-col cols="12" class="mb-6 mt-12 pt-12">
        <v-row justify="center" class="mb-3">
          <span class="text-h4 text-sm-h2 primary--text font-weight-bold">
            Materiales
          </span>
        </v-row>
        <v-row justify="center">
          <div style="height: 10px" class="over">
            <img
              class="center"
              src="@/assets/img/barra_materiales.png"
              alt="barra"
              style="width: 100%; background-size: cover"
            />
          </div>
        </v-row>
      </v-col>
      <v-col
        v-for="(item, index) in publicosList"
        :key="index"
        cols="12"
        md="4"
        class="my-3 animate__animated animate__fadeIn"
      >
        <v-row justify="center">
          <v-card
            class="rounded-xl text-center over"
            max-width="320"
            elevation="0"
          >
            <v-row class="pb-4 mb-4">
              <v-col cols="12" class="py-0">
                <v-row justify="center">
                  <nuxt-link :to="`/materiales/${item.slug_publico}`">
                    <v-row style="height: 190px" class="over" justify="center">
                      <img
                        class="center"
                        :src="filesUrl + item.ruta_imagen_home_publico"
                        alt="imagen"
                        style="width: 100%; background-size: cover"
                      />
                    </v-row>
                  </nuxt-link>
                  <div style="width: 100%; heigth: 7px" class="over">
                    <img
                      src="@/assets/img/barra_2.png"
                      style="height: 100%; background-size: cover"
                      alt="barra_uno"
                    />
                  </div>
                </v-row>
              </v-col>
              <v-col cols="12" class="mt-3 mb-0">
                <nuxt-link :to="`/materiales/${item.slug_publico}`">
                  <span
                    class="text-h5 text-md-h4 font-weight-bold text-center primary--text"
                  >
                    {{ item.nombre_publico }}
                  </span>
                </nuxt-link>
              </v-col>
              <v-col cols="12" class="pt-0 mt-0">
                <span
                  class="text-md-h6 text-center font-weight-regular px-2"
                  style="line-height: 1"
                >
                  {{ item.descripcion_publico }}
                </span>
              </v-col>
            </v-row>
          </v-card>
        </v-row>
      </v-col>
    </v-row>

    <!-- Coleccion Especiales -->
    <v-row class="primary mt-1 mb-0 py-6 mx-0">
      <v-card-text>
        <v-row>
          <v-col class="mt-6">
            <p
              class="text-h4 text-md-h3 font-weight-bold text-center white--text"
            >
              Colección especial del mes
            </p>
            <p
              v-if="coleccionesList.length > 0"
              class="text-h5 text-md-h3 font-weight-bold text-center white--text"
            >
              {{ tituloColeccion }}
            </p>
          </v-col>
        </v-row>
        <v-row class="col-12 col-md-10 offset-md-1" justify="center">
          <v-col
            v-for="(item, index) in coleccionesList"
            :key="index"
            cols="12"
            lg="4"
            class="my-4 px-4"
          >
            <v-row v-if="index < 3" class="px-2">
              <v-col cols="6">
                <v-row justify="center" justify-md="end">
                  <div style="height: 210px" class="overflow-h">
                    <nuxt-link :to="`/material/${item.slug_objeto_digital}`">
                      <img
                        :src="filesUrl + item.ruta_portada_objeto_digital"
                        alt=""
                        style="
                          height: 100%;
                          border-radius: 10px;
                          background-size: cover;
                        "
                      />
                    </nuxt-link>
                  </div>
                </v-row>
              </v-col>
              <v-col cols="6">
                <nuxt-link :to="`/material/${item.slug_objeto_digital}`">
                  <p
                    class="text-left white--text title font-weight-regular"
                    style="line-height: 23px"
                  >
                    {{ item.titulo }}
                  </p>
                </nuxt-link>
                <v-btn-toggle multiple rounded>
                  <v-btn
                    depressed
                    color="white"
                    rounded
                    small
                    class="my-1"
                    @click="verDetalle(item.slug_objeto_digital)"
                  >
                    <v-icon color="primary" small> fa fa-eye </v-icon>
                  </v-btn>
                  <v-btn
                    depressed
                    color="white"
                    rounded
                    small
                    class="my-1"
                    @click="descargar(item)"
                  >
                    <v-icon color="primary" small> fa fa-download </v-icon>
                  </v-btn>
                </v-btn-toggle>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
        <v-col cols="12">
          <v-row class="mt-1" justify="center">
            <nuxt-link :to="`colecciones/${slugColeccion}`">
              <v-btn rounded color="white" class="primary--text mb-5" x-large>
                <span
                  class="text-h6 text-md-3 font-weight-bold text-lowercase px-6"
                  >ver colección completa</span
                >
              </v-btn>
            </nuxt-link>
          </v-row>
        </v-col>
      </v-card-text>
    </v-row>
    <div class="barra-dos" />

    <!-- Las 36 culturas -->
    <v-row class="my-6 pt-6 mb-3 mx-0 px-0">
      <v-row justify="center" class="mb-7">
        <v-col cols="12" class="mt-3">
          <p
            class="text-h5 text-md-h3 text-center primary--text font-weight-bold"
          >
            Las culturas de Bolivia
          </p>
          <v-col cols="12" class="my-1 py-1">
            <v-row justify="center">
              <img
                class="mt-0 pt-0"
                src="@/assets/img/barra_2.png"
                style="width: 320px; height: 10px"
                alt=""
              />
            </v-row>
          </v-col>
          <p class="text-subtitle-2 text-md-h6 text-center font-weight-regular">
            Descubre los materiales de cada una de las naciones bolivianas
          </p>
        </v-col>
      </v-row>

      <!-- lg -->
      <div class="cultura-large mt-4">
        <v-row justify="center">
          <v-row class="mx-5 px-5 mx-6 over" justify="center">
            <div
              v-for="(item, index) in culturasList"
              :key="index"
              class="cultura-imagen over mb-8 mx-2"
              style="
                height: 100px;
                width: 175px;
                border-radius: 15px;
                position: relative;
                text-align: center;
                color: white;
              "
            >
              <nuxt-link :to="`/culturas/${item.slug_cultura}`">
                <img
                  v-if="item.ruta_imagen_home_cultura"
                  style="
                    width: 100%;
                    border-radius: 15px;
                    background-size: cover;
                  "
                  :src="filesUrl + item.ruta_imagen_home_cultura"
                />

                <div
                  class="centered"
                  style="
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 100%;
                  "
                >
                  <div style="background: #ffffffee; color: black">
                    <strong>
                      {{ item.nombre_cultura }}
                    </strong>
                  </div>
                </div>
              </nuxt-link>
            </div>
          </v-row>
        </v-row>
      </div>
      <!-- sm -->
      <div class="cultura-carrousel">
        <v-card-text>
          <v-row justify="center" class="px-6 mb-2">
            <v-col v-for="(item, index) in culturasList" :key="index">
              <v-row justify="center" class="pa-1">
                <nuxt-link :to="`/culturas/${item.slug_cultura}`">
                  <v-btn small rounded-sm color="white" class="black--text">
                    {{ item.nombre_cultura }}
                  </v-btn>
                </nuxt-link>
              </v-row>
            </v-col>
          </v-row>
        </v-card-text>
      </div>
      <v-col cols="12 py-4"></v-col>
    </v-row>
    <!-- Videos, audios, textos -->
    <br />

    <div class="barra-tres mt-6" />
    <v-row class="primary mt-0 mx-0">
      <v-col cols="12" class="py-6 my-3"></v-col>
      <v-col cols="12" class="py-6 my-3"></v-col>

      <v-row justify="center" class="py-6">
        <div
          v-for="(item, index) in categoriasList"
          :key="index"
          class="mx-12 my-3"
        >
          <nuxt-link :to="`/busqueda?categorias=${item.slug_categoria}`">
            <v-btn text>
              <v-icon style="font-size: 6em" class="white--text">
                fa
                {{
                  item.icono_categoria
                    ? item.icono_categoria
                    : 'fa-check-square'
                }}
              </v-icon>
            </v-btn>
          </nuxt-link>

          <p class="pt-6 text-center white--text mt-5 font-weight-light">
            {{ item.nombre_categoria }}
          </p>
        </div>
      </v-row>
      <v-col cols="12" class="py-3"></v-col>
      <v-col cols="12" class="py-3"></v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      categoriasList: [],
      publicosList: [],
      culturasList: [],
      coleccionesList: [],
      tituloColeccion: '',
      slugColeccion: '',
      filtroList: [],
      filesUrl: `${this.$config.baseURLFiles}/`,
      cadenaBusqueda: '',
      filtroClick: false,
      downloadUrl: ''
    }
  },
  mounted() {
    this.listarPublicos()
    this.listarCategorias()
    this.listarCulturas()
    this.listarColecciones()
  },
  methods: {
    async listarCategorias() {
      await this.$axios
        .get('/categorias/')
        .then((response) => {
          this.categoriasList = response.data.data
        })
        .catch((error) => {
          console.log(error)
        })
    },
    async listarPublicos() {
      await this.$axios
        .get('/publicos/')
        .then((response) => {
          this.publicosList = response.data.data
        })
        .catch((error) => {
          console.log(error)
        })
    },
    async listarCulturas() {
      await this.$axios
        .get('/culturas/')
        .then((response) => {
          this.culturasList = response.data.data
        })
        .catch((error) => {
          console.log(error)
        })
    },
    async listarColecciones() {
      await this.$axios
        .get('/colecciones/principales')
        .then((response) => {
          if (response.data.data.length > 0) {
            this.tituloColeccion = response.data.data[0].titulo_coleccion
            this.slugColeccion = response.data.data[0].slug_coleccion
            const params = {
              colecciones: response.data.data[0].slug_coleccion
            }
            this.$axios.get('/objetos', { params }).then((resp) => {
              resp.data.data.data.forEach((elem, index) => {
                if (index < 3) {
                  this.coleccionesList.push(elem)
                }
              })
            })
          }
        })
        .catch((error) => {
          console.log(error)
        })
    },
    filtrar() {
      this.filtroClick = true
      if (this.cadenaBusqueda === '' && this.filtroList.length < 1) {
        return
      }
      if (this.filtroList.length > 0) {
        this.$router.push(
          `/busqueda?categorias=${this.filtroList}&search=${this.cadenaBusqueda}`
        )
      } else {
        this.$router.push(`/busqueda?search=${this.cadenaBusqueda}`)
      }
    },
    verDetalle(elem) {
      this.$router.push(`/material/${elem}`)
    },
    descargar(elem) {
      console.log(`Descargando...`)
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
    }
  }
}
</script>
<style></style>
