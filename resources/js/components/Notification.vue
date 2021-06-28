<template>
  <!-- component -->
  <!-- Toast Container -->
  <!-- put taost notification in here , to cope when the toast more than one -->
  <!-- class="" For put toast on top right -->
  <div  class="flex flex-col justify-center fixed left-0 bottom-0 m-5 w-60 z-30">.

    <!-- Toast Notification Success-->
    <transition-group tag="div" name="slide-left" >
      <section v-for="(notification, index) in notifications" :key="notification.id" class="border-l-4  pt-3 shadow-md mb-2 transition-all cursor-pointer transform hover:scale-105" @click="stopToast(index)" @mouseenter="pauseTimer(index)" @mouseleave="pauseTimer(index,false)" :class="[ 'bg-' + getNotifStatusColor(notification.status) + '-500', 'border-' + getNotifStatusColor(notification.status) + '-600' ]" >
      
      <div class="w-full">
        <section class="flex items-center  px-5">
          <!-- icons -->
          <div class="mr-3 ">

            <div class="w-12 h-12 flex rounded-lg bg-white text-4xl" :class="[ 'text-' + getNotifStatusColor(notification.status) + '-500' ]">
              <span v-if="notification.status === 'success'" class="table m-auto"><ion-icon name="checkmark-done-outline" v-pre></ion-icon></span>

              <span v-else-if="notification.status === 'warning'" class="table m-auto"><ion-icon name="alert-outline" v-pre></ion-icon></span>

              <span v-else-if="notification.status === 'danger'" class="table m-auto"><ion-icon name="bug-outline" v-pre></ion-icon></span>  

              <span v-else-if="notification.status === 'info'" class="table m-auto"><ion-icon name="information-outline" v-pre></ion-icon></span>   
            </div>
            
          </div>
          
          <!-- message -->
          <div class="text-white max-w-xs ">
            {{notification.message}}
          </div>
        </section>
        <section class="mt-3">
          <div class="pt-2 pl-1">
            <div class="h-1 rounded-full w-0" :style="{'animation-duration': notification.time + 'ms'}" :class="[notification.timerLineWidth, 'bg-' + getNotifStatusColor(notification.status) + '-800' ]" ></div>
          </div>
        </section>
      </div>
      </section>
    </transition-group>
  </div>
</template>

<script>
export default {
  name: "Notification",
  data() {
      return {
        notifications: []
      }
  },
  methods: {
    decrementTimer(index){
      if(!this.notifications[index])return;
      this.notifications[index].timerLineWidth = "decrement-width";
      const idToRemove = this.notifications[index].id;
      this.notifications[index].timeStart = Date.now();
      this.notifications[index].timer = setTimeout(() => this.stopToast(null,idToRemove) , this.notifications[index].time);
    },
    startToast(status, message, time = 5000){
      let newNotification = {
        'id' : this.availableId,
        'status' : status,
        'message' : message,
        'timerLineWidth' : "pause-animation", // timer width behavior class
        'timer' : null, //setTimeOut instance
        'time' : time,
        'timeStart' : 0 //flag when the notification timer start
      }
      this.notifications.push(newNotification) - 1;
      const newNotificationIndex = this.notifications.length - 1;
      this.decrementTimer(newNotificationIndex);
    },
    stopToast(index = null,id = null){
      if(index){
        //Stop toast notification by Click
        this.notifications.splice(index, 1);
        return;
      }
      //Stop toast notification by timer
      for(var i = 0; i < this.notifications.length; i ++){
        if(this.notifications[i].id === id)this.notifications.splice(i, 1);
      }
    },
    pauseTimer(index, toPause = true){
      if(toPause){
        clearTimeout(this.notifications[index].timer);
        this.notifications[index].timerLineWidth += " pause-animation";
        this.notifications[index].time -=  Date.now() - this.notifications[index].timeStart;
        return;
      }
      this.decrementTimer(index);
    },
    getNotifStatusColor(status){
      let notificationColor = "blue"
      switch (status) {
        case 'success':
          notificationColor = "green";
          break;

        case 'info':
          notificationColor = "blue";
          break;
        case 'warning':
          notificationColor = "yellow";
          break;
        case 'danger':
          notificationColor = "red";
          break;
        default:
          break;
      }
      return notificationColor;
    },
  },
  computed: {
    availableId(){
      return this.notifications.length + 1;
    }
  },
  watch : {
    notifications(){
      this.availableId++;
    },
  }
}
</script>

<style>
  .slide-left-enter-active,
  .slide-left-leave-active {
    transition: all 500ms ease;
  }

  .slide-left-enter-from,
  .slide-left-leave-to {
    opacity: 0;
    transform: translateX(-50%);
    
  }

  .decrement-width {
    animation-name: decrementWidth;
    transition: all linear;
  }

  .pause-animation {
    animation-play-state: paused;
  }

  @keyframes decrementWidth{
    from {width: 100%;}
    to {width: 0px;}
  }
</style>