<template>
  <div @mouseenter="notifTab(false)" class="shadow border-b border-gray-200 rounded-md h-full relative" >
    <nav>
      <transition-group name="to-small" tag="nav" class="bg-gray-100 px-1 pt-1 flex flex-nowrap space-x-0.5 overflow-x-auto table-side-nav-scroll">
        <section v-for="(page,index) in pages" :key="page.id">
          <div  class="rounded-t-md py-1 pl-1 pr-2 text-xs select-none overflow-hidden whitespace-nowrap text-white w-full transition-all" :class="[page.id !== currentPageId ? page.color + ' cursor-pointer hover:bg-opacity-80' : 'bg-white text-gray-700']" @click="setActivePage(page.id, index)">
            <h6> {{page.title }} </h6>
          </div>
        </section>
      </transition-group>
    </nav>

    <main class="px-2 py-4">
      <keep-alive>
        <component :is="activePageContent"></component>
      </keep-alive>
    </main>

    <span v-if="hasNewItem" class="flex h-5 w-5 absolute right-0 top-0 bg-transparent">
      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400"></span>
      <span class="relative inline-flex rounded-full h-5 w-5 bg-green-500"></span>
    </span>
  </div>
</template>

<script>
import { defineAsyncComponent } from 'vue'

const SideNavigationLinks = defineAsyncComponent(() =>import('./SideNavigationLinks.vue'));
const Chat = defineAsyncComponent(() =>import('./Chat.vue'));


export default {
  name : 'MultiTab',
  components: {
  },  
  data() {
    return {
      hasNewItem : false,
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
        }
      ]
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
    },
    notifTab(hasNotif = true){
      this.hasNewItem = hasNotif;
    },
    addPage(title,color,content){
      const id = this.nextAvailableId; 
      const newPage = {
        'id' : id,
        'title' : title,
        'color' : color,
        'content' : content
      }
      this.notifTab();
      this.pages.push(newPage);
      this.setActivePage(this.pages[this.pages.length - 1].id, this.pages.length - 1);
    }
  },
  computed: {
    nextAvailableId() {
      return this.pages.length + 1;
    }
  }

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
