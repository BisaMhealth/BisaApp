<template>
  <div>
    <aside class="aside aside-fixed">
      <div class="aside-header">
        <a href="" class="aside-logo">
          Marketer
          <!-- <img class="site-logo" src="https://app.bisa.com.gh/../../assets/img/logo-inverse.png"> -->
        </a>
        <a href="" class="aside-menu-link">
          <i data-feather="menu"></i>
          <i data-feather="x"></i>
        </a>
      </div>
      <div class="aside-body">
        <div class="aside-loggedin">
          <div class="d-flex align-items-center justify-content-start">
            <a href="" class="avatar"
              ><img
                src="https://via.placeholder.com/500"
                class="rounded-circle"
                alt=""
            /></a>
            <div class="aside-alert-link">
              <a
                href=""
                class="new"
                data-toggle="tooltip"
                title="You have 2 unread messages"
                ><i data-feather="message-square"></i
              ></a>
              <a
                href=""
                class="new"
                data-toggle="tooltip"
                title="You have 4 new notifications"
                ><i data-feather="bell"></i
              ></a>
              <a href="" data-toggle="tooltip" title="Sign out"
                ><i data-feather="log-out"></i
              ></a>
            </div>
          </div>
          <div class="aside-loggedin-user">
            <a
              href="#loggedinMenu"
              class="d-flex align-items-center justify-content-between mg-b-2"
              data-toggle="collapse"
            >
              <h6 class="tx-semibold mg-b-0">Katherine Pechon</h6>
              <i data-feather="chevron-down"></i>
            </a>
            <p class="tx-color-03 tx-12 mg-b-0">Marketer</p>
          </div>
          <div class="collapse" id="loggedinMenu">
            <ul class="nav nav-aside mg-b-0">
              <li class="nav-item">
                <a href="" class="nav-link"
                  ><i data-feather="edit"></i> <span>Edit Profile</span></a
                >
              </li>
              <li class="nav-item">
                <a href="" class="nav-link"
                  ><i data-feather="user"></i> <span>View Profile</span></a
                >
              </li>
              <li class="nav-item">
                <a href="" class="nav-link"
                  ><i data-feather="settings"></i>
                  <span>Account Settings</span></a
                >
              </li>
              <li class="nav-item">
                <a href="" class="nav-link"
                  ><i data-feather="help-circle"></i>
                  <span>Help Center</span></a
                >
              </li>
              <li class="nav-item">
                <a href="" class="nav-link"
                  ><i data-feather="log-out"></i> <span>Sign Out</span></a
                >
              </li>
            </ul>
          </div>
        </div>
        <!-- aside-loggedin -->
        <ul class="nav nav-aside">
          <li class="nav-label">Dashboard</li>
         
          <li class="nav-item">
            <a href="dashboard-two.html" class="nav-link"
              ><i data-feather="globe"></i> <span>User Statistics</span></a
            >
          </li>
          <li class="nav-item">
            <a href="dashboard-three.html" class="nav-link"
              ><i data-feather="pie-chart"></i> <span>Questions Statistics</span></a
            >
          </li>
          <li class="nav-item">
            <a href="dashboard-four.html" class="nav-link"
              ><i data-feather="life-buoy"></i>
              <span>Platform Statistics</span></a
            >
          </li>
    

         
        
        </ul>
      </div>
    </aside>
    <div class="content ht-100v pd-0">
      <div class="content-header">
        <div class="content-search">
          <i data-feather="search"></i>
          <input type="search" class="form-control" placeholder="Search..." />
        </div>
        <nav class="nav">
          <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
          <a href="" class="nav-link"><i data-feather="grid"></i></a>
          <a href="" class="nav-link"><i data-feather="align-left"></i></a>
        </nav>
      </div>
      <!-- content-header -->

      <div class="content-body">
        <div class="container pd-x-0">
          <div
            class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30"
          >
            <div>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                </ol>
              </nav>
              <h4 class="mg-b-0 tx-spacing--1">Welcome to Marketer's Dashboard</h4>
            </div>
            <div class="d-none d-md-block">
              <button class="btn btn-sm pd-x-15 btn-white btn-uppercase">
                <i data-feather="mail" class="wd-10 mg-r-5"></i> Email
              </button>
              <button class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5">
                <i data-feather="printer" class="wd-10 mg-r-5"></i> Print
              </button>
              <button
                class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"
              >
                <i data-feather="file" class="wd-10 mg-r-5"></i> Generate Report
              </button>
            </div>
          </div>

          <div class="row row-xs">
            <div class="col-sm-6 col-lg-3">
              <div class="card card-body">
                <h6
                  class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
                >
                  Conversion Rate
                </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">0.81%</h3>
                  <p class="tx-11 tx-color-03 mg-b-0">
                    <span class="tx-medium tx-success"
                      >1.2% <i class="icon ion-md-arrow-up"></i
                    ></span>
                  </p>
                </div>
                <div class="chart-three">
                  <div id="flotChart3" class="flot-chart ht-30"></div>
                </div>
                <!-- chart-three -->
              </div>
            </div>
            <!-- col -->
            <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
              <div class="card card-body">
                <h6
                  class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
                >
                  Unique Purchases
                </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">3,137</h3>
                  <p class="tx-11 tx-color-03 mg-b-0">
                    <span class="tx-medium tx-danger"
                      >0.7% <i class="icon ion-md-arrow-down"></i
                    ></span>
                  </p>
                </div>
                <div class="chart-three">
                  <div id="flotChart4" class="flot-chart ht-30"></div>
                </div>
                <!-- chart-three -->
              </div>
            </div>
            <!-- col -->
            <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
              <div class="card card-body">
                <h6
                  class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
                >
                  Avg. Order Value
                </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">$306.20</h3>
                  <p class="tx-11 tx-color-03 mg-b-0">
                    <span class="tx-medium tx-danger"
                      >0.3% <i class="icon ion-md-arrow-down"></i
                    ></span>
                  </p>
                </div>
                <div class="chart-three">
                  <div id="flotChart5" class="flot-chart ht-30"></div>
                </div>
                <!-- chart-three -->
              </div>
            </div>
            <!-- col -->
            <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
              <div class="card card-body">
                <h6
                  class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
                >
                  Order Quantity
                </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">1,650</h3>
                  <p class="tx-11 tx-color-03 mg-b-0">
                    <span class="tx-medium tx-success"
                      >2.1% <i class="icon ion-md-arrow-up"></i
                    ></span>
                  </p>
                </div>
                <div class="chart-three">
                  <div id="flotChart6" class="flot-chart ht-30"></div>
                </div>
                <!-- chart-three -->
              </div>
            </div>
          
         
    
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
</style>