<template>
    <div class="mt-4 container">
        <div class="d-flex flex-row flex-wrap "> 
            <div v-for="mail_log in mail_logs" :key="mail_log.id" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="card my-2">         
                    <div class="card-header d-flex flex-row flex-wrap justify-content-around">
                        <div>A: {{mail_log.to}}</div>
                        <div>Sujet: {{mail_log.subject}}</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">Envoyé le : <span class="text-secondary">{{ mail_log.created_at | moment("dddd Do MMMM YYYY à H:mm") }}</span></div>                        
                       {{ mail_log.body }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'MailLogs',
    props: ['mail_logs'],
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