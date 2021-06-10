<template>
  <div>
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
          <h4 class="mg-b-0 tx-spacing--1">Welcome to Bisa Marketing Dashboard -:- (Users Statistics)</h4>
        </div>
        <div class="d-none d-md-block">
          <!-- <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5">
            <i data-feather="file" class="wd-10 mg-r-5"></i> Generate Report
          </button> -->
        </div>
      </div>

      <div class="row row-xs">
        <div class="col-sm-6 col-lg-3">
          <div class="card card-body">
            <h6
              class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
            >
              Today's Registrations
            </h6>
            <div class="d-flex d-lg-block d-xl-flex align-items-end">
              <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                {{ thisDayCount }}
              </h3>
            </div>
          </div>
        </div>
        <!-- col -->
        <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
          <div class="card card-body">
            <h6
              class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
            >
              This Week
            </h6>
            <div class="d-flex d-lg-block d-xl-flex align-items-end">
              <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                {{ thisWeekCount }}
              </h3>
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
              This Month
            </h6>
            <div class="d-flex d-lg-block d-xl-flex align-items-end">
              <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                {{ thisMonthCount }}
              </h3>
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
              This Year(From Febuauary)
            </h6>
            <div class="d-flex d-lg-block d-xl-flex align-items-end">
              <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                {{ thisYearCount }}
              </h3>
            </div>
          </div>
        </div>
      </div>
      <!-- row -->

      <div class="row mt-3">
        <div class="col-lg-3">
          <flat-pickr
            class="form-control"
            v-model="form.start_date"
            name="dateofc"
            :config="config1"
            placeholder="Start Date"
          ></flat-pickr>
        </div>
        <div class="col-lg-3">
          <flat-pickr
            class="form-control"
            v-model="form.end_date"
            name="dateofc"
            :config="config"
            placeholder="End Date"
          ></flat-pickr>
        </div>

        <div class="col-lg-3 text-center">
          <button @click="loadDetails()" class="btn btn-success">
            View Users
          </button>
        </div>
        <div class="col-lg-3">
          <h3>Total Users : {{ total }}</h3>
        </div>
      </div>
      <div class="row mt-3">
        <div class="table-responsive col-md-12 col-lg-12">
          <table class="table table-striped mg-b-0">
            <!-- Per Hospital -->

            <thead>
              <tr>
                <th>User Name</th>

                <th>Gender</th>
                <th>Age</th>
                <th>Country</th>
                <th>Address</th>
                <th>Registered On</th>
                <th>Registered From</th>

                <th>Remove</th>
              </tr>
            </thead>

            <tbody id="question-body">
              <tr v-for="singItem in records" :key="singItem.user_id">
                <td>{{singItem.hashname}}</td>
                <td>
                  <span class="badge badge-primary">
                    {{ singItem.gender }}</span
                  >
                </td>
                 <td>{{ singItem.age }}</td>
                <td>{{ singItem.country }}</td>
                <td>{{ singItem.address }}</td>
                <td>{{ singItem.registered_on }}</td>
               

                <td>{{ singItem.source }}</td>
                <td>
                  <a href="" type="button" class="btn btn-xs btn-dark"
                    ><i class="fa fa-edit"></i>
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- container -->
  </div>
</template>

<script>
import axios from "axios";
import Form from "vform";

export default {
  mounted() {
    this.getCounts();
    this.getRecords();
  },

  data() {
    return {
      form: new Form({
        start_date: "2020-02-01",
        end_date: "",
      }),
      config: {
        wrap: true, // set wrap to true only when using 'input-group'
        // altFormat: "M	j, Y",
        altInput: true,
        // minDate: "today",
        enableTime: false,
        dateFormat: "Y-m-d",
      },

        config1: {
        wrap: true, // set wrap to true only when using 'input-group'
        // altFormat: "M	j, Y",
        altInput: true,
         minDate: "2021-02-01",
        enableTime: false,
        dateFormat: "Y-m-d",
      },
      records: [],
      total: 0,
      thisDayCount: 0,
      thisMonthCount: 0,
      thisWeekCount: 0,
      thisYearCount: 0,
    };
  },
  methods: {
    getCounts() {
      axios
        .get("/api/v1/marketstatistics/patient-counts")
        .then(({ data }) => {
          this.thisDayCount = data.data.thisDayCount;
          this.thisMonthCount = data.data.thisMonthCount;
          this.thisWeekCount = data.data.thisWeekCount;
          this.thisYearCount = data.data.thisYearCount;

          // this.records = data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getRecords() {
      axios
        .get("/api/v1/marketstatistics/all-patients")
        .then(({ data }) => {
          this.records = data.data.patients;
          this.total = data.data.total;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    loadDetails() {
      this.records = [];
      let formData = new FormData();
      formData.append("start_date", this.form.start_date);
      formData.append("end_date", this.form.end_date);
      let uri =
        "/api/v1/marketstatistics/filter/patients";
      axios
        .post(uri, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          const res = response.data;
          // console.log(res.data);
          this.records = res.data.patients;
          this.total = res.data.total;
        });
    },
  },
};
</script>

<style lang="scss" scoped>
</style>