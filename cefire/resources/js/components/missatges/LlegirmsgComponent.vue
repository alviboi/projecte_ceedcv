<template>
    <div class="general">
        <div v-for="(user, index) in missatges" :key="index" class="missatge" :uk-toggle="'target: #missatge'+user.id">
            <div class="de"><span uk-icon="user"></span> {{user.name}}</div>
            <div><span uk-icon="mail"></span> {{user.cap}}</div>
            <div :id="'missatge'+user.id" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
                <h4><b>De:</b> {{user.name}}</h4>
                <h5><b>Capçalera:</b> {{user.cap}}</h5>
                <p>{{user.missatge}}</p>
                <p class="uk-text-right">
                    <button @click="borra(user.id)" class="uk-modal-button" type="button">Borra</button>
                    <button class="uk-modal-close" type="button">Tanca</button>
                </p>
            </div>
        </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            // users: [],
            missatges: [],
            results: []
        }
    },
    methods: {
        obri(id){
            UIkit.modal(id).show();
            // this.results = this.missatges.filter((item => item.id == id));
            // UIkit.modal('#missatge').show();
        },
        borra(id){
            for (let index = 0; index < this.missatges.length; index++) {
                if(this.missatges[index].id == id){
                    this.missatges.splice(index,1);
                }
            }
            let url = "notificacions/" + id;
            axios.delete(url)
            .then(res => {
                console.log(res)
            })
            .catch(err => {
                console.error(err);
            })
            UIkit.modal('#missatge'+id).hide();
        },


        // agafa_users(){
        //     axios.get("user")
        //     .then(res => {
        //         console.log(res);
        //         this.users=res.data;
        //     })
        //     .catch(err => {
        //         console.error(err);
        //     })
        // },
        agafa_missatges() {
            axios.get("notificacions")
            .then(res => {
                console.log(res);
                this.missatges=res.data;
            })
            .catch(err => {
                console.error(err);
            })
        }

    },
    mounted() {
        // this.agafa_users();
        this.agafa_missatges();
    },
}
</script>

<style lang="sass" scope>


.general
    display: flex
    // flex-wrap: wrap
    flex-direction: column
    // justify-content: flex-start
    align-items: stretch
    align-content: flex-start
    // overflow-y: scroll

.missatge
    display: block
    flex-grow: 0
    flex-shrink: 1
    flex-basis: auto
    align-self: auto
    margin-top: 15px
    border: 2px solid grey
    color: black
    background-color: white
    border-radius: 10px
    padding: 5px
    .de
        background: hsl(0, 0%, 85%)
        overflow-y: hidden

    // &.missatge

</style>
