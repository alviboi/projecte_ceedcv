<template>
	<div>
        <div class="uk-grid-small uk-child-width-expand uk-margin" uk-grid>
            <div class="uk-width-1-3">
                <h3>Horari d'assessors</h3>
            </div>
            <div class="uk-width-1-3">
                <form class="uk-width-expand uk-search uk-search-default">
                    <a uk-search-icon></a>
                    <input v-model="busca_ass" @input="busca_as_escri" class="uk-search-input" type="search" placeholder="">
                </form>
            </div>
        </div>
        {{results}}
          <!-- <ul
                v-show="isOpen"
                class="autocomplete-results"
            >
                <li
                v-for="(result, i) in results"
                :key="i"
                class="autocomplete-result"
                >
                {{ result.name }}
                </li>
            </ul> -->

    <div  class="grid-calendar">
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
        <div  class="costat">
            <div class="mati">
            <input type="radio" id="mati" value="m" v-model="mati_radio">
            <label for="mati">Matí</label>
            <br>
            <input type="radio" id="vesprada" value="v" v-model="mati_radio">
            <label for="vesprada">Vesprada</label>
            </div>
            <div v-for="(user, key) in users" class="assessor_nom" :key="key" :id="user.id" data-uk-tooltip="pos: left; animation: true; offset: 12;" :title="user.name" draggable="true" @drag="comenca_drag">{{user.name}}</div>
        </div>
    </div>
	</div>
</template>

