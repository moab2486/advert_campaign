<script>
  export default {
    props:{
        campaignData: [Array, Object]
    },

    data(){
        return{
            pageSize:5,
            currentPage:1
        }
    },

    computed:{
      tableData(){
        return this.campaignData.filter((row, index) => {
          let start = (this.currentPage-1)*this.pageSize;
          let end = this.currentPage*this.pageSize;
          if(index >= start && index < end) return true;
        });
      }
    },

    methods:{
        showCreatives(el){
            var showModal = true
            this.$store.dispatch("showCampaignCreatives", el.data.advert_creatives_path)
            this.$store.dispatch("modalTrigger", showModal)
        },

        editCampaign(el){
            this.$store.dispatch("editCampaign", el.data)
            .then(()=>{
                this.$router.replace('/campaign-form')
            })
        },

        nextPage(){
           if((this.currentPage*this.pageSize) < this.campaigns.length) this.currentPage++;
        },

        prevPage(){
          if(this.currentPage > 1) this.currentPage--;
        }
    }
  }
</script>

<template>
  <div>
      <table class="table table-striped table-hover table-sm">
          <thead class="table-bordered">
              <tr>
                <td rowspan="2" class="text-center align-middle">S/N</td>
                <td rowspan="2" class="text-center align-middle">Name</td>
                <td colspan="2" class="text-center">Advert period</td>
                <td rowspan="2" class="text-center align-middle">Daily budget</td>
                <td rowspan="2" class="text-center align-middle">Total budget</td>
                <td rowspan="2" class="text-center align-middle">Action</td>
              </tr>

            <tr>
                <td class="text-center">From</td>
                <td class="text-center">To</td>
            </tr>
          </thead>

          <tbody>
            <tr v-if="campaignData.length < 1">
                <td colspan="7" class="text-center">No available advertising campaign record(s) found</td>
            </tr>
            <tr v-for="(campaign, index) in tableData" :key="index" v-else>
                <td class="text-center">{{index+1}}</td>
                <td class="text-center">{{campaign.data.advert_name}}</td>
                <td class="text-center">{{campaign.data.advert_date_from}}</td>
                <td class="text-center">{{campaign.data.advert_date_to}}</td>
                <td class="text-center">{{campaign.data.daily_advert_budget}}</td>
                <td class="text-center">{{campaign.data.total_advert_budget}} </td>
                <td class="text-center">
                    <button class="btn icon-btn" @click="showCreatives(campaign)">
                        <font-awesome-icon icon="eye" />
                    </button>

                    <button class="btn icon-btn" @click="editCampaign(campaign)">
                        <font-awesome-icon icon="edit" />
                    </button>
                </td>
            </tr>
          </tbody>
      </table>

      <div class="d-flex align-items-end flex-column">
        <div>
            <label @click="prevPage" class="paginate-btn">Prev</label>
            <label class="paginate">{{currentPage}}</label>
            <label @click="nextPage" class="paginate-btn">Next</label>
        </div>
      </div>
  </div>
</template>

<style>
    .icon-btn{
        background: #8823a8;
        color: white;
    }

    
    .paginate-btn{
        width: 50px;
        color: #fff;
        background: #8823a8;
        padding: 3px;
        text-align: center;
        border-radius: 5px;
    }
    .paginate-btn:hover{
        background: #b4afb6;
    }
</style>