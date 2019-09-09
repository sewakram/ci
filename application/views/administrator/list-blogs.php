     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/ekko-lightbox/dist/ekko-lightbox.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/lightbox2/dist/css/lightbox.css">
            <!-- Page-header end -->
            <!-- Page-body start -->
            <div class="page-body">
                <!-- DOM/Jquery table start -->

                <div class="card">
                    <div class="card-block">
                      <div class="page-header-title">
                        <h4>List Articles</h4>
                      </div>
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item">
                                    <a href="<?php echo site_url();?>administrator">
                                        <i class="icofont icofont-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>administrator/add/blog">Add Articles</a>
                                </li>
                                <li class="breadcrumb-item"><a href="<?php echo site_url();?>administrator/blogs/list-blog">List Articles</a>
                                </li>
                            </ul>
                        </div>
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                       <th>SrNo.</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Created By</th>
                                        <th>Datetime</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $srno = 1; foreach($blogs as $blog) : ?>
                                 <tr>
                                        <td><?php echo $srno; ?></td>
                                        <td>
                                            <img width="20px;" src="<?php echo site_url();?>assets/images/posts/<?php echo $blog['post_image']; ?> ">                                           
                                        </td>
                                        <td><a href="<?php echo base_url(); ?>administrator/update_blog/<?php echo $blog['id']; ?>"><?php echo $blog['title']; ?></a></td>
                                         <td><?php $datauser = $this->Administrator_Model->get_user_details($blog['user_id']); echo $datauser['name']; ?></td>
                                         <td><?php echo date("M d,Y", strtotime($blog['created_at'])); ?></td>
                                        <td>
                                                <?php if($blog['status'] == 1){ ?>
                                               <a class="label label-inverse-primary enable" href='<?php echo base_url(); ?>administrator/enable/<?php echo $blog['id']; ?>?table=<?php echo base64_encode('posts'); ?>'>Enabled</a>
                                                <?php }else{ ?> 
                                                <a class="label label-inverse-warning disable" href='<?php echo base_url(); ?>administrator/desable/<?php echo $blog['id']; ?>?table=<?php echo base64_encode('posts'); ?>'>Disabled</a>
                                                <?php } ?>
                                                <!-- Edit Button -->
                                                <a class="label label-inverse-info" href='<?php echo base_url(); ?>administrator/update_blog/<?php echo $blog['id']; ?>'>Edit</a>
                                                <!-- Delete Button -->
                                                <a class="label label-inverse-danger delete" href='<?php echo base_url(); ?>administrator/delete/<?php echo $blog['id']; ?>?table=<?php echo base64_encode('posts'); ?>'>Delete</a>
                                            
                                        </td>
                                    </tr>
                                <?php $srno++; endforeach; ?>

                                <!-- <div class="paginate-link">
                                    <?php //echo $this->pagination->create_links(); ?>
                                </div>  -->

                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- DOM/Jquery table end -->
            </div>

  