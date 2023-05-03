<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    function __construct() 
	{
		parent::__construct();
        $this->DB 				= $this->load->database('default', true);
        $this->NAME_DB			= 'dbaerotrace.';
		$this->NAME_DBSYS		= 'dbaerosystem.';
    }
    
   function SelectCustomerWhere($where)    
    {
		$_query = "SELECT SQL_NO_CACHE * FROM ".$this->NAME_DB."mastercust 
				  WHERE ".$where."  ORDER BY custName asc";	
		//die($_query);			
    	return $this->DB->query($_query);	
    }
	
	function SelectGetCustomerWhere($where)    
    {
		$_query = "SELECT SQL_NO_CACHE * FROM ".$this->NAME_DB."mastercust 
				  WHERE ".$where."  ORDER BY custName asc";	
		//die($_query);			
    	return $this->DB->query($_query);	
    }
	
	function GetCustomerWhere($where)    
    {
		$_query = "SELECT SQL_NO_CACHE * FROM ".$this->NAME_DB."mastercust 
				  WHERE ".$where."  ORDER BY custName asc";	
		$query = $this->DB->query($_query);
        return $query->row_array();
    }
	
	function SelectTracingWhere($where)    
    {
		$_query = "SELECT SQL_NO_CACHE a.*, 
		DATE_FORMAT(trnDate, '%m/%d/%Y') as DateTrans,
		DATE_FORMAT(trnPickupDate, '%m/%d/%Y') as DatePickup,
		DATE_FORMAT(trnDeliveredDate, '%m/%d/%Y') as DateDelivery,
		DATE_FORMAT(trnDate,'%W, %b %d, %Y') AS date,
		b.direcCityName as kota_pengirim,
		c.direcCityName as kota_penerima,
		d.serviceName as namaservice,
		e.deliveryName as namapaket,
		f.paymentName as namapayment,
		g.group_name as NameBranch,
		h.group_name as NameDest,
		b.direcGroupCity as GroupCityOrg,
		c.direcGroupCity as GroupCityDest,
		i.custSaturday,
		i.custWeightActual,
		i.custWeightRound,
		i.custOverDayActive,
		i.custOverDayTime,
		DATE_FORMAT(trnDate, '%e-%b-%Y') as FormatDateTable
		FROM ".$this->NAME_DB."traceheaderhawb a
		LEFT JOIN ".$this->NAME_DB."masterdirectory b on a.trnShipperOrg=b.direcCode
		LEFT JOIN ".$this->NAME_DB."masterdirectory c on a.trnConsigneeDest=c.direcCode
		LEFT JOIN ".$this->NAME_DB."mastertypeservice d on a.trnTypeService=d.serviceField
		LEFT JOIN ".$this->NAME_DB."mastertypedelivery e on a.trnTypePackage=e.deliveryField
		LEFT JOIN ".$this->NAME_DB."mastertypepayment f on a.trnTypePayment=f.paymentField
		LEFT JOIN ".$this->NAME_DBSYS."app_group_trace g on a.trnBranch=g.group_field
		LEFT JOIN ".$this->NAME_DBSYS."app_group_trace h on a.trnDestination=h.group_field
		LEFT JOIN ".$this->NAME_DB."mastercust i ON a.trnAccCustomer=i.CustAcc	
					WHERE ".$where."
					GROUP BY trnNumberAwb
					order by trnDate,trnNumberAwb";	
		//die($_query);
    	return $this->DB->query($_query);	
    }
	function GetNoHawbNetworkCustomer($hawb,$account)    
    {
		$_query = "SELECT SQL_NO_CACHE *,date_format(trnDate,'%d-%M-%Y') AS trnDate FROM ".$this->NAME_DB."traceheaderhawb WHERE trnNumberAwb = '".$hawb."' and trnAccCustomer in (".$account.")";
    	$query = $this->DB->query($_query);
        return $query->row_array();
    	
    }
<<<<<<< HEAD
=======

	function GetNoHawbNetworkNonCustomer($hawb)    
    {
		$_query = "SELECT SQL_NO_CACHE *,date_format(trnDate,'%d-%M-%Y') AS trnDate FROM ".$this->NAME_DB."traceheaderhawb WHERE trnNumberAwb = '".$hawb."'";
    	$query = $this->DB->query($_query);
        return $query->row_array();
    	
    }
