<template>

    <div class="container">
        <button class="btn btn-success btn-md mb-3 mt-3" @click="abrirModalNuevo()" >
            <i class="fas fa-user-plus"> Nuevo Cliente</i>
        </button>
        <div class="row">

          <div id="use" class="col-md-12">
            <div class="card" style="width: auto;">
              <div class="card-body">
                <table class="table table-responsive-sm">
                  <thead>
                      <tr>
                          <th v-if="this.usrsuper==1">Supervisor</th>
                          <th>Nombre</th>
                          <th>Paterno</th>
                          <th v-if="btnMostrar==false">Cedula</th>
                          <th v-if="btnMostrar==false">Direccion</th>
                          <th v-if="btnMostrar==false">Celular</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr v-if="usuario.length==0">
                          <td colspan="8" class="text-center text-danger">
                              <label> No existe registro de Usuarios</label>
                          </td>
                      </tr>
                      <tr v-for="(item, index) in usuario" :key="index" @click="datoUsuario(item)">

                          <td v-if="usrsuper==1">
                              {{item.nomcreador}}
                          </td>
                          <td>
                              {{item.per_name}}
                          </td>
                          <td>
                              {{item.per_lastname}}
                          </td>

                          <td v-if="btnMostrar==false">
                              {{item.per_ci}}
                          </td>
                          <td v-if="btnMostrar==false">
                              {{item.pdv_name+": "+item.dir_name}}
                          </td>
                          <td v-if="btnMostrar==false">
                              {{item.per_mobile}}
                          </td>
                      </tr>
                  </tbody>

              </table>
              </div>
            </div>
          </div>
          <div v-if="this.btnMostrar" class="col-md-6">
            <div class="card" style="width: auto;">
              <div v-if="btnEditar" class="card-header">
                        {{this.titulo}}
              </div>
              <div class="card-body">
                <form action="POST">
                  <br>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Nickname</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">
                          <input
                            v-if="btnEditar"
                            v-model="users.use_username"
                            type="text"
                            placeholder="NickName"
                            class="form-control"
                            id="use_username"
                            @keyup="valida"
                            @blur="normal"
                            @click="valida"
                          />
                          <p v-else class="py-0 pl-0">{{users.use_username}} </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Nombre</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">

                          <input
                            v-if="btnEditar"
                            v-model="users.per_name"
                            type="text"
                            placeholder="Nombre"
                            class="form-control"
                            id="per_name"
                            @keyup="valida"
                            @blur="normal"
                            @click="valida"
                          />
                          <p v-else class="py-0 pl-0">{{users.per_name}} </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Ap. Paterno</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">

                          <input
                            v-if="btnEditar"
                            v-model="users.per_lastname"
                            type="text"
                            placeholder="Ap. Paterno"
                            class="form-control"
                            id="per_lastname"
                            @keyup="valida"
                            @blur="normal"
                            @click="valida"
                          />
                          <p v-else class="py-0 pl-0">{{users.per_lastname}} </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Ap. Materno</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">

                          <input
                            v-if="btnEditar"
                            v-model="users.per_lastname2"
                            type="text"
                            placeholder="Ap. Materno"
                            class="form-control"
                            id="per_lastname2"
                          />
                          <p v-else class="py-0 pl-0">{{users.per_lastname2}} </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Celuda</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">

                          <input
                            v-if="btnEditar"
                            v-model="users.per_ci"
                            type="number"
                            placeholder="Cedula"
                            class="form-control"
                            id="per_ci"
                            @keyup="valida"
                            @blur="normal"
                            @click="valida"
                          />
                          <p v-else class="py-0 pl-0">{{users.per_ci}} </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Fecha de Nacimiento</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">

                          <input
                            v-if="btnEditar"
                            v-model="users.per_date"
                            type="date"
                            placeholder="Fecha de Nacimiento"
                            class="form-control"
                            id="per_date"
                            @keyup="valida"
                            @blur="normal"
                            @click="valida"
                          />
                          <p v-else class="py-0 pl-0">{{users.per_date}} </p>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Telefono</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">

                          <input
                            v-if="btnEditar"
                            v-model="users.per_phone"
                            type="number"
                            placeholder="Telefono"
                            class="form-control"
                            id="per_phone"
                          />
                          <p v-else class="py-0 pl-0">{{users.per_phone}} </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Celular</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">

                          <input
                            v-if="btnEditar"
                            v-model="users.per_mobile"
                            type="number"
                            placeholder="Celular"
                            class="form-control"
                            id="per_mobile"
                            @keyup="valida"
                            @blur="normal"
                            @click="valida"
                          />
                          <p v-else class="py-0 pl-0">{{users.per_mobile}} </p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Email</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">
                          <input
                            v-if="btnEditar"
                            placeholder="Email"
                            type="email"
                            class="form-control"
                            pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                            v-model="users.per_email"
                            @keyup="valida"
                            @blur="normal"
                            @click="valida"
                            id="per_email">
                          <p v-else class="py-0 pl-0">{{users.per_email}} </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Perfil</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">
                          <b-form-select
                            v-if="btnCrear"
                            v-model="users.pro_id"
                            :options="perfil"
                            id="pro_id"
                            @keyup="valida"
                            @blur="normal"
                            @click="valida"
                            >
                            <option disabled value="">Perfil</option>
                          </b-form-select>
                          <p v-else class="py-0 pl-0">{{pro_name}} </p>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div v-if="btnEditar" class="row text-center">
                    <div class="col-md-6">
                      <input type="radio" id="activado" value="1" v-model="users.use_state"
                                    checked>
                                <label for="activado">Activo</label>
                    </div>
                    <div class="col-md-6">
                      <input type="radio" id="desactivado" value="0"
                                    v-model="users.use_state">
                                <label for="desactivado">Desactivado</label>
                    </div>
                  </div>


                  <div v-if="btnEditar" class="row text-center">
                    <div class="col-md-6">
                      <input type="radio" id="hombre" value="1" v-model="users.per_sex"
                                    checked>
                                <label for="hombre">Hombre</label>
                    </div>
                    <div class="col-md-6">
                      <input type="radio" id="mujer" value="0"
                                    v-model="users.per_sex">
                                <label for="mujer">Mujer</label>
                    </div>
                  </div>


                  <div v-else class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Estado</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">
                          <p v-if="users.use_state == 1" class="py-0 pl-0">{{
                              "Activado"
                            }}</p>
                          <p v-else class="py-0 pl-0">{{ "Desactivado" }}</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-12 py-0 pl-0">
                          <label class="col-md-12 py-0">Sexo</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 py-0">
                          <p v-if="users.per_sex == 1" class="py-0 pl-0">{{
                              "Hombre"
                            }}</p>
                          <p v-else class="py-0 pl-0">{{ "Mujer" }}</p>
                        </div>
                      </div>
                    </div>
                  </div>





