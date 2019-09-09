            <div class="page-header">
                <div class="page-header-title">
                    <h4><?php echo $this->lang->line('dashboard'); ?></h4>
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
                    
                    <!-- <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks dark-primary-border">
                            <div class="card-block">
                                <h5>Users</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-ui-user-group"></i>
                                    </li>
                                    <li class="text-right">
                                        <?php// echo $users;?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks warning-border">
                            <div class="card-block">
                                <h5>Publishers</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-ui-user-group text-warning"></i>
                                    </li>
                                    <li class="text-right text-warning complete">
                                        <?php //echo $publishers;?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks success-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>publisher/magazines"><h5>Total Magazines</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-files text-success"></i>
                                    </li>
                                    <li class="text-right text-success complete">
                                        <?php echo $magazinest;?>
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks success-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>publisher/active_magazines"><h5>Active Magazines</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-files text-success"></i>
                                    </li>
                                    <li class="text-right text-success complete">
                                        <?php echo $magazinesa;?> 
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks success-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>publisher/pending_magazines"><h5>Pending Magazines</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-files text-success"></i>
                                    </li>
                                    <li class="text-right text-success complete">
                                        <?php echo $magazinesp;?>
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks warning-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>publisher/blogs/list-blog"><h5>Total Articals</h5>
                                <ul>
                                    <li>
                                        <i class="icofont icofont-files text-warning"></i>
                                    </li>
                                    <li class="text-right text-warning">
                                       <?php echo $articalst;?>
                                    </li>
                                </ul></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card client-blocks warning-border">
                            <div class="card-block">
                                <a href="<?php echo base_url(); ?>publisher/transactions"><h5>Total Orders</h5>
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
                                <a href="<?php echo base_url(); ?>publisher/transactions"><h5>Total Earning</h5>
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
       