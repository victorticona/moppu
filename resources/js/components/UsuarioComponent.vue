<template>

    <div class="container">
        <button class="btn btn-success btn-md mb-3 mt-3" @click="abrirModalNuevo()" title="modificar">
            <i class="fas fa-user-plus"> Nuevo Usuario</i>
        </button>


        <table class="table table-responsive-md">
            <thead>
                <tr>
                    <th>Nikename</th>
                    <th>Nombre</th>
                    <th>Paterno</th>
                    <th>celuda</th>
                    <th>ciudad</th>
                    <th>telefono</th>
                    <th>celular</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="usuario.length==0">
                    <td colspan="8" class="text-center text-danger">
                        <label> No existe registro de Usuarios</label>
                    </td>
                </tr>
                <tr v-for="(item, index) in usuario" :key="index">

                    <td>
                        {{item.use_username}}
                    </td>
                    <td>
                        {{item.per_name}}
                    </td>
                    <td>
                        {{item.per_lastname}}
                    </td>

                    <td>
                        {{item.per_ci}}
                    </td>
                    <td>
                        {{item.pdv_name}}
                    </td>
                    <td>
                        {{item.per_phone}}
                    </td>
                    <td>
                        {{item.per_mobile}}
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
                        <button class="btn btn-info btn-sm" title="Detalles">
                            <i class="fas fa-info-circle"></i>
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
                                <input placeholder="NickName" type="text" class="form-control"
                                    v-model="users.use_username" @keypress="validacion" id="use_username">
                            </div>

                            <div class="form-group">
                                <input placeholder="Nombre" type="text" class="form-control" v-model="users.per_name"
                                    @keypress="validacion" id="per_name">
                            </div>

                            <div class="form-group">
                                <input placeholder="Apellido paterno" type="text" class="form-control"
                                    v-model="users.per_lastname" @keypress="validacion" id="per_lastname">
                            </div>
                            <div class="form-group">
                                <input placeholder="Apellido materno" type="text" class="form-control"
                                    v-model="users.per_lastname2">
                            </div>
                            <div class="form-group">
                                <input placeholder="Cedula" type="number" class="form-control" v-model="users.per_ci"
                                    @keypress="validacion" id="per_ci">
                            </div>
                            <div class="form-group">
                                <input placeholder="Fecha de nacimiento" type="date" class="form-control"
                                    v-model="users.per_date" @keypress="validacion" id="per_date">
                            </div>
                            <div class="form-group">
                                <input placeholder="Telefono" type="number" class="form-control"
                                    v-model="users.per_phone">
                            </div>
                            <div class="form-group">
                                <input placeholder="Celular" type="number" class="form-control"
                                    v-model="users.per_mobile" @keypress="validacion" id="per_mobile">
                            </div>
                            <div class="form-group">
                                <input placeholder="Email" type="email" class="form-control"
                                    pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}"
                                    v-model="users.per_email" @keypress="validacion" id="per_email">
                            </div>
                            <div class="form-group">
                                <b-form-select v-model="users.pdv_id" :options="options" @keypress="validacion"
                                    id="pdv_id">
                                    <option disabled value="">Ciudad</option>
                                </b-form-select>
                            </div>
                            <div class="form-group">
                                <b-form-select v-model="users.pro_id" :options="perfil" @keypress="validacion"
                                    id="pro_id">
                                    <option disabled value="">Perfil</option>
                                </b-form-select>
                            </div>
                            <div class="form-group">
                                <center>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="radio" id="hombre" value="1" v-model="users.per_sex">
                                            <label for="hombre">Hombre</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="mujer" value="0" v-model="users.per_sex">
                                            <label for="mujer">Mujer</label>
                                        </div>
                                    </div>
                                </center>
                            </div>
                            <div class="form-group">
                                <center>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="radio" id="activado" value="1" v-model="users.use_state"
                                                checked>
                                            <label for="activado">Activo</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" id="desactivado" value="0" v-model="users.use_state">
                                            <label for="desactivado">Desactivado</label>
                                        </div>
                                    </div>
                                </center>
                            </div>
                            <div class="form-group">
                                <b-form-input type="password" id="input-live" v-model="users.acc_value"
                                    :state="nameState" aria-describedby="input-live-help input-live-feedback"
                                    placeholder="Password" trim></b-form-input>
                                <!-- This will only be shown if the preceding input has an invalid state -->
                                <b-form-invalid-feedback id="input-live-feedback">
                                    Introduzca mas de 8 caracteres, entre numeros y letras
                                </b-form-invalid-feedback>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                @click.prevent="cierra()">Cerrar</button>
                            <button type="submit" class="btn btn-primary" @click.prevent="crear()" v-if="btnCrear">Crear
                                usuario</button>
                            <button type="submit" class="btn btn-primary" @click.prevent="editar()"
                                v-if="btnEditar">Editar usuario</button>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Usuario</h5>
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
                    usuario:[],
                    options: [],
                    perfil:[],
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
                        pdv_id:'',
                        acc_value:'',
                        pro_id:''
                    },
                    titulo:'',
                    use_id:'',
                    acc_id:'',
                    btnCrear:false,
                    btnEditar:false
                }
            },


            created(){
                axios.get('/usuario')
                .then(
                    res=>{
                        this.usuario=res.data
                    }
                ),
                axios.get('/polidivi/combobox')
                .then(
                    res=>{
                        this.options=res.data
                    }
                ),
                axios.get('/perfil/combobox')
                .then(
                    res=>{
                        this.perfil=res.data
                    }
                )

            },
            methods:{
                validacion(e){
                    $("#"+e.target.id).css("border-color", "#D5DBDB");
                },
                cierra(){
                  $("#modalForm").modal("hide");
                  $("#modalEliminar").modal("hide");
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
                    if(this.users.per_ci.trim() === ''){
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
                    if(this.users.pdv_id === ''){
                        toastr.warning('llena todos los campos');
                        $("#pdv_id").css("border-color", "#DA3E47");
                        return;
                    }else{
                        $("#pdv_id").css("border-color", "#D5DBDB");
                    }

                    if(this.users.acc_value.trim() === ''){
                        toastr.warning('llena todos los campos');
                        $("#acc_value").css("border-color", "#DA3E47");
                        return;
                    }

                    axios.post('/usuario',this.users).then(res=>{
                            if (res.data.success==true) {
                                toastr.success(res.data.msg);
                                //this.usuario.push(users);
                                axios.get('/usuario')
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
                    if(this.users.pdv_id === ''){
                        toastr.warning('llena todos los campos');
                        $("#pdv_id").css("border-color", "#DA3E47");
                        return;
                    }else{
                        $("#pdv_id").css("border-color", "#D5DBDB");
                    }


                    axios.put(`/usuario/${this.use_id}`, this.users).then(res=>{
                            if (res.data.success==true) {
                                toastr.success(res.data.msg);
                                //this.usuario[this.index] =users;
                                axios.get('/usuario')
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
                    axios.delete(`usuario/${this.acc_id}`)
                    .then(()=>{
                        this.usuario.splice(this.index,1);
                        toastr.success('Eliminado');
                    })
                    .catch(error => {
                        toastr.error('Error al eliminar');
                    });
                    $('#modalEliminar').modal('hide')

                },
                abrirModalEditar(datos){
                    this.titulo='Editar usuario'
                    this.users.per_name=datos.per_name
                    this.users.per_lastname=datos.per_lastname
                    this.users.per_lastname2=datos.per_lastname2
                    this.users.per_ci=datos.per_ci
                    this.users.per_date=datos.per_date
                    this.users.per_phone=datos.per_phone
                    this.users.per_mobile=datos.per_mobile
                    this.users.per_email=datos.per_email
                    this.users.per_sex=datos.per_sex
                    this.users.use_username=datos.use_username
                    this.users.pdv_id=datos.pdv_id
                    this.users.use_state=datos.use_state
                    this.users.acc_value=''
                    this.btnCrear=false
                    this.btnEditar=true
                    this.use_id=datos.use_id
                    axios.get(`/usuario/perfil/${this.use_id}`)
                                    .then(
                                        res=>{
                                            //this.usuario=res.data
                                            this.users.pro_id=res.data
                                            //console.log(res.data)
                                        }
                                    );

                    $('#modalForm').modal('show')
                },
                abrirModalNuevo(){
                    this.titulo='Nuevo Usuario'
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
                    this.users.pdv_id=''
                    this.users.use_state='1'
                    this.users.acc_value=''
                    this.users.pro_id=''
                    this.btnCrear=true
                    this.btnEditar=false
                    $('#modalForm').modal('show')
                },
                abrirModalEliminar(datos,index){
                    this.users.per_name=datos.per_name
                    this.users.per_lastname=datos.per_lastname
                    this.users.per_lastname2=datos.per_lastname2
                    this.acc_id=datos.acc_id
                    this.index=index
                    $('#modalEliminar').modal('show')
                }
            }
        }
</script>
