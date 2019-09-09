
<?php echo validation_errors(); ?>

<?php echo form_open('users/resetpassword'); ?>
<div class="clear"></div>
<div class="container">
<div class="login-section">

	<div class="loginbox">
	<h1 class="text-center"><?= $title ?></h1>
	<input type="hidden" name="id" value="<?php echo $_GET['id']?>">
	<label>Enter New Password</label>
	<input type="password" class="form-control" name="password" required autofocus><div class="clear"></div>
	<button type="submit" class="btn btn-primary btn-block btn-submit">Reset Password</button>
	</div>
	</div>
</div>
<?php echo form_close() ?>
<script type="text/javascript">
	$().ready(function() {

// validate signup form on keyup and submit
		$("form").validate({
			rules: {
				password: {
					required: true,
					minlength: 5
				}
	
			},
			messages: {
			
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				}
				
			}
		});
		
});
</script>