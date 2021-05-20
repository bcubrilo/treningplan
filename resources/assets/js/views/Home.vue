<template>
    <v-container

            style="min-height: 0;"
            grid-list-lg
    >

    <v-layout row wrap  v-if="tipoviTreninga != null">
        <v-flex xs12 sm12 md3 text-xs-center
                v-for="(tip, i) in tipoviTreninga"
                class="trening-plan-card"
        >
            <v-card color="blue-grey darken-2" class="white--text trening-tip"
                    height="125px"
                    width="300px"
                    append
                    :to="{ path : '/pregled-planova/' + tip.id}"
                    >
                <v-card-text >
                    <div class="headline text-xs-center">
                        {{tip.naziv}}
                    </div>
                </v-card-text>

            </v-card>
        </v-flex>
    </v-layout>
    </v-container>
</template>
<script>

    export default {

        name:'HomeView',
        data: ()=>({
            tipoviTreninga:null

        }),
        created(){
          this.ucitajTipove();
        },
        methods:{
            ucitajTipove: function () {
                axios(domenurl+'/dashboard/plan-tip/view')
                    .then(response=>this.tipoviTreninga = response.data);
            }
        }
    }
</script>
<style>
    .trening-plan-card{
        padding-top:20px;
        padding-bottom:20px;
    }
    .link-pregled-planova{
        z-index: 1000;
        color: white!important;
        text-decoration: none;
    }

    .trening-tip .card__text{
        position: absolute;
        top:50%;
        -webkit-transform: translateY(-50%);
        -moz-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        -o-transform: translateY(-50%);
        transform: translateY(-50%);
    }
</style>