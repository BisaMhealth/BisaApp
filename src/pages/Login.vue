<template>
  <div>
    <div class="container-fluid">
       <div class="row">
          <div class="card login-card">
              <div class="row">
                <div class="col-md-7 img-side">
                    <div id="overlay"></div>
                </div>
                <div class="col-md-5 form-side">
                  <div class="text-right">
                    <img class="img-fluid" src="/assets/img/bisa.png" width="70" height="40">
                  </div>
                  <form @submit.prevent="login">
                    <h3 class="tx-color-01 mg-b-5" style="margin-top: 60px;">Bisa Marketer's Dashboard</h3>
                    <br>
                    <div class="form-group">
                      <label>Email address</label>
                      <input
                        type="email"
                        v-model="form.email"
                        class="form-control"
                        placeholder="yourname@yourmail.com"
                      />
                    </div>
                    <div class="form-group">
                      <div class="d-flex justify-content-between mg-b-5">
                        <label class="mg-b-0-f">Password</label>
                        <a href="" class="tx-13">Forgot password?</a>
                      </div>
                      <input
                      v-model="form.password"
                        type="password"
                        class="form-control"
                        placeholder="Enter your password"
                      />
                    </div>
                    <button type="submit" class="btn  btn-block btn-grad" style="background-color:green ! important;">Sign In</button>
                  </form>
                  <div class="text-center">
                    <small>POWERED BY BISA TECHNOLOGIES &#169; {{currentYear.getFullYear()}}</small>
                  </div>
                </div>
              </div>
          </div>        
       </div>
    </div>
  </div>
</template>

<script>
import store from "../store";
import axios from "axios";
import Form from "vform";
import { mixin } from "./../mixin";
export default {
  mixins: [mixin],
  mounted() {},
  data() {
    return {
      form: new Form({
        email: "",
        password: "",
      }),

      currentYear: new Date(),
    };
  },
  methods: {
    login() {
      var vm = this;
      let formData = new FormData();
      formData.append("email", this.form.email);
      formData.append("password", this.form.password);
      axios
        .post("/api/v1/marketer/auth/login", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(
          (response) => {
            if (response) {
              const res = response.data;

              if (res.code == 200) {
                var userData = res.data;
                localStorage.setItem("welcometomarketdaz", userData.token);
                axios.defaults.headers.common["Authorization"] =
                  "Bearer " + userData.token;
                store.commit("loginUser");
                localStorage.setItem("bisamarketmask", userData.user.admin_id);
               // localStorage.setItem("bisarolemask", userData.user.role);

                 localStorage.setItem("permissions", userData.permissions);
                this.successToastRedirect(res.message, "/dashboard");
                //  window.location.replace("/dashboard");
              } else {
                vm.$toasted.show(res.message);
              }
            }
          },
          function (error) {
            //vm.isActive = false;

            if (error.response) {
              console.log(error.response.data.errors);
              error.response.data.errors.forEach((element) => {
                vm.$toasted.show(element);
              });
              // alert(error.response.status);
            }
          }
        );
    },
  },
};
</script>

<style lang="css" scoped>
    .container-fluid{
      background: url('/assets/img/dashbg.png'); 
      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;
    }

    .login-card
    {
      width: 1000px;
      margin: 80px auto;
      border: none;
      border-radius: 9px;
      background: linear-gradient(145deg, #ffffff, #e6e6e6);
      box-shadow:  35px 35px 70px #6e6c6c83,
             -35px -35px 70px #ffffff;
    }

    .img-side
    {
      background: url('/assets/img/background.jpg');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      height: 500px;
    }

    .form-side form
    {
      width: 305px;
      margin: 30px auto;
    }

    #overlay {
      position: absolute; 
      width: 100%; 
      height: 100%;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5); /* Black background with opacity */
      z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */
}

    .btn-grad {background-image: linear-gradient(to right, #8ec742 0%, #0f3443  51%, #8ec742  100%)}
    .btn-grad {
      margin: 10px auto;
      padding: 10px;
      text-align: center;
      text-transform: uppercase;
      transition: 0.5s;
      background-size: 200% auto;
      color: white;            
      box-shadow: 0 0 20px #eee;
      border-radius: 10px;
      display: block;
    }

    .btn-grad:hover {
      background-position: right center; /* change the direction of the change here */
      color: #fff;
      text-decoration: none;
    }
         
</style>
