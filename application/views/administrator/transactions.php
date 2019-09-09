     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/ekko-lightbox/dist/ekko-lightbox.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/lightbox2/dist/css/lightbox.css">





            <div class="page-header">
                <div class="page-header-title">
                    <h4>List Transactions</h4>
                </div>
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index-2.html">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Transactions</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">List Transactions</a>
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
                                        <th>Order No.</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Earning</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $srno  = 1;
                                foreach($transactions as $key=>$post) { ?>
                                 <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td> <?php echo $post['recept_no']; ?></td>
                                        <td><?php echo $post['purchase_date']; ?></td>
                                        <td><?php echo $post['amount']; ?></td>
                                        <td>
                                        <?php 
                                        $earning=($post['amount']*10/100);
                                        echo ($post['status']==1)? $earning:0 ;
                                         ?>
                                             
                                         </td>
                                        <td>
                                                <?php  
                                                switch ($post['status']) {
                                                case 1:
                                                echo "Completed";
                                                break;
                                                case 0:
                                                echo "Pending";
                                                break;
                                                case 2:
                                                echo "Inprocess";
                                                break;
                                                default:
                                                echo "Cancel";
                                                }
                                                ?>
                                                    
                                        </td>
                                        <td>
                                               
                                                <a class="label label-inverse-info" href='<?php echo base_url(); ?>administrator/transaction/<?php echo base64_encode($post['id']); ?>'>View Details</a>
                                                <?php if($post['status']==0){?>
                                                <a class="label label-inverse-info" href='<?php echo base_url(); ?>administrator/order/cancel/<?php echo base64_encode($post['id']); ?>'>Cancel Order</a>
                                                <?php } ?>
                                        </td>
                                    </tr>
                                <?php  }?>

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

  