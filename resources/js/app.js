window.Vue = require('vue').default;

require('./bootstrap');
import { BootstrapVue } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)

import vueRouter from 'vue-router';
Vue.use(vueRouter);

import routes from './router/route';
const router = new vueRouter({
    routes,
    mode: 'history'
});

import store from './store/index';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faEye, faEdit, faArrowAltCircleLeft, faPlus, faTimesCircle } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(faEye, faEdit, faArrowAltCircleLeft, faPlus, faTimesCircle);
Vue.component('font-awesome-icon', FontAwesomeIcon)

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

import axios from 'axios';
axios.defaults.baseURL = "http://advert_campaign.test/api/";

Vue.component('app-component', require('./components/AppComponent.vue').default);

const app = new Vue({
    el: '#app',
    store,
    router,
});
