import { createApp } from 'vue'

import AlertModal from './components/AlertModal.vue'
import TableData from './components/TableData.vue'

createApp({})
  .component('alert-modal',AlertModal)
  .component('table-data',TableData)
  .mount('#app')