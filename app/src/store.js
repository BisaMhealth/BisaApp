import Vue from 'vue';
import Vuex from 'vuex';

import NSVuexPersistent from 'nativescript-vuex-persistent';

import APIService from './services/api/index.js';

Vue.use(Vuex);

export default new Vuex.Store({
  plugins: [
    NSVuexPersistent([
      'auth'
    ])
  ],

  state: {
    auth: {
      user: null
    },
    questions: [],
  },

  getters: {
    currentUser (state) {
      return state.auth.user;
    },

    currentUserToken (state) {
      return state.auth.user ?
        state.auth.user.token : false;
    },

    currentUserId (state) {
      return state.auth.user ?
        state.auth.user.user_id : false;
    },

    currentUsername (state) {
      return state.auth.user ?
        state.auth.user.username : false;
    },

    currentUserFullName (state) {
      return state.auth.user ?
        [ state.auth.user.first_name, state.auth.user.last_name ].join(' ')
        : false;
    },

    currentUserUnreadMessages(state) {
      return state.questions.reduce((accumulator, question) => {
        return accumulator + question.unread_responses;
      }, 0);
    },

    questions(state) {
      return state.questions;
    }
  },

  mutations: {
    UPDATE_USER (state, userPayload) {
      console.log("Updating user", userPayload);
      state.auth.user = userPayload;
    },

    SET_QUESTIONS (state, questions) {
      state.questions = questions;
    }
  },

  actions: {
    updateUser({ commit }, userPayload) {
      commit('UPDATE_USER', userPayload);

      APIService.updateUser(userPayload);
    },

    updateUserCovid({ commit }, userPayload) {
      commit('UPDATE_USER', userPayload);
    },

    unsetUser({ commit }) {
      return new Promise((resolve, reject) => {
        commit('UPDATE_USER', null);
        resolve(true);
      });
    },

    setQuestions({ commit }, questions) {
      commit('SET_QUESTIONS', questions);
    },

    initialiseQuestionsInStore({ commit }, payload) {
      return new Promise((resolve, reject) => {
        APIService.fetchUserQuestions(payload.token, payload.userId)
          .then((res) => {
            console.log("Response", res);
            if (res.data) {
              commit('SET_QUESTIONS', res.data);
              resolve(true);
            }
          })
          .catch((err) => {
            console.log("Error", err);
            reject(err);
          })
      });
    },
  }
});
