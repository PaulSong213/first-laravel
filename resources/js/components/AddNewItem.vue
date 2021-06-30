<template>
  <section>
    {{title}}
    <div>
      <input type="text" v-model="test">
    </div>
  </section>
</template>

<script>
export default {
  name : 'AddNewItem',
  data (){
    return {
      test : ""
    }
  },
  props : {
    title : String
  },
  mounted(){
    console.log('add new');
  }
}
</script>

<style>

</style>