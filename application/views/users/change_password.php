<div class="container">

<div class="login-section">
<div class="user-prof-left">
<?php
$this->load->view('users/sidebar');
?>
</div>
    <div class="loginbox profile">
                            <!-- <?php //if(validation_errors()){?>
                                <div class="alert alert-danger fade in alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                <strong>Danger!</strong> <?php //echo validation_errors(); ?>
                                </div>
                             <?php //}

                             //if(!empty($success)){?>
                                <div class="alert alert-success fade in alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                <strong>Success!</strong> <?php //echo $success ?>
                                </div>
                            <?php //} ?> -->
   
        
                            <h2 class="text-center"><?= $title ?></h2>
                            
                            <?php echo form_open_multipart('users/changepassword'); ?>
                              <label>Email</label>
                                <input type="text" name="email" disabled="" value="<?php echo $this->session->userdata('email'); ?>" class="form-control"><div class="clear"></div>
                                        
                                        <div id="password_error" style="font-size:12px;"></div><div class="clear"></div> 
                                    

                                        <label>Current Password*</label>
                                        <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old Password"><div class="clear"></div>
                                        
                                        <div id="password_error" style="font-size:12px;"></div><div class="clear"></div> 
                                    
                                     
                                        <label>New Password*</label>
                                         <input type="password" autocomplete="off" name="new_password" id="new_password" class="form-control" placeholder="New Password"><div class="clear"></div>
                                        

                                     
                                        <label>Confirm New Password*</label>
                                        <input type="password" id="confirm_new_password" onkeyup="checkPass(); return false;" name="confirm_new_password" class="form-control" placeholder="Confirm New Password"><div class="clear"></div>
                                        
                                   <div class="clear"></div>
                                   <button type="submit" name="submit" class="btn btn-primary btn-submit">Submit</button>
                                        
                                    
                                    
                                </form>
    

</div>
<div class="clear"></div>
</div>

</div>

<script type="text/javascript">
    $().ready(function() {
        $("form").validate({
            rules: {
                        old_password: {
                        required: true,
                        minlength: 5
                        },
                        new_password: {
                        required: true,
                        minlength: 5
                        },
                        confirm_new_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#new_password",
                        }
                    },
            messages: {
                        old_password: {
                        required: "Please provide a current password",
                        minlength: "Your password must be at least 5 characters long"
                        },
                        new_password: {
                        required: "Please provide a new password",
                        minlength: "Your password must be at least 5 characters long"
                        },
                        confirm_new_password: {
                        required: "Please provide a new conform password",
                        minlength: "Your password must be at least 5 characters long",
                        // equalTo: "Please enter the same password as above"
                        }
                     }
        });
        
});
</script>