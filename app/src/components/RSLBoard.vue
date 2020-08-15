<template>
    <div class="mx-3 ">
        <h4 class="mt-4 ">Signalements</h4>
        <div class="d-flex flex-row flex-wrap overflow-auto board-section">            
            <div v-for="report in reports" :key="report.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">   
                <div class="card m-2 ">         
                <div class="card-header d-flex flex-row flex-wrap justify-content-around">
                    <div >{{report.name}}</div>
                    <div>{{report.email}}</div>
                </div>
                <div class="card-body">
                    <div>Signalé <span class="text-secondary">{{ report.date | moment("dddd Do MMMM YYYY à H:mm") }}</span></div>
                    <div>Date du test <span class="text-secondary">{{ report.test_date | moment("dddd Do MMMM YYYY") }}</span></div>                
                </div>
                </div>
            </div>
        </div> 


        <h4 class="mt-4">Lieus Publics</h4>
        <div class="d-flex flex-row flex-wrap overflow-auto board-section"> 
            <div v-for="location in locations" :key="location.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                <div class="card m-2 ">         
                    <div class="card-header d-flex flex-row flex-wrap justify-content-around">
                        <div>{{location.name}}</div>
                        <div>{{location.email}}</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row flex-wrap justify-content-between">
                            <div>Visiteurs <span class="text-secondary">{{location.visitors}}</span></div>
                            <div>Visites <span class="text-secondary">{{location.visits}}</span></div>
                            <div>signalements <span class="text-secondary">{{location.reports}}</span></div>
                        </div>
                        <div>Enregistré <span class="text-secondary">{{ location.date | moment("dddd Do MMMM YYYY à H:mm") }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-4">Visiteurs</h4>
        <div class="d-flex flex-row flex-wrap overflow-auto board-section"> 
            <div  v-for="visitor in visitors" :key="visitor.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                <div class="card m-2 ">         
                    <div class="card-header d-flex flex-row flex-wrap justify-content-around">
                        <div>{{visitor.name}}</div>
                        <div>{{visitor.email}}</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row flex-wrap justify-content-between">
                            <div>Visites <span class="text-secondary">{{visitor.visits}}</span></div>
                            <div>signalements <span class="text-secondary">{{visitor.reports}}</span></div>
                        </div>
                        <div>Enregistré <span class="text-secondary">{{ visitor.date | moment("dddd Do MMMM YYYY à H:mm") }}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mt-4">Liste de toutes les visites</h4>
        <div v-for="visit in visits" :key="visit.id">
            {{visit.name}} ({{visit.email}}) <span v-if="visit.reports">(signalements : {{ visit.reports }})</span>: <span class="text-secondary"> le {{ visit.date | moment("dddd Do MMMM YYYY à H:mm") }}</span>
        </div>
        <h4 class="mt-4">Liste de tous les responsables sanitaires locaux</h4>
        <div v-for="rsl in rsls" :key="rsl.id">
            {{rsl.name}} ({{rsl.email}}) <span v-if="rsl.reports">(signalements : {{ rsl.reports }})</span>: <span class="text-secondary">, enregistré le {{ rsl.date | moment("dddd Do MMMM YYYY à H:mm") }}</span>
        </div>
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