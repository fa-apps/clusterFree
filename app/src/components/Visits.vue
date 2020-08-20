<template>
    <div class="mt-4 container">
        <div class="d-flex flex-row flex-wrap "> 
            <div v-for="visit in visits" :key="visit.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="card my-2">         
                    <div class="card-header d-flex flex-row flex-wrap justify-content-around">
                        <div>{{visit.name}}</div>
                        <div>{{visit.email}}</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row flex-wrap justify-content-between">
                            <div>Signalements <span class="text-secondary">{{visit.reports}}</span></div>
                        </div>
                        <div v-if="visit.location">{{ visit.location }}</div>
                        <div>Date visite <span class="text-secondary">{{ visit.date | moment("dddd Do MMMM YYYY à H:mm") }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Visits',
    props: ['visits'],
    data : () => ({
    }),
    updated() {
    },
    mounted() {
    },
    methods: {
    },
    computed: {
    }
}
</script>