<template>
    <div class="container">
        <button class="btn btn-success btn-md mb-3 mt-3" @click="abrirModalNuevo()" title="modificar">
            <i class="fas fa-user-plus"> Nuevo Perfil</i>
        </button>
        <div class="row">
            <div class="col-sm">
                <div class="card" style="width: auto;">
                    <div class="card-header">
                        Perfil
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <table class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="datosDB.length==0">
                                        <td colspan="4" class="text-center text-danger">
                                            <label> No existe registro de Usuarios</label>
                                        </td>
                                    </tr>
                                    <tr v-for="(item, index) in datosDB" :key="index" @click="datoPerfil(item)">

                                        <td >
                                            {{item.pro_name}}
                                        </td>

                                        <td v-if="item.pro_state==1" >
                                            {{'Activado'}}
                                        </td>
                                        <td v-else>
                                            {{'Desactivado'}}
                                        </td>

                                        <td>
                                            <button class="btn btn-success btn-sm" @click="abrirModalEditar(item)"
                                                title="modificar">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>

                                            <!-- Button trigger modal -->
                                            <button type="button" title="Eliminar" class="btn btn-danger btn-sm"
                                                @click="abrirModalEliminar(item,index)">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </li>
                    </ul>
                </div>

                <!-- Modal formulario para editar y crear -->
                <div class="modal fade" id="modalForm">
                    <div class="modal-dialog modal-lg" style="width: 600px;">
                        <div class="modal-content ">
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
                                    <!-- <div class="container"> -->
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="card" style="width: 18rem;">
                                                <div class="card-header">
                                                    Perfil
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="form-group">
                                                            <input placeholder="Nombre del Perfil" type="text"
                                                                class="form-control" v-model="datoLocal.pro_name"
                                                                @keypress="validacion" id="pro_name">
                                                        </div>

                                                        <div class="form-group">
                                                            <center>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input type="radio" id="activado" value="1"
                                                                            v-model="datoLocal.pro_state" checked>
                                                                        <label for="activado">Activo</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="radio" id="desactivado" value="0"
                                                                            v-model="datoLocal.pro_state">
                                                                        <label for="desactivado">Desactivado</label>
                                                                    </div>
                                                                </div>
                                                            </center>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="card" style="width: 15rem;">
                                                <div class="card-header">
                                                    Modulos
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <v-treeview selectable open-all
                                                            item-disabled="locked"
                                                            :items="items"
                                                            return-object
                                                            v-model="datoSelect">
                                                        </v-treeview>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="close"
                                        @click.prevent="cierra()">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" @click.prevent="crear()"
                                        v-if="btnCrear">Crear
                                        Perfil</button>
                                    <button type="submit" class="btn btn-primary" @click.prevent="editar()"
                                        v-if="btnEditar">Editar Perfil</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- Modal formulario para editar y crear -->
                <!-- Modal de eliminar -->
                <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Eliminar
                                    Perfil</h5>
                                <button type="button" class="close" @click.prevent="cierra()" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{datoLocal.pro_name}}
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
            <div class="col-sm">
                <div class="card" style="height: auto">
                    <div class="card-header">
                        Modulos
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <!-- <v-app id="inspire"> -->
                            <v-treeview selectable
                                      open-all
                                      item-disabled="locked"
                                      return-object
                                      :items="items"
                                      v-model="datoSelect">
                            </v-treeview>
                            <!-- </v-app> -->
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
                data(){
                    return{
                        datosDB:[],
                        datoLocal:{
                            pro_name:'',
                            pro_state:''
                        },
                        items: [],
                        datoSelect:[],
                        titulo:'',
                        pro_id:'',
                        btnCrear:false,
                        btnEditar:false
                    }
                },

                created(){
                    axios.get('./perfil/indexlist')
                    .then(
                        res=>{
                            this.datosDB=res.data
                        }
                    ),
                    axios.get('./modulo/combobox')
                    .then(
                        res=>{
                            this.items=res.data
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
                      this.datoSelect=[];
                    },
                    datoPerfil(item){
                      axios.get(`./perfil/getmodules/${item.pro_id}`)
                        .then(
                            res=>{
                                this.datoSelect=res.data
                            }
                        )
                      console.log(this.datoSelect)
                    },

                    crear(){
                        if(this.datoLocal.pro_name.trim() === ''){
                            toastr.warning('llena todos los campos');
                            $("#pro_name").css("border-color", "#DA3E47");
                            return;
                        }
                        axios.post('public/../perfil',{params:{'dato':this.datoLocal,'select':this.datoSelect}}).then(res=>{
                                if (res.data.success==true) {
                                    toastr.success(res.data.msg);
                                    //this.usuario.push(users);
                                    axios.get('./perfil/indexlist')
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
                      if(this.datoLocal.pro_name.trim() === ''){
                            toastr.warning('llena todos los campos');
                            $("#pro_name").css("border-color", "#DA3E47");
                            return;
                        }
                        axios.put(`public/../perfil/${this.pro_id}`,{params:{'dato':this.datoLocal,'select':this.datoSelect}}).then(res=>{
                                if (res.data.success==true) {
                                    toastr.success(res.data.msg);
                                    axios.get('./perfil/indexlist')
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
                        axios.delete(`public/../perfil/${this.pro_id}`)
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
                        this.datoLocal.pro_name=item.pro_name
                        this.datoLocal.pro_state=item.pro_state
                        this.pro_id=item.pro_id
                        this.btnCrear=false
                        this.btnEditar=true
                        $('#modalForm').modal('show')
                    },
                    abrirModalNuevo(){
                        this.titulo='Nuevo Perfil'
                        this.datoLocal.pro_name=''
                        this.datoLocal.pro_state='1'
                        this.datoSelect=[]
                        this.btnCrear=true
                        this.btnEditar=false
                        $('#modalForm').modal('show')
                    },
                    abrirModalEliminar(item,index){
                        this.datoLocal.pro_name=item.pro_name
                        this.pro_id=item.pro_id
                        this.index=index
                        $('#modalEliminar').modal('show')
                    }
                }
            }
</script>
