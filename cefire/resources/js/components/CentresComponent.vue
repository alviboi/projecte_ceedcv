<template>

  <div style="width: 100%">
    <input type="checkbox" v-model="editant">Edita</input>
    <vue-table-dynamic
      @cell-click="EditaCelda"
      :params="params"

      ref="table"
    >
    </vue-table-dynamic>
  </div>
</template>

<script>
import VueTableDynamic from 'vue-table-dynamic'
export default {
  name: 'Demo',
  data() {
    return {
      editant: false,
      params: {
        data: [
          ["id","assessor","nom","codi","situacio","CP","ciutat","contacte","mail_contacte","tlf_contacte"]
        ],
        header: 'row',
        enableSearch: true,
        pagination: true,
        border:true,
        sort: [1,2,3,4,6],
        stripe: true,
        pageSize: 20,
        columnWidth: [{column: 0, width: '4%'}, {column: 3, width: '6%'}, {column: 4, width: '4%'},{column: 5, width: '4%'},{column: 6, width: '6%'}],
        edit: {
          row: [1],
          column: [1],
        }
      }
    }
  },
  components: { VueTableDynamic },
  methods: {
      prova(){
          let prova  = [5, 'fsfs', '7c95fdsfsf7', 'fsfds'];
          this.params.data.push(prova);
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
        console.log('onCellChange: ', rowIndex, columnIndex, data);
        let edit= {
          row: [rowIndex],
          column: [columnIndex],
        }
        this.params.edit=edit;

    }
  },

  mounted() {
      this.get_centres();
  },
}
</script>
