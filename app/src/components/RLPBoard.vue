<template>
    <div class="container px-0 py-4  rsl-section">
        <nav class="nav nav-pills flex-column flex-sm-row nav-justified">           
            <router-link  :to="{ path: '/dashboard' }" class="flex-sm-fill text-center nav-link ">Visites</router-link>
            <router-link :to="{ name: 'Visitors' }"  class="flex-sm-fill text-center nav-link ">Visiteurs</router-link>
            <router-link :to="{ name: 'Reports' }"  class="flex-sm-fill text-center nav-link ">Signalements</router-link>
        </nav>
        <router-view :visits="visits" :visitors="visitors" :reports="reports" class="h-100 overflow-auto"></router-view>        
    </div>
</template>


<script>
import Board from '../apis/Board.js';

export default {
    name: 'RLPBoard',
    props: ['user'],
    data : () => ({
        visits : [],
        reports : [],
        visitors : []
    }),
    mounted() {
        Board.rlp()
        .then( ( response ) => {
            this.visits=response.data.visits;
            this.reports=response.data.reports;
            this.visitors=response.data.visitors;
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