<template>

</template>

<script>
export default {
    data() {
        return {

        }
    },
    methods: {
        get_usuarios(){
            axios.get(url,params)
            .then(res => {
                console.log(res)
            })
            .catch(err => {
                console.error(err);
            })
        }
    },
}
</script>

<style>

</style>
