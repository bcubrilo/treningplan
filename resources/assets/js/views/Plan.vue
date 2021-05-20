<template>
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12 text-xs-center>
                <v-list three-line subheader>

                    <v-list-tile avatar v-if="plan!=null">
                        <v-list-tile-content>
                            <v-list-tile-title >{{plan.trening_plan.naziv}}</v-list-tile-title>
                            <v-list-tile-sub-title>Plan je započet: {{ formatirajDatum(plan.korisnik_plan.datum)  }}</v-list-tile-sub-title>
                            <v-list-tile-sub-title>Ukupno pretrčano: {{ ukupnoIstrcanihKm }} km</v-list-tile-sub-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-flex>
            <v-flex xs12 md12 text-xs-center>
                <scCalendar v-if="calendarData!=null"
                            :originData="calendarData"
                            :year="calendarYear"
                            :month="calendarMonth"
                ></scCalendar>
            </v-flex>

            <v-dialog v-model="dialog" fullscreen
                      color="purple darken-3"
                      transition="dialog-bottom-transition" :overlay=false>
                <v-card v-if="odabraniTrening!=null">
                    <v-toolbar dark color="purple darken-3" >
                        <v-btn icon @click.native="dialog = false" dark>
                            <v-icon>close</v-icon>
                        </v-btn>
                        <v-toolbar-title>Podaci o treningu</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-toolbar-items>
                            <v-btn dark flat @click.native="sacuvaj()">Sačuvaj</v-btn>
                        </v-toolbar-items>
                    </v-toolbar>
                    <v-list three-line subheader>

                        <v-list-tile avatar>
                            <v-list-tile-content>
                                <v-list-tile-title >Datum: {{ odabraniTrening.trening.datum }}</v-list-tile-title>
                                <v-list-tile-sub-title v-if="odabraniTrening.plan_trening.broj_kilometara!=null">Ukupno : {{ odabraniTrening.plan_trening.broj_kilometara }} km</v-list-tile-sub-title>
                                <v-list-tile-sub-title>{{ odabraniTrening.plan_trening.opis }}</v-list-tile-sub-title>

                                </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar>
                            <v-list-tile-content>
                                <v-list-tile-sub-title>{{ sacuvajTreningGreska}}</v-list-tile-sub-title>
                                <v-spacer> </v-spacer>
                            </v-list-tile-content>
                        </v-list-tile>

                    </v-list>

                    <v-divider></v-divider>

                    <v-list three-line subheader>
                        <v-subheader></v-subheader>
                        <v-list-tile avatar>
                            <v-list-tile-content>
                                <v-select v-bind:items="[{ text: 'Završen',value:'z' },{text:'Preskočen',value:'p'}]"
                                          v-model="odabraniTrening.trening.status"
                                          label="Označite trening kao završen ili preskočen"
                                          class="input-group--focused"
                                          multiline
                                ></v-select>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar>

                            <v-list-tile-content>
                                <v-text-field
                                        v-if="odabraniTrening.trening.status == 'z'"
                                        v-model="odabraniTrening.trening.broj_km"
                                          label="Pretrčana dužina (km)"
                                          class="input-group--focused"
                                            :rules="duzinaRules"
                                ></v-text-field>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile avatar>

                            <v-list-tile-content>
                                <v-text-field
                                        v-if="odabraniTrening.trening.status == 'z'"
                                        v-model="odabraniTrening.trening.opis"
                                        label="Vaš komentar"

                                        class="input-group--focused "
                                        multi-line
                                ></v-text-field>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </v-card>
            </v-dialog>

            <v-dialog
                    color="purple darken-3"
                    v-model="datumPocetkaDailog" persistent max-width="350px">
                <v-card>
                    <v-card-title>
                        <span class="headline">Promijeni datum početka plana</span>
                    </v-card-title>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                {{promjenaDatumGreska}}
                            </v-flex>
                            <v-flex xs12>
                                <v-date-picker v-model="noviDatumPocetka"
                                               locale="sr-Latn-RS"
                                               :first-day-of-week="1"
                                ></v-date-picker>
                            </v-flex>
                         </v-layout>
                    </v-container>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn  flat @click.native="promijeniDatumPocetka()">Promijeni</v-btn>
                        <v-btn  flat @click.native="datumPocetkaDailog = false">Otkaži</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-card id="opcije">
                <v-speed-dial
                        v-model="fab"
                        :top=false
                        :bottom=true
                        :right=true
                        :left=false
                        direction="top"
                        :hover=false
                        transition="slide-y-reverse-transition"
                >
                    <v-btn
                            slot="activator"
                            color="purple darken-3"
                            dark
                            fab
                            hover
                            v-model="fab"
                    >
                        <v-icon>build</v-icon>
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-btn
                            fab
                            dark
                            small
                            color="green"
                            @click="datumPocetkaDailog = true"
                    >
                        <v-icon>edit</v-icon>
                    </v-btn>

                    <v-btn
                            fab
                            dark
                            small
                            color="red"
                            @click="napustiPlan()"
                    >
                        <v-icon>cancel</v-icon>
                    </v-btn>
                </v-speed-dial>
            </v-card>

        </v-layout>

    </v-container>
