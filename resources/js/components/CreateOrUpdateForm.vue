<script>
import {mapState} from 'vuex'
export default {
    props:{
        campaigns: Array
    },

    data(){
        return {
            campaign: {
                advert_name: "",
                advert_date_from: null,
                advert_date_to: null,
                daily_advert_budget: null,
                total_advert_budget: null,
                advert_creatives_path: []
            },
        }
    },

    created(){
       this.editFileCampaign()
    },

    computed:{
        ...mapState({
            FileDataToBeEditted: (state) => state.editCapaignData,
            form_title: (state) => state.formTitle
        }),

        editValue(){
            return this.FileDataToBeEditted;
        }
    },

    methods:{
        saveCampaign(){
            if(this.campaign.advert_name == "" || this.campaign.advert_date_from == null || this.campaign.advert_date_to == null || this.campaign.daily_advert_budget == "" || this.campaign.total_advert_budget == null || this.campaign.advert_creatives_path.length < 1){
                this.errorAlert()
            }else{
              let formData = new FormData()
              this.campaign.advert_creatives_path.forEach((el, idx) => {
                if(this.campaign.edit){
                    formData.append(`advert_creatives_path[${idx}]`, el)
                }else{
                    formData.append(`advert_creatives_path[${idx}]`, el.file)
                }
              });
              if(this.campaign.edit){
                formData.append('advert_id', this.campaign.advert_id);
              }
              formData.append('advert_name', this.campaign.advert_name);
              formData.append('advert_date_from', this.campaign.advert_date_from);
              formData.append('advert_date_to', this.campaign.advert_date_to);
              formData.append('daily_advert_budget', this.campaign.daily_advert_budget);
              formData.append('total_advert_budget', this.campaign.total_advert_budget);

              this.$store.dispatch("createOrUpdateCampaign", formData)
              .then(()=>{
                this.clearCampaignForm();
                this.successAlert()
                this.$store.dispatch("getCampaign")
              })
            }

        },

        successAlert(){
           this.$swal({
            toast: true,
            title: 'Success!',
            text: 'successfully',
            timer: 2000,
            icon: 'success',
            position: 'top-right',
            animation: true,
            timerProgressBar: true,
            showConfirmButton: false,
           });
        },

        errorAlert(){
           this.$swal({
            toast: true,
            title: 'Error!',
            text: 'Fill all fields',
            timer: 2500,
            icon: 'error',
            position: 'top-right',
            animation: true,
            timerProgressBar: true,
            showConfirmButton: false,
           });
        },

        back(){
            this.clearCampaignForm()
            this.$router.replace('/')
        },

        uploadFile(e){
            var i = 0;
            while(i < e.target.files.length){
                this.campaign.advert_creatives_path.push({
                    "file": e.target.files[i]
                }) 

                i++
            }
        },

        editFileCampaign(){
            if(this.editValue.id != undefined){
               this.campaign.edit = true,
               this.campaign.titleHide = false
               this.campaign.formTitle = this.editValue.formTitle,
               this.campaign.advert_id = this.editValue.id,
               this.campaign.advert_name = this.editValue.advert_name,
               this.campaign.advert_date_from = this.editValue.advert_date_from,
               this.campaign.advert_date_to = this.editValue.advert_date_to,
               this.campaign.daily_advert_budget = this.editValue.daily_advert_budget,
               this.campaign.total_advert_budget = this.editValue.total_advert_budget,
               this.campaign.advert_creatives_path = JSON.parse(this.editValue.advert_creatives_path)
            }
        },

        clearCampaignForm(){
            this.campaign.advert_id = null,
            this.campaign.advert_name = "",
            this.campaign.advert_date_from = null,
            this.campaign.advert_date_to = null,
            this.campaign.daily_advert_budget = null,
            this.campaign.total_advert_budget = null,
            this.campaign.advert_creatives_path = []
            if(this.campaign.edit){
                this.$store.dispatch("clearEditState");
                this.$router.replace('/');
            }
        }
    }
}
</script>

<template>
    <div>
        <div class="d-flex justify-content-between align-middle pt-2 pb-2">
            <div>
                <font-awesome-icon
                    icon="arrow-alt-circle-left"
                    id="icon-font"
                    @click="back"
                />
            </div>
            <div>
                <h1 class="text-font">{{ campaign.formTitle }}</h1>
                <h1 class="text-font">{{ form_title.formTitle }}</h1>
            </div>
        </div>
        <form>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Advert name</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control"
                        v-model="campaign.advert_name"
                    />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label"
                    >Advert period from</label
                >
                <div class="col-sm-10">
                    <input
                        type="date"
                        class="form-control"
                        v-model="campaign.advert_date_from"
                    />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Advert period to</label>
                <div class="col-sm-10">
                    <input
                        type="date"
                        class="form-control"
                        v-model="campaign.advert_date_to"
                    />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Daily budget</label>
                <div class="input-group col-sm-10">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        v-model="campaign.daily_advert_budget"
                    />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Total budget</label>
                <div class="input-group col-sm-10">
                    <div class="input-group-prepend">
                        <div class="input-group-text">$</div>
                    </div>
                    <input
                        type="nuber"
                        step="0.01"
                        class="form-control"
                        v-model="campaign.total_advert_budget"
                    />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2">Upload creatives</label>
                <div class="col-sm-10">
                    <input
                        type="file"
                        multiple
                        class="form-control"
                        id="customFile"
                        @change="uploadFile($event)"
                    />
                </div>
            </div>

            <div class="form-group d-flex align-items-end flex-column">
                <div>
                    <button class="btn icon-btn" @click.prevent="saveCampaign">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<style>
.text-font,
#icon-font {
    font-size: 24pt;
}

#icon-font {
    color: #bf78d5;
}
</style>
