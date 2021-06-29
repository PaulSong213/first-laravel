<template>
  <nav class="">
    <transition-group name="to-small" tag="nav" class="bg-gray-100 px-1 pt-1 flex flex-nowrap space-x-0.5 overflow-x-auto table-side-nav-scroll">
      <section v-for="(page,index) in pages" :key="page.id">
        <div  class="rounded-t-md py-1 pl-1 pr-2 text-xs select-none overflow-hidden whitespace-nowrap text-white w-full transition-all" :class="[page.id !== currentPageId ? page.color + ' cursor-pointer hover:bg-opacity-80' : 'bg-white text-gray-700']" @click="setActivePage(page.id, index)">
          <h6> {{page.title }} </h6>
        </div>
      </section>
    </transition-group>
  </nav>

  <main class="px-2 py-4">
    <dynamic-template :component="activePageContent" ></dynamic-template>
  </main>
</template>

<script>
import  { h } from 'vue';
import SideNavigationLinks from './SideNavigationLinks.vue';
import Chat from './Chat.vue';
import AddNewItem from './AddNewItem.vue';

export default {
  name : 'MultiTab',
  components: {
    'dynamic-template' : {
      props: ['component'],
      render() {
        return h(this.component, this.props)
      },
      computed : {
        props(){
          if(this.component.name === "AddNewItem"){
            return {
              title : 'Add New Post'
            }
          }
          return {};
        }
      }
    }
  },  
  data() {
    return {
      currentPageId : 1,
      activePageContent : "",
      pages : [
        {
          'id' : 1,
          'title' : 'Navigation',
          'color' : 'bg-green-500',
          'content' : SideNavigationLinks
        },
        {
          'id' : 2,
          'title' : 'Chat',
          'color' : 'bg-purple-500',
          'content' : Chat,
        },
        {
          'id' : 3,
          'title' : 'Add new Post',
          'color' : 'bg-blue-500',
          'content' : AddNewItem
        },
      ]
    }
  },
  render(h) {
    if(!this.activePageContent){
      return h('div', 'Loading...');
    }else{
      return this.activePageContent();
    }
  },
  mounted(){
    this.setActivePage(1,0);
  },
  methods : {
    setActivePage(pageId, pageIndex){
      this.activePageContent = this.pages[pageIndex].content;
      this.currentPageId = pageId;
    },
    removePage(index){
      this.pages.splice(index, 1);
    }
  },

}
</script>

<style scoped>
  .to-small-enter-active,
  .to-small-leave-active {
    transition: all 600ms ease-in-out;
  }

  .to-small-enter-from,
  .to-small-leave-to {
    opacity: 0;
    transform: translateX(-50%);
  }
</style>
