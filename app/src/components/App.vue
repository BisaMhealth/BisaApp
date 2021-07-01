<template>
  <Page class="page" actionBarHidden="true" backgroundSpanUnderStatusBar="true">
    <DockLayout class="screen" stretchLastChild="true">
      <SharedFooter current-page="home" />

      <ScrollView dock="top" scrollBarIndicatorVisible="false">
        <StackLayout orientation="vertical">
          <AbsoluteLayout>
            <StackLayout class="welcome-header"
              left="0" top="0" width="100%" height="350">
              <Label class="greeting" :text="`${$t('hello')} ${currentUserFirstName}!`"
                horizontalAlignment="center" color="#FFF" />
              <Label class="description" :text="$t('whatDoYouWantToDoToday')"
                horizontalAlignment="center" color="#FFF" />
            </StackLayout>
            <StackLayout width="100%" top="150" height="60"
              paddingLeft="20" paddingRight="20"
              @tap="goToStartAQuestionPage">
              <GridLayout rows="auto" columns="*, auto" heigh
                borderRadius="40"
                backgroundColor="#EEE"
                padding="10" paddingLeft="20" paddingRight="20"
                v-shadow="{ elevation: 4 }">
                <Label :text="$t('askADoctorAQuestion')" horizontalAlignment="left"
                  verticalAlignment="middle" fontSize="14" color="lite-gray"
                  row="0" column="0" />
                <Image src="~/src/assets/icons/ic_send_black_24dp.png"
                  row="0" column="1" height="25" />
              </GridLayout>
            </StackLayout>
            <GridLayout columns="*,*,*" rows="130" top="210" width="100%"
              paddingTop="30" paddingLeft="10" paddingRight="10" backgroundColor="transparent">
              <StackLayout row="0" column="0"
                @tap="goToFAQPage">
                <FlexboxLayout backgroundColor="white" borderRadius="70" height="70" width="70"
                  justifyContent="space-around"
                  v-shadow="{ elevation: 15 }">
                  <Image src="~/src/assets/icons/question.png"
                    width="40" height="40"
                    alignSelf="center" />
                </FlexboxLayout>
                <Label :text="$t('seePopularQuestions')" horizontalAlignment="center"
                  marginTop="5" textWrap="true" fontSize="16" class="action-label" />
              </StackLayout>

              <StackLayout row="0" column="1"
                @tap="goToQuestionsPage">
                <FlexboxLayout backgroundColor="white" borderRadius="70" height="70" width="70"
                  justifyContent="space-around"
                  v-shadow="{ elevation: 15 }">
                  <Image src="~/src/assets/icons/chat.png" width="40" height="40"
                    alignSelf="center" />
                </FlexboxLayout>
                <Label :text="$t('allYourQuestions')" horizontalAlignment="center"
                  marginTop="4" textWrap="true" fontSize="16" class="action-label" />
              </StackLayout>

              <StackLayout row="0" column="2"
                @tap="goToHealthTipsPage">
                <FlexboxLayout backgroundColor="white" borderRadius="70" height="70" width="70"
                  justifyContent="space-around"
                  v-shadow="{ elevation: 15 }">
                  <Image src="~/src/assets/icons/health.png"
                    width="40" height="40"
                    alignSelf="center" />
                </FlexboxLayout>
                <Label :text="$t('getHealthTips')" horizontalAlignment="center"
                  marginTop="5" textWrap="true" fontSize="16" class="action-label" />
              </StackLayout>
            </GridLayout>
            
            <!-- <GridLayout :columns="isGhanaApp ? '*,auto,*,auto,*' : '*,auto,*'" rows="130" top="350" width="100%" -->
            <GridLayout columns="*,auto,*" rows="130" top="350" width="100%"
              paddingTop="30" paddingLeft="10" paddingRight="10" backgroundColor="transparent">
              <StackLayout v-if="isGhanaApp"
                row="0" column="0"
                @tap="goToGHSPage">
                <FlexboxLayout backgroundColor="white" borderRadius="70" height="70" width="70"
                  justifyContent="space-around"
                  v-shadow="{ elevation: 15 }">
                  <Image src="~/src/assets/icons/hospital.png" width="40" height="40"
                    alignSelf="center" />
                </FlexboxLayout>
                <Label :text="$t('ghanaHealthService')" horizontalAlignment="center"
                  marginTop="5" textWrap="true" fontSize="16" class="action-label" />
              </StackLayout>

              <StackLayout row="0" column="1"
                @tap="goToVideosPage">
                <FlexboxLayout backgroundColor="white" borderRadius="70" height="70" width="70"
                  justifyContent="space-around"
                  v-shadow="{ elevation: 15 }">
                  <Image src="~/src/assets/icons/video.png"
                    width="40" height="40"
                    alignSelf="center" />
                </FlexboxLayout>
                <Label :text="$t('videos')" horizontalAlignment="center"
                  marginTop="4" textWrap="true" class="action-label"
                  paddingLeft="25" fontSize="16" paddingRight="25" />
              </StackLayout>

              <!-- <StackLayout row="0" :column="isGhanaApp ? '3' : '1'" -->
              <StackLayout row="0" column="2"
                @tap="goToCovidPage">
                <FlexboxLayout backgroundColor="white" borderRadius="70" height="70" width="70"
                  justifyContent="space-around"
                  v-shadow="{ elevation: 15 }">
                  <Image src="~/src/assets/icons/coronavirus.png"
                    width="40" height="40"
                    alignSelf="center" />
                </FlexboxLayout>
                <Label :text="$t('covid19')" horizontalAlignment="center"
                  marginTop="4" textWrap="true" class="action-label"
                  paddingLeft="25" fontSize="14" paddingRight="25" />
              </StackLayout>
            </GridLayout>
          </AbsoluteLayout>

          <StackLayout marginTop="10" padding="20">
            <SharedHomePageArticle :title="$t('topGeneralHealthTips')"
              endpoint="4"></SharedHomePageArticle>
          </StackLayout>
        </StackLayout>
      </ScrollView>
    </DockLayout>
  </Page>
