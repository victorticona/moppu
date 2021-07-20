<template>

    <div class="container">

        <button class="btn btn-success btn-md mb-3 mt-3" @click="abrirModalNuevo()" title="modificar">
            <i class="fas fa-user-plus"> Nuevo Politica Division</i>
        </button>


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
                        <label> No existe registros</label>
                    </td>
                </tr>
                <tr v-for="(item, index) in datosDB" :key="index">

                    <td>
                        {{item.pdv_name}}
                    </td>
                    <td v-if="item.pdv_estado==1">
                        {{'Activado'}}
                    </td>
                    <td v-else>
                        {{'Desactivado'}}
                    </td>

                    <td>
                        <button class="btn btn-success btn-sm" @click="abrirModalEditar(item)" title="modificar">
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
                                <input placeholder="Nombre" type="text" class="form-control"
                                    v-model="datoLocal.pdv_name" @keypress="validacion" id="pdv_name">
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Politica division</h5>
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
                    datoLocal:{
                        pdv_name:'',
                        pdv_estado:'',
                        pdv_id:''
                    },
                    titulo:'',
                    index:'',
                    pdv_id:'',
                    btnCrear:false,
                    btnEditar:false
                }
            },

            created(){
                axios.get('/polidivi')
                .then(
                    res=>{
                        this.datosDB=res.data
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
                    this.titulo='Editar Politica Division'
                    this.datoLocal.pdv_name=item.pdv_name
                    this.datoLocal.pdv_estado=item.pdv_estado
                    this.datoLocal.pdv_id=item.pdv_id
                    this.btnCrear=false
                    this.btnEditar=true
                    $('#modalForm').modal('show')
                },
                abrirModalNuevo(){
                    this.titulo='Nueva Politica Division'
                    this.datoLocal.pdv_name=''
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
