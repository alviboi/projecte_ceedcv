<template>
  <div>
      <div class="uk-float-center">
          <h2>Avisos</h2>
      </div>
    <transition-group name="avis-complete" tag="p">
      <div v-for="avis in avisos" :key="avis.id" class="avis-complete-item">
          <div class="uk-card uk-card-default uk-width-1-1 margens" uk-margin>
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <span uk-icon="icon: warning; ratio: 2.5"></span>
                    </div>
                    <div class="uk-width-expand">
                        <h3 class="uk-card-title uk-margin-remove-bottom">{{avis.cap}}</h3>
                        <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">{{avis.data}}</time></p>
                    </div>
                </div>
            </div>
            <div class="uk-card-body">
                <p class="uk-text-large">{{avis.avis}}</p>
            </div>
            <div class="uk-card-footer">
                <span>Creat per {{avis.nom}}</span><div @click="borra(avis.id)"  class="uk-button uk-button-text uk-float-right">Borra avís</div>
            </div>
        </div>
      </div>
      </transition-group>
  </div>
</template>

<script>

export default {
    data() {
        return {
            avisos: []
        }
    },
    methods: {
        get_avisos() {
            let url="avisos";
            axios.get(url)
            .then(res => {
                console.log(res);
                this.avisos=res.data;
            })
            .catch(err => {
                console.error(err);
            })
        },
        borra(id) {
            let url="avisos/"+id;

            axios.delete(url)
            .then(res => {
                console.log(res);
                for (let index = 0; index < this.avisos.length; index++) {
                    if(this.avisos[index].id == id)
                    this.avisos.splice(index,1);
                }
            })
            .catch(err => {
                console.error(err);
                this.$toast.error(err.response.data.message);
            })
        }
    },
    mounted() {
        this.get_avisos();
    },
    created() {
        this.$eventBus.$on('avis-enviat', this.get_avisos);
    },
    beforeDestroy() {
        this.$eventBus.$off('avis-enviat');
    }
}
</script>

<style lang="sass" scope>
.margens
    margin-top: 10px

.avis-complete-item
    transition: all 1s
    display: inline-block
    margin-right: 10px
    min-width: 100%
    *
        background-color: #fce8e8

.avis-complete-enter, .avis-complete-leave-to
    opacity: 0
    transform: translateX(30px)

.avis-complete-leave-active
    position: absolute


</style>
