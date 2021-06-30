<template>
  <section>
      <div class="flex flex-col space-y-1">
        <div v-for="(link, index) in links" :key="index" class="flex">
        <a v-if="link.url !== currentUrl" :href="link.url" class="hover:bg-gray-200 active:bg-gray-100 hover:underline px-2 py-3 rounded-md text-xs uppercase text-gray-600 tracking-wider w-full">{{ link.title }}</a>
        <a v-else class="bg-blue-500 text-white px-2 py-3 rounded-md text-xs uppercase tracking-wider w-full">{{ link.title }}</a>   
        </div>
      </div>
  </section>
</template>

<script>

export default {
  name : 'SideNavigationLinks',
  data () {
    return {
      links : [
        {
          'title' : 'Home',
          'url' : '/'
        },
        {
          'title' : 'Posts',
          'url' : '/posts'
        }
      ]
    }
  },
  computed : {
    currentUrl(){
      return window.location.pathname;
    } 
  }
}
</script>

<style>

</style>