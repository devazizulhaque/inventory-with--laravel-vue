<template>
    <main class="authentication-content">
        <div class="container-fluid">
          <div class="authentication-card">
            <div class="card shadow rounded-0 overflow-hidden">
              <div class="row g-0">
                <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                  <img src="admin/assets/images/error/forgot-password-frent-img.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Forgot Password?</h5>
                    <p class="card-text mb-5">Enter your registered email ID to reset the password</p>
                    <form class="form-body" @submit.prevent="forget">
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="inputEmailid" class="form-label">Email id</label>
                            <input type="email" class="form-control form-control-lg radius-30" v-model="form.email" id="inputEmailid" placeholder="Email id">
                          </div>
                          <div class="col-12">
                            <div class="d-grid gap-3">
                              <button type="submit" class="btn btn-lg btn-primary radius-30">Send</button>
                              <router-link class="btn btn-lg btn-light radius-30" :to="{name: 'login'}">Back to Login</router-link>
                            </div>
                          </div>
                        </div>
                    </form>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </main>
</template>

<script>
import User from '../../Helpers/User';
export default {
  name: "ForgetView",
  created() {
    if (User.loggedIn) {
      this.$router.push({ name: "dashboard" });
    }
  },

  data() {
    return {
      form: {
        email: "",
      },
      errors: {},
    };
  },  
}
</script>

<style>

</style>