<template>
  <div class="container">
    <button
      class="btn btn-success btn-md mb-3 mt-3"
      @click="abrirModalNuevo()"
      title="modificar"
    >
      <i class="fas fa-user-plus"> Nueva Direccion</i>
    </button>
    <div class="row">
      <div class="col-sm">
        <div class="card" style="width: auto;">

          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <!-- <v-app id="inspire"> -->
              <v-treeview
                :items="items"
                activatable
                open-on-click
                open-all
              >
                <template slot="label" slot-scope="{ item }">
                  <div @click="direccion(item)">{{item.designacion+" "+ item.name }}</div>
                </template>
              </v-treeview>
              <!-- </v-app> -->
            </li>
          </ul>
        </div>
      </div>
      <div v-if="detalle == true" class="col-sm">

          <div class="card" style="width: auto;">
            <div v-if="btnEditar" class="card-header">
                        {{this.titulo}}
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <br>
                <form  method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 py-0 pl-0">
                            <label class="col-sm-12 py-0">
                              Nombre
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">
                            <input
                              v-if="btnEditar"
                              v-model="datosDB.dir_name"
                              type="text"
                              placeholder="Nombre"
                              class="form-control"
                              id="dir_name"
                              @keyup="valida"
                              @blur="normal"
                              @click="valida"
                            />
                            <p v-else class="py-0 pl-0">{{ datosDB.dir_name }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 py-0 pl-0">
                            <label class="col-sm-12 py-0">
                              Designacion
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">

                                <b-form-select v-if="btnEditar" v-model="datosDB.dir_designacion" :options="options" @keyup="valida"
                              @blur="normal"
                              @click="valida"
                                    id="dir_designacion">
                                    <option disabled value="">Designacion :</option>
                                </b-form-select>
                            <p v-else class="py-0 pl-0">{{ datosDB.dir_desig }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div v-if="btnEditar==false" class="row">

                    <div class="col-sm-12">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 py-0 pl-0">
                            <label class="col-sm-12 py-0">
                              Nombre Padre
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">
                            <p class="py-0 pl-0">{{ datosDB.dir_padre }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-else class="row">
                    <div class="form-group">
                      <center>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="radio" id="activado" value="1" v-model="datosDB.dir_state"
                                    checked>
                                <label for="activado">Activo</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" id="desactivado" value="0"
                                    v-model="datosDB.dir_state">
                                <label for="desactivado">Desactivado</label>
                            </div>
                        </div>
                      </center>
                    </div>
                  </div>

                  <!-- muestra datos de estado del modulo -->
                  <div v-if="btnEditar==false" class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 py-0 pl-0">
                            <label class="col-sm-12 py-0">
                              Hijos
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">
                            <p
                              v-if="datosDB.dir_haschild == 0"
                              class="py-0 pl-0"
                              >{{ "NO" }}</p
                            >
                            <p v-else class="py-0 pl-0">{{ "SI" }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 py-0 pl-0">
                            <label class="col-sm-12 py-0">
                              Estado
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">
                            <p v-if="datosDB.dir_state == 1" class="py-0 pl-0">{{
                              "Activado"
                            }}</p>
                            <p v-else class="py-0 pl-0">{{ "Desactivado" }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- muestra datos de estado para editar -->
                  <div v-else class="row">
                    <div class="form-group">
                      <label>Seleccine al Padre</label>
                          <v-treeview
                            shaped
                            hoverable
                            activatable
                            :items="items"
                            :active="datoSelect"
                            @update:active="updateActive"
                            open-all
                            >
                            <template slot="label" slot-scope="{ item }">
                              <div>{{item.designacion+" "+ item.name }}</div>
                            </template>
                        </v-treeview>
                    </div>
                  </div>

                </form>


                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-6">
                      <button
                        v-if="btnEditar==true && btnCrear==false"
                        class="btn btn-success btn-sm navbar-left"
                        @click="editar()"
                      >
                        <i class="fas fa-save"> Guardar</i>
                      </button>
                      <button
                        v-if="btnCrear"
                        class="btn btn-success btn-sm navbar-left"
                        @click="crear()"
                      >
                        <i class="fas fa-save"> Guardar</i>
                      </button>


                      <button
                        v-if="btnEditar==false"
                        class="btn btn-success btn-sm navbar-left"
                        @click="abrirEditar()"
                        title="modificar"
                      >
                        <i class="fas fa-pencil-alt"> Editar</i>
                      </button>
                    </div>
                    <div class="col-sm-6">
                      <button
                        v-if="btnEditar"
                        class="btn btn-danger btn-sm navbar-left"
                        @click="Cancelar()"
                        title="modificar"
                      >
                        <i class="fas fa-window-close"> Cancelar</i>
                      </button>
                      <button
                        v-else
                        class="btn btn-danger btn-sm navbar-left"
                        @click="abrirModalEliminar()"
                        title="Eliminar"
                      >
                        <i class="fas fa-trash-alt"> Eliminar</i>
                      </button>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
<!-- Modal de eliminar -->
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Eliminar
                          Modulo</h5>
                      <button type="button" class="close" @click.prevent="cierra()" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      {{this.datosDB.dir_name}}
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click.prevent="cierra()">Close</button>
                      <button type="button" class="btn btn-danger" @click="eliminarDatos()">Eliminar</button>
                  </div>
              </div>
          </div>
      </div>
<!--fin del modal de eliminar-->
      </div>
    </div>
  </div>

</template>

<script>
export default {
  data() {
    return {
      items: [],//datos para el select
      datosDB:{},//datos de un modulo seleccionado
      titulo: "",
      btnCrear: false,
      btnEditar: false,
      detalle: false,
      datoSelect:[],
      father:""
    };
  },

  created() {
    axios.get("./direccion").then(res => {
      this.items = res.data;
    });
    axios.get('/polidivi/combobox')
    .then(
        res=>{
            this.options=res.data
        }
    );
  },
  methods: {
    direccion(item) {
      if (item.id != 0) {
        this.btnEditar = false;
        this.btnCrear=false;
        this.detalle = true;
        axios.get(`./direccion/getdireccion/${item.id}`).then(res => {
          this.datosDB = res.data;
        });

      }
    },
    valida(e) {
      if (e.target.value.length > 0) {
        $("#" + e.target.id).css("border-color", "#86b7fe");
        $("#" + e.target.id).css(
          "box-shadow",
          "0 0 0 .2rem rgba(0, 123, 255, .25)"
        );
      } else {
        $("#" + e.target.id).css("border-color", "#DA3E47");
        $("#" + e.target.id).css(
          "box-shadow",
          "0 1px 1px rgba(236, 27, 27, 0.575) inset, 0 0 5px rgba(238, 24, 24, 0.63)"
        );
      }
    },
    normal(e) {
      if (e.target.value.length > 0) {
        $("#" + e.target.id).css("border", "1px solid #ced4da");
      } else {
        $("#" + e.target.id).css("border-color", "#DA3E47");
      }
      $("#" + e.target.id).css(
        "box-shadow",
        "0 1px 1px rgba(0, 0, 0, 0) inset, 0 0 0px rgba(0, 0, 0, 0)"
      );
    },
    cierra() {
      $("#modalEliminar").modal("hide");
      this.datoSelect = [];
    },
    abrirEditar() {
      this.titulo = "Editar Direccion";
      this.btnCrear = false;
      this.btnEditar = true;
      this.datoSelect[0]=this.datosDB.dir_father;
    },
    abrirModalNuevo() {
      this.titulo = "Nuevo Direccion";
      this.datosDB.dir_name='';
      this.datosDB.dir_state=1;
      this.datosDB.dir_designacion='';
      this.datosDB.dir_father=0;
      this.datoSelect[0]=null;
      this.detalle=true;
      this.btnCrear = true;
      this.btnEditar = true;
    },
    abrirModalEliminar() {
      $("#modalEliminar").modal("show");
    },
    Cancelar() {
      this.btnEditar = false;
      this.detalle=false;
    },
    crear() {
      if (this.datosDB.dir_name.trim() === "") {
        toastr.warning("llena todos los campos");
        $("#dir_name").css("border-color", "#DA3E47");
        return;
      }
      if (this.datosDB.dir_designacion === "") {
        toastr.warning("llena todos los campos");
        $("#dir_designacion").css("border-color", "#DA3E47");
        return;
      }
      axios.post('./direccion',this.datosDB).then(res => {
          if (res.data.success == true) {
            toastr.success(res.data.msg);
            this.btnEditar=false;
            this.detalle=false;
            //this.usuario.push(users);
            axios.get("./direccion").then(res => {
              this.items = res.data;
            });

          } else {
            toastr.error(res.data.msg);
          }
        })
        .catch(err => toastr.error("Error al ingresar los datos"));
    },
    //saca el id del arbol de direccion
    updateActive(id) {
      this.datosDB.dir_father=id[0];
    },
    editar() {
      if (this.datosDB.dir_name.trim() === "") {
        toastr.warning("llena todos los campos");
        $("#dir_name").css("border-color", "#DA3E47");
        return;
      }
      axios.put(`/direccion/${this.datosDB.dir_id}`, this.datosDB)
        .then(res => {
          if (res.data.success == true) {
            toastr.success(res.data.msg);
            this.btnEditar=false;
            this.detalle=false;
            axios.get("./direccion").then(res => {
              this.items = res.data;
            });
          } else {
            toastr.error(res.data.msg);
          }
        })
        .catch(err => toastr.error("Error al ingresar los datos"));
    },
    eliminarDatos() {
      axios
        .delete(`direccion/${this.datosDB.dir_id}`)
        .then(() => {
          toastr.success("Dato eliminado correctamente");
          this.btnEditar=false;
            this.detalle=false;
          axios.get("./direccion").then(res => {
              this.items = res.data;
            });
        })
        .catch(error => {
          toastr.error("Error al eliminar dato");
        });
      $("#modalEliminar").modal("hide");
    }
  }
};
</script>
