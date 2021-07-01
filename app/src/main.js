import Vue from 'nativescript-vue';

import App from './components/App'
import Login from './components/Login';
import Profile from './components/Profile';
import transalations from './i18n';
import store from './store';
import services from './services';

import Theme from "@nativescript/theme";

Theme.setMode(Theme.Light);

import VueDevtools from 'nativescript-vue-devtools';
import NSVueShadow from 'nativescript-vue-shadow';
import i18next from 'i18next';
import VueI18Next from '@panter/vue-i18next';
import config from './../config';

const main = () => {
  const appName = config.appName || 'Bisa';
  const lang = config.lang || 'en';

  if (TNS_ENV !== 'production') {
    Vue.use(VueDevtools)
  }

  let i18nOptions = {
    lng: lang,
    resources: {}
  }

  i18nOptions['resources'][lang] = {
    translation: transalations[lang]
  }

  Vue.use(NSVueShadow);
  Vue.use(VueI18Next);
  i18next.init(i18nOptions);
  const i18n = new VueI18Next(i18next);

  // Prints Vue logs when --env.production is *NOT* set while building
  Vue.config.silent = (TNS_ENV === 'production')
  // Prints Colored logs when --env.production is *NOT* set while building
  Vue.config.debug = (TNS_ENV !== 'production')

  Vue.mixins = {
    methods: {
      goToPage(page) {
        let pageInstances = {};

        let pageInstace = pageInstances[page];

        if (pageInstace) {
          this.$navigateTo(pageInstace)
        }
      },

      alert(message) {
        return alert({
          title: appName,
          okButtonText: "OK",
          message: message
        });
      }
    }
  }

  Vue.registerElement(
    'Fab',
    () => require('@nstudio/nativescript-floatingactionbutton').Fab
  );
  
  Vue.registerElement(
    'PreviousNextView', 
    () => require("nativescript-iqkeyboardmanager").PreviousNextView
  )

  Vue.prototype.$config = config;
  Vue.prototype.$apiServices = services.api;

  new Vue({
    i18n,
    store,
    render: h => {
      let pageToRender;
      if (!store.getters.currentUser) {
        pageToRender = Login;
      } else {
        pageToRender = App;
      }
      return h('frame', [
        h(pageToRender)
      ])
    }
  }).$start()
};

export default main;