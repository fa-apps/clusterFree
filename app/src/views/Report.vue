<template>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="text-center">
                <h4 class="">Signaler un test positif</h4>

                <div class="py-4">

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">Date du test</label>
                            
                                <datepicker v-model="form.tested_at" :language="fr" inline name="date" wrapper-class="mx-auto"></datepicker>
                               
                        </div>
                        <div v-if="isRSL" class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>

                            <div class="col-md-6">
                                <input v-model="form.email" id="email" type="email" class="form-control" required >

                                    <span class="invalid-feedback" role="alert">
                                    </span>
                            </div>
                        </div>
                        <button type="submit" @click.prevent="report" class="btn btn-primary my-4">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Report from "../apis/Report"
import Datepicker from 'vuejs-datepicker'
import {en, fr} from 'vuejs-datepicker/dist/locale'

export default {
    components: {
        Datepicker
    },
    data : () => ({
        form: {
            tested_at : new Date,
            email : ''
        },
        en: en,
        fr: fr
    }),
    computed: { 
        isRSL() { return this.$parent.$children[0].isRSL }
    },
    methods : {
        report() {
            Report.report(this.form)
            .then(() => {
                this.$router.push({ name: "Dashboard" });
            })
            .catch(error => {
                console.log(error.response.data.errors)
                this.errors = error.response.data.errors;
            });
        }
    }
}
</script>

