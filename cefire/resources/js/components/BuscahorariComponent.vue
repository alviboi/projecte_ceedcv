<template>
	<div>

        <div class="uk-grid-small uk-child-width-expand uk-margin" uk-grid>
            <div class="uk-width-1-3">
        <h3>Elements a buscar</h3>
            </div>
            <div class="uk-width-1-3">
                <label><input v-model="cefire" class="uk-checkbox" type="checkbox"> Cefire</label>
                <label><input v-model="compensa" class="uk-checkbox" type="checkbox"> Compensa</label>
                <label><input v-model="curs" class="uk-checkbox" type="checkbox"> Curs</label>
                <label><input v-model="guardia" class="uk-checkbox" type="checkbox"> Guardia</label>
                <label><input v-model="permis" class="uk-checkbox" type="checkbox"> Permis</label>
                <label><input v-model="visita" class="uk-checkbox" type="checkbox"> Visita</label>
            </div>
        </div>




        <div  class="calendari">
            <calendar-view
                :doEmitItemMouseEvents='false'
                :show-date="dia"
                :items="items"
                :enable-date-selection="false"
                :enableDragDrop="false"
                :display-week-numbers="false"
                :item-top="themeOptions.top"
                :item-content-height="themeOptions.height"
                :item-border-height="themeOptions.border"
                :class="`theme-` + theme"
                :current-period-label="themeOptions.currentPeriodLabel"
                :startingDayOfWeek=1
                @click-item="envia_missatge"
                class="holiday-us-traditional holiday-us-official"
            >
                <calendar-view-header
                    slot="header"
                    slot-scope="{ headerProps }"
                    :header-props="headerProps"
                    :previous-period-label="themeOptions.previousPeriodLabel"
                    :next-period-label="themeOptions.nextPeriodLabel"
                    @input="setdia"
                />
            </calendar-view>
        </div>
	</div>
</template>

