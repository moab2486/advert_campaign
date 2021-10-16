<script>
    import Table from './TableComponent';
    import {mapState} from 'vuex'
    export default {
        name: 'dataTable',
        components: {
          Table,
        },
        data(){
          return{
           title: "Advertising campaign"
          }
        },
        created(){
          this.$store.dispatch("getCampaign");
        },
        computed:{
          ...mapState({
            campaigns: (state) => state.campaigns,
            showModal: (state) => state.showModal,
            showCreatives: (state) => state.showCreatives,
          })
        },
        methods:{
          closeModal(){
            var showModal = false
            this.$store.dispatch("modalTrigger", showModal)
          }
        }
    }
</script>

<template>
  <div>
    <div class="pt-2 pb-2">
      <h1 class="text-font">{{ title }}</h1>
    </div>

    <Table :campaign-data='campaigns'/>

    <b-modal v-model="showModal" size="lg" hide-header hide-footer title="Campaign creatives" no-close-on-backdrop>
      <font-awesome-icon icon="times-circle" id="icon-font" class="text-danger" @click="closeModal"/>

      <div v-if="showCreatives.length < 1" class="text-center mt-5">
        No creatives found
      </div>

      <div class="gallery mt-5" v-else>
         <div v-for="creatives in JSON.parse(showCreatives)" :key="creatives.id" >
           <img :src="'/uploads/'+creatives" :alt="creatives" class="gallery_img" />
         </div>
      </div>
    </b-modal>
  </div>
</template>

<style scoped>
  .gallery {
    display: grid;
    grid-template-columns: repeat(3, 3fr);
    grid-gap: 15px;
  }

  .gallery_img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  #icon-font{
    position: absolute;
    margin-top: -30px;
    margin-left: -30px

  }
</style>