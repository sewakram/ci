<script src="<?php echo base_url(); ?>assets/js/jquery.mixitup.min.js"></script>
<div class="catwrapp singleproduct">
<div class="container">
<!-- <ul class="breadcrumb">
<li><a href="#">Home</a></li><li><a href="#">Magazines</a></li><li><a href="#">Women's Health</a></li><li>September 2019</li>
</ul> -->
<div class="whitebg" id="Container">

		<ul class="mix-nav">  
		   	<li><a class="filter active" data-filter="all" data-my-order="1">All</a></li>
		   	<?php foreach ($categories as $blogcategories) { ?>
		   		<li><a class="filter" data-filter=".<?=strtolower($blogcategories['slug'])?>" data-my-order="2"><?=$blogcategories['name']?></a></li>
		   	<?php } ?>
		</ul>
		<ul class="mix-panels" id="load_data">

			<?php /*$articles_cat = $this->articlescat->common_function_article_reports('posts', 'categories', 'status', '1'); 
			if(count($articles_cat) > 0){
				foreach ($articles_cat as $articlescategory) { ?>
					<li style="display: inline-block;" class="mix <?=$articlescategory['c_slug']?>">
						<a href="#"><img src="<?php echo site_url('/assets/images/posts/'.$articlescategory['post_image']);?>"></a>
		                <h5><a href="oasishr.html"><?=$articlescategory['title']?></a></h5>
					</li>
			<?php
				}
			 }
			 else{
			 	echo "No record found?";
			 }*/
			?>
		</ul>
		 <div id="load_data_message"></div>

</div>

</div>
</div>
<script type="text/javascript">
  $(function(){
    $('#Container').mixItUp();
  });
</script>
<script>
  $(document).ready(function(){

    var limit = 21;
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
        url:"<?php echo base_url(); ?>pages/loadarticlereport",
        method:"POST",
        data:{limit:limit, start:start},
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