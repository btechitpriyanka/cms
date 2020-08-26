<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {
     public function __construct()
		{
			parent::__construct();
		   if(!$this->session->userdata('is_logged_in'))
		   {
			   redirect('/login');
		   }
		   $this->load->model('article_model');
			
		}
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('articles');
		$this->load->view('footer');
	}
	public function add_aricle()
	{
		$this->load->view('header');
		$this->load->view('add_article');
		$this->load->view('footer');
	}
	
	public function list_articles() 
	{
		
		$data['page_title'] 	= "Articles List" ; 
		$is_admin     		= $this->session->userdata('is_admin');			
		$created_by     		= $this->session->userdata('user_id');	
		$srch_data = array();
		if($is_admin=="0"){
		$srch_data = array('created_by'=>$created_by);	
		 }		
		$data['article_list'] 	= $this->article_model->get_article_list($srch_data);
		$this->load->view('header',$data);
		$this->load->view('list_article',$data);
		$this->load->view('footer',$data);	
		
	}
	 public function add_article()
    {			
	
		$data['page_title'] ="Add New Article";	
		
		$this->load->library('form_validation');				
		
		$this->form_validation->set_rules('article_tag', 'Tag', 'required|trim');
		$this->form_validation->set_rules('article_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('article_desc', 'Description', 'required|trim');
		if (empty($_FILES['article_img']['name']))
		{
			$this->form_validation->set_rules('article_img', 'Article Image', 'required|trim');
		}
		if($this->form_validation->run() == FALSE)
		{
			 $this->load->view('header',$data);
		     $this->load->view('add_article',$data);
		     $this->load->view('footer',$data);	
		}
		else
		{
			
				 $post_data       = $this->input->post(NULL,true);
											
				// Image upload code starts
				
					//configure settings about image
					$config['upload_path']          = "assets/images/" ;
					$config['allowed_types']        = 'jpg|png|jpeg';
					$config['max_size']             = 30000;
											
					//upload new image
					$this->load->library('upload', $config);
					$lib = $this->upload->do_upload('article_img');
					
					if ($lib != 1 )
					{ 
						$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata("error",$this->upload->display_errors());
				        redirect('articles/list_articles');
					}
					else
					{
						$file_name                  = $this->upload->data('file_name');
						$post_data['article_img'] 	= $file_name;
					}

				// file upload code ends												
				   $add_data = $this->article_model->add_article_details($post_data);
					if(!empty($add_data)){					
							$this->session->set_flashdata("success","Article Added Successfully");
							redirect('articles/list_articles');
					} else {
						$this->session->set_flashdata("error","Please Try Again");
						redirect('articles/list_articles');
					}
				
		}
	 }


	public function edit_article($article_tag=NULL) {
		
				
		$data['page_title']         ="Edit Article Details";	
		$created_by     			= $this->session->userdata('user_id');
		$is_admin     			= $this->session->userdata('is_admin');
        $srch_data 					= array('article_tag'=>$article_tag);
		if($is_admin=="0"){
		$srch_data['created_by'] = $created_by;	
		 }				
		$data['article_details']    = $this->article_model->get_article_list($srch_data);
							
		$this->load->library('form_validation');
		
	    $this->form_validation->set_rules('article_tag', 'Tag', 'required|trim');
		$this->form_validation->set_rules('article_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('article_desc', 'Description', 'required|trim');											
		if($this->form_validation->run() == FALSE)
		{
			 $this->load->view('header',$data);
		     $this->load->view('edit_article',$data);
		     $this->load->view('footer',$data);	
		}
		else
		{
			    $post_data       = $this->input->post(NULL,true);
			if (!empty($_FILES['article_img']['name']))
				{						
				// Image upload code starts
				
					//configure settings about image
					$config['upload_path']          = "assets/images/" ;
					$config['allowed_types']        = 'jpg|png|jpeg';
					$config['max_size']             = 30000;
											
					//upload new image
					$this->load->library('upload', $config);
					$lib = $this->upload->do_upload('article_img');
					
					if ($lib != 1 )
					{ 
						$error = array('error' => $this->upload->display_errors());
						$this->session->set_flashdata("error",$this->upload->display_errors());
						redirect('articles/list_articles');
					}
					else
					{
						$file_name                  = $this->upload->data('file_name');
						$post_data['article_img'] 	= $file_name;
					}
				}
				// file upload code ends												
				   $add_data = $this->article_model->update_article_details($post_data);
					if(!empty($add_data)){					
							$this->session->set_flashdata("success","Article Updated Successfully");
							redirect('articles/list_articles');
					} else {
						$this->session->set_flashdata("error","Please Try Again");
						redirect('articles/list_articles');
					}
		}
	   }
	   public function view_article($article_tag=NULL) {
		
			$this->load->library('form_validation');	
		     $data['page_title']        ="View Article Details";			
		     $srch_data = array('article_tag'=>$article_tag);		
		     $data['article_details']    = $this->article_model->get_article_list($srch_data);
		     $data['comment_details']    = $this->article_model->get_comment_list($srch_data);
			 $this->load->view('header',$data);
		     $this->load->view('article_details',$data);
		     $this->load->view('footer',$data);					
		
	   }  
	   
	 public function add_comment()
    {			
	
		$data['page_title'] ="Add Comment";	
		
		$this->load->library('form_validation');				
		
		$article_tag = $this->input->post('article_tag');
		$article_id = $this->input->post('article_id');
		$this->form_validation->set_rules('article_comment', 'Comment', 'required|trim');
		
		if($this->form_validation->run() == FALSE)
		{
			 $this->session->set_flashdata("error","Comment is required");
			 redirect('articles/view_article/'.$article_id);
		}
		else
		{
			
		    $post_data = $this->input->post(NULL,true);							
		    $add_data  = $this->article_model->add_comment($post_data);
			if(!empty($add_data)){					
					$this->session->set_flashdata("success","Comment Added Successfully");
					redirect('articles/view_article/'.$article_tag);
			} else {
				$this->session->set_flashdata("error","Please Try Again");
				redirect('articles/view_article/'.$article_tag);
			}
			 
				
		}
	 }
	 
	 public function list_users() 
	{
		
		$data['page_title'] = "User List" ; 
		$data['user_list'] 	= $this->article_model->get_user_list();
		$this->load->view('header',$data);
		$this->load->view('list_users',$data);
		$this->load->view('footer',$data);	
		
	}
	 
	 public function add_user()
    {			
	
		$data['page_title'] ="Add New User";	
		
		$this->load->library('form_validation');				
		
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('username', 'User Name', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('email_id', 'Email Id', 'required|trim');
	
		if($this->form_validation->run() == FALSE)
		{
			 $this->load->view('header',$data);
		     $this->load->view('add_user',$data);
		     $this->load->view('footer',$data);	
		}
		else
		{
			
				   $post_data       = $this->input->post(NULL,true);
				   $add_data = $this->article_model->add_new_user($post_data);
					if(!empty($add_data)){					
							$this->session->set_flashdata("success","New User Added Successfully");
							redirect('articles/list_users');
					} else {
						$this->session->set_flashdata("error","Username Already Exists");
						redirect('articles/list_users');
					}
				
		}
	 }



}
