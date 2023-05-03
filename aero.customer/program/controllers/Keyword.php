<?php

class Keyword extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->obj =& get_instance();
		$this->load->helper('form');
		$this->load->library(array('allfunction'));
		$this->load->model(array('transaksi_model','sdr_model'));
		if(!$this->session->userdata('logged_in')):
		redirect('login', 'refresh');
		endif;	
	}
	
	function index()
	{
		$data=array();
		$data["form"]				= base_url()."keyword/tablerow";
		$data['view'] = $this->load->view('keywordform_views',$data,true);
        $data['extra_js'] = array('jquery-1.11.3.min.js','materialize.min.js');
		$this->allfunction->parseTemplates($data);     
		
	}
	
	function tablerow($kunci="",$kelompok="",$import=""){
		$submit         			= $this->input->post('submit');
		$keyword					= htmlentities($this->input->post('keyword'));
		$wordwrap					= htmlentities($this->input->post('keyword'));
		$group						= htmlentities($this->input->post('group'));
		$keyword					= $this->allfunction->clearkarakter($keyword);
		$data						=array();
		$data["data"]				=null;
		
		if(!empty($import)):
		$submit        			= 1;
		$keyword        		= base64_decode($kunci);
		$group        			= base64_decode($kelompok);
		endif;
		
		$karakter=strlen($keyword); //katekter saat ini saya filter minimal 4 digit
		if($submit and !empty($keyword) and $karakter>=4):
		
				if($group==1):			
							$keyword = str_replace(array("\r\n","\n"),',',$keyword);
							$cek = substr($keyword, -1);
							if($cek==","):  $keyword=substr($keyword,0,-1); endif;
							$keyword = str_replace(",","','",$keyword);
							$where	=" trnNumberAwb in ('".$keyword."') "." AND trnAccCustomer IN (".$this->session->userdata('account').")";
<<<<<<< HEAD
=======
							// $where	=" trnNumberAwb in ('".$keyword."') ";
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
				else:
													
							$where 	="( trnReffInstruction like '%".trim($keyword)."%' OR";
							$keyword = str_replace(array("\r\n","\n"),'#',trim($keyword));
							$like	=explode("#",$keyword);
							foreach ($like as $x =>$y):
							$where 	.= " trnReffInstruction LIKE '%".$y."%' OR";
							endforeach;
							
							$where	=substr($where,0,-2);
							$where	.=")";
							$where	.=" AND trnAccCustomer IN (".$this->session->userdata('account').")";
				endif;
		
		$result=$this->transaksi_model->SelectTracingWhere($where);
<<<<<<< HEAD
=======
		
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
		if ($result->num_rows() > 0) {
				if($result->num_rows() > 1):
					$data["data"]="multi";
					$data["row"]=array();
					$data["ontime"]=$data["overtime"]=$data["delay"]=0;
					$no=1;
					foreach($result->result() as $row):
						$TimePickup=null;
								$TimeOverDay=null;
								$LeadTime=0;
								if(empty($row->trnDeliveredByName)):
									$color	='color:red;font-style:italic;';
									$hari	="";
									$status	="BLANK IOD";
									$data["delay"]++;
								else:
									$hari=$this->allfunction->selisihHari($row->trnPickupDate,$row->trnDeliveredDate,$row->custSaturday);
									$LeadTime=$row->trnLeadTimeDelivery;
										if(!empty($row->custOverDayActive)):
										$TimePickup		=substr($row->trnPickupTime,0,2);
										$TimeOverDay	=substr($row->custOverDayTime,0,2);
											if($TimePickup>$TimeOverDay):
											$LeadTime++;
											endif;
										endif;
									
									if($LeadTime>=$hari):
									$color	='';
									$status =" Day # ONTIME";
									$data["ontime"]++;
									else:
									$color	='color:#ff00f0;font-weight:bold;';
									$status =" Day # FAIL";
									$data["overtime"]++;
									endif;
								endif;	
						$lastpoint		=$this->transaksi_model->GetLastCheckPoint($row->trnNumberAwb);					
						$data["row"][]=array(
								"no"					=> $no,
								"trnNumberAwb"			=> $row->trnNumberAwb,
								"trnorg"				=> $row->trnBranch,
								"trndest"				=> $row->trnDestination,
								"trnDate"				=> $row->FormatDateTable,
								"trnConsName"			=> $row->trnConsigneeName,
								"trnConsAlm1"			=> $row->trnConsigneeAlm1,
								"trnConsCity"			=> $row->trnConsigneeCity,
								"trnColi"				=> trim(number_format($row->trnActualColi,0)),
<<<<<<< HEAD
=======
								"pcs"				=> trim(number_format($row->trnsActualPcs,0)),
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
								"trnWeight"				=> trim(number_format($row->trnsActualKg,2,".","")),
								"trnTypeOfService"		=> $row->trnTypeService,
								"trnTypeOfPackage"		=> $row->trnTypePackage,
								"trnTypeVolume"			=> $row->trnTypeVolume,
								"trnDeliveredDate"		=> $row->trnDeliveredDate,
								"trnDeliveredTime"		=> $row->trnDeliveredTime,
								"trnDeliveredByName"	=> $row->trnDeliveredByName,
								"trnAcc"				=> $row->trnAccCustomer,
								"trnSpecialInstruction"	=> $row->trnSpecialInstruction,
								"trnReffInstruction"	=> $row->trnReffInstruction,
								"trnChargeInsurance"	=> $row->trnChargeInsurance,
								"trnChargePacking"		=> $row->trnChargePacking,
								"serviceLeadTime"		=> $row->trnLeadTimeDelivery,
								"style"					=> $color,
								"lastpost"				=> $lastpoint["checkHeader"],
								"informasi"				=> $hari." ".$status,
							);
							$no++;
					endforeach;
				else:
									$data["data"]="single";
									foreach($result->result() as $row):
									$awb			=$row->trnNumberAwb;
									endforeach;
									$hawb	= $this->transaksi_model->GetNoHawbNetworkCustomer($awb,$this->session->userdata('account'));
									$data["token_map"]				= $this->admin_model->GetValueParameterConfigurasiFieldValue("ParameterName","token_googlemap_".rand(1,5),"ParameterValue");
									$data["trnName"]    			= (!empty($hawb))?$hawb["trnShipperName"]:"";
									$data["trnAcc"]    				= (!empty($hawb))?$hawb["trnAccCustomer"]:"";
									$data["trnAlm1"]    		    = (!empty($hawb))?$hawb["trnShipperAlm1"]:"";
									$data["trnAlm2"]    			= (!empty($hawb))?$hawb["trnShipperAlm2"]:"";
									$data["trnAlm3"]    			= (!empty($hawb))?$hawb["trnShipperAlm3"]:"";
									$data["trnCity"]    			= (!empty($hawb))?$hawb["trnShipperCity"]:"";
									$data["trnPost"]    			= (!empty($hawb))?$hawb["trnShipperPost"]:"";
									$data["trnPhone"]    			= (!empty($hawb))?$hawb["trnShipperPhone"]:"";
									$data["trnFax"]    				= (!empty($hawb))?$hawb["trnShipperFax"]:"";
									$data["trnContact"]    			= (!empty($hawb))?$hawb["trnShipperContact"]:"";
									$data["trnReffInstruction"]  	= (!empty($hawb))?$hawb["trnReffInstruction"]:"";	
									$data["trnSpecialInstruction"]  = (!empty($hawb))?$hawb["trnSpecialInstruction"]:"";	
									$data["trnConsName"]    		= (!empty($hawb))?$hawb["trnConsigneeName"]:"";
									$data["trnConsAlm1"]    		= (!empty($hawb))?$hawb["trnConsigneeAlm1"]:"";
									$data["trnConsAlm2"]    		= (!empty($hawb))?$hawb["trnConsigneeAlm2"]:"";
									$data["trnConsAlm3"]    		= (!empty($hawb))?$hawb["trnConsigneeAlm3"]:"";
									$data["trnConsCity"]    		= (!empty($hawb))?$hawb["trnConsigneeCity"]:"";
									$data["trnConsPost"]    		= (!empty($hawb))?$hawb["trnConsigneePost"]:"";
									$data["trnConsPhone"]    		= (!empty($hawb))?$hawb["trnConsigneePhone"]:"";
									$data["trnConsFax"]    			= (!empty($hawb))?$hawb["trnConsigneeFax"]:"";
									$data["trnConsContact"]    		= (!empty($hawb))?$hawb["trnConsigneeContact"]:"";
									$data["trnDate"]    		    = (!empty($hawb))?$hawb["trnDate"]:"";
									$data["trnTypeOfPackage"]    	= (!empty($hawb))?$hawb["trnTypePackage"]:"";
									@$data["trnTypeOfService"]    	= (!empty($hawb))?$hawb["trnTypeService"]:"";
									$data["trncharge"]    			= (!empty($hawb["trncharge1stkg"]))?number_format($hawb["trnCharge1stKg"]+$hawb["trncharge1stKg"], 0, "," ,"."):0;			
									$data["trnchargeInsurance"]    	= (!empty($hawb["trnchargeInsurance"]))?number_format($hawb["trnchargeInsurance"], 0, "," ,"."):0;
									$data["trnchargePacking"]    	= (!empty($hawb["trnchargePacking"]))?number_format($hawb["trnchargePacking"], 0, "," ,"."):0;
									$data["trnchargeOthers"]    	= (!empty($hawb["trnchargeOthers"]))?number_format($hawb["trnchargeOthers"], 0, "," ,"."):0;
									$data["trnTotalCharge"]    		= (!empty($hawb["trnTotalCharge"]))?number_format($hawb["trnTotalCharge"], 0, "," ,"."):0;		
									$data["trnOrg"]    				= (!empty($hawb))?$hawb["trnShipperOrg"]:"";
									$data["trnDest"]    			= (!empty($hawb))?$hawb["trnDestination"]:"";
									$data["trnNOHAWB"]    			= (!empty($hawb))?$hawb["trnNumberAwb"]:"";
									$data["trnDim_H"]    			= (!empty($hawb))?number_format($hawb["trnDim_H"], 0, "," ,"."):"";
									$data["trnDim_W"]    			= (!empty($hawb))?number_format($hawb["trnDim_W"], 0, "," ,"."):"";
									$data["trnDim_L"]    			= (!empty($hawb))?number_format($hawb["trnDim_L"], 0, "," ,"."):"";
									$data["trnDim_V"]    			= (!empty($hawb))?number_format(($hawb["trnDim_H"]*$hawb["trnDim_W"]*$hawb["trnDim_L"])/4000, 0, "," ,"."):"";
									$data["trnWeight"]    			= (!empty($hawb))?number_format($hawb["trnWeight"], 0, "," ,"."):"";
									$data["trnPickUpbyName"]    	= (!empty($hawb))?$hawb["trnPickUpByName"]:"";
									$data["trnPickUpByNik"]    		= (!empty($hawb))?$hawb["trnPickUpByNik"]:"";
									$data["trnPickupDate"]    		= (!empty($hawb))?$hawb["trnPickupDate"]:"";
									$data["trnPickupTime"]    		= (!empty($hawb))?$hawb["trnPickupTime"]:"";
									$data["trnDeliveredByName"]    	= (!empty($hawb))?$hawb["trnDeliveredByName"]:"";
									$data["trnDeliveredByNik"]    	= (!empty($hawb))?$hawb["trnDeliveredByNik"]:"";
									$data["trnDeliveredDate"]    	= (!empty($hawb))?$hawb["trnDeliveredDate"]:"";
									$data["trnDeliveredTime"]    	= (!empty($hawb))?$hawb["trnDeliveredTime"]:"";
									$data["trnColi"]    			= (!empty($hawb))?$hawb["trnActualColi"]:0;
<<<<<<< HEAD
=======
									$data["pcs"]    				= (!empty($hawb))?$hawb["trnsActualPcs"]:0;
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
									$data["trnDeliveredByName"]    	= (!empty($hawb["sdrDeliveredByName"]))?$hawb["sdrDeliveredByName"]:$data["trnDeliveredByName"];
									$data["trnDeliveredDate"]    	= (!empty($hawb["sdrDeliveredByName"]))?$hawb["sdrDeliveredDate"]:$data["trnDeliveredDate"];
									$data["trnDeliveredTime"]    	= (!empty($hawb["sdrDeliveredByName"]))?$hawb["sdrDeliveredTime"]:$data["trnDeliveredTime"];
									$data["hawb"]					= (!empty($hawb["trnNumberAwb"]))?$hawb["trnNumberAwb"]:"";
									$data["trnLatitudeGps"]			= (!empty($hawb["trnLatitudeGps"]))?$hawb["trnLatitudeGps"]:"NoGps";
									$data["trnLongitudeGps"]		= (!empty($hawb["trnLongitudeGps"]))?$hawb["trnLongitudeGps"]:"NoGps";
									$data["accuracy"]				= (!empty($hawb["trnZoomGps"]))?$hawb["trnZoomGps"]:0;
									$data["trnTypeVolume"]    		 = (!empty($hawb))?$hawb["trnTypeVolume"]:"";
									$data["picture_data"]			= (!empty($hawb["trnNamePicture"]))?base_url().$this->config->item('dir_upload_sdr').$hawb["trnNamePicture"]:null;
									$data["signature_data"]			= (!empty($hawb["trnSignature"]))?base_url().$this->config->item('dir_upload_signature').$hawb["trnSignature"]:null;
											$data["checkpoint"]=array();
											$result			=$this->transaksi_model->SelectCheckPointTrace($data["hawb"]);
											$no=1;
											foreach($result->result() AS $row) :
															$lat			=null;
															$lng			=null;
															$view			=null;
															$notes			=null;
											
											if($row->checkHeader=="Delivery"):
												$delivery=((!empty($data["trnDeliveredByName"]))?" # ":"").$data["trnDeliveredByName"];
											else:
												$delivery=null;
											endif;
											
											if($row->checkHeader=="Booked"):
													
											elseif($row->checkHeader=="Pickup By Courier"):
													
											elseif($row->checkHeader=="Manifested" || $row->checkHeader=="ManifestShip" || $row->checkHeader=="Received at warehouse" || $row->checkHeader=="On Process"):
													
											elseif($row->checkHeader=="On delivery" || $row->checkHeader=="Departed"):
													
															if($row->checkHeader=="On delivery"):
																	$cekCoordinatSDR			=$this->transaksi_model->GetKoordinatSprCourier(array("detailAwb"=>$data["trnNOHAWB"],"masterNumber"=>$row->checkKeyword));
																		if($cekCoordinatSDR):
																				if(!empty($cekCoordinatSDR["masterTransportNumber"])):
																						$read=$this->allfunction->xmlkendaraan($cekCoordinatSDR["masterTransportNumber"]);
																						if(!empty($read["msisdn"])):
																						   $lat						=@$read["lat"];
																						   $lng						=@$read["lon"];
																						   $view					="view on map by transportasi : ".@$read["car_plate"];
																						 endif;
																				
																				elseif((!empty($cekCoordinatSDR["GpsLatitude"])) &&   (!empty($cekCoordinatSDR["GpsLongitude"]))):
																				$lat			=(!empty($cekCoordinatSDR["GpsLatitude"]))?$cekCoordinatSDR["GpsLatitude"]:null;
																				$lng			=(!empty($cekCoordinatSDR["GpsLongitude"]))?$cekCoordinatSDR["GpsLongitude"]:null;
																				$view			="view on map by courier : ".strtolower($cekCoordinatSDR["kurirFullname"])."#".$cekCoordinatSDR["kurirPhone"];
																				else:
																				$view			="view on map by null  ";
																				endif;
																		$notes	=" from : ".	$cekCoordinatSDR["masterGroupBranch"];	
																		endif;		
															endif;				
											elseif($row->checkHeader=="DeliveryByUpload" || $row->checkHeader=="Shipment delivered" || $row->checkHeader=="POD Return"):
													if($row->checkHeader=="Shipment delivered"):
															$lat			=$data["trnLatitudeGps"];
															$lng			=$data["trnLongitudeGps"];
															$view			=(!empty($data["accuracy"]))?"view on map delivery":"";
													endif;
													
											else:
													
											endif;

											$data["checkpoint"][]=array(
																	"no"			=>$no,
																	"header"		=>$row->checkHeader." ".$notes,
																	"status"		=>$row->checkStatus,
<<<<<<< HEAD
																	"remarks"		=>$row->checkRemarks,
=======
																	"remarks"		=>ucwords(strtolower($row->checkRemarksKA)),
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
																	"keyword"		=>$row->checkKeyword,
																	"stampdate"		=>$row->stampdate,
																	"stamptime"		=>$row->stamptime,
																	"gpslat"		=>$lat,
																	"gpslng"		=>$lng,
																	"gpsview"		=>$view);
<<<<<<< HEAD
=======

											if($row->checkCode =='DF'){
												$no++;
												$this->load->library('cargofunction');
												$api = $this->cargofunction->tracking($hawb['trnSmuNumber']);
												
												$flightdown="";
												if(!empty($api->checkHeader))
												{
													if($row->checkStampuser=="cresa"){
														
													}else{
														$this->load->model('mobile/admin_model');
														$apidetail = $this->cargofunction->trackingDetail($hawb['trnSmuNumber'],$hawb["trnNumberAwb"]);
														if(!empty($apidetail)){
															foreach($apidetail as $carg){
																$valuecode=$this->admin_model->GetValueParameterConfigurasiFieldValue("ParameterCode",$carg->checkStatusCF,"ParameterValue");
																$flightdown .=$valuecode."-".trim(strtoupper(strtolower($carg->checkFlightNo))).'-'.trim($carg->checkStampdate)."<br/> ";
														}
													}
												}}

												$data["checkpoint"][] = array(
													"no" => $no,
													"header" => "Flight",
													"status" => ($hawb["trnAccCustomer"]=="10020010280"?"Yeay! Paket Kamu sedang diterbangkan ke tujuan pengiriman Kamu":$flightdown), //"",
													"remarks" =>($hawb["trnAccCustomer"]=="10020010280"?"Yeay! Paket Kamu sedang diterbangkan ke tujuan pengiriman Kamu":$flightdown),
													"keyword" => ($hawb["trnAccCustomer"]=="10020010280"?$row->checkKeyword:$hawb['trnSmuNumber']),// ,
													"stampdate"		=>substr($row->checkStampdate,0,10),
													"stamptime"		=>substr($row->checkStampdate,-8),
													"gpslat"		=>$lat,
													"gpslng"		=>$lng,
													"gpsview"		=>$view
												);
												
											}				
											
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
											
											$data["TracingLast"]	=$row->checkHeader." ".$row->checkStampdate;
											$no++;
											endforeach;
								endif;

		} else {
			$data["data"]=null;
		}					

		
		if($data["data"]=="multi"):
			$data['export']				= base_url()."keyword/tablerow/".base64_encode($wordwrap)."/".base64_encode($group)."/true";
				if(empty($import)):
							$data['extra_js'] 			= array('jquery-1.11.3.min.js','materialize.min.js','footable.min.js','footable.filter.min.js','footable.paginate.min.js','footable-loader.js');
							$data['extra_css'] 			= array('footable.min.css');
							$data['view']				= $this->load->view('keywordmulti_views',$data,true); 
				else:
							$data["convert"]			=$import;
							$data["namafile"]			="Export_".date("YmdHis").".xls";
							$data['view']				= $this->load->view('keywordmulti_views',$data);
        $data['extra_js'] = array('jquery-1.11.3.min.js','materialize.min.js');
				endif;
		elseif($data["data"]=="single"):
			$data['view']				= $this->load->view('keywordsingle_views',$data,true); 	
        $data['extra_js'] = array('jquery-1.11.3.min.js','materialize.min.js');
		endif;		
		
		
		else:
			$data["form"]				= base_url()."keyword/tablerow";
			$data['view'] = $this->load->view('keywordform_views',$data,true);
			$data['extra_js'] = array('jquery-1.11.3.min.js','materialize.min.js');
		endif;	
		
		if(empty($import)):
		$this->allfunction->parseTemplates($data);  
		endif;	
		
		
	}
	
	
	
	
}

?>