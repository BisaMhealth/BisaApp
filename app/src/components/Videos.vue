<template>
  <Page>
    <!-- <SharedHeader :title="$t('videos')"
      :show-logout="false" :show-search="false"
      :flat="true" /> -->
    <ActionBar title="Videos" flat="true" :show-back="false" backgroundColor="#8DC63F" color="#FFFFFF"/>

    <DockLayout class="screen" stretchLastChild="true">
      <SharedFooter />

      <GridLayout rows="auto,*" dock="top">
        <ScrollView row="1" class="content" height="100%">
          <StackLayout height="100%">
            <WebView ref="webvie" height="100%" />
          </StackLayout>
        </ScrollView>

        <Fab
          @tap="askAQuestion"
          row="1"
          icon="~/src/assets/icons/chat_white.png"
          backgroundColor="#8DC63F"
          rippleColor="#8DC63F"
          class="fab-button"
        ></Fab>

        <ActivityIndicator width="50" :busy="loadingVideos"
          row="1"
          v-if="loadingVideos"></ActivityIndicator>
      </GridLayout>
    </DockLayout>
  </Page>
</template>

<script>
import { isIOS, isAndroid } from 'tns-core-modules/platform';
import moment from "moment";
import { mapGetters } from "vuex";
import * as WebViewInterface from 'nativescript-webview-interface'

let oWebViewInterface;

import Chat from "./Chat.vue";
import Home from "./App.vue";
import SharedHeader from "./shared/HeaderBar.vue";
import SharedFooter from "./shared/Footer.vue";
import TabFAQs from "./tabs/FAQs.vue";
import StartQuestion from './StartQuestion.vue';

const Videos = {
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
      ],
      loadingVideos: false,
      videos: []
    };
  },

  computed: {
    ...mapGetters({
      token: "currentUserToken",
      userId: "currentUserId"
    })
  },

  created() {
    this.fetchVideos();
  },

  methods: {
    askAQuestion() {
      this.$navigateTo(StartQuestion);
    },

    fetchVideos() {
      this.$apiServices.fetchVideos(this.token)
        .then(res => {
          console.log("Fetched Videos", res.data);

          this.videos = res.data;

          this.setupWebViewInterface();
        })
        .catch(err => {
          console.log("Error occurred: ", err);
        });
    },

    setupWebViewInterface() {
      this.loadingVideos = true;
      let webView = this.$refs.webvie.nativeView;
      console.log("WebView", webView)
      oWebViewInterface = new WebViewInterface.WebViewInterface(webView, '~/src/files/youtube.html');
      webView.on('loadFinished', (args) => {
          if (!args.error) {
            // emit event to webView or call JS function of webView
            console.log("Webview loaded!")
            this.emitEventToWebView();
            this.handleEventFromWebView();
          }
      });
    },

    emitEventToWebView(){
      oWebViewInterface.emit('show-videos', this.videos);
    },

    handleEventFromWebView() {
      oWebViewInterface.on('videos-loaded', (eventData) => {
        this.loadingVideos = false;
      })
    }
  }
};

export default Videos;
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