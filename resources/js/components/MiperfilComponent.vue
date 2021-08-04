<template>
  <div
    class="container-fluid"
    style="background:#f4f6f9;padding-top:10px;position:relative"
  >
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <center class="mt-4">
              <img src="img/person1.png" class="img-circle" width="150" />
              <h6 class="card-subtitle pt-2">{{ this.session }}</h6>
            </center>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card" v-for="(item, index) in datosDB" :key="index">
          <div class="card-body">
            <form class="form-horizontal form-material mx-1">
              <br />
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
                        <input
                          v-if="btnEditar"
                          v-model="datoLocal.use_username"
                          type="text"
                          placeholder="NickName"
                          class="form-control"
                          id="use_username"
                          @keyup="valida"
                          @blur="normal"
                          @click="valida"
                        />
                        <p v-else class="py-0 pl-0">{{
                          item.use_username
                        }}</p>
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
                        <input
                          v-if="btnEditar"
                          v-model="datoLocal.per_name"
                          type="text"
                          placeholder="Nombre"
                          class="form-control"
                          id="per_name"
                          @keyup="valida"
                          @blur="normal"
                          @click="valida"
                        />
                        <p v-else class="py-0 pl-0">{{ item.per_name }}</p>
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
                        <input
                          v-if="btnEditar"
                          v-model="datoLocal.per_lastname"
                          type="text"
                          placeholder="Ap. Paterno"
                          class="form-control"
                          id="per_lastname"
                          @keyup="valida"
                          @blur="normal"
                          @click="valida"
                        />
                        <p v-else class="py-0 pl-0">{{
                          item.per_lastname
                        }}</p>
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
                        <input
                          v-if="btnEditar"
                          v-model="datoLocal.per_lastname2"
                          type="text"
                          placeholder="Ap. Materno"
                          class="form-control"
                          id="per_lastname2"
                        />
                        <p v-else class="py-0 pl-0">{{
                          item.per_lastname2
                        }}</p>
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
                        <input
                          v-if="btnEditar"
                          v-model="datoLocal.per_ci"
                          type="number"
                          placeholder="Cedula de identidad"
                          class="form-control"
                          id="per_ci"
                          @keyup="valida"
                          @blur="normal"
                          @click="valida"
                        />
                        <p v-else class="py-0 pl-0">{{ item.per_ci }}</p>
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
                        <input
                          v-if="btnEditar"
                          v-model="datoLocal.per_email"
                          type="email"
                          placeholder="Email"
                          class="form-control"
                          id="per_email"
                          @keyup="valida"
                          @blur="normal"
                          @click="valida"
                        />
                        <p v-else class="py-0 pl-0">{{ item.per_email }}</p>
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
                        <b-form-select
                          v-if="btnEditar"
                          v-model="datoLocal.dir_id"
                          :options="options"
                          id="dir_id"
                          @keyup="valida"
                          @blur="normal"
                          @click="valida"
                        >
                          <option disabled value="">Ciudad</option>
                        </b-form-select>
                        <p v-else class="py-0 pl-0">{{ item.dir_name }}</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12 py-0 pl-0">
                        <label class="col-sm-12 py-0">
                          fecha de nacimiento
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 py-0">
                        <input
                          v-if="btnEditar"
                          v-model="datoLocal.per_date"
                          type="date"
                          placeholder="Fecha de nacimiento"
                          class="form-control"
                        />
                        <p v-else class="py-0 pl-0">{{ item.per_date }}</p>
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
                        <input
                          v-if="btnEditar"
                          v-model="datoLocal.per_phone"
                          type="number"
                          placeholder="Telefono"
                          class="form-control"
                          id="per_phone"
                        />
                        <p v-else class="py-0 pl-0">{{ item.per_phone }}</p>
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
                        <input
                          v-if="btnEditar"
                          v-model="datoLocal.per_mobile"
                          type="number"
                          placeholder="Celular"
                          class="form-control"
                          id="per_mobile"
                          @keyup="valida"
                          @blur="normal"
                          @click="valida"
                        />
                        <p v-else class="py-0 pl-0">{{
                          item.per_mobile
                        }}</p>
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
                          Sexo
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 py-0">
                        <center v-if="btnEditar">
                          <div class="row">
                            <div class="col-md-6">
                              <input
                                type="radio"
                                id="hombre"
                                value="1"
                                v-model="datoLocal.per_sex"
                              />
                              <label for="hombre">Hombre</label>
                            </div>
                            <div class="col-md-6">
                              <input
                                type="radio"
                                id="mujer"
                                value="0"
                                v-model="datoLocal.per_sex"
                              />
                              <label for="mujer">Mujer</label>
                            </div>
                          </div>
                        </center>
                        <p v-else-if="item.per_sex == 1" class="py-0 pl-0">{{
                          "Hombre"
                        }}</p>
                        <p v-else-if="item.per_sex == 0" class="py-0 pl-0">{{
                          "Mujer"
                        }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div v-if="btnEditar" class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12 py-0 pl-0">
                        <label class="col-sm-12 py-0">
                          Nueva Contraseña
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 py-0">
                        <b-form-input
                          type="password"
                          id="input-live"
                          v-model="datoLocal.acc_value"
                          :state="nameState1"
                          aria-describedby="input-live-help input-live-feedback"
                          placeholder="Password"
                          trim
                        ></b-form-input>
                        <!-- This will only be shown if the preceding input has an invalid state -->
                        <b-form-invalid-feedback id="input-live-feedback">
                          Introduzca mas de 8 caracteres, entre numeros y letras
                        </b-form-invalid-feedback>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12 py-0 pl-0">
                        <label class="col-sm-12 py-0">
                          Confirme la Contraseña
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 py-0">
                        <b-form-input
                          type="password"
                          id="input-live2"
                          v-model="datoLocal.acc_value2"
                          :state="nameState2"
                          aria-describedby="input-live2-help input-live2-feedback"
                          placeholder="Password"
                          trim
                        ></b-form-input>
                        <!-- This will only be shown if the preceding input has an invalid state -->
                        <!-- <b-form-invalid-feedback id="input-live2-feedback">
                                                    Confirme Contraseña
                                                </b-form-invalid-feedback> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div v-if="btnEditar" class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12 py-0 pl-0">
                        <label class="col-sm-12 py-0">
                          Introduzca su Contraseña para poder editar
                        </label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 py-0">
                        <input
                          class="form-control"
                          type="password"
                          v-model="datoLocal.acc_value_ant"
                          id="acc_value_ant"
                          @keyup="valida"
                          @blur="normal"
                          @click="valida"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="card-footer">
            <div class="row text-center">
              <div class="col-sm-6">
                <button
                  v-if="btnEditar"
                  class="btn btn-success btn-sm navbar-left"
                  @click="editar()"
                  title="modificar"
                >
                  <i class="fas fa-pencil-alt"> Guardar</i>
                </button>

                <button
                  v-else
                  class="btn btn-success btn-sm navbar-left"
                  @click="abrirModalEditar(item)"
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
                  <i class="fas fa-pencil-alt"> Cancelar</i>
                </button>
                <button v-else class="btn btn-info btn-sm" title="Detalles">
                  <i class="fas fa-info-circle"> Mas Informacion</i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    nameState1() {
      return this.datoLocal.acc_value.length > 7 ? true : false;
    },
    nameState2() {
      if (this.datoLocal.acc_value === this.datoLocal.acc_value2) {
        return true;
      } else {
        return false;
      }
    }
  },
  data() {
    return {
      datosDB: [],
      options: [],
      datoLocal: {
        per_name: "",
        per_lastname: "",
        per_lastname2: "",
        per_ci: "",
        per_date: "",
        per_phone: "",
        per_mobile: "",
        per_email: "",
        per_sex: "",
        use_username: "",
        dir_id: "",
        acc_value: "",
        acc_value2: "",
        acc_value_ant: ""
      },
      titulo: "",
      session: this.$attrs.session,
      btnEditar: false
    };
  },
  created() {
    axios.get("./miperfil").then(res => {
      this.datosDB = res.data;
    }),
      axios.get("./polidivi/combobox").then(res => {
        this.options = res.data;
      });
  },
  methods: {
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
    editar() {
      if (this.datoLocal.use_username.trim() === "") {
        toastr.warning("llena todos los campos que corresponda");
        $("#use_username").css("border-color", "#DA3E47");
        return;
      } else {
        $("#use_username").css("border-color", "#D5DBDB");
      }
      if (this.datoLocal.per_name.trim() === "") {
        toastr.warning("llena todos los campos que corresponda");
        $("#per_name").css("border-color", "#DA3E47");
        return;
      }
      if (this.datoLocal.per_lastname.trim() === "") {
        toastr.warning("llena todos los campos que corresponda");
        $("#per_lastname").css("border-color", "#DA3E47");
        return;
      }
      if (this.datoLocal.per_ci === "") {
        toastr.warning("llena todos los campos que corresponda");
        $("#per_ci").css("border-color", "#DA3E47");
        return;
      }

      if (this.datoLocal.per_mobile.trim() === "") {
        toastr.warning("llena todos los campos que corresponda");
        $("#per_mobile").css("border-color", "#DA3E47");
        return;
      }
      if (this.datoLocal.per_email.trim() === "") {
        toastr.warning("llena todos los campos que corresponda");
        $("#per_email").css("border-color", "#DA3E47");
        return;
      }
      if (
        this.datoLocal.acc_value.trim() != "" &&
        this.datoLocal.acc_value2.trim() === ""
      ) {
        toastr.warning("Confirme su contraseña");
        $("#input-live2").css("border-color", "#DA3E47");
        $("#input-live2").css(
          "box-shadow",
          "0 1px 1px rgba(236, 27, 27, 0.575) inset, 0 0 5px rgba(238, 24, 24, 0.63)"
        );
        return;
      }
      if (this.datoLocal.acc_value.trim() != this.datoLocal.acc_value2.trim()) {
        toastr.warning("La nueva contraseña no son iguales");
        $("#input-live").css("border-color", "#DA3E47");
        $("#input-live").css(
          "box-shadow",
          "0 1px 1px rgba(236, 27, 27, 0.575) inset, 0 0 5px rgba(238, 24, 24, 0.63)"
        );
        $("#input-live2").css("border-color", "#DA3E47");
        $("#input-live2").css(
          "box-shadow",
          "0 1px 1px rgba(236, 27, 27, 0.575) inset, 0 0 5px rgba(238, 24, 24, 0.63)"
        );
        return;
      }
      if (this.datoLocal.acc_value_ant.trim() === "") {
        toastr.warning("Introduzca su contraseña para editar");
        $("#acc_value_ant").css("border-color", "#DA3E47");
        return;
      }

      axios
        .put(
          `public/../miperfil/${this.datoLocal.use_username}`,
          this.datoLocal
        )
        .then(res => {
          if (res.data.success == true) {
            toastr.success(res.data.msg);
            this.btnEditar = false;
            axios.get("./miperfil").then(res => {
              this.datosDB = res.data;
            });
          } else {
            toastr.error(res.data.msg);
            $("#" + res.data.id).css("border-color", "#DA3E47");
            $("#" + res.data.id).css(
              "box-shadow",
              "0 1px 1px rgba(236, 27, 27, 0.575) inset, 0 0 5px rgba(238, 24, 24, 0.63)"
            );
          }
        })
        .catch(err => toastr.error("Error al ingresar los datos"));
    },
    abrirModalEditar(item) {
      this.titulo = "Editar Perfil";
      this.datoLocal.per_name = item.per_name;
      this.datoLocal.per_lastname = item.per_lastname;
      this.datoLocal.per_lastname2 = item.per_lastname2;
      this.datoLocal.per_ci = item.per_ci;
      this.datoLocal.per_date = item.per_date;
      this.datoLocal.per_phone = item.per_phone;
      this.datoLocal.per_mobile = item.per_mobile;
      this.datoLocal.per_email = item.per_email;
      this.datoLocal.per_sex = item.per_sex;
      this.datoLocal.use_username = item.use_username;
      this.datoLocal.dir_id = item.dir_id;
      this.datoLocal.acc_value = "";
      this.datoLocal.acc_value2 = "";
      this.datoLocal.acc_value_ant = "";
      this.btnCrear = false;
      this.btnEditar = true;
      //$('#modalForm').modal('show')
    },
    Cancelar() {
      this.btnEditar = false;
    }
  }
};
</script>
