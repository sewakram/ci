<div class="catwrapp singleproduct">
<div class="container">
<ul class="breadcrumb">
<li><a href="<?=site_url();?>">Home</a></li><li><a href="<?=site_url('category/'.$category->slug)?>"><?=ucfirst($category->name)?></a></li><li><?=ucfirst($magazine['name'])?></li><li><?=date('F Y', strtotime($myissue->publishing_date))?></li>
</ul>
<div class="whitebg">
<div class="prod-section">
<div class="proleft"><img src="<?php echo site_url('assets/images/magzines/cover/'.$myissue->cover);?>" alt="" title="" /><a href="#" id="preview" class="preview">Preview</a><div class="clear"></div>
<div class="content"></div>
<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>
<a href="https://twitter.com/intent/tweet?url=<?php echo $actual_link.'&text='.ucfirst($myissue->issue_name);?>" class="twitter-pro"><br class="clear" /></a><a href="#" class="fb-pro" onclick="
                    window.open(
                    'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent('<?php echo $actual_link;?>'), 
                    'facebook-share-dialog', 
                    'width=626,height=436'); 
                    return false;"><br class="clear" /></a><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $actual_link;?>" class="linke-pro"><br class="clear" /></a></div>
<div class="proright">
<?php echo form_open_multipart("addcart/".$myissue->id); ?>

<?php
  $field = array(
          "user_id" => $this->session->userdata('user_id'),
          "issue_id" =>$myissue->id
        );
  $selectRecord = $this->Category_Model->checkrecords('favourites', $field);
  $classfav = (count($selectRecord))? 'fav-box active' : 'fav-box';
 ?>
<div class="prohead"><h1><span id="favbox" class="<?=$classfav?>" onclick="<?php echo (!$this->session->userdata('login'))? "window.location.href='".site_url('users/login')."';" : 'addfav('.$myissue->id.')';?>"><br class="clear" /></span><?=ucfirst($myissue->issue_name)?> - <?=date('d F Y', strtotime($myissue->publishing_date))?></h1></div>
<div class="addthis_inline_share_toolbox"></div> 
<ul class="publisher-details">
<li><span>Publisher :</span> <?=ucfirst($magazine['publisher_company'])?></li>
<li><span>Category :</span> <?=ucfirst($category->name)?></li>
<li><span>Language :</span> <?php $this->load->model('Category_Model'); $languages = $this->Category_Model->get_details_table('languages', 'id',$magazine['languages'], 'name'); echo $languages['name']; ?></li>
<li><span>Frequency :</span> <?php $frequency = $this->myissue->comman_single_record('magazine_frequency','id',$magazine['frequency']); echo ucfirst($frequency->name);?></li>

</ul>
<section class="idonz-maga">
<section class="indoz limitedoffer">
<h4><?=ucfirst($magazine['name'])?> Subscription Plans </h4>
<p class="offerNew"><?=$magazine['description']?> </p>
<!-- <ul>                                               
<li>
   <div class="radio">
   <input class="rdtxt" id="radio-1" name="radio_purchase" type="radio" value="gold_paid_one" checked> 
   <label for="radio-1" class="radio-label">Price - $ <span class="price"><?php /*number_format(($myissue->issue_price * 30)/ $frequency->value,2)?></span>  / Month </label>
   </div>
</li>
<li>
  <div class="radio">
   <input class="rdtxt" id="radio-1" name="radio_purchase" type="radio" value="gold_paid_one" checked> 
   <label for="radio-1" class="radio-label">Price - $ <span class="price"><?php //echo number_format(($myissue->issue_price * 360)/ $frequency->value,2);*/?></span>  / Year </label>
   </div>
</li>

</ul> -->

</section>

