<template>
  <div>
    <aside class="aside aside-fixed">
      <div class="aside-header" style="height: 100px">
        <a href="" class="aside-logo">
          <img
            class="img-fluid"
            style="width: 160px; margin-top: 40px; margin-bottom: 30px"
            src="https://app.bisa.com.gh/../../assets/img/logo-inverse.png"
          />
        </a>
        <a href="" class="aside-menu-link">
          <i class="fa fa-menu"></i>
          <i class="fa fa-x"></i>
        </a>
      </div>
     
      <div class="aside-body">
        <div class="aside-loggedin">
          <div class="d-flex align-items-center justify-content-start">
            <div class="aside-alert-link">
              <a   @click.prevent="showLogoutModal" href="#" data-toggle="tooltip" title="Sign out"
                ><i class="fa fa-sign-in"></i
              ></a>
            </div>
          </div>
          <div class="aside-loggedin-user">
            <a
              href="#loggedinMenu"
              class="d-flex align-items-center justify-content-between mg-b-2"
              data-toggle="collapse"
            >
              <h6 class="tx-semibold mg-b-0" style="color: white">
                Bisa Marketer
              </h6>
              <i class="fa fa-chevron-down"></i>
            </a>
          </div>
          <div class="collapse" id="loggedinMenu">
            <ul class="nav nav-aside mg-b-0">
              <!-- <li class="nav-item">
                <a href="" class="nav-link"
                  ><i class="fa fa-edit"></i> <span>Edit Profile</span></a
                >
              </li> -->
              <!-- <li class="nav-item">
                <a href="" class="nav-link"
                  ><i class="fa fa-user"></i> <span>View Profile</span></a
                >
              </li> -->
              <!-- <li class="nav-item">
                <a href="" class="nav-link"
                  ><i class="fa fa-cog"></i>
                  <span>Account Settings</span></a
                >
              </li> -->
              <!-- <li class="nav-item">
                <a href="" class="nav-link"
                  ><i class="fa fa-user-circle"></i>
                  <span>Help Center</span></a
                >
              </li> -->
              <li class="nav-item" @click="showLogoutModal">
                <a class="nav-link"
                  ><i class="fa fa-sign-out-alt"></i> <span>Sign Out</span></a
                >
              </li>
            </ul>
          </div>
        </div>
        <!-- aside-loggedin -->
        <ul class="nav nav-aside">
          <li class="nav-item">
            <router-link :to="{ name: 'Overview' }" class="nav-link"
              ><i class="fa fa-chart-pie"></i>
              <span>Overview</span></router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'Users' }" class="nav-link"
              ><i class="fa fa-chart-area"></i>
              <span>Users Statistics</span></router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'Questions' }" class="nav-link"
              ><i class="fa fa-chart-bar"></i>
              <span>Questions Statistics</span></router-link
            >
          </li>
          <!-- <li class="nav-item">
            <router-link :to="{ name: 'Platform' }" class="nav-link"
              ><i class="fa fa-chart-line"></i>
              <span>Platform Statistics</span></router-link
            >
          </li> -->
          <li
          
          >
            <li @click="showLogoutModal"   class="nav-item">
            <div class="nav-link">
              <i class="fa fa-sign-out-alt"></i> <span>Sign Out</span>
            </div>
          </li>
        </ul>
      </div>
    </aside>
    <div class="content ht-100v pd-0">
      <!-- content-header -->
      <div class="content-body">
        <router-view></router-view>
      </div>

       <div class="footer" style="height: 60px;">
        <div>
           DESIGNED &amp; DEVELOPED BY BISA TECHNOLOGIES LTD  &#169; {{currentDate}}
        </div>
      </div>
    </div>
   
    <div
      class="modal fade"
      id="defaultModalDanger"
      tabindex="-1"
      role="dialog"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Signing Out</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body m-3">
            <p class="mb-0">Are you sure you want to logout?</p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              No
            </button>
            <button type="button" @click="logout" class="btn btn-danger">
              Yes
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mixin } from "./../mixin";
// import { axios } from "axios";
// import $ from  'jquery';

export default {
  data() {
    return {
      currentDate: new Date().getFullYear()
    };
  },
  components: {},

  mixins: [mixin],
  methods: {
    showLogoutModal() {
      
      window.$("#defaultModalDanger").modal().show();
      //  document.getElementById("defaultModalDanger").modal().show();
    },
    logout(e) {
      e.preventDefault();
     // delete axios.defaults.headers.common["Authorization"];
      localStorage.removeItem("welcometomarketdaz");
      localStorage.removeItem("bisamarketmask");
      // localStorage.removeItem("bisarolemask");
      // localStorage.removeItem("permissions");
      window.location.replace("/");
    },
  },
};
</script>

<style lang="css" scoped>
.aside-body ul {
  font-size: 16px;
  font-weight: 400;
}

.aside-body ul li span {
  padding-left: 10px;
}

.aside-loggedin-user h6 {
  font-size: 20px;
  font-weight: 700;
}
</style>