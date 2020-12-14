<template>
  <div>
      <div v-for="item in users" :key="item.id">
          <div class="llistat">
              <div class="id">
                  <span uk-icon="icon: home"></span>
                  {{ item.id }}
              </div>
              <div class="nom">
                  <span data-uk-icon="icon: user"></span>
                  <b>{{ item.name }}</b>
              </div>
              <div class="mail">
                  <span data-uk-icon="icon: mail"></span>
                  {{ item.email }}
              </div>
              <div class="perfil">
                  <span data-uk-icon="icon: world"></span>
                  {{ item.Perfil }}
              </div>
              <div class="rfid">
                  <span data-uk-icon="icon: credit-card"></span>
                  {{ item.rfid }}
              </div>
              <div class="botons">
                <div href="" @click="edita(item.id)" class="uk-icon-button" uk-icon="file-edit"></div>
                <div href="" class="uk-icon-button uk-text-danger" uk-icon="trash"></div>
              </div>
          </div>
      </div>

    <div id="edita" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Modal Title</h2>
            </div>
            <div class="uk-modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                <button class="uk-button uk-button-primary" type="button">Save</button>
            </div>
        </div>
    </div>


  </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
        }
    },
    methods: {
        edita(id){
            UIkit.modal("#edita").show();
        },
        agafa_users(){
            axios.get("user")
            .then(res => {
                console.log(res);
                this.users=res.data;
            })
            .catch(err => {
                console.error(err);
            })
        },

    },
    mounted() {
        this.agafa_users();
    },
}
</script>

<style lang="sass" scope>
.llistat
    display: grid
    grid-template-columns: 0.3fr 1.7fr 1fr 1fr 1fr 0.3fr
    grid-template-rows: 1fr
    gap: 0px 0px
    grid-template-areas: "id nom mail perfil rfid botons"
    border: 2px solid black
    border-radius: 10px
    margin: 10px
    padding: 5px
    comu
        overflow: hidden
    .id
        @extend comu
        grid-area: id
    .nom
        @extend comu
        grid-area: nom
    .mail
        @extend comu
        grid-area: mail
    .perfil
        grid-area: perfil
    .rfid
        @extend comu
        grid-area: rfid
    .botons
        @extend comu
        grid-area: botons
        display: flex
        align-items: right
        text-align: right



</style>
