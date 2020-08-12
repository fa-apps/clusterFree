<template>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="text-center">
                <h4 class="">Enregistrer un Visiteur</h4>

                <div class="py-4">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>

                            <div class="col-md-6">
                                <input v-model="form.name" id="name" type="text" class="form-control" required autofocus>
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>

                            <div class="col-md-6">
                                <input v-model="form.email" id="email" type="email" class="form-control" required >

                                    <span class="invalid-feedback" role="alert">
                                        
                                    </span>
                            </div>
                        </div>
                                    <button type="submit" @click.prevent="visit" class="btn btn-primary my-4">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import User from "../apis/User"

export default {
    data : () => ({
        form: {
            name : '',
            email : ''
        }
    }),
    methods : {
        visit() {
            User.visit(this.form)
            .then(() => {
                this.$router.push({ name: "Dashboard" });
            })
            .catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors;
                }
            });
        }
    }
}
</script>