>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
	
	function GetNoHawbNetworkRefCustomer($hawb,$account)    
    {
		$_query = "SELECT SQL_NO_CACHE *,date_format(trnDate,'%d-%M-%Y') AS trnDate FROM ".$this->NAME_DB."traceheaderhawb WHERE trnReffInstruction = '".trim($hawb)."' and trnAccCustomer in (".$account.") LIMIT 1";
		$query = $this->DB->query($_query);
        return $query->row_array();
    	
    }
	
	function SelectCheckPointTrace($number){
		  $_query = "SELECT SQL_NO_CACHE a.*,group_name,date_format(checkStampdate,'%d-%b-%Y') AS stampdate,date_format(checkStampdate,'%H:%i:%s') AS stamptime  FROM ".$this->NAME_DB."tracecheckpointhawb
					a LEFT JOIN ".$this->NAME_DBSYS."app_group_trace b ON a.checkBranch=b.group_field
					WHERE checkNumberAwb='".$number."'
					ORDER BY checkId asc";
    	  return $this->DB->query($_query);
	}
	
	function SelectMasterCalendarCaseWhere($arraydata=""){
		  $where="";
		  if($arraydata):
		  $where=" WHERE 1";		
		  foreach($arraydata as $field=>$value):
				if(!empty($value)):
				$where .=" AND ".$field." IN ('".$value."')";
				endif;
		  endforeach;
		  endif;
		  $_query = "SELECT SQL_NO_CACHE *,DATE_FORMAT(CalendarDate, '%d %b %Y') as tanggal,
		  DATE_FORMAT(CalendarDate, '%Y-%m-%d') as periode
		  FROM ".$this->NAME_DB."mastercalendar ".$where." ORDER BY CalendarDate Asc";	
	  
		  return $this->DB->query($_query);
	}
	
	function SelectTraceHeaderPeriodeGroupDestination($periode1,$periode2,$arraydata="",$GroupBy=""){
		$where		=null;	
		if($arraydata):
				foreach($arraydata as $field=>$value):
				if(!empty($value)):
				$where .=" AND ".$field." IN ('".$value."')";
				endif;
		  endforeach;
		 endif;
		  $_query = "SELECT SQL_NO_CACHE count(1) as total,".$GroupBy." as groupby
					FROM ".$this->NAME_DB."traceheaderhawb
					a
					LEFT JOIN ".$this->NAME_DBSYS."app_group_trace h on a.trnDestinationHub=h.group_field
					WHERE DATE_FORMAT(trnDate, '%Y-%m-%d') BETWEEN '".$periode1."' AND '".$periode2."' AND trnVoidFlag=0 ".$where." GROUP BY ".$GroupBy;
			//die($_query);
			return $this->DB->query($_query);
	}	
	
	function SelectTraceHeaderPeriode($periode1,$periode2,$void="",$kondisi="",$otherfield=""){
			if(empty($void)) $where =" AND trnVoidFlag=0";
			else			 $where =" AND trnVoidFlag=1";
			$_query = "SELECT SQL_NO_CACHE *,DATE_FORMAT(trnDate, '%e-%b-%Y') as FormatDateTable,
					DATE_FORMAT(trnPickupDate, '%e-%b-%Y') as FormatDatePickup,
					DATE_FORMAT(trnDeliveredDate, '%e-%b-%Y') as FormatDateDelivery,
					x.volumeSatuan,					
					g.group_name as NameBranch,
					h.group_name as NameDest,serviceLeadTime,
					c.custSaturday,
					c.custWeightActual,
					c.custWeightRound,
					c.custOverDayActive,
					c.custOverDayTime,
					spr.masterNumber as numberspr,
					DATE_FORMAT(arsip.masterCreatedate, '%e-%b-%Y') as FormatDateArsipPod,
					DATE_FORMAT(gr.HawbDate, '%e-%b-%Y') as FormatDateGr,
					DATE_FORMAT(spr.masterDate, '%e-%b-%Y') as FormatDateSpr, 
					arsip.masterCreatedate as DateArsip,
					to_days(trnDeliveredDate)-to_days(trnPickupDate) as lead_time_iod,
					to_days(trnDeliveredDate)-to_days(trnDate) as lead_time".((!empty($otherfield))?" ,".$otherfield:"")."
					FROM ".$this->NAME_DB."traceheaderhawb
					a
					LEFT JOIN ".$this->NAME_DBSYS."app_group_trace g on a.trnBranch=g.group_field
					LEFT JOIN ".$this->NAME_DBSYS."app_group_trace h on a.trnDestination=h.group_field
					LEFT JOIN ".$this->NAME_DB."mastertypeservice b ON a.trnTypeService=b.serviceField
					LEFT JOIN ".$this->NAME_DB."mastercust c ON a.trnAccCustomer=c.CustAcc
					LEFT JOIN ".$this->NAME_DB."mastervolume x ON a.trnTypeVolume=x.volumeField
					LEFT JOIN ".$this->NAME_DB."arsippomaster arsip ON a.trnArsipPodId=arsip.masterId
					LEFT JOIN ".$this->NAME_DB."dispatchsprawb gr ON a.trnNumberAwb=gr.HawbNumber
					LEFT JOIN ".$this->NAME_DB."dispatchsprmaster spr ON gr.HawbMaster=spr.masterId 
					WHERE DATE_FORMAT(trnDate, '%Y-%m-%d') BETWEEN '".$periode1."' AND '".$periode2."'  ".
					$where.((!empty($kondisi))?$kondisi:"")." 
					GROUP BY a.trnNumberAwb
					ORDER BY trnDate ASC";
			//die($_query);			
    	  return $this->DB->query($_query);
	}
	
	function GetKoordinatSprCourier($arraydata)  
    {
    	$where="";
		  if($arraydata):
		  $where=" WHERE ";		
		  foreach($arraydata as $field=>$value):
				if(!empty($field)):
				$where .=" ".$field." IN ('".$value."') AND";
				endif;
		  endforeach;
		  $where =substr($where,0,-3);
		  endif;
		
		$_query = " SELECT b.masterId,b.masterNumber,b.masterDate,b.masterKurir,b.masterGroupBranch,b.masterTransportNumber,
					c.kurirId,c.kurirUsername,c.kurirFullname,c.kurirNik,c.kurirPhone,
					d.GpsLatitude,d.GpsLongitude,d.GpsStampdate,d.GpsStampuser,b.masterTransportNumber
					FROM ".$this->NAME_DB."sdrtransdetail a
					LEFT JOIN ".$this->NAME_DB."sdrtransmaster b ON a.detailMaster=b.masterId
					LEFT JOIN ".$this->NAME_DB."sdrkurir c ON b.masterKurir=c.kurirId
					LEFT JOIN ".$this->NAME_DB."mastercoordinatgps d ON c.kurirUsername=d.GpsKurirUser
					".$where."
					ORDER BY b.masterId,d.GpsId DESC LIMIT 1";
					//die($_query);
		$query = $this->DB->query($_query);
        return $query->row_array();  
    }
	
	function SelectMasterVolumeActive(){
		  $_query = "SELECT SQL_NO_CACHE * FROM ".$this->NAME_DB."mastervolume WHERE volumeFlag<>9 AND volumeActive<>0 ORDER BY volumeId Asc";
    	  return $this->DB->query($_query);
	}
	
	function SelectMasterInvoiceAccount($arraydata){
		  $where="";
		  if($arraydata):
		  $where=" WHERE ";		
		  foreach($arraydata as $field=>$value):
				if(!empty($field)):
				$where .=" ".$field.$value." AND";
				endif;
		  endforeach;
		  $where=substr($where,0,-3);
		  endif;
		  
		  $_query = "SELECT SQL_NO_CACHE *, 
					DATE_FORMAT(masterinvStartDate, '%m/%d/%Y') as DateStart,
					DATE_FORMAT(masterinvFinishDate, '%m/%d/%Y') as DateFinish,
					DATE_FORMAT(masterinvDate, '%m/%d/%Y') as DateTransaksi,
					DATE_FORMAT(masterinvDate, '%d/%m/%Y') as FormatDateTable,
					DATE_FORMAT(masterinvStartDate, '%Y-%m-%d') as PeriodeStart,
					DATE_FORMAT(masterinvFinishDate, '%Y-%m-%d') as PeriodeFinish,
					DATE_FORMAT(masterinvDueDate, '%e-%b-%Y') as FormatDueDate
					FROM ".$this->NAME_DB."invoicepaymentmaster 
					".$where." ORDER BY masterinvFlag";
		//die($_query);			
    	  return $this->DB->query($_query);
	}
	
	function GetMasterInvoiceAccount($id)    
    {
		$_query = "SELECT SQL_NO_CACHE *, 
		DATE_FORMAT(masterinvStartDate, '%m/%d/%Y') as DateStart,
		DATE_FORMAT(masterinvFinishDate, '%m/%d/%Y') as DateFinish,
		DATE_FORMAT(masterinvDate, '%m/%d/%Y') as DateTransaksi,
		DATE_FORMAT(masterinvDate, '%d %M %Y') as FormatCreateTransaksi,
		DATE_FORMAT(masterinvStartDate, '%Y-%m-%d') as PeriodeStart,
		DATE_FORMAT(masterinvFinishDate, '%Y-%m-%d') as PeriodeFinish,
		DATE_FORMAT(masterinvInformasiStartDate, '%Y-%m-%d') as InformasiStart,
		DATE_FORMAT(masterinvInformasiFinishDate, '%Y-%m-%d') as InformasiFinish,
		DATE_FORMAT(masterinvInformasiStartDate, '%d %M %Y') as PeriodeInformasiStart,
		DATE_FORMAT(masterinvInformasiFinishDate, '%d %M %Y') as PeriodeInformasiFinish,
		DATE_FORMAT(masterinvDueDate, '%d %M %Y') as PeriodeInvoice,
		DATE_FORMAT(masterinvDueDate - INTERVAL (masterinvPeriodeDueDate) DAY, '%d %M %Y') as StartInvoice,
		DATE_FORMAT(masterinvPrintDate, '%e %M %Y') as TanggalCetak,
		DATE_FORMAT(masterinvPrintDate, '%m/%d/%Y') as DatePrint,
		DATE_FORMAT(masterinvDeliveryDate, '%m/%d/%Y') as DateDelivery,
		DATE_FORMAT(masterinvPaymentdate, '%m/%d/%Y') as DatePayment
		FROM ".$this->NAME_DB."invoicepaymentmaster 
		WHERE masterinvId = '".$id."'";
		//die($_query);
    	$query = $this->DB->query($_query);
        return $query->row_array();
    	
    }
	
	function SumInvoiceAccount($number){
		  $_query = "SELECT SQL_NO_CACHE detailinvMaster,
					SUM(detailinvActualKg) as detailinvActualKg,
					SUM(detailinvCharge1stKg) as detailinvCharge1stKg,
					SUM(detailinvActualColi) as detailinvActualColi,
					SUM(detailinvTotalCharge) as detailinvTotalCharge,
					SUM(detailinvSubCharges) as detailinvSubCharges,
					SUM(detailinvChargePacking) as detailinvChargePacking,
					SUM(detailinvChargeInsurance) as detailinvChargeInsurance,
					SUM(detailinvChargeOthers) as detailinvChargeOthers,
					SUM(detailinvTotalAll) as detailinvTotalAll
					FROM ".$this->NAME_DB."invoicepaymentdetail 
					WHERE detailinvMaster='".$number."'
					GROUP BY detailinvMaster";
		  return $this->DB->query($_query);
	}
	
	function SelectDetailMasterInvoiceAccount($number){
		  $_query = "SELECT SQL_NO_CACHE a.*,b.*,DATE_FORMAT(trnDate, '%e-%b-%Y') as FormatDateTable,
					d.serviceName as namaservice,
					e.deliveryName as namapaket,
					f.paymentName as namapayment,
					g.group_name as NameBranch,
					h.group_name as NameDest,
					x.direcGroupCity as CityOrg,
					y.direcGroupCity as CityDest,
					x.direcGroupCity as GroupCityOrg,
					y.direcGroupCity as GroupCityDest,
					DATE_FORMAT(trnDeliveredDate, '%e-%b-%Y') as FormatDateDelivery
					FROM ".$this->NAME_DB."invoicepaymentdetail a
					LEFT JOIN ".$this->NAME_DB."traceheaderhawb b ON a.detailinvNumberAwb=b.trnNumberAwb
					LEFT JOIN ".$this->NAME_DB."mastertypeservice d on b.trnTypeService=d.serviceField
					LEFT JOIN ".$this->NAME_DB."mastertypedelivery e on b.trnTypePackage=e.deliveryField
					LEFT JOIN ".$this->NAME_DB."mastertypepayment f on b.trnTypePayment=f.paymentField
					LEFT JOIN ".$this->NAME_DBSYS."app_group_trace g on b.trnBranch=g.group_field
					LEFT JOIN ".$this->NAME_DBSYS."app_group_trace h on b.trnDestination=h.group_field
					LEFT JOIN ".$this->NAME_DB."masterdirectory x ON b.trnShipperOrg=x.direcCode
					LEFT JOIN ".$this->NAME_DB."masterdirectory y ON b.trnConsigneeDest=y.direcCode
					WHERE detailinvMaster='".$number."'
					ORDER BY trnDate ASC";
			//die($_query);		
		  return $this->DB->query($_query);
	}
	
	function SelectMasterCustomerCaseActive($arraydata=""){
			  $where="";
			if(!empty($arraydata)):
			foreach($arraydata as $field=>$value):
				if(!empty($field)):
				$where .=" AND ".$field." IN ('".$value."')"; 
				endif;
			endforeach;			
			endif;
		  $_query = "SELECT SQL_NO_CACHE a.*,b.* FROM ".$this->NAME_DB."mastercust 
					 a LEFT JOIN ".$this->NAME_DBSYS."app_group_trace b ON a.custGroup=b.group_number
					 WHERE custLocked=1 ".$where." ORDER BY CustId Asc";
		  //print_r($_query);
		  
    	  return $this->DB->query($_query);
	}
	
	function GetLastCheckPoint($value)    
    {
    	$_query = "SELECT SQL_NO_CACHE * FROM ".$this->NAME_DB."tracecheckpointhawb WHERE checkNumberAwb = '".$value."' ORDER BY checkId DESC LIMIT 1";
		//die($_query);
    	$query = $this->DB->query($_query);
        return $query->row_array();
    	
    }
	
	function SelectMapTrafficTrace($arraydata="")
	 {
		$where		=null;	
		if($arraydata):
				$where		.="WHERE ";
				foreach($arraydata as $field=>$value):
				if(!empty($value)):
				$where .=" ".$field.$value." AND";
				endif;
		  endforeach;
				$where=substr($where,0,-3);
		 endif;

		$_query = "SELECT SQL_NO_CACHE c.provCode as codeprov,c.provName as nameprov,count(1) as total, sum(trnsActualKg) as weight FROM ".$this->NAME_DB."traceheaderhawb  a
					LEFT JOIN ".$this->NAME_DB."masterdirectory b ON a.trnConsigneeDest=b.direcCode
					LEFT JOIN ".$this->NAME_DB."masterprovinsi c ON b.direcProv=c.provCode
					".$where." GROUP BY c.provCode";
		//die($_query);			
		return $this->DB->query($_query);
    }
	
	function SelectTraceMileTonesPeriode($periode1,$periode2,$void="",$kondisi="",$otherfield="",$kategori=0){
			if(empty($void)) $where =" AND trnVoidFlag=0";
			else			 $where =" AND trnVoidFlag=1";
				if(empty($kategori)):
					$_query = "
					SELECT SQL_NO_CACHE trnNumberAwb,trnBranch,trnDestinationHub,trnAccCustomer,trnDate,trnPickupDate,trnDeliveredDate,
					trnLeadTimeDelivery,trnDeliveredByName,trnConsigneeName,trnReffInstruction,trnSpecialInstruction,trnContentsOfGoods,
					arsippod.masterCreatedate as DateArsip,
					DATE_FORMAT(trnDate, '%e-%b-%Y') as FormatDateTable,
					DATE_FORMAT(trnPickupDate, '%e-%b-%Y') as FormatDatePickup,
					DATE_FORMAT(trnDeliveredDate, '%e-%b-%Y') as FormatDateDelivery,
					c.custSaturday,
					c.custName,
					concat(DATE_FORMAT(trnCreateDate, '%e-%b-%Y'),' ',DATE_FORMAT(trnCreateDate,'%H:%i:%s')) as FormatDateTimeCreated,
					concat(DATE_FORMAT(trnPickupDate, '%e-%b-%Y'),' ',DATE_FORMAT(trnPickupTime,'%H:%i:%s')) as FormatDateTimePickup,
					concat(DATE_FORMAT(sprmaster.masterCreateDate, '%e-%b-%Y'),' ',DATE_FORMAT(sprmaster.masterCreateDate, '%H:%i:%s')) as FormatDateTimeSpr,
					concat(DATE_FORMAT(gr.HawbDate, '%e-%b-%Y'),' ',DATE_FORMAT(gr.HawbDate, '%H:%i:%s')) as FormatDateTimeGr,
					concat(DATE_FORMAT(pickmaster.PickMasterDate,'%e-%b-%Y'),' ',DATE_FORMAT(pickmaster.PickMasterDate,'%H:%i:%s')) as FormatDateTimePicklist,
					concat(DATE_FORMAT(labelmaster.BagMasterDate, '%e-%b-%Y'),' ',DATE_FORMAT(labelmaster.BagMasterDate, '%H:%i:%s')) as FormatDateTimeLabelbag,
					concat(DATE_FORMAT(stobmaster.masterCreatedate, '%e-%b-%Y'),' ',DATE_FORMAT(stobmaster.masterCreatedate, '%H:%i:%s')) as FormatDateTimeStob,
					concat(DATE_FORMAT(smumaster.smuCreatedate, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuCreatedate, '%H:%i:%s')) as FormatDateTimeSmu,
					concat(DATE_FORMAT(smumaster.smuDepartTime, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuDepartTime, '%H:%i:%s')) as FormatDateTimeSmuDepart,
					concat(DATE_FORMAT(smumaster.smuArrivedTime, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuArrivedTime, '%H:%i:%s')) as FormatDateTimeSmuArrived,
					concat(DATE_FORMAT(smumaster.smuDepartureDate, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuDepartureDate, '%H:%i:%s')) as FormatDateTimeSmuDepartReal,
					concat(DATE_FORMAT(smumaster.smuArrivedDate, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuArrivedDate, '%H:%i:%s')) as FormatDateTimeSmuArrivedReal,
					concat(DATE_FORMAT(smudetail.smuLabelDate, '%e-%b-%Y'),' ',DATE_FORMAT(smudetail.smuLabelDate, '%H:%i:%s')) as FormatDateTimeWarehouse,
					concat(DATE_FORMAT(sdrm.masterDatemaker, '%e-%b-%Y'),' ',DATE_FORMAT(sdrm.masterDatemaker, '%H:%i:%s')) as FormatDateTimeSdr,
					concat(DATE_FORMAT(a.trnDeliveredDate, '%e-%b-%Y'),' ',DATE_FORMAT(a.trnDeliveredTime, '%H:%i:%s')) as FormatDateTimeDelivery,
					
					concat(DATE_FORMAT(podmaster.podmasterCreatedate, '%e-%b-%Y'),' ',DATE_FORMAT(podmaster.podmasterCreatedate, '%H:%i:%s')) as FormatDateTimeManifestPOD, 
					concat(DATE_FORMAT(podmaster.podmasterDeliverydate, '%e-%b-%Y'),' ',DATE_FORMAT(podmaster.podmasterDeliverydate, '%H:%i:%s')) as FormatDateTimeManifestPODTerima, 
					concat(DATE_FORMAT(arsippod.masterCreatedate, '%e-%b-%Y'),' ',DATE_FORMAT(arsippod.masterCreatedate, '%H:%i:%s')) as FormatDateTimeArsipPod, 
					concat(DATE_FORMAT(custmaster.masterCreatedate, '%e-%b-%Y'),' ',DATE_FORMAT(custmaster.masterCreatedate, '%H:%i:%s')) as FormatDateTimeCustomerPOD, 
					concat(DATE_FORMAT(custmaster.masterDeliveryDateCustomer, '%e-%b-%Y'),' ',DATE_FORMAT(custmaster.masterDeliveryDateCustomer, '%H:%i:%s')) as FormatDateTimeCustomerPODTerima, 
					concat(DATE_FORMAT(invoice.masterinvDate, '%e-%b-%Y'),' ',DATE_FORMAT(invoice.masterinvDate, '%H:%i:%s')) as FormatDateTimeInvoice, 
					to_days(trnDeliveredDate)-to_days(trnPickupDate) as lead_time_iod,
					to_days(trnDeliveredDate)-to_days(trnDate) as lead_time".((!empty($otherfield))?" ,".$otherfield:"")."
					FROM ".$this->NAME_DB."traceheaderhawb
					a
					LEFT JOIN ".$this->NAME_DB."mastercust c ON a.trnAccCustomer=c.CustAcc
					LEFT JOIN ".$this->NAME_DB."dispatchsprawb gr ON a.trnNumberAwb=gr.HawbNumber
					LEFT JOIN ".$this->NAME_DB."dispatchsprmaster spr ON gr.HawbMaster=spr.masterId
					LEFT JOIN ".$this->NAME_DB."sdrtransdetail sdrd ON a.trnNumberAwb=sdrd.detailAwb
					LEFT JOIN ".$this->NAME_DB."sdrtransmaster sdrm ON sdrd.detailMaster=sdrm.masterId
					LEFT JOIN ".$this->NAME_DB."sdrkurir kurir ON sdrm.masterKurir=kurir.kurirId
					LEFT JOIN ".$this->NAME_DB."dispatchsprawb sprconnote ON a.trnNumberAwb=sprconnote.HawbNumber
					LEFT JOIN ".$this->NAME_DB."dispatchsprmaster sprmaster ON sprconnote.HawbMaster=sprmaster.masterId 	
					LEFT JOIN ".$this->NAME_DB."picklistconnote picklist ON sprconnote.HawbMaster=picklist.PickConnoteNumberAwb
					LEFT JOIN ".$this->NAME_DB."picklistmaster pickmaster ON picklist.PickMaster=pickmaster.PickMasterId
					LEFT JOIN ".$this->NAME_DB."labelbagdetail labeldetail ON labeldetail.BagDetailConnote=a.trnNumberAwb
					LEFT JOIN ".$this->NAME_DB."labelbagmaster labelmaster ON labeldetail.BagMaster=labelmaster.BagMasterId 
					LEFT JOIN ".$this->NAME_DB."manifestoutbounddetail stobdetail ON labelmaster.BagMasterNumber=stobdetail.detailLabelBag 
					LEFT JOIN ".$this->NAME_DB."manifestoutboundmaster stobmaster ON stobdetail.detailMaster=stobmaster.masterId 
					LEFT JOIN ".$this->NAME_DB."smutransaksidetail smudetail ON labelmaster.BagMasterNumber=smudetail.smuLabelBag 
					LEFT JOIN ".$this->NAME_DB."smutransaksimaster smumaster ON smudetail.smuMaster=smumaster.smuMasterId
					LEFT JOIN ".$this->NAME_DB."sdrtransdetail sdrdetail ON a.trnNumberAwb=sdrdetail.detailAwb
					LEFT JOIN ".$this->NAME_DB."sdrtransmaster sdrmaster ON sdrdetail.detailMaster=sdrmaster.masterId
					LEFT JOIN ".$this->NAME_DB."arsippomaster arsippod ON a.trnArsipPodId=arsippod.masterId
					LEFT JOIN ".$this->NAME_DB."invoicepaymentmaster invoice ON a.trnInvoiceNumber=invoice.masterinvNumber
					
					LEFT JOIN  ".$this->NAME_DB."manifestcustomerdetail custdetail on a.trnNumberAwb=custdetail.detailNumberawb
					LEFT JOIN  ".$this->NAME_DB."manifestcustomermaster custmaster on custdetail.detailMaster=custmaster.masterId
					LEFT JOIN  ".$this->NAME_DB."manifestpoddetail poddetail on a.trnNumberAwb=poddetail.poddetailNumberawb
					LEFT JOIN  ".$this->NAME_DB."manifestpodmaster podmaster on poddetail.poddetailMaster=podmaster.podmasterId
					WHERE DATE_FORMAT(trnDate, '%Y-%m-%d') BETWEEN '".$periode1."' AND '".$periode2."'  ".
					$where.((!empty($kondisi))?$kondisi:"")." 
					GROUP BY a.trnNumberAwb,labeldetail.BagDetailConnote
					ORDER BY a.trnNumberAwb ASC";
				elseif($kategori==1 or $kategori==2):
					$_query = "SELECT SQL_NO_CACHE trnNumberAwb,trnBranch,trnDestinationHub,trnAccCustomer,trnDate,trnPickupDate,trnDeliveredDate,
					trnLeadTimeDelivery,trnDeliveredByName,trnConsigneeName,trnReffInstruction,trnSpecialInstruction,trnContentsOfGoods,
					DATE_FORMAT(trnDate, '%e-%b-%Y') as FormatDateTable,
					DATE_FORMAT(trnPickupDate, '%e-%b-%Y') as FormatDatePickup,
					DATE_FORMAT(trnDeliveredDate, '%e-%b-%Y') as FormatDateDelivery,
					c.custSaturday,
					c.custName,
					concat(DATE_FORMAT(trnCreateDate, '%e-%b-%Y'),' ',DATE_FORMAT(trnCreateDate,'%H:%i:%s')) as FormatDateTimeCreated,
					concat(DATE_FORMAT(trnPickupDate, '%e-%b-%Y'),' ',DATE_FORMAT(trnPickupTime,'%H:%i:%s')) as FormatDateTimePickup,
					concat(DATE_FORMAT(sprmaster.masterCreateDate, '%e-%b-%Y'),' ',DATE_FORMAT(sprmaster.masterCreateDate, '%H:%i:%s')) as FormatDateTimeSpr,
					concat(DATE_FORMAT(gr.HawbDate, '%e-%b-%Y'),' ',DATE_FORMAT(gr.HawbDate, '%H:%i:%s')) as FormatDateTimeGr,
					concat(DATE_FORMAT(pickmaster.PickMasterDate,'%e-%b-%Y'),' ',DATE_FORMAT(pickmaster.PickMasterDate,'%H:%i:%s')) as FormatDateTimePicklist,
					concat(DATE_FORMAT(labelmaster.BagMasterDate, '%e-%b-%Y'),' ',DATE_FORMAT(labelmaster.BagMasterDate, '%H:%i:%s')) as FormatDateTimeLabelbag,
					concat(DATE_FORMAT(stobmaster.masterCreatedate, '%e-%b-%Y'),' ',DATE_FORMAT(stobmaster.masterCreatedate, '%H:%i:%s')) as FormatDateTimeStob,
					concat(DATE_FORMAT(smumaster.smuCreatedate, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuCreatedate, '%H:%i:%s')) as FormatDateTimeSmu,
					concat(DATE_FORMAT(smumaster.smuDate, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuDepartTime, '%H:%i:%s')) as FormatDateTimeSmuDepart,
					concat(DATE_FORMAT(smumaster.smuDate, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuArrivedTime, '%H:%i:%s')) as FormatDateTimeSmuArrived,
					concat(DATE_FORMAT(smumaster.smuDepartureDate, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuDepartureDate, '%H:%i:%s')) as FormatDateTimeSmuDepartReal,
					concat(DATE_FORMAT(smumaster.smuArrivedDate, '%e-%b-%Y'),' ',DATE_FORMAT(smumaster.smuArrivedDate, '%H:%i:%s')) as FormatDateTimeSmuArrivedReal,
					concat(DATE_FORMAT(smudetail.smuLabelDate, '%e-%b-%Y'),' ',DATE_FORMAT(smudetail.smuLabelDate, '%H:%i:%s')) as FormatDateTimeWarehouse,
					concat(DATE_FORMAT(a.trnDeliveredDate, '%e-%b-%Y'),' ',DATE_FORMAT(a.trnDeliveredTime, '%H:%i:%s')) as FormatDateTimeDelivery,
					to_days(trnDeliveredDate)-to_days(trnPickupDate) as lead_time_iod,
					to_days(trnDeliveredDate)-to_days(trnDate) as lead_time".((!empty($otherfield))?" ,".$otherfield:"")."
					FROM ".$this->NAME_DB."traceheaderhawb
					a
					LEFT JOIN ".$this->NAME_DB."mastercust c ON a.trnAccCustomer=c.CustAcc
					LEFT JOIN ".$this->NAME_DB."dispatchsprawb gr ON a.trnNumberAwb=gr.HawbNumber
					LEFT JOIN ".$this->NAME_DB."dispatchsprmaster spr ON gr.HawbMaster=spr.masterId
					LEFT JOIN ".$this->NAME_DB."dispatchsprawb sprconnote ON a.trnNumberAwb=sprconnote.HawbNumber
					LEFT JOIN ".$this->NAME_DB."dispatchsprmaster sprmaster ON sprconnote.HawbMaster=sprmaster.masterId 	
					LEFT JOIN ".$this->NAME_DB."picklistconnote picklist ON sprconnote.HawbMaster=picklist.PickConnoteNumberAwb
					LEFT JOIN ".$this->NAME_DB."picklistmaster pickmaster ON picklist.PickMaster=pickmaster.PickMasterId
					LEFT JOIN ".$this->NAME_DB."labelbagdetail labeldetail ON labeldetail.BagDetailConnote=a.trnNumberAwb
					LEFT JOIN ".$this->NAME_DB."labelbagmaster labelmaster ON labeldetail.BagMaster=labelmaster.BagMasterId 
					LEFT JOIN ".$this->NAME_DB."manifestoutbounddetail stobdetail ON labelmaster.BagMasterNumber=stobdetail.detailLabelBag 
					LEFT JOIN ".$this->NAME_DB."manifestoutboundmaster stobmaster ON stobdetail.detailMaster=stobmaster.masterId 
					LEFT JOIN ".$this->NAME_DB."smutransaksidetail smudetail ON labelmaster.BagMasterNumber=smudetail.smuLabelBag 
					LEFT JOIN ".$this->NAME_DB."smutransaksimaster smumaster ON smudetail.smuMaster=smumaster.smuMasterId
					WHERE DATE_FORMAT(trnDate, '%Y-%m-%d') BETWEEN '".$periode1."' AND '".$periode2."'  ".
					$where.((!empty($kondisi))?$kondisi:"")." 
					GROUP BY a.trnNumberAwb,labeldetail.BagDetailConnote
					ORDER BY a.trnNumberAwb ASC";
				elseif($kategori==3 or $kategori==4):
					$_query = "SELECT SQL_NO_CACHE trnNumberAwb,trnBranch,trnDestinationHub,trnAccCustomer,trnDate,trnPickupDate,trnDeliveredDate,
					trnLeadTimeDelivery,trnDeliveredByName,trnConsigneeName,trnReffInstruction,trnSpecialInstruction,trnContentsOfGoods,
					DATE_FORMAT(trnDate, '%e-%b-%Y') as FormatDateTable,
					DATE_FORMAT(trnPickupDate, '%e-%b-%Y') as FormatDatePickup,
					DATE_FORMAT(trnDeliveredDate, '%e-%b-%Y') as FormatDateDelivery,
					c.custSaturday,
					c.custName,
					concat(DATE_FORMAT(trnCreateDate, '%e-%b-%Y'),' ',DATE_FORMAT(trnCreateDate,'%H:%i:%s')) as FormatDateTimeCreated,
					concat(DATE_FORMAT(trnPickupDate, '%e-%b-%Y'),' ',DATE_FORMAT(trnPickupTime,'%H:%i:%s')) as FormatDateTimePickup,
					concat(DATE_FORMAT(sdrm.masterDatemaker, '%e-%b-%Y'),' ',DATE_FORMAT(sdrm.masterDatemaker, '%H:%i:%s')) as FormatDateTimeSdr,
					concat(DATE_FORMAT(a.trnDeliveredDate, '%e-%b-%Y'),' ',DATE_FORMAT(a.trnDeliveredTime, '%H:%i:%s')) as FormatDateTimeDelivery,
					to_days(trnDeliveredDate)-to_days(trnPickupDate) as lead_time_iod,
					to_days(trnDeliveredDate)-to_days(trnDate) as lead_time".((!empty($otherfield))?" ,".$otherfield:"")."
					FROM ".$this->NAME_DB."traceheaderhawb
					a
					LEFT JOIN ".$this->NAME_DB."mastercust c ON a.trnAccCustomer=c.CustAcc
					LEFT JOIN ".$this->NAME_DB."sdrtransdetail sdrd ON a.trnNumberAwb=sdrd.detailAwb
					LEFT JOIN ".$this->NAME_DB."sdrtransmaster sdrm ON sdrd.detailMaster=sdrm.masterId
					WHERE DATE_FORMAT(trnDate, '%Y-%m-%d') BETWEEN '".$periode1."' AND '".$periode2."'  ".
					$where.((!empty($kondisi))?$kondisi:"")." 
					GROUP BY a.trnNumberAwb
					ORDER BY a.trnNumberAwb ASC";
				elseif($kategori==5 or $kategori==6):
					$_query = "SELECT SQL_NO_CACHE trnNumberAwb,trnBranch,trnDestinationHub,trnAccCustomer,trnDate,trnPickupDate,trnDeliveredDate,
					trnLeadTimeDelivery,trnDeliveredByName,trnConsigneeName,trnReffInstruction,trnSpecialInstruction,trnContentsOfGoods,
					arsippod.masterCreatedate as DateArsip,
					DATE_FORMAT(trnDate, '%e-%b-%Y') as FormatDateTable,
					DATE_FORMAT(trnPickupDate, '%e-%b-%Y') as FormatDatePickup,
					DATE_FORMAT(trnDeliveredDate, '%e-%b-%Y') as FormatDateDelivery,
					c.custSaturday,
					c.custName,
					concat(DATE_FORMAT(arsippod.masterCreatedate, '%e-%b-%Y'),' ',DATE_FORMAT(arsippod.masterCreatedate, '%H:%i:%s')) as FormatDateTimeArsipPod,
					concat(DATE_FORMAT(invoice.masterinvDate, '%e-%b-%Y'),' ',DATE_FORMAT(invoice.masterinvDate, '%H:%i:%s')) as FormatDateTimeInvoice,
					concat(DATE_FORMAT(a.trnDeliveredDate, '%e-%b-%Y'),' ',DATE_FORMAT(a.trnDeliveredTime, '%H:%i:%s')) as FormatDateTimeDelivery,
					to_days(trnDeliveredDate)-to_days(trnPickupDate) as lead_time_iod,
					to_days(trnDeliveredDate)-to_days(trnDate) as lead_time".((!empty($otherfield))?" ,".$otherfield:"")."
					FROM ".$this->NAME_DB."traceheaderhawb
					a
					LEFT JOIN ".$this->NAME_DB."mastercust c ON a.trnAccCustomer=c.CustAcc
					LEFT JOIN ".$this->NAME_DB."arsippomaster arsippod ON a.trnArsipPodId=arsippod.masterId
					LEFT JOIN ".$this->NAME_DB."invoicepaymentmaster invoice ON a.trnInvoiceNumber=invoice.masterinvNumber
					WHERE DATE_FORMAT(trnDate, '%Y-%m-%d') BETWEEN '".$periode1."' AND '".$periode2."'  ".
					$where.((!empty($kondisi))?$kondisi:"")." 
					GROUP BY a.trnNumberAwb
					ORDER BY a.trnNumberAwb ASC";
				else:
					$query="";
				endif;	
			//die($_query);			
    	  return $this->DB->query($_query);
	}	

}