<template>
  <div>
    <div
      class="uk-grid uk-grid-divider uk-grid-medium uk-child-width-1-2 uk-child-width-1-3@l uk-child-width-1-3@xl"
      data-uk-grid
    >
      <div>
        <span class="uk-text-small"><span data-uk-icon="icon:user" class="uk-margin-small-right uk-text-primary"></span>Busca assessor:</span>
        <div class="uk-margin-small-top">
            <form class="uk-width-expand uk-search uk-search-default" autocomplete="on">
                <a @click="filterResults()" uk-search-icon></a>
                <input list="llista" v-model="busca_ass" class="uk-search-input">
                    <datalist class="llista" id="llista">
                        <option v-for="(user,key) in users" :key="key" :value="user.name">{{user.name}}</option>
                    </datalist>
            </form>
        </div>
      </div>
      <div>
        <span class="uk-text-small"><span data-uk-icon="icon:calendar" class="uk-margin-small-right uk-text-primary"></span>Rang de dates:</span>
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
        </div>
    </div>

    <hr />
    <div>
      <div
        class="uk-grid uk-grid-divider uk-grid-medium uk-child-width-1-2 uk-child-width-1-2@l uk-child-width-1-2@xl"
        data-uk-grid
      >
        <div>

        </div>
        <div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>

import Datepicker from "vuejs-datepicker";
import { ca } from "vuejs-datepicker/dist/locale";
    export default {
        data() {
            return {
                users: [],
                busca_ass: '',
                ca: ca,
                desde: '',
                fins: ''
            };
        },
        components: {
            Datepicker,
        },
        methods: {
            filterResults() {
                this.results = this.users.filter((item => item.name.toLowerCase() == this.busca_ass.toLowerCase()));
                //this.tots_els_elements_get();
            },
            agafa_users(){
                axios.get("user")
                .then(res => {
                    console.log(res);
                    this.users=res.data;
                })
                .catch(err => {
                    console.error(err);
                })
            },
            canvia_data(){
                console.log(this.fins);
                console.log(this.desde);
                if(this.fins > this.desde) {
                    // this.get_temps();
                } else {
                    this.$toast.error("No puc calcular temps invertit");
                }
            },
        },
        mounted() {
            this.agafa_users();

        },
    };
</script>

<style>
</style>
