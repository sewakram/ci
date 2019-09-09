<div class="container">

<div class="login-section">
  <h2><?= $title ?></h2>
<div class="user-prof-left">
<?php
$this->load->view('users/sidebar');
?>
</div>
    <div class="loginbox profile">
            
            <?php echo validation_errors(); ?>
            <?php echo form_open_multipart('users/profile'); ?>
            <h2 class="text-center"><?= $title ?></h3>
             <label>Name</label>
             <input type="text" class="form-control" value="<?php  echo $profiledata['name']; ?>" name="name" placeholder="Name"><div class="clear"></div>
             <label>Username</label>
             <input type="text" name="username" value="<?php  echo $profiledata['username']; ?>" disabled readonly="readonly" class="form-control" placeholder="Username"><div class="clear"></div>
             <label>Email</label>
             <input type="text" name="email" value="<?php  echo $profiledata['email']; ?>" disabled readonly="readonly" class="form-control" placeholder="Email"><div class="clear"></div>
            <label>Mobile No.</label>
            <input type="text" name="contact" value="<?php  echo $profiledata['contact']; ?>" class="form-control" placeholder="Mobile No."><div class="clear"></div>
                <label>Address</label>
                <input type="text"  name="address" value="<?php echo $profiledata['address']; ?>" class="form-control" placeholder="Address"><div class="clear"></div>
            <label>Gender</label><div class="clear"></div>
<label class="genoption">
                    <input value="Female" <?php if($profiledata['gender'] == 'Female'){ echo "checked"; } ?> name="gender" checked="" class="gender" type="radio"><i class="helper"></i> <span>Female</span>
                </label>
            
                <label class="genoption">
                    <input value="Male" <?php if($profiledata['gender'] == 'Male'){ echo "checked"; } ?> name="gender" class="gender" type="radio"><i class="helper"></i> <span>Male</span>
                </label><div class="clear"></div>
                <label>Date of Birth</label>
                
                <input type="text" id="dropper-default"  value="<?php echo $profiledata['dob']; ?>" name="dob" class="form-control" placeholder="Select Your Birth Date"><div class="clear"></div>
            <div id="datepicker"></div>
             <label>Zipcode</label>
             <input type="text" name="zipcode" value="<?php echo $profiledata['zipcode']; ?>"  class="form-control" placeholder="Zipcode">
          <div class="clear"></div>
            <button type="submit" name="submit" class="btn btn-primary btn-submit">Update</button>
            <?php echo form_close() ?>
            
    </div><div class="clear"></div>

</div>

</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#dropper-default" ).datepicker({
  dateFormat: "dd-mm-yy",
  changeYear: true
});
  } );
  </script>