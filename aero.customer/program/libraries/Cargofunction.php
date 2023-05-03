<?php

class Cargofunction
{
    public function __construct() {
        $this->obj =& get_instance();
        // $this->obj->load->model(array('client_model'));
        $this->obj->load->helper('form');
        $this->obj->load->helper('html');
    }

    function tracking($awb,$connote="",$type="")
    {
        if(empty($awb))
        {
            return '';
        }
        $curlFirstHandler = curl_init();

        curl_setopt_array($curlFirstHandler, [
            CURLOPT_URL => 'https://carly.garuda-indonesia.com:8243/token',
            CURLOPT_RETURNTRANSFER => true,

            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
            CURLOPT_HTTPHEADER => [
                //'Authorization: Basic ' . base64_encode($userName . ':' . $password)
                'Authorization: Basic eVdPbGNSTkZCRFF0cUpzQW5NWGlyVWlQbTdBYTp2d29TSlZTNHN5UjhKSklYODJHZUQwa2xIRDhh'
            ],
        ]);

        $response = curl_exec($curlFirstHandler);
        curl_close($curlFirstHandler);

        $response = json_decode($response);

//        echo '<pre>';
//        print_r($response);
//        echo '</pre>';

        $curlSecondHandler = curl_init();

        $params = explode('-',$awb);

        if(!empty($params[0]) && !empty($params[1]))
        {
            $postdata = array("awbNo" => $params[1],"carrierCode" => $params[0]);
        }
        else
        {
            return '';
        }

//
//        echo '<pre>';
//        print_r($postdata);
//        echo '</pre>';

        $postvars = '';
        foreach($postdata as $key=>$value) {
            $postvars .= $key . "=" . $value . "&";
        }

        curl_setopt($curlSecondHandler, CURLOPT_URL, 'https://carly.garuda-indonesia.com:8243/t/cargo.ga/cargo/v.1.0/trackingStatus');
        curl_setopt($curlSecondHandler, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curlSecondHandler, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlSecondHandler, CURLOPT_POST, 1);
        curl_setopt($curlSecondHandler, CURLOPT_POSTFIELDS, $postvars);
        curl_setopt($curlSecondHandler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlSecondHandler, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt($curlSecondHandler, CURLOPT_HTTPHEADER, array(
            'application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $response->access_token
        ));

        $response = curl_exec($curlSecondHandler);
        curl_close($curlSecondHandler);

        $response = json_decode($response);

        if(empty($response[0]->Table0))
        {
            return '';
        }

//        echo '<pre>';
//        print_r($response);
//        //print_r($response[0]->Table0);
//        echo '</pre>';

        $mapping = array('BKD'=>'Booking Confirmed','EXE'=>'Booking Executed','RCS'=>'Shipment Accepted','PRE'=>'Pre-manifested','MAN'=>'Manifested','DEP'=>'Departed','ARR'=>'Arrived','RCF'=>'Received From Flight');

        if($type=='detail')
        {
            $count = 0;
            $return = array();
            
            foreach($response[0]->Table0 as $info)
            {
                $return[$count] = new stdClass();
                $return[$count]->checkHeader = 'PROCESS';
                $return[$count]->checkCode = 'FL';
                $return[$count]->checkStatus = 'Flight';
                $return[$count]->checkFlightNo = $info->FlightNo;
                $return[$count]->checkFlightDate = $info->FlightDate;
                $return[$count]->checkOrigin = $info->Origin;
                $return[$count]->checkDestination = $info->Destination;
                $return[$count]->checkPieces = $info->Pieces;
                $return[$count]->checkWeight = $info->ChargeableWeight;
                $return[$count]->checkBranch = $info->Origin;
                // $return[$count]->checkStatus = $mapping[$info->AWBStatus];
                $return[$count]->checkStatusCF = $info->AWBStatus;
                $return[$count]->checkKeyword = $info->TrackAWBNo;
                $return[$count]->checkStampuser = substr($info->UpdatedUser,0,11);
                $return[$count]->checkStampdate = date('Y-m-d H:i:s',strtotime(substr($info->UpdatedUser,-20)));
                $count++;
            }
        }
        else
        {
            $return = new stdClass();
            foreach($response[0]->Table0 as $info)
            {
                $return->checkHeader = 'PROCESS';
                $return->checkCode = 'FL';
                $return->checkStatus = 'Flight';
                $return->checkBranch = $info->Origin;
                // $return->checkStatus = $mapping[$info->AWBStatus];
                $return->checkRemarks = ' (<a href="'.site_url('default/tools/cfcargo?awb='.$awb.'&connote='.$connote).'">'.$info->TrackAWBNo.'</a>) - '.$info->AWBStatus.'';
                $return->checkKeyword = $info->TrackAWBNo;
                $return->checkStampuser = substr($info->UpdatedUser,0,11);
                $return->checkStampdate = date('Y-m-d H:i:s',strtotime(substr($info->UpdatedUser,-20)));
            }
        }

//        echo '<pre>';
//        print_r($return);
//        echo '</pre>';

        return $return;
    }
    function trackingDetail($awb,$connote)
    {
        return $this->tracking($awb,$connote,'detail');
    }   
    
}
