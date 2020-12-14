/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./home.js');



window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('avisos-component', require('./components/avisos/AvisosComponent.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('calendar-component', require('./components/CalendarComponent.vue').default);
Vue.component('dia-component', require('./components/DiaComponent.vue').default);
Vue.component('fitxar-component', require('./components/FitxarComponent.vue').default);
Vue.component('horaris-component', require('./components/HorarisComponent.vue').default);
Vue.component('buscahorari-component', require('./components/BuscahorariComponent.vue').default);
Vue.component('escriuavis-component', require('./components/avisos/EscriuavisComponent.vue').default);

Vue.component('escriumsg-component', require('./components/missatges/EscriumsgComponent.vue').default);
Vue.component('llegirmsg-component', require('./components/missatges/LlegirmsgComponent.vue').default);

Vue.component('centres-component', require('./components/CentresComponent.vue').default);
Vue.component('report-component', require('./components/Reports/ReportComponent.vue').default);
Vue.component('line-component', require('./components/Reports/LinegrafComponent.vue').default);
Vue.component('controlass-component', require('./components/ControlassComponent.vue').default);








Vue.prototype.$eventBus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    data: {
        showMissatge: false,
        showModal: false,
        calendar: false,
        horari: false,
        view: 'principal'
    },
    components: {
        'calendar': {
          template: '<div><calendar-component/></div>'
        },
        'horari': {
          template: '<div><fitxar-component /></div>'
        },
        'horaritots': {
            template: '<div><horaris-component/></div>'
        },
        'buscaenhoraris': {
            template: '<div><buscahorari-component/></div>'
        },
        'principal': {
            template: '<div><avisos-component /></div>'
        },
        'centres': {
            template: '<div><centres-component /></div>'
        },
        'report1': {
            template: '<div><report-component /></div>'
        },
        'controlass': {
            template: '<div><controlass-component /></div>'
        }


      },
    methods: {
        canvi() {
            this.horari=false;
            this.calendar=true;
        },
        tanca_avis() {
            // alert('hola');
            this.showModal=false;
        },
        tanca_missatge() {
            // alert('hola');
            this.showMissatge=false;
        }
    },
    created() {
        this.$eventBus.$on('tanca-avis', this.tanca_avis);
        this.$eventBus.$on('tanca-missatge', this.tanca_missatge);

    },
    beforeDestroy() {
        this.$eventBus.$off('tanca-avis');
        this.$eventBus.$off('tanca-missatge');

    }



    // components: {
    //     'escriuavis-component': () => import(
    //     './components/avisos/EscriuavisComponent.vue'
    //     ),
    // }
});
