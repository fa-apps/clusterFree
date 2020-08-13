<template>
    <div class="mt-4">
        <h4>Liste des visites</h4>
        <div v-for="visit in visits" :key="visit.id">
            {{visit.rlp}}:<span class="text-secondary"> le {{ visit.date | moment("dddd Do MMMM YYYY à H:mm") }}</span>
        </div>
    </div>
    

</template>


<script>
import Board from '../apis/Board.js';

export default {
    name: 'VLPBoard',
    props: ['user'],
    data : () => ({
        visits : []
    }),
    mounted() {
        Board.vlp()
        .then( ( response ) => {
            this.visits=response.data;
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