<div id="footer">
<div class="container">
		<div class="ft-address">
			<div class="add-txt">
			<h3>Contact Us</h3>
			<p><b>Corporate Address:</b></br><?= $contact['company_address'];?></p>
		</div>
		</div>
		<div class="ftmid">
				<h3>Latest News</h3>
			<ul>
        <?php foreach ($customepage as $key => $value) { ?>

				<li><a href="<?php echo base_url(); ?>page/<?php echo $value['slug']; ?>"><?php echo $value['page_name']?></a></li>

       <?php } ?>
				<!-- <li><a href="#">Our Team</a></li>
				<li><a href="#">Board of Directors</a></li>
				<li><a href="#">Advisory Board</a></li>
				<li><a href="#">Our Partners</a></li>
				<li><a href="#">Advertising</a></li>
				<li><a href="#">Press</a></li> -->
			</ul>
 
		</div>
		<div class="ftrgt">
			<h3>Follow Us</h3>
			<ul>
				<li><a href="#" class="tw"> Twitter</a></li>
				<li><a href="#" class="fb"> Facebook</a></li>
				<li><a href="#" class="ldin"> Linkedin</a></li>
			</ul>


		</div>
<div class="clear"></div>

 
</div>
</div>

<div class="copyright">
	<div class="container">
		<div class="copytxt">
			<p>&copy; Copyright 2019,All rights reserved, <br/> Design & developed by kyzooma.com</p>
		</div>
		<div class="credit">
		<ul>
			<li><img src="<?php echo base_url(); ?>assets/images/front/paypal.png" alt="Paypal"></li>
			<li><img src="<?php echo base_url(); ?>assets/images/front/visa.png" alt="Visa"></li>
			<li><img src="<?php echo base_url(); ?>assets/images/front/pay-u.png" alt="Pay U"></li>
			<li><img src="<?php echo base_url(); ?>assets/images/front/eft.png" alt="eft"></li>
		</ul>

		</div>
		<div class="clear"></div>
	</div>
