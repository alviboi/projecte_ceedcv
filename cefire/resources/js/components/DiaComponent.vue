<template>
<div class="dia">
    <div class="lateral_esquerre flex-container">
        <button data-toggle="tooltip" data-placement="bottom" title="CEFIRE" @click="cefire('CEFIRE')" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>
        <button data-toggle="tooltip" data-placement="bottom" title="CURS" @click="cefire('CURS')" class="btn btn-primary btn-sm"><i class="fas fa-chalkboard-teacher"></i></button>
        <button data-toggle="tooltip" data-placement="bottom" title="GUARDIA" @click="cefire('GUARDIA')" class="btn btn-primary btn-sm"><i class="fas fa-dog"></i></button>
        <button data-toggle-second="tooltip" title="COMPENSA" class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-umbrella-beach"></i>
        </button>
        <button data-toggle-second="tooltip" title="VISITA" class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-school"></i>
        </button>
    </div>
    <div class="principal">
        <div class="s-cefire"></div>
        <div class="s-compensa">COMPENSA</div>
        <div class="s-curs">Curs</div>
        <div class="s-visita">visita</div>
        <div class="s-guardia">guardia</div>
    </div>
</div>
</template>

<script>

export default {

}
</script>

<style lang="sass">

    .dia
        max-width: 150px
        display: grid
        grid-template-columns: min-content repeat(3, 1em)
        grid-template-rows: repeat(5, 1fr)
        grid-column-gap: 2px
        grid-row-gap: 2px
        border: 2px solid
        &:hover > .lateral_esquerre
            visibility: visible
            opacity: 1
            transform: translate(0px)
            overflow-x: hidden
            white-space: nowrap
            -webkit-overflow-scrolling: touch




    .lateral_esquerre
        grid-area: 1 / 1 / 6 / 2
        overflow-x: hidden
        white-space: nowrap
        visibility: hidden
        opacity: 0
        transform: translate(-3px)
        transition: transform 0.3s, visibility 1s, opacity 0.5s linear
        -webkit-overflow-scrolling: touch



    .baix
        grid-area: 5 / 1 / 6 / 5
        border: 2px solid gray

    .principal
        grid-area: 1 / 1 / 6 / 6
        display: inline-flex
        flex-wrap: wrap
        flex-direction: column
        justify-content: flex-start
        align-items: auto
        align-content: flex-start
        padding: 5px
        .s-
            flex: 0 1 auto
            margin: 1px
            border: 1px solid
            border-radius: 5px
            padding: 3px
            &cefire
                @extend .s-
                background-color: blue
                content: "CEFIRE"
                font-weight: 300
                color: #fff
            &compensa
                @extend .s-
                background-color: gray
            &guardia
                @extend .s-
                background-color: red
            &visita
                @extend .s-
                background-color: blue
            &curs
                @extend .s-
                background-color: yellow
            &:after
                font-family: "Font Awesome 5 Free"
                text-align: right
                float: right
                content: "\f2ed"
                margin-left: 10px
                color: #fff
                font-weight: 300
                cursor: pointer
                &:active
                    display: none


    .flex-container
        display: flex
        flex-wrap: wrap
        flex-direction: column
        justify-content: flex-start
        align-items: auto
        align-content: flex-start
        .button
            flex: 0 1 auto
            margin: 1px










</style>
