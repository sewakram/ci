           <div class="page-header">
                <div class="page-header-title">
                    <h4><?php echo 'Add Articles'; ?></h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <?php //print_r($viewBlogComments); ?>
                        <li class="breadcrumb-item"><a href="<?php echo site_url();?>administrator/add/blog">Add Articles</a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?php echo site_url();?>administrator/blogs/list-blog">List Articles</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">                           
                            <div class="card-block">
                            <?php echo form_open_multipart('publisher/add_blog'); ?>
                              <div class="form-group col-sm-8">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Add Title">
                              </div>
                              <div class="form-group col-sm-6">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                <?php endforeach; ?>
                                </select>
                              </div>

                              <div class="form-group col-sm-6">
                                <label>Articles Related by Magazines</label>
                                <select name="magazine_id" class="form-control">
                                <?php $magazineslist = $this->Administrator_Model->get_magazines($this->session->userdata('user_id')); foreach ($magazineslist as $magazineslists): ?>
                                    <option value="<?php echo $magazineslists['id']; ?>"><?php echo $magazineslists['name']; ?></option>
                                <?php endforeach; ?>
                                </select>
                              </div>

                              <div class="form-group col-sm-6">
                                <label>Upload Image</label><br>
                                <input type="file" class="form-control" name="userfile" size="20">
                              </div>

                              <div class="form-group col-sm-12">
                                <label>Body</label>
                                <textarea id="editor1" class="form-control" name="body" placeholder="Add Body"></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->
                    </div>
                </div>
            </div>
            <!-- Page body end -->
        </div>
    </div>

    <script type="text/javascript">
        $().ready(function() {

    // validate signup form on keyup and submit
            $("form").validate({
                rules: {
                    title: "required",
                    category_id: "required",
                    magazine_id: "required",
                    // userfile: "required",
                    body: {
                        required:true,
                        minlength:300
                    }                    
                                        
                },
                messages: {
                    title: "Please enter title",
                    category_id: "Please select category",
                    magazine_id: "Please select magazine related to artical",
                    // userfile: "Please upload artical image",
                    body:{
                        required: "Please write an artical",
                        minlength: "Artical must be at least 300 character",
                    }                 
                    
                }
            });
            
    });
    </script>