   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.css" />

    
            <div class="page-header">
                <div class="page-header-title">
                    <h4><?=$title?></h4>
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
                        <li class="breadcrumb-item"><a href="#!"><?=$title?></a>
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
                        <div class="container page">
  <div class="card">
<div class="card-header">

<strong>Invoice:</strong><?=$orderdata['recept_no'];?> 
  <span class="float-right" style="margin-left: 10px;"> <strong>Date:</strong> <?=$orderdata['purchase_date'];?></span>
  <span class="float-right"> <strong>Status:</strong> 
<?php

switch ($orderdata['ostatus']) {
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
  </span>

</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<h6 class="mb-3">From:</h6>
<div>
<strong>Webz Poland</strong>
</div>
<div>Madassdlinskiego 8</div>
<div>71-101 Szczecin, Poland</div>
<div>Email: info@dfdf.com.pl</div>
<div>Phone: +48 4423 666 3333</div>
</div>

<div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>
<strong><?=$orderdata['name'];?></strong>
</div>
<div><?=$orderdata['address'];?></div>
<div>Email: <?=$orderdata['email'];?></div>
<div>Phone: <?=$orderdata['contact'];?></div>
</div>



</div>

<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th class="center">#</th>
<th>Item</th>
<!-- <th>Description</th> -->

<th class="right">Unit Cost(Rs.)</th>
  <th class="center">Qty</th>
<th class="right">Subtotal(Rs.)</th>
</tr>
</thead>
<tbody>
    <?php
    // $no=1;
    $total=0;
    foreach ($transaction as $key => $product) {
        // $no++;
        $total=$total+$product['sub_total'];
        // echo $total;
    ?>
<tr>
<td class="center"><?= $key+1;?></td>
<td class="left strong"><?= $product['issue_name'];?></td>
<!-- <td class="left">Extended License</td> -->

<td class="right"><?= ($product['sub_total']/$product['qty']);?></td>
  <td class="center"><?= $product['qty'];?></td>
<td class="right"><?= $product['sub_total'];?></td>
</tr>
<?php } ?>

</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>
<!-- <tr>
<td class="left">
<strong>Subtotal</strong>
</td>
<td class="right">$8.497,00</td>
</tr>
<tr>
<td class="left">
<strong>Discount (20%)</strong>
</td>
<td class="right">$1,699,40</td>
</tr>
<tr>
<td class="left">
 <strong>VAT (10%)</strong>
</td>
<td class="right">$679,76</td>
</tr> -->
<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong><?='Rs.'.$total;//$orderdata['amount'];?></strong>
</td>
</tr>
</tbody>
</table>

</div>

</div>

</div>
</div>
<a class="btn btn-primary" href="<?php echo base_url(); ?>publisher/transactions">Back</a>
<!-- <button id="btnPrint" type="button" class="btn btn-primary" onclick="test()">Print</button> -->
</div>
                        <!-- Basic Form Inputs card end -->
                   

     <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/switchery/dist/switchery.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/swithces.js"></script>
       <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
    <!-- Date-range picker js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>admintemplate/bower_components/datedropper/datedropper.min.js"></script>

   
    <!-- ck editor -->
    <script src="<?php echo base_url(); ?>admintemplate/bower_components/ckeditor/ckeditor.js"></script>
    <!-- echart js -->
  
    <script src="<?php echo base_url(); ?>admintemplate/assets/pages/user-profile.js"></script>