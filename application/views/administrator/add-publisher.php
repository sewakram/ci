   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css" />

    
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Publishers</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Publishers</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add Publishers</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page header end -->
            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5>Add Publishers</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                    <i class="icofont icofont-close-circled"></i>
                                </div>
                            </div>
                            <div class="card-block">
                             <div class="col-sm-8">
                                 <div class="validation_errors_alert">

                                </div>
                            </div>
                             <div class="col-sm-8">
                               <?php echo form_open_multipart('administrator/add_publisher'); ?>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">First Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="firstname" name="firstname" value="" title="First Name" class="form-control form-txt-primary"  placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Last Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="lastname" name="lastname" value="" title="Last Name" class="form-control form-txt-primary" placeholder="Last Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Publishing Company Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="publisher" name="publisher" value="" title="Publishing Company Name" class="form-control form-txt-primary" placeholder="Publishing Company Name">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">No of Magazines</label>
                                    <div class="col-sm-8">
                                    <select  id="magNo" name="magNo" required="" class="form-control form-control-primary">
                                          <option value="">No of magazines</option>
                                          <option value="1">1</option>
                                          <option value="3">upto 3</option>
                                          <option value="5">upto 5</option>
                                          <option value="7">upto 7</option>
                                          <option value="10">upto 10</option>
                                          <option value="15">More than 10</option>
                                    </select>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="text"  name="email" class="form-control form-txt-primary" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Password</label>
                                        <div class="col-sm-8">
                                            <input type="password"  name="password" class="form-control form-txt-primary" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Mobile No</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="mobile" value="" title="Mobile Number" id="mobile" class="form-control form-txt-primary" placeholder="Mobile Number">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Address Line</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="address1" id="address1" value="" title="address1" class="form-control form-txt-primary"  placeholder="Address Line">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Country</label>
                                    <div class="col-sm-8">
                                    <select  id="country" name="country"  class="form-control form-control-primary">
                                          <option value="">Select your country</option>
                                         
                                          <?php foreach($countrys as $country) { ?>
                                         
                                          <option value="<?php echo $country['id'];?>" ><?php echo $country['nicename'];?> </option>
                                          <?php } ?>
                                         
                                    </select>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Zip/Postal Code</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="zip" id="zip" value="" title="Zip/Postal Code" class="form-control form-txt-primary" placeholder="Zip/Postal Code">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">How did you hear about us</label>
                                    <div class="col-sm-8">
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
                                    </select>
                                    </div>
                                    </div>
                                     
                                    
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                    
                                    
                                </form>
                               </div>
                                   
                                </div>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->
                   

     <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/swithces.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.js"></script>

   
    <!-- ck editor -->
    <script src="<?php echo base_url(); ?>admintemplate/bower_components/ckeditor/ckeditor.js"></script>
    <!-- echart js -->
  
    <script src="<?php echo base_url(); ?>admintemplate/assets/pages/user-profile.js"></script>
    <script type="text/javascript">
    $().ready(function() {

// validate signup form on keyup and submit
        $("form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5
                },
                magNo: {
                    required: true,
                   
                },
                publisher: {
                    required: true,
                   
                },
                lastname: {
                    required: true,
                   
                },
                firstname: {
                    required: true,
                   
                },
                address1: {
                    required: true,
                   
                },
                country: {
                    required: true,
                   
                },
                hear: {
                    required: true,
                   
                },
                mobile: {
                    required:true,
                    number: true,
                    minlength:10
                },
                email: {
                    required: true,
                    email: true
                }
                
            },
            messages: {
                magNo: {
                    required: "Please select no. of magazines",
                    
                },
                hear: {
                    required: "Please select How did you hear about us",
                    
                },
                address1: {
                    required: "Please enter address",
                    
                },
                country: {
                    required: "Please select country",
                    
                },
                publisher: {
                    required: "Please enter publishing Company",
                    
                },
                lastname: {
                    required: "Please enter last name",
                    
                },
                firstname: {
                    required: "Please enter first name",
                    
                },
                mobile: {
                    required: "Please enter mobile number",
                    number:"Only number acceptable"
                },
            
                email: {
                    required: "Please enter email id as username",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },           
            }
        });
        
});
</script>