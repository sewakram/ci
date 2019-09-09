<?php
 if ($this->session -> userdata('email') == "" && $this->session -> userdata('login') != true && $this->session -> userdata('role_id') != 1) {
      redirect('administrator/index');
    }
 ?>

     <!-- Menu aside start -->
    <div class="main-menu">
        <div class="main-menu-header">
           <ul class="nav-left-new">
                        <li>
                            <?php if($this->session->userdata('role')==1){
                             ?>  
                            <a id="collapse-menu" href="<?php echo base_url(); ?>administrator/dashboard">
                                <i class="ti-home"></i>
                            </a>
                             <?php } else{ ?>
                                <a id="collapse-menu" href="<?php echo base_url(); ?>publisher/dashboard">
                                <i class="ti-home"></i>
                            </a>
                        <?php } ?>
                        </li>
                        <li>
                            <?php if($this->session->userdata('role')==1){
                             ?>
                            <a class="main-search morphsearch-search" href="<?php echo base_url(); ?>administrator/update-profile">
                                <i class="ti-user   "></i>
                            </a>
                            <?php } else{ ?>
                             <a class="main-search morphsearch-search" href="<?php echo base_url(); ?>publisher/update-profile">
                                <i class="ti-user   "></i>
                            </a> 
                            <?php } ?>  
                        </li>
                        <li>
                             <?php if($this->session->userdata('role')==1){
                             ?>
                            <a class="main-search morphsearch-search" href="<?php echo base_url(); ?>administrator/change-password">
                                <i class="ti-settings"></i>
                            </a>
                            <?php } else{ ?>
                                <a class="main-search morphsearch-search" href="<?php echo base_url(); ?>publisher/change-password">
                                <i class="ti-settings"></i>
                            </a>
                            <?php } ?>  

                        </li>
                        <!-- <li>
                            <a class="main-search morphsearch-search" href="#">
                                <i class="ti-email"></i>
                            </a>
                        </li> -->
                   
                    </ul>
        </div>
        <div class="main-menu-content">
            <!-- nav start -->
            <ul class="main-navigation">
            <?php
               // echo "<pre>";print_r();exit;
              if($this->session->userdata('role')==1){
             ?>  
             <li class="nav-item <?php if(isset($active) && $active == 'dashboard'): echo 'has-class'; endif; ?>">
                    <a href="<?php echo base_url(); ?>administrator/dashboard">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
            </li>
             <!-- publisher start -->
            <li class="nav-item <?php if(isset($active) && $active == 'publisher'): echo 'has-class'; endif; ?>">
                <a href="#!">
                    <i class="ti-layout"></i>
                    <span>Publishers</span>
                </a>
                <ul class="tree-1">
                    <li><a href="<?php echo base_url(); ?>administrator/publishers/add-publisher">Add Publisher</a></li>
                    <li><a href="<?php echo base_url(); ?>administrator/publishers/list_publisher">Publishers</a></li>
                </ul>
            </li>
            <!-- publisher end -->

            <!-- user start -->
                <li class="nav-item <?php if(isset($active) && $active == 'users'): echo 'has-class'; endif; ?>">
                    <a href="#!">
                        <i class="ti-layout"></i>
                        <span>Users</span>
                    </a>
                    <ul class="tree-1">
                        <li><a href="<?php echo base_url(); ?>administrator/users/add-user">Add User</a></li>
                        <li><a href="<?php echo base_url(); ?>administrator/users/users">Users</a></li>
                    </ul>
                </li>
            <!-- user end -->
            <!-- Magazines start --> 
                <li class="nav-item <?php if(isset($active) && $active == 'magazines'): echo 'has-class'; endif; ?>">
                    <a href="#!">
                        <i class="ti-book"></i>
                        <span>Magazines</span>
                    </a>
                    <ul class="tree-1">
                        <li><a href="<?php echo base_url(); ?>administrator/magazines/add-magazines">Add New Magazine</a></li>
                        <li><a href="<?php echo base_url(); ?>administrator/magazines/magazines">Manage magazines</a></li>
                    </ul>
                </li>
            <!-- Magazines end -->
            <!-- Category start -->
                <li class="nav-item <?php if(isset($active) && $active == 'category'): echo 'has-class'; endif; ?>">
                    <a href="#!">
                        <i class="ti-pencil-alt"></i>
                        <span>Category</span>
                    </a>
                    <ul class="tree-1">
                                <li><a href="<?php echo base_url(); ?>administrator/magazine-categories/create">Add Category</a></li>
                                <li><a href="<?php echo base_url(); ?>administrator/magazine-categories">List Category</a></li>
                    </ul>
                </li> 
                <!-- Category end -->
                <!-- Site conf start -->
                    <li class="nav-item">
                        <a href="#!">
                            <i class="ti-settings"></i>
                            <span>Site Configuration</span>
                        </a>
                        <ul class="tree-1">
                            <li><a href="<?php echo base_url(); ?>administrator/site-configuration/update/1">Site Configuration</a></li>
                            <!-- <li><a href="<?php echo base_url(); ?>administrator/scopages">SCO</a></li>
                            <li> <a href="<?php echo base_url(); ?>administrator/sociallinks">Social Links</a></li> -->
                            <li> <a href="<?php echo base_url(); ?>administrator/page-contents">Page Contents</a></li>
                            <li><a href="<?php echo base_url(); ?>administrator/team/list" data-i18n="nav.basic-components.breadcrumbs">Advertisement</a></li>
                        </ul>
                    </li>
                <!-- site conf end -->
                 <!-- Blog start -->
                 <li class="nav-item <?php if(isset($active) && ($active == 'blogcategory' || $active == 'blog')): echo 'has-class'; endif; ?>">
                    <a href="#!">
                        <i class="ti-layers"></i>
                        <span>Articles</span>
                    </a>
                    <ul class="tree-1 <?php if(isset($active) && ($active == 'blogcategory' || $active == 'blog')): echo 'open'; endif; ?>">
                        <li class="nav-sub-item"><a href="#">Articles</a>
                            <ul class="tree-1 <?php if(isset($active) && $active == 'blog'): echo 'open'; endif; ?>">
                                <li><a href="<?php echo base_url(); ?>administrator/blogs/add-blog">Add Articles</a></li>
                                <li><a href="<?php echo base_url(); ?>administrator/blogs/list-blog">List Articles</a></li>
                            </ul>
                        </li>
                        <!-- Category start -->
                            <li class="nav-sub-item">
                                <a href="#!">
                                    <span>Category</span>
                                </a>
                                <ul class="tree-2 <?php if(isset($active) && $active == 'blogcategory'): echo 'open'; endif; ?>">
                                            <li><a href="<?php echo base_url(); ?>administrator/blog-categories/create">Add Category</a></li>
                                            <li><a href="<?php echo base_url(); ?>administrator/blog-categories">List Category</a></li>
                                </ul>
                            </li> 
                        <!-- Category end -->
                    </ul>

                </li> 
            <!-- Blog end -->
            <!-- Transaction start -->
            <li class="nav-item <?php if(isset($active) && ($active == 'transaction' )): echo 'has-class'; endif; ?>">
            <a href="<?php echo base_url(); ?>administrator/transactions">
            <i class="ti-layers"></i>
            <span>Transactions</span>
            </a>
            

            </li> 
            <!-- Transaction end -->
        <?php } else{ ?>
            <li class="nav-item <?php if(isset($active) && $active == 'dashboard'): echo 'has-class'; endif; ?>">
                    <a href="<?php echo base_url(); ?>publisher/dashboard">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
            </li>

            <li class="nav-item <?php if(isset($active) && $active == 'bank'): echo 'has-class'; endif; ?>">
                    <a href="<?php echo base_url(); ?>publisher/bankdetails">
                        <i class="ti-home"></i>
                        <span>Bank Details</span>
                    </a>
            </li>
        <!-- Magazines start --> 
            <li class="nav-item <?php if(isset($active) && $active == 'magazines'): echo 'has-class'; endif; ?>">
                <a href="#!">
                    <i class="ti-book"></i>
                    <span>Magazines</span>
                </a>
                <ul class="tree-1">
                    <li><a href="<?php echo base_url(); ?>publisher/magazines/add-magazines">Add New Magazine</a></li>
                    <li><a href="<?php echo base_url(); ?>publisher/magazines/magazines">Manage magazines</a></li>
                </ul>
            </li>
        <!-- Magazines end -->
            <!-- Blog start -->
                 <li class="nav-item <?php if(isset($active) && ($active == 'blogcategory' || $active == 'blog')): echo 'has-class'; endif; ?>">
                    <a href="#!">
                        <i class="ti-layers"></i>
                        <span>Articles</span>
                    </a>
                    <ul class="tree-1 <?php if(isset($active) && ($active == 'blogcategory' || $active == 'blog')): echo 'open'; endif; ?>">
                                <li><a href="<?php echo base_url(); ?>publisher/blogs/add-blog">Add Articles</a></li>
                                <li><a href="<?php echo base_url(); ?>publisher/blogs/list-blog">List Articles</a></li>
                    </ul>

                </li> 
            <!-- Blog end -->
            <!-- Transaction start -->
            <li class="nav-item <?php if(isset($active) && ($active == 'transaction' )): echo 'has-class'; endif; ?>">
            <a href="<?php echo base_url(); ?>publisher/transactions">
            <i class="ti-layers"></i>
            <span>Transactions</span>
            </a>
            

            </li> 
            <!-- Transaction end -->
        <?php } ?>
             <!-- user start -->
                <!-- <li class="nav-item">
                    <a href="#!">
                        <i class="ti-layout"></i>
                        <span>Users</span>
                    </a>
                    <ul class="tree-1">
                        <li><a href="<?php //echo base_url(); ?>administrator/users/add-user">Add User</a></li>
                        <li><a href="<?php //echo base_url(); ?>administrator/users/users">Users</a></li>
                    </ul>
                </li> -->
            <!-- user end -->
               
                <!-- Faq start -->
                   <!--  <li class="nav-item">
                        <a href="#!">
                            <i class="ti-write"></i>
                            <span>FAQ</span>
                        </a>
                        <ul class="tree-1">
                            <li class="nav-sub-item"><a href="#">FAQ Category</a>
                                <ul class="tree-2">
                                    <li><a href="<?php //echo base_url(); ?>administrator/faq-categories/create">Add FAQ Category</a></li>
                                    <li><a href="<?php //echo base_url(); ?>administrator/faq-categories">List FAQ Category </a></li>
                                </ul>
                            </li>
                            <li class="nav-sub-item"><a href="#">FAQ</a>
                                <ul class="tree-2">
                                    <li><a href="<?php //echo base_url(); ?>administrator/faq/create">Add FAQ</a></li>
                                    <li><a href="<?php //echo base_url(); ?>administrator/faq">List FAQ</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                <!-- Faq end -->
                
                <!--Slider start  -->
                    <!-- <li class="nav-item">
                        <a href="#!">
                            <i class="ti-layout-slider"></i>
                            <span data-i18n="nav.basic-components.main">Sliders</span>
                        </a>
                        <ul class="tree-1">
                            <li><a href="<?php //echo base_url(); ?>administrator/sliders/create" data-i18n="nav.basic-components.alert">Add slider</a></li>
                            <li><a href="<?php //echo base_url(); ?>administrator/sliders" data-i18n="nav.basic-components.breadcrumbs">List slider</a></li>
                        </ul>
                    </li> -->
                    <!-- slider end -->
                    <!-- Gallery start -->
                     <!-- <li class="nav-item">
                        <a href="#!">
                            <i class="ti-layout-slider"></i>
                            <span data-i18n="nav.basic-components.main">Gallery</span>
                        </a>
                        <ul class="tree-1">
                            <li><a href="<?php //echo base_url(); ?>administrator/galleries/add" data-i18n="nav.basic-components.alert">Add Gallery</a></li>
                            <li><a href="<?php //echo base_url(); ?>administrator/galleries" data-i18n="nav.basic-components.breadcrumbs">List Gallery</a></li>
                        </ul>
                    </li> -->
                    <!-- gallery end -->
                    <!-- Team start -->
                    <!-- <li class="nav-item">
                        <a href="#!">
                            <i class="ti-layout-grid2-thumb"></i>
                            <span data-i18n="nav.basic-components.main">Teams</span>
                        </a>
                        <ul class="tree-1">
                            <li><a href="<?php //echo base_url(); ?>administrator/team/add" data-i18n="nav.basic-components.alert">Add Team</a></li>
                            <li><a href="<?php //echo base_url(); ?>administrator/team/list" data-i18n="nav.basic-components.breadcrumbs">List Teams</a></li>
                        </ul>
                    </li> -->
                    <!-- Team end -->
                    <!-- Testimonial start -->
                    <!-- <li class="nav-item">
                        <a href="#!">
                            <i class="ti-direction-alt"></i>
                            <span data-i18n="nav.basic-components.main">Testimonials</span>
                        </a>
                        <ul class="tree-1" style="display: none;">
                            <li><a href="<?php //echo base_url(); ?>administrator/testimonials/add" data-i18n="nav.basic-components.alert">Add Testimonial</a></li>
                            <li><a href="<?php //echo base_url(); ?>administrator/testimonials/list" data-i18n="nav.basic-components.breadcrumbs">List Testimonials</a></li>
                        </ul>
                    </li> -->
                    <!-- Testimonial end -->
            </ul>
            <!-- nav end -->
        </div>
    </div>
    <!-- Menu aside end -->
     <!-- Main-body start -->
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-header start -->

    <?php if($this->session->flashdata('success')): ?>
      <?php echo '<div class="alert alert-success icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Success! &nbsp;&nbsp;</strong>'.$this->session->flashdata('success').'</p></div>'; ?>
    <?php endif; ?>
    <?php if($this->session->flashdata('danger')): ?>
      <?php echo '<div class="alert alert-danger icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Error! &nbsp;&nbsp;</strong>'.$this->session->flashdata('danger').'</p></div>'; ?>
    <?php endif; ?>

     <?php if(validation_errors() != null): ?>
      <?php echo '<div class="alert alert-warning icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Alert! &nbsp;&nbsp;</strong>'.validation_errors().'</p></div>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('match_old_password')): ?>
      <?php echo '<p class="alert alert-success">'.$this->session->flashdata('match_old_password').'</p>'; ?>
    <?php endif; ?>


     



