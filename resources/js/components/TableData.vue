<template>
  <main>
    <div class="flex space-x-2">
        <section class="overflow-x-auto w-auto">
          <div class="p-2 align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th v-for="(attribute,index) in attributes" :key="index" scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{attribute}}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      actions
                    </th>
                  </tr>
                </thead>
                <transition-group tag="tbody" name="slide-up" class="bg-white divide-y divide-gray-200">
                  <tr v-for="(row, index) in rows" :key="row.id" class="whitespace-nowrap hover:bg-gray-100" >
                    <td v-for="(attribute,index) in attributes" :key="index" class="p-4"> 
                      <h6 class="text-sm text-gray-800">
                        {{ formatRow(row[attribute],attribute) }}
                      </h6> 
                    </td>    
                    <td class="p-4">
                      <section class="flex flex-col space-y-1 lg:flex-row lg:space-y-0 lg:space-x-1">
                        <!-- View -->
                        <div class="bg-blue-500 hover:bg-blue-600 active:bg-blue-500 text-white hover:shadow-sm transition-all rounded-lg cursor-pointer h-8 w-8 flex opacity-80" @click="deleteEvent('warning')">
                          <ion-icon class="table m-auto" name="eye" v-pre></ion-icon>
                        </div>
                        <!-- Edit -->
                        <div class="bg-green-500 hover:bg-green-600 active:bg-green-500 text-white hover:shadow-sm transition-all rounded-lg cursor-pointer h-8 w-8 flex opacity-80" @click="deleteEvent('success')">
                          <ion-icon class="table m-auto" name="create" v-pre></ion-icon>
                        </div>
                        <!-- Delete -->
                        <div class="bg-red-500 hover:bg-red-600 active:bg-red-500 text-white hover:shadow-sm transition-all rounded-lg cursor-pointer h-8 w-8 flex opacity-80" @click="warnDelete(row.id,row.title,index)">
                          <ion-icon class="table m-auto" name="trash" v-pre></ion-icon>
                        </div>
                      </section>
                    </td>  
                  </tr>
                </transition-group>
              </table>
            </div>
          </div>
        </section>

        <!-- Side Pop Up -->
        <section class="bg-green-100 w-3/4 table">
            test
        </section>
    </div>
    
</main>
<alert-modal :title="warnDeleteData.title"
            :body="warnDeleteData.body"  :okButton="warnDeleteData.okButton" ref="warnDelete" :iconName="warnDeleteData.iconName" :alertColor="warnDeleteData.alertColor" :okButtonColor="warnDeleteData.okButtonColor"></alert-modal>

<notification ref="toastNotification"></notification>
</template>

<script>
import AlertModal from './AlertModal.vue';
import Notification from './Notification.vue';
import axios from 'axios';
const axiosVerified = axios.create({
  baseURL: 'http://127.0.0.1:8000',
  headers: { 'X-CSRF-TOKEN': document.getElementsByTagName('meta')["csrf-token"].getAttribute('content')}
});

export default {
  name: "Table",
  components: {
    'alert-modal' : AlertModal,
    'notification' : Notification
  },
  data() {
    return {
      warnDeleteData:{
          'title' : 'Are you sure you want to delete this item.',
          'body' : 'This is a permanent action',
          'okButton' : 'Delete',
          'iconName' : 'warning',
          'alertColor': 'bg-red-500',
          'okButtonColor' : 'border-red-500 bg-red-500 active:bg-red-600'
        },
        rows: Array(),
    }
  },
  methods:{
    formatRow(row,column){
      const dateColumns = ['updated_at','created_at'];
      var isDate = dateColumns.includes(column) && row !== null;
      if(isDate){
        let date = new Date(row);
        return new Intl.DateTimeFormat('en-US', { dateStyle: 'full', timeStyle: 'long' }).format(date);
      }
      return row;
    },
    deleteEvent(type){
      this.$refs.toastNotification.startToast(type,"testttt tetetet ge ge gege");
    },
    warnDelete(toDeleteItemId,toDeleteItemName, toDeleteIndex){
      if(toDeleteItemName)this.warnDeleteData.title = "Are you sure you want to delete: " + toDeleteItemName;
      const deleteAction = () => {
        axiosVerified.delete('/posts/' + toDeleteItemId)
          .then((response) => {
            // handle success
            var status = response.data.status;
            var message = response.data.message;
            this.$refs.toastNotification.startToast(status,message);
            this.rows.splice(toDeleteIndex, 1);
          })
          .catch(function (error) {
            // handle error
            console.log(error);
          });
      };
      this.$refs.warnDelete.willOpenAlert(true,deleteAction);
    }
  },
  props: {
    datas: Object,
    attributes: Object,
  },
  mounted(){
    this.rows = this.datas;
  }
}
</script>

<style>

</style>