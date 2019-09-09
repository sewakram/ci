<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>pages/css/style.css">
<div class="container">
  <div id='loader' style='display: none;'>
  <img src='<?=site_url('/assets/images/preloader.gif')?>' width='32px' height='32px'>
</div>
<div class="login-section">
  <h2><?= $title ?></h2>
<div class="user-prof-left">
 
    <?php
    $this->load->view('users/sidebar');
    ?>
</div>
<div class="loginbox profile subscrip">
  <div class="catList">
                  <ul>
                    <?php 
                      foreach($subscriptions as $myissue){
                      // echo $myissue['issue_name']."</br>";
                      ?>
                       <li><img src="<?php echo site_url('assets/images/magzines/cover/'.$myissue['cover']);?>" alt="" title="" /><h3><?=$myissue['issue_name']?></h3>
                        <button  type="button" id="<?= $myissue["paid"]?>" onclick="clickme('<?= $myissue["paid"]?>')" class="add-to-cart">Read Now</button>
                      </li> 
                     
                    <?php } ?>
                  </ul>
                </div>
</div>
<div class="clear"></div>

<!-- modal start -->
<!-- <div class="modal fade" id="flip-book-window" tabindex="-1" role="dialog" aria-labelledby="headerLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
      <div class="modal-body">
        <div class="mount-node">
        </div>
      </div>
    </div>
  </div>
</div> -->
<div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="headerLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title" id="headerLabel">3D FlipBook</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        some text here
      </div>
    </div>
  </div>
</div>

<div class="fb3d-modal">
  <a href="#" class="cmd-close"><span class="glyphicon glyphicon-remove"></span></a>
  <div class="mount-container">

  </div>
</div>
<!-- modal end -->
</div>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>pages/js/html2canvas.min.js"></script>
<script src="<?php echo base_url(); ?>pages/js/three.min.js"></script>
<script src="<?php echo base_url(); ?>pages/js/pdf.min.js"></script>

<script src="<?php echo base_url(); ?>pages/js/3dflipbook2.min.js"></script>
 <script src="<?php echo base_url(); ?>pages/js/bootstrap.min.js"></script>
<script type="text/javascript">

  function clickme(thisref){
  var template = {
    html: '<?php echo base_url(); ?>pages/templates/default-book-view.html',
    styles: [
      '<?php echo base_url(); ?>pages/css/font-awesome.min.css',
      '<?php echo base_url(); ?>pages/css/short-black-book-view.css'
    ],
    script: '<?php echo base_url(); ?>pages/js/default-book-view.js'
  };
var test=JSON.stringify(thisref);
  var booksOptions = {

      thisref: {
      pdf: '<?php echo site_url('assets/images/magzines/paid_magzine/');?>'+thisref+'#disableAutoFetch=true&disableStream=true',
      // downloadURL: 'books/pdf/CondoLiving.pdf',
      template: template,
      controlsProps: {
          // downloadURL: 'books/pdf/CondoLiving.pdf',
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
        propertiesCallback: function(props) {
        props.page.depth /= 4;
        props.cover.padding = 0.002;
        // props.cover.binderTexture = 'books/pdf/binder/TheThreeMusketeers.jpg';
        return props;
        },
        // styleClb: function() {
        // $('.fb3d-modal').removeClass('dark').addClass('light');
        // }
    }

  };
  // booksOptions.map(function(obj) { 
  booksOptions[thisref] = booksOptions['thisref']; // Assign new key 
  delete booksOptions['thisref']; // Delete old key 
  // return obj; 
  // });
  console.log('booksOptions',booksOptions);
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
      // instance.options.styleClb();
    });
  
  $(this).click(function(e) {
    console.log(booksOptions);
    if(e.target.id) {
        instance.options = booksOptions[e.target.id];
        $('.fb3d-modal').fb3dModal('show');
      }
  });
}
</script>
<script src="<?php echo base_url(); ?>pages/js/script.js"></script>
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
 