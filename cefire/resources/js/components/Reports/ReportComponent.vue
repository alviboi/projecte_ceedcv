<template>
  <div>
    <div
      class="uk-grid uk-grid-divider uk-grid-medium uk-child-width-1-2 uk-child-width-1-4@l uk-child-width-1-5@xl"
      data-uk-grid
    >
      <div>
        <span class="uk-text-small"
          ><span
            data-uk-icon="icon:users"
            class="uk-margin-small-right uk-text-primary"
          ></span
          >Temps total</span
        >
        <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">
          {{ (total / 60).toFixed(2) }} hores
        </h1>
        <div class="uk-text-small">Sense contar eixides.</div>
      </div>
      <div>
        <span class="uk-text-small"
          ><span
            data-uk-icon="icon:clock"
            class="uk-margin-small-right uk-text-primary"
          ></span
          >Total mes passat</span
        >
        <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">
          {{ (total_pass / 60).toFixed(2) }} hores
        </h1>
        <!-- <div class="uk-text-small">
							<span class="uk-text-warning" data-uk-icon="icon: triangle-down">-15%</span> less than last week.
						</div> -->
      </div>
      <div>

        <span class="uk-text-small"><span data-uk-icon="icon:calendar" class="uk-margin-small-right uk-text-primary"></span>Rang de dates:</span>
                      <!-- v-model="dia_aux"
                @selected="canvia_data()" -->
        <div class="uk-margin-small-top">
            <Datepicker
                :language="ca"
                input-class="uk-input uk-form-small"
                :monday-first="true"
                placeholder="Desde"
                value=""
                v-model="desde"
                @input="canvia_data()"
                >
        </Datepicker>
        <Datepicker
                input-class="uk-input uk-form-small"
                :language="ca"
                :monday-first="true"
                placeholder="Fins"
                value=""
                v-model="fins"
                @input="canvia_data()"
                >
        </Datepicker>

        </div>


        <!-- <div class="uk-text-small">
            <span class="uk-text-success" data-uk-icon="icon: triangle-up"> 19%</span> more than last week.
        </div> -->

    </div>
					<!--<div>

						<span class="uk-text-small"><span data-uk-icon="icon:search" class="uk-margin-small-right uk-text-primary"></span>Week Search</span>
						<h1 class="uk-heading-primary uk-margin-remove uk-text-primary">9.543</h1>
						<div class="uk-text-small">
							<span class="uk-text-danger" data-uk-icon="icon: triangle-down"> -23%</span> less than last week.
						</div>

					</div>
					<div class="uk-visible@xl">
						<span class="uk-text-small"><span data-uk-icon="icon:users" class="uk-margin-small-right uk-text-primary"></span>Lorem ipsum</span>
						<h1 class="uk-heading-primary uk-margin-remove uk-text-primary">5.284</h1>
						<div class="uk-text-small">
							<span class="uk-text-success" data-uk-icon="icon: triangle-up"> 7%</span> more than last week.
						</div>
					</div> -->
    </div>

    <hr />
    <div>
      <div
        class="uk-grid uk-grid-divider uk-grid-medium uk-child-width-1-2 uk-child-width-1-2@l uk-child-width-1-2@xl"
        data-uk-grid
      >
        <div>
          <line-component
            :key="refresca"
            :data="datos"
            :labels="labels"
            :nom="nom"
            :nom_datos="nom_datos"
          />
        </div>
        <div>
          <pie-component
            :key="refresca+10000"
            :data="datos2"
            :labels="labels2"
            :nom="nom2"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import PiegrafComponent from './PiegrafComponent.vue';
// import LinegrafComponent from './LinegrafComponent.vue'
// export default {
//   components: { LinegrafComponent },

// }

import Datepicker from "vuejs-datepicker";
import { ca } from "vuejs-datepicker/dist/locale";
export default {
  data() {
    return {
      desde: new Date(),
      fins: new Date(),
      ca: ca,
      dia: new Date(),
      total_pass: 0,
      total: 0,
      datos: [],
      labels: [],
      datos2: [],
      labels2: [],
      nom: "Gràfica dels minuts fets al cefire",
      nom2: "Distribució d'hores realitzades",
      nom_datos: "Cefire",
      refresca: 0,
    };
  },
  components: {
        Datepicker,
  },
  methods: {
    canvia_data(){
        console.log(this.fins);
        console.log(this.desde);
        if(this.fins > this.desde) {
            this.get_temps();
        }
    },
    primer_data_mes_passat(data) {
      let dia = data.getDate();
      let mes = data.getMonth();
      let an = data.getFullYear();
      if (mes == 0) {
        let ret = an - 1 + "-12-1";
        return ret;
      } else {
        let ret = an + "-" + mes + "-1";
        return ret;
      }
    },
    ultim_data_mes_passat(data) {
      var d = new Date(this.dia.getFullYear(), this.dia.getMonth() + 1, 0);
      let dia = d.getUTCDate();
      let mes = d.getMonth();
      let an = d.getFullYear();
      if (mes == 0) {
        let ret = an - 1 + "-12-" + dia;
        return ret;
      } else {
        let ret = an + "-" + mes + "-" + dia;
        return ret;
      }
    },
    data_mes_inici() {
      let dia = this.dia.getDate();
      let mes = this.dia.getMonth() + 1;
      let an = this.dia.getFullYear();
      let ret = an + "-" + mes + "-01";
      return ret;
    },

    get_temps() {
    //   let desde = this.data_mes_inici();
    //   let fins = data_db(this.dia);
      let desde = data_db(this.desde);
      let fins = data_db(this.fins);
      let url = "/" + desde + "/" + fins;
      axios
        .get('contar'+url)
        .then((res) => {
          console.log(res);
          this.datos = res.data.data;
          this.labels = res.data.labels;
          this.total = res.data.total;
          this.refresca++;
        })
        .catch((err) => {
          console.error(err);
        });

      axios.get('contar_tot'+url)
      .then(res => {
          console.log(res)
          this.datos2 = res.data.datos;
          this.labels2 = res.data.labels;
          this.refresca++;
      })
      .catch(err => {
          console.error(err);
      })
    },
    get_temps2() {
      let desde = this.primer_data_mes_passat(this.dia);
      let fins = this.ultim_data_mes_passat(this.dia);
    //   let desde = "2020-12-01";
    //   let fins = "2020-12-31";
      let url = "contar/" + desde + "/" + fins;
      axios
        .get(url)
        .then((res) => {
          console.log(res);
          this.total_pass = res.data.total;
        })
        .catch((err) => {
          console.error(err);
        });
    },

    // get_temps() {
    //     let desde= "2020-10-01";
    //     let fins= "2020-12-31";
    //     let url="contar/"+desde+"/"+fins;
    //     axios.get(url)
    //     .then(res => {
    //         console.log(res)
    //         this.datos=res.data.data;
    //         this.labels=res.data.labels;
    //         this.total=res.data.total;
    //         this.refresca++;
    //     })
    //     .catch(err => {
    //         console.error(err);
    //     })
    // }
  },
  mounted() {
    // data_db(this.dia);
    this.get_temps();
    this.get_temps2();
    this.desde = this.data_mes_inici();
  },
};
</script>

<style>
</style>
