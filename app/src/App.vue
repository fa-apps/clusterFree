<template>
  <div id="app" class="bg-light h-100">
    <Navigation />
    <router-view/>
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
