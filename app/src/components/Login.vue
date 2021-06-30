<template>
  <Page actionBarHidden="true" class="ns-light">
    <FlexboxLayout class="page">
      <ScrollView class="form" :scrollBarIndicatorVisible="false">
        <AbsoluteLayout>
          <StackLayout top="0" left="0" width="100%" paddingTop="80" paddingBottom="50">
            <Image v-if="!isCovidLogin" class="logo" :src="resLoginBadge" height="100"></Image>

            <Image v-if="isCovidLogin" class="logo" src='~/src/assets/icons/full-logo-covid.png' height="100"></Image>

            <GridLayout rows="auto, auto, auto, auto, auto, auto, auto, auto"
              marginTop="20">
              <StackLayout row="0" class="input-field" v-show="!isLoggingIn">
                <GridLayout row="auto" columns="*,*">
                  <TextField
                    row="0"
                    col="0"
                    class="input"
                    :hint="$t('firstName')"
                    :isEnabled="!processing"
                    v-model="user.firstName"
                    returnKeyType="next"
                    @returnPress="focusLastName"
                  ></TextField>
                  <TextField
                    row="0"
                    col="1"
                    ref="lastName"
                    class="input"
                    :hint="$t('lastName')"
                    :isEnabled="!processing"
                    v-model="user.lastName"
                    returnKeyType="next"
                    @returnPress="focusEmail"
                  ></TextField>
                </GridLayout>
                <StackLayout class="hr-light"></StackLayout>
              </StackLayout>

              <StackLayout row="1" class="input-field">
                <TextField
                  ref="email"
                  class="input"
                  :hint="$t('email')"
                  :isEnabled="!processing"
                  keyboardType="email"
                  autocorrect="false"
                  autocapitalizationType="none"
                  v-model="user.email"
                  returnKeyType="next"
                  @returnPress="focusPassword"
                ></TextField>
                <StackLayout class="hr-light"></StackLayout>
              </StackLayout>

              <StackLayout row="2" class="input-field" marginTop="5">
                <TextField
                  class="input"
                  ref="password"
                  :isEnabled="!processing"
                  :hint="$t('password')"
                  secure="true"
                  v-model="user.password"
                  :returnKeyType="isLoggingIn ? 'done' : 'next'"
                  @returnPress="isLoggingIn ? null : focusPhone"
                ></TextField>
                <StackLayout class="hr-light"></StackLayout>
              </StackLayout>

              <StackLayout row="3" v-show="!isLoggingIn" class="input-field">
                <TextField
                  class="input"
                  ref="phone"
                  :isEnabled="!processing"
                  :hint="$t('phone')"
                  v-model="user.phone"
                  returnKeyType="next"
                ></TextField>
                <StackLayout class="hr-light"></StackLayout>
              </StackLayout>

              <StackLayout row="4" v-show="!isLoggingIn" class="input-field">
                <GridLayout rows="auto" columns="*,*">
                  <TextField row="0" col="0"
                    class="input"
                    ref="gender"
                    :isEnabled="!processing"
                    :hint="$t('gender')"
                    v-model="user.gender"
                    returnKeyType="next"
                    editable="false"
                    @tap="selectGenderOptions"
                  ></TextField>
                  <TextField row="0" col="1"
                    class="input"
                    ref="location"
                    :isEnabled="!processing"
                    :hint="$t('location')"
                    v-model="user.address"
                    returnKeyType="done"
                    editable="true"
                  ></TextField>
                </GridLayout>
                <StackLayout class="hr-light"></StackLayout>
              </StackLayout>

              <StackLayout row="5" v-show="!isLoggingIn" class="input-field">
                <GridLayout rows="auto" columns="*,*">
                  <TextField row="0" col="0"
                    class="input"
                    ref="bloodGroup"
                    :isEnabled="!processing"
                    :hint="$t('bloodGroup')"
                    v-model="user.bloodGroup"
                    returnKeyType="next"
                    editable="false"
                    @tap="selectBloodType"
                  ></TextField>
                  <TextField row="0" col="1"
                    class="input"
                    ref="dateOfBirth"
                    :isEnabled="!processing"
                    :hint="$t('dateOfBirth')"
                    v-model="user.dateOfBirth"
                    returnKeyType="next"
                    editable="false"
                    @tap="selectADate"
                  ></TextField>

                </GridLayout>
                <StackLayout class="hr-light"></StackLayout>
              </StackLayout>

              <StackLayout row="6" v-show="!isLoggingIn" class="input-field">
                <GridLayout rows="auto" columns="*,*">
                  <TextField row="0" col="0"
                    class="input"
                    ref="height"
                    :isEnabled="!processing"
                    :hint="$t('height')"
                    v-model="user.height"
                    returnKeyType="done"
                    editable="true"
                  ></TextField>
                  <TextField row="0" col="1"
                    class="input"
                    ref="weight"
                    :isEnabled="!processing"
                    :hint="$t('weight')"
                    v-model="user.weight"
                    returnKeyType="next"
                    editable="true"
                  ></TextField>
                </GridLayout>
                <StackLayout class="hr-light"></StackLayout>
              </StackLayout>

              <StackLayout row="7" v-show="!isLoggingIn" class="input-field">
                <TextField class="input"
                  ref="knownCondition"
                  :isEnabled="!processing"
                  :hint="$t('knownCodition')"
                  v-model="user.knownCondition"
                  returnKeyType="done"
                  editable="true"
                ></TextField>
                <StackLayout class="hr-light"></StackLayout>
              </StackLayout>

              <ActivityIndicator rowspan="3" :busy="processing"></ActivityIndicator>
            </GridLayout>

            <Button
                :text="isLoggingIn ? $t('login') : $t('submit')"
                :isEnabled="!processing"
                @tap="submit"
                padding='8'
                class="btn btn-primary "
            ></Button>
            
            <Label
              *v-show="isLoggingIn"
              v-if="!isCovidLogin && isLoggingIn"
              :text="$t('forgotYourPassword')"
              class="login-label"
              @tap="forgotPassword()"
            ></Label>
  
          </StackLayout>

          <GridLayout columns="auto,*,auto" top="0" left="0" width="100%">
            <Image src="~/assets/flag.png"
              width="40" marginTop="30"
              row="0" col="0"
              horizontalAlignment="right"
            ></Image>
            <Label v-if="!isCovidLogin" class="uppercase text-black" @tap="toggleForm"
              row="0" col="2"
              width="auto" paddingTop="5" marginTop="30">
              <FormattedString fontSize="17" class="">
                <Span :text="isLoggingIn ? $t('signUp') : $t('login')"></Span>
              </FormattedString>
            </Label>
          </GridLayout>
        </AbsoluteLayout>
      </ScrollView>
    </FlexboxLayout>
  </Page>
