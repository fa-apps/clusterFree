<template>
    <div class="container px-0 py-4 rsl-section">
        <nav class="nav nav-pills flex-column flex-sm-row nav-justified">           
            <router-link  :to="{ path: '/dashboard' }" class="flex-sm-fill text-center nav-link ">Visites</router-link>
            <router-link :to="{ name: 'Visitors' }"  class="flex-sm-fill text-center nav-link ">Visiteurs</router-link>
            <router-link :to="{ name: 'Reports' }"  class="flex-sm-fill text-center nav-link ">Signalements</router-link>
            <router-link :to="{ name: 'Locations' }"  class="flex-sm-fill text-center nav-link ">Lieux Publics</router-link>
            <router-link :to="{ name: 'RSLs' }"  class="flex-sm-fill text-center nav-link ">Responsables Sanitaires</router-link>
        </nav>
        <router-view :visits="visits" :visitors="visitors" :reports="reports" :rsls="rsls" :locations="locations"></router-view>        
    </div>
</template>


<script>
import Board from '../apis/Board.js';

export default {
    name: 'RSLBoard',
    props: ['user'],
    data : () => ({
        visits : [],
        reports : [],
        locations : [],
        visitors : [],
        rsls : []
    }),
    mounted() {
        Board.rsl()
        .then( ( response ) => {
            this.visits=response.data.visits;
            this.reports=response.data.reports;
            this.locations=response.data.locations;
            this.visitors=response.data.visitors;
            this.rsls=response.data.rsls;
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