<template>
    <transition name="fade">
    <div v-if="isAlertOpened"
        class="bg-gray-500 transition duration-150 ease-in-out fixed top-0 right-0 bottom-0 left-0 z-30 w-full overflow-hidden pt-20 h-full bg-opacity-60">
            <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
                <div class="relative rounded shadow-lg dark:bg-gray-800 bg-white w-full max-w-lg overflow-y-auto" style="max-height: 80vh">

                    <div :class="alertColor" class="py-10 bg-opacity-90 flex justify-center">
                      <ion-icon v-if="iconName" :name="iconName" class="w-24 h-24 block mx-auto text-white"></ion-icon>  
                    </div>
                    <div class="p-6">
                      <!-- TITLE -->
                      <h1 class="dark:text-gray-100 text-gray-800 font-bold text-lg">
                        {{title}}
                        </h1>

                      <!-- BODY -->
                      <div class="overflow-y-auto" style="max-height: 30vh">
                        <p class="py-4 text-base font-medium dark:text-gray-100 text-gray-800">{{body}}</p>
                      </div>

                      <!-- FOOTER -->
                      <p class="text-sm font-medium dark:text-gray-100 text-gray-600">{{footer}}</p>
                      <div class="sm:flex items-center justify-between pt-6">
                          <button v-if="!okButtonOnly"
                          class="py-3.5 w-full dark:text-gray-100 text-gray-600 leading-3 focus:outline-none hover:opacity-90 text-sm font-semibold border-gray-600 rounded border"
                          @click="willOpenAlert(false)">{{cancelButton}}</button>
                          <button v-if="!cancelButtonOnly"
                           @click="willUserAgreed(true)"
                          class="py-3.5 w-full sm:mt-0 mt-2 sm:ml-2 leading-3 text-white focus:outline-none hover:opacity-90 text-sm font-semibold border rounded" :class="okButtonColor">{{okButton}}</button>
                      </div>
                    </div>
                    <div class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 dark:text-gray-100 hover: dark:text-gray-100 text-gray-600 transition duration-150 ease-in-out bg-white p-1 rounded-full active:bg-red-600 active:text-white hover:bg-gray-500 hover:text-red-100" @click="willOpenAlert(false)">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-label="Close" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </div>
                </div>
            </div>
    </div>
    </transition>  
</template>

<script>
export default {
    name: "AlertModal",
    data(){
      return{
        isAlertOpened: false,
        callBackIfAgreed: null,
        isUserAgreed: false
      }
    },
    props:{
      title:{
        type: String,
        required: true
      }, 
      body: String,
      footer: String,
      cancelButton:{
        type: String,
        default: "Cancel"
      },
      okButton:{
        type: String,
        default: "Agree"
      },
      okButtonColor: {
        type: String,
        default: "border-blue-600 bg-blue-600 active:bg-blue-700"
      },
      iconName: String,
      alertColor: String,
      cancelButtonOnly: {
        type: Boolean,
        default: false
      },
      okButtonOnly: {
        type: Boolean,
        default: false
      },
    },
    unmounted(){
      this.callBackIfAgreed = null;
    },
    methods: {
        willOpenAlert(toOpen = true,callBack = null){
          this.isAlertOpened = toOpen;
          this.callBackIfAgreed = callBack;
        },
        willUserAgreed(isAgreed){
          this.isUserAgreed = isAgreed;
        }
    },
    watch:{
      isUserAgreed(isAgreed){
        if(isAgreed && this.callBackIfAgreed)this.callBackIfAgreed();
        this.isUserAgreed = false;
        return this.willOpenAlert(false);
      }
    }
};
</script>

<style scoped>
</style>