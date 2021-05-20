<template>
    <div class="trening-plan-pregled-container" v-if="plan!=null">
        <h1>{{ plan.naziv }}</h1>
    </div>
</template>
<script>
    export  default {
        name: 'trening-plan-pregled-treninga',
        props:{
            plan:{
                type:Object,
                default: null
            }
        }
    }
</script>