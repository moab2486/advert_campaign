<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvertisingCampaign;
use App\Models\AdvertCreative;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\ReadResource;

class advertisingCampaignController extends Controller
{
    /**
     * create or edit advertising campaign.
     *
     * @param  \Illuminate\Http\Request $request
     * @return Array
     */
    public function submitCampaign(Request $request){
        $this->validate($request, [
            'advert_name' => 'required',
            'advert_date_from' => 'required',
            'advert_date_to' => 'required',
            'daily_advert_budget' => 'required',
            'total_advert_budget' => 'required',
        ]);

        if($request->advert_id){
            try {
                $advert_id = $request->advert_id;

                $data = $request->all();

                $update_advertising_campaign = AdvertisingCampaign::find($advert_id);

                $update_advertising_campaign->update([
                    'advert_name' => $data['advert_name'],
                    'advert_date_from' => $data['advert_date_from'],
                    'advert_date_to' => $data['advert_date_to'],
                    'daily_advert_budget' => $data['daily_advert_budget'],
                    'total_advert_budget' => $data['total_advert_budget']
                ]);

                $this->advertsing_campaign_creatives($data['advert_creatives_path'], $advert_id);
            
                $update_advertising_campaign->status_code = 201;
                $update_advertising_campaign->message = "sucessFully updated";

                return new ResponseResource($update_advertising_campaign);
            }
            catch (Exception $e) {
                return false;
            }
        }else{
            try {
                $create_advertising_campaign = new AdvertisingCampaign;

                $data = $request->all();
                
                $create_advertising_campaign->advert_name = $request->input("advert_name");
                $create_advertising_campaign->advert_date_from = $request->input("advert_date_from");
                $create_advertising_campaign->advert_date_to = $request->input("advert_date_to");
                $create_advertising_campaign->daily_advert_budget = $request->input("daily_advert_budget");
                $create_advertising_campaign->total_advert_budget = $request->input("total_advert_budget");
                    
                $create_advertising_campaign->save();

                $this->advertsing_campaign_creatives($data['advert_creatives_path'], $create_advertising_campaign->id);

                $create_advertising_campaign->status_code = 201;
                $create_advertising_campaign->message = "sucessFully created";

            
                return new ResponseResource($create_advertising_campaign);
            }
            catch (Exception $e) {
                return false;
            }
        }
    }

    /**
     * Retrive all advertising campaign
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return Array
     */
    public function retriveCampaigns(Request $request){
        $get_advertising_campaign = AdvertisingCampaign::orderBy('id', 'DESC')->get();
        
        return ReadResource::collection($get_advertising_campaign);
    }


    /**
     * upload advertsing campaign creatives.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function advertsing_campaign_creatives($filesToBeUplooaded, $advert_id)
    {   
        if (! \File::isDirectory(public_path('uploads'))) {
            \File::makeDirectory(public_path('uploads'), 0777, true, true);
        }

        $files = [];

        foreach($filesToBeUplooaded as $file)
        {
            if(gettype($file) === 'string'){
                array_push($files, $file);
            }else{
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path().'/uploads/', $name);
                array_push($files, $name);
            }
        }
        

        $update_advertising_campaign = AdvertisingCampaign::find($advert_id);

        $update_advertising_campaign->update([
            'advert_creatives_path' => json_encode($files),
        ]);
    }

}
