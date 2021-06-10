<template>
  <div>
    <div class="container pd-x-0">
      <div
        class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-10 mg-xl-b-10"
      >
        <div class="main-welcome-header">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
              <!-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li> -->
            </ol>
          </nav>
          <h3 class="mg-b-0 tx-spacing--1">
            Welcome to Bisa Marketing Dashboard
          </h3>
          <hr />
        </div>
      </div>

      <div class="row row-xs mb-10">
        <div class="col-lg-12"><h4>User Registrations</h4></div>

        <div class="col-sm-6 col-lg-3">
          <div class="card card-body">
            <h6
              class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
            >
              Today's Registrations
            </h6>
            <div class="d-flex d-lg-block d-xl-flex align-items-end">
              <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                {{ thisPatientDayCount }}
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
                {{ thisPatientWeekCount }}
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
                {{ thisPatientMonthCount }}
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
                {{ thisPatientYearCount }}
              </h3>
            </div>
          </div>
        </div>
      </div>
      <div
        class="row pt-10 pb-10"
        style="padding-bottom: 10px; padding-top: 10px"
      >
        <div class="col-lg-12 mt-5">
          <h4>Questions Statistics</h4>
        </div>
      </div>

      <div class="row row-xs">
        <div class="col-sm-6 col-lg-3">
          <div class="card card-body">
            <h6
              class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
            >
              Total Questions Asked Today
            </h6>
            <div class="d-flex d-lg-block d-xl-flex align-items-end">
              <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                {{ thisQuestionDayCount }}
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
                {{ thisQuestionWeekCount }}
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
                {{ thisQuestionMonthCount }}
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
                {{ thisQuestionYearCount }}
              </h3>
            </div>
          </div>
        </div>
      </div>
      <div
        class="row pt-10 pb-10"
        style="padding-bottom: 10px; padding-top: 10px"
      ></div>

      <div class="row row-xs mt-5">
        <div class="col-lg-6">
          <div class="col-lg">
            <h4>Gender Breakdown</h4>
          </div>
          <div class="row">
            <div class="col-sm-6 col-lg-6">
              <div class="card card-body">
                <h6
                  class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
                >
                  Males <br />
                </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                    {{ maleCount }}
                  </h3>
                </div>
              </div>
            </div>
            <!-- col -->
            <div class="col-sm-6 col-lg-6">
              <div class="card card-body">
                <h6
                  class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
                >
                  Females
                </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                    {{ femaleCount }}
                  </h3>
                </div>

                <!-- chart-three -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="col-lg">
            <h4>Platform Usage( Today)</h4>
          </div>
          <div class="row">
            <div class="col-sm-6 col-lg-6">
              <div class="card card-body">
                <h6
                  class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
                >
                  Mobile <br />
                </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                    {{ mobileCount }}
                  </h3>
                </div>
              </div>
            </div>
            <!-- col -->
            <div class="col-sm-6 col-lg-6">
              <div class="card card-body">
                <h6
                  class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8"
                >
                  Desktop/Web
                </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                  <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">
                    {{ webCount }}
                  </h3>
                </div>

                <!-- chart-three -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div style="padding-bottom: 20px"></div>
      <div class="row mt-5">
        <div class="col-lg-6 bd-1">
          <div>
            <h5>Questions By Categories</h5>
          </div>
          <div>
            <apexchart
              ref="realtimeChart"
              type="pie"
              width="100%"
              :options="chartOptions"
              :series="series"
            ></apexchart>
          </div>

          <!-- <div class="row">
            <div class="col-lg-4">
              <flat-pickr
                class="form-control"
                v-model="form.question_start_date"
                name="dateofc"
                :config="config1"
                placeholder="Start Date"
              ></flat-pickr>
            </div>
            <div class="col-lg-4">
              <flat-pickr
                class="form-control"
                v-model="form.question_end_date"
                name="dateofc"
                :config="config"
                placeholder="End Date"
              ></flat-pickr>
            </div>

            <div class="col-lg-4 text-center">
              <button
                @click="filterGetQuestionCategory()"
                class="btn btn-success"
              >
                View Data
              </button>
            </div>
          </div> -->
        </div>

        <div class="col-lg-6">
          <div>
            <h5>Breakdown of Signups</h5>
          </div>
          <div>
            <apexchart
              ref="realtimesignupChart"
              type="pie"
              width="90%"
              :options="signupOptions"
              :series="signupbreaks"
            ></apexchart>
          </div>

          <!-- <div class="row">
            <div class="col-lg-4">
              <flat-pickr
                class="form-control"
                v-model="form.signup_start_date"
                name="dateofc"
                :config="config1"
                placeholder="Start Date"
              ></flat-pickr>
            </div>
            <div class="col-lg-4">
              <flat-pickr
                class="form-control"
                v-model="form.signup_end_date"
                name="dateofc"
                :config="config"
                placeholder="End Date"
              ></flat-pickr>
            </div>

            <div class="col-lg-4 text-center">
              <button @click="filterSignupBreakdown()" class="btn btn-success">
                View Data
              </button>
            </div>
          </div> -->
        </div>
      </div>
      <!-- row -->
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Form from "vform";

