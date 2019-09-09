<style type="text/css">
	
	.row {
	margin-bottom: 5% !important;
	margin-top: 5% !important;
    width: 300px;
    margin: 0 auto;
}
</style>

<div class="container">
	<div class="login-section">
	<div class="loginbox">
		<?php echo validation_errors(); ?>
		<?php echo form_open_multipart('users/register'); ?>
		<h1 class="text-center"><?= $title ?></h1>
		   
		   	 <label>Name</label>
		   	 <input type="text" class="form-control" name="name"><div class="clear"></div>
		   
		   
		   	 <label>Username</label>
		   	 <input type="text" name="username" class="form-control"><div class="clear"></div>
		   
		   
		   	 <label>Email</label>
		   	 <input type="text" name="email" class="form-control"><div class="clear"></div>
		   
		   
		   	 <label>Password</label>
		   	 <input type="password" class="form-control" id="password" name="password"><div class="clear"></div>
		   
		   
		   	 <label>Confirm Password</label>
		   	 <input type="password" class="form-control" name="password2"><div class="clear"></div>
		   
		   
		   	 <label>Zipcode</label>
		   	 <input type="text" name="zipcode" class="form-control"><div class="clear"></div>
		   
		   <button type="submit" class="btn btn-primary btn-submit">Register</button>
		<?php echo form_close() ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$().ready(function() {

// validate signup form on keyup and submit
jQuery.validator.addMethod("lettersonly", function(value, element) 
{
return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters and spaces only please"); 

		$("form").validate({
			rules: {
				name: {
					required:true,
					lettersonly: true
				},
				username: {
					required:true,
					minlength:6,
					lettersonly: true
				},
				mobile: {
					required:true,
					number: true,
					minlength:10
				},
				
				zipcode: {
					required:true,
					minlength:4
				},
				password: {
					required: true,
					minlength: 5
				},
				password2: {
					required: true,
					minlength: 5,
					equalTo: "#password",
				},

				email: {
					required: true,
					email: true
				},
				
			},
			messages: {
				name:{
					required:"Please enter your firstname",
					lettersonly: "Please enter valid alphabet",
				} ,
				username:{
					required:"Please enter your username",
					minlength: "Username must be at least 6 character",
					lettersonly: "Please enter valid alphabet",
				},
				
				mobile:{
					required: "Please enter mobile no.",
					number: "Please enter valid number",
					minlength: "Mobile number must be at least 10 digits",
				},
				zipcode:{
					required: "Please enter zip code",
					minlength: "Zip code must be at least 4 digits alphanumeric",
				},
				
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				password2: {
					required: "Please provide a conform password",
					minlength: "Your password must be at least 5 characters long",
					// equalTo: "Please enter the same password as above"
				},
				email:{
				required:"Please enter a email address",
				email:"Please enter a valid email address"
					
				} 
				
			}
		});
		
});
</script>