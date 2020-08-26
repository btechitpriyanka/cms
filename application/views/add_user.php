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
<form action="<?php echo base_url()."/articles/add_user"; ?>" method="post" >
  <div class="form-group">
    <label for="name">Name:</label>
    <input type="text" class="form-control" id="name" name="name" maxlength="100" required>
  </div>  
  <div class="form-group">
    <label for="name">Email Id:</label>
    <input type="text" class="form-control" id="email_id" name="email_id" maxlength="100" required>
  </div> 

  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" id="username" name="username" maxlength="100" required>
  </div>  
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password" maxlength="25" required>
  </div>  
  
    <div class="modal-footer">
  <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>
  </div>
  </div>
  </div>
  
