   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css" />
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script> -->

    
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Update Bank details</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Update Bank details</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Update Bank details</a>
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
                                <h5>Update Bank details</h5>
                                <div class="card-header-right">
                                    <i class="icofont icofont-rounded-down"></i>
                                    <i class="icofont icofont-refresh"></i>
                                    <i class="icofont icofont-close-circled"></i>
                                </div>
                            </div>
                            <div class="card-block">
                             <div class="col-sm-8">
                               <?php echo form_open_multipart('publisher/update_bank_details_data'); ?>
                                     <input type="hidden" name="id" class="form-control" value="<?php echo $this->session->userdata('user_id'); ?>">
                                   
                                     <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Account Number</label>
                                        <div class="col-sm-10">
                                            <input type="text"  name="acc_no" class="form-control form-txt-primary" value="<?php echo $bankdetails['acc_no']; ?>" placeholder="Account Number">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Account Name</label>
                                        <div class="col-sm-10">
                                            <input type="text"  name="acc_name" class="form-control form-txt-primary" value="<?php echo $bankdetails['acc_name']; ?>" placeholder="Account Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Name</label>
                                        <div class="col-sm-10">
                                            <input type="text"  name="bnk_name" class="form-control form-txt-primary" value="<?php echo $bankdetails['bnk_name']; ?>" placeholder="Bank Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Swift Code</label>
                                        <div class="col-sm-10">
                                            <input type="text"  name="bnk_swift" class="form-control form-txt-primary" value="<?php echo $bankdetails['bnk_swift']; ?>" placeholder="Bank Swift Code">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Routing Number</label>
                                        <div class="col-sm-10">
                                            <input type="text"  name="bnk_routing" class="form-control form-txt-primary" value="<?php echo $bankdetails['bnk_routing']; ?>" placeholder="Bank Routing Number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Ifsc Code</label>
                                        <div class="col-sm-10">
                                            <input type="text"  name="bnk_ifsc" class="form-control form-txt-primary" value="<?php echo $bankdetails['bnk_ifsc']; ?>" placeholder="Bank Ifsc Code">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Address Line 1</label>
                                        <div class="col-sm-10">
                                            <input type="text"  name="bnk_address1" class="form-control form-txt-primary" value="<?php echo $bankdetails['bnk_address1']; ?>" placeholder="Bank Address Line 1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Bank Address Line 2</label>
                                        <div class="col-sm-10">
                                            <input type="text"  name="bnk_address2" class="form-control form-txt-primary" value="<?php echo $bankdetails['bnk_address2']; ?>" placeholder="Bank Address Line 2">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">City</label>
                                        <div class="col-sm-10">
                                            <input type="text"   name="bnk_city" class="form-control form-txt-primary" value="<?php echo $bankdetails['bnk_city']; ?>" placeholder="City">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">State</label>
                                        <div class="col-sm-10">
                                            <input type="text"  name="bnk_state" class="form-control form-txt-primary" value="<?php echo $bankdetails['bnk_state']; ?>" placeholder="State">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                    <select  id="country" name="country"  class="form-control form-control-primary">
                                          <option value="">Select your country</option>
                                         
                                          <?php foreach($countrys as $country) { ?>
                                         
                                          <option value="<?php echo $country['id'];?>" <?php if($country['id']==$bankdetails['bnk_country']) echo "selected";?> ><?php echo $country['nicename'];?> </option>
                                          <?php } ?>
                                         
                                    </select>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Postal Code</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="bnk_zip" value="<?php echo $bankdetails['bnk_zip']; ?>" class="form-control form-txt-primary" placeholder="Postal Code">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
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
                    acc_name: "required",
                    bnk_name: "required",
                    bnk_routing: "required",
                    bnk_ifsc: "required",
                    bnk_swift: {
                        required:true,
                        minlength:11
                    },
                    bnk_address1: "required",
                    bnk_address2: "required",
                    bnk_city: "required",
                    bnk_state: "required",
                    country: "required",
                    bnk_zip: {
                        required:true,
                        number: true
                    },
                    acc_no: {
                        required:true,
                        number: true,
                        minlength:15
                    }
                    
                },
                messages: {
                    acc_name: "Please enter account name",
                    bnk_name: "Please enter Bank Name",
                    bnk_routing: "Please enter routing number",
                    bnk_ifsc: "Please enter bank IFSC",
                    bnk_swift: "Please enter bank SWIFT code",
                    acc_no:{
                        required: "Please enter account no.",
                        number: "Please enter valid number",
                        minlength: "Account number must be at least 15 digits",
                    },
                    bnk_zip:{
                        required: "Please enter zip code",
                        number: "Please enter valid zip code",
                        minlength: "Zip code must be at least 4 digits",
                    },
                    bnk_address1: "Please enter address",
                    bnk_address2: "Please enter address",
                    bnk_city: "Please enter city",
                    bnk_state: "Please enter state",
                    country: "Please enter country",
                    
                }
            });
            
    });
    </script>