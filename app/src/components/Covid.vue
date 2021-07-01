<template>
   <Page>
      <!-- <SharedHeader :title="$t('covid19')"
         :show-logout="false" :show-search="false"
         :flat="true" /> -->
      <ActionBar title="Covid-19" flat="true" :show-back="true" backgroundColor="#8DC63F" color="#FFFFFF">
        
      </ActionBar>

      <DockLayout class="content" stretchLastChild="true">
         <SharedFooter />

         <ScrollView dock="top">
            <StackLayout >
               
              <WebView ref="covid" height="550" />
              <Label
                text="Source: Ghana Health Service"
                fontSize="18"
                marginLeft="5"
                fontWeight="bold"
                marginTop="12"
                textWrap="true"
              />
              <Label
                @tap="openLink()"
                class="source"
                marginLeft="5"
                text="https://ghanahealthservice.org/covid19/"
                fontSize="15"
                marginTop="7"
                textWrap="true"
                marginBottom="20"
                textDecoration="underline"
              />
              <SharedHomePageArticle marginTop="15" marginLeft="5" :title="$t('articlesOnCovid19')" endpoint="9"></SharedHomePageArticle>
               
            </StackLayout>
            
         </ScrollView>
      </DockLayout>
   </Page>
</template>

<script >
const Vue = require("nativescript-vue");

import { Utils } from "@nativescript/core";
import { mapGetters } from "vuex";
import SharedFooter from "./shared/Footer.vue";
import SharedHeader from "./shared/HeaderBar.vue";

import * as WebViewInterface from 'nativescript-webview-interface'
import SharedHomePageArticle from "./shared/HomePageArticleTile.vue";
import {WebView, LoadEventData} from "tns-core-modules/ui/web-view";

let oWebViewInterface;

const Covid =  {
   components: {
    SharedFooter,
    SharedHeader,
    SharedHomePageArticle
  },

  data() {
    return {
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

  created() {
   //   this.setupWebViewInterface()
   // this.pageLoaded
   this.fetchVideos()
  },

  computed: {
    ...mapGetters({
      token: "currentUserToken",
      userId: "currentUserId"
    })
  },

  methods: {
    openLink(){
      Utils.openUrl("https://ghanahealthservice.org/covid19")
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
      let webView = this.$refs.covid.nativeView
      console.log("WebView", webView)
      oWebViewInterface = new WebViewInterface.WebViewInterface(webView, '<iframe style="width: 100%; height: 100%; overflow: hidden;" scroll="no" src="https://ghanahealth.maps.arcgis.com/apps/opsdashboard/index.html#/2acce23387f24cfbb8b9efe76a93e1f7"></iframe>');
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

export default Covid;
</script>

<style scoped>

.source {
    color: rgb(78, 78, 220);
}
</style>