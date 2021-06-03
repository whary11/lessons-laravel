<template>
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary shadow border-0">
        <div class="card-header bg-transparent pb-5">
          <div class="text-muted text-center mt-2 mb-3">
            <small>Sign in with</small>
          </div>
          <div class="btn-wrapper text-center">
            <a href="#" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon"
                ><img src="/assets/img/icons/common/github.svg"
              /></span>
              <span class="btn-inner--text">Github</span>
            </a>
            <a href="#" class="btn btn-neutral btn-icon">
              <span class="btn-inner--icon"
                ><img src="/assets/img/icons/common/google.svg"
              /></span>
              <span class="btn-inner--text">Google</span>
            </a>
          </div>
        </div>
        <div class="card-body px-lg-5 py-lg-5">
          <div class="text-center text-muted mb-4">
            <p class="text-center text-danger" v-for="(item, key) in errors" :key="key">
              {{ item }}
            </p>
            <!-- <small >Or sign in with credentials</small> -->
          </div>
          <form role="form">
            <base-input
              formClasses="input-group-alternative mb-3"
              placeholder="Email"
              addon-left-icon="ni ni-email-83"
              @input="(value) =>  setValue('email', value)"
            >
            </base-input>

            <base-input
              formClasses="input-group-alternative mb-3"
              placeholder="Password"
              type="password"
              addon-left-icon="ni ni-lock-circle-open"
              @input="(value) =>  setValue('password', value)"
            >
            </base-input>

            <base-checkbox class="custom-control-alternative">
              <span class="text-muted">Remember me</span>
            </base-checkbox>
            <div class="text-center">
              <base-button type="primary" class="my-4" @click="login()">Sign in</base-button>
            </div>
          </form>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-6">
          <a href="#" class="text-light"><small>Forgot password?</small></a>
        </div>
        <div class="col-6 text-right">
          <router-link :to="{name:'register'}" class="text-light"
            ><small>Create new account</small></router-link
          >
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { forIn } from 'lodash';
export default {
  name: "login",
  data() {
    return {
      model: {
        email: "",
        password: "",
      },

      errors: []
    };
  },
  methods: {
    async login(){
      this.errors = []
      axios.post('/api/authentication/login', this.model)
        .then(resp => {
          localStorage.setItem('token', resp.data.token)
          this.$router.push({name:'dashboard'})
        }).catch(err => {
          console.log(err.response);

          

          if (err.response.status == 422) {
            for (const key in err.response.data.data) {
              
              err.response.data.data[key].map(e => {
                
                this.errors.push(e)
              })
            }
          }

          console.log(this.errors);
        })
    },
    setValue(type, evt){
      let value = evt.target.value;
      this.model[type] = value
    },
   
    
    }
  
};
</script>
<style></style>