<template>
  <div>

        <div class="titulet" data-uk-tooltip="animation: true; offset: 2;" :title="data">{{ nom_dia }} {{ dia_mes }} {{ mati }}</div>

    <div class="dia">
      <!-- COLUMNA LATERAL DESPLEGABLE -->
      <div class="lateral_esquerre flex-container">
        <button
          data-toggle="tooltip"
          data-placement="bottom"
          title="CEFIRE"
          @click="afegix('cefire')"
          class="btn btn-primary btn-sm"
        >
          <i class="fas fa-check"></i>
        </button>
        <button
          data-toggle="tooltip"
          data-placement="bottom"
          title="CURS"
          :uk-toggle="'target: #curs-modal'+this._uid"
          class="btn btn-primary btn-sm"
        >
          <i class="fas fa-chalkboard-teacher"></i>
        </button>
        <button
          data-toggle="tooltip"
          data-placement="bottom"
          title="GUARDIA"
          @click="afegix('guardia')"
          class="btn btn-primary btn-sm"
        >
          <i class="fas fa-dog"></i>
        </button>
        <button
          data-toggle-second="tooltip"
          data-placement="bottom"
          title="COMPENSA"
          class="btn btn-primary btn-sm"
          :uk-toggle="'target: #compensa-modal'+this._uid"
        >
          <i class="fas fa-umbrella-beach"></i>
        </button>
        <button
          data-toggle-second="tooltip"
          data-placement="bottom"
          title="VISITA"
          class="btn btn-primary btn-sm"
          :uk-toggle="'target: #visita-modal'+this._uid"
        >
          <i class="fas fa-school"></i>
        </button>
        <button
          data-toggle-second="tooltip"
          data-placement="bottom"
          title="PERMIS"
          class="btn btn-primary btn-sm"
          :uk-toggle="'target: #permis-modal'+this._uid"
        >
          <i class="fas fa-virus"></i>
        </button>
      </div>
      <!-- COLUMNA LATERAL DESPLEGABLE -->
      <!-- ESPAI ON ES POSEN LES ETIQUETES -->
      <div id="principal" class="principal">
        <transition-group name="list-complete2" tag="div">
          <div
            v-for="cef in cefire"
            class="s-cefire list-complete2-item"
            :key="'c' + cef.id"
            data-uk-tooltip="pos: right; animation: true; offset: 12;"
            :title="cef.inici+'-'+cef.fi"
          >
            <span @click="borra_par('cefire', cef.id)" class="cerrar" />
          </div>

          <div
            v-for="com in compensa"
            class="s-compensa list-complete2-item"
            :key="'com' + com.id"
            data-uk-tooltip="pos: right; animation: true; offset: 12;"
            :title="com.motiu"
          >
            <span @click="borra_par('compensa', com.id)" class="cerrar" />
          </div>

          <div
            v-for="cur in curs"
            class="s-curs list-complete2-item"
            :key="'cur' + cur.id"
            data-uk-tooltip="pos: right; animation: true; offset: 12;"
            :title="cur.curs"
          >
            <span @click="borra_par('curs', cur.id)" class="cerrar" />
          </div>
          <div
            v-for="vis in visita"
            class="s-visita list-complete2-item"
            :key="'vis' + vis.id"
            data-uk-tooltip="pos: right; animation: true; offset: 12;"
            :title="vis.centre"
          >
            <span @click="borra_par('visita', vis.id)" class="cerrar" />
          </div>
          <div
            v-for="gua in guardia"
            class="s-guardia list-complete2-item"
            :key="'gua' + gua.id"
          >
            <span @click="borra_par('guardia', gua.id)" class="cerrar" />
          </div>
          <div
            v-for="perm in permis"
            class="s-permis list-complete2-item"
            :key="'perm' + perm.id"
            data-uk-tooltip="pos: right; animation: true; offset: 12;"
            :title="perm.motiu"
          >
            <span @click="borra_par('permis', perm.id)" class="cerrar" />
          </div>
        </transition-group>

        <!-- <div class="s-compensa"></div>
        <div class="s-curs"></div>
        <div class="s-visita"></div>
        <div class="s-guardia"></div> -->
      </div>
      <!-- ESPAI ON ES POSEN LES ETIQUETES -->
    </div>

    <!-- MODALS DE LES FINESTRES -->
    <!-- Curs modal -->
    <div :id="'curs-modal'+this._uid" uk-modal>
      <div class="uk-modal-dialog uk-modal-body">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <input
              v-model="curs_i"
              class="uk-form-large data-uk-input uk-width-1-1"
              type="text"
              placeholder="Curs a realitzar"
            />
          </div>
        </fieldset>
        <p class="uk-text-right">
          <button
            class="uk-button uk-button-default uk-modal-close"
            type="button"
          >
            Cancel·la
          </button>
          <button
            @click="salva('curs')"
            class="uk-button uk-button-primary uk-modal-close"
            type="button"
          >
            Salva
          </button>
        </p>
      </div>
    </div>

    <!-- Compensa modal -->
    <div :id="'compensa-modal'+this._uid" uk-modal>
      <div class="uk-modal-dialog uk-modal-body">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <input
              v-model="compensa_i"
              class="uk-form-large data-uk-input uk-width-1-1"
              type="text"
              placeholder="Motiu pel que compenses"
            />
          </div>
        </fieldset>
        <p class="uk-text-right">
          <button
            class="uk-button uk-button-default uk-modal-close"
            type="button"
          >
            Cancel·la
          </button>
          <button
            @click="salva('compensa')"
            class="uk-button uk-button-primary uk-modal-close"
            type="button"
          >
            Salva
          </button>
        </p>
      </div>
    </div>

    <!-- Visita modal -->
    <div :id="'visita-modal'+this._uid" uk-modal>
      <div class="uk-modal-dialog uk-modal-body">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <input
              v-model="visita_i"
              class="uk-form-large data-uk-input uk-width-1-1"
              type="text"
              placeholder="Visita a realitzar"
            />
          </div>
        </fieldset>
        <p class="uk-text-right">
          <button
            class="uk-button uk-button-default uk-modal-close"
            type="button"
          >
            Cancel·la
          </button>
          <button
            @click="salva('visita')"
            class="uk-button uk-button-primary uk-modal-close"
            type="button"
          >
            Salva
          </button>
        </p>
      </div>
    </div>
    <!-- Permis modal -->
    <div :id="'permis-modal'+this._uid" uk-modal>
      <div class="uk-modal-dialog uk-modal-body">
        <fieldset class="uk-fieldset">
          <div class="uk-margin">
            <input
              v-model="permis_i"
              class="uk-form-large data-uk-input uk-width-1-1"
              type="text"
              placeholder="Motiu del permís"
            />
            <div class="js-upload uk-placeholder uk-text-center">
                <span uk-icon="icon: cloud-upload"></span>
                <span class="uk-text-middle">Puja o arrastra l'arxiu justificant</span>
                <div uk-form-custom>
                    <input type="file" multiple>
                    <span class="uk-link">selecting one</span>
                </div>
            </div>
          </div>
        </fieldset>
        <p class="uk-text-right">
          <button
            class="uk-button uk-button-default uk-modal-close"
            type="button"
          >
            Cancel·la
          </button>
          <button
            @click="salva('permis')"
            class="uk-button uk-button-primary uk-modal-close"
            type="button"
          >
            Salva
          </button>
        </p>
      </div>
    </div>
    <!-- MODALS DE LES FINESTRES -->
  </div>
