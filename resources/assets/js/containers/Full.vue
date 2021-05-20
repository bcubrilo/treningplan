<template>
    <v-app id="inspire">

        <v-navigation-drawer
                persistent
                temporary
                clipped
                app
                dark
                style="z-index:100"
                v-model="drawer"
        >
            <v-list dense>
                <template v-for="(item, i) in items">

                    <v-list-tile @click="" router :to="{path: item.link}">
                        <v-list-tile-action href>

                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ item.text}}

                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar
                color="purple darken-3"
                dark
                app
                clipped-left
                fixed
        >
            <v-toolbar-title style="width: 300px" class="ml-0 pl-3"
            >
                <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
                Trening Plan
            </v-toolbar-title>

            <v-spacer></v-spacer>
            <v-btn icon @click="dialogPodesavanja = true">
                <i class="material-icons">account_circle</i>
            </v-btn>
            <v-btn icon @click="logout()">
                <i class="material-icons">exit_to_app</i>
                <form id="logout-form" :action="logoutLink" method="POST" style="display: none;">
                    <input type="hidden" name="_token" v-model="token">
                </form>
            </v-btn>
        </v-toolbar>
        <main>
            <v-content>
                <v-container fluid>
                    <router-view></router-view>
                </v-container>
            </v-content>
        </main>

        <v-dialog v-model="dialogPodesavanja" class="purple darken-3"  fullscreen transition="dialog-bottom-transition" :overlay=false>
            <v-card>
                <v-toolbar dark color="purple darken-3">
                    <v-btn icon @click.native="dialogPodesavanja = false" dark>
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Podešavanja</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn dark flat @click.native="azurirajProfil()">Sačuvaj</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-container>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-text-field
                                    box
                                    label="Email"
                                    :rules="emailRules"
                                    v-model="korisnik.email"
                                    hint=""
                                    persistent-hint
                                    readonly
                                    style="padding-bottom: 20px;"
                            ></v-text-field>

                        </v-flex>
                        <v-flex xs6>
                            <v-text-field
                                    box
                                    label="Kod za verifikaciju broja telefona"

                                    v-model="korisnik.brojTelefonaKod"
                                    hint=""
                                    persistent-hint
                                    style="padding-bottom: 20px;"
                                    v-if="posaljiKodZaVerifikacijuTelefona"
                            ></v-text-field>
                            <v-btn v-if="posaljiKodZaVerifikacijuTelefona && korisnik.brojTelefonaKod.length==0"
                                @click="posaljiKodZaVerifikaciju()"
                            >Posalji kod za verifikaciju broja telefona</v-btn>
                        </v-flex>
                        <v-flex xs12>
                            <v-list>
                                <v-list-tile>
                                    <v-list-tile-action>
                                        <v-switch v-model="korisnik.posaljiObavjestenje" color="purple"></v-switch>
                                    </v-list-tile-action>
                                    <v-list-tile-title>Obavijesti me mejlom da imam trening </v-list-tile-title>
                                </v-list-tile>
                            </v-list>
                            <v-select
                                    label="Vrijeme slanja obavještenja (h)"
                                    v-bind:items="sati"
                                    v-if="korisnik.posaljiObavjestenje"
                                    style="max-width: 300px;"
                                    v-model="korisnik.satObavjestenja"
                            ></v-select>

                            <v-divider></v-divider>

                            <v-expansion-panel>
                                <v-expansion-panel-content>
                                    <div slot="header">Promijeni lozinku</div>
                                    <v-card>
                                        <v-card-title :class="korisnik.lozinka.error ? 'red--text' : 'green--text'">{{ korisnik.lozinka.poruka}}</v-card-title>
                                    <v-container>
                                        <v-layout>
                                            <v-flex xs12>
                                                <v-form v-model="korisnik.lozinka.form_valid" ref="lozinka_form" lazy-validation>

                                                    <v-text-field
                                                                  box
                                                                  label="Stara lozinka"
                                                                  :rules="passwordRules"
                                                                  v-model="korisnik.lozinka.trenutnaLozinka"
                                                                  hint=""
                                                                  persistent-hint
                                                                  style="padding-bottom: 20px;"
                                                                  required
                                                                  min="6"
                                                                  :append-icon="korisnik.lozinka.e1 ? 'visibility' : 'visibility_off'"
                                                                  :append-icon-cb="() => (korisnik.lozinka.e1 = !korisnik.lozinka.e1)"
                                                                  :type="korisnik.lozinka.e1 ? 'password' : 'text'"
                                                    ></v-text-field>

                                                    <v-text-field
                                                            box
                                                            label="Nova lozinka"
                                                            :rules="passwordRules"
                                                            v-model="korisnik.lozinka.novaLozinka"
                                                            hint=""
                                                            persistent-hint
                                                            style="padding-bottom: 20px;"
                                                            :append-icon="korisnik.lozinka.e2 ? 'visibility' : 'visibility_off'"
                                                            :append-icon-cb="() => (korisnik.lozinka.e2 = !korisnik.lozinka.e2)"
                                                            :type="korisnik.lozinka.e2 ? 'password' : 'text'"
                                                            required
                                                    ></v-text-field>
                                                    <v-text-field
                                                            box
                                                            label="Potvrdi lozinku"
                                                            :rules="passwordRules"
                                                            v-model="korisnik.lozinka.novaLozinkaPotvrda"
                                                            hint=""
                                                            persistent-hint
                                                            :append-icon="korisnik.lozinka.e3 ? 'visibility' : 'visibility_off'"
                                                            :append-icon-cb="() => (korisnik.lozinka.e3 = !korisnik.lozinka.e3)"
                                                            :type="korisnik.lozinka.e3 ? 'password' : 'text'"
                                                            style="padding-bottom: 20px;"
                                                            required
                                                    ></v-text-field>
                                                </v-form>
                                            </v-flex>


                                        </v-layout>
                                    </v-container>
                                        <v-card-actions>
                                            <v-btn color="purple darken-3" text-center style="color:white"
                                                @click="promijeniLozinku()"
                                            >Potvrdi</v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
        </v-dialog>
    </v-app>
