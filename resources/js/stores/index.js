'use strict'
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    is_login:false
  },
  mutations: {
    async authenticated(state){
      console.log('fffffffff');
      state.is_login = true;
    }
  },
  getters: {
    layout (state) {
      return state.layout
    },
    checkLogin(state){
      return state.is_login;
    }
  }
})