<template>
  <div id="app" class="bg-light">
    <Navigation />
    <router-view />
  </div>
</template>

<script>
import Navigation from "@/components/Navigation.vue";

export default {
  components: {
    Navigation
  }
};


</script>

<style>
.h-screen {
  height: 100vh;
}
</style>
