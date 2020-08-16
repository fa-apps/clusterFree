<template>
    <div class="mt-4 container">
        <div class="d-flex flex-row flex-wrap"> 
            <div  v-for="visitor in visitors" :key="visitor.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="card my-2">         
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
    </div>
</template>


<script>

export default {
    name: 'Visitors',
    props: ['visitors'],
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