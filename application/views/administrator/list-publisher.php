     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/ekko-lightbox/dist/ekko-lightbox.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/lightbox2/dist/css/lightbox.css">

<!-- <script type="text/javascript">
 $(document).ready(function(){
        $(".delete").click(function(e){ alert('as');
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r.success){
                    $this.closest("tr").remove();
                }
            })
        });
    });
$(document).ready(function(){
        $(".enable").click(function(e){ alert('as');
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r.success){
                    $this.closest("tr").remove();
                }
            })
        });
    });
$(document).ready(function(){
        $(".desable").click(function(e){ alert('as');
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r.success){
                    $this.closest("tr").remove();
                }
            })
        });
    });
</script> -->



            <div class="page-header">
                <div class="page-header-title">
                    <h4>List Publisher</h4>
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
                        <li class="breadcrumb-item"><a href="#!">List Publishers</a>
                        </li>
                    </ul>
                </div>
            </div>
           
            <!-- Page-header end -->
            <!-- Page-body start -->
            <div class="page-body">
                <!-- DOM/Jquery table start -->

                <div class="card">
                    <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <!-- <th>Image</th> -->
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Publishing Company</th>
                                        <th>Magazines</th>
                                        <!-- <th>Hear From</th>
                                        <th>country</th> -->
                                        <!-- <th>Reg-Date</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $srno  = 1;
                                 foreach($publishers as $post) : ?>
                                 <tr>
                                        <td><?php echo $srno; ?></td>
                                        <!-- <td>
                                            <img width="20px;" src="<?php //echo site_url();?>assets/images/users/<?php //echo $post['image']; ?> ">                                           
                                        </td> -->
                                        <td><?php echo $post['name']; ?></td>
                                        <td><?php echo $post['email']; ?></td>
                                        <td><?php echo $post['contact']; ?></td>
                                        <td><?php echo $post['publisher']; ?></td>
                                        <td><?php echo $post['mag_no']; ?></td>
                                        <!-- <td><?php //echo $post['hear']; ?></td>
                                        <td><?php //echo $post['nicename']; ?></td> -->
                                         <!-- <td><?php //echo date("M d,Y", strtotime($post['register_date'])); ?></td> -->
                                        <td>
                                                <?php if($post['status'] == 1){ ?>
                                               <a class="label label-inverse-primary enable" href='<?php echo base_url(); ?>administrator/enable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('users'); ?>'>Enabled</a>
                                                <?php }else{ ?> 
                                                <a class="label label-inverse-warning desable" href='<?php echo base_url(); ?>administrator/desable/<?php echo $post['id']; ?>?table=<?php echo base64_encode('users'); ?>'>Desabled</a>
                                                <?php } ?>
                                                <a class="label label-inverse-info" href='<?php echo base_url(); ?>administrator/publishers/update-publisher/<?php echo $post['id']; ?>'>Edit</a>
                                                <a class="label label-inverse-info" href='<?php echo base_url(); ?>administrator/publishers/view-publisher/<?php echo $post['id']; ?>'>View</a>
                                                <a class="label label-inverse-danger delete" href='<?php echo base_url(); ?>administrator/delpub/<?php echo $post['id']; ?>'>Delete</a>
                                            
                                        </td>
                                    </tr>
                                <?php $srno++;endforeach; ?>

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

  