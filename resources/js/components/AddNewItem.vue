<template>
  <section>
    {{title}}
    <div>
      <input type="text" v-model="test">
      {{test}}
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
  }
}
</script>

<style>

</style>