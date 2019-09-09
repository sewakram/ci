
<?php echo validation_errors(); ?>

<?php echo form_open('users/login'); ?>
<div class="clear"></div>
<div class="container">
<div class="login-section">

	<div class="loginbox">
	<h1 class="text-center"><?= $title ?></h1>
	<label>Enter email id as Username</label>
	<input type="text" name="username" class="form-control" required autofocus><div class="clear"></div>
	<label>Enter Password</label>
	<input type="password" class="form-control" name="password" required autofocus><div class="clear"></div>
	<button type="submit" class="btn btn-primary btn-block btn-submit login-btn">Login</button>
	<a id="login-button" class="btn-submit google-login" href="<?= 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email') . '&redirect_uri=' . urlencode($google_redirect_uri) . '&response_type=code&client_id=' . $google_client_id . '&access_type=online' ?>"><img src="<?php echo base_url(); ?>assets/images/front/google.png" class="googleimg" alt="Login with Google">Login with Google</a>
	<a class="btn btn-primary btn-block  register-reader btn-submit" href="<?php echo base_url();?>users/register">Reader Registration</a>
	<a class="forgot" href="<?php echo base_url();?>users/forget">Forgot Password?</a>
	
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
				},

				username: {
					required: true,
					email: true
				},
				
			},
			messages: {
			
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				username: {
					required: "Please enter email id as username",
					email: "Please enter a valid email address"
				},
				
				
				
			}
		});
		
});
</script>