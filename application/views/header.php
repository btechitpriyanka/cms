<html>
<head>
<title>CMS Assignment | <?php echo isset($page_title)?$page_title:"";?></title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body>
 <?php if($this->session->userdata('is_logged_in')){ ?>
 <h5>Hi, <?php echo $this->session->userdata('display_name');?></h5>
  <a href="<?php echo base_url()."logout";?>" ><h5>Logout</h5> </a>
  <a href="<?php echo base_url()."articles/list_articles";?>"><h5>List Articles</h5> </a>
  
  <a href="<?php echo base_url()."articles/add_article";?>"><h5>Add New Article</h5> </a>
   <?php if($this->session->userdata('is_admin') =="1"){ ?>
  <a href="<?php echo base_url()."articles/add_user";?>"><h5>Add New User</h5> </a>
  <a href="<?php echo base_url()."articles/list_users";?>"><h5>List Users</h5> </a>
  <?php }?>
 <?php } else { ?>
 
   <a href="<?php echo base_url()."login";?>"><h5>Login</h5> </a>
    <?php }?>
	
	   <a href="<?php echo base_url()."home";?>"><h5>Home</h5> </a>