<template>
  <div class="content-section scrollable">
      <div class="card">
        <div class="card-body container" v-if="user">
            <div class="d-flex">
            <div>
              <h3>{{ user.name }}</h3>
              <span>{{ user.email }}</span>
            </div>
            <div  v-if="user && user.role == 'RSL'" class="ml-auto" data-toggle="modal" data-target="#settings"><i class="fa fa-ellipsis-v icon-xl p-3"></i>
              <div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="settingsLabel">Paramètres</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                       <div class="form-group row">
                            <label for="delay-1" class="col-md-6 col-form-label text-md-right">Délai d'alerte (jours) </label>
                            <div class="col-md-6">
                                <input id="delay-1" v-model="form.delay1" class="form-control" required autofocus/>
                                <span class="invalid-feedback" role="alert"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
      user: null,
      form : {
        delay1 : 7
      }
    };
  },

  mounted() {
    User.auth().then(response => {
      this.user = response.data;
    }).catch(error => console.log(error));
  }

};
</script>
