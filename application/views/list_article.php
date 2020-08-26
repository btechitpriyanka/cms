   <div class="container">

 <div class="row">

    <div class="col-md-4">
	<a class="btn btn-primary" href="<?php echo base_url()."/articles/add_article/"  ?>">
 Add New
 

</a>
	</div>
  </div>
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
      <th scope="col">Article Image</th>
      <th scope="col">Tag</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
 
  <tbody id="tbl_body">
  <?php if(!empty($article_list)){ ?>
  <?php foreach ($article_list as $key=>$article){
	  ?>
    <tr>
      <th scope="row"><?php echo $key+1 ?></th>
      <td><img src="<?php echo base_url()."assets/images/".$article['article_img'] ?>" width="300" height="200" /></td>
      <td><a href="<?php echo base_url()."articles/view_article/".urldecode($article["article_tag"]);?>" > <?php echo $article['article_tag'] ?> </a></td>
      <td><?php echo $article['article_name'] ?></td>
      <td><?php echo $article['article_desc'] ?></td><td>	 
	  <a class="btn btn-primary"  href="<?php echo base_url()."/articles/edit_article/".urldecode($article["article_tag"]) ?>" >Edit</a> &nbsp;

	</td>
    </tr>
<?php } } else { echo "<tr>  <td colspan='6'> No Record Found !!</td> </tr>";}  ?>
  </tbody>
</table>
  
 	
  </div>
  </div>
  </div>
  
  
