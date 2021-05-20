import VueDashboardRouter from 'vue-router'

let routes = [

    {
        path:'/plan-tip',
        component: require('./views/TreningPlanTipView.vue')
    },
    {
        path:'/planovi',
        component: require('./views/TreningPlanView.vue')
    },
    {
        path:'/trening-plan-trening/:treningPlanId',
        component: require('./views/TreningPlanTreningView.vue'),
        props: true
    },
    {
        path:'/korisnici',
        component: require('./views/Korisnici.vue')
    }

]

export default new VueDashboardRouter({
    routes
})