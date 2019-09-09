            <div class="page-header">
                <div class="page-header-title">
                    <h4>Dashboard</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Pages</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="page-body">
                <div class="row">
                    
                    
                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks dark-primary-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>administrator/users/users"><h5>Users</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-ui-user-group"></i>
                                    </li>
                                    <li class="text-right">
                                        <?php echo $users;?>
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks warning-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>administrator/publishers/list_publisher"><h5>Publishers</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-ui-user-group text-warning"></i>
                                    </li>
                                    <li class="text-right text-warning complete">
                                        <?php echo $publishers;?>
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks success-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>administrator/magazines/magazines"><h5>Magazines</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-files text-success"></i>
                                    </li>
                                    <li class="text-right text-success complete">
                                        <?php echo $magazines;?>
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>/publisher/blogs/list-blog"><h5>Total Articals</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-files text-primary"></i>
                                    </li>
                                    <li class="text-right text-primary">
                                        <?php echo $articalst;?>
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks warning-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>administrator/transactions"><h5>Total Orders</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-files text-warning"></i>
                                    </li>
                                    <li class="text-right text-warning">
                                       <?php echo $ordersdata['count'];?>
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks warning-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>administrator/transactions"><h5>Total Earning</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-wallet text-warning"></i>
                                    </li>
                                    <li class="text-right text-warning">
                                       <?php echo '$ '.$earning['earning'];?>
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>
                    
                   
                    
                </div>
            </div>
       