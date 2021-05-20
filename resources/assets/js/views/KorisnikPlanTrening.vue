<template>
        <v-layout justify-center class="korisnik-trening-detalji ">
            <v-flex xs12 text-xs-center v-if="treningInfo">

                <v-card>
                    <template>
                        <v-layout row>
                            <v-flex xs5 md3>
                                <v-card tile flat color="purple" >
                                    <v-card-text class="white--text">Datum</v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs7>
                                <v-card tile flat>
                                    <v-card-text class="text-sm-left text-xs-left text-md-left text-lg-left">{{treningInfo.trening.datum}}</v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                        <v-divider></v-divider>
                    </template>
                    <template>
                        <v-layout row v-if="treningInfo.trening.trening_plan_trening.ukupno > 0">
                            <v-flex xs5 md3>
                                <v-card tile flat color="purple">
                                    <v-card-text class="white--text">Ukupno : </v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs9>
                                <v-card tile flat>
                                    <v-card-text>{{treningInfo.trening.trening_plan_trening.ukupno}}</v-card-text>
                                </v-card>
                            </v-flex>
                        </v-layout>
                        <v-divider></v-divider>
                    </template>
                    <template>
                        <v-layout row >
                            <v-flex xs5 md3>
                                <v-card tile flat color="purple" fill-height height="100%">
                                    <v-card-text class="white--text">Trening </v-card-text>

                                </v-card>

                            </v-flex>
                            <v-flex xs7>
                                <v-card tile flat>
                                    <v-card-text class="text-sm-left text-xs-left text-md-left text-lg-left">{{treningInfo.trening.trening_plan_trening.opis}}</v-card-text>
                                </v-card>
                            </v-flex>

                        </v-layout>
                        <v-divider></v-divider>
                    </template>
                    <template>
                        <v-layout row >
                            <v-flex xs5 md3>
                                <v-card tile flat color="purple" fill-height height="100%">
                                    <v-card-text class="white--text">Status </v-card-text>
                                </v-card>

                            </v-flex>
                            <v-flex xs7>
                                <v-list style="padding: 0;">
                                    <v-list-tile avatar>
                                        <v-list-tile-content>
                                            <v-select v-bind:items="[{ text: 'Završen',value:'z' },{text:'Preskočen',value:'p'}]"
                                                      v-model="treningInfo.trening.status"
                                                      class="input-group--focused"
                                                      multiline
                                                      @change="modelChanged()"
                                            ></v-select>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-flex>
                        </v-layout>
                        <v-divider></v-divider>
                    </template>
                    <template>
                        <v-layout row v-if="treningInfo.trening.status == 'z'">
                            <v-flex xs5 md3>
                                <v-card color="purple" height="100%">
                                    <v-card-text class="white--text">km</v-card-text>
                                </v-card>
                            </v-flex>
                            <v-flex xs7>
                                <div style="padding: 0 15px 0 15px;">
                                    <v-text-field
                                            v-model="treningInfo.trening.broj_km"
                                            class="input-group--focused"
                                            :rules="duzinaRules"
                                            @keydown.native="modelChanged()"
                                    ></v-text-field>
                                </div>
                            </v-flex>
                        </v-layout>
                        <v-divider></v-divider>
                    </template>

                    <v-layout row v-if="treningInfo.trening.status=='z'">
                        <v-flex xs5 md3>
                            <v-card color="purple" height="100%">
                                <v-card-text >
                                    <v-card-text class="white--text">Vaš komentar</v-card-text>
                                </v-card-text>
                            </v-card>

                        </v-flex>
                        <v-flex xs7>
                            <div style="padding: 0 15px 0 15px;">
                                <v-text-field
                                        v-model="treningInfo.trening.opis"
                                        class="input-group--focused  text-left"
                                        multi-line
                                        @keydown.native="modelChanged()"
                                ></v-text-field>
                            </div>
                        </v-flex>
                    </v-layout>
                </v-card>
                <v-btn color="purple" class="white--text" @click="sacuvaj()"><span v-if="!treningSacuvan">Sačuvaj</span>
                    <v-scroll-x-transition>
                        <v-icon
                                v-if="treningSacuvan"
                                color="white"
                        >
                            check
                        </v-icon>
                    </v-scroll-x-transition>
                </v-btn>

            </v-flex>
        </v-layout>
</template>

<script>
    export default{
        props:['planId','treningId'],
        name: 'KorisnikPlanTrening',

        data: ()=>({
            treningInfo:null,
            duzinaRules:[],
            sacuvajTreningGreska:'',
            dugmeSacuvajAktivno:true,
            treningSacuvan:false

        }),
        created(){
           this.ucitajTrening();
        },
        methods:{
            ucitajTrening:function(){
                axios(domenurl+'/korisnik/plan/trening/'+this.planId + "/" + this.treningId)
                    .then((response) => {
                        this.treningInfo = response.data[0];
                        console.log(this.treningInfo);
                });
            },
            sacuvaj:function(){
                if(!this.dugmeSacuvajAktivno)return;
                this.dugmeSacuvajAktivno = false;
                this.duzinaRules = [];

                if(this.treningInfo.trening.broj_km!=null
                    && isNaN(this.treningInfo.trening.broj_km)){
                    this.duzinaRules = [
                        (v) =>  'Unešena vrijednost nije validna!',
                ];
                    return;
                }

                axios.post(domenurl+'/korisnik/plan/sacuvaj-trening',{
                    plan_id: this.treningInfo.korisnik_plan.id,
                    trening_id: this.treningInfo.trening.id,
                    broj_km: this.treningInfo.trening.broj_km,
                    opis: this.treningInfo.trening.opis,
                    status: this.treningInfo.trening.status
                }).then((response)=>{
                    if(response.status==200){
                    this.sacuvajTreningGreska = '';
                    this.treningSacuvan = true;

                }else{
                    this.sacuvajTreningGreska = response.data;
                }
                this.dugmeSacuvajAktivno = true;
            })
            .catch(function (error) {
                    this.sacuvajTreningGreska = error;
                    this.dugmeSacuvajAktivno = true;
                })

            },
            modelChanged:function(){
                if(this.treningSacuvan){
                    this.treningSacuvan = false;
                }
            }
        },

    }
</script>