<!-- Modal Direcciones para editar y crear -->
        <div class="modal fade" id="modalDir">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title">
                          <label>Direcciones</label>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" @click.prevent="cierra()"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                          <div class="form-group">
                            <label>Seleccine Direccion</label>
                                <v-treeview
                                  shaped
                                  hoverable
                                  activatable
                                  :items="items"
                                  :active="datoSelect"
                                  open-all
                                  >
                                  <template  slot="label" slot-scope="{ item }">
                                    <div @click.prevent="updateActive(item)">{{item.designacion+" "+ item.name }}</div>
                                  </template>
                              </v-treeview>
                          </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!--Final Modal Direcciones para editar y crear -->


        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-sm-12 py-0 pl-0">
                <label class="col-md-12 py-0">Direccion</label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 py-0">
                <p id="dir_name" class="py-0 pl-0" v-if="btnEditar" @click="direccion()">{{users.dir_name}}</p>
                <input
                  v-if="btnEditar"
                  v-model="users.dir_id"
                  type="number"
                  id="dir_id"
                  hidden
                  @keyup="valida"
                  @blur="normal"
                  @click="valida"
                />
                <p v-else class="py-0 pl-0">
                  {{dire}}
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-sm-12 py-0 pl-0">
                <label class="col-md-12 py-0">Mas detalles</label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 py-0">
                <textarea
                  v-if="btnEditar"
                  v-model="users.per_dirdetalle"
                  placeholder="detalles"
                  class="form-control"
                  id="per_dirdetalle"
                  @keyup="valida"
                  @blur="normal"
                  @click="valida"
                  cols="25"
                  rows="3">
                </textarea>

                <p v-else class="py-0 pl-0">{{users.per_dirdetalle}} </p>
              </div>
            </div>
          </div>
        </div>



        <div v-if="btnEditar" class="row">
          <div class="col-md-12">
            <b-form-input type="password" id="input-live" v-model="users.acc_value"
                          :state="nameState" aria-describedby="input-live-help input-live-feedback"
                          placeholder="Password" trim>
            </b-form-input>
            <b-form-invalid-feedback id="input-live-feedback">
                <p v-if="btnCrear">
                  Introduzca mas de 8 caracteres, entre numeros y letras
                </p>
                <p v-else>
                  Introduzca mas de 8 caracteres, entre numeros y letras
                  <br> Opcional
                </p>

            </b-form-invalid-feedback>
          </div>
        </div>


        </form>
                <br>
                <div class="card-footer">
                  <div class="row text-center">
                    <div class="col-sm-6">
                      <button
                        v-if="btnEditar==true && btnCrear==false"
                        class="btn btn-success btn-sm navbar-left"
                        @click="editar()"
                      >
                        <i class="fas fa-save"> Guardar</i>
                      </button>
                      <button
                        v-if="btnCrear && usrsuper==0"
                        class="btn btn-success btn-sm navbar-left"
                        @click="crear()"
                      >
                        <i class="fas fa-save"> Guardar</i>
                      </button>


                      <button
                        v-if="btnEditar==false"
                        class="btn btn-success btn-sm navbar-left"
                        @click="abrirModalEditar()"
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
              </div>
            </div>
          </div>
        </div>



      <!--fin del modal de eliminar-->
      <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" @click.prevent="cierra()"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{users.per_name+" "+users.per_lastname+" "+users.per_lastname2}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            @click.prevent="cierra()">Cerrar</button>
                        <button type="button" class="btn btn-danger" @click="eliminarUsuario()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--fin del modal de eliminar-->

    </div>