</template>

<script>
    export default {
        name: 'full',
        data: () => ({
            logoutLink:domenurl + '/logout',
            token : document.head.querySelector('meta[name="csrf-token"]').content,
            dialog: false,
            drawer: false,
            items: [
                {icon: 'home',text:'Početna',link: '/pocetna'},
                {icon:'assignment',text:'Moji Planovi',link:'/planovi'}
            ],
            dialogPodesavanja: false,
            korisnik:{
                email:'',
                brojTelefona:'',
                brojTelefonaStari:'',
                nacinObavjestevanja:'',
                posaljiObavjestenje:'',
                brojTelefonaKod:'',
                satObavjestenja:0,
                lozinka:{
                    trenutnaLozinka:'',
                    novaLozinka:'',
                    novaLozinkaPotvrda:'',
                    error:'',
                    poruka:'',
                    e1:true,
                    e2:true,
                    e3:true,
                    form_valid:true
                }
            },
            emailRules: [
                v => {
                    return !!v || 'E-mail is required'
                },
                v => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
            ],
            telephoneRules:[
                v=>/^($|(((0{2})\s[1-9]\d{0,2})(\s?(\-\s?)?)\(?|0|\()(0\))?(0?[1-9](\d{1,4}?|(\d{1,2}\s\d{1,3})))(\s?(\-\s?)?)(\d{2,4}?\s?(\d{2,3}\s)?\d{2,5}))$/.test(v) || 'Broj telefona mora biti validan!'

            ],
            passwordRules:[
                v => {
                    return !!v || 'Polje je obavezno'
                },
                v => /^.{6,}$/.test(v) || 'Morate unijeti minimalno 6 karaktera!'

            ],
            sati:[]
        }),
        props: {
            source: String
        },
        computed:{
          posaljiKodZaVerifikacijuTelefona:function () {
              return this.korisnik.brojTelefonaStari != this.korisnik.brojTelefona;
          }
        },
        created(){
                this.ucitajProfil();
                for(let i=0;i<=23;i++){
                    this.sati.push({'text':(i<10 ? '0'+i : i)+' h','value':i});
                }
        },

        methods:{
            ucitajProfil:function () {
                axios.get(domenurl+'/korisnik/profil')
                    .then((response)=>{

                        let info = response.data.user_info;
                        this.korisnik.email = info.email;
                        this.korisnik.brojTelefona = info.broj_telefona;
                        this.korisnik.brojTelefonaStari = info.broj_telefona;
                        this.korisnik.nacinObavjestevanja = info.nacin_obavjestavanja;
                        this.korisnik.posaljiObavjestenje = info.posalji_obavjestenje == 1 ? true : false;
                        this.korisnik.satObavjestenja = parseInt(info.sat_obavjestenja != null ? info.sat_obavjestenja : 0);
                    });
            },
            azurirajProfil : function () {
                axios.post(domenurl+'/korisnik/azuriraj',{
                    broj_telefona: this.korisnik.brojTelefona,
                    broj_telefona_verifikacija_kod: this.korisnik.brojTelefonaKod,
                    nacin_obavjestavanja: this.korisnik.posaljiObavjestenje==true ? this.korisnik.nacinObavjestevanja: '',
                    sat_obavjestenja: this.korisnik.satObavjestenja,
                    posalji_obavjestenje: this.korisnik.posaljiObavjestenje
                })
                    .then((response)=>{
                        this.dialogPodesavanja = false;
                        this.ucitajProfil();
                    });
            },
            posaljiKodZaVerifikaciju: function(){
                axios.get(domenurl+'/korisnik/broj-telefona-posalji-kod');
            },
            logout: function () {
                document.getElementById('logout-form').submit();
                setTimeout(function(){window.location.href = '/login';},1000);
            },
            promijeniLozinku:function () {
                if(this.korisnik.lozinka.novaLozinka.localeCompare(this.korisnik.lozinka.novaLozinkaPotvrda)!=0
                    || !this.$refs.lozinka_form.validate()){
                    this.korisnik.lozinka.status = 'Morate da potvrdite lozinku;.';
                    return;
                }
                axios.post(domenurl+'/korisnik/promijeni-lozinku',{
                    stara_lozinka: this.korisnik.lozinka.trenutnaLozinka,
                    nova_lozinka: this.korisnik.lozinka.novaLozinka,
                    nova_lozinka_potvrda: this.korisnik.lozinka.novaLozinkaPotvrda,
                    check: 1
                })
                    .then((response)=>{
                        this.korisnik.lozinka.error = response.data[0].error;
                        this.korisnik.lozinka.poruka = response.data[0].poruka;
                    });
            }

        }
    }
</script>
<style>
    .container.fill-height .layout{
        overflow-x: auto;
    }
</style>