<template>

    <div class="container-fluid" style="background:#f4f6f9;padding-top:10px;position:relative">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <center class="mt-4">
                            <img src="/img/person1.png" class="img-circle" width="150" />
                            <h6 class="card-subtitle pt-2">{{this.session}} </h6>
                        </center>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card" v-for="(item, index) in datosDB" :key="index">
                    <div class="card-body" >
                        <form class="form-horizontal form-material mx-1">
                          <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-md-12 py-0">Nickname</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <input v-if="btnEditar" v-model="datoLocal.use_username" type="text" placeholder="NickName"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.use_username}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
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
                                                <input v-if="btnEditar" v-model="datoLocal.per_name" type="text" placeholder="Nombre"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.per_name}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">Apellido Paterno</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <input v-if="btnEditar" v-model="datoLocal.per_lastname" type="text" placeholder="Ap. Paterno"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.per_lastname}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">
                                                    Apellido Materno
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <input v-if="btnEditar" v-model="datoLocal.per_lastname2" type="text" placeholder="Ap. Materno"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.per_lastname2}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">
                                                  Cedula de indentidad
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <input v-if="btnEditar" v-model="datoLocal.per_ci" type="number" placeholder="Cedula de identidad"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.per_ci}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">
                                                    Email
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <input v-if="btnEditar" v-model="datoLocal.per_email" type="email" placeholder="Email"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.per_email}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">Ciudad</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <!-- <input v-if="btnEditar" type="text" placeholder="Ciudad"
                                                    class="form-control"> -->
                                                <b-form-select v-if="btnEditar" v-model="datoLocal.pdv_id" :options="options" @keypress="validacion"
                                                    id="pdv_id">
                                                    <option disabled value="">Ciudad</option>
                                                </b-form-select>
                                                <pre v-else class="py-0 pl-0">{{item.pdv_name}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">
                                                    Sexo
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <center v-if="btnEditar">
                                                  <div class="row">
                                                      <div class="col-md-6">
                                                          <input type="radio" id="hombre" value="1" v-model="datoLocal.per_sex">
                                                          <label for="hombre">Hombre</label>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <input type="radio" id="mujer" value="0" v-model="datoLocal.per_sex" >
                                                          <label for="mujer">Mujer</label>
                                                      </div>
                                                  </div>
                                              </center>
                                                <pre v-else-if="item.per_sex==1" class="py-0 pl-0">{{'Hombre'}}</pre>
                                                <pre v-else-if="item.per_sex==0" class="py-0 pl-0">{{'Mujer'}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">
                                                  Telefono
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <input v-if="btnEditar" v-model="datoLocal.per_phone" type="number" placeholder="Telefono"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.per_phone}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">
                                                    Celular
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <input v-if="btnEditar" v-model="datoLocal.per_mobile" type="number" placeholder="Celular"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.per_mobile}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">
                                                  Telefono
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <input v-if="btnEditar" type="number" placeholder="Telefono"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.per_phone}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12 py-0 pl-0">
                                                <label class="col-sm-12 py-0">
                                                    Celular
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 py-0">
                                                <input v-if="btnEditar" type="number" placeholder="Celular"
                                                    class="form-control">
                                                <pre v-else class="py-0 pl-0">{{item.per_mobile}}</pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-6">
                          <button class="btn btn-success btn-sm navbar-left" @click="abrirModalEditar(item)" title="modificar">
                            <i class="fas fa-pencil-alt"> Editar</i>
                          </button>
                        </div>
                        <div class="col-md-6">
                          <button class="btn btn-info btn-sm" title="Detalles">
                            <i class="fas fa-info-circle"> Mas Informacion</i>
                          </button>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal formulario para editar y crear -->
        <div class="modal fade" id="modalForm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title">
                            <i class="fa fa-users-cog" v-if="btnCrear"></i>
                            <i class="fa fa-users-cog" v-if="btnEditar"></i> {{titulo}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" @click.prevent="cierra()"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <input placeholder="Nombre de la Ciudad" type="text" class="form-control"
                                    v-model="datoLocal.pdv_name" @keypress="validacion" id="pdv_name">
                            </div>

                            <div class="form-group">
                                <input placeholder="Locacion" type="text" class="form-control"
                                    v-model="datoLocal.pdv_locacion" @keypress="validacion" id="pdv_locacion">
                            </div>
                            <div class="form-group">
                                <center>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="radio" id="activado" value="1" v-model="datoLocal.pdv_estado"
                                                checked>
                                            <label for="activado">Activo</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="desactivado" value="0"
                                                v-model="datoLocal.pdv_estado">
                                            <label for="desactivado">Desactivado</label>
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="close"
                                @click.prevent="cierra()">Cerrar</button>
                            <button type="submit" class="btn btn-primary" @click.prevent="crear()" v-if="btnCrear">Crear
                                Ciudad</button>
                            <button type="submit" class="btn btn-primary" @click.prevent="editar()"
                                v-if="btnEditar">Editar Ciudad</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- Modal formulario para editar y crear -->
        <!-- Modal de eliminar -->
        <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Ciudad</h5>
                        <button type="button" class="close" data-dismiss="modal" @click.prevent="cierra()"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{datoLocal.pdv_name}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            @click.prevent="cierra()">Close</button>
                        <button type="button" class="btn btn-danger" @click="eliminarDatos()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        <!--fin del modal de eliminar-->

    </div>


</template>


<script>
    export default {
                data(){
                    return{
                        datosDB:[],
                        options: [],
                        datoLocal:{
                            pdv_name:'',
                            pdv_locacion:'',
                            pdv_estado:'',
                            pdv_id:''
                        },
                        titulo:'',
                        index:'',
                        pdv_id:'',
                        session:this.$attrs.session,
                        btnCrear:false,
                        btnEditar:false
                    }
                },


                created(){
                    axios.get('/miperfil')
                    .then(
                        res=>{
                            this.datosDB=res.data,
                            console.log(res.data);
                        }
                    ),
                    axios.get('/polidivi/combobox')
                    .then(
                        res=>{
                            this.options=res.data
                        }
                    )

                },
                methods:{
                    validacion(e){
                        $("#"+e.target.id).css("border-color", "#D5DBDB");
                        //console.log(e);
                    },
                    cierra(){
                      $("#modalForm").modal("hide");
                      $("#modalEliminar").modal("hide");
                    },

                    crear(){
                        if(this.datoLocal.pdv_name.trim() === ''){
                            toastr.warning('llena todos los campos');
                            $("#pdv_name").css("border-color", "#DA3E47");
                            return;
                        }
                        axios.post('/polidivi',this.datoLocal).then(res=>{
                                if (res.data.success==true) {
                                    toastr.success(res.data.msg);
                                    //this.usuario.push(users);
                                    axios.get('/polidivi')
                                        .then(
                                            res=>{
                                                this.datosDB=res.data
                                            }
                                        );
                                    $('#modalForm').modal('hide');
                                } else {
                                    toastr.error(res.data.msg);
                                }
                            })
                            .catch(err=>toastr.error('Error al ingresar los datos'));

                    },
                    editar(){
                        axios.put(`/polidivi/${this.datoLocal.pdv_id}`, this.datoLocal).then(res=>{
                                if (res.data.success==true) {
                                    toastr.success(res.data.msg);
                                    axios.get('/polidivi')
                                        .then(
                                            res=>{
                                                this.datosDB=res.data
                                            }
                                        );
                                    $('#modalForm').modal('hide');
                                } else {
                                    toastr.error(res.data.msg);
                                }
                            })
                            .catch(err=>toastr.error('Error al ingresar los datos'));

                    },
                    eliminarDatos(){
                        axios.delete(`polidivi/${this.pdv_id}`)
                        .then(() => {
                            this.datosDB.splice(this.index, 1);
                            toastr.success('Dato eliminado correctamente');
                        })
                        .catch(error => {
                            toastr.error('Error al eliminar dato');
                        });
                        $('#modalEliminar').modal('hide');

                    },
                    abrirModalEditar(item){
                        this.titulo='Editar Perfil'
                        this.datoLocal.per_name=item.per_name
                        this.datoLocal.per_lastname=item.per_lastname
                        this.datoLocal.per_lastname2=item.per_lastname2
                        this.datoLocal.per_ci=item.per_ci
                        this.datoLocal.per_date=item.per_date
                        this.datoLocal.per_phone=item.per_phone
                        this.datoLocal.per_mobile=item.per_mobile
                        this.datoLocal.per_email=item.per_email
                        this.datoLocal.per_sex=item.per_sex
                        this.datoLocal.use_username=item.use_username
                        this.datoLocal.pdv_id=item.pdv_id
                        this.datoLocal.use_state=item.use_state
                        this.datoLocal.acc_value=''
                        this.btnCrear=false
                        this.btnEditar=true
                        //$('#modalForm').modal('show')
                    },
                    abrirModalNuevo(){
                        this.titulo='Nueva Ciudad'
                        this.datoLocal.pdv_name=''
                        this.datoLocal.pdv_locacion=''
                        this.datoLocal.pdv_estado='1'
                        this.btnCrear=true
                        this.btnEditar=false
                        $('#modalForm').modal('show')
                    },
                    abrirModalEliminar(item,index){
                        this.datoLocal.pdv_name=item.pdv_name
                        this.pdv_id=item.pdv_id
                        this.index=index
                        $('#modalEliminar').modal('show')
                    }
                }
            }
</script>
