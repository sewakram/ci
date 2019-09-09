<div class="container">
<div class="login-section">
<div class="loginbox publish-register">
						
						<?php echo form_open_multipart('publisher/register'); ?>
						<h1 class="text-center"><?= $title ?></h1>
<div class="pub-md-6">						
<label class="col-sm-4 ">First Name</label>
<input type="text" id="firstname" name="firstname" value="" title="First Name" class="form-control form-txt-primary"><div class="clear"></div>
</div>

<div class="pub-md-6">						    
<label>Last Name</label>			    
<input type="text" id="lastname" name="lastname" value="" title="Last Name" class="form-control form-txt-primary"><div class="clear"></div>
</div><div class="clear"></div>

<div class="pub-md-6">
<label>Publishing Company Name</label>
<input type="text" id="publisher" name="publisher" value="" title="Publishing Company Name" class="form-control form-txt-primary"><div class="clear"></div>
</div>

<div class="pub-md-6">
<label>No of Magazines</label>
<select  id="magNo" name="magNo" required="" class="form-control form-control-primary">
						      <option value="">No of magazines</option>
						      <option value="1">1</option>
						      <option value="3">upto 3</option>
						      <option value="5">upto 5</option>
						      <option value="7">upto 7</option>
						      <option value="10">upto 10</option>
						      <option value="15">More than 10</option>
						</select><div class="clear"></div>
	</div><div class="clear"></div>
<div class="pub-md-6">
<label>Email</label>
<input type="text"  name="email" class="form-control form-txt-primary"><div class="clear"></div>
</div>

<div class="pub-md-6">						    
<label >Password</label>
<input type="password"  name="password" class="form-control form-txt-primary"><div class="clear"></div>
</div><div class="clear"></div>

<div class="pub-md-6">
<label >Mobile No</label>
<input type="text" name="mobile" value="" title="Mobile Number" id="mobile" class="form-control form-txt-primary"><div class="clear"></div>
</div>

<div class="pub-md-6">
<label >Address Line</label>
<input type="text" name="address1" id="address1" value="" title="address1" class="form-control form-txt-primary"  ><div class="clear"></div>
	</div><div class="clear"></div>
<div class="pub-md-6">
<label >Country</label>	
<select  id="country" name="country"  class="form-control form-control-primary">
<option value="">Select your country</option>

<?php foreach($countrys as $country) { ?>

<option value="<?php echo $country['id'];?>" ><?php echo $country['nicename'];?> </option>
<?php } ?>

</select><div class="clear"></div>
</div>						

<div class="pub-md-6">						
<label >Zip/Postal Code</label>
<input type="text" name="zip" id="zip" value="" title="Zip/Postal Code" class="form-control form-txt-primary" placeholder="Zip/Postal Code"><div class="clear"></div>
</div><div class="clear"></div>

<div class="pub-md-6 full">						   
<label >How did you hear about us</label>
<select  id="hear" name="hear"  class="form-control form-control-primary">
						        <option value="">Select</option>
						        <option>Idondza Sales Representative</option>
						        <option>Apple App Store Presence</option>
						        <option>Android App Store Presence</option>
						        <option>Idondza Article About Idondza</option>
						        <option>Saw Newsstand App powered by Idondza</option>
						        <option>Saw in-magazine promotion of Idondza</option>
						        <option>Online Ads by Idondza</option>
						        <option>Web Search</option>
						        <option>Publisher Referral</option>
						        <option >Word of Mouth</option>
						        <option >User Request</option>
						        <option >Other</option>
						</select><div class="clear"></div>
</div><div class="clear"></div>
						 

<button type="submit" name="submit" class="btn btn-primary btn-submit register">Register</button>
						    
						</div>


						</form>
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
				firstname: {
					required:true,
					lettersonly: true
				},
				lastname:{
					required:true,
					lettersonly: true
				} ,
				publisher: "required",
				magNo: "required",
				mobile: {
					required:true,
					number: true,
					minlength:10
				},
				address1: "required",
				country: "required",
				hear: "required",
				zip: {
					required:true,
					minlength:4
				},
				password: {
					required: true,
					minlength: 5
				},
				email: {
					required: true,
					email: true
				},
				
			},
			messages: {
				firstname: {
					required:"Please enter your firstname",
					lettersonly: "Please enter valid alphabet",
				},
				lastname: {
					required:"Please enter your lastname",
					lettersonly: "Please enter valid alphabet",
				},
				publisher: "Please enter publishing company name",
				magNo: "Please select no. of magazines",
				mobile:{
					required: "Please enter mobile no.",
					number: "Please enter valid number",
					minlength: "Mobile number must be at least 10 digits",
				},
				zip:{
					required: "Please enter zip code",
					minlength: "Zip code must be at least 4 digits alphanumeric",
				},
				address1: "Please enter address",
				country: "Please select country",
				hear: "Please select how did you hear abou us",
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 5 characters long"
				},
				email: "Please enter a valid email address",
				
			}
		});
		
});
</script>