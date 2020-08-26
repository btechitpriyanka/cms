<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	 
	 public function __construct()
		{
			parent::__construct();
			$this->load->model('login_model');
			
		}

	public function index()
	{
		$data['page_title'] = "Login" ; 		
		$this->load->view('header',$data);
		$this->load->view('login');
		$this->load->view('footer');
	}
	
	 public function loginMe()
    {
		$this->load->library('form_validation');        
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('user_pass', 'Password', 'trim|required|min_length[2]');
        
        if($this->form_validation->run() == FALSE)
        {
			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');
        } else  {
			
            $login_data = $this->login_model->loginMe();
			
            if($login_data['status']=='success')
            {   
					$this->session->set_userdata($login_data['data']);
					$this->session->set_userdata('is_logged_in',true);
					$this->session->set_userdata('session_id',session_id());
					redirect('articles/list_articles');					
			}
            else
            {
            	$this->session->set_flashdata('error',$login_data['message']);
                redirect('/login');		
            }
        }
    }
	public function logout(){
		$this->session->sess_destroy();
		redirect('/login');		
	}
	
}