<script>
import { CalendarView, CalendarViewHeader } from "vue-simple-calendar"
// The next two lines are processed by webpack. If you're using the component without webpack compilation,
// you should just create <link> elements for these. Both are optional, you can create your own theme if you prefer.
require("vue-simple-calendar/static/css/default.css")
require("vue-simple-calendar/static/css/holidays-us.css")
require("vue-simple-calendar/static/css/gcal.css")
export default {
	name: "CalendarDemoApp",
	components: {
		CalendarView,
		CalendarViewHeader,
	},
	data: function () {
		return {
            isOpen: false,
            results: null,
            busca_ass: "",
            users: [],
            mati_radio: 'm',
            id_drag: null,
			dia: new Date(),
			selectionStart: null,
			selectionEnd: null,
			theme: "gcal",
			items: Array()
				// .fill()
				// .map((_, i) => this.getRandomEvent(i)),
		}
	},
	computed: {
		themeOptions() {
            let ret = {
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
        busca_as_escri() {
            this.isOpen = true;
            this.filterResults();
        },
        filterResults() {
            var self=this;
            this.results = this.users.filter((item => item.name.toLowerCase().indexOf(this.busca_ass.toLowerCase()) > -1));
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
        get_totes_guardies(){
            var result = []
            let any=this.dia.getFullYear();
            let mes=this.dia.getMonth();
            axios.get("guardia/totes/"+(mes+1)+"/"+any)
            .then(res => {
                console.log(res);
                this.emplena_calendari_guardies(res.data)
            })
            .catch(err => {
                console.error(err);
            });

        },
        emplena_calendari_guardies(result) {
            for (let index = 0; index < result.length; index++) {
                const element = result[index];
                let mati = (element[2]=="09:00:00") ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
                let fechas = element[1].split('-');
                let i = {
                    id: element[3],
                    title: "<div id="+element[3]+" data-uk-tooltip='pos: right; animation: true; offset: 12;' title=\""+element[0]+"\">"+mati+" "+element[0]+"</div>",
                    startDate: Date.UTC(fechas[0], fechas[1]-1, fechas[2]),
                    // endDate: Date.UTC(2020, 11, 10),
                    classes: "custom-date-class-red uk-animation-scale-up",
                };
                this.items.push(i);
            }
            this.index=result.length;
        },
        comenca_drag(e){
            console.log(e.target);
            this.id_drag=e.target;

        },
        drag_on_prova(calendarItem, date, windowEvent) {//textContent
            //@drop-on-date([calendarItem, date, windowEvent])
            console.log(calendarItem);
            console.log(date);
            var id_res=null;
            let fetxa = Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate()+1);
            let url="guardia/insert";
            let fetxa2 = data_db(date);
            let params ={
                id: this.id_drag.id,
                data: fetxa2,
                mati: this.mati_radio
            };
            axios.post(url,params)
            .then(res => {
                console.log(res);
                id_res=res.data.id;
                let mati = (this.mati_radio=="m") ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
                // let ind = this.index;
                let drag_item = {
                    id: id_res,
                    title: "<div id="+id_res+" data-uk-tooltip='pos: right; animation: true; offset: 12;' title=\""+this.id_drag.textContent+"\">"+mati+" "+this.id_drag.textContent+"</div>",
                    startDate: fetxa,
                    classes: "custom-date-class-red uk-animation-scale-up",
                };
                this.items.push(drag_item);
            })
            .catch(err => {
                console.error(err);
            })

        },
        drag_prova(item,e) {
            //[calendarItem, windowEvent]
            console.log(item);
            console.log(e);
        },
        este2(item,e) {
            //[calendarItem, windowEvent]
            console.log(e);
        },
        borrar(item,e) {
            console.log(item);
            var doc = new DOMParser().parseFromString(item.title, "text/html");
            console.log(doc);
            for (let index = 0; index < this.items.length; index++) {
                if(this.items[index].id == item.id)
                this.items.splice(index,1);
            }
            let url = "guardia/" + item.id;
            axios.delete(url)
            .then(res => {
                console.log(res)
            })
            .catch(err => {
                console.error(err);
            })
		},
		setdia(d) {
            this.dia = d;
            this.items= [];
            this.get_totes_guardies();

		},
		setSelection(dateRange) {
			this.selectionEnd = dateRange[1]
			this.selectionStart = dateRange[0]
		},
		finishSelection(dateRange) {
			this.setSelection(dateRange)
		},
		// getRandomEvent(index) {
		// 	const startDay = Math.floor(Math.random() * 28 + 1)
		// 	const endDay = Math.floor(Math.random() * 4) + startDay
		// 	var d = new Date()
		// 	var i = {
		// 		id: index,
		// 		title: "Event " + (index + 1),
		// 		startDate: Date.UTC(d.getUTCFullYear(), d.getUTCMonth(), startDay),
		// 		endDate: Date.UTC(d.getUTCFullYear(), d.getUTCMonth(), endDay),
		// 		classes: "custom-date-class-red",
		// 	}
		// 	return i
		// },
    },
    mounted() {
        this.agafa_users();
        this.get_totes_guardies();
    },
}
</script>

<style lang="sass" scope>
$color_guardia: red
$linea: #dddddd

.altura
    padding-bottom: 30px !important
.general
    font-family: Avenir, Arial, Helvetica, sans-serif
    display: flex
    height: 87vh
    width: 100%


.cv-item.custom-date-class-red
    background-color: $color_guardia
    border: 1px solid $linea
    border-radius: 8px



.cv-item.custom-date-class-blue
    background-color:  $color_guardia

.cv-item
    margin-top: 15px

.cabecal
    display: grid
    grid-template-columns: 1fr 1fr 1fr 1fr
    grid-template-rows: 1fr
    gap: 0px 20px
    grid-template-areas: "arrere mig mig avant"
    .arrere
        grid-area: arrere
    .mig
        grid-area: mig
        text-align: center
        margin-bottom: 0px
        margin-top: 5px
    .avant
        grid-area: avant
.grid-calendar
    display: grid
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr
    grid-template-rows: 1fr
    gap: 0px 0px
    height: 87vh
    grid-template-areas: "calendari calendari calendari calendari calendari calendari calendari calendari calendari costat"
.calendari
    grid-area: calendari
.costat
    padding: 3%
    grid-area: costat
    & .mati
        border: 1px solid black
        border-radius: 5px
        margin-bottom: 3px
    & .assessor_nom
        max-width: 10em
        vertical-align: top
        height: 1.3em
        line-height: 1.3em
        font-size: 0.9em
        white-space: nowrap
        overflow: hidden
        display: block
        cursor: pointer
        border: 1px solid $linea
        border-radius: 8px
        background-color: white
        margin-top: 2px
        background-color: $color_guardia
        color: #fffafd
        padding: 1px
        padding-left: 3px

</style>
