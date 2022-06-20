// import Vue from "vue";
// import VueAxios from "vue-axios";
import axios from 'axios'
// import VueConfirmDialog from 'vue-confirm-dialog'
// import Notifications from 'vue-notification'
// import Vuex from "vuex";

window._ = require('lodash');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Content-Type'] = 'application/json';
//
// window.Vue = require('vue');
//
// Vue.use(Notifications)
// Vue.use(Vuex)
//
// Vue.use(VueAxios, axios)
// Vue.use(VueConfirmDialog)
// Vue.component('vue-confirm-dialog', VueConfirmDialog.default)

