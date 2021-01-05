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
                    input-class="uk-form"
                    :monday-first="true"
                    placeholder="Desde"
                    value=""
                    v-model="desde"
                    @input="canvia_data()"
                    >
                </Datepicker>
                <Datepicker
                    input-class="uk-form"
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
        <div>
            <button class="uk-button uk-button-primary" @click="agafa_dades_permisos_sense_arxius()">Busca assessors sense permís pujat</button>
            <button class="uk-button uk-button-primary uk-margin-top">Busca arxius orfes i elimina'ls</button>
        </div>
    </div>

    <hr />
    <div>
      <div
        class="uk-margin uk-grid uk-grid-medium uk-child-width-1-3 uk-child-width-1-6@l uk-child-width-1-6@xl"
        name="fade" is="transition-group"
        data-uk-grid
      >
            <div class="element_permis uk-margin-small-right" v-for="permis in permisos" :key="permis.id">
                <div class="file">
                    <span @click="mira_arxiu(permis.arxiu)"><i :class='permis.arxiu !== null? "fas fa-file-pdf fa-6x" : "fas fa-exclamation-circle fa-6x uk-text-danger"'></i></span>
                </div>
                <div class="Dia_p">
                    <b>Data: </b>{{permis.data}}
                    <b>Inici: </b>{{permis.inici}}
                    <b>Fi: </b>{{permis.fi}}
                </div>
                <div class="Nom">
                    <h5><b>Motiu: </b>{{permis.motiu}}<br>
                    <b>Nom: </b>{{permis.name}}</h5>
                </div>
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
                desde: '0000-00-00',
                fins: '0000-00-00',
                permisos: {},
                results: [],
                arxiu: null
            };
        },
        components: {
            Datepicker,
        },
        methods: {
            filterResults() {
                this.results = this.users.filter((item => item.name.toLowerCase() == this.busca_ass.toLowerCase()));
                if (this.results[0] !== undefined){
                    this.completa();
                }
            },
            agafa_users(){
                axios.get("user")
                .then(res => {
                    this.users=res.data;
                })
                .catch(err => {
                    this.$toast.error(err.message);
                    console.error(err);
                })
            },
            canvia_data(){
                console.log(this.fins);
                console.log(this.desde);
                if(this.fins > this.desde) {
                    this.filterResults();
                }
            },
            agafa_dades_permisos () {
                if (this.results[0]['id'] !== undefined)
                    {
                        let url = "permis_desde";
                        let params = {
                            'id': this.results[0]['id'],
                            'desde': data_db(this.desde),
                            'fins': data_db(this.fins)
                        }
                        axios.post(url,params)
                        .then(res => {
                            this.permisos = res.data;
                            console.log(res)
                        })
                        .catch(err => {
                            this.$toast.error(err.response.data.message);
                        })
                    }
            },
            agafa_dades_permisos_sense_arxius () {

                    let url = "permis_sense_arxiu";
                    axios.post(url)
                    .then(res => {
                        this.permisos = res.data;
                        console.log(res)
                    })
                    .catch(err => {
                        this.$toast.error(err.response.data.message);
                    })
            },
            completa () {
                if (this.busca_ass != '' && this.desde != '0000-00-00' && this.fins != '0000-00-00'){
                    this.agafa_dades_permisos();
                }
            },
            mira_arxiu(d){
                let url="download_permis";
                let params={
                    "arxiu": d
                }
                axios(
                    {
                        url: url,
                        method: 'POST',
                        responseType: 'blob', // important per a rebre arxius
                        params: params
                    }
                    )
                .then(response => {
                    console.log(response);
                    var blob = new Blob([response.data], { type: 'application/pdf' });
                    var url = window.URL.createObjectURL(blob);
                    var link = document.createElement('a');
                    link.href = url;
                    link.download = 'permis.pdf'
                    link.click();
                })
                .catch(err => {
                    this.$toast.error("Error: Pareix que no ha pujat el permís");
                    console.error(err);
                })
            },
        },
        mounted() {
            this.agafa_users();

        },
        watch: {
            busca_ass() {
                this.filterResults();
            }
        },
    };
</script>

<style lang="sass" scope>
.element_permis
    display: grid
    grid-template-columns: 1fr 1fr
    // grid-template-rows: 150px 150px
    gap: 0px 0px
    grid-template-areas: "file Dia" "Nom Nom"
    border: 1px solid
    padding: 15px
    margin: 20px
    border-radius: 8px
    background: #e6d5e7
    .file
        grid-area: file
        overflow: hidden
        cursor: pointer
    .Dia_p
        grid-area: Dia
    .Nom
        margin-top: 6px
        grid-area: Nom
        overflow: auto
</style>
