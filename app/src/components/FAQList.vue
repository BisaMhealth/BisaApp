<template>
  <Page>
    <SharedHeader :title="$t('mostPopularQuestions')"
      :show-logout="false" :show-search="false"
      :flat="true" />

    <DockLayout class="screen" stretchLastChild="true">
      <SharedFooter />


      <GridLayout rows="auto,*" dock="top">
        <TabFAQs v-if="isIOS" 
          row="1"
          :category="categories[0]"></TabFAQs>
        
        <TabView v-if="isAndroid"
          row="1"
          tabBackgroundColor="#8DC63F"
          tabTextColor="#FFFFFF"
          selectedTabTextColor="#FFFFFF"
          androidSelectedTabHighlightColor="white"
        >
          <TabViewItem
            v-for="category in categories"
            :key="category.cat_id"
            :title="category.cat_name"
          >
            <TabFAQs :category="category"></TabFAQs>
          </TabViewItem>
        </TabView>

        <Fab
          @tap="askAQuestion"
          row="1"
          icon="~/src/assets/icons/chat_white.png"
          backgroundColor="#8DC63F"
          rippleColor="#8DC63F"
          class="fab-button"
        ></Fab>
      </GridLayout>
    </DockLayout>
  </Page>
</template>

<script>
import { isIOS, isAndroid } from 'tns-core-modules/platform';
import moment from "moment";
import { mapGetters } from "vuex";

import Chat from "./Chat.vue";
import Home from "./App.vue";
import SharedHeader from "./shared/HeaderBar.vue";
import SharedFooter from "./shared/Footer.vue";
import TabFAQs from "./tabs/FAQs.vue";
import StartQuestion from './StartQuestion.vue';

const FAQList = {
  components: {
    SharedHeader,
    SharedFooter,
    TabFAQs,
  },

  data() {
    return {
      isIOS,
      isAndroid,
      categories: [
        {
          cat_id: 1,
          cat_name:this.$t('general'),
          slug: "general"
        },
        // {
        //   cat_id: 2,
        //   cat_name:this.$t('others'),
        //   slug: "Others"
        // }
      ],
      questions: []
    };
  },

  computed: {
    ...mapGetters({
      token: "currentUserToken",
      userId: "currentUserId"
    })
  },

  created() {
    // this.fetchQuestions();
  },

  methods: {
    askAQuestion() {
      this.$navigateTo(StartQuestion);
    },

    fetchQuestions() {
      this.$apiServices.fetchPopularQuestions(this.token)
        .then(res => {
          console.log("Fetched Questions", res.data);

          this.questions = res.data;
        })
        .catch(err => {
          console.log("Error occurred: ", err);
        });
    },
  }
};

export default FAQList;
</script>

<style scoped>
.chat .chat-category,
.chat .chat-time {
  /* background-color: #fed7d7; */
  border-radius: 20;
  /* color: #c53030; */
  font-weight: bold;
  font-size: 14;
  /* padding: 2 15; */
  text-transform: uppercase;
}
</style>