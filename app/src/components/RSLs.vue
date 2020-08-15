<template>
    <div class="mt-4 container h-100 overflow-auto ">
        <div class="d-flex flex-row flex-wrap "> 
            <div  v-for="rsl in rsls" :key="rsl.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="card my-2 ">         
                    <div class="card-header d-flex flex-row flex-wrap justify-content-around">
                        <div>{{rsl.name}}</div>
                        <div>{{rsl.email}}</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row flex-wrap justify-content-between">
                            <div>Signalements <span class="text-secondary">{{rsl.reports}}</span></div>
                        </div>
                        <div>Enregistré <span class="text-secondary">{{ rsl.date | moment("dddd Do MMMM YYYY à H:mm") }}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

export default {
    name: 'RSLs',
    props: ['rsls'],
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