<template>
  <DockLayout stretchLastChild="true">
    <ScrollView scrollBarIndicatorVisible="false" dock="top">
      <StackLayout>
        <StackLayout class="content">
          <StackLayout padding="20">
            <AbsoluteLayout
              v-for="(question, ind) in questions"
              :key="ind"
              height="auto"
              backgroundColor="transparent"
              width="100%"
              borderRadius="15"
              marginBottom="30"
              @tap="goToAnswer(question)"
            >
              <StackLayout
                top="0"
                left="0"
                width="100%"
                height="100%"
                borderRadius="15 10"
                paddingLeft="0"
              >
                <!-- <Label
                  :text="getFormattedTimeDiff(question.created_at)"
                  fontSize="13"
                  fontWeight="bold"
                  textWrap="true"
                  width="100%"
                /> -->
                <Label
                  :text="question.question"
                  fontSize="18"
                  textWrap="true"
                  width="100%"
                />
              </StackLayout>
            </AbsoluteLayout>
          </StackLayout>
        </StackLayout>
      </StackLayout>
    </ScrollView>
    <ActivityIndicator width="50" :busy="fetchingQuestions"></ActivityIndicator>
  </DockLayout>
</template>

<script>
import moment from 'moment';

import { mapGetters } from "vuex";

import Article from "./../Article.vue";
import FAQAnswer from "../FAQAnswer.vue";

const FAQsTab = {
  props: {
    category: {
      type: [Object],
      required: true
    }
  },

  data() {
    return {
      fetchingQuestions: false,
      questions: []
    };
  },

  computed: {
    ...mapGetters({
      token: "currentUserToken"
    })
  },

  mounted() {
    console.log("FAQ List mounted!")
    this.fetchQuestions();
  },

  methods: {
    goToAnswer(question) {
      this.$navigateTo(FAQAnswer, {
        props: {
          question
        }
      });
    },

    fetchQuestions() {
      console.log(this.category)
      if (!this.token) {
        console.log("Token missing");
        return false;
      }

      this.fetchingQuestions = true;
      this.$apiServices.fetchFAQsByCategory(this.token, this.category.cat_id)
        .then(res => {
          console.log("Questions Fetched: ", res);
          this.fetchingQuestions = false;
          this.questions = res.data;
        })
        .catch(err => {
          this.fetchingQuestions = false;
          console.log(err);
        });
    },

    getFormattedTimeDiff(date) {
      let mDate = moment(date.date);
      let mNow = moment();
      let duration = mNow.diff(mDate);

      return mDate.fromNow();
    }
  }
};

export default FAQsTab;
</script>