export default {
  mounted() {
    this.getPatientCounts();
    this.getQuestionCategory();
    this.getSignupBreakdown();
    this.getQuestionCounts();
    this.getGenderCounts();
    this.getUsageStats();
  },
  data() {
    return {
      maleCount: 0,
      femaleCount: 0,

      mobileCount: 0,
      webCount: 0,

      thisPatientDayCount: 0,
      thisPatientMonthCount: 0,
      thisPatientWeekCount: 0,
      thisPatientYearCount: 0,

      thisQuestionDayCount: 0,
      thisQuestionWeekCount: 0,
      thisQuestionMonthCount: 0,
      thisQuestionYearCount: 0,

      series: [44, 55, 13, 43, 22, 22, 22],
      chartOptions: {
        chart: {
          width: 380,
          type: "pie",
        },
        labels: [],
        responsive: [
          {
            breakpoint: 480,
            options: {
              chart: {
                width: 200,
              },
              legend: {
                position: "bottom",
              },
            },
          },
        ],
      },

      signupbreaks: [44, 55],
      signupOptions: {
        chart: {
          // width: 380,
          type: "pie",
        },

        labels: [],

        responsive: [
          {
            breakpoint: 480,
            options: {
              chart: {
                width: 200,
              },
              legend: {
                position: "bottom",
              },
            },
          },
        ],
      },
      questionsCategories: [],
      questionsCategoriesValues: [],
      form: new Form({
        question_start_date: "2020-02-01",
        question_end_date: "",
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
    };
  },

  methods: {
    filterGetQuestionCategory() {
      let formData = new FormData();
      formData.append("start_date", this.form.question_start_date);
      formData.append("end_date", this.form.question_end_date);
      let uri =
        "/api/v1/marketstatistics/filter/questions-categories";
      axios
        .post(uri, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          const res = response.data.data;

          this.questionsCategories = res.questionsCategories;
          // this.questionsCategoriesValues = res.values;
          this.series = res.values;
          // this.chartOptions.labels = res.questionsCategories;
          this.chartOptions = {
            labels: res.questionsCategories,
          };
        });
    },
    filterSignupBreakdown() {
      let formData = new FormData();
      formData.append("start_date", this.form.signup_start_date);
      formData.append("end_date", this.form.signup_end_date);
      let uri =
        "/api/v1/marketstatistics/filter/signup-breakdown";
      axios
        .post(uri, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          const res = response.data.data;
          this.signupbreaks = res.values;
          this.signupOptions = {
            labels: res.sources,
          };
        });
    },

    getQuestionCategory() {
      axios
        .get(
          "/api/v1/marketstatistics/question-categories"
        )
        .then((response) => {
          let data = response.data;
          if (data) {
            const res = response.data.data;

            this.questionsCategories = res.questionsCategories;
            // this.questionsCategoriesValues = res.values;
            this.series = res.values;
            // this.chartOptions.labels = res.questionsCategories;
            this.chartOptions = {
              labels: res.questionsCategories,
            };

            // this.$refs.realtimeChart.updateOptions(
            //   [
            //     {
            //       data: res.vales,
            //       labels : res.questionsCategories,
            //     }
            //   ]
            // )
          }
        });
    },
    getSignupBreakdown() {
      axios
        .get(
          "/api/v1/marketstatistics/signup-breakdown"
        )
        .then((response) => {
          let data = response.data;
          if (data) {
            const res = response.data.data;
            this.signupbreaks = res.values;

            this.signupOptions = {
              labels: res.sources,
            };
          }
        });
    },

    getPatientCounts() {
      axios
        .get("/api/v1/marketstatistics/patient-counts")
        .then(({ data }) => {
          this.thisPatientDayCount = data.data.thisDayCount;
          this.thisPatientMonthCount = data.data.thisMonthCount;
          this.thisPatientWeekCount = data.data.thisWeekCount;
          this.thisPatientYearCount = data.data.thisYearCount;

          // this.records = data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getGenderCounts() {
      axios
        .get(
          "/api/v1/marketstatistics/gender-breakdown"
        )
        .then(({ data }) => {
          this.maleCount = data.data.male;
          this.femaleCount = data.data.female;

          // this.records = data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    getUsageStats() {
      axios
        .get("/api/v1/marketstatistics/get-webstats")
        .then(({ data }) => {
          this.mobileCount = data.data.mobile;
          this.webCount = data.data.web;

          // this.records = data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    getQuestionCounts() {
      axios
        .get(
          "/api/v1/marketstatistics/question-counts"
        )
        .then(({ data }) => {
          this.thisQuestionDayCount = data.data.thisDayCount;
          this.thisQuestionMonthCount = data.data.thisMonthCount;
          this.thisQuestionWeekCount = data.data.thisWeekCount;
          this.thisQuestionYearCount = data.data.thisYearCount;

          // this.records = data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>

<style lang="css" scoped>
.main-welcome-header h4 {
  font-size: 40px;
  font-weight: 500;
}

.bd-1 {
  border-right: 1px solid lightgreen;
}
</style>