<template>
  <div>
    <v-card-text>
      <v-row justify="center" align="start">
        <v-col cols="12" sm="2" class="pr-0 mr-0">
          <v-select
            height="48"
            item-text="text"
            item-value="value"
            :items="filtroBusquedaList"
            label="buscar todo"
            outlined
            dense
            background-color="#EDF4FF"
            no-data-text="Datos no disponibles"
            style="
              border-top-left-radius: 20px;
              border-bottom-left-radius: 20px;
            "
          >
          </v-select>
        </v-col>
        <v-col cols="5" sm="4" class="pl-0 ml-0">
          <v-text-field
            dense
            outlined
            height="48"

            placeholder="Escribe lo que estás buscando"
            style="
              border-top-right-radius: 20px;
              border-bottom-right-radius: 20px;
              padding-bottom:-4px ;
            "
          >
          </v-text-field>
        </v-col>
        <v-col cols="3" sm="2" style="margin-left: -6em">
          <v-btn depressed color="#377dff" class="white--text" height="48" rounded dense>
            <span class="font-weight-regular mx-4"> Buscar </span>
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
      filter: '',
      filtroBusquedaList: [
        {
          text: 'video',
          value: 'video'
        },
        {
          text: 'audio',
          value: 'audio'
        },
        {
          text: 'texto',
          value: 'texto'
        }
      ]
    }
  }
}
</script>

<style></style>