<section class="idonztop">
<h4><?php ucfirst($magazine['name']) ?> Subscription Plans</h4>
<ul>
  <?php if($myissue->issue_price != 0 && $myissue->issue_price > 0 ){
      if( $this->session->userdata('site_currency') == 'usd'){
         $singleprice = $myissue->issue_price;
      }
      else
      {
         $singleprice = $this->session->userdata('site_currencyConverter') * $myissue->issue_price;
      }
  ?>
<li>
   <div class="radio">
    <span class="planshead">Single Issue</span>
   <input class="rdtxt" id="radio-3" name="subscripplan" type="radio" value="issue_price" checked>
   <label for="radio-3" class="radio-label"><?php echo $this->session->userdata('site_currencySymbol');?> <span class="price"><?php echo number_format($singleprice,2)?></span></label>
   </div>
</li>
<?php if($magazine['magazine_three_mon_sub_price'] != 0 && $magazine['magazine_three_mon_sub_price'] > 0 ){    if( $this->session->userdata('site_currency') == 'usd'){
         $three_mon = $magazine['magazine_three_mon_sub_price'];
      }
      else
      {
         $three_mon = $this->session->userdata('site_currencyConverter') * $magazine['magazine_three_mon_sub_price'];
      }
  ?>
<li>
 <div class="radio">
  <span class="planshead">3 Month</span>
  <input class="rdtxt" id="radio-4" name="subscripplan" type="radio" value="magazine_three_mon_sub_price" checked>
   <label for="radio-4" class="radio-label"><?php echo $this->session->userdata('site_currencySymbol');?> <span class="price"><?=number_format($three_mon,2)?></span></label>
</div>
</li>
<?php } ?>
<?php if($magazine['magazine_six_mon_sub_price'] != 0 && $magazine['magazine_six_mon_sub_price'] > 0 ){ 
      if( $this->session->userdata('site_currency') == 'usd'){
         $six_mon = $magazine['magazine_six_mon_sub_price'];
      }
      else
      {
         $six_mon = $this->session->userdata('site_currencyConverter') * $magazine['magazine_six_mon_sub_price'];
      }
  ?>
<li>
 <div class="radio">
  <span class="planshead">6 Month</span>
  <input class="rdtxt" id="radio-5" name="subscripplan" type="radio" value="magazine_six_mon_sub_price" checked>
   <label for="radio-5" class="radio-label"><?php echo $this->session->userdata('site_currencySymbol');?> <span class="price"><?=number_format($six_mon,2)?></span></label>
</div>
</li>
<?php } ?>
<?php if($magazine['magazine_twelve_mon_sub_price'] != 0 && $magazine['magazine_twelve_mon_sub_price'] > 0 ){ 
      if( $this->session->userdata('site_currency') == 'usd'){
         $twelve_mon = $magazine['magazine_twelve_mon_sub_price'];
      }
      else
      {
         $twelve_mon = $this->session->userdata('site_currencyConverter') * $magazine['magazine_twelve_mon_sub_price'];
      }
  ?>
<li>
 <div class="radio">
  <span class="planshead">1 Year</span>
  <input class="rdtxt" id="radio-6" name="subscripplan" type="radio" value="magazine_twelve_mon_sub_price" checked>
   <label for="radio-6" class="radio-label"><?php echo $this->session->userdata('site_currencySymbol');?> <span class="price"><?=number_format($twelve_mon,2)?></span></label>
</div>
</li>
<?php } ?>
<?php }else{ ?>
    <li>
   <div class="radio">
    <span class="planshead">Single Issue</span>
   <input class="rdtxt" id="radio-3" name="subscripplan" type="radio" value="issue_price" checked>
   <label for="radio-3" class="radio-label"><?php echo $this->session->userdata('site_currencySymbol');?> <span class="price">Free</span></label>
   </div>
</li>
<?php } ?>
</ul>

<div id='loader' style='display: none;'>
  <img src='<?=site_url('/assets/images/preloader.gif')?>' width='32px' height='32px'>
</div>

</section> 
</section>
    <script src="<?php echo base_url(); ?>pages/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>pages/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>pages/css/bootstrap-theme.min.css">
<script type="text/javascript">
  $("#preview").on("click", function(){
      if($('#theThreeMusketeers').length){
         $('#theThreeMusketeers').trigger('click');
      }
  });

  $("#free").on("click", function(){
      if($('#theThreeMusketeers').length){
        console.log('trigger');
         $('#theThreeMusketeers').trigger('click');
      }
  });
  function lookme(){
    $('#theThreeMusketeers').trigger('click');
  }
    </script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>pages/css/style.css">
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="headerLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title" id="headerLabel">idondza</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        idondza Preview 
      </div>
    </div>
  </div>
</div>
<div class="fb3d-modal">
  <a href="#" class="cmd-close"><span class="glyphicon glyphicon-remove"></span></a>
  <div class="mount-container">

  </div>
</div>
<div class="" style="display: none">
  <div class="books">
    <div class="thumb">
      <a href="#"><img id="theThreeMusketeers" style="min-width: 240px;" class="btn" alt="Preview" /></a>
    </div>
  </div>
</div>
<?php if($myissue->issue_price != 0 && $myissue->issue_price > 0 ){ ?>
<button type="submit" class="add-to-cart"><span data-add-to-cart-text="">Add to cart</span></button>
<?php }else{?>
<button  type="button" onclick="lookme()" class="add-to-cart">Read Now</button>
<?php }?>
<div class="clear"></div>
<?php echo form_close() ?>

</div>
<div class="clear"></div>


<div class="product-tabs">
  <input type="radio" name="tabs" id="pro-desc" checked="checked">
  <label for="pro-desc">Magazine Description</label>
  <div class="tab">
     <p><?=$magazine['description']?></p>
  </div>
  <input type="radio" name="tabs" id="issue-desc">
  <label for="issue-desc">Issue Description</label>
  <div class="tab">
    <p><?php echo $myissue->description;?></p>
  </div>
  

