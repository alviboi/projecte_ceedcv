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
</div>
</template>

<script>
export default {

}
</script>

<style lang="sass">
    .dia
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
        grid-area: 1 / 2 / 5 / 5

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
