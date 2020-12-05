<template>
<div class="general">



<div class="grid-container">
    <div v-for="(key,index) in 7" :key="key" :class='"d"+(index+1)'>
        <dia-component :data="lloc[index+1]" mati="m"/>
        <dia-component :data="lloc[index+1]" mati="v"/>
    </div>
</div>

</div>
</template>

<script>
    export default {
        data() {
            return {
                dia: new Date(),
                lloc: []
            }
        },
        methods: {
            async emplena_lloc () {
                let aux_dia = getDiumenge(this.dia);
                this.lloc[0]=aux_dia;
                for (let index = 1; index < 8; index++) {
                    this.lloc[index] = new Date(aux_dia.setTime( aux_dia.getTime() + 1 * 86400000 ));
                }
            }
        },
        created() {
            this.emplena_lloc();
        },
        watch: {
            dia() {
                emplena_lloc();
            }
        },
    }

</script>

<style lang="sass" scope>
.general
    padding: 1%
.grid-container
    display: grid
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr
    gap: 10px
    grid-template-areas: "d1 d2 d3 d4 d5 d6 d7"
    @for $var from 0 through 6
        .d#{$var}
            grid-area: d#{$var}


</style>
