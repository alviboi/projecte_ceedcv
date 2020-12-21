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
                Habilitar des de l'aparell significa que al fitxar tant des de l'ordinador com de l'aparell quedarà enregistrat amb l'hora que s'ha fet. S'ha d'informar a tots els assessors que s'ha habilitat aquesta opció.
                <div class="uk-margin">
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input v-model="fitxar_aparell" class="uk-checkbox" type="checkbox" > Habilita fitxar desde aparell</label>
                    </div>
                </div>
                <div class="uk-margin">
                    <button @click="get_usuaris_ldap" class="uk-button uk-button-primary">Guarda</button>
                </div>
            </div>
        </div>
    </div>

    <div id="usuaris_ldap" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Usuaris importables</h2>
        <div class="uk-margin">
            <div v-for="(item, index) in usuaris" :key="item.id" class="item">
                <span>{{ item.name }}</span> <span>{{ item.email }}</span><input value="false" v-model="importa[index]" class="uk-checkbox" type="checkbox" >
            </div>
        </div>
        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Tanca</button>
            <button class="uk-button uk-button-primary" type="button">Importa</button>
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
        }
    },
}
</script>

<style lang="sass" scope>
.item
    border: 1px solid grey
    margin: 5px
    padding: 5px

</style>