<script>
import { CalendarView, CalendarViewHeader } from "vue-simple-calendar"
require("vue-simple-calendar/static/css/default.css")
require("vue-simple-calendar/static/css/holidays-us.css")
require("vue-simple-calendar/static/css/gcal.css")
export default {
	components: {
		CalendarView,
		CalendarViewHeader,
	},
	data: function () {
		return {
            cefire: false,
            curs: false,
            compensa: false,
            guardia: false,
            permis: false,
            visita: false,
			dia: new Date(),
			theme: "gcal",
			items: Array()
		}
	},
	computed: {
		themeOptions() {
            let ret = {
                result: null,
                index: 0,
                users: [],
                top: "1.6em",
                height: "2em",
                border: "2px",
                previousYearLabel: "<<",
                previousPeriodLabel: "<",
                nextPeriodLabel: ">",
                nextYearLabel: ">>",
                currentPeriodLabel: "",

				};
            return ret;
		},
	},
	methods: {
        setdia(d) {
            this.dia = d;
            this.items= [];
            this.cefire= false;
            this.curs= false;
            this.compensa= false;
            this.guardia= false;
            this.permis= false;
            this.visita= false;

            //this.tots_els_elements_get();
		},
        get_element(element){
            var result = []
            let any=this.dia.getFullYear();
            let mes=this.dia.getMonth();
            let url="complet/"+element+"/"+any+"/"+(mes+1)
            axios.get(url)
            .then(res => {
                console.log(res);
                this.emplena_calendari(element,res.data)
            })
            .catch(err => {
                console.error(err);
            });

        },
        emplena_calendari(element,result) {
            var num=0;
            var clase="custom-date-class-red";
            var toti="id";
            switch (element) {
                case 'cefire':
                    num=1000000;
                    clase="custom-date-class-blue";
                    toti="inici";
                    break;
                case 'compensa':
                    num=2000000;
                    clase="custom-date-class-gray";
                    toti="motiu";
                    break;
                case 'curs':
                    num=3000000;
                    clase="custom-date-class-yellow";
                    toti="curs";
                    break;
                case 'guardia':
                    num=4000000;
                    clase="custom-date-class-red";
                    toti="inici";
                    break;
                case 'permis':
                    num=5000000;
                    clase="custom-date-class-green";
                    toti="motiu";
                    break;
                case 'visita':
                    num=6000000;
                    clase="custom-date-class-pink";
                    toti="centre";
                    break;
                default:
                    num=7000000;
                    clase="custom-date-class-red";
                    break;
            }
            for (let index = 0; index < result.length; index++) {
                const ele = result[index];
                let inici=ele.inici.replace(/:/g,'');
                let inici_int=Number(inici);
                let fi=ele.inici.replace(/:/g,'');
                console.log("Fi: "+fi);
                let fi_int=Number(fi);
                console.log("Fi_int: "+fi_int);
                let mati = (inici_int>=80000 && inici_int<150000) ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
                let fechas = ele.data.split('-');
                let i = {
                    id: (ele.id+num),
                    title: "<div id="+(ele.id+num)+" data-uk-tooltip='pos: right; animation: true; offset: 12;' title=\""+ele[toti]+"\">"+mati+" "+ele.name+"</div>",
                    startDate: Date.UTC(fechas[0], fechas[1]-1, fechas[2]),
                    classes: clase+" uk-animation-scale-up",
                };
                this.items.push(i);
            }
            this.index=result.length;
        },
        comproba_id_element (id){
            if (id>=1000000) {
                if (id>=2000000) {
                    if (id>=3000000) {
                        if (id>=4000000) {
                            if (id>=5000000) {
                                if (id>=6000000) {
                                    if (id>=7000000) {
                                        return "Error";
                                        }
                                return "Visita";
                                }
                            return "Permís";
                            }
                        return "Guardia";
                        }
                    return "Curs";
                    }
                return "Compensa";
                }
            return "Cefire";
            }
        },
        envia_missatge(calendarItem, windowEvent) {
            var parser = new DOMParser();
            var doc = parser.parseFromString(calendarItem.title, 'text/html');
            let destinatari = doc.body.innerText.trim();
            let data = fecha_format(calendarItem.startDate);
            let id = this.comproba_id_element(Number(doc.all[3].id));
            console.log(id);
            let envia =  {
                destinatari: destinatari,
                assumpte: "En relació al element "+id+" del dia "+ data
            }
            this.$eventBus.$emit('missatge-variables',envia);
        }
    },
    mounted() {


    },
    watch: {
        cefire(newValue, oldValue) {
            if (newValue == true){
                this.get_element('cefire');
            } else {
                for (let index = this.items.length-1; index >= 0; index--) {
                    console.log((this.items[index].id>=1000000) && (this.items[index].id<2000000));
                    if((this.items[index].id>=1000000) && (this.items[index].id<2000000)) {
                        console.log(index);
                        this.items.splice(index,1);
                    }
                }
            }
        },
        compensa(newValue, oldValue) {
            if (newValue == true){
                this.get_element('compensa');
            } else {
                for (let index = this.items.length-1; index >= 0; index--) {
                    if((this.items[index].id>=2000000) && (this.items[index].id<3000000)) {
                        console.log(index);
                        this.items.splice(index,1);
                    }
                }
            }
        },
        curs(newValue, oldValue) {
            if (newValue == true){
                this.get_element('curs');
            } else {
                for (let index = this.items.length-1; index >= 0; index--) {
                    if((this.items[index].id>=3000000) && (this.items[index].id<4000000)) {
                        console.log(index);
                        this.items.splice(index,1);
                    }
                }
            }
        },
        guardia(newValue, oldValue) {
            if (newValue == true){
                this.get_element('guardia');
            } else {
                for (let index = this.items.length-1; index >= 0; index--) {
                    if((this.items[index].id>=4000000) && (this.items[index].id<5000000)) {
                        console.log(index);
                        this.items.splice(index,1);
                    }
                }
            }
        },
        permis(newValue, oldValue) {
            if (newValue == true){
                this.get_element('permis');
            } else {
                for (let index = this.items.length-1; index >= 0; index--) {
                    if((this.items[index].id>=5000000) && (this.items[index].id<6000000)) {
                        console.log(index);
                        this.items.splice(index,1);
                    }
                }
            }
        },
        visita(newValue, oldValue) {
            if (newValue == true){
                this.get_element('visita');
            } else {
                for (let index = this.items.length-1; index >= 0; index--) {
                    if((this.items[index].id>=6000000) && (this.items[index].id<7000000)) {
                        console.log(index);
                        this.items.splice(index,1);
                    }
                }
            }
        }
    },


}
</script>

<style lang="sass" scope>
$color_guardia: red
$linea: #dddddd

.altura
    padding-bottom: 30px !important
.calendari
    font-family: Avenir, Arial, Helvetica, sans-serif
    // display: flex
    // height: 100vh
    width: 100%
    display: flex
    flex-direction: column
    flex-grow: 1



item-general
    border: 1px solid $linea
    border-radius: 8px
    font-size: 1.1em

.cv-item.custom-date-class-red
    @extend item-general
    background-color: red

.cv-item.custom-date-class-gray
    @extend item-general
    background-color: gray

.cv-item.custom-date-class-yellow
    @extend item-general
    background-color: yellow

.cv-item.custom-date-class-blue
    @extend item-general
    background-color: blue

.cv-item.custom-date-class-green
    @extend item-general
    background-color: green

.cv-item.custom-date-class-pink
    @extend item-general
    background-color: #cc00cc


.calendari
    height: 87vh

</style>
