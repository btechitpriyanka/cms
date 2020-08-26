<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
     public function __construct()
		{
			parent::__construct();
		  
		   $this->load->model('article_model');
			
		}
	
	public function index()
	{
		$data['page_title'] 	= "Articles List" ; 		
		$data['article_list'] 	= $this->article_model->get_article_list();
		$this->load->view('header',$data);
		$this->load->view('articles',$data);
		$this->load->view('footer',$data);
	}
	
	public function view_article($article_tag=NULL)
	{
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
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email_id', 'Email ID', 'required|trim');
		
		if($this->form_validation->run() == FALSE)
		{
			 $this->session->set_flashdata("error","Comment is required");
			 redirect('home/view_article/'.$article_id);
		}
		else
		{
			
		    $post_data = $this->input->post(NULL,true);							
		    $add_data  = $this->article_model->add_comment($post_data);
			if(!empty($add_data)){					
					$this->session->set_flashdata("success","Comment Added Successfully");
					redirect('home/view_article/'.$article_tag);
			} else {
				$this->session->set_flashdata("error","Please Try Again");
				redirect('home/view_article/'.$article_tag);
			}
			 
				
		}
	 }
	
}
