<template>
<div id="tabs" class="container">

    <div class="tabs">
        <a v-on:click="activetab='comp1'" v-bind:class="[ activetab === 'comp1' ? 'active' : '' ]">Horaris</a>
        <a v-on:click="activetab='comp2'" v-bind:class="[ activetab === 'comp2' ? 'active' : '' ]">Horaris Assessors</a>
        <a v-on:click="activetab='comp3'" v-bind:class="[ activetab === 'comp3' ? 'active' : '' ]">Busca en horaris</a>
        <a v-on:click="activetab='comp4'" v-bind:class="[ activetab === 'comp4' ? 'active' : '' ]">Afegix guardies</a>
        <a v-on:click="activetab='comp5'" v-bind:class="[ activetab === 'comp5' ? 'active' : '' ]">Busca en centres</a>
        <a v-on:click="activetab=3" v-bind:class="[ activetab === 6 ? 'active' : '' ]">Tab 3</a>
        <a v-on:click="activetab=1" v-bind:class="[ activetab === 7 ? 'active' : '' ]">Horaris</a>
        <a v-on:click="activetab=2" v-bind:class="[ activetab === 8 ? 'active' : '' ]">Tab 2</a>
        <a v-on:click="activetab=3" v-bind:class="[ activetab === 9 ? 'active' : '' ]">Tab 3</a>
    </div>

    <div class="content">
        <div class="tabcontent">
        <transition name="component-fade" mode="out-in">
            <component  v-bind:is="activetab"></component>
        </transition>
        </div>
        <!-- <transition-group name="fade" mode="out-in">
        <div v-if="activetab === 1" class="tabcontent" key="1">
            Is this the real life? Is this just fantasy?
            <horariComponent />
        </div>
        <div v-if="activetab === 2" class="tabcontent" key="2">
            Caught in a landslide, no escape from reality
        </div>
        <div v-if="activetab === 3" class="tabcontent" key="3">
            Open your eyes, look up to the skies and see
        </div>
        </transition-group> -->
    </div>

</div>
</template>

<script>

Vue.component('horariComponent', require('./horariComponent.vue').default);
Vue.component('horariasseComponent', require('./horariasseComponent.vue').default);
Vue.component('buscahorariComponent', require('./buscahorariComponent.vue').default);
Vue.component('centresComponent', require('./centresComponent.vue').default);




export default {
    data() {
        return {
            ajuda2: 'aa',
            activetab: 'comp1',
        }
    },
    components: {
        'comp1' : {
        template: '<div ><horariComponent /></div>'
        },
        'comp2' : {
        template: '<div ><horariasseComponent /></div>'
        },
        'comp3' : {
        template: '<div ><horariasseComponent /></div>'
        },
        'comp3' : {
        template: '<div ><centresComponent /></div>'
        }
    },
    methods: {
        activat() {
            this.activetab = this.$root.$data.ajuda;
        }
    },
    mounted() {
        //this.activat();
    },

}
</script>

<style lang="sass" scope>
/* Import Google Font */
@import url(https://fonts.googleapis.com/css?family=Nunito+Sans)

/* RESET */
*
  box-sizing: border-box
  margin: 0
  padding: 0


/* STYLING */
.container
    max-width: 100%
    min-width: 100%
    margin: 20px auto
    font-family: "Nunito Sans", Arial, Helvetica, sans-serif
    color: #888


/* Style the tabs */
.tabs
    overflow: hidden
    margin-left: 20px
    margin-bottom: -2px // hide bottom border


.tabs ul
    list-style-type: none
    margin-left: 20px


.tabs a
    float: left
    cursor: pointer
    padding: 12px 24px
    transition: background-color 0.2s
    border: 1px solid #ccc
    border-right: none
    background-color: #f1f1f1
    border-radius: 10px 10px 0 0
    font-weight: bold

.tabs a:last-child
    border-right: 1px solid #ccc


/* Change background color of tabs on hover */
.tabs a:hover
    background-color: #aaa
    color: #fff


/* Styling for active tab */
.tabs a.active
    background-color: #fff
    color: #484848
    border-bottom: 2px solid #fff
    cursor: default


/* Style the tab content */
.tabcontent
    padding: 30px
    border: 1px solid #ccc
    border-radius: 10px
    box-shadow: 3px 3px 6px #e1e1e1

</style>
