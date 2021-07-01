<template>
  <Page class="page">
    <!-- <SharedHeader :title="$t('askADoctor')" 
      :show-logout="false" :show-search="false" :flat="true" /> -->

    <ActionBar title="Start Question" flat="true" show-back="true" backgroundColor="#8DC63F" color="#FFFFFF">
      <NavigationButton text="Back" android.systemIcon="ic_menu_back" @tap="onNavBtnTap"/>
    </ActionBar>
    <DockLayout class="screen" stretchLastChild="true">
      <AbsoluteLayout dock="top" marginBottom="10">
        <ScrollView stretchLastChild="true" top="0" left="0" width="100%" height="100%">
        <!-- <PreviousNextView  top="0" left="0" width="100%" height="100%"> -->
          <StackLayout>
            <StackLayout marginTop="20">
              <Label
                :text="$t('chooseACategory')"
                fontSize="18"
                fontWeight="bold"
                paddingLeft="20"
                marginBottom="10"
              />
              <ScrollView orientation="horizontal" :scrollBarIndicatorVisible="false">
                <StackLayout orientation="horizontal" height="170">
                  <StackLayout
                    v-for="(category, ind) in categories"
                    :key="ind"
                    class="category-item"
                    height="140"
                    width="120"
                    marginRight="10"
                    marginLeft="20"
                    borderRadius="10"
                    marginBottom="30"
                    v-shadow="{ elevation: 15, cornerRadius: 20 }"
                    @tap="selectedCategory(category)"
                    :backgroundColor="isSelectedCategory(category) ? 
                      '#8DC63F' : 'white'"
                  >
                    <Image
                      :src="getCategoryImage(category)"
                      stretch="fill"
                      borderRadius="15"
                      :width="getCategoryImageWidth(category)"
                      :height="getCategoryImageHeight(category)"
                      :marginTop="getCategoryImageMarginTop(category)"
                      horizontalAlignment="center"
                      verticalAlignment="top"
                    />

                    <Label
                      :text="category.category_name"
                      fontSize="17"
                      color="black"
                      verticalAlignment="bottom"
                      horizontalAlignment="center"
                      textWrap="true"
                      width="100%"
                      padding="10"
                    />
                  </StackLayout>
                </StackLayout>
              </ScrollView>
            </StackLayout>

            <GridLayout
              dock="bottom"
              columns="*,auto"
              rows="auto"
              width="100%"
              marginTop="0"
              paddingRight="10"
              paddingLeft="10"
              paddingTop="10"
            >
              <StackLayout row="0" col="0" height="120">
                <GridLayout
                  rows="95"
                  columns="*,auto"
                  width="100%"
                  v-if="!isRecording"
                  backgroundColor="#FFF"
                  borderColor="#E3E3E3"
                  borderRadius="30"
                  borderWidth="1"
                >
                  <TextView
                  multiline="true"
                  :hint="$t('enterDetailsOfQuestion')"
                  borderRadius="5"
                  marginBottom="10"
                  fontSize="15"
                  marginTop="10"
                  height="300"
                  padding="10"
                  borderWidth="1"
                  bordercolor="#E3E3E3"
                  v-shadow="{ elevation: 3 }"
                  v-model="questionDetails"
                ></TextView>
                 
                </GridLayout>
              </StackLayout>
              <StackLayout
                row="0"
                col="1"
                marginLeft="5"
                height="50"
                width="50"
                borderRadius="100%"
                backgroundColor="#8DC63F"
                verticalAlignment="top"
                paddingTop="10"
              >
                <Image
                  
                  src="~/src/assets/icons/ic_send_white_24dp.png"
                  strethc="fill"
                  height="30"
                  horizontalAlignment="center"
                  verticalAlignment="center"
                  @tap="submitQuestion"
                />
              </StackLayout>
            </GridLayout>
          </StackLayout>
        <!-- </PreviousNextView> -->
        </ScrollView>

        <ActivityIndicator top="0" left="0" width="50"
          marginLeft="48%" marginTop="48%"
          :busy="submittingQuestion"></ActivityIndicator>
      </AbsoluteLayout>
    </DockLayout>
  </Page>
</template>

<script>
const Vue = require("nativescript-vue");
let Toast = require("nativescript-toast");

import { mapGetters } from "vuex";

import config from "../../config";
import { TNSPlayer, TNSRecorder } from "nativescript-audio";
import * as backgroundHttp from "nativescript-background-http";
import * as imagePicker from "nativescript-imagepicker";


import * as sha1 from "js-sha1";
import * as timer from "tns-core-modules/timer";

import Chat from "./Chat.vue";
import Home from "./App.vue";
import SharedFooter from "./shared/Footer.vue";

