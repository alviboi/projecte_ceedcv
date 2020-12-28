<template>
<div class="general_centres">
    <form id="search">
        Busca <input v-model="busqueda"> Centres per pàgina <input type="number" v-model="centres_per_pagina">
    </form>
<hr>
 <transition-group name="flip-list" tag="div">
     <div key="move_1">

    <table>
    <thead>
      <tr>
        <th v-for="key in columnes"
          @click="sortBy(key)"
          :class="{ active: ordenaKey == key }"
          :key=key>
          {{ key | capitalize }}
          <span class="arrow" :class="ordena[key] > 0 ? 'asc' : 'dsc'">
          </span>
        </th>
        <th>
            Edita
        </th>
      </tr>
    </thead>


    <tbody name="ordenaCeldes" is="transition-group">
      <tr v-for="(entry,index) in mostra" :key=index>
        <td v-for="(key, index2) in columnes" :key=index2>
          {{entry[key]}}
        </td>
        <td>
            <button @click="edita_centre(entry)" class="boto_edita"><i class="fas fa-edit"></i></button>
        </td>
      </tr>
    </tbody>



  </table>
<hr>
</div>
<div key="move_2">
    <nav aria-label="Page navigation example">
        <ul class="paginacio">
            <li class="pagina-item">
                <button type="button" class="pagina-link" v-if="pagina != 1" @click="pagina--"> Anterior </button>
            </li>
            <li class="pagina-item">
                    <button type="button" class="pagina-link" v-for="(pageNumber,index) in pagines.slice(pagina-1, pagina+5)" :key="index" @click="pagina = pageNumber"> {{pageNumber}} </button>				</li>
            <li class="pagina-item">
                <button type="button" class="pagina-link" v-if="pagina < pagines.length" @click="pagina++"> Posterior </button>
            </li>
        </ul>
    </nav>

</div>

 </transition-group>

<div id="edita-centre" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Edita centre</h2>
        <div class="uk-form-controls">
            <label for="recipient-name" class="uk-form-label">Centre:</label>
            <input type="text" class="uk-input" id="recipient-name" v-model="editant['nom']">
          </div>
          <div class="uk-form-controls">
            <label for="recipient-codi" class="uk-form-label">Codi:</label>
            <input type="number" class="uk-input" id="recipient-codi" v-model="editant['codi']">
          </div>
          <div class="uk-form-controls">
            <label for="recipient-situacio" class="uk-form-label">Situació:</label>
            <select type="text" class="uk-select" id="recipient-xituacio" v-model="editant['situacio']">
                <option>PUB.</option>
                <option>CON.</option>
            </select>
          </div>
          <div class="uk-form-controls">
            <label for="recipient-cp" class="uk-form-label">CP:</label>
            <input type="number" class="uk-input" id="recipient-cp" v-model="editant['CP']">
          </div>
          <div class="uk-form-controls">
            <label for="recipient-ciutat" class="uk-form-label">Ciutat:</label>
            <input type="text" class="uk-input" id="recipient-ciutat" v-model="editant['ciutat']">
          </div>
          <div class="uk-form-controls">
            <label for="recipient-assessor" class="uk-form-label">Assessoria:</label>
                <select class="uk-select" id="recipient-assessor" v-model="editant['assessor']">
                    <option v-for="(user,key) in users" :key="key" :value="user.name">{{user.name}}</option>
                </select>
          </div>
          <div class="uk-form-controls">
            <label for="recipient-contacte" class="uk-form-label">Contacte:</label>
            <input type="text" class="uk-input" id="recipient-contacte" v-model="editant['contacte']">
          </div>
          <div class="uk-form-controls">
            <label for="recipient-mail_contacte" class="uk-form-label">Mail contacte:</label>
            <input type="text" class="uk-input" id="recipient-mail_contacte" v-model="editant['mail_contacte']">
          </div>
          <div class="uk-form-controls">
            <label for="recipient-tlf" class="uk-form-label">Tlf contacte:</label>
            <input type="number" class="uk-input" id="recipient-tlf" v-model="editant['tlf_contacte']">
          </div>
          <div class="uk-form-controls">
            <label for="recipient-ob" class="uk-form-label">Observacions:</label>
            <textarea type="text" class="uk-input" rows="2" id="recipient-ob" v-model="editant['Observacions']">
            </textarea>
          </div>
          <div class="uk-text-center uk-margin">
              <a :href="url" class="uk-margin uk-h4">Informació del centre</a>
          </div>

        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Tanca</button>
            <button class="uk-button uk-button-danger uk-modal-close" @click="borra()" type="button">Borra centre</button>
            <button class="uk-button uk-button-primary" type="button" @click="envia_dades()">Salva</button>
        </p>
    </div>
</div>



</div>
</template>

