
<!-- Banner Txt -->
<div class="mainslider">
	<div class="banner">
		<div class="banner-txt">
			<?php $header = $this->myissue->comman_single_record('teams','id',1); ?>
		<div class="ban-txt">
		<h1><?=$header->name?></h1>
		<?=$header->description?>
		<a href="<?=$header->designation?>">Explore Now!</a>
		</div>
	</div>
	<a href="<?=$header->designation?>">
	<img src="<?php echo base_url(); ?>assets/images/teams/<?=$header->image?>" alt="<?=$header->name?>" class="headimg" /></a>

	<div class="clear"></div>

	</div>
</div>
<!-- Banner Txt end -->
<!-- newspapers Slider -->
<div class="newspapers">
	<div class="container">
		<h2>Newspapers</h2>
		<?php 	$newspaper = $this->myissue->join_comman_function('add_magazines','issues','primary_category', '4'); ?>
		<div id="carousel" class="carousel">
		<a href="#" id="prev" class="prev">Prev</a>
		  <?php foreach ($newspaper as $newspapers) { ?>
		  	<a href="<?=site_url('magazine/'.$newspapers['c_slug'].'/'.$newspapers['m_slug'].'/'.$newspapers['i_slug']);?>"><img src="<?php echo site_url('assets/images/magzines/cover/'.$newspapers['i_cover']);?>" style="display: inline; left: 458px; top: 19px; visibility: visible; position: absolute; z-index: 5; opacity: 1; width: 204px; height: 262px;" id="item-1" /></a>
		  <?php  } ?>
	 	 <a href="#" id="next" class="next">Next</a>
    </div>

	</div>
</div>

<!-- newspapers Slider end-->

<!-- Magazines Slider -->
<div class="magazines">
	<div class="container">
		<h2>Magazines</h2>
		<?php 	$magazine = $this->myissue->join_comman_function('add_magazines','issues','primary_category', '5'); ?>
		<div id="carousel2" class="carousel">
		<a href="#" id="prev2" class="prev">Prev</a>
      		 <?php foreach ($magazine as $magazines) { ?>
		  	<a href="<?=site_url('magazine/'.$magazines['c_slug'].'/'.$magazines['m_slug'].'/'.$magazines['i_slug']);?>"><img src="<?php echo site_url('assets/images/magzines/cover/'.$magazines['i_cover']);?>" style="display: inline; left: 458px; top: 19px; visibility: visible; position: absolute; z-index: 5; opacity: 1; width: 204px; height: 262px;" id="item-1" /></a>
		  <?php  } ?>
	  	<a href="#" id="next2" class="next">Next</a>
    </div>

	</div>
</div>

<!-- Magazines Slider end-->
<!-- Article & Reports Slider -->
<div class="magazines">
	<div class="container">
		<h2>Article & Reports</h2>
		<div id="carousel3" class="carousel">
	<a href="#" id="prev3" class="prev">Prev</a>
      <a href="#"><img src="<?php echo base_url(); ?>assets/images/front/slider3/slide1.jpg" id="item-1" /></a>
      <a href="#"><img src="<?php echo base_url(); ?>assets/images/front/slider3/slide2.jpg" id="item-2" /></a>
      <a href="#"><img src="<?php echo base_url(); ?>assets/images/front/slider3/slide3.jpg" id="item-3" /></a>
      <a href="#"><img src="<?php echo base_url(); ?>assets/images/front/slider3/slide4.jpg" id="item-4" /></a>
      <a href="#"><img src="<?php echo base_url(); ?>assets/images/front/slider3/slide5.jpg" id="item-5" /></a>
      <a href="#"><img src="<?php echo base_url(); ?>assets/images/front/slider3/slide6.jpg" id="item-6" /></a>
      <a href="#"><img src="<?php echo base_url(); ?>assets/images/front/slider3/slide7.jpg" id="item-7" /></a> 
	  <a href="#" id="next3" class="next">Next</a>
    </div>

	</div>
</div>

<!-- Article & Reports Slider end-->

<!-- Promo Slider -->
<div class="magazines">
	<div class="container">
		<h2>Promo</h2>
		<?php 	$promo = $this->myissue->join_comman_function('add_magazines','issues','primary_category', '12'); ?>
		<div id="carousel4" class="carousel">
			<a href="#" id="prev4" class="prev">Prev</a>
      			<?php foreach ($promo as $promos) { ?>
			  	<a href="<?=site_url('magazine/'.$promos['c_slug'].'/'.$promos['m_slug'].'/'.$promos['i_slug']);?>"><img src="<?php echo site_url('assets/images/magzines/cover/'.$promos['i_cover']);?>" style="display: inline; left: 458px; top: 19px; visibility: visible; position: absolute; z-index: 5; opacity: 1; width: 204px; height: 262px;" id="item-1" /></a>
			  <?php  } ?>
	 		<a href="#" id="next4" class="next">Next</a>
    </div>

	</div>
</div>

<!-- Promo Slider end-->


<div class="container contrary">
		 
		<div class="banner-txt">
		<div class="ban-txt">
			<?php $footer = $this->myissue->comman_single_record('teams','id',2); ?>
			<h4><?=$footer->name?> </h4>
		<?=$footer->description?> 
		</div>
	</div>
	<a href="<?=$footer->designation?>">
	<img src="<?php echo base_url(); ?>assets/images/teams/<?=$footer->image?>" alt="<?=$footer->name?>" class="headimg" /></a>

	<div class="clear"></div>

	 
 
</div>