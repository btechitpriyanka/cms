  <div class="col-md-12">
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
                <div class="col-md-12">
                  <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
              </div>
          </div>

<div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="<?php echo base_url()."login/loginMe";?>"  method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="user_name" class="text-info">Username:</label><br>
                                <input type="text" name="user_name" id="user_name" class="form-control" value="<?php echo set_value('user_name'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_pass" class="text-info">Password:</label><br>
                                <input type="text" name="user_pass" id="user_pass" class="form-control" value="<?php echo set_value('user_pass'); ?>">
                            </div>
                            <div class="form-group">
                             
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>