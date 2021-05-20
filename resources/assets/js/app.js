import './bootstrap'

import router from './routes'

Vue.component('Full',require('./containers/Full.vue'));
Vue.component('HomeView',require('./views/Home.vue'));


const app = new Vue({
    el: '#app',
    router
});