</div>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.waterwheelCarousel.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        var carousel = $("#carousel").waterwheelCarousel({
          flankingItems: 3,
          movingToCenter: function ($item) {
            $('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
          },
          movedToCenter: function ($item) {
            $('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
          },
          movingFromCenter: function ($item) {
            $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
          },
          movedFromCenter: function ($item) {
            $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
          },
          clickedCenter: function ($item) {
            $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
          }
        });
        $('#prev').bind('click', function () {
          carousel.prev();
          return false
        });

        $('#next').bind('click', function () {
          carousel.next();
          return false;
        });

        $('#reload').bind('click', function () {
          newOptions = eval("(" + $('#newoptions').val() + ")");
          carousel.reload(newOptions);
          return false;
        });

        // Magazines
var carousel2 = $("#carousel2").waterwheelCarousel({
          flankingItems: 3,
          movingToCenter: function ($item) {
            $('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
          },
          movedToCenter: function ($item) {
            $('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
          },
          movingFromCenter: function ($item) {
            $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
          },
          movedFromCenter: function ($item) {
            $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
          },
          clickedCenter: function ($item) {
            $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
          }
        });

        $('#prev2').bind('click', function () {
          carousel2.prev();
          return false
        });

        $('#next2').bind('click', function () {
          carousel2.next();
          return false;
        });
        // Article Reports 
var carousel3 = $("#carousel3").waterwheelCarousel({
          flankingItems: 3,
          movingToCenter: function ($item) {
            $('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
          },
          movedToCenter: function ($item) {
            $('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
          },
          movingFromCenter: function ($item) {
            $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
          },
          movedFromCenter: function ($item) {
            $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
          },
          clickedCenter: function ($item) {
            $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
          }
        });

        $('#prev3').bind('click', function () {
          carousel3.prev();
          return false
        });

        $('#next3').bind('click', function () {
          carousel3.next();
          return false;
        });
// Promo4
var carousel4 = $("#carousel4").waterwheelCarousel({
          flankingItems: 3,
          movingToCenter: function ($item) {
            $('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
          },
          movedToCenter: function ($item) {
            $('#callback-output').prepend('movedToCenter: ' + $item.attr('id') + '<br/>');
          },
          movingFromCenter: function ($item) {
            $('#callback-output').prepend('movingFromCenter: ' + $item.attr('id') + '<br/>');
          },
          movedFromCenter: function ($item) {
            $('#callback-output').prepend('movedFromCenter: ' + $item.attr('id') + '<br/>');
          },
          clickedCenter: function ($item) {
            $('#callback-output').prepend('clickedCenter: ' + $item.attr('id') + '<br/>');
          }
        });

        $('#prev4').bind('click', function () {
          carousel4.prev();
          return false
        });

        $('#next4').bind('click', function () {
          carousel4.next();
          return false;
        });

      });
      
        
    </script>


   <script type="text/javascript">
 

  jQuery(document).ready(function(){
    jQuery('.menutab').click(function(event){
       event.stopPropagation();
       jQuery( "ul.menubar" ).slideToggle();
   });
});

 
      </script>
 
   <!-- <script src="//code.jquery.com/jquery-1.12.4.js"></script> -->
   
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <script type="text/javascript">
          jQuery().ready(function() {  
    /* Custom select design */    
    jQuery('.drop-down').append('<div class="button"></div>');    
    jQuery('.drop-down').append('<ul class="select-list"></ul>');    
    jQuery('.drop-down select option').each(function() {  
    var bg = jQuery(this).css('background-image');    
    jQuery('.select-list').append('<li class="clsAnchor"><span value="' + jQuery(this).val() + '" class="' + jQuery(this).attr('class') + '" style=background-image:' + bg + '>' + jQuery(this).text() + '</span></li>');   
    });    
    jQuery('.drop-down .button').html('<span class\="drop-selected" style=background-image:' + jQuery('.drop-down select').find(':selected').css('background-image') + '>' + jQuery('.drop-down select').find(':selected').text() + '</span>' + '<a href="javascript:void(0);" class="select-list-link fa fa-angle-down"></a>');   
    jQuery('.drop-down ul li').each(function() {   
    if (jQuery(this).find('span').text() == jQuery('.drop-down select').find(':selected').text()) {  
    jQuery(this).addClass('active');       
    }      
    });     
    jQuery('.drop-down .select-list span').on('click', function()
    {          
    var dd_text = jQuery(this).text();  
    var dd_img = jQuery(this).css('background-image'); 
    var dd_val = jQuery(this).attr('value');   
    jQuery('.drop-down .button').html('<span class\="drop-selected" style=background-image:' + dd_img + '>' + dd_text + '</span>' + '<a href="javascript:void(0);" class="select-list-link fa fa-angle-down"></a>');      
    jQuery('.drop-down .select-list span').parent().removeClass('active');    
    jQuery(this).parent().addClass('active');     
    $('.drop-down select[name=options]').val( dd_val ); 
    $('.drop-down .select-list').slideUp();
    window.location.href='<?php echo base_url(); ?>CountrySwitcher/switchcountry/'+dd_val;     
    });       
    jQuery('.drop-down .button').on('click','a.select-list-link', function()
    {      
    jQuery('.drop-down ul').slideToggle();  
    });     
    /* End */       
    });
    </script>
	
	<script>
jQuery(document).ready(function(){  
jQuery('.sel-box').prepend("<div id='mobile-toggle'>Login/Register</div>");
jQuery('#mobile-toggle').click(function(){
jQuery('.sel-box ul').slideToggle();
jQuery('.sel-box li a ').on('click',function () {
       jQuery('.sel-box ul').slideUp();
     });
}); 
});
</script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d5bbb2c115bda7e"></script> 
</body>
</html>
