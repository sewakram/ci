<div class="catwrapp">
<div class="container">
<div class="whitebg">
<div class="bestsellingmag">
<span class="bestsell-img hidedesk"><img src="<?php echo base_url(); ?>assets/images/front/best-selling-magazines.jpg" alt="" Title="" /></span>
<span class="best-sell-descp">Enjoy unlimited access to 5,000+ best-selling magazines and thousands of recommended articles with iDondzo GOLD!</span>
<span class="trynow"><a href="#">Try Now</a></span>
<span class="bestsell-img hidemob"><img src="<?php echo base_url(); ?>assets/images/front/best-selling-magazines.jpg" alt="" Title="" /></span>
<div class="clear"></div>
</div>

<h2><?=$title?></h2>
<div class="catList">
<ul>
  <?php 
  	if($this->input->get('search'))
	{
		$myissue = $this->searchreport->join_allsearch_function('add_magazines','issues','primary_category', 'all', $this->input->get('search'));
		if(count($myissue) > 0)
		{
		  	   foreach ($myissue as $myissues) {
			?>
			<li><a href="<?=site_url('magazine/'.$myissues['c_slug'].'/'.$myissues['m_slug'].'/'.$myissues['i_slug']);?>"><img src="<?php echo site_url('assets/images/magzines/cover/'.$myissues['i_cover']);?>" alt="" title="" /><h3><?=$myissues['issue_name']?></h3></a></li>
			<?php
			}
		}
		else
		{
			echo "Sorry! No Search Record Found?";
		}
	}
	?>
</ul>

</div>

</div>

</div>
</div>