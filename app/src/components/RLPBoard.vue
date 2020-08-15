<template>
    <div class="mx-3">
        <h4 class="mt-4">Liste de vos signalements</h4>
        <div v-for="report in reports" :key="report.id">
            Signalement le : <span class="text-secondary">{{ report.date | moment("dddd Do MMMM YYYY à H:mm") }}</span>
            du test positif du <span class="text-secondary">{{ report.test_date | moment("dddd Do MMMM YYYY") }}</span>
        </div> 
        <h4 class="mt-4">Liste de vos visiteurs</h4>
        <div v-for="visit in visits" :key="visit.id">
            {{visit.vlp}} ({{visit.email}}) <span v-if="visit.count">(signalements : {{ visit.count }})</span>: <span class="text-secondary"> le {{ visit.date | moment("dddd Do MMMM YYYY à H:mm") }}</span>
        </div>
    </div>
</template>


<script>
import Board from '../apis/Board.js';

export default {
    name: 'RLPBoard',
    props: ['user'],
    data : () => ({
        visits : [],
        reports : []
    }),
    mounted() {
        Board.rlp()
        .then( ( response ) => {
            this.visits=response.data.visits;
            this.reports=response.data.reports;
        })
        .catch( error => {
            console.log(error)            
            this.errors=error.response.data.errors;
        });        
    },
    methods: {
    },
    computed: {
    }
}
</script>