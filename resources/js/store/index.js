import Vue from "vue";
import Vuex from "vuex"
import axios from 'axios'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        status: '',
        error: '',
        campaigns: {},
        editCapaignData: {},
        formTitle: '',
        showCreatives: [],
        showModal: false,
    },
    mutations: {
        request_status(state){
            state.status = 'loading'
        },      
        request_error(state){
            state.status = 'error'
            state.error = 'Invalid Login Credential'
        },
        get_campaign(state, campaign){
            state.status = 'status'
            state.campaigns = campaign
        },
        create_campaign_button(state, val){
            state.formTitle = val
        },
        edit_campaign_button(state, val){
            state.editCapaignData = val
        },
        show_campaign_creatives(state, val){
            state.showCreatives = val
        },
        trigger_modal(state, val){
            state.showModal = val
        },
    },
    actions: {
        getCampaign({commit}){
            return new Promise((resolve, reject) => {
              commit('request_status')
              axios.get(`retrive_campaigns`)
                .then(resp => {
                    const campaign = resp.data.data;
                    commit('get_campaign', campaign);
                    resolve()
                })
                .catch(err => {
                    commit('request_error')
                    reject(err)
                })
            })
        },

        createOrUpdateCampaign({commit}, campaignData){
            return new Promise((resolve, reject) => {
              commit('request_status')
              axios({url:`submit_advert_campaign`, data:campaignData,  method: 'post',
                  headers:{
                    'Content-Type': 'multipart/form-data'
                  } 
              })
                .then(resp => {
                    const campaign = resp.data.data;
                    commit('get_campaign', campaign);
                    resolve()
                })
                .catch(err => {
                    commit('request_error')
                    reject(err)
                })
            })
        },

        createCamapaign({commit}, val){
            commit("create_campaign_button", val)
        },

        editCampaign({commit}, val){
            val.formTitle = "Edit campaign"
            commit("edit_campaign_button", val)
        },

        showCampaignCreatives({commit}, val){
            commit("show_campaign_creatives", val)
        },

        modalTrigger({commit}, val){
            commit("trigger_modal", val)
        },
    }
});

export default store;