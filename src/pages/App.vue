<template>
  <div>
    <router-view :key="$route.fullPath"></router-view>
  </div>
</template>

<script>

import store from "../store";
export default {
  mounted() {
    if (store.getters.isLoggedIn && this.$route.path == "/") {
      this.$router.push("/dashboard"); // redirect to home, for example
    }
  },
};
</script>

