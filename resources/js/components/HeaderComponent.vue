<script>
export default{
    name: 'headbar',
    data(){
        return{
            value:{
                formTitle: 'Create new campaign'
            }
        }
    },
    methods: {
        createCampaign(){
            this.$store.dispatch("createCamapaign", this.value)
            .then(()=>{
                this.$router.replace('/campaign-form')
            })
        }
    }
}
</script>


<template>
  <div class="headBar">
      <div class="d-flex justify-content-between">
          <h1>Welcome</h1>
          <button class="btn btn-color btn-width" @click="createCampaign">
              <font-awesome-icon icon="plus" /> Create campaign
          </button>
      </div>
  </div>
</template>

<style scoped>
    .btn-color{
        background: #bf78d5;
        color: #fff;
    }

    
</style>