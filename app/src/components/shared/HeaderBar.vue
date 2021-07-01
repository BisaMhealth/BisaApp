<template>
  <ActionBar ref="actionBar"
    backgroundColor="#8DC63F" color="#FFFFFF"
    :title="title">
    <ActionItem v-if="showLogout"
      @tap="logout"
      text="Logout"
      ios.position="right"
      android.position="right"
      color="#FFFFFF"
    ></ActionItem>
  </ActionBar>
</template>

<script>
  import { isIOS } from 'tns-core-modules/platform';
  import Login from './../Login.vue';
  
  const HeaderBar = {
    props: {
      title: {
        type: String,
        required: true
      },
      showLogout: {
        type: Boolean,
        required: false,
        default: false
      },
      showSearch: {
        type: Boolean,
        required: false,
        default: false
      },
      showUploadImage: {
        type: Boolean,
        required: false,
        default: false
      },
      showRecordAudio: {
        type: Boolean,
        required: false,
        default: false
      },
      // flat
    },

    data () {
      return {}
    },

    mounted () {
      if (isIOS) {
        // console.log("ActionBar Ref", this.$refs.actionBar);
        if (this.$refs.actionBar) {
          // this.$refs.actionBar.nativeView.ios.prefersLargeTitles = true;
        }
      }
    },

    methods: {
      search() {

      },

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

      uploadImage() {
        this.$emit('upload-image')
      },

      recordAudio() {
        this.$emit('record-audio')
      }
    }
  }

  export default HeaderBar;
</script>
