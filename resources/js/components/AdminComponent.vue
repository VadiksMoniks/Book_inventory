<template>
  <div class="app">
      <AdminHeader></AdminHeader>
      <AdminTable></AdminTable>
  </div>
</template>

<script>
import AdminHeader from './AdminHeader.vue';
import AdminTable from './AdminTable.vue';


export default {

  components: {
        AdminHeader, AdminTable
   },
  methods:{
    
  }
}
</script>
<style scoped>

</style>