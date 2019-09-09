   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css" />

    
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Publisher</h4>
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
                        <li class="breadcrumb-item"><a href="#!">Update Publisher</a>
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
                                <h5>Update Publisher -- <small style="text-decoration: underline;"><?php echo $publisher['username']; ?></small></h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                    <i class="icofont icofont-close-circled"></i>
                                </div>
                            </div>
                            <div class="card-block">
                             <div class="col-sm-8">
                               <?php echo form_open_multipart('administrator/update_publisher_data'); ?>
                                     <input type="hidden" name="id" class="form-control" value="<?php echo $publisher['user_id']; ?>">

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Full Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="name" class="form-control form-txt-primary" value="<?php echo $publisher['name']; ?>" placeholder="Full Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Publishing Company Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="publisher" name="publisher" title="Publishing Company Name" class="form-control form-txt-primary" value="<?php echo $publisher['publisher']; ?>" placeholder="Publishing Company Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">No of Magazines</label>
                                    <div class="col-sm-8">
                                    <select  id="magNo" name="magNo" required="" class="form-control form-control-primary">
                                          <option value="">No of magazines</option>
                                          <option value="1" <?php if($publisher['mag_no']==1) echo "selected"?>>1</option>
                                          <option value="3" <?php if($publisher['mag_no']==3) echo "selected"?>>upto 3</option>
                                          <option value="5" <?php if($publisher['mag_no']==5) echo "selected"?>>upto 5</option>
                                          <option value="7" <?php if($publisher['mag_no']==7) echo "selected"?>>upto 7</option>
                                          <option value="10" <?php if($publisher['mag_no']==10) echo "selected"?>>upto 10</option>
                                          <option value="15" <?php if($publisher['mag_no']==15) echo "selected"?>>More than 10</option>
                                    </select>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="text"  name="email" class="form-control form-txt-primary" value="<?php echo $publisher['email']; ?>" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Mobile No.</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="contact" value="<?php echo $publisher['contact']; ?>" class="form-control form-txt-primary" placeholder="Mobile No.">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Address</label>
                                        <div class="col-sm-8">
                                            <input type="text"  name="address" value="<?php echo $publisher['address']; ?>" class="form-control form-txt-primary" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Country</label>
                                    <div class="col-sm-8">
                                    <select  id="country" name="country"  class="form-control form-control-primary">
                                          <option value="">Select your country</option>
                                         
                                          <?php foreach($countrys as $country) { ?>
                                         
                                          <option value="<?php echo $country['id'];?>" <?php if($country['id']==$publisher['cid']) echo "selected";?>><?php echo $country['nicename'];?> </option>
                                          <?php } ?>
                                           </select>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Zipcode</label>
                                        <div class="col-sm-8">
                                            <input type="text"  name="zipcode" value="<?php echo $publisher['zipcode']; ?>" class="form-control form-txt-primary" placeholder="Zipcode">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">How did you hear about us</label>
                                    <div class="col-sm-8">
                                    <select  id="hear" name="hear"  class="form-control form-control-primary">
                                            <option value="">Select</option>
                                            <option <?php if($publisher['hear']==='Magzter Sales Representative') echo "selected"?>>Magzter Sales Representative</option>

                                            <option <?php if($publisher['hear']==='Apple App Store Presence') echo "selected"?>>Apple App Store Presence</option>

                                            <option <?php if($publisher['hear']==='Android App Store Presence') echo "selected"?>>Android App Store Presence</option>

                                            <option <?php if($publisher['hear']==='Magazine Article About Magzter') echo "selected"?>>Magazine Article About Magzter</option>

                                            <option <?php if($publisher['hear']==='Saw Newsstand App powered by Magzter') echo "selected"?>>Saw Newsstand App powered by Magzter</option>

                                            <option <?php if($publisher['hear']==='Saw in-magazine promotion of Magzter') echo "selected"?>>Saw in-magazine promotion of Magzter</option>

                                            <option <?php if($publisher['hear']==='Online Ads by Magzter') echo "selected"?>>Online Ads by Magzter</option>

                                            <option <?php if($publisher['hear']==='Web Search') echo "selected"?>>Web Search</option>

                                            <option <?php if($publisher['hear']==='Publisher Referral') echo "selected"?>>Publisher Referral</option>

                                            <option <?php if($publisher['hear']==='Word of Mouth') echo "selected"?>>Word of Mouth</option>

                                            <option <?php if($publisher['hear']==='User Request') echo "selected"?>>User Request</option>

                                            <option <?php if($publisher['hear']==='Other') echo "selected"?>>Other</option>
                                    </select>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Want to make Enable?</label>
                                        <div class="col-sm-5">
                                            <div class="checkbox-fade fade-in-primary">
                                            <label>
                                            <input type="checkbox" value="1" name="status" class="js-single" <?php if($publisher['status'] == '1'){ echo "checked"; } ?> />
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label"></label>
                                        <div class="col-sm-8">
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
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
               
                magNo: {
                    required: true,
                   
                },
                publisher: {
                    required: true,
                   
                },
                name: {
                    required: true,
                   
                },
                
                address: {
                    required: true,
                   
                },
                country: {
                    required: true,
                   
                },
                hear: {
                    required: true,
                   
                },
                contact: {
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
                address: {
                    required: "Please enter address",
                    
                },
                country: {
                    required: "Please select country",
                    
                },
                publisher: {
                    required: "Please enter publishing Company",
                    
                },
                
                name: {
                    required: "Please enter full name",
                    
                },
                contact: {
                    required: "Please enter mobile number",
                    number:"Only number acceptable"
                },
            
                email: {
                    required: "Please enter email id as username",
                    email: "Please enter a valid email address"
                },
                           
            }
        });
        
});
</script>