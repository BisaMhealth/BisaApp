<template>
  <Page>
    <!-- <SharedHeader
      :title="$t('ghanaHealthService')"
      :show-logout="false"
      :show-search="false"
      :flat="true"
    /> -->

  <ActionBar title="Ghana Health Service" flat="true" show-back="false" backgroundColor="#8DC63F" color="#FFFFFF"/>

    <DockLayout class="screen" stretchLastChild="true">
      <SharedFooter />

      <ScrollView dock="top">
        <StackLayout padding="20">
          <Label
            textWrap="true"
            fontSize="18"
            text="The Ghana Health Service (GHS) is an autonomous Executive Agency responsible for implementation of national policies under the control of the Minister for Health through its governing Council - the Ghana Health Service Council."
          />

          <Label
            :text="$t('contacts')"
            marginTop="50"
            fontSize="20"
            fontWeight="bold"
            textAlignment="left"
            width="100%"
          />

          <GridLayout columns="*,auto,*" rows="auto"
            @tap="callNumber('112')">
            <Label
              :text="`${$t('emergency')} :`"
              fontSize="18"
              marginTop="20"
              horizontalAlignment="left"
              row="0"
              column="0"
            />
            <Label
              text="112"
              fontSize="20"
              fontWeight="bold"
              marginTop="20"
              horizontalAlignment="right"
              row="0"
              column="2"
            />
          </GridLayout>

          <GridLayout columns="*,auto,*" rows="auto"
            @tap="callNumber('311')">
            <Label
              :text="`${$t('generalInformation')} :`"
              fontSize="18"
              marginTop="20"
              horizontalAlignment="left"
              row="0"
              column="0"
            />
            <Label
              text="311"
              fontSize="20"
              fontWeight="bold"
              marginTop="20"
              horizontalAlignment="right"
              row="0"
              column="2"
            />
          </GridLayout>

          <GridLayout columns="*,auto,*" rows="auto"
            @tap="callNumber('0307011419')">
            <Label
              :text="`${$t('hotline')} :`"
              fontSize="18"
              marginTop="20"
              horizontalAlignment="left"
              row="0"
              column="0"
            />
            <Label
              text="0307 011 419"
              fontSize="20"
              fontWeight="bold"
              marginTop="20"
              horizontalAlignment="right"
              row="0"
              column="2"
            />
          </GridLayout>

          <StackLayout marginTop="60" marginLeft="0" marginRight="0">
            <SharedHomePageArticle :title="$t('recentArticlesFromGHS')" endpoint="8"></SharedHomePageArticle>
          </StackLayout>
        </StackLayout>
      </ScrollView>
    </DockLayout>
  </Page>
</template>

<script>
import moment from "moment";
import { mapGetters } from "vuex";

let phone = require("nativescript-phone");

import Chat from "./Chat.vue";
import Home from "./App.vue";
import SharedHeader from "./shared/HeaderBar.vue";
import SharedFooter from "./shared/Footer.vue";
import SharedHomePageArticle from "./shared/HomePageArticleTile.vue";
import TabFAQs from "./tabs/FAQs.vue";

const FAQList = {
  components: {
    SharedHeader,
    SharedFooter,
    SharedHomePageArticle,
    TabFAQs
  },

  data() {
    return {
      categories: [
        {
          cat_id: 8,
          cat_name: this.$t("general"),
          slug: "general"
        }
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
  },

  methods: {
    callNumber(numberToCall) {
      console.log("Calling number")
      // Convert Number to string
      numberToCall = numberToCall.toString();

      phone.dial(numberToCall, true);
      return;
    }
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