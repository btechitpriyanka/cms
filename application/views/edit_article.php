  <div class="container">
  <div class="row">
  <!-- Button trigger modal -->
    <div class="row">
               <div class="col-md-6">
                  <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
               </div>
            </div>
 <div class="col-md-6"> 

                    <h4 class="modal-title">Edit Article Details</h4>

<?php if(!empty($article_details)){ ?>
<form action="<?php echo base_url()."/articles/edit_article/".$article_details[0]["article_tag"] ?>" method="post" enctype="multipart/form-data">
 <div class="form-group">
    <label for="article_tag">Tag: <?php echo $article_details[0]["article_tag"]?></label>
    <input type="hidden" class="form-control" id="article_tag" name="article_tag" maxlength="100" required value="<?php echo $article_details[0]["article_tag"]?>">
  </div>  
  <div class="form-group">
    <label for="article_name">Name:</label>
    <input type="text" class="form-control" id="article_name" name="article_name" maxlength="100" required value="<?php echo $article_details[0]["article_name"]?>">
  </div>  
  <div class="form-group">
    <label for="article_desc">Description:</label>
 	<textarea  class="form-control" id="article_desc" name="article_desc"  required rows="10"><?php echo $article_details[0]["article_desc"]?></textarea>
  </div>   
  <div class="form-group">
    <label for="article_desc">Upload Image:</label>
	<img  src="<?php echo base_url()."assets/images/".$article_details[0]["article_img"]?>" width="100" height="100"/>
    <input type="file" class="form-control" id="article_img" name="article_img" >
  </div>  


  <div class="modal-footer">
  <button type="submit" class="btn btn-success">Update</button>
  </div>
</form>



<?php } else { ?>
  <div class="alert alert-danger alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         Article details not found !!!
   </div>
<?php }  ?>
  
 	
  </div>
  </div>
  </div>
  
