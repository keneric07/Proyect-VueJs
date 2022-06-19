<template>
  <div data-app class="row">
    <v-card class="col-12">
      <v-data-table
        :headers="headers"
        :items="jugadores"
        :search="search"
        sort-by="nombre_completo"
        loading
        loading-text="Cargando... Por favor espere"
      >
        
        <template v-slot:[`item.foto`]="{ item }">
          <figure class="alc-event-box-score__score-team-logo" >
            
            <img
              :src="item.foto"
              :alt="item.nombre_completo"
              style="max-width: 75px"
              
            />
            
          </figure>
        </template>
        
        <template v-slot:[`item.id`]="{ item }">

           <v-btn
            class="mx-2"
            fab
            dark
            small
            color="#22bb33"
            title="Ver jugador"
            @click="verJugador(item)"
            
          >
            <v-icon dark>mdi-account-search </v-icon>
          </v-btn>
        </template>
      </v-data-table>

     
      <!--MODAL POR JUGADOR-->
    <div id="modalDetalle" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="padding:60px">
      <h2>Detalles de Jugador</h2>
      
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group form-group--floating-label">
                    <input
                    readonly
                      id="nombre"
                      type="text"
                      class="form-control"
                      placeholder="Nombre"
                      name="nombre"
                      v-model="info.nombre_completo"/>
                    <label class="control-label" for="nombre">Nombre</label>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group form-group--floating-label">
                    <input
                    readonly
                      type="text"
                      class="form-control"
                      id="apellido"
                      placeholder="Apellido"
                      name="apellido"
                      v-model="info.apellido"
                    />
                    <label class="control-label" for="apellido">Apellido</label>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group form-group--floating-label">
                    <input
                    readonly
                      type="text"
                      class="form-control"
                      id="cedula"
                      placeholder="Cédula"
                      name="cedula"
                      v-model="info.cedula"
                      />
                    <label class="control-label" for="cedula">Cédula</label>
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group form-group--floating-label">
                    <input
                    readonly
                      type="email"
                      class="form-control"
                      id="correo"
                      name="correo"
                      value="jugador.correo"
                      required
                      v-model="info.correo"
                    />
                    <label class="control-label" for="correo"
                      >Correo Electronico</label
                    >
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group form-group--floating-label">
                    <input
                    readonly
                      type="number"
                      class="form-control"
                      id="estatura"
                      placeholder="En Centímetros..."
                      name="estatura"
                      step="0.01"
                      v-model="info.estatura"
                     
                    />
                    <label class="control-label" for="estatura"
                      >Estatura(Centímetros)</label
                    >
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                  <div class="form-group form-group--floating-label">
                    <input
                    readonly
                      type="number"
                      class="form-control"
                      id="peso"
                      placeholder="En Kilogramos..."
                      name="peso"
                      step="0.01"
                       v-model="info.peso"
                   
                    />
                    <label class="control-label" for="peso"
                      >Peso(Kilogramos)</label
                    >
                  </div>
                </div>
              </div>
           
    </div>
  </div>
</div>
    </v-card>



  </div>

  
</template>
<script>
import * as jugadoresService from "../services/jugadores";
import * as mensajes from "../helpers/mensajes";
export default {
  props: ["player_team_id"],
  data() {
    return {
      headers: [
        { text: "Foto", value: "foto", align: "center" },
       
        { text: "Jugador", value: "nombre_completo" },

        { text: "Acciones", value: "id" },
      ],
      search: "",
      jugadores: [],
      info:[]
    };
  },
  methods: {
    getMisJugadores() {
      jugadoresService
        .MisJugadores()
        .then((jugadores) => {
          this.jugadores = jugadores;
        })
        .catch((error) => console.log(error));
    },

    verJugador(item){
      this.info=item
      $('#modalDetalle').modal('show')
    }

  },
  mounted() {
    this.getMisJugadores();
   
  },
};
</script>