<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Description of Model
 *
 * 
 */
class Login_model extends CI_Model {
	
    public function __construct() {
        parent::__construct();
		
    }
	
	function loginMe($Login_data=array())
    {
			$user_name   = $this->input->post('user_name');
            $password    = $this->input->post('user_pass');
			
			$where = array('user_name'=>$user_name,'user.is_active'=>'1');		
			$join  = array('tbl_user_role_mst as role'=>'role.role_id = user.user_role_id');		
			$user_details = $this->query->get_all_details('user.*,role_name,is_admin', 'tbl_user_mst as user',$join,$where);
				
			if(!empty($user_details)){
				$user_role_id  = $user_details[0]['user_role_id'];
				$hash_password = $user_details[0]['user_password'];
					if (password_verify($password, $hash_password)) {
					  $data = array('status' =>'success','message' => 'Login Successful','data' => $user_details[0]);
					} else {
						 $data = array('status' =>'error','message' => 'Please enter the correct password','data' => '');
					}
						
			} else {
				$data = array('status' =>'error','message' => 'Invalid Credentials!!!','data' => '');
			}
			return $data;

    }
	
	
}
