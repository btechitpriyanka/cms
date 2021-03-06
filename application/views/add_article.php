  <div class="container">
  <div class="row">
  
  <!-- Button trigger modal -->
 <div class="col-md-6">
					<?php
						$this->load->helper('form');
						$error = $this->session->flashdata('error');
						if($error)
						{
						  ?>
					  <div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo $this->session->flashdata('error'); ?>
					  </div>
					  <?php } ?>
					  <?php  
							$success = $this->session->flashdata('success');
							if($success)
							{
						  ?>
					  <div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo $this->session->flashdata('success'); ?>
					  </div>
					  <?php } ?>

			<div class="row">
               <div class="col-md-6">
                  <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
               </div>
            </div>
<form action="<?php echo base_url()."/articles/add_article"; ?>" method="post" autocomplete="off" enctype="multipart/form-data">
  <div class="form-group">
    <label for="article_tag">Tag:</label>
    <input type="text" class="form-control" id="article_tag" name="article_tag" maxlength="100" required>
  </div>  
  <div class="form-group">
    <label for="article_name">Name:</label>
    <input type="text" class="form-control" id="article_name" name="article_name" maxlength="100" required>
  </div>  
  <div class="form-group">
    <label for="article_desc">Description:</label>
    <textarea  class="form-control" id="article_desc" name="article_desc" rows="10"  required></textarea>
  </div>   
  <div class="form-group">
    <label for="article_desc">Upload Image:</label>
    <input type="file" class="form-control" id="article_img" name="article_img" required>
  </div>  
    <div class="modal-footer">
  <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>
  </div>
  </div>
  </div>
  
