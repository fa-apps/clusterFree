<template>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h4 class="">Enregistrer RSL ou RLP</h4>

                <div class="py-4">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>

                            <div class="col-md-6">
                                <input v-model="form.name" id="name" type="text" class="form-control" required autofocus placeholder="Entrez un nom...">
                                    <span class="invalid-feedback" role="alert">
                                    </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                            <div class="col-md-6">
                            <select v-model="form.role" class="form-control" id="role" required>
                                <option value="" disabled selected>Selectionnez...</option>
                                <option value ="RSL">Responable Sanitaire Local</option>
                                <option value ="RLP">Responsable Lieu Public</option>
                            </select>          
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>

                            <div class="col-md-6">
                                <input v-model="form.email" id="email" type="email" class="form-control" required placeholder="utilisateur@exemple.fr">

                                    <span class="invalid-feedback" role="alert">
                                        
                                    </span>
                            </div>
                        </div>

                        <p>Un e-mail sera envoyé à l'adresse ci dessus, avec les details de connexion et un mot de passe généré automatiquement.</p>                       

                        <button type="submit" @click.prevent="register" class="btn btn-primary my-4">Envoyer</button>
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
            role : '',
            email : ''
        }
    }),
    methods : {
        register() {
            User.register(this.form)
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
