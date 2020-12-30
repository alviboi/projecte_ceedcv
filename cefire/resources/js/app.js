/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./home.js');

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'e5f9e09fa9fe46c9b61e',
//     cluster: 'eu',
//     encrypted: true,
// });
window.pusher = new Pusher('e5f9e09fa9fe46c9b61e',{
    cluster: 'eu',
    encrypted: true,
  });
window.channel = pusher.subscribe('guardies');

// window.channel = pusher.subscribe('private-cefire');




// Echo.private('chat')
//   .listen('MessageSent', (e) => {
//     this.messages.push({
//       message: e.message.message,
//       user: e.user
//     });
//   });


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

Vue.component('configuracio-component', require('./components/ConfiguracioComponent.vue').default);
Vue.component('editaperfil-component', require('./components/EditaperfilComponent.vue').default);

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

Vue.component('centres-component', require('./components/Centres/CentresComponent.vue').default);
Vue.component('centresmeus-component', require('./components/Centres/CentresmeusComponent.vue').default);


Vue.component('report-component', require('./components/Reports/ReportComponent.vue').default);
Vue.component('line-component', require('./components/Reports/LinegrafComponent.vue').default);
Vue.component('controlass-component', require('./components/ControlassComponent.vue').default);

Vue.component('dadespersonals-component', require('./components/DadespersonalsComponent.vue').default);


//L'error més comú que tens quan modifiques una cosa d'ací, no està funcionant npm run watch, o compila a npm run dev




Vue.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 5,
    newestOnTop: true
  });



Vue.prototype.$eventBus = new Vue();


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


axios.get("logat_id")
.then(res => {
    console.log(res);
    Vue.prototype.$user_id = res.data;
})
.catch(err => {
    console.error(err);
})

const app = new Vue({
    el: '#app',
    data: {
        showMissatge: false,
        showModal: false,
        // calendar: false,
        // horari: false,
        showEdita: false,
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
        'centresmeus': {
            template: '<div><centresmeus-component /></div>'
        },
        'report1': {
            template: '<div><report-component /></div>'
        },
        'controlass': {
            template: '<div><controlass-component /></div>'
        },
        'personals': {
            template: '<div><dadespersonals-component /></div>'
        },
        'configuracio': {
            template: '<div><configuracio-component /></div>'
        },


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
        },
        tanca_edita() {
            // alert('hola');
            this.showEdita=false;
        }
    },
    created() {
        this.$eventBus.$on('tanca-avis', this.tanca_avis);
        this.$eventBus.$on('tanca-missatge', this.tanca_missatge);
        this.$eventBus.$on('tanca-edita', this.tanca_edita);

    },
    beforeDestroy() {
        this.$eventBus.$off('tanca-avis');
        this.$eventBus.$off('tanca-missatge');
        this.$eventBus.$off('tanca-edita');

    }

});

