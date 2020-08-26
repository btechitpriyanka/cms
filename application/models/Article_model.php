<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Description of Model
 *
 * 
 */
class Article_model extends CI_Model {
	
    public function __construct() {
        parent::__construct();
		
    }
	
	function get_article_list($data=null)
    {
		$where['is_active'] = "1";	
		if(!empty($data['article_tag']))
		 {
			 $where['article_tag'] = $data['article_tag'];
		 }
		 if(!empty($data['article_id']))
		 {
			 $where['article_id'] = $data['article_id'];
		 }
		 if(!empty($data['created_by']))
		 {
			 $where['created_by'] = $data['created_by'];
		 }
			
		$article_list = $this->query->get_details('*','tbl_articles',$where,NULL,'article_tag desc');
		return $article_list;
    }
	function get_comment_list($data=null)
    {
		$where['is_active'] = "1";	
		if(!empty($data['article_tag']))
		 {
			 $where['article_tag'] = $data['article_tag'];
		 }
		$join = array('tbl_article_comment as comment'=>'comment.article_id=tbl_articles.article_id');	
		$comment_list = $this->query->get_all_details('comment.*','tbl_articles',$join,$where,NULL,'created_dt desc');
		return $comment_list;
    }
	
	function add_article_details($post_data=null)
    {
		$article_tag   				= $post_data['article_tag'];
		$article_name  				= $post_data['article_name'];
		$article_desc  				= $post_data['article_desc'];
		$article_img  				= $post_data['article_img'];
		$created_by     			= $this->session->userdata('user_id');	
		$is_active	   				= "1";		
		
		// Check Tag exist
		$article_details = $this->query->get_details('*','tbl_articles',array('article_tag'=>$article_tag));
		if(!empty($article_details)){
			return false;
		} else {
		$data_array = array('article_tag'=>$article_tag,
		'article_name'=>$article_name,
		'article_desc'=>$article_desc,
		'article_img'=>$article_img,
		'is_active'=>$is_active,
		'created_by'=>$created_by, 
		'created_dt'=>date('Y-m-d H:i:s'));
		$article_id    = $this->query->insert('tbl_articles',$data_array);
		return $article_id;
		}
    }
	
	function update_article_details($post_data=null)
    {
		//$article_id   			= $post_data['article_id'];
		$article_tag   				= $post_data['article_tag'];
		$article_name  				= $post_data['article_name'];
		$article_desc  				= $post_data['article_desc'];
		$article_img  				= $post_data['article_img'];
		$modified_by     			= $this->session->userdata('user_id');	
		$is_active	   				= "1";	
		
		$data_array = array(
		'article_name'=>$article_name,
		'article_desc'=>$article_desc,		
		'is_active'=>$is_active,
		'modified_by'=>$modified_by, 
		'modified_dt'=>date('Y-m-d H:i:s'));
		
		if(!empty($article_img))
		{
			$data_array['article_img']= $article_img;
		}
		
		$where  = array('article_tag'=>$article_tag);
		$update_id = $this->query->update('tbl_articles',$data_array,$where);
		if($update_id){return true; } else { return false; }
    }
	function add_comment($post_data=null)
    {
		$article_id   		= $post_data['article_id'];
		$article_comment  	= $post_data['article_comment'];
		$email_id  			= $post_data['email_id'];
		$name  				= $post_data['name'];
		$data_array = array('article_id'=>$article_id,
		'comment'=>$article_comment,
		'email_id'=>$email_id,
		'name'=>$name,
		'created_dt'=>date('Y-m-d H:i:s'));
		$comment_id    = $this->query->insert('tbl_article_comment',$data_array);
		return $comment_id;

    }
	
	function get_user_list($data=null)
    {
		$where['is_active']    = "1";	
		$where['user_role_id'] = "2";	
		$user_list = $this->query->get_details('*','tbl_user_mst',$where,NULL,'display_name');
		return $user_list;
    }
	
	function add_new_user($post_data=null)
    {
		$name   				= $post_data['name'];
		$username  				= $post_data['username'];
		$password  				= $post_data['password'];
		$email_id  				= $post_data['email_id'];
		$created_by     		= $this->session->userdata('user_id');	
		$is_active	   			= "1";		
		
		// Check Tag exist
		$user_details = $this->query->get_details('*','tbl_user_mst',array('user_name'=>$username));
		if(!empty($user_details)){
			return false;
		} else {
		$data_array = array('display_name'=>$name,
		'user_name'=>$username,
		'email_id'=>$email_id,
		'user_role_id'=>"2",
		'user_password'=>password_hash($password,PASSWORD_DEFAULT),
		'is_active'=>$is_active,
		'created_by'=>$created_by, 
		'created_dt'=>date('Y-m-d H:i:s'));
		$user_id    = $this->query->insert('tbl_user_mst',$data_array);
		return $user_id;
		}
    }
	
	
}
