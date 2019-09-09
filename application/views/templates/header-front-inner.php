<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel='stylesheet' href='<?php echo base_url(); ?>assets/style.css' type='text/css' media='all' />
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=$title?></title>
<?php 
if(isset($page))
{
	if('pages/magazine-details' == $page)
	{ 
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
?>
	<!--og:title -->
	<meta property="og:title" content="<?=ucfirst($myissue->issue_name)?> - <?=date('d F Y', strtotime($myissue->publishing_date))?>">
	 
	<!--og:image -->
	<meta property="og:image" content="<?php echo site_url('assets/images/magzines/cover/'.$myissue->cover);?>">
	 
	<!--og:description -->
	<meta property="og:description" content="<?php echo $myissue->description;?>">
	 
	<!--og:type -->
	<meta property="og:type" content="article">
	 
	<!--og:url -->
	<meta property="og:url" content="<?=$actual_link?>">

	<!--og:site_name -->
	<meta property="og:site_name" content="<?=site_url()?>">
	 


	<!--twitter:title -->
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@<?=site_url()?>" />
	<meta name="twitter:creator" content="@<?=ucfirst($magazine['publisher_company'])?>" />
	<meta property="og:url" content="<?=$actual_link?>" />
	<meta property="og:title" content="<?=ucfirst($myissue->issue_name)?> - <?=date('d F Y', strtotime($myissue->publishing_date))?>" />
	<meta property="<?php echo $myissue->description;?>" />
	<meta property="og:image" content="<?php echo site_url('assets/images/magzines/cover/'.$myissue->cover);?>"/>
<?php }
}
?>
<link href="https://fonts.googleapis.com/css?family=Roboto:300i,400,400i,500,700,900&display=swap" rel="stylesheet"> 
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<style type="text/css">
	.error{
	    color: red;
}
#at4-share{
	display: none;
}
</style>
</head>

<body>

<div class="menubox innerheader">

<div class="lang">
<div class="menu">
<div class="dropdown-lang">
	<!-------Start Flags Country--------->
	<div class="drop-down">
	        <select id="country" name="country">
	        	<?php foreach ($country as $countries) { ?>
	            <option <?php if($this->session->userdata('site_country') == strtolower($countries['iso'])) echo 'selected="selected"'; ?> class="drop-option" value="<?=strtolower($countries['iso'])?>" 
	         style="background-image:url('<?php echo site_url('assets/images/flags/'.strtolower($countries['iso']).'.svg'); ?>');"><?=ucfirst($countries['nicename'])?></option>
	     <?php } ?>
	        </select>
	</div> 
	<!-------End Flags Country--------->
	<!-------start Language ----------->
	<select name="currency" onchange="javascript:window.location.href='<?php echo base_url(); ?>CurrencySwitcher/switchCurrency/'+this.value;">
	    <option value="usd" <?php if($this->session->userdata('site_currency') == 'usd') echo 'selected="selected"'; ?>>USD</option>
	    <option value="inr" <?php if($this->session->userdata('site_currency') == 'inr') echo 'selected="selected"'; ?>>INR</option>
	    <option value="eur" <?php if($this->session->userdata('site_currency') == 'eur') echo 'selected="selected"'; ?>>EUR</option> 
	     <option value="gbp" <?php if($this->session->userdata('site_currency') == 'gbp') echo 'selected="selected"'; ?>>GBP</option>
	    <option value="sgd" <?php if($this->session->userdata('site_currency') == 'sgd') echo 'selected="selected"'; ?>>SGD</option>  
    </select>
	<!-------End Language ------------>
	<!-------start Language ----------->
	<select onchange="javascript:window.location.href='<?php echo base_url(); ?>LanguageSwitcher/switchLang/'+this.value;">
	    <option value="english" <?php if($this->session->userdata('site_lang') == 'english') echo 'selected="selected"'; ?>>English</option>
	    <option value="german" <?php if($this->session->userdata('site_lang') == 'german') echo 'selected="selected"'; ?>>German</option>   
	     <option value="turkish" <?php if($this->session->userdata('site_lang') == 'turkish') echo 'selected="selected"'; ?>>Turkish</option>
	     <option value="spanish" <?php if($this->session->userdata('site_lang') == 'spanish') echo 'selected="selected"'; ?>>Spanish</option>
	     <option value="finnish" <?php if($this->session->userdata('site_lang') == 'finnish') echo 'selected="selected"'; ?>>Finnish</option>
	     <option value="japanese" <?php if($this->session->userdata('site_lang') == 'japanese') echo 'selected="selected"'; ?>>Japanese</option>
    </select>
	<!-------End Language ------------>
	<div class="clear"></div>
</div>
</div></div>

<div class="menu innerhead">
<div class="head-left-sml"><a href="<?=site_url();?>"><img src="<?php echo base_url(); ?>assets/images/front/idondza-sml.jpg" alt="idondza" /></a></div>

  <div class="headright">
  <ul class="headul">
<!-- <li class="signin"><a href="#">sign In</a></li> -->
	<?php if(!$this->session->userdata('login')): ?>
	<li><a href="<?php echo base_url(); ?>users/login"><?=$this->lang->line('login_as_reader');?></a></li>
	<li><a href="<?php echo base_url(); ?>administrator/index"><?=$this->lang->line('login_as_publisher');?></a></li>
	<?php endif; ?>
	<?php if($this->session->userdata('login')): ?>
	<li><a href="<?php echo base_url(); ?>users/profile"><?php echo $this->session->userdata('username'); ?></a></li>
	<li><a href="<?php echo base_url(); ?>users/logout"><?=$this->lang->line('logout');?></a></li>
	<?php endif; ?> 
    <li class="cart"><a href="<?php echo base_url(); ?>cart"><span><?= count($this->cart->contents());?></span></a></li>
</ul>



</div>

<nav>
  <div class="menutab"><div class="bar1"></div>
  <div class="bar2"></div>
  <div class="bar3"></div></div>
  <ul class="menubar">
	<?php $this->load->model('Category_Model');
	  $cat_menu = $this->Category_Model->product_categories();
	  foreach ($cat_menu as $category_menu) {
	  $categroy = $this->uri->segment(2);
	  $class = '';
	  if($categroy == $category_menu['slug'] )
	  {
	  	$class = 'class="active"';
	  }
  	?>
		<li><a href="<?=base_url('category/'.$category_menu['slug'])?>" <?=$class?> ><?=$this->lang->line(strtolower($category_menu['name']));?></a></li>
	<?php } ?>
	<li><a href="<?=base_url('articles_reports')?>" <?=($this->uri->segment(1) === 'articles_reports')? 'class="active"': ''?> ><?=$this->lang->line('article_report');?></a></li>
	</ul>

</nav>

</div>
</div>