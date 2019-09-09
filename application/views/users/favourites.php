<div class="container">
<div class="login-section">
  <h2><?= $title ?></h2>
<div class="user-prof-left">
 
    <?php
    $this->load->view('users/sidebar');
    ?>
</div>
<div class="loginbox profile">
  <div class="catList">
                  <ul>
                    <?php 
                      foreach($myfav as $magazine){
                        $myissue = $this->myissue->common_function_fav('issues', 'add_magazines', 'id', $magazine->issue_id);
                      foreach ($myissue as $myissues) {
                      ?>
                      <li><a href="<?=site_url('magazine/'.$myissues['c_slug'].'/'.$myissues['m_slug'].'/'.$myissues['i_slug']);?>"><img src="<?php echo site_url('assets/images/magzines/cover/'.$myissues['i_cover']);?>" alt="" title="" /><h3><?=$myissues['issue_name']?></h3></a></li>
                      <?php } ?>
                    <?php } ?>
                  </ul>
                </div>
</div>
<div class="clear"></div>
</div>
</div>


 
 
	

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#dropper-default" ).datepicker({
  dateFormat: "dd-mm-yy",
  changeYear: true
});
  } );
  </script>