<script>
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';
export default {
    data() {
        return {
            users: {},
            editant: {},
            centres_per_pagina: 15,
            pagina: 1,
            pagines: [],
            ordenaKey: [],
            ordena: {"id":1,"assessor":1,"nom":1,"codi":1,"situacio":1,"CP":1,"ciutat":1,"contacte":1,"mail_contacte":1,"tlf_contacte":1,"Observacions":1},
            busqueda: '',
            columnes: ["id","assessor","nom","codi","situacio","CP","ciutat","contacte","mail_contacte","tlf_contacte","Observacions"],
            datos: []
        }
    },
    computed: {
        url () {
            return "http://www.ceice.gva.es/abc/i_guiadecentros/es/centro.asp?codi="+this.editant['codi'];
        },
        dadesFiltrades() {
            var ordenaKey = this.ordenaKey
            var filtraKey = this.busqueda && this.busqueda.toLowerCase()
            var order = this.ordena[ordenaKey] || 1
            var data = this.datos
            if (filtraKey) {
                data = data.filter(function (row) {
                return Object.keys(row).some(function (key) {
                    return String(row[key]).toLowerCase().indexOf(filtraKey) > -1
                })
                })
            }
            if (ordenaKey) {
                data = data.slice().sort(function (a, b) {
                a = a[ordenaKey]
                b = b[ordenaKey]
                return (a === b ? 0 : a > b ? 1 : -1) * order
                })
            }
            return data

        },
        mostra () {
            return this.pagina_f(this.dadesFiltrades);
        }
    },
    filters: {
        capitalize: function (str) {
            return str.charAt(0).toUpperCase() + str.slice(1)
        }
    },
    methods: {
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
        edita_centre(edit) {
            UIkit.modal("#edita-centre").show();
            this.editant = edit;
        },
        sortBy(key) {
            this.ordenaKey = key;
            this.ordena[key] = this.ordena[key] * -1;
        },
        get_centres() {
            axios.get("centres")
            .then(res => {
                console.log(res);
                this.datos=res.data;
            })
            .catch(err => {
                console.error(err);
            })
            this.setPagines();
        },
        setPagines () {
            this.pagines = [];
			let NumeroPagines = Math.ceil(this.dadesFiltrades.length / this.centres_per_pagina);
			for (let index = 1; index <= NumeroPagines; index++) {
				this.pagines.push(index);
            }
        },
        pagina_f (datos) {
			let pagina = this.pagina;
			let perPagina = this.centres_per_pagina;
			let from = (pagina * perPagina) - perPagina;
			let to = (pagina * perPagina);
			return  datos.slice(from, to);
        },
        envia_dades() {
            let user_id=0;
            for (let index = 0; index < this.users.length; index++) {
                if (this.users[index]['name'] == this.editant['assessor']){
                    user_id=this.users[index]['id'];
                }
            }
            this.editant.user_id=user_id;


            let params = this.editant;
            let url = "centres/"+this.editant['id'];
            axios.put(url,params)
            .then(res => {
                console.log(res);
                this.$toast.success("Dades guardades");
            })
            .catch(err => {
                this.$toast.error(err.message);
                console.error(err);
            })
        },
        borra() {
            axios.delete("centres/"+this.editant['id'])
            .then(res => {
                console.log(res);
                this.$toast.success("Has esborrat el centre");
            })
            .catch(err => {
                console.error(err);
            })
        }
    },
    watch: {
		dadesFiltrades () {
			this.setPagines();
		}
	},
    mounted() {
        this.get_centres();
        this.agafa_users();
    },

}
</script>

<style lang="sass" scope>

    .general_centres

        table
            /* border: 2px solid #42b983; */
            border-radius: 3px
            background-color: #fff

        th
            background-color: #22111a
            color: rgba(255,255,255,0.66)
            cursor: pointer
            .active
                color: #fff
                .arrow
                    opacity: 1

        td
            background-color: #f9f9f9

        th, td
            min-width: 3px
            padding: 2px 10px
            max-width: 200px
            overflow: hidden


    .arrow
        display: inline-block
        vertical-align: middle
        width: 0
        height: 0
        margin-left: 5px
        opacity: 0.66

    .arrow.asc
        border-left: 4px solid transparent
        border-right: 4px solid transparent
        border-bottom: 4px solid #fff

    .arrow.dsc
        border-left: 4px solid transparent
        border-right: 4px solid transparent
        border-top: 4px solid #fff

    button.pagina-link
        display: inline-block
        font-size: 20px
        color: #22111a
        font-weight: 500
        background-color: white
        border: #22111a 1px solid

    .offset
        width: 500px !important
        margin: 20px auto

    .paginacio
        display: flex
        padding-left: 0
        list-style: none
        border-radius: .25rem

    .ordenaCeldes-enter-active,.ordenaCeldes-leave-active
        transition: all 1s

    .ordenaCeldes-enter,.ordenaCeldes-leave-to
            opacity: 0
            transform: translateX(30px)

    .flip-list-move
        transition: transform 1s


    .boto_edita
        background-color: #22111a
        color: white
        border-color: #444
        cursor: pointer


</style>
