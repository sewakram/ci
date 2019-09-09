
<?php echo validation_errors(); ?>

<?php echo form_open('users/forget'); ?>
<div class="clear"></div>
<div class="container">
<div class="login-section">

	<div class="loginbox">
	<h1 class="text-center"><?= $title ?></h1>
	<label>Please enter email</label>
	<input type="text" name="username" class="form-control" required autofocus><div class="clear"></div>
	<button type="submit" class="btn btn-primary btn-block btn-submit">Submit</button>
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