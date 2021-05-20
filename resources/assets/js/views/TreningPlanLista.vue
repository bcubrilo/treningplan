<template>
<v-container>
    <v-layout row wrap>
        <v-flex xs12 sm12 md12>
            <v-card style="margin-bottom: 20px;">
                <v-card-title v-if="tip!=null">
                    <div slot="header"><h5>{{ tip.naziv }}</h5></div>
                </v-card-title>
            </v-card>
        </v-flex>
    </v-layout>
    <v-layout row wrap>
        <v-flex xs12 >
            <v-expansion-panel expand>
                <v-expansion-panel-content v-for="(item,i) in sortiraniPlanovi" :key="i" :value="i ==0 ? true : false">
                    <div slot="header"><h5>{{ item.nivo_naziv }} Nivo</h5></div>
                    <v-container>
                        <v-layout row wrap>
                            <v-flex xs12 sm6 md4  v-for="plan in item.planovi">
                                <v-card color="blue-grey darken-2"

                                        class="white--text"
                                        append
                                        style="margin: 20px;"
                                        :to="{ path : '/plan-detalji/' + plan.id}"
                                >
                                    <v-card-title primary-title >
                                        <p>{{plan.naziv}}</p>

                                    </v-card-title>
                                    <v-card-text>
                                        {{plan.broj_sedmica}} sedmica
                                    </v-card-text>

                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>

                </v-expansion-panel-content>
            </v-expansion-panel>



        </v-flex>


    </v-layout>
</v-container>


</template>
<script>

    export  default {

        props:['tipId'],
        name:'TreningPlanLista',

        data:()=>({
            planovi:null,
            tip: '',
            nivoi:[
                {id:'pocetni',naziv:'Početni'},
                {id:'srednji',naziv:'Srednji'},
                {id:'napredni',naziv:'Napredni'},
            ],

            sortiraniPlanovi:[

            ]
        }),
        created(){
            this.ucitajPlanove();
        },
        methods:{
            ucitajPlanove:function () {
                axios(domenurl+'/dashboard/trening-plan/filter-tip/'+this.tipId)
                    .then((response)=>{
                        this.planovi = response.data;
                        for(let i=0;i<this.nivoi.length;i++){

                            let item={
                                nivo_naziv:'',
                                planovi:[]
                            };
                            let nivo = this.nivoi[i].id;
                            item.nivo_naziv = this.nivoi[i].naziv;
                            let filtrirani = this.planovi.filter(function (plan) {
                                return plan.nivo==nivo;
                            });
                            item.planovi=filtrirani;
                            this.sortiraniPlanovi.push(item);
                        }
                    });
                axios(domenurl+'/dashboard/plan-tip/view/'+this.tipId)
                    .then((response)=>{
                        this.tip = response.data;

                    });
            }
        }
    }
</script>