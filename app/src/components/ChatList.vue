<template>
  <Page class="page">
    <!-- <SharedHeader :title="$t('allYourQuestions')" 
      :show-search="false" :show-logout="false" :show-back="false"
      :flat="true" /> -->
    <ActionBar title="Chat" flat="true" show-back="false" backgroundColor="#8DC63F" color="#FFFFFF"/>
    <DockLayout class="screen" stretchLastChild="true">
      <SharedFooter current-page="chat" />

      <GridLayout rows="auto, *" dock="top">
        <ListView for="(question, questionInd) in questions" @itemTap="showChat" row="1">
          <v-template>
            <StackLayout paddingLeft="20" paddingRight="20" paddingTop="10" paddingBottom="10" class="chat">
              <GridLayout row="auto" columns="auto,*,auto">
                <Label :text="question.question_category" class="chat-category"
                  row="0" column="0" />
                <Label :text="getFormattedTimeDiff(question.created_at)"
                  class="chat-time"
                  row="0" column="2" />
              </GridLayout>
              <GridLayout columns="auto, *, auto" rows="auto" width="100%">
                <Label :text="question.question_content" 
                  fontSize="18"
                  textWrap="true"
                  row="0" column="0" />

                <Label v-if="question.unread_responses && question.unread_responses > 0"
                  :text="question.unread_responses"
                  class="chat-unread" 
                  row="0" column="2" />
              </GridLayout>
            </StackLayout>
          </v-template>
        </ListView>

        <Fab
          @tap="askAQuestion"
          row="1"
          icon="~/src/assets/icons/chat_white.png"
          backgroundColor="#8DC63F"
          rippleColor="#8DC63F"
          class="fab-button"
        ></Fab>

        <ActivityIndicator width="50" :busy="fetchingQuestions"
          row="1"
          v-if="fetchingQuestions"></ActivityIndicator>
      </GridLayout>
    </DockLayout>
  </Page>
</template>

<script>
const Vue = require("nativescript-vue");
  import moment from 'moment';
  import { mapGetters, mapActions } from 'vuex';

  import Chat from './Chat.vue';
  import Home from './App.vue';
  import StartQuestion from './StartQuestion.vue';
  import SharedFooter from './shared/Footer.vue';
  import SharedHeader from './shared/HeaderBar.vue';

  const ChatList = Vue.extend({
    components: {
      SharedFooter,
      SharedHeader
    },

    data () {
      return {
        fetchingQuestions: false,
        // questions: []
      }
    },

    computed: {
      ...mapGetters({
        token: 'currentUserToken',
        userId: 'currentUserId',
        'questions': 'questions',
      })
    },

    mounted () {
      this.refreshQuestionsInStore({
        token: this.token,
        userId: this.userId,
      })
        .then(res => this.fetchingQuestions = false)
        .catch(err => this.fetchingQuestions = false);
    },

    methods: {
      ...mapActions({
        'refreshQuestionsInStore': 'initialiseQuestionsInStore'
      }),

      askAQuestion() {
        this.$navigateTo(StartQuestion);
      },

      goToHome () {
        this.$navigateTo(Home);
      },

      showChat (event) {
        let question = event.item;
        console.log("question: ", question);
        this.$navigateTo(Chat, {
          props: {
            'questionId': question.question_id,
          }
        });
      },

      fetchQuestions () {
        this.fetchingQuestions = true;
        this.$apiServices.fetchUserQuestions(this.token, this.userId)
          .then((res) => {
            this.fetchingQuestions = false;
            console.log("Fetched Questions", res.data);
            this.questions = res.data;
          })
          .catch((err) => {
            this.fetchingQuestions = false;
            console.log("Error occurred: ", err);
          });
      },

      getFormattedTimeDiff (date) {
        let mDate = moment(date.date);
        let mNow = moment();
        let duration = mNow.diff(mDate);

        return mDate.fromNow();
      }
    }
  });

  export default ChatList;
</script>

<style scoped>
  .chat .chat-category,
  .chat .chat-time {
    /* background-color: #fed7d7; */
    border-radius: 20;
    /* color: #c53030; */
    /* font-weight: bold; */
    font-size: 10;
    /* padding: 2 15; */
    text-transform: uppercase;
  }
  .chat .chat-unread {
    background-color: red;
    border-radius: 18;
    color: white;
    width: 18;
    height: 18;
    font-size: 12;
    text-align: center;
  }
  .fab-button {
    height: 70;
    width: 70;
    margin: 15;
    background-color: #ff4081;
    
    vertical-align: bottom;
  }
</style>