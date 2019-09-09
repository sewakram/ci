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

<h2><?=$categories['name']?></h2>
<div class="catList">
  <?php 
  	if($this->input->get('search'))
	{
		echo "<ul>";
		$myissue = $this->myissue->join_search_function('add_magazines','issues','primary_category', $categories['id'], $this->input->get('search'));
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
		echo "</ul>";
	}
	else
	{
	  /*foreach($magazines as $magazine){
	  	$myissue = $this->myissue->comman_function('issues','m_id',$magazine['id']);
	  	   foreach ($myissue as $myissues) {
	  ?>
		<li><a href="<?=site_url('magazine/'.$categories['slug'].'/'.$magazine['slug'].'/'.$myissues->slug);?>"><img src="<?php echo site_url('assets/images/magzines/cover/'.$myissues->cover);?>" alt="" title="" /><h3><?=$myissues->issue_name?></h3></a></li>
		  <?php } ?>
	  <?php } */
	  	echo '<ul id="load_data"></ul>';
	}
	?>

<div id="load_data_message"></div>
</div>

</div>

</div>
</div>
<script>
  $(document).ready(function(){

    var limit = 20;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '<div class="post_data">';
        output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
        output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
        output += '</div>';
      }
      $('#load_data_message').html(output);
    }

    lazzy_loader(limit);

    function load_data(limit, start)
    {
      $.ajax({
        url:"<?php echo base_url(); ?>Pages/fetch",
        method:"POST",
        data:{limit:limit, start:start, cat:<?=$categories['id']?>},
        cache: false,
        success:function(data)
        {
          if(data == '')
          {
            $('#load_data_message').html('<h3>No More Result Found</h3>');
            action = 'active';
          }
          else
          {
            $('#load_data').append(data);
            $('#load_data_message').html("");
            action = 'inactive';
          }
        }
      })
    }

    if(action == 'inactive')
    {
      action = 'active';
      load_data(limit, start);
    }

    $(window).scroll(function(){
      if($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive')
      {
        lazzy_loader(limit);
        action = 'active';
        start = start + limit;
        setTimeout(function(){
          load_data(limit, start);
        }, 1000);
      }
    });

  });
</script>