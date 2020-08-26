   <div class="container">


  <div class="row">
  <!-- Button trigger modal -->
  

				<h5 class="col-md-6 pull-left"> <?php
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
				  </h5>
	
 <div class="col-md-12">

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Username</th>
    </tr>
  </thead>
 
  <tbody id="tbl_body">
  <?php if(!empty($user_list)){ ?>
  <?php foreach ($user_list as $key=>$user){
	  ?>
    <tr>
      <th scope="row"><?php echo $key+1 ?></th>
      <td><?php echo $user['display_name'] ?></td>
      <td><?php echo $user['email_id'] ?></td>
      <td><?php echo $user['user_name'] ?></td>
     
    </tr>
<?php } } else { echo "<tr>  <td colspan='6'> No Record Found !!</td> </tr>";}  ?>
  </tbody>
</table>
  
 	
  </div>
  </div>
  </div>
  
  