</div>
<div class="clear"></div>
</div>
<!-- <h2>Recent Issues</h2>
<div class="recent-issues">
<div class="catList">
<ul>
<li><a href="#"><img src="images/mag-thumb1.jpg" alt="" title="" /><h3>Lorem Ipsum industry</h3></a></li>
<li><a href="#"><img src="images/mag-thumb2.jpg" alt="" title="" /><h3>Lorem Ipsum industry</h3></a></li>
<li><a href="#"><img src="images/mag-thumb3.jpg" alt="" title="" /><h3>Lorem Ipsum industry</h3></a></li>
<li><a href="#"><img src="images/mag-thumb4.jpg" alt="" title="" /><h3>Lorem Ipsum industry</h3></a></li>
<li><a href="#"><img src="images/mag-thumb5.jpg" alt="" title="" /><h3>Lorem Ipsum industry</h3></a></li>
</ul>
</div>
</div>
<a href="#" class="viewall">VIEW ALL  >></a> -->
<div class="clear"></div>
<h2><?=ucfirst($category->name)?></h2>

<div class="recent-issues">
  <?php $recent_cat_magazine = $this->Category_Model->get_last_recent_magazines('DESC', 5, $magazine['id']); 
  ?>
  <?php 
      if(count($recent_cat_magazine) > 0)
      {
  ?>
  <div class="catList">
  <ul>
    <?php 
      foreach($recent_cat_magazine as $recent_cat_magazines){
      ?>
        <li><a href="<?=site_url('magazine/'.$category->slug.'/'.$magazine['slug'].'/'.$recent_cat_magazines['slug']);?>"><img src="<?php echo site_url('assets/images/magzines/cover/'.$recent_cat_magazines['cover']);?>" alt="" title="" /><h3><?=$recent_cat_magazines['issue_name']?></h3></a></li>
      <?php } ?>
  </ul>
  <?php 
    }
    else
    {
      echo "Sorry Not any magazine avail in this category.";
    }
  ?>
</div>
</div>
<a href="<?=site_url('category/'.$category->slug)?>" class="viewall">VIEW ALL  >></a>
<div class="clear"></div>

</div>
<style type="text/css">
  /* Popup box BEGIN */
.hover_bkgr_fricc{
    background:rgba(0,0,0,.4);
    cursor:pointer;
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
	left:0;
	right:0;
}
.hover_bkgr_fricc .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc > div {
    background-color: #000;
    /*box-shadow: 10px 10px 60px #555;*/
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height:90px;
    vertical-align: middle;
    width:25%;
    position: relative;
    border-radius: 8px;
    padding: 15px 5% 0;
	color:#FFF;
}
.popupCloseButton {
    background-color: #fff;
    border: 3px solid #999;
    border-radius: 50px;
    cursor: pointer;
    display: inline-block;
    font-family: arial;
    font-weight: bold;
    position: absolute;
    top: -20px;
    right: -20px;
    font-size: 25px;
    line-height: 30px;
    width: 30px;
    height: 30px;
    text-align: center;
}
.popupCloseButton:hover {
    background-color: #ccc;
}
.trigger_popup_fricc {
    cursor: pointer;
    font-size: 20px;
    margin: 20px;
    display: inline-block;
    font-weight: bold;
}

.hover_bkgr_fricc > div p {text-indent: unset;}
#fav-response {
	display: block;
	text-align: center;
	margin: 0 auto;
	float: none;
	padding: 0;
}
/* Popup box BEGIN */
</style>

<div class="hover_bkgr_fricc">
    <span class="helper"></span>
    <div>
	<span id="fav-response" class="fav-box"><br class="clear"></span><br class="clear">
        <p><?=ucfirst($myissue->issue_name)?></p><p id="fav-msg"></p>
    </div>
</div>
<script>
  function addfav(favid){
      $.ajax({
        type: 'POST',
        url: '<?=site_url('pages/addfav');?>',
        data: 'fav='+favid,
        success: function(data){
          var obj = JSON.parse(data);
          if(obj.class)
          {
              $('#fav-msg').html(obj.msg);
			  $('#fav-response').addClass('active');
              $('.hover_bkgr_fricc').show();
              setTimeout(function(){ $('.hover_bkgr_fricc').hide(); },2000);
              $('#favbox').addClass('active');
			  
          }
          else
          {
             $('#fav-msg').html(obj.msg);
			 $('#fav-response').removeClass('active');
             $('.hover_bkgr_fricc').show();
             setTimeout(function(){ $('.hover_bkgr_fricc').hide(); },2000);
             $('#favbox').removeClass('active');
          }
        }
    });
  }
</script>
</div>
</div>

