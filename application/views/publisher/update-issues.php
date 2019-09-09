   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css" />
    <!-- Select 2 css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>admintemplate/bower_components/select2/dist/css/select2.min.css" />
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/multiselect/css/multi-select.css" />
    <style type="text/css">
        .select2-container .select2-selection--single{
            height: 46px !important;
        }
        .asterisk{
            color: red;
        }
    </style>
    
            <div class="page-header">
                <div class="page-header-title">
                    <h4>Magazines</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Issues</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Update Issues</a>
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
                                <h5>Update Issue</h5>
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
                               <?php echo form_open_multipart('publisher/update/issues/'.$magazines['id']); ?>
                                    <input type="hidden" value="<?php echo $magazines['id'];?>"  name="id">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Issue Name <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" placeholder="Issue Name" value="<?php echo $magazines['issue_name'];?>">
                                        </div>
                                    </div>

                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Issue Description <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control max-textarea" name="description" rows="4" style="height: 166px;"><?php echo $magazines['description'];?></textarea>
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Publishing Date <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                        <input type="date" id="dropper-default" value="<?php echo $magazines['publishing_date'];?>" name="publishing_date" class="form-control" placeholder="Select Your Publishing Date">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Price Per magazine $<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="price_per_issue" name="price_per_issue" value="<?php echo $magazines['issue_price'];?>">  
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Upload Magazine Cover Image <span class="asterisk">*</span></label>
                                        <div class="col-sm-6">
                                            <input name="imgFiles" accept=".gif, .png, .jpg, .jpeg" class="form-control" type="file" value="">
                                             <img width="100px;" src="<?php echo site_url();?>assets/images/magzines/cover/<?php echo $magazines['cover']; ?> ">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Upload Preview Magazine <span class="asterisk">*</span></label>
                                        <div class="col-sm-6">
                                            <input name="userfile[]" class="form-control" type="file" accept="application/pdf">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Upload Full Paid Magazine <span class="asterisk">*</span></label>
                                        <div class="col-sm-6">
                                            <input name="userfile_paid[]" class="form-control" type="file" accept="application/pdf">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                               </div>
                                   
                                </div>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->
                