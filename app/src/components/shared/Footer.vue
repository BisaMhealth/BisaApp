<template>
  <GridLayout
    class="bottom-tabs"
    columns="*,*,*,*"
    height="70"
    orientation="horizontal"
    dock="bottom"
  >
    <StackLayout row="0" col="0" class="footer-item"
      @tap="goToHome">
      <Image height="25"
        src="~/src/assets/icons/outline_home_black_24dp.png" />
      <Label :text="$t('home')" fontSize="15" />
    </StackLayout>
    <StackLayout row="0" col="1" class="footer-item"
      @tap="goToChatList">
      <AbsoluteLayout>
        <GridLayout columns="*,auto,*" top="0" left="0"
          width="100%">
          <Image height="20" marginBottom="4" marginTop="1"
            row="0" col="1"
            src="~/src/assets/icons/chat.png"/>
        </GridLayout>

        <Label v-if="unreadMessagesCount && unreadMessagesCount > 0"
          :text="unreadMessagesCount" backgroundColor="red" borderRadius="18"
          width="18" height="18" fontSize="11" color="white"
          marginLeft="50" />
      </AbsoluteLayout>
      <Label :text="$t('chats')" fontSize="15" />
    </StackLayout>
    <StackLayout row="0" col="2" class="footer-item"
      @tap="goToHealthTips">
      <Image height="20" marginBottom="4" marginTop="1"
        src="~/src/assets/icons/health.png"/>
      <Label :text="$t('tips')" fontSize="15" />
    </StackLayout>
    <StackLayout row="0" col="3" class="footer-item"
      @tap="goToProfile">
      <Image height="25"
        src="~/src/assets/icons/ic_person_outline_black_24dp.png"/>
      <Label :text="$t('profile')" fontSize="15" />
    </StackLayout>
  </GridLayout>
</template>

<script>
import { mapGetters } from 'vuex';

const SharedFooterComponent = {
  name: 'SharedFooterComponent',

  props: {
    currentPage: {
      type: String,
      required: false
    }
  },

  data () {
    return {}
  },

  computed: {
    ...mapGetters({
      'unreadMessagesCount': 'currentUserUnreadMessages',
    }),
  },

  methods: {
    goToHome () {
      console.log("Going to home!");
      if (this.currentPage == 'home') {
        return false;
      }
      
      let Home = require('../App.vue').default;
      this.$navigateTo(Home);
    },

    goToChatList () {
      console.log("Going to chatlist!");
      if (this.currentPage == 'chat') {
        return false;
      }

      console.log('here')
      let ChatList = require('../ChatList.vue').default;
      console.log('here here')
      this.$navigateTo(ChatList);
    },

    goToHealthTips () {
      console.log("Going to health tips!");
      if (this.currentPage == 'healthTips') {
        return false;
      }

      let HealthTipsPage = require('../HealthTips.vue').default;
      this.$navigateTo(HealthTipsPage);
    },

    goToProfile () {
      console.log("Going to profile!");
      if (this.currentPage == 'profile') {
        return false;
      }

      let Profile = require('../Profile.vue').default;
      this.$navigateTo(Profile);
    }
  }
}

export default SharedFooterComponent;
</script>

<style scoped>
.bottom-tabs {
    padding-top: 10;
}
.footer-item {
  text-align: center;
}
</style>