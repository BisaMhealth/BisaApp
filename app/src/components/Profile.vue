<template>
  <Page class="page">
    <!-- <SharedHeader :title="userFullName"
      :show-logout="true"
      :show-search="false" /> -->
    
    <ActionBar
    backgroundColor="#8DC63F" color="#FFFFFF"
    :title="userFullName">
    <ActionItem
      @tap="logout"
      text="Logout"
      ios.position="right"
      android.position="right"
      color="#FFFFFF"
    ></ActionItem>
  </ActionBar>

    <DockLayout class="screen" stretchLastChild="true">
      <SharedFooter current-page="profile" show-search="false" />

      <ScrollView dock="top" scrollBarIndicatorVisible="false">
        <StackLayout orientation="vertical">
          <StackLayout marginTop="30">
            <Image :src="currentUserImage"
              width="80" height="80"
              borderRadius="80" />

            <GridLayout columns="3*,auto,*" rows="auto, auto, auto"
              paddingLeft="20" paddingRight="20">
              <StackLayout row="0" column="0">
                <Label :text="$t('username')" fontSize="12" marginTop="20"
                  horizontalAlignment="left" />
                <Label :text="user && user.username ? user.username : 'N/A'" fontSize="16" fontWeight="bold"
                  horizontalAlignment="left" />
              </StackLayout>

              <StackLayout row="0" column="2">
                <Label :text="$t('gender')" fontSize="12" marginTop="20"
                  horizontalAlignment="right" />
                <Label :text="user && user.gender ? user.gender : 'N/A'" fontSize="16" fontWeight="bold"
                  horizontalAlignment="right" />
              </StackLayout>

              <StackLayout row="1" column="0">
                <Label :text="$t('email')" fontSize="12" marginTop="20"
                  horizontalAlignment="left" />
                <Label :text="user && user.email ? user.email : 'N/A'" fontSize="16" fontWeight="bold"
                  horizontalAlignment="left" />
              </StackLayout>

              <StackLayout row="2" column="0">
                <Label :text="$t('location')" fontSize="12" marginTop="20"
                  horizontalAlignment="left" />
                <Label :text="user && user.address ? user.address : 'N/A'" fontSize="16" fontWeight="bold"
                  horizontalAlignment="left" />
              </StackLayout>
            </GridLayout>

            <GridLayout columns="*,auto,*" rows="auto, auto,auto"
              paddingLeft="20" paddingRight="20">
              <StackLayout row="0" column="0">
                <Label :text="$t('weight')" fontSize="12" marginTop="20"
                  horizontalAlignment="left" />
                <StackLayout orientation="horizontal">
                  <Label :text="user && user.weight ? user.weight : 'N/A'" fontSize="16" fontWeight="bold"
                    horizontalAlignment="left" />
                  <Label text="(Edit)" fontSize="16" fontWeight="normal"
                    marginLeft="30"
                    horizontalAlignment="left"
                    @tap="editWieght" />
                </StackLayout>
              </StackLayout>

              <StackLayout row="0" column="2">
                <Label :text="$t('height')" fontSize="12" marginTop="20"
                  horizontalAlignment="right" />
                <StackLayout orientation="horizontal"
                  horizontalAlignment="right">
                  <Label text="(Edit)" fontSize="16" fontWeight="normal"
                    marginRight="30"
                    horizontalAlignment="left"
                    @tap="editHeight" />
                  <Label :text="user && user.height ? user.height : 'N/A'" fontSize="16" fontWeight="bold"
                    />
                </StackLayout>
              </StackLayout>

              <StackLayout row="1" column="0">
                <Label :text="$t('bloodGroup')" fontSize="12" marginTop="20"
                  horizontalAlignment="left" />
                <StackLayout orientation="horizontal">
                  <Label :text="user && user.blood_group ? user.blood_group : 'N/A'" fontSize="16" fontWeight="bold"
                    horizontalAlignment="left" />
                  <Label text="(Edit)" fontSize="16" fontWeight="normal"
                    marginLeft="30"
                    horizontalAlignment="left"
                    @tap="editBloodType" />
                </StackLayout>
              </StackLayout>

              <StackLayout row="2" column="0" colspan="2">
                <Label :text="$t('knownCodition')" fontSize="12" marginTop="20"
                  horizontalAlignment="left" />
                <StackLayout orientation="horizontal">
                  <Label :text="user && user.known_condition ? user.known_condition : 'N/A'"
                    fontSize="16" fontWeight="bold"
                    horizontalAlignment="left" />
                </StackLayout>
              </StackLayout>
            </GridLayout>

            <GridLayout columns="*,auto,*" rows="auto"
              paddingLeft="20" paddingRight="20"
              marginTop="70">
              <Label :text="$t('version')" fontSize="16"
                marginTop="20"
                horizontalAlignment="left" row="0" column="0" />
              <Label text="0.2.21" fontSize="16" fontWeight="bold"
                marginTop="20"
                horizontalAlignment="right" row="0" column="2" />
            </GridLayout>
          </StackLayout>
        </StackLayout>
      </ScrollView>
    </DockLayout>
  </Page>
</template>

<script>
const Dialogs = require("tns-core-modules/ui/dialogs");
import { mapGetters } from 'vuex';

import Login from './Login';
import SharedFooter from './shared/Footer.vue';
// import SharedHeader from './shared/HeaderBar.vue';

const Profile = {
  components: {
    SharedFooter,
    // SharedHeader,
  },

  data () {
    return {}
  },

  computed: {
    ...mapGetters({
      user: 'currentUser',
      userFullName: 'currentUserFullName'
    }),

    currentUserImage() {
      return (this.user && this.user.thumbnail) ?
        this.user.thumbnail : '~/src/assets/icons/user.png';
    }
  },

  methods: {
    logout () {
      console.log("Logout a user");
      this.$store.dispatch('unsetUser')
        .then((res) => {
          this.$navigateTo(Login);
        })
        .catch((err) => {
          console.log("An error occured:", err);
        });
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

    editBloodType() {
      this.selectDialog('blood_group', {
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

    editHeight() {
      prompt({
        title: this.$t('height'),
        message: this.$t('enterHeight'),
        inputType: "number",
        defaultText: "",
        okButtonText: this.$t('ok'),
        cancelButtonText: this.$t('cancel')
      }).then(data => {
        if (data.result) {
          let user = this.user;
          user.height = data.text;
          this.$store.dispatch('updateUser', user);
        }
      })
      .catch((err) => {
        console.log("An error occurred: ", err);
      });
    },

    editWieght() {
      prompt({
        title: this.$t('weight'),
        message: this.$t('enterWeight'),
        inputType: "number",
        defaultText: "",
        okButtonText: this.$t('ok'),
        cancelButtonText: this.$t('cancel')
      }).then(data => {
        if (data.result) {
          let user = this.user;
          user.weight = data.text;
          this.$store.dispatch('updateUser', user);
        }
      })
      .catch((err) => {
        console.log("An error occurred: ", err);
      });
    },

  }
};

export default Profile;
</script>

<style scoped>
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
