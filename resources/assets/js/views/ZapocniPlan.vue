<template>
    <v-container>
        <v-layout row wrap>
            <v-flex xs10>
                <h6>Odaberite početni datum</h6>
            </v-flex>

            <v-flex xs10 sm5>
                <v-menu
                        lazy
                        :close-on-content-click="true"

                        transition="scale-transition"
                        offset-y
                        full-width
                        :nudge-right="40"
                        max-width="290px"
                        min-width="290px"
                >
                    <v-text-field
                            slot="activator"
                            label="Datum početka"
                            v-model="datumPocetkaFormatted"
                            prepend-icon="event"
                            readonly
                    ></v-text-field>
                    <v-date-picker v-model="datumPocetka"
                                   locale="sr-Latn-RS"
                                   :first-day-of-week="1"

                                   no-title scrollable>
                    </v-date-picker>
                </v-menu>
            </v-flex>
            <v-spacer></v-spacer>
            <v-flex xs10 sm5>

                <v-text-field
                        v-if="datumZavrsetkaFormatted"
                        slot="activator"
                        label="Datum završetka"
                        v-model="datumZavrsetkaFormatted"
                        prepend-icon="event"
                        readonly
                ></v-text-field>

                </v-menu>
            </v-flex>
            <v-flex xs10 v-if="datumPocetka!=null">
                <h6>* Trčite na vlastitu odgovornost!</h6>
            </v-flex>
            <v-flex xs12 md12  text-xs-center>
                <scCalendar v-if="datumPocetka!=null"
                            :originData="treninzi"
                            :year="kalendarGodina"
                            :month="kalendarMjesec"
                ></scCalendar>
            </v-flex>
            <v-dialog v-if="dialogTrening!=null" v-model="dialog" persistent>
                <v-card >
                    <v-card-title class="white--text purple darken-3">Informacije o treningu</v-card-title>
                    <v-card-text color="white">
                        {{ dialogTrening.opis}}
                        <template v-if="dialogTrening.broj_kilometara">
                            <p>Ukupno: {{ dialogTrening.broj_kilometara }} km.</p>
                        </template>
                    </v-card-text>
                    <v-card-actions class="white--text purple darken-3">

                        <v-btn class="white--text" flat @click.native="dialog = false">Zatvori</v-btn>

                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-flex xs12>
                <v-fab-transition>
                    <v-btn
                            v-if="datumPocetka!=null"
                            color="purple darken-3"
                            large
                            fab
                            fixed
                            bottom
                            center
                            v-model="fab"
                            @click="pocniPlan()"
                    >
                        <small style="color:white">Sačuvaj</small>

                    </v-btn>
                </v-fab-transition>

            </v-flex>

        </v-layout>
    </v-container>

</template>
<script>
   import scCalendar from '../components/scheduleCalendar/scCalendar.vue'
   import { EventBus } from '../components/scheduleCalendar/utils.js';
    export  default {
        components: {
            scCalendar
            },
        props:['planId'],
        name: 'ZapocniPlan',
        data:()=>({
            plan: null,
            datumPocetka:null,
            datumZavrsetka:null,
            datumPocetkaLocal:null,
            datumZavrsetkaLocal:null,
            date: null,
            menu: false,
            modal: false,

            treninzi:[
                {
                    id: 111,
                    date: '2017-11-27',
                    text: 'Neki podaci'
                }
            ],
            kalendar:{
                godina:null,
                mjesec:null
            },
            dialogTrening:null,
            dialog:false,
            fab:false
        }),
        watch:{
            datumPocetka: function (noviDatum) {
                if(noviDatum){
                    this.datumZavrsetka = null;
                    if(noviDatum != null && this.plan != null){
                        let datum = new Date(noviDatum);
                        this.kalendar.godina=datum.getFullYear();
                        this.kalendar.mjesec= datum.getMonth();

                        datum.setDate(datum.getDate() + this.plan.broj_sedmica * 7);
                        datum.toISOString().substr(0, 10)
                        this.datumZavrsetka = datum.toISOString().substr(0, 10);

                        this.rasporediTreninge();
                    }
                }
            },
            datumZavrsetka:function (noviDatum) {
//                if(noviDatum != null && this.plan != null){
//                    this.datumPocetka = null;
//                    let datum = new Date(noviDatum);
//                    datum.setDate(datum.getDate() - this.plan.broj_sedmica * 7);
//                    this.datumPocetka = datum.toISOString().substr(0, 10);
//                }
            }
        },
        computed:{
          datumPocetkaFormatted: function () {
              if(this.datumPocetka!=null) {
                  let datum = new Date(this.datumPocetka);
                  return datum.toLocaleDateString('sr-rs');
              }
          },
        datumZavrsetkaFormatted: function () {
            if(this.datumZavrsetka!=null) {
                let datum = new Date(this.datumZavrsetka);
                return datum.toLocaleDateString('sr-rs');
            }
        },
         kalendarGodina:function() {
             if (this.datumPocetka != null) {
                 let datum = new Date(this.datumPocetka);
                 return datum.getFullYear();
             }
         },
            kalendarMjesec:function(){
              if(this.datumPocetka!=null){
                  let datum = new Date(this.datumPocetka);
                  return datum.getMonth();
              }
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
                axios(domenurl+'/dashboard/trening-plan/view/'+this.planId)
                    .then((response) => {
                        this.plan = response.data[0];

                    });
            },
            datumFormat: function(d,standard=false){
                let datum = new Date(d);
                if(standard==true){
                    return(
                        datum.getFullYear()+'-'+((datum.getMonth()+1 < 10 ? '0'+(datum.getMonth()+1): (datum.getMonth()+1)))
                            +'-'+((datum.getDate() < 10 ? '0'+(datum.getDate()) : datum.getDate()))
                    );
                }else {
                    return (
                        (datum.getDate() < 10 ? '0' + datum.getDate() : datum.getDate()) + '.'
                        + (datum.getMonth() + 1 < 10 ? ('0' + (datum.getMonth() + 1)) : datum.getMonth() + 1) + '.'
                        + datum.getFullYear() + '.');
                }
            },
            rasporediTreninge:function () {

                this.treninzi = [];
                if(this.datumPocetka!=null){

                    for(let i =0;i<this.plan.treninzi.length;i++){
                        if(this.plan.treninzi[i].tip =='Odmor')
                        {
                            continue;
                        }
                        let datum = new Date(this.datumPocetka);
                        let brojDana = (this.plan.treninzi[i].sedmica - 1)*7 + (this.plan.treninzi[i].dan -1);

                        datum.setDate(datum.getDate()+brojDana);

                        let trening={
                            id:this.plan.treninzi[i].id,
                            date:this.datumFormat(datum,true),
                            text:this.plan.treninzi[i].opis
                        }
                        this.treninzi.push(trening);
                    }
                }
            },
            prikaziDetaljeTreninga:function(id){

                let trening = this.plan.treninzi.filter(function (trening) {
                    return trening.id == id;
                });
                if(trening){
                    this.dialogTrening=trening[0];
                    this.dialog=!this.dialog;
                }
            },
            pocniPlan:function(){
                axios.post(domenurl+'/korisnik/kreiraj-plan',{
                    plan_id:this.plan.id,
                    datum: this.datumPocetka
                }).then((response)=>{
                    if(response.status == 200) {
                        router.push({path: '/planovi'});
                    }
                });
            }
        }

    }
</script>