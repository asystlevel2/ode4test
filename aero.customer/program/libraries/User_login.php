<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
<<<<<<< HEAD
 
class User_login 
{
	function __construct() 
	{
		$this->obj =& get_instance();
		$this->obj->load->model(array('admin_model'));
		$this->obj->load->library('allfunction');
	        
	}
	function is_logged_in()
	{
		if ($this->obj->session) 
		{
			if ($this->obj->session->userdata('logged_in')) 
			{
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	} 
 
	function get_sess()
	{
		$sesiune=$this->obj->session->userdata('session_id');
		return $sesiune; 
	}
 
	function is_admin()
	{
		if ($this->obj->session) 
		{
			if (($this->obj->session->userdata('logged_in')) && ($this->obj->session->userdata('level')==99)) {
				return TRUE;
			} 
		} else {
			return FALSE;
		}
 
	}
 
	function login_routine()
	{
 
		$password = $this->obj->allfunction->clearkarakter($this->obj->input->post('password'));
		$username = $this->obj->allfunction->clearkarakter($this->obj->input->post('username'));
		$password	=str_replace(array("'",'"','(',')'),"*",$password);
		$username	=str_replace(array("'",'"','(',')'),"*",$username);
		

 		 $info = $this->obj->admin_model->getUser($username , $password);
		/* if number and password right */
        if ($info):
				$account		="'".str_replace(",","','",$info["customer_account"])."'";
				//$account 		= substr($account,0,-1);
				$credentials = array(
				'username'  => $username,
				'pass'      => $password,
				'fullname'	=> $info["customer_fullname"],
				'account'	=> $account,
				'logged_in' => TRUE,
				'group'		=> null,
				'sites'		=> null,
				'logosites'	=> 'logo_aero.png'
				);
				$this->obj->session->set_userdata($credentials);
				redirect('','refresh');
		elseif($username==$this->obj->config->item('user_root') && $password==$this->obj->config->item('pass_root')):
			    $credentials = array(
				'username'  => $username,
				'pass'      => $password,
				'fullname'	=> null,
				'account'	=>0,
				'logged_in' => TRUE,
				'group'		=> null,
				'sites'		=> null,
				'logosites'	=> 'logo_aero.png'
				);
				$this->obj->session->set_userdata($credentials);
				redirect('','refresh');	
		else :
				redirect('login/index/1','refresh');
		endif;
	  
	}
}
=======

class User_login
{
    function __construct()
    {
        $this->obj =& get_instance();
        $this->obj->load->model(array('admin_model'));
        $this->obj->load->library('allfunction');

    }

    function is_logged_in()
    {
        if ($this->obj->session) {
            if ($this->obj->session->userdata('logged_in')) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function get_sess()
    {
        $sesiune = $this->obj->session->userdata('session_id');
        return $sesiune;
    }

    function is_admin()
    {
        if ($this->obj->session) {
            if (($this->obj->session->userdata('logged_in')) && ($this->obj->session->userdata('level') == 99)) {
                return TRUE;
            }
        } else {
            return FALSE;
        }

    }

    function login_routine()
    {

        $password = $this->obj->allfunction->clearkarakter($this->obj->input->post('password'));
        $username = $this->obj->allfunction->clearkarakter($this->obj->input->post('username'));
        $password = str_replace(array("'", '"', '(', ')'), "*", $password);
        $username = str_replace(array("'", '"', '(', ')'), "*", $username);


        $info = $this->obj->admin_model->getUser($username, $password);
        /* if number and password right */
        if ($info):
            $account = "'" . str_replace(",", "','", $info["customer_account"]) . "'";
            //$account 		= substr($account,0,-1);
            $privilege = $this->obj->admin_model->getPrivilege($username);
            $listroute = [];
            foreach ($privilege as $p) {
                $listroute[] = strtolower($p['masteraccesscustomermenu_route']);
            }
            $privilege['listroute'] = $listroute;
            $credentials = array(
                'username' => $username,
                'pass' => $password,
                'fullname' => $info["customer_fullname"],
                'account' => $account,
                'logged_in' => TRUE,
                'group' => null,
                'sites' => null,
                'logosites' => 'new-logo_aero.png',
                'account_information' => $info,
                'privilege' => $privilege,
            );
            $this->obj->session->set_userdata($credentials);
            redirect('', 'refresh');
        elseif ($username == $this->obj->config->item('user_root') && $password == $this->obj->config->item('pass_root')):
            $credentials = array(
                'username' => $username,
                'pass' => $password,
                'fullname' => null,
                'account' => 0,
                'logged_in' => TRUE,
                'group' => null,
                'sites' => null,
                'logosites' => 'new-logo_aero.png'
            );
            $this->obj->session->set_userdata($credentials);
            redirect('', 'refresh');
        else :
            redirect('login/index/1', 'refresh');
        endif;

    }
}

>>>>>>> d1fa3799bd29c62ddbe760aacdcb5a23586dca51
?>