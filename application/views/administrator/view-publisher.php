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
                               
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Full Name: </label>
                                        <div class="col-sm-8">
                                            <span class="form-txt-primary"><?php echo $publisher['name']?></span>
                                        </div>
                                    </div>
                                    

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Publishing Company Name</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['publisher']?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">No of Magazines</label>
                                    <div class="col-sm-8">
                                     <span class="form-txt-primary"><?php $publisher['mag_no']?></span>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <span class="form-txt-primary"><?php echo $publisher['email']?></span>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Mobile No</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['contact']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Address</label>
                                        <div class="col-sm-8">
                                            <span class="form-txt-primary"><?php echo $publisher['address']?></span>
                                        </div>
                                    </div>

                                    
                                    
                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Country</label>
                                    <div class="col-sm-8">
                                     <span class="form-txt-primary"><?php echo $publisher['nicename']?></span>
                                    </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Zip/Postal Code</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['zipcode']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">How did you hear about us</label>
                                    <div class="col-sm-8">
                                     <span class="form-txt-primary"><?php echo $publisher['hear']?></span>
                                    </div>
                                    </div>
                                    <b><h3>Bank Details</h3></b>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Account Number</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['acc_no']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Account Name</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['acc_name']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Bank Name</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['bnk_name']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Bank Swift Code</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['bnk_swift']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Bank Routing Number</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['bnk_routing']?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Bank Ifsc Code</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['bnk_ifsc']?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Bank Address Line 1</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['bnk_address1']?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Bank Address Line 2</label>
                                        <div class="col-sm-8">
                                             <span class="form-txt-primary"><?php echo $publisher['bnk_address2']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">City</label>
                                        <div class="col-sm-8">
                                            <span class="form-txt-primary"><?php echo $publisher['bnk_city']?></span>
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">State</label>
                                        <div class="col-sm-8">
                                           <span class="form-txt-primary"><?php echo $publisher['bnk_state']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Bank Country</label>
                                        <div class="col-sm-8">
                                            <span class="form-txt-primary"><?php echo $publisher['bnk_country']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Postal Code</label>
                                        <div class="col-sm-8">
                                            <span class="form-txt-primary"><?php echo $publisher['bnk_zip']?></span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        
                                        <div class="col-sm-8">
                                           <a href="<?php echo base_url(); ?>administrator/publishers/list_publisher" class="btn btn-primary">Back</a>
                                        </div>
                                    </div>
                                    
                                    
                               
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