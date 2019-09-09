
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

<div class="container">
<div class="login-section">
    <h2><?= $title ?></h2>
<div class="user-prof-left">
<?php
$this->load->view('users/sidebar');
?>
</div>
    
        <div class="loginbox profile">
                <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="sno">S.No</th>
                <th>Receipt No</th>
                <th>Purchase Date</th>
                <!-- <th>Type Of Purchase</th> -->
                <!-- <th>Qty</th> -->
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // print_r($orders);die();
            $srno  = 1;
            
            foreach ($orders as $order) { ?>
            <tr>
                <td class="sno"><?php echo $srno; ?></td>
                <td><?php echo $order['recept_no']; ?></td>
                <td><?php echo $order['purchase_date']; ?></td>
                <!-- <td><?php //echo $order['qty']; ?></td> -->
                <td><?php echo $order['amount']; ?></td>
                <td>
                    <?php  
                    switch ($order['status']) {
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
                <td><a class="label label-inverse-info fa fa-eye" href="<?php echo base_url(); ?>users/vieworder/<?php echo base64_encode($order['id']); ?>"></a> 
                    <?php if($order['status']== 0 || $order['status']== 3){?><a class="label label-inverse-info fa fa-money" href="<?php echo base_url(); ?>cart/pending/pay/<?php echo base64_encode($order['id']); ?>"></a> 
                    <a class="label label-inverse-info fa fa-trash-o" onclick = "if (! confirm('Are you sure you want to delete?')) { return false; }" href="<?php echo base_url(); ?>cart/pending/delete/<?php echo base64_encode($order['id']); ?>"></a><?php } ?>
                </td>
            </tr>
            <?php $srno++; } ?> 
        </tbody>
        <tfoot>
            <tr>
                <th class="sno">S.No</th>
                <th>Receipt No</th>
                <th>Purchase Date</th>
                <!-- <th>Type Of Purchase</th> -->
                <!-- <th>Qty</th> -->
                <th>Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>               
        </div><div class="clear"></div>

	</div>
</div>
<script type="text/javascript">
   $( function() {
    $('#example').DataTable();
  } );

</script>

 <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


<style type="text/css">
    
    .page {
    margin-bottom: 5% !important;
    margin-top: -5% !important;
    width: 900px;
    margin: 0 auto;
}
.errorbox{
    margin-bottom: 5% !important;
    margin-top: -5% !important;
    width: 800px;
    margin: 0 auto;
}
.fade.in {
    opacity: 1;
}
.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}
.alert-dismissable, .alert-dismissible {
    padding-right: 35px;
}
.alert {
    padding: 15px;
        padding-right: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    border-radius: 4px;
}
.fade {
    opacity: 0;
    -webkit-transition: opacity .15s linear;
    -o-transition: opacity .15s linear;
    transition: opacity .15s linear;
}

</style>