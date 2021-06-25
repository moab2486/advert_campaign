require('./bootstrap');

window.Vue = require('vue').default;

import store from './store/index';

import axios from 'axios';
axios.defaults.baseURL = "http://127.0.0.1:8000/api/books";

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    store,
});
