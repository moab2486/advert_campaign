require('./bootstrap');

window.Vue = require('vue').default;

import store from './store/index';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faChevronDown } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faChevronDown);

Vue.component('font-awesome-icon', FontAwesomeIcon)

import axios from 'axios';
axios.defaults.baseURL = "http://127.0.0.1:8000/api/";

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    store,
});
