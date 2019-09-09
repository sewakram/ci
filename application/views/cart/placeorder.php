<div class="catwrapp singleproduct">
<div class="container">
<ul class="breadcrumb">
<li><a href="<?=site_url();?>">Home</a></li>
<li><a href="<?=site_url('cart/')?>">Cart</a></li>
</ul>
<div class="container"> 
<div class="loginbox billpaym">
<!-- cart begain -->
<?php
$grand_total = 0;
// Calculate grand total.
if ($cart = $this->cart->contents()):
foreach ($cart as $item):
$grand_total = $grand_total + $item['subtotal'];
endforeach;
endif;
?>
<div id="bill_info">

<?php // Create form for enter user imformation and send values 'shopping/save_order' function?>
<form id="order" name="billing" method="post" action="<?php echo base_url() . 'cart/save_order' ?>" >
<input type="hidden" name="command" />
<div align="center">
<h1 align="center">Billing Info</h1>
<table border="0" cellpadding="2px" class="BillingTab">
<tr><td>Order Total:</td><td><strong>$<?php echo number_format($order['amount'], 2); ?></strong></td></tr>
<tr><td>Your Name:</td><td><input type="text" name="name" disabled="disabled" value="<?= $userdata['name']?>" /></td></tr>
<tr><td>Address:</td><td><input type="text" name="address" disabled="disabled" value="<?= $userdata['address']?>" /></td></tr>
<tr><td>Email:</td><td><input type="text" name="email" disabled="disabled" value="<?= $userdata['email'];?>" /></td></tr>
<tr><td>Phone:</td><td><input type="text" name="phone" disabled="disabled" value="<?= $userdata['contact']?>" /></td></tr>
<tr><td>Payment Options:</td>
	<td>
		<input class="radio" type="radio"  name="payment" value="ppal" /> <span><img src="https://centurysoftwares.com/idondza/assets/images/front/paypal.png" alt="Paypal"></span>
		<input class="radio" type="radio"  name="payment" value="visa" /> <span><img src="https://centurysoftwares.com/idondza/assets/images/front/visa.png" alt="Visa"></span>
		<input class="radio" type="radio"  name="payment" value="payu" /> <span><img src="https://centurysoftwares.com/idondza/assets/images/front/pay-u.png" alt="Pay U"></span>
		<input class="radio" type="radio"  name="payment" value="eft" /> <span><img src="https://centurysoftwares.com/idondza/assets/images/front/eft.png" alt="eft"></span>
		
	</td>
</tr>
<tr><td><?php
// This button for redirect main page.
//echo "<a class ='fg-button teal'  id='back' href=" . base_url() . "index.php/shopping>Back</a>"; 
if($order['amount']!=0){
?>
</td><td><input class ='fg-button teal' type="submit" value="Place Order" /></td>
<?php }?>
</tr>

</table>
</div>
</form>
</div>
<!-- cart end -->
<div class="clear"></div>
 
</div>

</div>


</div>
</div>
<script type="text/javascript">
	// $(this).is(':checked') && 
	$(function(){
    ////////////////////disable refresh
    window.onbeforeunload = function() {
        return "Dude, are you sure you want to leave? Think of the kittens!";
    }
    ////////////////////disable f5
    function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

    $(document).ready(function(){
     $(document).on("keydown", disableF5);
    });
    // /////////////////disable back
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
    history.pushState(null, null, document.URL);
    });
    //////////////////
  $('input[type="radio"]').click(function(){
  	var form = $(this).parents('form:first');
    if ($(this).val()=='ppal')
    {
      // alert("Paypal");
      form.attr('action','<?=base_url()?>cart/buypaypal/<?= $order['oid'];?>');
      console.log(form);
    }else{
    	form.attr('action','<?=base_url()?>cart/buyvisa/<?= $order['oid'];?>');
    	console.log(form);
      // alert("Cash");
    }
  });
});
</script>