</template>

<script>
const Dialogs = require("tns-core-modules/ui/dialogs");
import { ModalDatetimepicker } from 'nativescript-modal-datetimepicker'

import { mapGetters } from 'vuex';

import config from './../../config';
import Home from "./App";

import { isIOS } from 'tns-core-modules/platform';

export default {
  data() {
    return {
      covidBuild: true,
      isLoggingIn: true,
      isCovidLogin: false,
      processing: false,
      user: {
        firstName: null,
        lastName: null,
        phone: null,
        gender: null,
        address: null,
        email: null,
        imageUrl: "", 
        password: null,
        country: config.country == 'gh' ? "Ghana" : "Senegal",

        bloodGroup: null,
        dateOfBirth: null,
        knownCondition: null,
        weight: "",
        height: "",
      }
    };
  },

  computed: {
    ...mapGetters({
      currentUser: 'currentUser'
    }),

    resLoginBadge() {
      return config.country == 'sn' ? 
        '~/src/assets/images/login_badge_sn.png' :
        '~/src/assets/images/login_badge_gh.png';
    }
  },

  created () {
    if (this.currentUser) {
      console.log("Redirecting to Home screen");
      this.$navigateTo(Home, { clearHistory: true });
      return;
    }
  },

  methods: {
    toggleForm() {
      this.isLoggingIn = !this.isLoggingIn;
    },
    
    selectDialog(field, options) {
      let title = options["title"] || "Title",
        action = options["action"] || this.$t('cancel'),
        choices = options["choices"] || [];

      Dialogs.action(title, action, choices).then(result => {
        if (result == action) {
          return;
        }

        this.user[field] = result;
        return;
      });
    },

    selectGenderOptions() {
      this.selectDialog('gender', {
        title: this.$t('selectAGender'),
        action: this.$t('cancel'),
        choices: [ this.$t('male'), this.$t('female') ]
      });
    },

    selectCountryOptions() {
      this.selectDialog('country', {
        title: this.$t('selectACountry'),
        action: this.$t('cancel'),
        choices: [ 'Ghana', 'Senegal' ]
      });
    },


    selectBloodType() {
      this.selectDialog('bloodGroup', {
        title: this.$t('enterBloodType'),
        action: this.$t('cancel'),
        choices: [
          'O-',
          'O+',
          'A-',
          'A+',
          'B-',
          'B+',
          'AB-',
          'AB+',
        ]
      });
    },

    selectADate() {
      const picker = new ModalDatetimepicker();

      picker.pickDate({
        title: "Select Your Date of Birth",
        theme: "light",
        maxDate: new Date()
      })
      .then(result => {
        let jsdate = new Date(result.year, result.month - 1, result.day);
        
        this.user.dateOfBirth = jsdate.getFullYear() + '-' + ('0' + (jsdate.getMonth()+1)).slice(-2) + '-' + ('0' + jsdate.getDate()).slice(-2);
      })
      .catch(error => {
        console.log("Error: " + error);
      });
    },

    submit() {
      this.processing = true;
      if (this.isLoggingIn) {
        this.login();
      } else {
        this.register();
      }
    },

    login() {
      if (!this.user.email || !this.user.password) {
        this.alert(this.$t('alerts.login.emailAndPasswordMissing'));
        this.processing = false;
        return;
      }

      let data = {
        userId: this.user.email,
        password: this.user.password
      };

      this.$apiServices.login(data)
        .then(res => {
          console.log("Resp", res)
          let response = JSON.parse(res.content);
          if(response.success){
            this.processing = false;
            const userObject = response.data;
            if (! userObject) {
              throw 'account not found!';
              return false;
            }
            console.log("User logged in", userObject['email']);

            this.$navigateTo(Home, { clearHistory: true });
          }else{
            this.processing = false;
            this.alert(response.message);
          }
          
        })
        .catch((err) => {
          console.log("Err", err)

          this.processing = false;
          this.alert(
            this.$t('alerts.login.accountNotFound')
          );
        });
    },

    register() {
      let user = this.user;

      if (
				!user.firstName ||
				!user.lastName ||
				!user.email ||
				!user.phone ||
				!user.password ||
        !user.dateOfBirth ||
        !user.gender
			) {
				this.alert(this.$t("alerts.login.requiredFieldMissing"));
				this.processing = false;
				return;
			}

      // Format phone number
      user['phone'] = "233" + String(user.phone).slice(-9)
      console.log("Request data", user)

      this.$apiServices.register(user)
        .then((res) => {
          console.log("Resp", res)
          let response = JSON.parse(res.content);
          if (response.success) {
						this.processing = false;
						this.alert(this.$t("alerts.login.registrationSuccess"));

						if(isIOS){
							this.isLoggingIn = true;
						}else{
							this.login();
						}
					} else {
						this.processing = false;
						this.alert(response.message);
					}
        })
        .catch((err) => {
          console.log("Err", err)
          this.processing = false;
          this.alert(
            this.$t('alerts.login.registrationFailed')
          );
        });
    },

    forgotPassword() {
      prompt({
        title: this.$t('forgotYourPassword'),
        message: this.$t('enterEmailToResetPassword'),
        inputType: "email",
        defaultText: "",
        okButtonText: this.$t('ok'),
        cancelButtonText: this.$t('cancel')
      }).then(data => {
        if (data.result) {          
          this.$apiServices.resetPassword(data.text.trim())
            .then((res) => {
              console.log(res)
              let response = JSON.parse(res.content);
              if(response.success){
                  this.alert(
                    this.$t('alerts.login.passwordResetCompleted')
                );
              }else{
                this.alert(response.message)
              }
              
            })
            .catch((err) => {
              console.log(err)
              this.alert(
                this.$t('alerts.login.passwordResetFailed')
              );
            });
        }
      })
      .catch((err) => {
        console.log("An error occurred: ", err);
      });
    },

    focusLastName () {
      this.$refs.lastName.nativeView.focus();
    },

    focusEmail () {
      this.$refs.email.nativeView.focus();
    },

    focusPhone () {
      this.$refs.phone.nativeView.focus();
    },

    focusPassword() {
      this.$refs.password.nativeView.focus();
    },

    alert(message) {
      return alert({
        title: "Bisa",
        okButtonText: this.$t('ok'),
        message: message
      });
    }
  }
};
</script>

