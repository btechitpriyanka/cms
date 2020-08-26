  <div class="container">
  <div class="row">
  <!-- Button trigger modal -->
 <div class="row">
               <div class="col-md-6">
                  <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
               </div>
            </div>
 <div class="col-md-6"> 
     <h4 class="modal-title">Article Details</h4>

<?php if(!empty($article_details)){ ?>

 <div class="form-group">
    <label for="article_tag">Tag: <?php echo $article_details[0]["article_tag"]?></label>
  
  </div>  
  <div class="form-group">
    <label for="article_name">Name: <?php echo $article_details[0]["article_name"]?></label>

  </div>  
  <div class="form-group">
    <label for="article_desc">Description:<?php echo $article_details[0]["article_desc"]?></label>
 
  </div>   
  <div class="form-group">
    <label for="article_desc">Upload Image:</label>
	<img  src="<?php echo base_url()."assets/images/".$article_details[0]["article_img"]?>" width="100" height="100"/>
    
  </div>  <ul>
  <?php if(!empty($comment_details)) {
	  foreach($comment_details as $comment) {
		  echo "<li>".$comment['comment']. " - By ".$comment['name'] ."-".$comment['created_dt']." </li>";
  }}
	  
	  ?>
	  </ul>
 <?php if(!$this->session->userdata('is_logged_in')){ ?>
<form action="<?php echo base_url()."/home/add_comment"; ?>" method="post">
 <input type="hidden" class="form-control" id="article_id" name="article_id" maxlength="100" required value="<?php echo $article_details[0]["article_id"]?>">
 <input type="hidden" class="form-control" id="article_tag" name="article_tag" maxlength="100" required value="<?php echo $article_details[0]["article_tag"]?>">
   <div class="form-group">
 <textarea  id="article_comment" class="form-control" name="article_comment" required rows="5" Placeholder="Write Comment"></textarea>
   </div> 
  <div class="form-group col-md-6">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
  </div>   
  <div class="form-group col-md-6">
    <label for="name">Email:</label>
    <input type="email" class="form-control" id="email_id" name="email_id" maxlength="100" required>
  </div>  
   <button type="submit" class="btn btn-success">Submit</button>
</form>

 <?php } ?>

<?php } else { ?>
  <div class="alert alert-danger alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         Article details not found !!!
   </div>
<?php }  ?>
  
 	
  </div>
  </div>
  </div>
  
