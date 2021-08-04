<template>
  <div class="container">
    <button
      class="btn btn-success btn-md mb-3 mt-3"
      @click="abrirModalNuevo()"
      title="modificar"
    >
      <i class="fas fa-user-plus"> Nuevo Modulo</i>
    </button>
    <div class="row">
      <div class="col-sm">
        <div class="card" style="width: auto;">

          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <!-- <v-app id="inspire"> -->
              <v-treeview
                item-disabled="locked"
                :items="items"
                activatable
                open-on-click
              >
                <template slot="label" slot-scope="{ item }">
                  <div @click="modulos(item)">{{ item.name }}</div>
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
                              v-model="datosDB.mod_name"
                              type="text"
                              placeholder="Nombre"
                              class="form-control"
                              id="mod_name"
                              @keyup="valida"
                              @blur="normal"
                              @click="valida"
                            />
                            <p v-else class="py-0 pl-0">{{ datosDB.mod_name }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 py-0 pl-0">
                            <label class="col-sm-12 py-0">
                              Icono
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">
                            <select v-if="btnEditar" v-model="datosDB.mod_icono" name="mod_icono" id="mod_icono" style="display: flex;
                            justify-content: center; position:-webkit-sticky;text-align-last: center"
                                class="form-select text-center fa-2x fa" onfocus='this.size=4;' onblur='this.size=1;'
                                onchange='this.size=1; this.blur();'>
                                <option value="f007" class="fa-2x fa">&#xf007</option>
                                <option value="f641" class="fa-2x fa">&#xf641</option>
                                <option value="f2b9" class="fa-2x fa">&#xf2b9</option>
                                <option value="f2bb" class="fa-2x fa">&#xf2bb</option>
                                <option value="f042" class="fa-2x fa">&#xf042</option>
                                <option value="f5d0" class="fa-2x fa">&#xf5d0</option>
                                <option value="f037" class="fa-2x fa">&#xf037 </option>
                                <option value="f039" class="fa-2x fa">&#xf039 </option>
                                <option value="f036" class="fa-2x fa">&#xf036 </option>
                                <option value="f038" class="fa-2x fa">&#xf038 </option>
                                <option value="f461" class="fa-2x fa">&#xf461 </option>
                                <option value="f0f9" class="fa-2x fa">&#xf0f9 </option>
                                <option value="f2a3" class="fa-2x fa">&#xf2a3 </option>
                                <option value="f13d" class="fa-2x fa">&#xf13d </option>
                                <option value="f103" class="fa-2x fa">&#xf103 </option>
                                <option value="f100" class="fa-2x fa">&#xf100 </option>
                                <option value="f101" class="fa-2x fa">&#xf101 </option>
                                <option value="f102" class="fa-2x fa">&#xf102 </option>
                                <option value="f107" class="fa-2x fa">&#xf107 </option>
                                <option value="f104" class="fa-2x fa">&#xf104 </option>
                                <option value="f105" class="fa-2x fa">&#xf105 </option>
                                <option value="f106" class="fa-2x fa">&#xf106 </option>
                                <option value="f556" class="fa-2x fa">&#xf556 </option>
                                <option value="f644" class="fa-2x fa">&#xf644 </option>
                                <option value="f5d1" class="fa-2x fa">&#xf5d1 </option>
                                <option value="f187" class="fa-2x fa">&#xf187 </option>
                                <option value="f557" class="fa-2x fa">&#xf557 </option>
                                <option value="f358" class="fa-2x fa">&#xf358 </option>
                                <option value="f359" class="fa-2x fa">&#xf359 </option>
                                <option value="f35a" class="fa-2x fa">&#xf35a </option>
                                <option value="f35b" class="fa-2x fa">&#xf35b </option>
                                <option value="f0ab" class="fa-2x fa">&#xf0ab </option>
                                <option value="f0a8" class="fa-2x fa">&#xf0a8 </option>
                                <option value="f0a9" class="fa-2x fa">&#xf0a9 </option>
                                <option value="f0aa" class="fa-2x fa">&#xf0aa </option>
                                <option value="f063" class="fa-2x fa">&#xf063 </option>
                                <option value="f060" class="fa-2x fa">&#xf060 </option>
                                <option value="f061" class="fa-2x fa">&#xf061 </option>
                                <option value="f062" class="fa-2x fa">&#xf062 </option>
                                <option value="f0b2" class="fa-2x fa">&#xf0b2 </option>
                                <option value="f337" class="fa-2x fa">&#xf337 </option>
                                <option value="f338" class="fa-2x fa">&#xf338 </option>
                                <option value="f2a2" class="fa-2x fa">&#xf2a2 </option>
                                <option value="f069" class="fa-2x fa">&#xf069 </option>
                                <option value="f1fa" class="fa-2x fa">&#xf1fa </option>
                                <option value="f558" class="fa-2x fa">&#xf558 </option>
                                <option value="f5d2" class="fa-2x fa">&#xf5d2 </option>
                                <option value="f29e" class="fa-2x fa">&#xf29e </option>
                                <option value="f559" class="fa-2x fa">&#xf559 </option>
                                <option value="f77c" class="fa-2x fa">&#xf77c </option>
                                <option value="f77d" class="fa-2x fa">&#xf77d </option>
                                <option value="f55a" class="fa-2x fa">&#xf55a </option>
                                <option value="f04a" class="fa-2x fa">&#xf04a </option>
                                <option value="f7e5" class="fa-2x fa">&#xf7e5 </option>
                                <option value="f666" class="fa-2x fa">&#xf666 </option>
                                <option value="f24e" class="fa-2x fa">&#xf24e </option>
                                <option value="f515" class="fa-2x fa">&#xf515 </option>
                                <option value="f516" class="fa-2x fa">&#xf516 </option>
                                <option value="f05e" class="fa-2x fa">&#xf05e </option>
                                <option value="f462" class="fa-2x fa">&#xf462 </option>
                                <option value="f02a" class="fa-2x fa">&#xf02a </option>
                                <option value="f0c9" class="fa-2x fa">&#xf0c9 </option>
                                <option value="f433" class="fa-2x fa">&#xf433 </option>
                                <option value="f434" class="fa-2x fa">&#xf434 </option>
                                <option value="f2cd" class="fa-2x fa">&#xf2cd </option>
                                <option value="f244" class="fa-2x fa">&#xf244 </option>
                                <option value="f240" class="fa-2x fa">&#xf240 </option>
                                <option value="f242" class="fa-2x fa">&#xf242 </option>
                                <option value="f243" class="fa-2x fa">&#xf243 </option>
                                <option value="f241" class="fa-2x fa">&#xf241 </option>
                                <option value="f236" class="fa-2x fa">&#xf236 </option>
                                <option value="f0fc" class="fa-2x fa">&#xf0fc </option>
                                <option value="f0f3" class="fa-2x fa">&#xf0f3 </option>
                                <option value="f1f6" class="fa-2x fa">&#xf1f6 </option>
                                <option value="f55b" class="fa-2x fa">&#xf55b </option>
                                <option value="f647" class="fa-2x fa">&#xf647 </option>
                                <option value="f206" class="fa-2x fa">&#xf206 </option>
                                <option value="f84a" class="fa-2x fa">&#xf84a </option>
                                <option value="f1e5" class="fa-2x fa">&#xf1e5 </option>
                                <option value="f780" class="fa-2x fa">&#xf780 </option>
                                <option value="f1fd" class="fa-2x fa">&#xf1fd </option>
                                <option value="f517" class="fa-2x fa">&#xf517 </option>
                                <option value="f6b6" class="fa-2x fa">&#xf6b6 </option>
                                <option value="f29d" class="fa-2x fa">&#xf29d </option>
                                <option value="f781" class="fa-2x fa">&#xf781 </option>
                                <option value="f032" class="fa-2x fa">&#xf032 </option>
                                <option value="f0e7" class="fa-2x fa">&#xf0e7 </option>
                                <option value="f1e2" class="fa-2x fa">&#xf1e2 </option>
                                <option value="f5d7" class="fa-2x fa">&#xf5d7 </option>
                                <option value="f55c" class="fa-2x fa">&#xf55c </option>
                                <option value="f02d" class="fa-2x fa">&#xf02d </option>
                                <option value="f6b7" class="fa-2x fa">&#xf6b7 </option>
                                <option value="f7e6" class="fa-2x fa">&#xf7e6 </option>
                                <option value="f518" class="fa-2x fa">&#xf518 </option>
                                <option value="f5da" class="fa-2x fa">&#xf5da </option>
                                <option value="f02e" class="fa-2x fa">&#xf02e </option>
                                <option value="f84c" class="fa-2x fa">&#xf84c </option>
                                <option value="f850" class="fa-2x fa">&#xf850 </option>
                                <option value="f853" class="fa-2x fa">&#xf853 </option>
                                <option value="f436" class="fa-2x fa">&#xf436 </option>
                                <option value="f466" class="fa-2x fa">&#xf466 </option>
                                <option value="f49e" class="fa-2x fa">&#xf49e </option>
                                <option value="f468" class="fa-2x fa">&#xf468 </option>
                                <option value="f2a1" class="fa-2x fa">&#xf2a1 </option>
                                <option value="f5dc" class="fa-2x fa">&#xf5dc </option>
                                <option value="f7ec" class="fa-2x fa">&#xf7ec </option>
                                <option value="f0b1" class="fa-2x fa">&#xf0b1 </option>
                                <option value="f469" class="fa-2x fa">&#xf469 </option>
                                <option value="f519" class="fa-2x fa">&#xf519 </option>
                                <option value="f51a" class="fa-2x fa">&#xf51a </option>
                                <option value="f55d" class="fa-2x fa">&#xf55d </option>
                                <option value="f188" class="fa-2x fa">&#xf188 </option>
                                <option value="f1ad" class="fa-2x fa">&#xf1ad </option>
                                <option value="f0a1" class="fa-2x fa">&#xf0a1 </option>
                                <option value="f140" class="fa-2x fa">&#xf140 </option>
                                <option value="f46a" class="fa-2x fa">&#xf46a </option>
                                <option value="f207" class="fa-2x fa">&#xf207 </option>
                                <option value="f55e" class="fa-2x fa">&#xf55e </option>
                                <option value="f64a" class="fa-2x fa">&#xf64a </option>
                                <option value="f1ec" class="fa-2x fa">&#xf1ec </option>
                                <option value="f133" class="fa-2x fa">&#xf133 </option>
                                <option value="f073" class="fa-2x fa">&#xf073 </option>
                                <option value="f274" class="fa-2x fa">&#xf274 </option>
                                <option value="f783" class="fa-2x fa">&#xf783 </option>
                                <option value="f272" class="fa-2x fa">&#xf272 </option>
                                <option value="f271" class="fa-2x fa">&#xf271 </option>
                                <option value="f273" class="fa-2x fa">&#xf273 </option>
                                <option value="f784" class="fa-2x fa">&#xf784 </option>
                                <option value="f030" class="fa-2x fa">&#xf030 </option>
                                <option value="f083" class="fa-2x fa">&#xf083 </option>
                                <option value="f6bb" class="fa-2x fa">&#xf6bb </option>
                                <option value="f786" class="fa-2x fa">&#xf786 </option>
                                <option value="f55f" class="fa-2x fa">&#xf55f </option>
                                <option value="f46b" class="fa-2x fa">&#xf46b </option>
                                <option value="f1b9" class="fa-2x fa">&#xf1b9 </option>
                                <option value="f5de" class="fa-2x fa">&#xf5de </option>
                                <option value="f5df" class="fa-2x fa">&#xf5df </option>
                                <option value="f5e1" class="fa-2x fa">&#xf5e1 </option>
                                <option value="f5e4" class="fa-2x fa">&#xf5e4 </option>
                                <option value="f8ff" class="fa-2x fa">&#xf8ff </option>
                                <option value="f0d7" class="fa-2x fa">&#xf0d7 </option>
                                <option value="f0d9" class="fa-2x fa">&#xf0d9 </option>
                                <option value="f0da" class="fa-2x fa">&#xf0da </option>
                                <option value="f150" class="fa-2x fa">&#xf150 </option>
                                <option value="f191" class="fa-2x fa">&#xf191 </option>
                                <option value="f152" class="fa-2x fa">&#xf152 </option>
                                <option value="f151" class="fa-2x fa">&#xf151 </option>
                                <option value="f0d8" class="fa-2x fa">&#xf0d8 </option>
                                <option value="f787" class="fa-2x fa">&#xf787 </option>
                                <option value="f218" class="fa-2x fa">&#xf218 </option>
                                <option value="f217" class="fa-2x fa">&#xf217 </option>
                                <option value="f788" class="fa-2x fa">&#xf788 </option>
                                <option value="f6be" class="fa-2x fa">&#xf6be </option>
                                <option value="f0a3" class="fa-2x fa">&#xf0a3 </option>
                                <option value="f6c0" class="fa-2x fa">&#xf6c0 </option>
                                <option value="f51b" class="fa-2x fa">&#xf51b </option>
                                <option value="f51c" class="fa-2x fa">&#xf51c </option>
                                <option value="f5e7" class="fa-2x fa">&#xf5e7 </option>
                                <option value="f1fe" class="fa-2x fa">&#xf1fe </option>
                                <option value="f080" class="fa-2x fa">&#xf080 </option>
                                <option value="f201" class="fa-2x fa">&#xf201 </option>
                                <option value="f200" class="fa-2x fa">&#xf200 </option>
                                <option value="f00c" class="fa-2x fa">&#xf00c </option>
                                <option value="f058" class="fa-2x fa">&#xf058 </option>
                                <option value="f560" class="fa-2x fa">&#xf560 </option>
                                <option value="f14a" class="fa-2x fa">&#xf14a </option>
                                <option value="f7ef" class="fa-2x fa">&#xf7ef </option>
                                <option value="f439" class="fa-2x fa">&#xf439 </option>
                                <option value="f43a" class="fa-2x fa">&#xf43a </option>
                                <option value="f43c" class="fa-2x fa">&#xf43c </option>
                                <option value="f43f" class="fa-2x fa">&#xf43f </option>
                                <option value="f441" class="fa-2x fa">&#xf441 </option>
                                <option value="f443" class="fa-2x fa">&#xf443 </option>
                                <option value="f445" class="fa-2x fa">&#xf445 </option>
                                <option value="f447" class="fa-2x fa">&#xf447 </option>
                                <option value="f13a" class="fa-2x fa">&#xf13a </option>
                                <option value="f137" class="fa-2x fa">&#xf137 </option>
                                <option value="f138" class="fa-2x fa">&#xf138 </option>
                                <option value="f139" class="fa-2x fa">&#xf139 </option>
                                <option value="f078" class="fa-2x fa">&#xf078 </option>
                                <option value="f053" class="fa-2x fa">&#xf053 </option>
                                <option value="f054" class="fa-2x fa">&#xf054 </option>
                                <option value="f077" class="fa-2x fa">&#xf077 </option>
                                <option value="f1ae" class="fa-2x fa">&#xf1ae </option>
                                <option value="f51d" class="fa-2x fa">&#xf51d </option>
                                <option value="f111" class="fa-2x fa">&#xf111 </option>
                                <option value="f1ce" class="fa-2x fa">&#xf1ce </option>
                                <option value="f64f" class="fa-2x fa">&#xf64f </option>
                                <option value="f7f2" class="fa-2x fa">&#xf7f2 </option>
                                <option value="f328" class="fa-2x fa">&#xf328 </option>
                                <option value="f46c" class="fa-2x fa">&#xf46c </option>
                                <option value="f46d" class="fa-2x fa">&#xf46d </option>
                                <option value="f017" class="fa-2x fa">&#xf017 </option>
                                <option value="f24d" class="fa-2x fa">&#xf24d </option>
                                <option value="f20a" class="fa-2x fa">&#xf20a </option>
                                <option value="f0c2" class="fa-2x fa">&#xf0c2 </option>
                                <option value="f381" class="fa-2x fa">&#xf381 </option>
                                <option value="f73b" class="fa-2x fa">&#xf73b </option>
                                <option value="f6c3" class="fa-2x fa">&#xf6c3 </option>
                                <option value="f73c" class="fa-2x fa">&#xf73c </option>
                                <option value="f73d" class="fa-2x fa">&#xf73d </option>
                                <option value="f740" class="fa-2x fa">&#xf740 </option>
                                <option value="f6c4" class="fa-2x fa">&#xf6c4 </option>
                                <option value="f743" class="fa-2x fa">&#xf743 </option>
                                <option value="f382" class="fa-2x fa">&#xf382 </option>
                                <option value="f561" class="fa-2x fa">&#xf561 </option>
                                <option value="f121" class="fa-2x fa">&#xf121 </option>
                                <option value="f126" class="fa-2x fa">&#xf126 </option>
                                <option value="f0f4" class="fa-2x fa">&#xf0f4 </option>
                                <option value="f013" class="fa-2x fa">&#xf013 </option>
                                <option value="f085" class="fa-2x fa">&#xf085 </option>
                                <option value="f51e" class="fa-2x fa">&#xf51e </option>
                                <option value="f0db" class="fa-2x fa">&#xf0db </option>
                                <option value="f075" class="fa-2x fa">&#xf075 </option>
                                <option value="f27a" class="fa-2x fa">&#xf27a </option>
                                <option value="f651" class="fa-2x fa">&#xf651 </option>
                                <option value="f4ad" class="fa-2x fa">&#xf4ad </option>
                                <option value="f7f5" class="fa-2x fa">&#xf7f5 </option>
                                <option value="f4b3" class="fa-2x fa">&#xf4b3 </option>
                                <option value="f086" class="fa-2x fa">&#xf086 </option>
                                <option value="f653" class="fa-2x fa">&#xf653 </option>
                                <option value="f51f" class="fa-2x fa">&#xf51f </option>
                                <option value="f14e" class="fa-2x fa">&#xf14e </option>
                                <option value="f066" class="fa-2x fa">&#xf066 </option>
                                <option value="f422" class="fa-2x fa">&#xf422 </option>
                                <option value="f78c" class="fa-2x fa">&#xf78c </option>
                                <option value="f562" class="fa-2x fa">&#xf562 </option>
                                <option value="f563" class="fa-2x fa">&#xf563 </option>
                                <option value="f564" class="fa-2x fa">&#xf564 </option>
                                <option value="f0c5" class="fa-2x fa">&#xf0c5 </option>
                                <option value="f1f9" class="fa-2x fa">&#xf1f9 </option>
                                <option value="f4b8" class="fa-2x fa">&#xf4b8 </option>
                                <option value="f09d" class="fa-2x fa">&#xf09d </option>
                                <option value="f125" class="fa-2x fa">&#xf125 </option>
                                <option value="f565" class="fa-2x fa">&#xf565 </option>
                                <option value="f654" class="fa-2x fa">&#xf654 </option>
                                <option value="f05b" class="fa-2x fa">&#xf05b </option>
                                <option value="f520" class="fa-2x fa">&#xf520 </option>
                                <option value="f521" class="fa-2x fa">&#xf521 </option>
                                <option value="f7f7" class="fa-2x fa">&#xf7f7 </option>
                                <option value="f1b2" class="fa-2x fa">&#xf1b2 </option>
                                <option value="f1b3" class="fa-2x fa">&#xf1b3 </option>
                                <option value="f0c4" class="fa-2x fa">&#xf0c4 </option>
                                <option value="f1c0" class="fa-2x fa">&#xf1c0 </option>
                                <option value="f2a4" class="fa-2x fa">&#xf2a4 </option>
                                <option value="f747" class="fa-2x fa">&#xf747 </option>
                                <option value="f108" class="fa-2x fa">&#xf108 </option>
                                <option value="f655" class="fa-2x fa">&#xf655 </option>
                                <option value="f470" class="fa-2x fa">&#xf470 </option>
                                <option value="f522" class="fa-2x fa">&#xf522 </option>
                                <option value="f6cf" class="fa-2x fa">&#xf6cf </option>
                                <option value="f6d1" class="fa-2x fa">&#xf6d1 </option>
                                <option value="f523" class="fa-2x fa">&#xf523 </option>
                                <option value="f524" class="fa-2x fa">&#xf524 </option>
                                <option value="f525" class="fa-2x fa">&#xf525 </option>
                                <option value="f526" class="fa-2x fa">&#xf526 </option>
                                <option value="f527" class="fa-2x fa">&#xf527 </option>
                                <option value="f528" class="fa-2x fa">&#xf528 </option>
                                <option value="f566" class="fa-2x fa">&#xf566 </option>
                                <option value="f5eb" class="fa-2x fa">&#xf5eb </option>
                                <option value="f7fa" class="fa-2x fa">&#xf7fa </option>
                                <option value="f529" class="fa-2x fa">&#xf529 </option>
                                <option value="f567" class="fa-2x fa">&#xf567 </option>
                                <option value="f471" class="fa-2x fa">&#xf471 </option>
                                <option value="f6d3" class="fa-2x fa">&#xf6d3 </option>
                                <option value="f155" class="fa-2x fa">&#xf155 </option>
                                <option value="f472" class="fa-2x fa">&#xf472 </option>
                                <option value="f474" class="fa-2x fa">&#xf474 </option>
                                <option value="f4b9" class="fa-2x fa">&#xf4b9 </option>
                                <option value="f52a" class="fa-2x fa">&#xf52a </option>
                                <option value="f52b" class="fa-2x fa">&#xf52b </option>
                                <option value="f192" class="fa-2x fa">&#xf192 </option>
                                <option value="f4ba" class="fa-2x fa">&#xf4ba </option>
                                <option value="f019" class="fa-2x fa">&#xf019 </option>
                                <option value="f568" class="fa-2x fa">&#xf568 </option>
                                <option value="f6d5" class="fa-2x fa">&#xf6d5 </option>
                                <option value="f5ee" class="fa-2x fa">&#xf5ee </option>
                                <option value="f569" class="fa-2x fa">&#xf569 </option>
                                <option value="f56a" class="fa-2x fa">&#xf56a </option>
                                <option value="f6d7" class="fa-2x fa">&#xf6d7 </option>
                                <option value="f44b" class="fa-2x fa">&#xf44b </option>
                                <option value="f793" class="fa-2x fa">&#xf793 </option>
                                <option value="f794" class="fa-2x fa">&#xf794 </option>
                                <option value="f6d9" class="fa-2x fa">&#xf6d9 </option>
                                <option value="f044" class="fa-2x fa">&#xf044 </option>
                                <option value="f7fb" class="fa-2x fa">&#xf7fb </option>
                                <option value="f052" class="fa-2x fa">&#xf052 </option>
                                <option value="f430" class="fa-2x fa">&#xf430 </option>
                                <option value="f141" class="fa-2x fa">&#xf141 </option>
                                <option value="f142" class="fa-2x fa">&#xf142 </option>
                                <option value="f0e0" class="fa-2x fa">&#xf0e0 </option>
                                <option value="f2b6" class="fa-2x fa">&#xf2b6 </option>
                                <option value="f658" class="fa-2x fa">&#xf658 </option>
                                <option value="f199" class="fa-2x fa">&#xf199 </option>
                                <option value="f52c" class="fa-2x fa">&#xf52c </option>
                                <option value="f12d" class="fa-2x fa">&#xf12d </option>
                                <option value="f796" class="fa-2x fa">&#xf796 </option>
                                <option value="f153" class="fa-2x fa">&#xf153 </option>
                                <option value="f362" class="fa-2x fa">&#xf362 </option>
                                <option value="f12a" class="fa-2x fa">&#xf12a </option>
                                <option value="f06a" class="fa-2x fa">&#xf06a </option>
                                <option value="f071" class="fa-2x fa">&#xf071 </option>
                                <option value="f065" class="fa-2x fa">&#xf065 </option>
                                <option value="f424" class="fa-2x fa">&#xf424 </option>
                                <option value="f31e" class="fa-2x fa">&#xf31e </option>
                                <option value="f35d" class="fa-2x fa">&#xf35d </option>
                                <option value="f360" class="fa-2x fa">&#xf360 </option>
                                <option value="f06e" class="fa-2x fa">&#xf06e </option>
                                <option value="f1fb" class="fa-2x fa">&#xf1fb </option>
                                <option value="f070" class="fa-2x fa">&#xf070 </option>
                                <option value="f863" class="fa-2x fa">&#xf863 </option>
                                <option value="f049" class="fa-2x fa">&#xf049 </option>
                                <option value="f050" class="fa-2x fa">&#xf050 </option>
                                <option value="f1ac" class="fa-2x fa">&#xf1ac </option>
                                <option value="f52d" class="fa-2x fa">&#xf52d </option>
                                <option value="f56b" class="fa-2x fa">&#xf56b </option>
                                <option value="f182" class="fa-2x fa">&#xf182 </option>
                                <option value="f0fb" class="fa-2x fa">&#xf0fb </option>
                                <option value="f15b" class="fa-2x fa">&#xf15b </option>
                                <option value="f15c" class="fa-2x fa">&#xf15c </option>
                                <option value="f1c6" class="fa-2x fa">&#xf1c6 </option>
                                <option value="f1c7" class="fa-2x fa">&#xf1c7 </option>
                                <option value="f1c9" class="fa-2x fa">&#xf1c9 </option>
                                <option value="f56c" class="fa-2x fa">&#xf56c </option>
                                <option value="f6dd" class="fa-2x fa">&#xf6dd </option>
                                <option value="f56d" class="fa-2x fa">&#xf56d </option>
                                <option value="f1c3" class="fa-2x fa">&#xf1c3 </option>
                                <option value="f56e" class="fa-2x fa">&#xf56e </option>
                                <option value="f1c5" class="fa-2x fa">&#xf1c5 </option>
                                <option value="f56f" class="fa-2x fa">&#xf56f </option>
                                <option value="f570" class="fa-2x fa">&#xf570 </option>
                                <option value="f571" class="fa-2x fa">&#xf571 </option>
                                <option value="f477" class="fa-2x fa">&#xf477 </option>
                                <option value="f478" class="fa-2x fa">&#xf478 </option>
                                <option value="f1c1" class="fa-2x fa">&#xf1c1 </option>
                                <option value="f1c4" class="fa-2x fa">&#xf1c4 </option>
                                <option value="f572" class="fa-2x fa">&#xf572 </option>
                                <option value="f573" class="fa-2x fa">&#xf573 </option>
                                <option value="f574" class="fa-2x fa">&#xf574 </option>
                                <option value="f1c8" class="fa-2x fa">&#xf1c8 </option>
                                <option value="f1c2" class="fa-2x fa">&#xf1c2 </option>
                                <option value="f575" class="fa-2x fa">&#xf575 </option>
                                <option value="f576" class="fa-2x fa">&#xf576 </option>
                                <option value="f008" class="fa-2x fa">&#xf008 </option>
                                <option value="f0b0" class="fa-2x fa">&#xf0b0 </option>
                                <option value="f577" class="fa-2x fa">&#xf577 </option>
                                <option value="f06d" class="fa-2x fa">&#xf06d </option>
                                <option value="f7e4" class="fa-2x fa">&#xf7e4 </option>
                                <option value="f134" class="fa-2x fa">&#xf134 </option>
                                <option value="f479" class="fa-2x fa">&#xf479 </option>
                                <option value="f578" class="fa-2x fa">&#xf578 </option>
                                <option value="f6de" class="fa-2x fa">&#xf6de </option>
                                <option value="f024" class="fa-2x fa">&#xf024 </option>
                                <option value="f11e" class="fa-2x fa">&#xf11e </option>
                                <option value="f74d" class="fa-2x fa">&#xf74d </option>
                                <option value="f0c3" class="fa-2x fa">&#xf0c3 </option>
                                <option value="f579" class="fa-2x fa">&#xf579 </option>
                                <option value="f07b" class="fa-2x fa">&#xf07b </option>
                                <option value="f65d" class="fa-2x fa">&#xf65d </option>
                                <option value="f07c" class="fa-2x fa">&#xf07c </option>
                                <option value="f65e" class="fa-2x fa">&#xf65e </option>
                                <option value="f031" class="fa-2x fa">&#xf031 </option>
                                <option value="f44e" class="fa-2x fa">&#xf44e </option>
                                <option value="f04e" class="fa-2x fa">&#xf04e </option>
                                <option value="f52e" class="fa-2x fa">&#xf52e </option>
                                <option value="f119" class="fa-2x fa">&#xf119 </option>
                                <option value="f57a" class="fa-2x fa">&#xf57a </option>
                                <option value="f662" class="fa-2x fa">&#xf662 </option>
                                <option value="f1e3" class="fa-2x fa">&#xf1e3 </option>
                                <option value="f11b" class="fa-2x fa">&#xf11b </option>
                                <option value="f52f" class="fa-2x fa">&#xf52f </option>
                                <option value="f0e3" class="fa-2x fa">&#xf0e3 </option>
                                <option value="f3a5" class="fa-2x fa">&#xf3a5 </option>
                                <option value="f22d" class="fa-2x fa">&#xf22d </option>
                                <option value="f6e2" class="fa-2x fa">&#xf6e2 </option>
                                <option value="f06b" class="fa-2x fa">&#xf06b </option>
                                <option value="f79c" class="fa-2x fa">&#xf79c </option>
                                <option value="f79f" class="fa-2x fa">&#xf79f </option>
                                <option value="f000" class="fa-2x fa">&#xf000 </option>
                                <option value="f57b" class="fa-2x fa">&#xf57b </option>
                                <option value="f7a0" class="fa-2x fa">&#xf7a0 </option>
                                <option value="f530" class="fa-2x fa">&#xf530 </option>
                                <option value="f0ac" class="fa-2x fa">&#xf0ac </option>
                                <option value="f57c" class="fa-2x fa">&#xf57c </option>
                                <option value="f57d" class="fa-2x fa">&#xf57d </option>
                                <option value="f57e" class="fa-2x fa">&#xf57e </option>
                                <option value="f7a2" class="fa-2x fa">&#xf7a2 </option>
                                <option value="f450" class="fa-2x fa">&#xf450 </option>
                                <option value="f664" class="fa-2x fa">&#xf664 </option>
                                <option value="f19d" class="fa-2x fa">&#xf19d </option>
                                <option value="f531" class="fa-2x fa">&#xf531 </option>
                                <option value="f532" class="fa-2x fa">&#xf532 </option>
                                <option value="f57f" class="fa-2x fa">&#xf57f </option>
                                <option value="f580" class="fa-2x fa">&#xf580 </option>
                                <option value="f581" class="fa-2x fa">&#xf581 </option>
                                <option value="f582" class="fa-2x fa">&#xf582 </option>
                                <option value="f583" class="fa-2x fa">&#xf583 </option>
                                <option value="f584" class="fa-2x fa">&#xf584 </option>
                                <option value="f585" class="fa-2x fa">&#xf585 </option>
                                <option value="f586" class="fa-2x fa">&#xf586 </option>
                                <option value="f587" class="fa-2x fa">&#xf587 </option>
                                <option value="f588" class="fa-2x fa">&#xf588 </option>
                                <option value="f589" class="fa-2x fa">&#xf589 </option>
                                <option value="f58a" class="fa-2x fa">&#xf58a </option>
                                <option value="f58b" class="fa-2x fa">&#xf58b </option>
                                <option value="f58c" class="fa-2x fa">&#xf58c </option>
                                <option value="f58d" class="fa-2x fa">&#xf58d </option>
                                <option value="f7a4" class="fa-2x fa">&#xf7a4 </option>
                                <option value="f7a5" class="fa-2x fa">&#xf7a5 </option>
                                <option value="f58e" class="fa-2x fa">&#xf58e </option>
                                <option value="f7a6" class="fa-2x fa">&#xf7a6 </option>
                                <option value="f0fd" class="fa-2x fa">&#xf0fd </option>
                                <option value="f805" class="fa-2x fa">&#xf805 </option>
                                <option value="f6e3" class="fa-2x fa">&#xf6e3 </option>
                                <option value="f665" class="fa-2x fa">&#xf665 </option>
                                <option value="f4bd" class="fa-2x fa">&#xf4bd </option>
                                <option value="f4be" class="fa-2x fa">&#xf4be </option>
                                <option value="f4c0" class="fa-2x fa">&#xf4c0 </option>
                                <option value="f4c1" class="fa-2x fa">&#xf4c1 </option>
                                <option value="f258" class="fa-2x fa">&#xf258 </option>
                                <option value="f806" class="fa-2x fa">&#xf806 </option>
                                <option value="f256" class="fa-2x fa">&#xf256 </option>
                                <option value="f25b" class="fa-2x fa">&#xf25b </option>
                                <option value="f0a7" class="fa-2x fa">&#xf0a7 </option>
                                <option value="f0a5" class="fa-2x fa">&#xf0a5 </option>
                                <option value="f0a4" class="fa-2x fa">&#xf0a4 </option>
                                <option value="f0a6" class="fa-2x fa">&#xf0a6 </option>
                                <option value="f25a" class="fa-2x fa">&#xf25a </option>
                                <option value="f255" class="fa-2x fa">&#xf255 </option>
                                <option value="f257" class="fa-2x fa">&#xf257 </option>
                                <option value="f259" class="fa-2x fa">&#xf259 </option>
                                <option value="f4c2" class="fa-2x fa">&#xf4c2 </option>
                                <option value="f4c4" class="fa-2x fa">&#xf4c4 </option>
                                <option value="f2b5" class="fa-2x fa">&#xf2b5 </option>
                                <option value="f6e6" class="fa-2x fa">&#xf6e6 </option>
                                <option value="f807" class="fa-2x fa">&#xf807 </option>
                                <option value="f292" class="fa-2x fa">&#xf292 </option>
                                <option value="f8c0" class="fa-2x fa">&#xf8c0 </option>
                                <option value="f8c1" class="fa-2x fa">&#xf8c1 </option>
                                <option value="f6e8" class="fa-2x fa">&#xf6e8 </option>
                                <option value="f0a0" class="fa-2x fa">&#xf0a0 </option>
                                <option value="f1dc" class="fa-2x fa">&#xf1dc </option>
                                <option value="f025" class="fa-2x fa">&#xf025 </option>
                                <option value="f58f" class="fa-2x fa">&#xf58f </option>
                                <option value="f590" class="fa-2x fa">&#xf590 </option>
                                <option value="f004" class="fa-2x fa">&#xf004 </option>
                                <option value="f7a9" class="fa-2x fa">&#xf7a9 </option>
                                <option value="f21e" class="fa-2x fa">&#xf21e </option>
                                <option value="f533" class="fa-2x fa">&#xf533 </option>
                                <option value="f591" class="fa-2x fa">&#xf591 </option>
                                <option value="f6ec" class="fa-2x fa">&#xf6ec </option>
                                <option value="f6ed" class="fa-2x fa">&#xf6ed </option>
                                <option value="f1da" class="fa-2x fa">&#xf1da </option>
                                <option value="f453" class="fa-2x fa">&#xf453 </option>
                                <option value="f7aa" class="fa-2x fa">&#xf7aa </option>
                                <option value="f015" class="fa-2x fa">&#xf015 </option>
                                <option value="f6f0" class="fa-2x fa">&#xf6f0 </option>
                                <option value="f7ab" class="fa-2x fa">&#xf7ab </option>
                                <option value="f0f8" class="fa-2x fa">&#xf0f8 </option>
                                <option value="f47d" class="fa-2x fa">&#xf47d </option>
                                <option value="f47e" class="fa-2x fa">&#xf47e </option>
                                <option value="f80d" class="fa-2x fa">&#xf80d </option>
                                <option value="f593" class="fa-2x fa">&#xf593 </option>
                                <option value="f80f" class="fa-2x fa">&#xf80f </option>
                                <option value="f594" class="fa-2x fa">&#xf594 </option>
                                <option value="f254" class="fa-2x fa">&#xf254 </option>
                                <option value="f253" class="fa-2x fa">&#xf253 </option>
                                <option value="f252" class="fa-2x fa">&#xf252 </option>
                                <option value="f251" class="fa-2x fa">&#xf251 </option>
                                <option value="f6f1" class="fa-2x fa">&#xf6f1 </option>
                                <option value="f6f2" class="fa-2x fa">&#xf6f2 </option>
                                <option value="f246" class="fa-2x fa">&#xf246 </option>
                                <option value="f810" class="fa-2x fa">&#xf810 </option>
                                <option value="f7ad" class="fa-2x fa">&#xf7ad </option>
                                <option value="f86d" class="fa-2x fa">&#xf86d </option>
                                <option value="f2c1" class="fa-2x fa">&#xf2c1 </option>
                                <option value="f2c2" class="fa-2x fa">&#xf2c2 </option>
                                <option value="f47f" class="fa-2x fa">&#xf47f </option>
                                <option value="f7ae" class="fa-2x fa">&#xf7ae </option>
                                <option value="f03e" class="fa-2x fa">&#xf03e </option>
                                <option value="f302" class="fa-2x fa">&#xf302 </option>
                                <option value="f01c" class="fa-2x fa">&#xf01c </option>
                                <option value="f03c" class="fa-2x fa">&#xf03c </option>
                                <option value="f275" class="fa-2x fa">&#xf275 </option>
                                <option value="f534" class="fa-2x fa">&#xf534 </option>
                                <option value="f129" class="fa-2x fa">&#xf129 </option>
                                <option value="f05a" class="fa-2x fa">&#xf05a </option>
                                <option value="f033" class="fa-2x fa">&#xf033 </option>
                                <option value="f669" class="fa-2x fa">&#xf669 </option>
                                <option value="f595" class="fa-2x fa">&#xf595 </option>
                                <option value="f66a" class="fa-2x fa">&#xf66a </option>
                                <option value="f66b" class="fa-2x fa">&#xf66b </option>
                                <option value="f084" class="fa-2x fa">&#xf084 </option>
                                <option value="f11c" class="fa-2x fa">&#xf11c </option>
                                <option value="f66d" class="fa-2x fa">&#xf66d </option>
                                <option value="f596" class="fa-2x fa">&#xf596 </option>
                                <option value="f597" class="fa-2x fa">&#xf597 </option>
                                <option value="f598" class="fa-2x fa">&#xf598 </option>
                                <option value="f535" class="fa-2x fa">&#xf535 </option>
                                <option value="f66f" class="fa-2x fa">&#xf66f </option>
                                <option value="f1ab" class="fa-2x fa">&#xf1ab </option>
                                <option value="f109" class="fa-2x fa">&#xf109 </option>
                                <option value="f5fc" class="fa-2x fa">&#xf5fc </option>
                                <option value="f812" class="fa-2x fa">&#xf812 </option>
                                <option value="f599" class="fa-2x fa">&#xf599 </option>
                                <option value="f59a" class="fa-2x fa">&#xf59a </option>
                                <option value="f59b" class="fa-2x fa">&#xf59b </option>
                                <option value="f59c" class="fa-2x fa">&#xf59c </option>
                                <option value="f5fd" class="fa-2x fa">&#xf5fd </option>
                                <option value="f06c" class="fa-2x fa">&#xf06c </option>
                                <option value="f094" class="fa-2x fa">&#xf094 </option>
                                <option value="f536" class="fa-2x fa">&#xf536 </option>
                                <option value="f537" class="fa-2x fa">&#xf537 </option>
                                <option value="f3be" class="fa-2x fa">&#xf3be </option>
                                <option value="f3bf" class="fa-2x fa">&#xf3bf </option>
                                <option value="f1cd" class="fa-2x fa">&#xf1cd </option>
                                <option value="f0eb" class="fa-2x fa">&#xf0eb </option>
                                <option value="f0c1" class="fa-2x fa">&#xf0c1 </option>
                                <option value="f195" class="fa-2x fa">&#xf195 </option>
                                <option value="f03a" class="fa-2x fa">&#xf03a </option>
                                <option value="f022" class="fa-2x fa">&#xf022 </option>
                                <option value="f0cb" class="fa-2x fa">&#xf0cb </option>
                                <option value="f0ca" class="fa-2x fa">&#xf0ca </option>
                                <option value="f124" class="fa-2x fa">&#xf124 </option>
                                <option value="f023" class="fa-2x fa">&#xf023 </option>
                                <option value="f3c1" class="fa-2x fa">&#xf3c1 </option>
                                <option value="f309" class="fa-2x fa">&#xf309 </option>
                                <option value="f30a" class="fa-2x fa">&#xf30a </option>
                                <option value="f30b" class="fa-2x fa">&#xf30b </option>
                                <option value="f30c" class="fa-2x fa">&#xf30c </option>
                                <option value="f2a8" class="fa-2x fa">&#xf2a8 </option>
                                <option value="f59d" class="fa-2x fa">&#xf59d </option>
                                <option value="f604" class="fa-2x fa">&#xf604 </option>
                                <option value="f0d0" class="fa-2x fa">&#xf0d0 </option>
                                <option value="f076" class="fa-2x fa">&#xf076 </option>
                                <option value="f674" class="fa-2x fa">&#xf674 </option>
                                <option value="f183" class="fa-2x fa">&#xf183 </option>
                                <option value="f279" class="fa-2x fa">&#xf279 </option>
                                <option value="f59f" class="fa-2x fa">&#xf59f </option>
                                <option value="f5a0" class="fa-2x fa">&#xf5a0 </option>
                                <option value="f041" class="fa-2x fa">&#xf041 </option>
                                <option value="f3c5" class="fa-2x fa">&#xf3c5 </option>
                                <option value="f276" class="fa-2x fa">&#xf276 </option>
                                <option value="f277" class="fa-2x fa">&#xf277 </option>
                                <option value="f5a1" class="fa-2x fa">&#xf5a1 </option>
                                <option value="f222" class="fa-2x fa">&#xf222 </option>
                                <option value="f227" class="fa-2x fa">&#xf227 </option>
                                <option value="f229" class="fa-2x fa">&#xf229 </option>
                                <option value="f22b" class="fa-2x fa">&#xf22b </option>
                                <option value="f22a" class="fa-2x fa">&#xf22a </option>
                                <option value="f6fa" class="fa-2x fa">&#xf6fa </option>
                                <option value="f5a2" class="fa-2x fa">&#xf5a2 </option>
                                <option value="f0fa" class="fa-2x fa">&#xf0fa </option>
                                <option value="f11a" class="fa-2x fa">&#xf11a </option>
                                <option value="f5a4" class="fa-2x fa">&#xf5a4 </option>
                                <option value="f5a5" class="fa-2x fa">&#xf5a5 </option>
                                <option value="f538" class="fa-2x fa">&#xf538 </option>
                                <option value="f676" class="fa-2x fa">&#xf676 </option>
                                <option value="f223" class="fa-2x fa">&#xf223 </option>
                                <option value="f753" class="fa-2x fa">&#xf753 </option>
                                <option value="f2db" class="fa-2x fa">&#xf2db </option>
                                <option value="f130" class="fa-2x fa">&#xf130 </option>
                                <option value="f3c9" class="fa-2x fa">&#xf3c9 </option>
                                <option value="f539" class="fa-2x fa">&#xf539 </option>
                                <option value="f131" class="fa-2x fa">&#xf131 </option>
                                <option value="f610" class="fa-2x fa">&#xf610 </option>
                                <option value="f068" class="fa-2x fa">&#xf068 </option>
                                <option value="f056" class="fa-2x fa">&#xf056 </option>
                                <option value="f146" class="fa-2x fa">&#xf146 </option>
                                <option value="f7b5" class="fa-2x fa">&#xf7b5 </option>
                                <option value="f10b" class="fa-2x fa">&#xf10b </option>
                                <option value="f3cd" class="fa-2x fa">&#xf3cd </option>
                                <option value="f0d6" class="fa-2x fa">&#xf0d6 </option>
                                <option value="f3d1" class="fa-2x fa">&#xf3d1 </option>
                                <option value="f53a" class="fa-2x fa">&#xf53a </option>
                                <option value="f53b" class="fa-2x fa">&#xf53b </option>
                                <option value="f53c" class="fa-2x fa">&#xf53c </option>
                                <option value="f53d" class="fa-2x fa">&#xf53d </option>
                                <option value="f5a6" class="fa-2x fa">&#xf5a6 </option>
                                <option value="f186" class="fa-2x fa">&#xf186 </option>
                                <option value="f5a7" class="fa-2x fa">&#xf5a7 </option>
                                <option value="f678" class="fa-2x fa">&#xf678 </option>
                                <option value="f21c" class="fa-2x fa">&#xf21c </option>
                                <option value="f6fc" class="fa-2x fa">&#xf6fc </option>
                                <option value="f8cc" class="fa-2x fa">&#xf8cc </option>
                                <option value="f245" class="fa-2x fa">&#xf245 </option>
                                <option value="f7b6" class="fa-2x fa">&#xf7b6 </option>
                                <option value="f001" class="fa-2x fa">&#xf001 </option>
                                <option value="f6ff" class="fa-2x fa">&#xf6ff </option>
                                <option value="f22c" class="fa-2x fa">&#xf22c </option>
                                <option value="f1ea" class="fa-2x fa">&#xf1ea </option>
                                <option value="f53e" class="fa-2x fa">&#xf53e </option>
                                <option value="f481" class="fa-2x fa">&#xf481 </option>
                                <option value="f247" class="fa-2x fa">&#xf247 </option>
                                <option value="f248" class="fa-2x fa">&#xf248 </option>
                                <option value="f613" class="fa-2x fa">&#xf613 </option>
                                <option value="f679" class="fa-2x fa">&#xf679 </option>
                                <option value="f700" class="fa-2x fa">&#xf700 </option>
                                <option value="f03b" class="fa-2x fa">&#xf03b </option>
                                <option value="f815" class="fa-2x fa">&#xf815 </option>
                                <option value="f1fc" class="fa-2x fa">&#xf1fc </option>
                                <option value="f5aa" class="fa-2x fa">&#xf5aa </option>
                                <option value="f53f" class="fa-2x fa">&#xf53f </option>
                                <option value="f482" class="fa-2x fa">&#xf482 </option>
                                <option value="f1d8" class="fa-2x fa">&#xf1d8 </option>
                                <option value="f0c6" class="fa-2x fa">&#xf0c6 </option>
                                <option value="f4cd" class="fa-2x fa">&#xf4cd </option>
                                <option value="f1dd" class="fa-2x fa">&#xf1dd </option>
                                <option value="f540" class="fa-2x fa">&#xf540 </option>
                                <option value="f5ab" class="fa-2x fa">&#xf5ab </option>
                                <option value="f67b" class="fa-2x fa">&#xf67b </option>
                                <option value="f0ea" class="fa-2x fa">&#xf0ea </option>
                                <option value="f04c" class="fa-2x fa">&#xf04c </option>
                                <option value="f28b" class="fa-2x fa">&#xf28b </option>
                                <option value="f1b0" class="fa-2x fa">&#xf1b0 </option>
                                <option value="f67c" class="fa-2x fa">&#xf67c </option>
                                <option value="f304" class="fa-2x fa">&#xf304 </option>
                                <option value="f305" class="fa-2x fa">&#xf305 </option>
                                <option value="f5ac" class="fa-2x fa">&#xf5ac </option>
                                <option value="f5ad" class="fa-2x fa">&#xf5ad </option>
                                <option value="f14b" class="fa-2x fa">&#xf14b </option>
                                <option value="f303" class="fa-2x fa">&#xf303 </option>
                                <option value="f5ae" class="fa-2x fa">&#xf5ae </option>
                                <option value="f4ce" class="fa-2x fa">&#xf4ce </option>
                                <option value="f816" class="fa-2x fa">&#xf816 </option>
                                <option value="f295" class="fa-2x fa">&#xf295 </option>
                                <option value="f541" class="fa-2x fa">&#xf541 </option>
                                <option value="f756" class="fa-2x fa">&#xf756 </option>
                                <option value="f095" class="fa-2x fa">&#xf095 </option>
                                <option value="f879" class="fa-2x fa">&#xf879 </option>
                                <option value="f3dd" class="fa-2x fa">&#xf3dd </option>
                                <option value="f098" class="fa-2x fa">&#xf098 </option>
                                <option value="f87b" class="fa-2x fa">&#xf87b </option>
                                <option value="f2a0" class="fa-2x fa">&#xf2a0 </option>
                                <option value="f87c" class="fa-2x fa">&#xf87c </option>
                                <option value="f4d3" class="fa-2x fa">&#xf4d3 </option>
                                <option value="f484" class="fa-2x fa">&#xf484 </option>
                                <option value="f818" class="fa-2x fa">&#xf818 </option>
                                <option value="f67f" class="fa-2x fa">&#xf67f </option>
                                <option value="f072" class="fa-2x fa">&#xf072 </option>
                                <option value="f5af" class="fa-2x fa">&#xf5af </option>
                                <option value="f5b0" class="fa-2x fa">&#xf5b0 </option>
                                <option value="f04b" class="fa-2x fa">&#xf04b </option>
                                <option value="f144" class="fa-2x fa">&#xf144 </option>
                                <option value="f1e6" class="fa-2x fa">&#xf1e6 </option>
                                <option value="f067" class="fa-2x fa">&#xf067 </option>
                                <option value="f055" class="fa-2x fa">&#xf055 </option>
                                <option value="f0fe" class="fa-2x fa">&#xf0fe </option>
                                <option value="f2ce" class="fa-2x fa">&#xf2ce </option>
                                <option value="f681" class="fa-2x fa">&#xf681 </option>
                                <option value="f682" class="fa-2x fa">&#xf682 </option>
                                <option value="f2fe" class="fa-2x fa">&#xf2fe </option>
                                <option value="f75a" class="fa-2x fa">&#xf75a </option>
                                <option value="f619" class="fa-2x fa">&#xf619 </option>
                                <option value="f3e0" class="fa-2x fa">&#xf3e0 </option>
                                <option value="f154" class="fa-2x fa">&#xf154 </option>
                                <option value="f011" class="fa-2x fa">&#xf011 </option>
                                <option value="f683" class="fa-2x fa">&#xf683 </option>
                                <option value="f684" class="fa-2x fa">&#xf684 </option>
                                <option value="f5b1" class="fa-2x fa">&#xf5b1 </option>
                                <option value="f485" class="fa-2x fa">&#xf485 </option>
                                <option value="f486" class="fa-2x fa">&#xf486 </option>
                                <option value="f02f" class="fa-2x fa">&#xf02f </option>
                                <option value="f487" class="fa-2x fa">&#xf487 </option>
                                <option value="f542" class="fa-2x fa">&#xf542 </option>
                                <option value="f12e" class="fa-2x fa">&#xf12e </option>
                                <option value="f029" class="fa-2x fa">&#xf029 </option>
                                <option value="f128" class="fa-2x fa">&#xf128 </option>
                                <option value="f059" class="fa-2x fa">&#xf059 </option>
                                <option value="f458" class="fa-2x fa">&#xf458 </option>
                                <option value="f10d" class="fa-2x fa">&#xf10d </option>
                                <option value="f10e" class="fa-2x fa">&#xf10e </option>
                                <option value="f687" class="fa-2x fa">&#xf687 </option>
                                <option value="f7b9" class="fa-2x fa">&#xf7b9 </option>
                                <option value="f7ba" class="fa-2x fa">&#xf7ba </option>
                                <option value="f75b" class="fa-2x fa">&#xf75b </option>
                                <option value="f074" class="fa-2x fa">&#xf074 </option>
                                <option value="f543" class="fa-2x fa">&#xf543 </option>
                                <option value="f8d9" class="fa-2x fa">&#xf8d9 </option>
                                <option value="f1b8" class="fa-2x fa">&#xf1b8 </option>
                                <option value="f01e" class="fa-2x fa">&#xf01e </option>
                                <option value="f2f9" class="fa-2x fa">&#xf2f9 </option>
                                <option value="f25d" class="fa-2x fa">&#xf25d </option>
                                <option value="f87d" class="fa-2x fa">&#xf87d </option>
                                <option value="f3e5" class="fa-2x fa">&#xf3e5 </option>
                                <option value="f122" class="fa-2x fa">&#xf122 </option>
                                <option value="f75e" class="fa-2x fa">&#xf75e </option>
                                <option value="f7bd" class="fa-2x fa">&#xf7bd </option>
                                <option value="f079" class="fa-2x fa">&#xf079 </option>
                                <option value="f4d6" class="fa-2x fa">&#xf4d6 </option>
                                <option value="f70b" class="fa-2x fa">&#xf70b </option>
                                <option value="f018" class="fa-2x fa">&#xf018 </option>
                                <option value="f544" class="fa-2x fa">&#xf544 </option>
                                <option value="f135" class="fa-2x fa">&#xf135 </option>
                                <option value="f4d7" class="fa-2x fa">&#xf4d7 </option>
                                <option value="f09e" class="fa-2x fa">&#xf09e </option>
                                <option value="f143" class="fa-2x fa">&#xf143 </option>
                                <option value="f158" class="fa-2x fa">&#xf158 </option>
                                <option value="f545" class="fa-2x fa">&#xf545 </option>
                                <option value="f546" class="fa-2x fa">&#xf546 </option>
                                <option value="f547" class="fa-2x fa">&#xf547 </option>
                                <option value="f548" class="fa-2x fa">&#xf548 </option>
                                <option value="f70c" class="fa-2x fa">&#xf70c </option>
                                <option value="f156" class="fa-2x fa">&#xf156 </option>
                                <option value="f5b3" class="fa-2x fa">&#xf5b3 </option>
                                <option value="f5b4" class="fa-2x fa">&#xf5b4 </option>
                                <option value="f7bf" class="fa-2x fa">&#xf7bf </option>
                                <option value="f7c0" class="fa-2x fa">&#xf7c0 </option>
                                <option value="f0c7" class="fa-2x fa">&#xf0c7 </option>
                                <option value="f549" class="fa-2x fa">&#xf549 </option>
                                <option value="f54a" class="fa-2x fa">&#xf54a </option>
                                <option value="f70e" class="fa-2x fa">&#xf70e </option>
                                <option value="f7c2" class="fa-2x fa">&#xf7c2 </option>
                                <option value="f002" class="fa-2x fa">&#xf002 </option>
                                <option value="f688" class="fa-2x fa">&#xf688 </option>
                                <option value="f689" class="fa-2x fa">&#xf689 </option>
                                <option value="f010" class="fa-2x fa">&#xf010 </option>
                                <option value="f00e" class="fa-2x fa">&#xf00e </option>
                                <option value="f4d8" class="fa-2x fa">&#xf4d8 </option>
                                <option value="f233" class="fa-2x fa">&#xf233 </option>
                                <option value="f61f" class="fa-2x fa">&#xf61f </option>
                                <option value="f064" class="fa-2x fa">&#xf064 </option>
                                <option value="f1e0" class="fa-2x fa">&#xf1e0 </option>
                                <option value="f1e1" class="fa-2x fa">&#xf1e1 </option>
                                <option value="f14d" class="fa-2x fa">&#xf14d </option>
                                <option value="f20b" class="fa-2x fa">&#xf20b </option>
                                <option value="f3ed" class="fa-2x fa">&#xf3ed </option>
                                <option value="f21a" class="fa-2x fa">&#xf21a </option>
                                <option value="f48b" class="fa-2x fa">&#xf48b </option>
                                <option value="f54b" class="fa-2x fa">&#xf54b </option>
                                <option value="f290" class="fa-2x fa">&#xf290 </option>
                                <option value="f291" class="fa-2x fa">&#xf291 </option>
                                <option value="f07a" class="fa-2x fa">&#xf07a </option>
                                <option value="f2cc" class="fa-2x fa">&#xf2cc </option>
                                <option value="f5b6" class="fa-2x fa">&#xf5b6 </option>
                                <option value="f4d9" class="fa-2x fa">&#xf4d9 </option>
                                <option value="f2f6" class="fa-2x fa">&#xf2f6 </option>
                                <option value="f2a7" class="fa-2x fa">&#xf2a7 </option>
                                <option value="f2f5" class="fa-2x fa">&#xf2f5 </option>
                                <option value="f012" class="fa-2x fa">&#xf012 </option>
                                <option value="f5b7" class="fa-2x fa">&#xf5b7 </option>
                                <option value="f7c4" class="fa-2x fa">&#xf7c4 </option>
                                <option value="f0e8" class="fa-2x fa">&#xf0e8 </option>
                                <option value="f7c5" class="fa-2x fa">&#xf7c5 </option>
                                <option value="f7c9" class="fa-2x fa">&#xf7c9 </option>
                                <option value="f7ca" class="fa-2x fa">&#xf7ca </option>
                                <option value="f54c" class="fa-2x fa">&#xf54c </option>
                                <option value="f714" class="fa-2x fa">&#xf714 </option>
                                <option value="f715" class="fa-2x fa">&#xf715 </option>
                                <option value="f7cc" class="fa-2x fa">&#xf7cc </option>
                                <option value="f1de" class="fa-2x fa">&#xf1de </option>
                                <option value="f118" class="fa-2x fa">&#xf118 </option>
                                <option value="f5b8" class="fa-2x fa">&#xf5b8 </option>
                                <option value="f4da" class="fa-2x fa">&#xf4da </option>
                                <option value="f75f" class="fa-2x fa">&#xf75f </option>
                                <option value="f48d" class="fa-2x fa">&#xf48d </option>
                                <option value="f54d" class="fa-2x fa">&#xf54d </option>
                                <option value="f7cd" class="fa-2x fa">&#xf7cd </option>
                                <option value="f7ce" class="fa-2x fa">&#xf7ce </option>
                                <option value="f2dc" class="fa-2x fa">&#xf2dc </option>
                                <option value="f7d0" class="fa-2x fa">&#xf7d0 </option>
                                <option value="f7d2" class="fa-2x fa">&#xf7d2 </option>
                                <option value="f696" class="fa-2x fa">&#xf696 </option>
                                <option value="f5ba" class="fa-2x fa">&#xf5ba </option>
                                <option value="f0dc" class="fa-2x fa">&#xf0dc </option>
                                <option value="f15d" class="fa-2x fa">&#xf15d </option>
                                <option value="f881" class="fa-2x fa">&#xf881 </option>
                                <option value="f15e" class="fa-2x fa">&#xf15e </option>
                                <option value="f882" class="fa-2x fa">&#xf882 </option>
                                <option value="f160" class="fa-2x fa">&#xf160 </option>
                                <option value="f884" class="fa-2x fa">&#xf884 </option>
                                <option value="f161" class="fa-2x fa">&#xf161 </option>
                                <option value="f885" class="fa-2x fa">&#xf885 </option>
                                <option value="f0dd" class="fa-2x fa">&#xf0dd </option>
                                <option value="f162" class="fa-2x fa">&#xf162 </option>
                                <option value="f886" class="fa-2x fa">&#xf886 </option>
                                <option value="f163" class="fa-2x fa">&#xf163 </option>
                                <option value="f887" class="fa-2x fa">&#xf887 </option>
                                <option value="f0de" class="fa-2x fa">&#xf0de </option>
                                <option value="f5bb" class="fa-2x fa">&#xf5bb </option>
                                <option value="f197" class="fa-2x fa">&#xf197 </option>
                                <option value="f891" class="fa-2x fa">&#xf891 </option>
                                <option value="f717" class="fa-2x fa">&#xf717 </option>
                                <option value="f110" class="fa-2x fa">&#xf110 </option>
                                <option value="f1bc" class="fa-2x fa">&#xf1bc </option>
                                <option value="f5bd" class="fa-2x fa">&#xf5bd </option>
                                <option value="f0c8" class="fa-2x fa">&#xf0c8 </option>
                                <option value="f45c" class="fa-2x fa">&#xf45c </option>
                                <option value="f698" class="fa-2x fa">&#xf698 </option>
                                <option value="f5bf" class="fa-2x fa">&#xf5bf </option>
                                <option value="f005" class="fa-2x fa">&#xf005 </option>
                                <option value="f699" class="fa-2x fa">&#xf699 </option>
                                <option value="f089" class="fa-2x fa">&#xf089 </option>
                                <option value="f5c0" class="fa-2x fa">&#xf5c0 </option>
                                <option value="f69a" class="fa-2x fa">&#xf69a </option>
                                <option value="f621" class="fa-2x fa">&#xf621 </option>
                                <option value="f048" class="fa-2x fa">&#xf048 </option>
                                <option value="f051" class="fa-2x fa">&#xf051 </option>
                                <option value="f0f1" class="fa-2x fa">&#xf0f1 </option>
                                <option value="f249" class="fa-2x fa">&#xf249 </option>
                                <option value="f04d" class="fa-2x fa">&#xf04d </option>
                                <option value="f28d" class="fa-2x fa">&#xf28d </option>
                                <option value="f2f2" class="fa-2x fa">&#xf2f2 </option>
                                <option value="f54e" class="fa-2x fa">&#xf54e </option>
                                <option value="f54f" class="fa-2x fa">&#xf54f </option>
                                <option value="f550" class="fa-2x fa">&#xf550 </option>
                                <option value="f21d" class="fa-2x fa">&#xf21d </option>
                                <option value="f0cc" class="fa-2x fa">&#xf0cc </option>
                                <option value="f551" class="fa-2x fa">&#xf551 </option>
                                <option value="f12c" class="fa-2x fa">&#xf12c </option>
                                <option value="f239" class="fa-2x fa">&#xf239 </option>
                                <option value="f0f2" class="fa-2x fa">&#xf0f2 </option>
                                <option value="f5c1" class="fa-2x fa">&#xf5c1 </option>
                                <option value="f185" class="fa-2x fa">&#xf185 </option>
                                <option value="f12b" class="fa-2x fa">&#xf12b </option>
                                <option value="f5c2" class="fa-2x fa">&#xf5c2 </option>
                                <option value="f5c3" class="fa-2x fa">&#xf5c3 </option>
                                <option value="f5c4" class="fa-2x fa">&#xf5c4 </option>
                                <option value="f5c5" class="fa-2x fa">&#xf5c5 </option>
                                <option value="f69b" class="fa-2x fa">&#xf69b </option>
                                <option value="f021" class="fa-2x fa">&#xf021 </option>
                                <option value="f2f1" class="fa-2x fa">&#xf2f1 </option>
                                <option value="f48e" class="fa-2x fa">&#xf48e </option>
                                <option value="f0ce" class="fa-2x fa">&#xf0ce </option>
                                <option value="f45d" class="fa-2x fa">&#xf45d </option>
                                <option value="f10a" class="fa-2x fa">&#xf10a </option>
                                <option value="f3fa" class="fa-2x fa">&#xf3fa </option>
                                <option value="f490" class="fa-2x fa">&#xf490 </option>
                                <option value="f3fd" class="fa-2x fa">&#xf3fd </option>
                                <option value="f02b" class="fa-2x fa">&#xf02b </option>
                                <option value="f02c" class="fa-2x fa">&#xf02c </option>
                                <option value="f4db" class="fa-2x fa">&#xf4db </option>
                                <option value="f0ae" class="fa-2x fa">&#xf0ae </option>
                                <option value="f1ba" class="fa-2x fa">&#xf1ba </option>
                                <option value="f62e" class="fa-2x fa">&#xf62e </option>
                                <option value="f62f" class="fa-2x fa">&#xf62f </option>
                                <option value="f769" class="fa-2x fa">&#xf769 </option>
                                <option value="f76b" class="fa-2x fa">&#xf76b </option>
                                <option value="f7d7" class="fa-2x fa">&#xf7d7 </option>
                                <option value="f120" class="fa-2x fa">&#xf120 </option>
                                <option value="f034" class="fa-2x fa">&#xf034 </option>
                                <option value="f035" class="fa-2x fa">&#xf035 </option>
                                <option value="f00a" class="fa-2x fa">&#xf00a </option>
                                <option value="f009" class="fa-2x fa">&#xf009 </option>
                                <option value="f00b" class="fa-2x fa">&#xf00b </option>
                                <option value="f630" class="fa-2x fa">&#xf630 </option>
                                <option value="f491" class="fa-2x fa">&#xf491 </option>
                                <option value="f2cb" class="fa-2x fa">&#xf2cb </option>
                                <option value="f2c7" class="fa-2x fa">&#xf2c7 </option>
                                <option value="f2c9" class="fa-2x fa">&#xf2c9 </option>
                                <option value="f2ca" class="fa-2x fa">&#xf2ca </option>
                                <option value="f2c8" class="fa-2x fa">&#xf2c8 </option>
                                <option value="f165" class="fa-2x fa">&#xf165 </option>
                                <option value="f164" class="fa-2x fa">&#xf164 </option>
                                <option value="f08d" class="fa-2x fa">&#xf08d </option>
                                <option value="f3ff" class="fa-2x fa">&#xf3ff </option>
                                <option value="f00d" class="fa-2x fa">&#xf00d </option>
                                <option value="f057" class="fa-2x fa">&#xf057 </option>
                                <option value="f043" class="fa-2x fa">&#xf043 </option>
                                <option value="f5c7" class="fa-2x fa">&#xf5c7 </option>
                                <option value="f5c8" class="fa-2x fa">&#xf5c8 </option>
                                <option value="f204" class="fa-2x fa">&#xf204 </option>
                                <option value="f205" class="fa-2x fa">&#xf205 </option>
                                <option value="f7d8" class="fa-2x fa">&#xf7d8 </option>
                                <option value="f71e" class="fa-2x fa">&#xf71e </option>
                                <option value="f552" class="fa-2x fa">&#xf552 </option>
                                <option value="f7d9" class="fa-2x fa">&#xf7d9 </option>
                                <option value="f5c9" class="fa-2x fa">&#xf5c9 </option>
                                <option value="f6a0" class="fa-2x fa">&#xf6a0 </option>
                                <option value="f6a1" class="fa-2x fa">&#xf6a1 </option>
                                <option value="f722" class="fa-2x fa">&#xf722 </option>
                                <option value="f25c" class="fa-2x fa">&#xf25c </option>
                                <option value="f637" class="fa-2x fa">&#xf637 </option>
                                <option value="f238" class="fa-2x fa">&#xf238 </option>
                                <option value="f7da" class="fa-2x fa">&#xf7da </option>
                                <option value="f224" class="fa-2x fa">&#xf224 </option>
                                <option value="f225" class="fa-2x fa">&#xf225 </option>
                                <option value="f1f8" class="fa-2x fa">&#xf1f8 </option>
                                <option value="f2ed" class="fa-2x fa">&#xf2ed </option>
                                <option value="f829" class="fa-2x fa">&#xf829 </option>
                                <option value="f82a" class="fa-2x fa">&#xf82a </option>
                                <option value="f1bb" class="fa-2x fa">&#xf1bb </option>
                                <option value="f091" class="fa-2x fa">&#xf091 </option>
                                <option value="f0d1" class="fa-2x fa">&#xf0d1 </option>
                                <option value="f4de" class="fa-2x fa">&#xf4de </option>
                                <option value="f63b" class="fa-2x fa">&#xf63b </option>
                                <option value="f4df" class="fa-2x fa">&#xf4df </option>
                                <option value="f63c" class="fa-2x fa">&#xf63c </option>
                                <option value="f553" class="fa-2x fa">&#xf553 </option>
                                <option value="f1e4" class="fa-2x fa">&#xf1e4 </option>
                                <option value="f26c" class="fa-2x fa">&#xf26c </option>
                                <option value="f0e9" class="fa-2x fa">&#xf0e9 </option>
                                <option value="f5ca" class="fa-2x fa">&#xf5ca </option>
                                <option value="f0cd" class="fa-2x fa">&#xf0cd </option>
                                <option value="f0e2" class="fa-2x fa">&#xf0e2 </option>
                                <option value="f2ea" class="fa-2x fa">&#xf2ea </option>
                                <option value="f29a" class="fa-2x fa">&#xf29a </option>
                                <option value="f19c" class="fa-2x fa">&#xf19c </option>
                                <option value="f127" class="fa-2x fa">&#xf127 </option>
                                <option value="f09c" class="fa-2x fa">&#xf09c </option>
                                <option value="f13e" class="fa-2x fa">&#xf13e </option>
                                <option value="f093" class="fa-2x fa">&#xf093 </option>
                                <option value="f007" class="fa-2x fa">&#xf007 </option>
                                <option value="f406" class="fa-2x fa">&#xf406 </option>
                                <option value="f4fa" class="fa-2x fa">&#xf4fa </option>
                                <option value="f4fb" class="fa-2x fa">&#xf4fb </option>
                                <option value="f4fc" class="fa-2x fa">&#xf4fc </option>
                                <option value="f2bd" class="fa-2x fa">&#xf2bd </option>
                                <option value="f4fd" class="fa-2x fa">&#xf4fd </option>
                                <option value="f4fe" class="fa-2x fa">&#xf4fe </option>
                                <option value="f4ff" class="fa-2x fa">&#xf4ff </option>
                                <option value="f500" class="fa-2x fa">&#xf500 </option>
                                <option value="f501" class="fa-2x fa">&#xf501 </option>
                                <option value="f728" class="fa-2x fa">&#xf728 </option>
                                <option value="f502" class="fa-2x fa">&#xf502 </option>
                                <option value="f0f0" class="fa-2x fa">&#xf0f0 </option>
                                <option value="f503" class="fa-2x fa">&#xf503 </option>
                                <option value="f504" class="fa-2x fa">&#xf504 </option>
                                <option value="f82f" class="fa-2x fa">&#xf82f </option>
                                <option value="f234" class="fa-2x fa">&#xf234 </option>
                                <option value="f21b" class="fa-2x fa">&#xf21b </option>
                                <option value="f505" class="fa-2x fa">&#xf505 </option>
                                <option value="f506" class="fa-2x fa">&#xf506 </option>
                                <option value="f507" class="fa-2x fa">&#xf507 </option>
                                <option value="f508" class="fa-2x fa">&#xf508 </option>
                                <option value="f235" class="fa-2x fa">&#xf235 </option>
                                <option value="f0c0" class="fa-2x fa">&#xf0c0 </option>
                                <option value="f509" class="fa-2x fa">&#xf509 </option>
                                <option value="f2e5" class="fa-2x fa">&#xf2e5 </option>
                                <option value="f2e7" class="fa-2x fa">&#xf2e7 </option>
                                <option value="f5cb" class="fa-2x fa">&#xf5cb </option>
                                <option value="f221" class="fa-2x fa">&#xf221 </option>
                                <option value="f226" class="fa-2x fa">&#xf226 </option>
                                <option value="f228" class="fa-2x fa">&#xf228 </option>
                                <option value="f492" class="fa-2x fa">&#xf492 </option>
                                <option value="f493" class="fa-2x fa">&#xf493 </option>
                                <option value="f03d" class="fa-2x fa">&#xf03d </option>
                                <option value="f4e2" class="fa-2x fa">&#xf4e2 </option>
                                <option value="f6a7" class="fa-2x fa">&#xf6a7 </option>
                                <option value="f897" class="fa-2x fa">&#xf897 </option>
                                <option value="f45f" class="fa-2x fa">&#xf45f </option>
                                <option value="f027" class="fa-2x fa">&#xf027 </option>
                                <option value="f6a9" class="fa-2x fa">&#xf6a9 </option>
                                <option value="f026" class="fa-2x fa">&#xf026 </option>
                                <option value="f028" class="fa-2x fa">&#xf028 </option>
                                <option value="f772" class="fa-2x fa">&#xf772 </option>
                                <option value="f729" class="fa-2x fa">&#xf729 </option>
                                <option value="f554" class="fa-2x fa">&#xf554 </option>
                                <option value="f555" class="fa-2x fa">&#xf555 </option>
                                <option value="f494" class="fa-2x fa">&#xf494 </option>
                                <option value="f773" class="fa-2x fa">&#xf773 </option>
                                <option value="f83e" class="fa-2x fa">&#xf83e </option>
                                <option value="f496" class="fa-2x fa">&#xf496 </option>
                                <option value="f5cd" class="fa-2x fa">&#xf5cd </option>
                                <option value="f193" class="fa-2x fa">&#xf193 </option>
                                <option value="f1eb" class="fa-2x fa">&#xf1eb </option>
                                <option value="f72e" class="fa-2x fa">&#xf72e </option>
                                <option value="f410" class="fa-2x fa">&#xf410 </option>
                                <option value="f2d0" class="fa-2x fa">&#xf2d0 </option>
                                <option value="f2d1" class="fa-2x fa">&#xf2d1 </option>
                                <option value="f2d2" class="fa-2x fa">&#xf2d2 </option>
                                <option value="f72f" class="fa-2x fa">&#xf72f </option>
                                <option value="f4e3" class="fa-2x fa">&#xf4e3 </option>
                                <option value="f5ce" class="fa-2x fa">&#xf5ce </option>
                                <option value="f159" class="fa-2x fa">&#xf159 </option>
                                <option value="f0ad" class="fa-2x fa">&#xf0ad </option>
                                <option value="f497" class="fa-2x fa">&#xf497 </option>
                                <option value="f157" class="fa-2x fa">&#xf157 </option>
                                <option value="f6ad" class="fa-2x fa">&#xf6ad </option>

                            </select>
                            <!-- se agrega linea para el icono mediante jquery append -->
                            <div v-else class="py-0 pl-0" id="ico"></div>
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
                              Codigo
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">
                            <p class="py-0 pl-0">{{ datosDB.mod_tree }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 py-0 pl-0">
                            <label class="col-sm-12 py-0">
                              URL
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">
                            <input
                              v-if="btnEditar"
                              v-model="datosDB.mod_url"
                              type="text"
                              placeholder="URL"
                              class="form-control"
                              id="mod_url"
                              @keyup="valida"
                              @blur="normal"
                              @click="valida"
                            />
                            <p v-else class="py-0 pl-0">{{ datosDB.mod_url }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div v-if="btnEditar==false" class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-12 py-0 pl-0">
                            <label class="col-sm-12 py-0">
                              Padre
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">
                            <p v-if="datosDB.mod_father == 0" class="py-0 pl-0">{{
                              "NO"
                            }}</p>
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
                              Nombre Padre
                            </label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 py-0">
                            <p class="py-0 pl-0">{{ datosDB.mod_padre }}</p>
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
                                <input type="radio" id="activado" value="1" v-model="datosDB.mod_state"
                                    checked>
                                <label for="activado">Activo</label>
                            </div>
                            <div class="col-md-6">
                                <input type="radio" id="desactivado" value="0"
                                    v-model="datosDB.mod_state">
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
                              v-if="datosDB.mod_haschild == 0"
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
                            <p v-if="datosDB.mod_state == 1" class="py-0 pl-0">{{
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
                            >
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
                      {{this.datosDB.mod_name}}
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
    axios.get("./modulo").then(res => {
      this.items = res.data;
    });
  },
  methods: {
    modulos(item) {
      if (item.id != 0) {
        this.btnEditar = false;
        this.btnCrear=false;
        this.detalle = true;
        axios.get(`./modulo/getmodulos/${item.id}`).then(res => {
          this.datosDB = res.data;
          var icono =
            '<i id="icon" class="nav-icon fa fa-3x">&#x' +
            res.data.mod_icono +
            "</i>";
          $("#icon").remove();
          $("#ico").append(icono);
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
      this.titulo = "Editar Modulo";
      this.btnCrear = false;
      this.btnEditar = true;
      this.datoSelect[0]=this.datosDB.mod_father;
      console.log(this.datosDB);
    },
    abrirModalNuevo() {
      this.titulo = "Nuevo Modulo";
      this.datosDB.mod_icono='';
      this.datosDB.mod_menu=1;
      this.datosDB.mod_admin=0;
      this.datosDB.mod_name='';
      this.datosDB.mod_state=1;
      this.datosDB.mod_url='';
      this.datoSelect[0]=null;
      this.detalle=true;
      this.btnCrear = true;
      this.btnEditar = true;
    },
    abrirModalEliminar() {
      console.log(this.datosDB);
      $("#modalEliminar").modal("show");
    },
    Cancelar() {
      var icono =
          '<i id="icon" class="nav-icon fa fa-3x">&#x' +
          this.datosDB.mod_icono +
          "</i>";
      this.btnEditar = false;
      $( document ).ready(function() {
          $("#ico").append(icono);
      });
      this.detalle=false;
    },
    crear() {
      if (this.datosDB.mod_name.trim() === "") {
        toastr.warning("llena todos los campos");
        $("#mod_name").css("border-color", "#DA3E47");
        return;
      }
      if (this.datosDB.mod_url.trim() === "") {
        toastr.warning("llena todos los campos");
        $("#mod_url").css("border-color", "#DA3E47");
        return;
      }
      console.log(this.datosDB);
      axios.post('./modulo',this.datosDB).then(res => {
          if (res.data.success == true) {
            toastr.success(res.data.msg);
            this.btnEditar=false;
            this.detalle=false;
            //this.usuario.push(users);
            axios.get("./modulo").then(res => {
              this.items = res.data;
            });

          } else {
            toastr.error(res.data.msg);
          }
        })
        .catch(err => toastr.error("Error al ingresar los datos"));
    },
    //saca el id del arbol de modulos
    updateActive(id) {
      this.datosDB.mod_father=id[0];
    },
    editar() {
      if (this.datosDB.mod_name.trim() === "") {
        toastr.warning("llena todos los campos");
        $("#mod_name").css("border-color", "#DA3E47");
        return;
      }
      console.log(this.datosDB);
      axios.put(`/modulo/${this.datosDB.mod_id}`, this.datosDB)
        .then(res => {
          if (res.data.success == true) {
            toastr.success(res.data.msg);
            this.btnEditar=false;
            this.detalle=false;
            axios.get("./modulo").then(res => {
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
        .delete(`modulo/${this.datosDB.mod_id}`)
        .then(() => {
          toastr.success("Dato eliminado correctamente");
          axios.get("./modulo").then(res => {
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
