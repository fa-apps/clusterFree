<template>
    <div class="mt-4 container">
        <div class="d-flex flex-row flex-wrap overflow-auto board-section"> 
            <div v-for="location in locations" :key="location.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="card my-2">         
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
    </div>
</template>


<script>

export default {
    name: 'Locations',
    props: ['locations'],
    data : () => ({
    }),
    mounted() {              
    },
    methods: {
    },
    computed: {
    }
}
</script>