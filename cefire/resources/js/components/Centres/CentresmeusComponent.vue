<template>
    <centres-component :busqueda2="bus" :editable='true'/>
</template>

<script>
export default {
    data() {
        return {
            bus: ""
        }
    },
    methods: {
        logat() {
            axios.get("logat")
            .then(res => {
                console.log(res);
                this.bus=res.data;
            })
            .catch(err => {
                console.error(err);
            })
        }
    },
    mounted() {
        this.logat();
    },
}
</script>

<style>

</style>


