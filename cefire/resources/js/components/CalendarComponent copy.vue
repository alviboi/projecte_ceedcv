<template>
	<div id="component">
        <button @click="este">este</button>
		<h1>My Calendar</h1>
		<calendar-view
			:show-date="showDate"
			:items="items"
			:enable-date-selection="true"
			:display-week-numbers="false"
			:item-top="themeOptions.top"
			:item-content-height="themeOptions.height"
			:item-border-height="themeOptions.border"
			:current-period-label="themeOptions.currentPeriodLabel"
			class="holiday-us-traditional holiday-us-official"
			@date-selection-start="setSelection"
			@date-selection="setSelection"
			@date-selection-finish="finishSelection"
		>
			<calendar-view-header
				slot="header"
				slot-scope="{ headerProps }"
				:header-props="headerProps"
				:previous-year-label="themeOptions.previousYearLabel"
				:previous-period-label="themeOptions.previousPeriodLabel"
				:next-period-label="themeOptions.nextPeriodLabel"
				:next-year-label="themeOptions.nextYearLabel"
				@input="setShowDate"
			/>
		</calendar-view>
	</div>
</template>
<script>
	import { CalendarView, CalendarViewHeader } from "vue-simple-calendar"
	// The next two lines are processed by webpack. If you're using the component without webpack compilation,
	// you should just create <link> elements for these. Both are optional, you can create your own theme if you prefer.
	require("vue-simple-calendar/static/css/default.css")
	require("vue-simple-calendar/static/css/holidays-us.css")

	export default {
        data() {
            return {
				theme: "gcal",
				showDate: new Date(),
                items: Array(25)
            }
		},
		components: {
			CalendarView,
			CalendarViewHeader,
		},
		name: 'app',
		data: function() {
			return { showDate: new Date() }
		},
		components: {
			CalendarView,
			CalendarViewHeader,
		},
		methods: {
            este() {

            },
			setShowDate(d) {
				this.showDate = d;
            },
			este() {
				alert(this.items[1].title);
			},
			setShowDate(d) {
			this.showDate = d
			},
			setSelection(dateRange) {
				this.selectionEnd = dateRange[1]
				this.selectionStart = dateRange[0]
			},
			finishSelection(dateRange) {
				this.setSelection(dateRange)
			},
			getRandomEvent(index) {
				const startDay = Math.floor(Math.random() * 28 + 1)
				const endDay = Math.floor(Math.random() * 4) + startDay
				var d = new Date()
				var i = {
					id: index,
					title: "Event " + (index + 1),
					startDate: Date.UTC(d.getUTCFullYear(), d.getUTCMonth(), startDay),
					endDate: Date.UTC(d.getUTCFullYear(), d.getUTCMonth(), endDay),
					classes: Math.random() > 0.9 ? ["custom-date-class-red"] : null,
				}
				return i
			},
        },
        mounted() {
			console.log('Component mounted calendar.');
			this.items=[{
				id: 1,
				title: "Event 1",
				startDate: Date.UTC("2020", "12", "7"),
				endDate: Date.UTC("2020", "12", "9"),
				classes: "custom-date-class-red",
                },
            {
				id: 2,
				title: "Event 2",
				startDate: Date.UTC("2020", "12", "14"),
				endDate: Date.UTC("2020", "12", "17"),
				classes: "custom-date-class-red",
                }];
		},
		computed: {
		themeOptions() {
			return this.theme == "gcal"
				? {
						top: "2.6em",
						height: "2.1em",
						border: "0px",
						previousYearLabel: "\uE5CB\uE5CB",
						previousPeriodLabel: "\uE5CB",
						nextPeriodLabel: "\uE5CC",
						nextYearLabel: "\uE5CC\uE5CC",
						currentPeriodLabel: "Today",
				}
				: {
						top: "1.4em",
						height: "1.4em",
						border: "2px",
						previousYearLabel: "<<",
						previousPeriodLabel: "<",
						nextPeriodLabel: ">",
						nextYearLabel: ">>",
						currentPeriodLabel: "",
				}
			},
		},

	}
</script>
<style>
	#component {
		font-family: 'Avenir', Helvetica, Arial, sans-serif;
		color: #2c3e50;
		height: 67vh;
		margin-left: auto;
		margin-right: auto;
	}
    .cv-item.custom-date-class-red {
	background-color: #ff6666;
}
</style>
