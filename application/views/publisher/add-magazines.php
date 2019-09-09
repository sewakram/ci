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
                        <li class="breadcrumb-item"><a href="#!">Magazines</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add New Magazine</a>
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
                                <h5>Add New Magazine</h5>
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
                               <?php echo form_open_multipart('publisher/add_magazines'); ?>
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Magazine Name <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" placeholder="Magazine Name">
                                        </div>
                                    </div>

                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Publishing Company <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                             <input readonly="readonly" type="text" name="country" value="<?php echo $company["publisher"];?>" class="form-control" placeholder="Website Url">
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Magazine Description <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control max-textarea" name="description" rows="4" style="height: 166px;"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <select onchange="pramoFunction(this)" class="js-example-basic-single col-sm-10" name="primary_category">
                                                    <option value="">Select</option>
                                                    <?php foreach($product_categories as $post) : ?>
                                                         <option value="<?php echo $post['id']; ?>"><?php echo $post['name']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Subcategory<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-10" name="sub_category">
                                                <option value="">Select</option>
                                                <option>Animals and Pets</option>
                                                <option>Art</option>
                                                <option">Automotive</option>
                                                <option ">Boating &amp; Sailing</option>
                                                <option ">Bridal</option>
                                                <option >Business</option>
                                                <option >Celebrity</option>
                                                <option >Children</option>
                                                <option >Comics</option>
                                                <option >Computer &amp; Mobile</option>
                                                <option >Cooking</option>
                                                <option >Culture</option>
                                                <option >Education</option>
                                                <option>Entertainment</option>
                                                <option >Fashion</option>
                                                <option >Fiction</option>
                                                <option >Fishing &amp; Hunting</option>
                                                <option>Flying &amp; Aviation</option>
                                                <option >Gaming</option>
                                                <option>Health</option>
                                                <option >Hobbies &amp; Craft</option>
                                                <option>Home</option>
                                                <option >Investment</option>
                                                <option>Journals</option>
                                                <option>Lifestyle</option>
                                                <option>Men's Interest</option>
                                                <option >Men's Magazines</option>
                                                <option>Music</option>
                                                <option>News</option>
                                                <option >Newspaper</option>
                                                <option>Parenting</option>
                                                <option>Photography</option>
                                                <option>Politics</option>
                                                <option>Property</option>
                                                <option >Puzzle &amp; Gaming</option>
                                                <option >Religious &amp; Spiritual</option>
                                                <option>Science</option>
                                                <option>Sports</option>
                                                <option>Technology</option>
                                                <option>Travel</option>
                                                <option>TV guide</option>
                                                <option>Weddings</option>
                                                <option>Women's Interest</option>
                                                <option>Young Adult</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Age Rating<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-10" name="age_rating">
                                                    <option value="">Select Age Rating</option>
                                                     <?php foreach($age_rates as $agerate) : ?>
                                                         <option value="<?php echo $agerate['id']; ?>"><?php echo $agerate['name']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Keywords </label>
                                        <div class="col-sm-9">
                                             <input type="text" name="keywords" class="form-control" placeholder="Keywords">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Website Url </label>
                                        <div class="col-sm-9">
                                             <input type="text" name="website_url" class="form-control" placeholder="Website Url">
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Country/Region Publish From<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-10" name="country_publish_form">
                                                  <option value="">Select</option>
                                                    <?php foreach($countries as $post) : ?>
                                                         <option value="<?php echo $post['id']; ?>"><?php echo $post['nicename']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Select the Countries where your magazine need to block </label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-hide-search col-sm-12" multiple="multiple" style="width: 75%" name="country_block[]">
                                                <option value="">Select</option>
                                                    <?php foreach($countries as $post) : ?>
                                                         <option value="<?php echo $post['id']; ?>"><?php echo $post['nicename']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="zeroprice">
                                        <label class="col-sm-3 col-form-label">Price Per magazine $<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="price_per_issue" name="price_per_issue" value="">  
                                        </div>
                                    </div>

                                    <div id="zeropackage">
                                    <div class="form-group row">
                                      <label class="col-sm-3 control-label">Number of issues for 3 months:</label>
                                      <div class="col-sm-3">
                                        <input type="text" class="form-control" id="magazine_three_mon_sub" name="magazine_three_mon_sub" value="">
                                      </div>
                                        <label class="col-sm-2 control-label"> Subscription Price</label>
                                          <div class="col-sm-4">
                                             <input type="text" class="form-control" id="magazine_three_mon_sub_price" name="magazine_three_mon_sub_price" value="">
                                            <span class="help-block">US dollar</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-sm-3 control-label">Number of issues for 6 months:</label>
                                      <div class="col-sm-3">
                                        <input type="text" class="form-control" id="magazine_six_mon_sub" name="magazine_six_mon_sub" value="">
                                      </div>
                                        <label class="col-sm-2 control-label"> Subscription Price</label>
                                          <div class="col-sm-4">
                                            <input type="text" class="form-control" id="magazine_six_mon_sub_price" name="magazine_six_mon_sub_price" value="">
                                            <span class="help-block">US dollar</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-sm-3 control-label">Number of issues for 12 months:</label>
                                      <div class="col-sm-3">
                                        <input type="text" class="form-control" id="magazine_twelve_mon_sub" name="magazine_twelve_mon_sub" value="">
                                      </div>
                                        <label class="col-sm-2 control-label">Subscription Price</label>
                                          <div class="col-sm-4">
                                            <input type="text" class="form-control" id="magazine_twelve_mon_sub_price" name="magazine_twelve_mon_sub_price" value="">
                                            <span class="help-block">US dollar</span>
                                        </div>
                                    </div>
                                </div>
                                     <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Magazine Frequency <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-10" name="frequency">
                                                     <optgroup label="Select Magazine Frequency">
                                                        <?php foreach($magazine_frequency as $mfq) : ?>
                                                             <option value="<?php echo $mfq['id']; ?>"><?php echo $mfq['name']; ?></option>
                                                        <?php endforeach; ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Magazine Language <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-hide-search col-sm-12" multiple="multiple" style="width: 75%" name="languages[]">
                                                <optgroup label="Select Language">
                                                        <?php foreach($languages as $language) : ?>
                                                             <option value="<?php echo $language['id']; ?>"><?php echo $language['name']; ?></option>
                                                        <?php endforeach; ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                
                                    
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </div>
                                </form>
                               </div>
                                   
                                </div>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->
                        
                   <script type="text/javascript">
                    function pramoFunction(thisref) {
                   
                       if(thisref.value==12){
                        // console.log(thisref.value);
                        $('#zeroprice').hide();
                        $('#zeropackage').hide();
                        $('#price_per_issue').val(0);
                       }else{
                        $('#zeroprice').show();
                        $('#zeropackage').show();
                       }
                    }
        $().ready(function() {

    // validate signup form on keyup and submit
            $("form").validate({
                rules: {
                    name: "required",
                    primary_category: "required",
                    sub_category: "required",
                    age_rating: "required",
                    description: {
                        required:true,
                        minlength:100
                    },
                    country_publish_form: "required",
                    price_per_issue: "required",
                    frequency: "required",
                    languages: "required",
                                        
                },
                messages: {
                    name: "Please enter magazine name",
                    primary_category: "Please select category",
                    sub_category: "Please select subcategory",
                    age_rating: "Please select age rating",
                    country_publish_form: "Please select publishing country",
                    frequency: "Please select frequency",
                    languages: "Please select language",
                    
                    description:{
                        required: "Please enter description",
                        minlength: "Description must be at least 100 character",
                    },
                    price_per_issue:{
                        required: "Please enter price per issue",
                        number: "Please enter valid price",
                    },
                   
                    
                }
            });
            
    });
    </script>
