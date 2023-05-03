<?php

class Tracing extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->obj =& get_instance();
		$this->load->helper('form');
		$this->load->model(array('transaksi_model'));
		if(!$this->session->userdata('logged_in')):
		redirect('login', 'refresh');
		endif;	
	}
	
	function index()
	{
		$data=array();
		
		$ListAccount[1]					='-- All Account --';
		$result=$this->transaksi_model->SelectCustomerWhere("custAcc in (".$this->session->userdata('account').")");
		
		foreach($result->result() as $row):
			$ListAccount[$row->custAcc] 	= strtoupper(trim($row->custName));
		endforeach;
		
		$data["form"]					= base_url()."tracing/tablerow";
		$data["ListAccount"]			= $ListAccount;
		$data["ListDelivery"]			=array(
										0=>"All Case",
										1=>"On Time",
										2=>"Fail",
										3=>"Progress",
										4=>"Overdue"
										);
		$data['view'] = $this->load->view('tracingform_views',$data,true);
        $data['extra_js'] = array('jquery-1.11.3.min.js','materialize.min.js');
		$this->allfunction->parseTemplates($data);
   
		
	}
	
	
	function tablerow($nama="",$account="",$start="",$end="",$select="",$import=""){
		$submit         		= $this->input->post('submit');
		$name_form        		= htmlentities($this->input->post('name_form'));
		$account_form        	= htmlentities($this->input->post('account_form'));
		$select_form        	= htmlentities($this->input->post('select_form'));
		$start_form        		= date("Y-m-d",strtotime(htmlentities($this->input->post('tanggal1'))));
		$end_form        		= date("Y-m-d",strtotime(htmlentities($this->input->post('tanggal2'))));
		
		$moda					=array();
		
		if(!empty($import)):
		$name_form        		= base64_decode($nama);
		$account_form        	= str_replace("'","",base64_decode($account));
		$start_form        		= base64_decode($start);
		$end_form        		= base64_decode($end);
		$select_form        	= base64_decode($select);
		endif;
		
		$data["kategori"]		= $select_form;
		$kategori				= $select_form;
		$start	= explode("-",$start_form);
		$end	= explode("-",$end_form);
	
		$data=array();
		$no=1;
		if($account_form==1):
							$account_form		=$this->session->userdata('account');
		else:				
							$account_form		="'".str_replace(",","','",$account_form)."'";
		endif;	
		$data["row"]=array();
		$data["ontime"]=$data["overtime"]=$data["delay"]=$data["overdue"]=$data["progress"]=0;
		$result=$this->transaksi_model->SelectTracingWhere("trnAccCustomer in (".$account_form.") AND trnDate between '".$start_form."' and '".$end_form."'");
		foreach($result->result() as $row):
								$KategoriDelivery=null;
								$TimePickup=null;
								$TimeOverDay=null;
								$LeadTime=0;
											if(empty($row->trnDeliveredByName)):
												$hari=$this->allfunction->selisihHari($row->trnPickupDate,date("Y-m-d"),$row->custSaturday);
												$LeadTime=$row->trnLeadTimeDelivery;
													if(!empty($row->custOverDayActive)):
													$TimePickup		=substr($row->trnPickupTime,0,2);
													$TimeOverDay	=substr($row->custOverDayTime,0,2);
														if($TimePickup>$TimeOverDay):
														$LeadTime++;
														endif;
													endif;
												$color	='color:red;font-style:italic;';
												if(empty($LeadTime)): //jika lead time 0, dianggap BLANK LT
												$KategoriDelivery=3;
												$status ="BLANKSLA";
												$data["progress"]++;
												elseif($LeadTime>=$hari):
												$KategoriDelivery=3;
												$status ="PROGRESS";
												$data["progress"]++;
												else:
												$KategoriDelivery=4;	
												$status ="OVERDUE";
												$data["overdue"]++;
												endif;
												$hari='';
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
												
												if(empty($LeadTime)): //jika lead time 0, dianggap sukesee
												$KategoriDelivery=1;
												$color	='';
												$status =" Day # ONTIME";
												$data["ontime"]++;
												elseif($LeadTime>=$hari):
												$KategoriDelivery=1;
												$color	='';
												$status =" Day # ONTIME";
												$data["ontime"]++;
												else:
												$KategoriDelivery=2;
												$color	='color:#ff00f0;font-weight:bold;';
												$status =" Day # FAIL";
												$data["overtime"]++;
												endif;
											endif;	
				$lastpoint		=$this->transaksi_model->GetLastCheckPoint($row->trnNumberAwb);			
				if($kategori==0)$KategoriDelivery=0;							
				if($kategori==$KategoriDelivery):
				$data["row"][]=array(
								"no"					=> $no,
								"trnNumberAwb"			=> $row->trnNumberAwb,
								"trnorg"				=> $row->trnBranch,
								"trndest"				=> $row->trnDestination,
								"trnDate"				=> $row->FormatDateTable,
								"trnConsName"			=> $row->trnConsigneeName,
								"trnConsAlm1"			=> $row->trnConsigneeAlm1,
								"trnConsCity"			=> $row->trnConsigneeCity,
<<<<<<< HEAD
=======
								"pcs"				=> trim(number_format($row->trnsActualPcs,0)),
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
								"trnColi"				=> trim(number_format($row->trnActualColi,0)),
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
								"trnPriceAll"			=> $row->trnTotalAllRevisi,
								"style"					=> $color,
								"lastpost"				=> $lastpoint["checkHeader"],
								"informasi"				=> $hari." ".$status,
								"kategori"				=> $KategoriDelivery
				);
				$no++;
				$moda[$row->trnTypeVolume][]=1;
				endif;
		endforeach;
		
		$start	= explode("-",$start_form);
		$end	= explode("-",$end_form);
		$data["nomor_account"]		= str_replace(array("'"),"",$account_form);
					//$data["name_account"]		= $name_form;
					$data["name_account"]=null;
					$result			=$this->transaksi_model->SelectMasterCustomerCaseActive(array("custAcc"=>str_replace(",","','",$data["nomor_account"])));
					foreach($result->result() as $row):
					$data["name_account"]	.=$row->custName." ,";
					endforeach;
					$data["name_account"]	=substr($data["name_account"],0,-1);
		
		
		
		$data["start"]				= $start_form;
		$data["end"]				= $end_form ;
		$data['export']				= base_url()."tracing/tablerow/".base64_encode($name_form)."/".base64_encode($account_form)."/".base64_encode($start_form)."/".base64_encode($end_form)."/".base64_encode($select_form)."/true/";
		$data["moda"]				=$moda;
		if(!empty($import)):
		$data["namafile"]			="Export_".$data["start"]."_s/d_".$data["end"].".xls";
		$data['view']				= $this->load->view('tracingexport_views',$data); 
		else:
		$data['extra_js'] 			= array('jquery-1.11.3.min.js','materialize.min.js','footable.min.js','footable.filter.min.js','footable.paginate.min.js','footable-loader.js');
		$data['extra_css'] 			= array('footable.min.css');
		$data['view']				= $this->load->view('tracinggrid_views',$data,true); 
		$this->allfunction->parseTemplates($data);
		endif;
     
	
	}
	
	
	
	function posdata($kode=""){
		$kode	=(!empty($_REQUEST["kode"]))?$_REQUEST["kode"] :$kode;
		
		$param=$this->transaksi_model->GetCustomerWhere("custAcc in (".$kode.")");
		$kode=(!empty($kode))?$kode:"ALL ACCOUNT";
		$csacc=(!empty($kode))?$kode:"ALL ACCOUNT";
		$nama=(!empty($param))?$param["custName"]:"ALL ACCOUNT";
		
		header("content-type: text/xml");
		echo "
		<xmlresponse>
		<data>$kode</data>
		<data>$csacc</data>
		<data>$nama</data>
		</xmlresponse>
		";
	}
	
}

?>