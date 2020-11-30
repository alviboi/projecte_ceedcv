<template>
<div class="dia">
    <div class="lateral_esquerre">
        <button data-toggle="tooltip" data-placement="bottom" title="CEFIRE" @click="cefire('CEFIRE')" class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button>
        <button data-toggle="tooltip" data-placement="bottom" title="CURS" @click="cefire('CURS')" class="btn btn-primary btn-sm"><i class="fas fa-chalkboard-teacher"></i></button>
        <button data-toggle="tooltip" data-placement="bottom" title="GUARDIA" @click="cefire('GUARDIA')" class="btn btn-primary btn-sm"><i class="fas fa-dog"></i></button>
<button data-toggle-second="tooltip" title="COMPENSA" class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-umbrella-beach"></i>
            </button>
                        <button data-toggle-second="tooltip" title="VISITA" class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-school"></i>
            </button>
            <div class="dropdown-menu">
                <div class="px-2 py-2">

                        <label for="exampleDropdownFormEmail1">Quin centre?</label>
                        <input @keyup.enter.prevent="cefire('VISITA '+centre_in)" class="form-control d-inline" id="exampleDropdownFormEmail1" placeholder="Centre" v-model="centre_in">
                </div>
            </div>

    </div>
</div>
</template>

<script>
export default {

}
</script>

<style lang="sass" scoped>
    .dia {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(5, 1fr);
        grid-column-gap: 2px;
        grid-row-gap: 2px;
        border: 2px solid;


    .lateral_esquerre {
        grid-area: 1 / 1 / 6 / 2;
        border: 2px solid red;
        &.div  {
            width: 100%;
            height: 100%;
        }
        &.button  {
            width: 100%;
            height: 100%;
        }
    }

    .baix {
        grid-area: 5 / 1 / 6 / 5;
        border: 2px solid gray;
    }

    .principal {
        grid-area: 1 / 2 / 5 / 5;
        }
    }
</style>
