<template>

<div>
    <div class="uk-child-width-1-2@s uk-grid-match" uk-grid>
        <div>
            <div class="uk-card uk-card-secondary uk-card-hover uk-card-body">
                <h3 class="uk-card-title">LDAP</h3>
                <label class="uk-form-label" for="form-stacked-text">Introdueix la clau de netadmin del servidor LliureX</label>
                <div class="uk-margin">
                    <input v-model="netadmin" class="uk-input" type="password" placeholder="Contrasenya netadmin">
                </div>
                <label class="uk-form-label" for="form-stacked-text">Introdueix la contrasenya</label>
                <div class="uk-margin">
                    <input v-model="servidor" class="uk-input" type="text" placeholder="IP del servidor">
                </div>
                <div class="uk-margin">
                    <button @click="get_usuaris_ldap" class="uk-button uk-button-primary">Agafa usuaris</button>
                </div>
            </div>
        </div>

        <div>
            <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                <h3 class="uk-card-title">Comportament fitxatge</h3>
                Habilitar des de l'aparell significa que al fitxar tant des de l'ordinador com de l'aparell quedarà enregistrat amb l'hora que s'ha fet. S'ha d'informar a tots els assessors que s'ha habilitat aquesta opció. Ja que és possible que fitxen amb un dia tota la setmana i no quede enregistrada l'hora correcta d'entrada.
                <div class="uk-margin">
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input v-model="fitxar_aparell" @click="fitxar_aparell_f()" class="uk-checkbox" type="checkbox" > Habilita fitxar desde aparell</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="usuaris_ldap" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Usuaris importables</h2>
        <div class="uk-margin uk-overflow-auto">
            <p>Els següents usuaris que es poden importar a l'aplicació de fitxatges són (aquells usuaris que el nom d'usuari no siga un correu electrònic no es poden importar):</p>
        </div>
        <div class="uk-margin">
            <template v-for="(item, index) in usuaris">
                <div v-if="item.email.includes('@')" :key="item.id">
                    <div class="item">
                        <div class="nom"><span uk-icon="user"></span>{{ item.name }}</div> <div class="mail"><span uk-icon="mail"></span>{{ item.email }}</div><div class="che"><input class="uk-checkbox" value="false" v-model="importa[index]" type="checkbox" ></div>
                    </div>
                </div>
            </template>
        </div>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Tanca</button>
            <button class="uk-button uk-button-primary" @click="importa_f" type="button">Importa</button>
        </p>
    </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            usuaris: {},
            netadmin: "",
            servidor: "",
            fitxar_aparell: false,
            importa: []
        }
    },
    methods: {
        importa_f(){
            let dades_enviar=[];
            for (let index = 0; index < this.importa.length; index++) {
                if (this.importa[index] !== undefined && this.importa[index]==true) {
                    dades_enviar.push(this.usuaris[index]);
                }
            }
            axios.post("user",dades_enviar)
            .then(res => {
                console.log(res)
            })
            .catch(err => {
                console.error(err);
            })
        },
        get_usuaris_ldap(){
            let params = {
                'contrasenya': this.netadmin,
                'ip': this.servidor
            }
            axios.post("get_usuaris_ldap",params)
            .then(res => {
                console.log(res)
                this.usuaris=res.data;
                UIkit.modal('#usuaris_ldap').show();
            })
            .catch(err => {
                console.error(err);
                alert(err.message);
            })
        },
        get_configuracio(){
            axios.get("control")
            .then(res => {
                this.fitxar_aparell=res.data.aparell;
                console.log(res)
            })
            .catch(err => {
                console.error(err);
            })
        },
        fitxar_aparell_f() {
            let params = {
                'aparell': this.fitxar_aparell? 0 : 1
            }
            axios.put("control/1",params)
            .then(res => {
                console.log(res);
                this.$toast.success(res.data);

            })
            .catch(err => {
                console.error(err);
                this.$toast.error(err.response.data);

            })
        }
    },
    mounted() {
        this.get_configuracio();
    },
}
</script>

<style lang="sass" scope>

.item
    border: 1px solid grey
    margin: 5px
    padding: 5px
    border-radius: 5px
    display: grid
    grid-template-columns: 1.4fr 1.4fr 0.2fr
    grid-template-rows: 1fr
    gap: 5px 5px
    grid-template-areas: "nom mail che"
    &.nom
        grid-area: a
    &.mail
        grid-area: b
    &.che
        grid-area: c
        float: right
        align-content: center
        text-align: center
        padding: 2px

</style>
