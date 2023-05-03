<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

<<<<<<< HEAD
class Admin_model extends CI_Model {

    function __construct() 
	{
		parent::__construct();
        $this->DB 		= $this->load->database('default', true);
        $this->NAME_DB= 'dbaerotrace.';
		$this->NAME_DBSYS= 'dbaerosystem.';
    }
    
    function getUser($username,$pass)    
    {
    	$_query = "SELECT SQL_NO_CACHE *	FROM ".$this->NAME_DB."masteraccesscustomer where 
		(customer_username='".$username."' OR customer_email='".$username."') AND (customer_enkripsi='".md5($pass)."' and customer_base='".base64_encode($pass)."') AND customer_active=1";
    	$query = $this->DB->query($_query);
        return $query->row_array();
    	
    }
	
	function updateUser($field,$value,$data)
    {
		$this->DB->where($field,$value);
		$this->DB->update($this->NAME_DB.'masteraccesscustomer',$data);
    }
	
	function GetValueParameterConfigurasiFieldValue($field,$value,$parameter)    
    {
    	$_query = "SELECT SQL_NO_CACHE ".$parameter." as parameter FROM ".$this->NAME_DBSYS."parameter WHERE ".$field." = '".$value."'";
    	//die($_query);
		$query = $this->DB->query($_query);
        if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) 	
			return $row->parameter;

		} else {
			return null;
		}
    	
    }
	
	function GetValueParameterConfigurasi($value)    
    {
    	$_query = "SELECT SQL_NO_CACHE ParameterValue FROM ".$this->NAME_DBSYS."parameter WHERE ParameterName = '".$value."'";
    	//die($_query);
		$query = $this->DB->query($_query);
        if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) 	
			return $row->ParameterValue;

		} else {
			return null;
		}
    	
=======
class Admin_model extends CI_Model
{

    private $DB_Trace;

    function __construct()
    {
        parent::__construct();
        $this->DB = $this->load->database('default', true);
        $this->DB_Trace = $this->load->database('transaksi');
        $this->NAME_DB = 'dbaerotrace.';
        $this->NAME_DBSYS = 'dbaerosystem.';
    }

    function getUser($username, $pass)
    {
        $_query = "SELECT SQL_NO_CACHE a.*,b.*,c.custServices	FROM " . $this->NAME_DB . "masteraccesscustomer a
        JOIN ".$this->NAME_DB."mastercust b ON a.customer_account = b.custacc COLLATE latin1_general_ci
        LEFT JOIN ".$this->NAME_DB."mastercustomerservices c ON b.custAcc = c.custAcc
        where 
		(customer_username='" . $username . "' OR customer_email='" . $username . "') AND (customer_enkripsi='" . md5($pass) . "' and customer_base='" . base64_encode($pass) . "') AND customer_active=1";
        $query = $this->DB->query($_query);
        return $query->row_array();
    }

    function getPrivilege($user) {
        $_query = "SELECT c.*,d.* ";
        $_query .= "FROM ".$this->NAME_DB."masteraccesscustomer a ";
        $_query .= "JOIN ".$this->NAME_DB."mastercust b ON a.customer_account = b.custacc COLLATE latin1_general_ci ";
        $_query .= "LEFT JOIN ".$this->NAME_DB."masteraccesscustomerroles c ON a.customer_id = c.accesscustomerroles_user COLLATE latin1_general_ci ";
        $_query .= "LEFT JOIN ".$this->NAME_DB."masteraccesscustomermenu d ON c.accesscustomerroles_menu = d.masteraccesscustomermenu_id ";
        $_query .= "WHERE a.customer_username = '$user' AND d.isActive = 1";
        return $this->DB->query($_query)->result_array();
    }

    function updateUser($field, $value, $data)
    {
        $this->DB->where($field, $value);
        $this->DB->update($this->NAME_DB . 'masteraccesscustomer', $data);
    }

    function GetValueParameterConfigurasiFieldValue($field, $value, $parameter)
    {
        $_query = "SELECT SQL_NO_CACHE " . $parameter . " as parameter FROM " . $this->NAME_DBSYS . "parameter WHERE " . $field . " = '" . $value . "'";
        //die($_query);
        $query = $this->DB->query($_query);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                return $row->parameter;

        } else {
            return null;
        }

    }

    function GetValueParameterConfigurasi($value)
    {
        $_query = "SELECT SQL_NO_CACHE ParameterValue FROM " . $this->NAME_DBSYS . "parameter WHERE ParameterName = '" . $value . "'";
        //die($_query);
        $query = $this->DB->query($_query);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
                return $row->ParameterValue;

        } else {
            return null;
        }

>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
    }


}