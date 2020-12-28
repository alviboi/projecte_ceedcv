<template>
<div>

    <h1>{{ pagines }}</h1>

    <form id="search">
        Search <input name="query" v-model="busqueda">
    </form>

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
      </tr>
    </thead>
    <tbody>
      <tr v-for="(entry,index) in mostra" :key=index>
        <td v-for="(key, index) in columnes" :key=index>
          {{entry[key]}}
        </td>
        <td>
            <button>Este</button>
        </td>
      </tr>
    </tbody>
  </table>


        <nav aria-label="Page navigation example">
			<ul class="pagination">
				<li class="page-item">
					<button type="button" class="page-link" v-if="pagina != 1" @click="pagina--"> Anterior </button>
				</li>
				<li class="page-item">
                        <button type="button" class="page-link" v-for="(pageNumber,index) in pagines.slice(pagina-1, pagina+5)" :key="index" @click="pagina = pageNumber"> {{pageNumber}} </button>				</li>
				<li class="page-item">
					<button type="button" class="page-link" v-if="pagina < pagines.length" @click="pagina++"> Posterior </button>
				</li>
			</ul>
		</nav>





</div>
</template>

<script>
import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';
export default {
    data() {
        return {
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
        dadesFiltrades() {
            var ordenaKey = this.ordenaKey
            var filterKey = this.busqueda && this.busqueda.toLowerCase()
            var order = this.ordena[ordenaKey] || 1
            var data = this.datos
            if (filterKey) {
                data = data.filter(function (row) {
                return Object.keys(row).some(function (key) {
                    return String(row[key]).toLowerCase().indexOf(filterKey) > -1
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
			let NumeroPagines = Math.ceil(this.dadesFiltrades.length / 20);
			for (let index = 1; index <= NumeroPagines; index++) {
				this.pagines.push(index);
            }
        },
        pagina_f (datos) {
			let pagina = this.pagina;
			let perPagina = 20;
			let from = (pagina * perPagina) - perPagina;
			let to = (pagina * perPagina);
			return  datos.slice(from, to);
		}
    },
    watch: {
		dadesFiltrades () {
			this.setPagines();
		}
	},
    mounted() {
        this.get_centres();
    },

}
</script>

<style scope>

body {
  font-family: Helvetica Neue, Arial, sans-serif;
  font-size: 14px;
  color: #444;
}

table {
  border: 2px solid #42b983;
  border-radius: 3px;
  background-color: #fff;
}

th {
  background-color: #42b983;
  color: rgba(255,255,255,0.66);
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

td {
  background-color: #f9f9f9;
}

th, td {
	min-width: 3px;
	padding: 2px 10px;
    max-width: 200px;
    overflow: hidden;
}

th.active {
  color: #fff;
}

th.active .arrow {
  opacity: 1;
}

.arrow {
  display: inline-block;
  vertical-align: middle;
  width: 0;
  height: 0;
  margin-left: 5px;
  opacity: 0.66;
}

.arrow.asc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-bottom: 4px solid #fff;
}

.arrow.dsc {
  border-left: 4px solid transparent;
  border-right: 4px solid transparent;
  border-top: 4px solid #fff;
}

button.page-link {
	display: inline-block;
}
button.page-link {
    font-size: 20px;
    color: #29b3ed;
    font-weight: 500;
}
.offset{
  width: 500px !important;
  margin: 20px auto;
}
.pagination {
    display: -ms-flexbox;
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: .25rem;
}
</style>
