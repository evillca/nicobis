<template>
  <div class="backgroundGrey">
    <!-- Barra Busqueda -->
    <v-row class="offset-md-1 pt-4 mt-0 px-6">
      <v-col cols="4" sm="3" md="2" offset-md="1" class="pr-0 mr-0">
        <v-select
          v-model="filtroList"
          height="48"
          :items="categoriasList"
          label="buscar todo"
          outlined
          item-text="nombre_categoria"
          item-value="slug_categoria"
          dense
          background-color="#EDF4FF"
          no-data-text="Datos no disponibles"
          style="border-top-left-radius: 20px; border-bottom-left-radius: 20px"
          :menu-props="{ bottom: true, offsetY: true }"
        >
          <template #prepend-inner>
            <v-icon v-if="filtroList.length == 0" class="mt-0">
              mdi-filter-variant
            </v-icon>
          </template>
          <template slot="selection" slot-scope="data">
            <v-icon class="mx-3" small
              >fa {{ data.item.icono_categoria }}</v-icon
            >
            {{ data.item.nombre_categoria }}
          </template>
          <template slot="item" slot-scope="data">
            <v-icon class="mx-3" small
              >fa {{ data.item.icono_categoria }}</v-icon
            >
            {{ data.item.nombre_categoria }}
          </template>
        </v-select>
      </v-col>
      <v-col cols="6" sm="4" class="pl-0 ml-0">
        <v-text-field
          v-model="cadenaBusqueda"
          dense
          outlined
          height="48"
          placeholder="Escribe lo que estás buscando"
          style="
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
            padding-bottom: -4px;
          "
          :error-messages="
            filtroClick && cadenaBusqueda == '' && filtroList.length === 0
              ? 'Escribe o selecciona algo para buscar'
              : ''
          "
          @keydown.enter="filtrar"
        >
        </v-text-field>
      </v-col>
      <v-col cols="1" sm="2" style="margin-left: -4.5em">
        <v-btn
          depressed
          color="#377dff"
          class="white--text"
          height="48"
          rounded
          dense
          @click="filtrar"
        >
          <span class="font-weight-regular mx-4"> Buscar </span>
        </v-btn>
      </v-col>
    </v-row>
    <!-- Detalle -->
    <v-card-text class="white px-5">
      <v-row justify="center">
        <v-col cols="12" md="10" offset-md="2" class="pr-6">
          <p
            class="text-h4 text-md-h3 primary--text font-weight-bold text-left"
          >
            {{ detalleObjeto.titulo }}
          </p>
        </v-col>
        <!-- MULTIMEDIA -->
        <v-col cols="12" sm="8">
          <v-col cols="12" md="8" offset-md="3" class="mt-0 pt-0">
            <div class="over" style="width: 100%; max-height: 500px">
              <!-- TEXTO -->
              <img
                v-if="
                  detalleObjeto.tipo == 'texto' || detalleObjeto.tipo == 'audio'
                "
                :src="filesUrl + detalleObjeto.portada"
                alt="imagen_material"
                style="width: 95%"
              />
            </div>
            <!-- VIDEO -->
            <div
              v-if="
                detalleObjeto.tipo == 'video' &&
                playerOptions.sources.length > 0
              "
            >
              <!-- Inside videp player component -->
              <div
                v-video-player:myVideoPlayer="playerOptions"
                class="video-player-box"
                :playsinline="playsinline"
                @play="onPlayerPlay($event)"
                @pause="onPlayerPause($event)"
                @ended="onPlayerEnded($event)"
                @loadeddata="onPlayerLoadeddata($event)"
                @waiting="onPlayerWaiting($event)"
                @playing="onPlayerPlaying($event)"
                @timeupdate="onPlayerTimeupdate($event)"
                @canplay="onPlayerCanplay($event)"
                @canplaythrough="onPlayerCanplaythrough($event)"
                @ready="playerReadied"
                @statechanged="playerStateChanged($event)"
              ></div>
            </div>
          </v-col>
          <!-- END MULTIMEDIA -->
          <v-row justify="start" class="px-6 pt-4">
            <v-card-text class="pt-0 mt-0">
              <v-col cols="12" md="8" offset-md="3" class="mt-4">
                <h1 class="primary--text" style="letter-spacing: 0px">
                  Resumen
                </h1>
              </v-col>
              <v-col cols="12" md="8" offset-md="3">
                <p>
                  {{ detalleObjeto.resumen }}
                </p>
              </v-col>
            </v-card-text>
          </v-row>
        </v-col>
        <!-- Seccion descargas -->
        <v-col cols="10" offset="1" offset-sm="0" sm="4">
          <v-row>
            <v-col cols="12">
              <v-chip class="black white--text">
                <span class="font-weight-bold">{{ detalleObjeto.forma }}</span>
              </v-chip>
            </v-col>
            <!-- AUDIO -->
            <v-col v-if="detalleObjeto.tipo == 'audio'" cols="12">
              <audio controls>
                <source :src="filesUrl + detalleObjeto.src" type="audio/mpeg" />
                El navegador no soporta el contenido
              </audio>
            </v-col>
            <v-col cols="12" class="pr-6">
              <p style="letter-spacing: -0.5px; font-size: 1.3em">
                <span class="font-weight-bold">Titulo:</span>
                {{ detalleObjeto.titulo }}
              </p>
              <p style="letter-spacing: -0.5px; font-size: 1.3em">
                <span class="font-weight-bold">Año:</span>
                {{ detalleObjeto.anio }}
              </p>
              <p style="letter-spacing: -0.5px; font-size: 1.3em">
                <span class="font-weight-bold">Licencia:</span>
                {{ detalleObjeto.licencia }}
              </p>
              <div v-for="(elem, i) in detalleObjeto.atributos" :key="i">
                <p style="letter-spacing: -0.5px; font-size: 1.3em">
                  <span class="font-weight-bold">{{ elem.atributo }}:</span>
                  <span>{{ elem.detalle }}</span>
                </p>
              </div>
            </v-col>
            <v-col cols="12" sm="12" class="pb-0">
              <v-btn
                depressed
                outlined
                rounded
                color="primary"
                @click="descargarArchivo"
              >
                Descargar
                <v-icon small class="ml-2"> fa fa-download</v-icon>
              </v-btn>
            </v-col>
            <v-col cols="12" sm="12">
              <v-btn
                depressed
                outlined
                rounded
                color="primary"
                @click="dialog = true"
              >
                Compartir
                <v-icon small class="ml-2"> fa fa-share</v-icon>
              </v-btn>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-card-text>
    <v-dialog v-model="dialog" width="500">
      <v-card class="mb-4 pb-2">
        <v-card-title> Compartir en </v-card-title>
        <v-card-text>
          <v-row justify="center" class="text-center mt-6">
            <v-col>
              <ShareNetwork
                network="facebook"
                :url="currentUrl"
                :title="detalleObjeto.titulo"
                :description="detalleObjeto.resumen"
              >
                <v-btn depressed icon color="#1779f2">
                  <v-icon large> fa fa-facebook </v-icon>
                </v-btn>
                <br />
                <p class="mt-2 grey--text">Facebook</p>
              </ShareNetwork>
            </v-col>
            <v-col>
              <ShareNetwork
                network="twitter"
                :url="currentUrl"
                :title="detalleObjeto.titulo"
                :description="detalleObjeto.resumen"
              >
                <v-btn depressed icon color="#1C9CEA">
                  <v-icon large> fa fa-twitter </v-icon>
                </v-btn>
                <br />
                <p class="mt-2 grey--text">Twitter</p>
              </ShareNetwork>
            </v-col>
            <v-col>
              <v-btn depressed icon color="brown" @click="copiarClipboard">
                <v-icon large> fa fa-clipboard </v-icon>
              </v-btn>
              <br />
              <p
                class="mt-2"
                style="cursor: pointer; color: grey"
                @click="copiarClipboard"
              >
                Copiar enlace
              </p>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions class="my-6">
          <v-row justify="end">
            <v-btn depressed text @click="dialog = false"> Cerrar </v-btn>
          </v-row>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categoriasList: [],
      cadenaBusqueda: '',
      filtroList: [],
      filesUrl: `${this.$config.baseURLFiles}/`,
      detalleObjeto: {
        slug: '',
        titulo: '',
        anio: '',
        fecha: '',
        licencia: '',
        resumen: '',
        forma: '',
        tipo: '',
        portada: '',
        src: '',
        atributos: null
      },
      flagUrl: false,
      downloadUrl: '',
      // Video data
      playsinline: true,

      // videojs options
      playerOptions: {
        muted: false,
        language: 'es',
        playbackRates: [0.7, 1.0, 1.5, 2.0],
        sources: [
          {
            type: 'video/mp4',
            src: ''
          }
        ]
      },
      filtroClick: false,
      currentUrl: '',
      dialog: false
    }
  },
  mounted() {
    this.listarCategorias()
    this.listarDetalle()
    this.currentUrl = location.toString()
  },
  methods: {
    async listarDetalle() {
      await this.$axios
        .get(`/objetos/${this.$route.params.id}`)
        .then((response) => {
          console.log(response)
          this.detalleObjeto.slug = response.data.data[0]?.slug_objeto_digital
          this.detalleObjeto.titulo = response.data.data[0]?.titulo
          this.detalleObjeto.anio = response.data.data[0]?.año
          this.detalleObjeto.fecha = response.data.data[0]?.fecha
          this.detalleObjeto.licencia =
            response.data.data[0]?.licencia_objeto_digital
          this.detalleObjeto.resumen = response.data.data[0]?.resumen
          this.detalleObjeto.portada =
            response.data.data[0]?.ruta_portada_objeto_digital
          this.detalleObjeto.forma = response.data.data[0]?.nombre_forma
          this.detalleObjeto.tipo = response.data.data[0]?.slug_categoria
          // Para descargar
          const dataFile = JSON.parse(response.data.data[0].detalle_archivo)
          this.detalleObjeto.src = dataFile[0]?.url
          this.downloadUrl = this.filesUrl + dataFile[0]?.url

          if (dataFile[0]?.url && dataFile[0]?.url !== '-') {
            this.flagUrl = true
          }

          console.log(`Buscando file...`)
          console.log(this.filesUrl + this.detalleObjeto.src)
          this.playerOptions.sources[0].src = `${this.filesUrl}${this.detalleObjeto.src}`
          // Atributos
          this.detalleObjeto.atributos = JSON.parse(
            response.data.data[0].atributos
          )
        })
        .catch((error) => {
          console.log(error)
        })
    },
    filtrar() {
      this.filtroClick = true

      if (this.cadenaBusqueda === '' && this.filtroList.length === 0) {
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
    descargarArchivo() {
      try {
        if (this.flagUrl) {
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
    onPlayerPlay(player) {
      // console.log('player play!', player)
    },
    onPlayerPause(player) {
      // console.log('player pause!', player)
    },
    onPlayerEnded(player) {
      // console.log('player ended!', player)
    },
    onPlayerLoadeddata(player) {
      // console.log('player Loadeddata!', player)
    },
    onPlayerWaiting(player) {
      // console.log('player Waiting!', player)
    },
    onPlayerPlaying(player) {
      // console.log('player Playing!', player)
    },
    onPlayerTimeupdate(player) {
      // console.log('player Timeupdate!', player.currentTime())
    },
    onPlayerCanplay(player) {
      // console.log('player Canplay!', player)
    },
    onPlayerCanplaythrough(player) {
      // console.log('player Canplaythrough!', player)
    },
    // or listen state event
    playerStateChanged(playerCurrentState) {
      console.log('player current update state', playerCurrentState)
    },
    // player is ready
    playerReadied(player) {
      console.log('example 01: the player is readied', player)
    },
    copiarClipboard() {
      navigator.clipboard.writeText(this.currentUrl)
      this.$toast.success(`Enlace copiado en el portapapeles`)
    }
  }
}
</script>

<style lang="css">
.container {
  width: 100%;
  margin: 0px auto;
}
#video {
  max-width: 100%;
  height: auto;
}
.video-js {
  width: auto !important;
  height: 400px !important;
}
</style>
