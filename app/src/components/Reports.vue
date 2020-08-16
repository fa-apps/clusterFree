<template>
    <div class="mt-4 container">
        <div class="d-flex flex-row flex-wrap"> 
            <div v-for="report in reports" :key="report.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="card my-2">         
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
    </div>
</template>


<script>

export default {
    name: 'Reports',
    props: ['reports'],
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