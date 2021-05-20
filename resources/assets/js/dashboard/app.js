import '../bootstrap'

import router from './routes'

Vue.component('Full',require('./containers/Full.vue'));
Vue.component('TreningPlanTipView',require('./views/TreningPlanTipView.vue'));
Vue.component('TreningPlanView',require('./views/TreningPlanView.vue'));
Vue.component('TreningPlanTreningView',require('./views/TreningPlanTreningView.vue'));


const app = new Vue({
    el: '#dashboardApp',
    router
});

