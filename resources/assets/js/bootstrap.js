import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'

import router from './routes.js'
window.Vue = Vue

Vue.use(VueRouter)
Vue.use(Vuetify)
window.axios = require('axios')
// window.domenurl = 'https://www.treningplan.trcizdravo.com';
window.domenurl = 'http://localhost/treningplan/public';//
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
    'X-Requested-With': 'XMLHttpRequest'
}


window.EventManager = new Vue();
window.router = router