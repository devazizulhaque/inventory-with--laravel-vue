<template>
    <main class="authentication-content">
        <div class="container-fluid">
          <div class="authentication-card">
            <div class="card shadow rounded-0 overflow-hidden">
              <div class="row g-0">
                <div class="col-lg-6 bg-login d-flex align-items-center justify-content-center">
                  <img src="admin/assets/images/error/login-img.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Sign Up</h5>
                    <p class="card-text mb-5">See your growth and get consulting support!</p>
                    <form class="form-body" @submit.prevent="register">
                      <div class="d-grid">
                        <a class="btn btn-white radius-30" href="javascript:;"><span class="d-flex justify-content-center align-items-center">
                            <img class="me-2" src="assets/images/icons/search.svg" width="16" alt="">
                            <span>Sign up with Google</span>
                          </span>
                        </a>
                      </div>
                      <div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
                        <hr>
                      </div>
                      <div class="row g-3">
                        <div class="col-12 ">
                          <label for="inputName" class="form-label">Name</label><br>
                          <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                          <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-person-circle"></i></div>
                            <input type="text" class="form-control radius-30 ps-5" id="inputName" placeholder="Enter Name" v-model="form.name">
                          </div>
                        </div>
                        <div class="col-12">
                          <label for="inputEmailAddress" class="form-label">Email Address</label><br>
                          <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                          <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                            <input type="email" class="form-control radius-30 ps-5" id="inputEmailAddress" placeholder="Email Address" v-model="form.email">
                          </div>
                        </div>
                        <div class="col-12">
                          <label for="inputChoosePassword" class="form-label">Enter Password</label><br>
                          <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                          <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                            <input type="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Enter Password" v-model="form.password">
                          </div>
                        </div>

                        <div class="col-12">
                          <label for="inputChoosePassword" class="form-label">Confirm Password</label><br>
                          <div class="ms-auto position-relative">
                            <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                            <input type="password" class="form-control radius-30 ps-5" id="inputChoosePassword" placeholder="Re-Type Password" v-model="form.password_confirmation">
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                            <label class="form-check-label" for="flexSwitchCheckChecked">I Agree to the Trems & Conditions</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="d-grid">
                            <button type="submit" class="btn btn-primary radius-30">Sign in</button>
                          </div>
                        </div>
                        <div class="col-12">
                          <p class="mb-0">Already have an account?  <router-link :to="{name: 'login'}">Sign In here</router-link></p>
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
export default {
  name: "RegisterView",
  components: {},

  created() {
    if (User.loggedIn()) {
      if (this.$route.name !== 'dashboard') {
        this.$router.push({ name: 'dashboard' });
      }
    }
  },
  
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      errors: {},
    };
  },

  methods: {
    register() {
      axios.post('/api/auth/register', this.form)
      .then(
        response => {
          User.responseAfterLogin(response)
          this.$router.push({name: 'dashboard'})
          Toast.fire({
            icon: 'success',
            title: 'Signed up successfully'
          })
        },
      )
      .catch(error => this.errors = error.response.data.errors)
    }
  }
}
</script>

<style>

</style>