</template>


<script>
export default {
  computed: {
    nameState() {
      return this.users.acc_value.length > 7 ? true : false
    }
  },
  data(){
    return{
      usuario:[],//contiene todos los usuarios de bd
      items: [],//contiene todas las direcciones
      datoSelect:[],//contiene el id para mostrar la direccion que tiene al editar
      perfil:[],//contiene todos los perfiles
      usrsuper:this.$attrs.super,
      users:{
        per_name:'',
        per_lastname:'',
        per_lastname2:'',
        per_ci:'',
        per_date:'',
        per_phone:'',
        per_mobile:'',
        per_email:'',
        per_sex:'',
        use_state:'',
        use_username:'',
        acc_value:'',
        per_dirdetalle:'',
        pro_id:'',
        dir_id:''
      },
      titulo:'',
      pro_name:'',//contiene el nombre del perfil
      dire:'',//contiene el nombre de toda la direccion de padre a hijo
      btnCrear:false,
      btnEditar:false,
      btnMostrar:false
    }
  },
  created(){
    axios.get('/cliente')
    .then(
        res=>{
            this.usuario=res.data
        }
    ),
    axios.get('/perfil/combobox')
    .then(
        res=>{
            this.perfil=res.data
        }
    ),
    axios.get("./direccion").then(res => {
      this.items = res.data;
    })
  },
  methods:{
    direccion(){
      $('#modalDir').modal('show');
    },
    //saca el id del arbol de direccion
    updateActive(dat) {
      this.users.dir_name=dat.designacion+' '+dat.name;
      this.users.dir_id=dat.id;
      toastr.success(dat.designacion+' '+dat.name+"<br> Se agrego");
    },
    datoUsuario(item){
      this.users=item;
      this.datoSelect[0]=this.users.dir_id;
      axios.get(`/usuario/perfil/${item.use_id}`)
        .then(
            res=>{
                this.users.pro_id=res.data.pro_id,
                this.pro_name=res.data.pro_name
            }
      );
      axios.get(`/usuario/direccion/${item.use_id}`)
        .then(
            res=>{
              this.dire=res.data
            }
      );
      axios.get('/cliente')
        .then(
          res=>{
            this.usuario=res.data
          }
      );
      this.btnMostrar=true;
      this.btnCrear=false;
      this.btnEditar=false;
      $("#use").removeClass("col-md-12").addClass("col-md-6");

      this.users.acc_value="";
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
    Cancelar() {
      this.btnEditar = false;
      this.btnMostrar=false;
      this.btnCrear=false;
      $("#use").removeClass("col-md-6").addClass("col-md-12");

    },
    cierra(){
      $("#modalDir").modal("hide");
      $("#modalEliminar").modal("hide");
    },
    abrirModalEditar(){
        this.titulo='Editar Cliente'
        this.btnCrear=false
        this.btnEditar=true
    },
    abrirModalNuevo(){
        this.titulo='Nuevo Cliente'
        this.users.per_name=''
        this.users.per_lastname=''
        this.users.per_lastname2=''
        this.users.per_ci=''
        this.users.per_date=''
        this.users.per_phone=''
        this.users.per_mobile=''
        this.users.per_email=''
        this.users.per_sex='1'
        this.users.use_username=''
        this.users.use_state='1'
        this.users.acc_value=''
        this.users.pro_id=''
        this.users.per_dirdetalle=''
        this.users.dir_name='Seleccione direccion'
        this.btnCrear=true
        this.btnEditar=true
        this.btnMostrar=true;
        $("#use").removeClass("col-md-12").addClass("col-md-6");
    },
    abrirModalEliminar(){
        $('#modalEliminar').modal('show')
    },

    crear(){
        if(this.users.use_username.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#use_username").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_name.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_name").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_lastname.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_lastname").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_ci === ''){
            toastr.warning('llena todos los campos');
            $("#per_ci").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_date.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_date").css("border-color", "#DA3E47");
            return;
        }else{
            $("#per_date").css("border-color", "#D5DBDB");
        }
        if(this.users.per_mobile.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_mobile").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_email.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_email").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.acc_value.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#acc_value").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.dir_id === ''){
            toastr.warning('Seleccione una direccion');
            $("#dir_name").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.pro_id === ''){
            toastr.warning('Seleccione un Perfil');
            $("#pro_id").css("border-color", "#DA3E47");
            return;
        }else{
            $("#pro_id").css("border-color", "#D5DBDB");
        }
        if(this.users.per_dirdetalle.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_dirdetalle").css("border-color", "#DA3E47");
            return;
        }

        axios.post('/usuario',this.users).then(res=>{
                if (res.data.success==true) {
                    toastr.success(res.data.msg);
                    this.btnMostrar=false;
                    this.btnCrear=false;
                    this.btnEditar=false;
                    $("#use").removeClass("col-md-6").addClass("col-md-12");
                    axios.get('/cliente')
                        .then(
                            res=>{
                                this.usuario=res.data
                            }
                        );
                } else {
                    toastr.error(res.data.msg);
                    console.log(res.data);
                     $('#'+res.data.id).css("border-color", "#DA3E47");
                }
            })
            .catch(err=>toastr.error('Error al ingresar los datos'));
    },
    editar(){
        if(this.users.use_username.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#use_username").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_name.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_name").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_lastname.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_lastname").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_ci === ''){
            toastr.warning('llena todos los campos');
            $("#per_ci").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_date.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_date").css("border-color", "#DA3E47");
            return;
        }else{
            $("#per_date").css("border-color", "#D5DBDB");
        }
        if(this.users.per_mobile.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_mobile").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_email.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_email").css("border-color", "#DA3E47");
            return;
        }
        // if(this.users.acc_value.trim() === ''){
        //     toastr.warning('llena todos los campos');
        //     $("#acc_value").css("border-color", "#DA3E47");
        //     return;
        // }
        if(this.users.dir_id === ''){
            toastr.warning('Seleccione una direccion');
            $("#dir_name").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.pro_id === ''){
            toastr.warning('Seleccione un Perfil');
            $("#pro_id").css("border-color", "#DA3E47");
            return;
        }else{
            $("#pro_id").css("border-color", "#D5DBDB");
        }
        if(this.users.per_dirdetalle.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_dirdetalle").css("border-color", "#DA3E47");
            return;
        }

        if(this.users.per_mobile.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_mobile").css("border-color", "#DA3E47");
            return;
        }
        if(this.users.per_email.trim() === ''){
            toastr.warning('llena todos los campos');
            $("#per_email").css("border-color", "#DA3E47");
            return;
        }


        axios.put(`/usuario/${this.users.use_id}`, this.users)
        .then(res=>{
                if (res.data.success==true) {
                    toastr.success(res.data.msg);
                    this.btnMostrar=false;
                    this.btnCrear=false;
                    this.btnEditar=false;
                    $("#use").removeClass("col-md-6").addClass("col-md-12");
                    //this.usuario[this.index] =users;
                    axios.get('/cliente')
                        .then(
                            res=>{
                                this.usuario=res.data
                            }
                        );
                    $('#modalForm').modal('hide');
                } else {
                    toastr.error(res.data.msg);
                }
            })
            .catch(err=>toastr.error('Error al ingresar los datos'));

    },
    eliminarUsuario(){
        axios.delete(`usuario/${this.users.use_id}`)
        .then(res=>{
                if (res.data.success==true) {
                    toastr.success(res.data.msg);
                    this.btnMostrar=false;
                    this.btnCrear=false;
                    this.btnEditar=false;
                    $("#use").removeClass("col-md-6").addClass("col-md-12");
                    //this.usuario[this.index] =users;
                    axios.get('/cliente')
                        .then(
                            res=>{
                                this.usuario=res.data
                            }
                        );
                    $('#modalEliminar').modal('hide')
                } else {
                    toastr.error(res.data.msg);
                }
            })
        .catch(error => {
            toastr.error('Error al eliminar');
        });


    }
  }
}
</script>
