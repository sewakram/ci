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
                        <li class="breadcrumb-item"><a href="#!">Update Magazine</a>
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
                                <h5>Update Magazine</h5>
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
                               <?php echo form_open_multipart('publisher/update_magazines/'.$magazines['id']); ?>
                                    <input type="hidden" value="<?php echo $magazines['id'];?>"  name="id">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Magazine Name <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" placeholder="Magazine Name" value="<?php echo $magazines['name'];?>">
                                        </div>
                                    </div>

                                      <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Publishing Company <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                             <input readonly="readonly" type="text" name="country" value="<?php echo $magazines["publisher_company"];?>" class="form-control" placeholder="Website Url">
                                        </div>
                                        
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Magazine Description <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control max-textarea" name="description" rows="4" style="height: 166px;"><?php echo $magazines['description'];?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Category<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <select id="categorypromo" onchange="pramoFunction(this)" class="js-example-basic-single col-sm-10" name="primary_category">
                                                    <option value="">Select</option>
                                                    <?php foreach($product_categories as $post) : ?>
                                                        <?php $catselect = ''; if( $magazines['primary_category'] == $post['id'] ): $catselect = 'selected="selected"'; endif;?>
                                                         <option <?=$catselect?> value="<?php echo $post['id']; ?>"><?php echo $post['name']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Subcategory<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-10" name="sub_category">
                                                <option value="">Select</option>
                                                <option <?php if($magazines['sub_category']=='Animals and Pets') echo "selected"?>>Animals and Pets</option>
                                                <option <?php if($magazines['sub_category']=='Art') echo "selected"?>>Art</option>
                                                <option <?php if($magazines['sub_category']=='Automotive') echo "selected"?>>Automotive</option>
                                                <option <?php if($magazines['sub_category']=='Boating & Sailing') echo "selected"?>>Boating &amp; Sailing</option>
                                                <option <?php if($magazines['sub_category']=='Bridal') echo "selected"?>>Bridal</option>
                                                <option <?php if($magazines['sub_category']=='Business') echo "selected"?>>Business</option>
                                                <option <?php if($magazines['sub_category']=='Celebrity') echo "selected"?>>Celebrity</option>
                                                <option <?php if($magazines['sub_category']=='Children') echo "selected"?>>Children</option>
                                                <option <?php if($magazines['sub_category']=='Comics') echo "selected"?>>Comics</option>
                                                <option <?php if($magazines['sub_category']=='Computer & Mobile') echo "selected"?>>Computer &amp; Mobile</option>
                                                <option <?php if($magazines['sub_category']=='Cooking') echo "selected"?>>Cooking</option>
                                                <option <?php if($magazines['sub_category']=='Culture') echo "selected"?>>Culture</option>
                                                <option <?php if($magazines['sub_category']=='Education') echo "selected"?>>Education</option>
                                                <option <?php if($magazines['sub_category']=='Entertainment') echo "selected"?>>Entertainment</option>
                                                <option <?php if($magazines['sub_category']=='Fashion') echo "selected"?>>Fashion</option>
                                                <option <?php if($magazines['sub_category']=='Fiction') echo "selected"?>>Fiction</option>
                                                <option <?php if($magazines['sub_category']=='Fishing & Hunting') echo "selected"?>>Fishing &amp; Hunting</option>
                                                <option <?php if($magazines['sub_category']=='Flying & Aviation') echo "selected"?>>Flying &amp; Aviation</option>
                                                <option <?php if($magazines['sub_category']=='Gaming') echo "selected"?>>Gaming</option>
                                                <option <?php if($magazines['sub_category']=='Health') echo "selected"?>>Health</option>
                                                <option <?php if($magazines['sub_category']=='Hobbies') echo "selected"?>>Hobbies &amp; Craft</option>
                                                <option <?php if($magazines['sub_category']=='Home') echo "selected"?>>Home</option>
                                                <option <?php if($magazines['sub_category']=='Investment') echo "selected"?>>Investment</option>
                                                <option <?php if($magazines['sub_category']=='Journals') echo "selected"?>>Journals</option>
                                                <option <?php if($magazines['sub_category']=='Lifestyle') echo "selected"?>>Lifestyle</option>
                                                <option <?php if($magazines['sub_category']=='Men`s Interest') echo "selected"?>>Men`s Interest</option>
                                                <option <?php if($magazines['sub_category']=='Men\'s Magazines') echo "selected"?>>Men's Magazines</option>
                                                <option <?php if($magazines['sub_category']=='Music') echo "selected"?>>Music</option>
                                                <option <?php if($magazines['sub_category']=='News') echo "selected"?>>News</option>
                                                <option <?php if($magazines['sub_category']=='Newspaper') echo "selected"?>>Newspaper</option>
                                                <option <?php if($magazines['sub_category']=='Parenting') echo "selected"?>>Parenting</option>
                                                <option <?php if($magazines['sub_category']=='Photography') echo "selected"?>>Photography</option>
                                                <option <?php if($magazines['sub_category']=='Politics') echo "selected"?>>Politics</option>
                                                <option <?php if($magazines['sub_category']=='Property') echo "selected"?>>Property</option>
                                                <option <?php if($magazines['sub_category']=='Puzzle & Gaming') echo "selected"?>>Puzzle &amp; Gaming</option>
                                                <option <?php if($magazines['sub_category']=='Religious & Spiritual') echo "selected"?>>Religious &amp; Spiritual</option>
                                                <option <?php if($magazines['sub_category']=='Science') echo "selected"?>>Science</option>
                                                <option <?php if($magazines['sub_category']=='Sports') echo "selected"?>>Sports</option>
                                                <option <?php if($magazines['sub_category']=='Technology') echo "selected"?>>Technology</option>
                                                <option <?php if($magazines['sub_category']=='Travel') echo "selected"?>>Travel</option>
                                                <option <?php if($magazines['sub_category']=='TV guide') echo "selected"?>>TV guide</option>
                                                <option <?php if($magazines['sub_category']=='Weddings') echo "selected"?>>Weddings</option>
                                                <option <?php if($magazines['sub_category']=='Women\'s Interest') echo "selected"?>>Women's Interest</option>
                                                <option <?php if($magazines['sub_category']=='Young Adult') echo "selected"?>>Young Adult</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Age Rating<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-10" name="age_rating">
                                                    <option value="">Select Age Rating</option>
                                                     <?php foreach($age_rates as $agerate) : ?>
                                                        <?php $arselect = ''; if( $magazines['age_rating'] == $agerate['id'] ): $arselect = 'selected="selected"'; endif;?>
                                                         <option <?=$arselect?> value="<?php echo $agerate['id']; ?>"><?php echo $agerate['name']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Keywords </label>
                                        <div class="col-sm-9">
                                             <input type="text" name="keywords" class="form-control" placeholder="Keywords" value="<?php echo $magazines['keywords'];?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Website Url </label>
                                        <div class="col-sm-9">
                                             <input type="text" name="website_url" class="form-control" placeholder="Website Url" value="<?php echo $magazines['website_url'];?>">
                                        </div>
                                    </div>

                                     <!-- <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Publishing Date <span class="asterisk">*</span></label>
                                        <div class="col-sm-9">
                                        <input type="date" id="dropper-default" value="<?php //echo $magazines['publishing_date'];?>" name="publishing_date" class="form-control" placeholder="Select Your Publishing Date">
                                        </div>
                                    </div> -->

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Country/Region Publish From<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single col-sm-10" name="country_publish_form">
                                                  <option value="">Select</option>
                                                    <?php foreach($countries as $post) : ?>
                                                        <?php $pfselect = ''; if( $magazines['country_publish_form'] == $post['id'] ): $pfselect = 'selected="selected"'; endif;?>
                                                         <option <?=$pfselect?> value="<?php echo $post['id']; ?>"><?php echo $post['nicename']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Select the Countries where your magazine need to block </label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-hide-search col-sm-12" multiple="multiple" style="width: 75%" name="country_block[]">
                                                <option value="">Select</option>
                                                    <?php 
                                                    $ex_block = explode(', ', $magazines['country_block']);
                                                    foreach($countries as $post) : ?>
                                                         <?php 
                                                            $cont_sel = '';
                                                            if (in_array($post['id'], $ex_block)) {
                                                               $cont_sel = 'selected="selected"';
                                                            }
                                                            ?>
                                                             <option <?=$cont_sel?> value="<?php echo $post['id']; ?>"><?php echo $post['nicename']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="zeroprice">
                                        <label class="col-sm-3 col-form-label">Price Per magazine $<span class="asterisk">*</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="price_per_issue" name="price_per_issue" value="<?php echo $magazines['price_per_issue'];?>">  
                                        </div>
                                    </div>

                                    <div id="zeropackage">
                                    <div class="form-group row">
                                      <label class="col-sm-3 control-label">Number of issues for 3 months:</label>
                                      <div class="col-sm-3">
                                        <input type="text" class="form-control" id="magazine_three_mon_sub" name="magazine_three_mon_sub" value="<?php echo $magazines['magazine_three_mon_sub'];?>">
                                      </div>
                                        <label class="col-sm-2 control-label"> Subscription Price</label>
                                          <div class="col-sm-4">
                                             <input type="text" class="form-control" id="magazine_three_mon_sub_price" name="magazine_three_mon_sub_price" value="<?php echo $magazines['magazine_three_mon_sub_price'];?>">
                                            <span class="help-block">US dollar</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-sm-3 control-label">Number of issues for 6 months:</label>
                                      <div class="col-sm-3">
                                        <input type="text" class="form-control" id="magazine_six_mon_sub" name="magazine_six_mon_sub" value="<?php echo $magazines['magazine_six_mon_sub'];?>">
                                      </div>
                                        <label class="col-sm-2 control-label"> Subscription Price</label>
                                          <div class="col-sm-4">
                                            <input type="text" class="form-control" id="magazine_six_mon_sub_price" name="magazine_six_mon_sub_price" value="<?php echo $magazines['magazine_six_mon_sub_price'];?>">
                                            <span class="help-block">US dollar</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-sm-3 control-label">Number of issues for 12 months:</label>
                                      <div class="col-sm-3">
                                        <input type="text" class="form-control" id="magazine_twelve_mon_sub" name="magazine_twelve_mon_sub" value="<?php echo $magazines['magazine_twelve_mon_sub'];?>">
                                      </div>
                                        <label class="col-sm-2 control-label">Subscription Price</label>
                                          <div class="col-sm-4">
                                            <input type="text" class="form-control" id="magazine_twelve_mon_sub_price" name="magazine_twelve_mon_sub_price" value="<?php echo $magazines['magazine_twelve_mon_sub_price'];?>">
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
                                                             <option value="<?php echo $mfq['id']; ?>" <?php if($mfq['id']==$magazines['frequency']) echo "selected"?>><?php echo $mfq['name']; ?></option>
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
                                                        <?php 
                                                        $ex_lang = explode(', ', $magazines['languages']);
                                                        foreach($languages as $language) : 
                                                            $lang_sel = '';
                                                            if (in_array($language['id'], $ex_lang)) {
                                                               $lang_sel = 'selected="selected"';
                                                            }
                                                            ?>
                                                             <option <?=$lang_sel?> value="<?php echo $language['id']; ?>"><?php echo $language['name']; ?></option>
                                                        <?php endforeach; ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                
                                   <!--  <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Upload Magazine Cover Image <span class="asterisk">*</span></label>
                                        <div class="col-sm-6">
                                            <input name="imgFiles" class="form-control" type="file" value="">
                                             <img width="100px;" src="<?php //echo site_url();?>assets/images/magzines/cover/<?php //echo $magazines['cover']; ?> ">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Upload Preview Magazine <span class="asterisk">*</span></label>
                                        <div class="col-sm-6">
                                            <input name="userfile[]" class="form-control" type="file" multiple="multiple">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Upload Full Paid Magazine <span class="asterisk">*</span></label>
                                        <div class="col-sm-6">
                                            <input name="userfile_paid[]" class="form-control" type="file" multiple="multiple">
                                        </div>
                                    </div> -->
                                    
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
                    if($('#categorypromo').val()==12){
                        // console.log(thisref.value);
                        $('#zeroprice').hide();
                        $('#zeropackage').hide();
                        $('#price_per_issue').val(0);
                       }else{
                        $('#zeroprice').show();
                        $('#zeropackage').show();
                       }
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