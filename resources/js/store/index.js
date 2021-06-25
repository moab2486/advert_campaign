import Vue from "vue";
import Vuex from "vuex"
import axios from 'axios'

Vue.use(Vuex);

const store = new Vuex.store({
    state: {
        status: '',
        error: '',
        books: {}
    },
    mutation: {
        request_status(state){
            state.status = 'loading'
        },      
        request_error(state){
            state.status = 'error'
            state.error = 'Invalid Login Credential'
        },
        get_books(state, books){
            state.status = 'status'
            state.books = books
        },
    },
    action: {
        getBooks({commit}){
            return new Promise((resolve, reject) => {
              commit('request_status')
              axios.get(`books`)
                .then(resp => {
                    const books = resp.data;
                    commit('get_books', books);
                    resolve()
                })
                .catch(err => {
                    commit('request_error')
                    reject(err)
                })
            })
        },
    }
});

export default store;