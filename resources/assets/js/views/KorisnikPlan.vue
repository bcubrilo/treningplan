<template>
    <v-container
            fluid
            style="min-height: 0;"
            grid-list-lg
            id="korisnik-planovi"
    >
        <v-layout row wrap  v-if="planovi != null">

            <v-expansion-panel expand>
                <v-expansion-panel-content value="true">
                    <div   slot="header"><h5>Aktivni planovi</h5></div>
                    <v-container>
                        <v-layout row wrap>

                            <v-flex xs12 sm6 md4 v-for="plan in planovi">
                                <v-card color="purple darken-3" class="white--text" :to="{path:'/plan/'+plan.korisnik_plan.id }">
                                    <v-card-title>
                                        <span>{{ plan.trening_plan.naziv}}</span>
                                    </v-card-title>
                                    <v-card-text>
                                        <div>Broj sedmica : {{ plan.trening_plan.broj_sedmica}}</div>
                                        <div>Datum početka : {{ formatirajDatum(plan.korisnik_plan.datum)}}</div>
                                    </v-card-text>

                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-expansion-panel-content>
            </v-expansion-panel>
            <v-divider inset></v-divider>
            <v-expansion-panel expand>
                <v-expansion-panel-content :lazy="true" @click.native ="ucitajPlanove('O')">
                    <div color="purple darken-3" slot="header"><h5>Otkazani planovi</h5></div>
                    <v-container>
                        <v-layout row wrap>

                            <v-flex xs12 sm6 md4 v-for="plan in otkazaniPlanovi">
                                <v-card color="purple darken-3" class="white--text" :to="{path:'/plan/'+plan.korisnik_plan.id }">
                                    <v-card-title>
                                        <span>{{ plan.trening_plan.naziv}}</span>
                                    </v-card-title>
                                    <v-card-text>
                                        <div>Broj sedmica : {{ plan.trening_plan.broj_sedmica}}</div>
                                        <div>Datum početka : {{ plan.korisnik_plan.datum}}</div>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-expansion-panel-content>
            </v-expansion-panel>
            <v-divider inset></v-divider>
            <v-expansion-panel expand>
                <v-expansion-panel-content @click.native ="ucitajPlanove('Z')">
                    <div color="purple" slot="header"><h5>Završeni planovi</h5></div>
                    <v-container >
                        <v-layout row wrap>

                            <v-flex xs12 sm6 md4 v-for="plan in zavrseniPlanovi">
                                <v-card color="purple darken-3" class="white--text"  :to="{path:'/plan/'+plan.korisnik_plan.id }">
                                    <v-card-title>
                                        <span>{{ plan.trening_plan.naziv}}</span>
                                    </v-card-title>
                                    <v-card-text>
                                        <div>Broj sedmica : {{ plan.trening_plan.broj_sedmica}}</div>
                                        <div>Datum početka : {{ plan.korisnik_plan.datum}}</div>
                                    </v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-expansion-panel-content>
            </v-expansion-panel>

        </v-layout>

    </v-container>
</template>

<script>
    export default {
        name:'KorisnikPlan',
        data:()=>({
            planovi:null,
            otkazaniPlanovi: null,
            zavrseniPlanovi: null
        }),
        created(){
            this.ucitajPlanove();
        },
        methods:{
            ucitajPlanove:function (status = 'A') {
                if(status=='A' && this.planovi != null || status =='O' && this.otkazaniPlanovi != null
                    || status =='Z' && this.zavrseniPlanovi != null){
                    return;
                }

                axios.get(domenurl+'/korisnik/planovi/'+status)
                    .then((response)=>{
                        if(status =='A'){
                            this.planovi = response.data;
                        }else if(status == 'O'){
                            this.otkazaniPlanovi = response.data;
                        }else if(status == 'Z'){
                            this.zavrseniPlanovi = response.data;
                        }else{

                        }

                    });
            },
            formatirajDatum:function(datum){
                let tmp = datum.split('-');
                return tmp[2]+'.'+tmp[1]+'.'+tmp[0]+'.';
            }
        }
    }
</script>
<style>
    #korisnik-planovi .expansion-panel__header{
        background-color: #455a64!important;
    }
   #korisnik-planovi .expansion-panel__header,#korisnik-planovi .expansion-panel__header .header__icon .icon{
        color: white;
    }
</style>