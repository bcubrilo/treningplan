import VueDashboardRouter from 'vue-router'

let routes = [

    {
        path: '/', redirect: { path:'/pocetna' }
    },

    {
        path:'/pocetna',
        component: require('./views/Home.vue')
    },
    {
        path:'/pregled-planova/:tipId',
        component:require('./views/TreningPlanLista.vue'),
        props:true
    },
    {
        path:'/plan-detalji/:planId',
        component:require('./views/TreningPlanDetalji.vue'),
        props:true
    },
    {
        path:'/zapocni-plan/:planId',
        component:require('./views/ZapocniPlan.vue'),
        props:true
    },
    {
        path:'/planovi',
        component:require('./views/KorisnikPlan.vue'),
    },
    {
        path:'/plan/:planId',
        component:require('./views/Plan.vue'),
        props:true
    }
]

export default new VueDashboardRouter({
    routes
})