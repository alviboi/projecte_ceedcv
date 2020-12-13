<template>

  <div style="width: 100%">
    <input type="checkbox" v-model="editant">Edita</input>
    <vue-table-dynamic
      class="tabla"
      @cell-click="EditaCelda"
      @cell-change="prova"
      :params="params"

      ref="table"
    >
    </vue-table-dynamic>
  </div>
</template>

<script>
import VueTableDynamic from 'vue-table-dynamic'
export default {
  data() {
    return {
      editant: false,
      params: {
        data: [
          ["id","assessor","nom","codi","situacio","CP","ciutat","contacte","mail_contacte","tlf_contacte","Observacions"]
        ],
        header: 'row',
        enableSearch: true,
        pagination: true,
        border:true,
        sort: [1,2,3,4,6],
        stripe: true,
        pageSize: 20,
        columnWidth: [{column: 0, width: '4%'}, {column: 3, width: '6%'}, {column: 4, width: '4%'},{column: 5, width: '4%'},{column: 6, width: '6%'}],
        edit: {}
      }
    }
  },
  components: { VueTableDynamic },
  methods: {
      prova(rowIndex,columnIndex,data){
          console.log(this.params.data[rowIndex]);
      },
      get_centres() {
          axios.get("centres")
          .then(res => {
              console.log(res);
              this.params.data=res.data;
          })
          .catch(err => {
              console.error(err);
          })
      },
      EditaCelda (rowIndex, columnIndex, data) {
        console.log(rowIndex, columnIndex);
        if (this.editant==true){
            if (columnIndex == 1){
                alert("No pots editar este camp");
            } else {
                let edit= {
                    row: [rowIndex],
                    column: [columnIndex],
                }
            this.params.edit=edit;
            }
        } else {
            let url="http://www.ceice.gva.es/abc/i_guiadecentros/es/centro.asp?codi="+this.params.data[rowIndex][3];
            console.log(this.params.data[rowIndex][3]);
            newTab(url);
        }

    }
  },
  watch: {
      editant(){
          if (this.editant == false ){
              let edit= {}
              this.params.edit=edit;
          }
      }
  },
  mounted() {
      this.get_centres();
  },
}
</script>
<style lang="sass" scope>
.tabla
    font-size: 14px !important
    padding: 10px
    border-radius: 10px
    -webkit-box-shadow: 3px 8px 144px -53px rgba(0,0,0,0.53)
    -moz-box-shadow: 3px 8px 144px -53px rgba(0,0,0,0.53)
    box-shadow: 3px 8px 144px -53px rgba(0,0,0,0.53)

</style>