</template>

<script>
UIkit.upload('.js-upload', {

    url: '',
    multiple: true,

    beforeSend: function () {
        console.log('beforeSend', arguments);
    },
    beforeAll: function () {
        console.log('beforeAll', arguments);
    },
    load: function () {
        console.log('load', arguments);
    },
    error: function () {
        console.log('error', arguments);
    },
    complete: function () {
        console.log('complete', arguments);
    },

    loadStart: function (e) {
        console.log('loadStart', arguments);

        bar.removeAttribute('hidden');
        bar.max = e.total;
        bar.value = e.loaded;
    },

    progress: function (e) {
        console.log('progress', arguments);

        bar.max = e.total;
        bar.value = e.loaded;
    },

    loadEnd: function (e) {
        console.log('loadEnd', arguments);

        bar.max = e.total;
        bar.value = e.loaded;
    },

    completeAll: function () {
        console.log('completeAll', arguments);

        setTimeout(function () {
            bar.setAttribute('hidden', 'hidden');
        }, 1000);

        alert('Upload Completed');
    }

});
export default {
  data() {
    return {
      id: null,
      cefire: {},
      compensa: {},
      curs: {},
      visita: {},
      guardia: {},
      permis: {},
    //   data: new Date("2020-01-20"),
      curs_i: "",
      compensa_i: "",
      visita_i: "",
      permis_i: "",
    //   mati: "m",
      dies: [
            'Diumenge',
            'Dilluns',
            'Dimarts',
            'Dimecres',
            'Dijous',
            'Divendres',
            'Dissabte',
            'Diumenge',
    ],
    nom_dia: "",
    dia_mes: 0
    };
  },
  props: ['mati','data'],
  methods: {
    get_nom_dia() {
        this.nom_dia = this.dies[this.data.getDay()]
    },
    get_dia_mes() {
        this.dia_mes = this.data.getDate()
    },
    borra_par(bd, id) {
      let url = bd + "/" + id;
      axios
        .delete(url)
        .then((res) => {
          console.log(res);
          for (let index = 0; index < this[bd].length; index++) {
            if (this[bd][index].id == id) {
              this[bd].splice(index, 1);
            }
          }
        })
        .catch((err) => {
          console.error(err);
        });
    },
    get_de_bd(bd) {
      axios
        .get("dia_"+bd+"/"+data_db(this.data)+"/"+this.mati) ///dia_cefire/{dia}/{mati}
        .then((res) => {
          console.log(res.data);
          this[bd] = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },
    afegix(desti) {
      //alert(this.data);
      let inici,fi;
      if (this.mati=='m'){
        inici="9:00:00";
        fi="14:00:00";
      } else {
        inici="16:00:00";
        fi="20:00:00";
      }
      var params = {
        data: data_db(this.data),
        inici: inici,
        fi: fi,
      };
      axios
        .post(desti, params)
        .then((res) => {
          console.log(res);
          if (Object.keys(this[desti]).length !== 0) {
            this[desti].push(res.data);
          } else {
            this[desti] = [res.data];
          }
        })
        .catch((err) => {
          console.error(err);
        });
    },
    salva(desti) {
      let varNom = desti + "_i";
      let inici,fi;
      if (this.mati=='m'){
        inici="9:00:00";
        fi="14:00:00";
      } else {
        inici="16:00:00";
        fi="20:00:00";
      }
      var params = {
        data: data_db(this.data),
        inici: inici,
        fi: fi,
        motiu: this[varNom],
      };
      axios
        .post(desti, params)
        .then((res) => {
          console.log(res);
          if (Object.keys(this[desti]).length !== 0) {
            this[desti].push(res.data);
          } else {
            this[desti] = [res.data];
          }
        })
        .catch((err) => {
          console.error(err);
        });
      this[varNom] = "";
      UIkit.modal("#"+desti+"-modal"+this._uid).hide();
    },
  },
  mounted() {
    this.get_de_bd("cefire");
    this.get_de_bd("compensa");
    this.get_de_bd("curs");
    this.get_de_bd("visita");
    this.get_de_bd("guardia");
    this.get_de_bd("permis");
    this.get_nom_dia();
    this.get_dia_mes();
    this.id = this._uid
  },
  watch: {
      data(){
          this.componentKey++;
      }

  },
};
</script>

<style lang="sass" scope>
$fondo:  #f1faee
.titulet
    font-size: 1.2em
    margin-left: 10px
    font-color: gray

.dia
    max-width: 150px
    display: grid
    grid-template-columns: min-content repeat(3, 1em)
    grid-template-rows: repeat(5, 1fr)
    grid-column-gap: 2px
    grid-row-gap: 2px
    border: 1px solid gray
    border-radius: 7px
    background-color: white
    box-shadow: 0px 0px 34px 5px rgba(187,187,187,0.58)
    -webkit-box-shadow: 0px 0px 34px 5px rgba(187,187,187,0.58)
    -moz-box-shadow: 0px 0px 34px 5px rgba(187,187,187,0.58)
    &:hover > .lateral_esquerre
        visibility: visible
        opacity: 1
        transform: translate(-105%)
        overflow-x: hidden
        white-space: nowrap
        -webkit-overflow-scrolling: touch

    .lateral_esquerre
        grid-area: 1 / 1 / 6 / 2
        overflow-x: hidden
        white-space: nowrap
        visibility: hidden
        opacity: 0
        transform: translate(0px)
        transition: transform 0.3s, visibility 1s, opacity 0.5s linear
        -webkit-overflow-scrolling: touch
        z-index: 0

    .principal
        grid-area: 1 / 1 / 6 / 6
        display: inline-flex
        // flex-wrap: wrap
        flex-direction: column
        justify-content: flex-start
        align-items: auto
        align-content: flex-start
        padding: 5px
        z-index: 1
        background-color: $fondo
        border-radius: 10px
        .s-
            flex: 0 1 auto
            margin: 1px
            border: 1px solid
            border-radius: 5px
            padding: 3px
            font-weight: bold
            color: #373444
            width: 95%
            max-width: 130px
            &cefire
                @extend .s-
                background-color: blue
                &:before
                    content: "CEFIRE"
            &compensa
                @extend .s-
                background-color: gray
                &:before
                    content: "COMPENSA"

            &guardia
                @extend .s-
                background-color: red
                &:before
                    content: "GUARDIA"

            &visita
                @extend .s-
                background-color: pink
                &:before
                    content: "VISITA"

            &curs
                @extend .s-
                background-color: yellow
                &:before
                    content: "CURS"
            &permis
                @extend .s-
                background-color: green
                &:before
                    content: "PERMÍS"

    .cerrar
        font-family: "Font Awesome 5 Free"
        text-align: right
        float: right
        margin-right: 3px
        color: #373444
        font-weight: bold
        cursor: pointer
        pointers: all
        &:before
            content: "\f2ed"

    .flex-container
        display: flex
        flex-wrap: wrap
        flex-direction: column
        justify-content: flex-start
        align-items: auto
        align-content: flex-start
        .button
            flex: 0 1 auto
            margin: 1px
</style>
