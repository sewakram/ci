<div class="catwrapp singleproduct">
<div class="container">
<ul class="breadcrumb">
<li><a href="<?=site_url();?>">Home</a></li>
<li><a href="<?=site_url('cart/')?>">Cart</a></li>
</ul>
<div class="whitebg">
<div class="prod-section">
<!-- cart begain -->
<script>
/* Update item quantity */
function updateCartItem(obj, rowid){
  $.get("<?php echo base_url('cart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value}, function(resp){
    if(resp == 'ok'){
      location.reload();
    }else{
      alert('Cart update failed, please try again.');
    }
  });
}

// To conform clear all data in cart.
function clear_cart() {
var result = confirm('Are you sure want to clear all bookings?');

if (result) {
window.location = "<?php echo base_url(); ?>cart/remove/all";
} else {
return false; // cancel button
}
}
</script>
<div id='content'>
 
<div id="cart" >
<div id="heading">
<h2 align="center">Products on Your Shopping Cart</h2>
</div>

<div id="text">
<?php $cart_check = $this->cart->contents();

// If cart is empty, this will show below message.
if(empty($cart_check)) {
echo 'To add products to your shopping cart click on "Add to Cart" Button';
} ?> </div>

<table id="table" border="0" cellpadding="5px" cellspacing="1px">
<?php
// All values of cart store in "$cart".
if ($cart = $this->cart->contents()): ?>
<tr id= "main_heading">
<td>Serial</td>
<td>Name</td>
<td>Price</td>
<td>Qty</td>
<td>Amount</td>
<td>Cancel Product</td>
</tr>
<?php
// Create form and send all values in "shopping/update_cart" function.
echo form_open('cart/update_cart');
$grand_total = 0;
$i = 1;

foreach ($cart as $item):
// echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
// Will produce the following output.
// <input type="hidden" name="cart[1][id]" value="1" />

echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
?>
<tr>
<td>
<?php echo $i++; ?>
</td>
<td>
<?php echo $item['name']; ?>
</td>
<td>
<?php echo $this->session->userdata('site_currencySymbol');?> <?php echo number_format($this->session->userdata('site_currencyConverter') * $item['price'], 2); ?>
</td>
<td>
<?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right" onchange=updateCartItem(this,"'.$item['rowid'].'")'); ?>
</td>
<?php $grand_total = $grand_total + $item['subtotal']; ?>
<td>
<?php echo $this->session->userdata('site_currencySymbol');?> <?php echo number_format($this->session->userdata('site_currencyConverter') * $item['subtotal'], 2) ?>
</td>
<td>

<?php
// cancle image.
$path = "<span class='fa fa-times-circle'>";
echo anchor('cart/remove/' . $item['rowid'], $path); ?></span>
</td>
<?php endforeach; ?>
</tr>
<tr>
<td><b>Order Total: <?php echo $this->session->userdata('site_currencySymbol');?> <?php

//Grand Total.
echo number_format($this->session->userdata('site_currencyConverter') * $grand_total, 2); ?></b></td>

<?php // "clear cart" button call javascript confirmation message ?>
<td colspan="5" align="right"><input  class ='fg-button teal' type="button" value="Clear Cart" onclick="clear_cart()">

<?php //submit button. ?>
<input class ='fg-button teal'  type="submit" value="Update Cart">
<?php echo form_close(); ?>

<!-- "Place order button" on click send "billing" controller -->
<input class ='fg-button teal' type="button" value="Checkout" onclick="window.location = '<?php echo base_url(); ?>cart/billing_view'"></td>
</tr>
<tr><p>You will be billed $<?php echo $grand_total; ?> for this transaction. This is the equivalent amount of your own currency in US Dollars.
</p></tr>
<?php endif; ?>
</table>

</div>

</div>
<!-- cart end -->
<div class="clear"></div>
</div>

</div>


</div>
</div>
<style type="text/css">
  
  #content{

width:979px;
margin:0 auto;
}
#result_div {
background-color: #FFF;
width: 640px;
height: 175px;
margin: 0 auto;
margin-bottom: 10px;
margin-left: 445px;
margin-top: 300px;
}
h1{
padding:20px;
background-color:#333333;
width: 600px;
color:#FFF;
}
#products_e{
background-color: #FFFFFF;
width: 979px;
position: absolute;
margin-top: 10px;
}
#cart{
width:979px;
height:auto;
margin-top: -20px;
position:relative;
background-color:#FFFFFF;
}
h2{
font-family: 'Raleway', sans-serif;
padding:20px;
background-color:#333333;
color:#FFF;
}
#product_div{
width: 310px;
height:500px;
background: #fff;
position: relative;
float: left;
padding: 5px;
margin: 2px;
border: 1px solid #E0E0E0;
}
div#image_div {
width: 300px;
height: 250px;
}
div#info_product {
height: 165px;
}
tr {
background: white;
}
#bill_info{
background-color:#FFF;
width:640px;
margin:0 auto;
margin-bottom:10px;
}
h1{
padding:20px;
background-color:#333333;
color:#FFF;
}
div#text {
color: #08BBB7;
margin-left: 255px;
margin-top: -19px;
margin-bottom: 10;
font-family: 'Raleway', sans-serif;
}
#heading{
padding-bottom:10px
}
#table{
font-size:15px;
background-color:#E1E1E1;
width:100%;
}
tr{
bgcolor:#FFFFFF;
}
#main_heading{
font-weight:bold;
bgcolor:#FFFFFF;
}
div#name {
font-weight: 700;
font-size: 17px;
margin-bottom: 10px;
}
div#desc {
font-size: 15px;
margin-bottom: 11px;
min-height: 105px;
line-height: 1.4;
}
div#add_button {
margin-top: 23px;
}
span#go_back {
margin-left: 245px;
}

.fg-button{
position: relative;
top: 0;
border-radius: 4;
font-size: 18px;
padding: 8px 28px;
text-decoration: none;
border: 0px solid;
cursor: pointer;
border-bottom-width: 3px;
outline: none;
-webkit-transition: 0.3s background;
-moz-transition: 0.3s background;
transition: 0.3s background;
}
.fg-button:active{
top: 2px;
}
.fg-button.teal{
color: #fff;
border-color: #031E3C;
background-color:#0E519B;
}
.fg-button.teal:hover{
background: #0E519B;
}
.fg-button.teal:active{
background: #09cbc7;
top: 2px;
border-bottom-width: 1px;
}
</style>