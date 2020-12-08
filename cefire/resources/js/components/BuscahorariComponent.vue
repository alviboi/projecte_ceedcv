<template>
	<div>
        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input :value="cefire" class="uk-checkbox" type="checkbox"> Cefire</label>
            <label><input :value="compensa" class="uk-checkbox" type="checkbox"> Compensa</label>
            <label><input :value="curs" class="uk-checkbox" type="checkbox"> Curs</label>
            <label><input :value="guardia" class="uk-checkbox" type="checkbox"> Guardia</label>
            <label><input :value="permis" class="uk-checkbox" type="checkbox"> Permis</label>
            <label><input :value="visita" class="uk-checkbox" type="checkbox"> Visita</label>


        </div>
        <div  class="calendari">
            <calendar-view
                :doEmitItemMouseEvents='false'
                :show-date="dia"
                :items="items"
                :enable-date-selection="false"
                :enableDragDrop="true"
                :selection-start="selectionStart"
                :selection-end="selectionEnd"
                :display-week-numbers="false"
                :item-top="themeOptions.top"
                :item-content-height="themeOptions.height"
                :item-border-height="themeOptions.border"
                :class="`theme-` + theme"
                :current-period-label="themeOptions.currentPeriodLabel"
                :startingDayOfWeek=1
                class="holiday-us-traditional holiday-us-official"
                @date-selection-start="setSelection"
                @date-selection="setSelection"
                @date-selection-finish="finishSelection"
                @click-item="borrar"
                @drag-start="drag_prova"
                @drop-on-date="drag_on_prova"
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
            cefire: true,
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
        get_element(element){
            var result = []
            let any=this.dia.getFullYear();
            let mes=this.dia.getMonth();
            let url="/user_"+element+"/"+this.results[0].id+"/"+any+"/"+(mes+1)
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
                    num=10000;
                    clase="custom-date-class-blue";
                    toti="inici";
                    break;
                case 'compensa':
                    num=20000;
                    clase="custom-date-class-gray";
                    toti="motiu";
                    break;
                case 'curs':
                    num=30000;
                    clase="custom-date-class-yellow";
                    toti="curs";
                    break;
                case 'guardia':
                    num=40000;
                    clase="custom-date-class-red";
                    toti="inici";
                    break;
                case 'permis':
                    num=50000;
                    clase="custom-date-class-green";
                    toti="motiu";
                    break;
                case 'visita':
                    num=60000;
                    clase="custom-date-class-pink";
                    toti="centre";
                    break;
                default:
                    num=70000;
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
                    title: "<div id="+(ele.id+num)+" data-uk-tooltip='pos: right; animation: true; offset: 12;' title=\""+ele[toti]+"\">"+mati+" "+element.toUpperCase()+"</div>",
                    startDate: Date.UTC(fechas[0], fechas[1]-1, fechas[2]),
                    classes: clase+" uk-animation-scale-up",
                };
                this.items.push(i);
            }
            this.index=result.length;
        }
    },
    mounted() {

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
    display: flex
    height: 90vh
    width: 100%


.cv-item.custom-date-class-red
    background-color: $color_guardia
    border: 1px solid $linea
    border-radius: 8px
    font-size: 1.2em


.cv-item
    margin-top: 15px



.calendari
    height: 87vh

</style>