<style scoped>
.page {
  align-items: center;
  flex-direction: column;
}

.form {
  margin-left: 30;
  margin-right: 30;
  flex-grow: 2;
  vertical-align: middle;
}

.logo {
  margin-bottom: 12;
  height: 90;
  font-weight: bold;
}

.header {
  horizontal-align: center;
  font-size: 25;
  font-weight: 600;
  margin-bottom: 70;
  text-align: center;
  color: #8cd740;
}

.input-field {
  margin-bottom: 25;
}

.input {
  font-size: 18;
  placeholder-color: #a8a8a8;
}

.input:disabled {
  background-color: white;
  opacity: 0.5;
}

.input:focus {
  /* border-color: #8cd740; */
  outline: none !important;
  border-bottom-width: 2;
  border-bottom-color: #8cd740;
  /* background-color: #8cd740; */
  /* border-radius: 10; */
  /* color: #FFF; */
  /* padding-left: 10; */
}

.btn-primary {
  background-color: #8cd740;
  color: #fff;
  font-size: 20;
  margin: 0;
  padding: 20 10;
}

.login-label {
  horizontal-align: center;
  color: #a8a8a8;
  font-size: 16;
  text-align: center;
}

.sign-up-label {
  margin-bottom: 20;
  text-align: center;
}

.bold {
  /* color: #000000; */
  color: #a8a8a8;
}
.uppercase {
  text-transform: uppercase;
}
.text-black {
  color: #000000;
}
</style>