</template>
<script>
    import scCalendar from '../components/scheduleCalendar/scCalendar.vue'
    import { EventBus } from '../components/scheduleCalendar/utils.js';
    export  default {
        props:['planId'],
        name:'Plan',
        components: {
            scCalendar
        },
        data:()=>({
            plan:null,
            calendarData: [],
            calendarYear: new Date().getFullYear(),
            calendarMonth: new Date().getMonth(),
            odabraniTrening:{
                trening:'',
                plan_trening:'',
                broj_kilometara:'',
                zavrsen:false
            },
            dialog : false,
            duzinaRules:[

            ],
            sacuvajTreningGreska:'',
            datumPocetkaDailog:false,
            noviDatumPocetka:new Date().toISOString().slice(0,10),
            promjenaDatumGreska: '',
            fab: false
        }),
        computed:{
            ukupnoIstrcanihKm: function () {
                let duzina = 0;
                if(this.plan!=null){

                    for(let i=0;i<this.plan.trening.treninzi.length;i++){

                        let trening = this.plan.trening.treninzi[i];

                        if(trening.status=='z'){
                            duzina+=trening.broj_km != null ? parseFloat(trening.broj_km) : 0;
                        }
                    }
                }
                return duzina;
            }
        },
        created(){
            this.ucitajPlan();
            EventBus.$on('sc-calendar-clicked-id', id => {
                this.prikaziDetaljeTreninga(id);
            });
        },
        methods:{
            ucitajPlan:function(){
                axios.get(domenurl+'/korisnik/plan/'+this.planId)
                    .then((response)=>{
                        this.plan = response.data[0];
                        this.popuniTreninge();
                    });
            },
            popuniTreninge:function(){
                this.calendarData = [];
                if(this.plan!=null){
                    for(let i = 0;i < this.plan.trening.treninzi.length;i++){
                        let trening = this.plan.trening.treninzi[i];

                        if(trening){
                            let treningPlanTrening = this.plan.trening.plan_treninzi.filter(function (t) {
                                return t.id == trening.trening_plan_trening_id;
                            });
                            if(treningPlanTrening[0].tip=='Odmor'){
                                continue;
                            }
                            let tmp ={
                                id: trening.id,
                                date: trening.datum,
                                text:treningPlanTrening[0].opis
                            }
                            this.calendarData.push(tmp);
                        }
                    }

                }
            },
            prikaziDetaljeTreninga:function (id) {
                if(id){
                    let trening = this.plan.trening.treninzi.filter(function (t) {
                        return t.id == id;
                    });
                    trening = trening[0];
                    let treningPlanTrening = null;
                    if(trening){
                        treningPlanTrening = this.plan.trening.plan_treninzi.filter(function (t) {
                            return t.id == trening.trening_plan_trening_id;
                        });
                       this.odabraniTrening.trening = trening;
                       this.odabraniTrening.plan_trening = treningPlanTrening[0];
                    }

                    this.dialog = true;
                }
            },
            sacuvaj:function(){
                this.duzinaRules = [];

                if(this.odabraniTrening.trening.broj_km!=null
                    && isNaN(this.odabraniTrening.trening.broj_km)){
                    this.duzinaRules = [
                        (v) =>  'Unešena vrijednost nije validna!',
                    ];
                    return;
                }

                axios.post(domenurl+'/korisnik/plan/sacuvaj-trening',{
                    plan_id: this.plan.korisnik_plan.id,
                    trening_id: this.odabraniTrening.trening.id,
                    broj_km: this.odabraniTrening.trening.broj_km,
                    opis: this.odabraniTrening.trening.opis,
                    status: this.odabraniTrening.trening.status
                }).then((response)=>{
                   if(response.status==200){
                       this.dialog = false;
                       this.sacuvajTreningGreska = '';
                       let index = this.plan.trening.treninzi.findIndex((obj => obj.id == this.odabraniTrening.trening.id));
                       this.plan.trening.treninzi[index].broj_km = this.odabraniTrening.trening.broj_km;
                       this.plan.trening.treninzi[index].status = this.odabraniTrening.trening.status;
                       this.plan.trening.treninzi[index].opis = this.odabraniTrening.trening.opis;


                   }else{
                       this.sacuvajTreningGreska = response.data;
                   }
                })
                    .catch(function (error) {
                        this.sacuvajTreningGreska = error;
                    });
                ;
            },
            promijeniDatumPocetka:function () {

                axios.post(domenurl+'/korisnik/plan/promijeni-datum-pocetka',{
                    plan_id: this.plan.korisnik_plan.id,
                    novi_datum: this.noviDatumPocetka
                })
                .then((response)=>{

                    if(response.status == 200){
                        this.datumPocetkaDailog = false;
                        this.promjenaDatumGreska = '';
                        this.ucitajPlan();
                    }else{
                        this.promjenaDatumGreska = response.data;
                    }

                });
            },
            napustiPlan:function () {
                let r = confirm('Da li zaista želite da napustite ovaj plan?');
                if(r){
                    axios.get(domenurl+'/korisnik/plan/otkazi-plan/'+this.plan.korisnik_plan.id)
                        .then((response)=>{
                            router.push({path:'/planovi'});
                        });
                }
            },
            formatirajDatum:function(datum){
                let tmp = datum.split('-');
                return tmp[2]+'.'+tmp[1]+'.'+tmp[0]+'.';
            }
        }
    }
</script>
<style>
    /* This is for documentation purposes and will not be needed in your application */
    #opcije .speed-dial {
        position: absolute;
    }

     #opcije .btn--floating {
        position: relative;
    }
</style>