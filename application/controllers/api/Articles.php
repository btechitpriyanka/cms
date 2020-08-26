<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

//include Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Articles extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        
        //load user model
        $this->load->model('article_model');
    }
    
    public function index_get($id = null) {
		
        $data['article_id'] = $this->get('article_id');
        $data['article_tag'] = $this->get('article_tag');
		
        $articles = $this->article_model->get_article_list($data);
        
        //check if the user data exists
        if(!empty($articles)){
            //set the response and exit
            $this->response($articles, REST_Controller::HTTP_OK);
        }else{
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'message' => 'No article were found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function index_post() {
        $articleData = array();
        $articleData['article_tag'] = $this->post('article_tag');
        $articleData['article_name'] = $this->post('article_name');
        $articleData['article_desc'] = $this->post('article_desc');
        $articleData['article_img'] = $this->post('article_img');
        if(!empty($articleData['article_tag']) && !empty($articleData['article_name']) && !empty($articleData['article_desc']) && !empty($articleData['article_img'])){
            
            $insert = $this->article_model->add_article_details($articleData);
            
            //check if the data inserted
            if($insert){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Article has been added successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response("Provide complete Article information to create.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function index_put() {
        $articleData = array();
        $articleData['article_name'] = $this->put('article_name');
        $articleData['article_desc'] = $this->put('article_desc');
        $articleData['article_img'] = $this->put('article_img');
        $articleData['article_tag'] = $this->put('article_tag');
        if(!empty($articleData['article_tag']) && !empty($articleData['article_img']) && !empty($articleData['article_desc']) && !empty($articleData['article_name'])){
           
            $update = $this->article_model->update_article_details($articleData);
         
            if($update){
                //set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'Article has been updated successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                //set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            //set the response and exit
            $this->response("Provide complete user information to update.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    
}

?>