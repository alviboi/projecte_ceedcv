<template>
  <div>
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
          uk-toggle="target: #curs-modal"
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
          uk-toggle="target: #compensa-modal"
        >
          <i class="fas fa-umbrella-beach"></i>
        </button>
        <button
          data-toggle-second="tooltip"
          data-placement="bottom"
          title="VISITA"
          class="btn btn-primary btn-sm"
          uk-toggle="target: #visita-modal"
        >
          <i class="fas fa-school"></i>
        </button>
      </div>
      <!-- COLUMNA LATERAL DESPLEGABLE -->
      <!-- ESPAI ON ES POSEN LES ETIQUETES -->
      <div id="principal" class="principal">
        <div
          v-for="cef in cefire"
          class="s-cefire"
          :key="cef.id"
          data-uk-tooltip="pos: right; animation: true; offset: 12;"
          :title="cef.data"
        ></div>
        <div v-for="com in compensa" class="s-compensa" :key="com.id"></div>
        <div v-for="cur in curs" class="s-curs" :key="cur.id"></div>
        <div v-for="vis in visita" class="s-visita" :key="vis.id"></div>
        <div v-for="gua in guardia" class="s-guardia" :key="gua.id"></div>

        <!-- <div class="s-cefire"></div>
        <div class="s-compensa"></div>
        <div class="s-curs"></div>
        <div class="s-visita"></div>
        <div class="s-guardia"></div> -->
      </div>
      <!-- ESPAI ON ES POSEN LES ETIQUETES -->
    </div>
    <button @click="afegix">Prova</button>
    <button @click="pilla">Prova</button>
    <button class="uk-button" data-uk-tooltip="{pos:'right}" title="dsadsadas">
      ...dsa
    </button>
    <!-- This is a button toggling the modal -->
    <button
      class="uk-button uk-button-default uk-margin-small-right"
      type="button"
      uk-toggle="target: #curs-modal"
    >
      Open
    </button>
    <!-- MODALS DE LES FINESTRES -->
    <!-- Curs modal -->
    <div id="curs-modal" uk-modal>
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
    <div id="compensa-modal" uk-modal>
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
    <div id="visita-modal" uk-modal>
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
    <!-- MODALS DE LES FINESTRES -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      cefire: {},
      compensa: {},
      curs: {},
      visita: {},
      guardia: {},
      data: new Date("2020-11-23"),
      curs_i: "",
      compensa_i: "",
      visita_i: "",
    };
  },
  methods: {
    pilla() {
      axios
        .get("cefire")
        .then((res) => {
          console.log(res.data);
          this.cefire = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },
    afegix(desti) {
      //alert(this.data);
      let dia = this.data.getDate();
      let mes = this.data.getMonth() + 1;
      let an = this.data.getFullYear();
      var params = {
        data: an + "-" + mes + "-" + dia,
        inici: "9:00:00",
        fi: "14:00:00",
      };
      axios
        .post(desti, params)
        .then((res) => {
          console.log(res);
          if (Object.keys(this[desti]).length !== 0) {
            this[desti].push(res.data);
          } else {
            this[desti] =  [res.data]
          }
        })
        .catch((err) => {
          console.error(err);
        });
    },
    salva(desti) {
      let varNom = desti + "_i";
      let dia = this.data.getDate();
      let mes = this.data.getMonth() + 1;
      let an = this.data.getFullYear();
      var params = {
        data: an + "-" + mes + "-" + dia,
        inici: "9:00:00",
        fi: "14:00:00",
        motiu: this[varNom],
      };
      axios
        .post(desti, params)
        .then((res) => {
          console.log(res);
          if (Object.keys(this[desti]).length !== 0) {
            this[desti].push(res.data);
          } else {
            this[desti] =  [res.data]
          }
        })
        .catch((err) => {
          console.error(err);
        });
      this[varNom] = "";
      UIkit.modal("#curs-modal").hide();
    },
  },
};
</script>

<style lang="sass">
.dia
    max-width: 150px
    display: grid
    grid-template-columns: min-content repeat(3, 1em)
    grid-template-rows: repeat(5, 1fr)
    grid-column-gap: 2px
    grid-row-gap: 2px
    border: 1px solid gray
    border-radius: 7px
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
        flex-wrap: wrap
        flex-direction: column
        justify-content: flex-start
        align-items: auto
        align-content: flex-start
        padding: 5px
        z-index: 10
        .s-
            flex: 0 1 auto
            margin: 1px
            border: 1px solid
            border-radius: 5px
            padding: 3px
            font-weight: bold
            color: #373444
            width: 95%
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
                background-color: blue
                &:before
                    content: "VISITA"

            &curs
                @extend .s-
                background-color: yellow
                &:before
                    content: "CURS"

            &:after
                font-family: "Font Awesome 5 Free"
                text-align: right
                float: right
                content: "\f2ed"
                margin-left: 10px
                color: #373444
                font-weight: bold
                cursor: pointer
                pointers: all

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
