<template>
	<div>
        <div class="uk-grid">
        <div class="uk-width-1-4"><button @click="agafa_users">Este</button></div>
        <div class="uk-width-1-4"><button @click="get_totes_guardies">Guardies</button></div>
        <div class="uk-width-1-4"><button @click="drag_prova">drag prova</button></div>
        <div class="uk-width-1-4"><button>a</button></div><label @drag="comenca_drag">Example Label</label>
    </div>
    <div  class="grid-calendar">
        <div  class="calendari">
            <calendar-view
                :show-date="dia"
                :items="items"
                :enable-date-selection="true"
                :enableDragDrop="true"
                :selection-start="selectionStart"
                :selection-end="selectionEnd"
                :display-week-numbers="false"
                :item-top="themeOptions.top"
                :item-content-height="themeOptions.height"
                :item-border-height="themeOptions.border"
                :class="`theme-` + theme"
                :current-period-label="themeOptions.currentPeriodLabel"
                class="holiday-us-traditional holiday-us-official"
                @date-selection-start="setSelection"
                @date-selection="setSelection"
                @date-selection-finish="finishSelection"
                @click-item="este2"
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
            <div v-for="(user, key) in users" :key="key" :id="user.id" data-uk-tooltip="pos: left; animation: true; offset: 12;" :title="user.name" draggable="true" @drag="comenca_drag">{{user.name}}</div>
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
            users: [],
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
                        index: 1,
                        users: [],
						top: "1.4em",
						height: "1.4em",
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
            axios.get("guardia/totes/"+mes+"/"+any)
            .then(res => {
                console.log(res);
                result=res.data;
            })
            .catch(err => {
                console.error(err);
            });
            result.forEach(element => {
                let mati = (element['inici']=="09:00:00") ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
                let fechas = element['data'].split('-');
                let i = {
                    id: index,
                    title: mati+" "+element['name'],
                    startDate: Date.UTC(fechas[0], fechas[1], fechas[2]),
                    // endDate: Date.UTC(2020, 11, 10),
                    classes: "custom-date-class-blue",
                };
                this.index++;
                this.items.push(i);
            });

        },
        comenca_drag(e){
            console.log(e.target.id);
            this.id_drag=e.target.id;

        },
        drag_on_prova(calendarItem, date, windowEvent) {
            //@drop-on-date([calendarItem, date, windowEvent])
            console.log(calendarItem);
            console.log(date);
            let fetxa = Date.UTC(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate()+1);
            let este = data_db(date);
            let drag_item = {
				id: 100006,
				title: este,
                startDate: fetxa,
                // endDate: fetxa,
				classes: "custom-date-class-blue",
            };
            this.items.push(drag_item);
        },
        drag_prova(item,e) {
            //[calendarItem, windowEvent]
            console.log(item);
            console.log(e);
        },
        este() {
			let i = {
				id: 100005,
				title: "<span uk-icon='heart'></span> Event prova",
				startDate: Date.UTC(2020, 11, 5),
				// endDate: Date.UTC(2020, 11, 10),
				classes: "custom-date-class-blue",
            };
            this.items.push(i);
        },
        este2(item,e) {
            //[calendarItem, windowEvent]
            console.log(e);
        },
        borrar() {
            //[calendarItem, windowEvent]
            this.items.splice(1,1);
		},
		setdia(d) {
			this.dia = d
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
}
</script>

<style lang="sass" scope>
.altura
    padding-bottom: 30px !important
.general
    font-family: Avenir, Arial, Helvetica, sans-serif
    display: flex
    height: 87vh
    width: 100%


.cv-item.custom-date-class-red
    background-color: #ff6666

.cv-item.custom-date-class-blue
    background-color: #7d66ff

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
    & div
        max-width: 10em
        vertical-align: top
        height: 1.3em
        line-height: 1.3em
        font-size: 0.9em
        white-space: nowrap
        overflow: hidden
        display: block
        cursor: pointer
        border: 1px solid black
        border-radius: 5px
        background-color: white
        margin: 1px
</style>
