<template>
  <nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
      <div class="navbar-header">
        <router-link class="navbar-brand" :to="{ path : isLoggedIn ? '/dashboard' : '/' }">Cluster Free</router-link>
      </div>
      <ul class="nav navbar-nav">

        <router-link v-if="!isLoggedIn" class="nav-item nav-link" :to="{ name: 'Login' }">Connexion</router-link>

        <router-link v-if="isLoggedIn" class="nav-item nav-link" :to="{ name: 'Report' }">Signaler Positif</router-link>

        <router-link v-if="isLoggedIn && isRSL" class="nav-item nav-link" :to="{ name: 'Register' }">Enregister RSL/RLP</router-link>

        <router-link v-if="isLoggedIn && isRLP" class="nav-item nav-link" :to="{ name: 'Visit' }">Enregister Visiteur</router-link>

        <a class="nav-item nav-link" v-if="isLoggedIn" @click.prevent="logout" href="#">Deconnexion</a> 
      </ul>
    </div>
  </nav>
</template>

<script>
import User from "../apis/User";

export default {
  data() {
    return {
      isLoggedIn: false,
      isRSL: false,
      isRLP: false,
      isVLP: false,
      user:null
    };
  },
  updated() {
   
    if (this.isLoggedIn && !this.user ) {
      User.auth().then(response => {
        this.user = response.data;
      });
    }
  },
  mounted() {
    this.$root.$on("login", () => {
      this.isLoggedIn = true;
    });

    this.isLoggedIn = !!localStorage.getItem("token");

     if (this.isLoggedIn ) {
      User.auth().then(response => {
        this.user = response.data;
      });
    }
  },
  watch: {
    user: function(user) {
      if (user) {
        this.isRLP = this.user.role == "RLP";
        this.isVLP = this.user.role == "VLP";
        this.isRSL = this.user.role == "RSL";
      }
    }

  },
  methods: {
    logout() {
      User.logout().then(() => {
        localStorage.removeItem("token");
        this.user = null;
        this.isLoggedIn = false;
        this.isRLP = false;
        this.isVLP =false ;
        this.isRSL = false;
        this.$router.push({ name: "Home" });
      });
    }
  }
};
</script>

<style>
.router-link-exact-active {
  color: #ffffff !important;
  transition: all 0.25s;
}
</style>