const StartQuestion = Vue.extend({
  components: {
    SharedFooter,
  },

  data() {
    return {
      questionDetails: null,
      selectedCategoryId: null,
      categories: [],
      submittingQuestion: false,
      fetchingCategories: false,
      audioRecorder: null,
			isRecording: false,
			_meterInterval: null,
			audioMeter: 0,
      _player: null,
			latestAudioFileName: null,
    };
  },

  computed: {
    ...mapGetters({
      token: "currentUserToken",
      userId: "currentUserId"
    })
  },

  mounted() {
    this.fetchCategories();
    this._player = new TNSPlayer();
  },

  methods: {
    onNavBtnTap(){
        this.$navigateBack()
      },
    alert(message) {
      return alert({
        title: "Bisa",
        okButtonText: "OK",
        message: message
      });
    },

    selectedCategory(category) {
      this.selectedCategoryId = category.category_id;
    },

    isSelectedCategory(category) {
      return category.category_id == this.selectedCategoryId;
    },

    getCategoryImage(category) {
      switch (category.category_id) {
        case 1:
          return "~/src/assets/icons/children.png";
        case 2:
          return "~/src/assets/icons/sex.png";
        case 3:
          return "~/src/assets/icons/red-ribbon.png";
        case 4:
          return "~/src/assets/icons/nutrition.png";
        case 5:

        case 6:
          return "~/src/assets/icons/cat_info.png";
        case 7:
          return "~/src/assets/icons/coronavirus.png";
      }
    },

    getCategoryImageWidth(category) {
      switch (category.category_id) {
        case 1:
        case 4:
          return 60;
        case 2:
          return 50;
        case 3:
          return 30;
        case 5:
          return 30;
        default:
          return 40;
      }
    },

    getCategoryImageHeight(category) {
      switch (category.category_id) {
        case 1:
        case 4:
          return 60;
        case 2:
          return 50;
        case 7:
          return 50;
        default:
          return 40;
      }
    },

    getCategoryImageMarginTop(category) {
      switch (category.category_id) {
        case 3:
        case 5:
        case 6:
          return 20;
        default:
          return 10;
      }
    },

    goToChatPage() {
      this.$navigateTo(Chat);
    },

    goToHomePage() {
      this.$navigateTo(Home);
    },

    fetchCategories() {
      let ghana = [
        {
          "category_id": 5,
          "category_name": "General Health"
        },
        {
          "category_id": 7,
          "category_name": "Covid-19"
        },
        {
          "category_id": 1,
          "category_name": "Children Health"
        },
        {
          "category_id": 4,
          "category_name": "Nutrition"
        },
        {
          "category_id": 2,
          "category_name": "Sexual and Reproductive Health"
        },
        {
          "category_id": 3,
          "category_name": "HIV"
        },
        {
          "category_id": 6,
          "category_name": "Others"
        },
        
        
      ];

      let senegal = [
        {
          "category_id": 1,
          "category_name": "Les enfants"
        },
        {
          "category_id": 2,
          "category_name": "RLa santé reproductive"
        },
        {
          "category_id": 3,
          "category_name": "VIH / SIDA"
        },
        {
          "category_id": 4,
          "category_name": "Nutrition"
        },
        {
          "category_id": 5,
          "category_name": "Toutes les infos"
        },
        {
          "category_id": 6,
          "category_name": "Autres"
        }
      ];

      this.categories = this.$config.lang == 'en' ? ghana : senegal;

      // this.fetchingCategories = true;
      // this.$apiServices.fetchQuestionCategories(this.token)
      //   .then(res => {
      //     this.fetchingCategories = false;
      //     console.log("Categories", res.data);
      //     this.categories = res.data;
      //   })
      //   .catch(err => {
      //     this.fetchingCategories = false;
      //     console.log("Error", err);
      //   });
    },

		_initMeter() {
			this._resetMeter();
			this._meterInterval = timer.setInterval(() => {
				this.audioMeter = this.audioRecorder.getMeters();
				console.log(this.audioMeter);
			}, 300);
		},

		_resetMeter() {
			if (this._meterInterval) {
				this.audioMeter = "0";
				timer.clearInterval(this._meterInterval);
				this._meterInterval = undefined;
			}
    },

    submitQuestion() {
      if (!this.selectedCategoryId) {
        this.alert(
          this.$t('alerts.askAQuestion.categoryRequired')
        );
        return;
      }

      this.submittingQuestion = true;

      let data = {
        userId: this.userId,
        questionCategoryId: this.selectedCategoryId,
        questionContent: this.questionDetails,
        mediaUrl: "n/a",
        fileType: "n/a",
        fileExtendsion: "n/a",
        token: this.token
      };

      if (this.newReplyImage) {
				data.mediaUrl = this.newReplyImage;
        data.fileType = "image";
        data.questionContent = "Image";
			}

			if (this.newReplyAudio) {
				data.mediaUrl = this.newReplyAudio;
        data.fileType = "audio";
        data.questionContent = "Audio";
      }
      
      console.log("Data: ", data);

      this.$apiServices.submitQuestion(this.token, data)
        .then(res => {
          this.submittingQuestion = false;
          console.log("Question Submitted", response, res.data);
          let response = JSON.parse(res.content);

          if (response && response.success != true) {
            console.log("Error this is not question", response);
            let toast = Toast.makeText(
              `${this.$t('alerts.askAQuestion.anErrorOccurred')}: ${response.message}.`
            );
            toast.show();
            return false;
          }

          this.questionDetails = null;
          this.newReplyImage = null;
			    this.newReplyAudio = null;
          console.log("Question ID", response["questionId"]);
          this.$navigateTo(Chat, {
            props: {
              questionId: response.questionId
            }
          });
        })
        .catch(err => {
          this.submittingQuestion = false;
          console.log("An error occurred while submitting your question", err);

          Toast.makeText(
            this.$t('alerts.askAQuestion.anErrorOccurred') + " " +
            this.$t('alerts.askAQuestion.pleaseTryAgain')
          ).show();
        });
    }
  },

  destroyed() {
    this.audioRecorder = null;
    this._recorder = null;
    this._player = null;
  },

  watch: {
		newReplyImage(val) {
			console.log("Image value updated", val);
			if (val) {
				this.submitQuestion();
			}
		},
		newReplyAudio(val) {
			console.log("Audio value updated", val);
			if (val) {
				this.submitQuestion();
			}
		},
	},
});

export default StartQuestion;
</script>

<style scoped>
.category-item {
  text-align: center;
}
</style>
