<template>
  <div class="mx-1 xtext-center py-1">
    
    <div class="card">
      <div class="card-header" v-if="user">
        <h3>{{ user.name }}</h3>
        <span>{{ user.email }}</span>
      </div>
    </div>
    <rsl-board :user="user" v-if="user && user.role == 'RSL'"/>
    <rlp-board :user="user" v-if="user && user.role == 'RLP'"/>
    <vlp-board :user="user" v-if="user && user.role == 'VLP'"/>
  </div>
</template>

<script>
import User from "../apis/User";
import RSLBoard from "@/components/RSLBoard.vue";
import RLPBoard from "@/components/RLPBoard.vue";
import VLPBoard from "@/components/VLPBoard.vue";

export default {

  components : {
    'rsl-board' : RSLBoard,
    'rlp-board' : RLPBoard,
    'vlp-board' : VLPBoard,
  },

  data() {
    return {
      user: null
    };
  },

  mounted() {
    User.auth().then(response => {
      this.user = response.data;
    }).catch(error => console.log(error));
  }

};
</script>