<script src="<?php echo base_url(); ?>pages/js/html2canvas.min.js"></script>
<script src="<?php echo base_url(); ?>pages/js/three.min.js"></script>
<script src="<?php echo base_url(); ?>pages/js/pdf.min.js"></script>

<script src="<?php echo base_url(); ?>pages/js/3dflipbook.min.js"></script>

<script type="text/javascript">

$(function() {
  
  function theKingIsBlackPageCallback(n) {
    return {
      type: 'image',
      src: '<?php echo base_url(); ?>pages/books/image/theKingIsBlack/'+(n+1)+'.jpg',
      interactive: false
    };
  }
  var booksOptions = {
    theKingIsBlack: {
      pageCallback: theKingIsBlackPageCallback,
      pages: 40,
      propertiesCallback: function(props) {
        props.cover.color = 0x000000;
        return props;
      },
      controlsProps: {
      downloadURL: false,
      actions: {
        cmdBackward: {
          code: 37,
        },
        cmdForward: {
          code: 39
        },
         cmdSave: {
                enabled: false
              },
        cmdPrint: {
          enabled: false
        }
      }
      },
      template: {
        html: '<?php echo base_url(); ?>pages/templates/default-book-view.html',
        styles: [
          '<?php echo base_url(); ?>pages/css/font-awesome.min.css',
          '<?php echo base_url(); ?>pages/css/short-white-book-view.css'
        ],
        script: '<?php echo base_url(); ?>pages/js/default-book-view.js',
        sounds: {
          startFlip: '<?php echo base_url(); ?>pages/sounds/start-flip.mp3',
          endFlip: '<?php echo base_url(); ?>pages/sounds/end-flip.mp3'
        }
      },
      styleClb: function() {
        $('.fb3d-modal').removeClass('light').addClass('dark');
      }
    },
    theThreeMusketeers: {
      pdf: '<?php echo site_url('assets/images/magzines/preview/'.$myissue->preview);?>#disableAutoFetch=true&disableStream=true',
      downloadURL: false,
      controlsProps: {
      downloadURL: false,
      actions: {
        cmdBackward: {
          code: 37,
        },
        cmdForward: {
          code: 39
        },
         cmdSave: {
                enabled: false
              },
        cmdPrint: {
          enabled: false
        }
      }
      },
      template: {
        html: '<?php echo base_url(); ?>pages/templates/default-book-view.html',
        styles: [
          '<?php echo base_url(); ?>pages/css/font-awesome.min.css',
          '<?php echo base_url(); ?>pages/css/short-black-book-view.css'
        ],
        script: '<?php echo base_url(); ?>pages/js/default-book-view.js',
        sounds: {
          startFlip: '<?php echo base_url(); ?>pages/sounds/start-flip.mp3',
          endFlip: '<?php echo base_url(); ?>pages/sounds/end-flip.mp3'
        }
      },
      propertiesCallback: function(props) {
        props.page.depth /= 4;
        props.cover.padding = 0.002;
        props.cover.binderTexture = '<?php echo base_url(); ?>pages/books/pdf/binder/TheThreeMusketeers.jpg';
        return props;
      },
      styleClb: function() {
        $('.fb3d-modal').removeClass('dark').addClass('light');
      }
    }
  };

  var instance = {
    scene: undefined,
    options: undefined,
    node: $('.fb3d-modal .mount-container')
  };

  var modal = $('.fb3d-modal');
    modal.on('fb3d.modal.hide', function() {
      instance.scene.dispose();
    });
    modal.on('fb3d.modal.show', function() {
      instance.scene = instance.node.FlipBook(instance.options);
      instance.options.styleClb();
    });
    $('.books').find('img').click(function(e) {
      if(e.target.id) {
        instance.options = booksOptions[e.target.id];
        $('.fb3d-modal').fb3dModal('show');
      }
    });
  });

  $('#modalView').on('shown.bs.modal', function() {
     $(this).find('.modal-dialog').css({
        width: ($(this).find('.modal-body').find('*').width()+60)+'px',
        opacity: 1
     });
  });
  $('#modalView').on('hidden.bs.modal', function() {
     $(this).find('.modal-dialog').css({
        opacity: 0
     });
  });

  $('.image-preview .pbtn').click(function(e) {
    var target = e.target;
    while(target && !$(target).hasClass('wrap')) {
      target = target.parentNode;
    }

    var view = $('#modalView'), body = view.find('.modal-body'), footer = view.find('.modal-footer');
    body.html($('<img style="width: '+$(target).css('width')+'; height: '+$(target).css('height')+';" src="images/'+e.target.id+'.gif">'));
    footer.html($(e.target).attr('data'));
    view.modal('show');
  });

  $('.img-link').click(function(e) {
    e.preventDefault();
    $($(e.target).attr('href')).trigger('click');
  });
</script>
 <script src="<?php echo base_url(); ?>pages/js/script.js"></script>