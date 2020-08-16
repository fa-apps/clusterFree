<template>
    <div class="container px-0 py-4  vlp-section">        
        <nav class="nav nav-pills flex-column flex-sm-row nav-justified">           
            <router-link  :to="{ path: '/dashboard' }" class="flex-sm-fill text-sm-center nav-link ">Visites</router-link>
            <router-link :to="{ name: 'Reports' }" class="flex-sm-fill text-sm-center nav-link ">Signalements</router-link>
        </nav>
        <router-view :visits="visits" :reports="reports"></router-view>
    </div>
</template>


<script>
import Board from '../apis/Board.js';

export default {
    name: 'VLPBoard',
    components : {
    },
    props: ['user'],
    data : () => ({
        visits : [],
        reports : []
    }),
    mounted() {
        Board.vlp()
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