</template>

<script>
const firebase = require('nativescript-plugin-firebase');

import { mapGetters } from 'vuex';
import config from './../../config';

import Explore from './Explore.vue';
import StartQuestion from './StartQuestion.vue';
import HealthTips from './HealthTips.vue';
import SharedFooter from './shared/Footer.vue';
import SharedHomePageArticle from './shared/HomePageArticleTile.vue';
import FAQList from './FAQList.vue';
import Profile from './Profile.vue';
import ChatList from './ChatList.vue';
import Chat from './Chat.vue';
import GHS from './GHS.vue';
import Covid from './Covid.vue';
import Videos from './Videos.vue';

export default {
  components: {
    SharedFooter,
    SharedHomePageArticle,
  },

  data() {
    return {};
  },

  computed: {
    ...mapGetters({
      currentUser: 'currentUser',
      userId: 'currentUserId',
      token: 'currentUserToken',
    }),

    currentUserFirstName () {
      return this.currentUser ? this.currentUser.first_name : false;
    },

    isGhanaApp () {
      return config.country == 'gh';
    }
  },

  created () {
    console.log("Current User", this.currentUser);
    if (! this.currentUser) {
      console.log("Redirecting to Login!.......");
      const Login = require('./Login.vue').default;
      this.$navigateTo(Login, { clearHistory: true });
      return;
    }
  },

  mounted () {
    this.setupFirebaseCM();
    this.initialiseStore();
  },

  methods: {
    goToGHSPage() {
      this.$navigateTo(GHS);
    },
    goToCovidPage() {
      this.$navigateTo(Covid);
    },
    goToVideosPage() {
      this.$navigateTo(Videos);
    },
    goToExplorePage () {
      this.$navigateTo(Explore);
    },
    goToHealthTipsPage () {
      this.$navigateTo(HealthTips);
    },
    goToStartAQuestionPage () {
      this.$navigateTo(StartQuestion);
    },
    goToFAQPage () {
      this.$navigateTo(FAQList);
    },
    goToQuestionsPage () {
      this.$navigateTo(ChatList);
    },

    setupFirebaseCM () {
      console.log("Setting up Firebase");
      let self = this;

      firebase.init({
          showNotificationsWhenInForeground: true,
          
          onPushTokenReceivedCallback (token) {
            console.log("Push Token Received", token);
            // Register Device for a particluar user
            let data = {
              patientId: self.userId,
	            deviceType: "android",
	            regToken: token,
	            token: self.token
            }

            self.$apiServices.registerUserDevice(data)
              .then((res) => {
                let response = JSON.parse(res.content);
                console.log("Device Registered", response);
              })
              .catch((err) => {
                console.log("An error occurred while registering device");
              });
          },

          onMessageReceivedCallback (message) {
            console.log("New Push notification message received", message);

            if (! message.foreground) {
              let questionId = message.data ? message.data.questionId : null;
              if (questionId) {
                self.$navigateTo(Chat, {
                  props: {
                    questionId,
                  }
                });
              }
            }

            self.initialiseStore();
          }
        })
        .then((res) => {
          console.log("Firebase initialised!", res);
        })
        .catch((err) => {
          console.log("Error occurred while initialising Firebase", err);
        });

    },

    initialiseStore() {
      this.$store.dispatch('initialiseQuestionsInStore', {
        token: this.token,
        userId: this.userId,
      });
    }
  }
};
</script>

<style scoped>
  .welcome-header {
    background-image: url('~/src/assets/images/header-background.png');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;

    padding-top: 60pt;
    padding-bottom: 50pt;

    /* tests */
    background-color: gray;
  }
  .welcome-header .greeting {
    font-size: 25pt;
    font-weight: bold;
    margin-bottom: 20px;
  }
  .welcome-header .description {
    font-size:  16pt;
  }

  .action-label {
    text-align: center;
  }

    .header {
        padding: 10 18;
    }

    .see-all {
        padding: 0 18;
    }

    .tabs {
        font-size: 13pt;
        font-weight: bold;
        padding: 0 9;
    }

    .tabs Label {
        border-bottom-color: #686871;
        border-bottom-width: 1;
        color: #979797;
        padding-bottom: 12;
        text-align: center;
    }

    .tabs Label.active {
        border-bottom-color: #ED2567;
        border-bottom-width: 1;
        color: #ED2567;
    }

    .content {
        padding: 32 0 0 0;
    }

    .content .h1,
    .content .h2 {
        padding-left: 18;
    }

    .room-list-header {
        margin-top: 24;
    }

    .see-all {
        color: #979797;
        font-size: 10pt;
        font-weight: 600;
        text-align: right;
    }

    .rooms {
        margin-top: 18;
    }

    .room {
        padding-right: 12;
    }

    .room.first-child {
        margin-left: 18;
    }

    .room .h2 {
        padding-left: 0;
    }

    .room Image {
        border-radius: 12;
    }

    .room Label.h2 {
        color: #CE9F70;
        margin-top: 8.29;
    }

    .stars {
        margin-top: 8;
    }

    .stars Image {
        padding-right: 1.71;
    }
</style>
