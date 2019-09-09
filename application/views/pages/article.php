<div class="catwrapp">
<div class="container">
<div class="whitebg">

<div class="topBox">
    <div class="artdes">
<span class="article-img"><img src="<?=site_url('/assets/images/posts/'.$articles->post_image)?>" alt="<?=$articles->title?>" Title="" /></span>


<div class="clear"></div>
</div>
</div>


<div class="ArticleBox">
 <h2 class="page-title"><?=$articles->title?></h2>
 <?php $magazine = $this->myissue->comman_single_record('add_magazines','id',$articles->magazine_id);
       $category = $this->myissue->comman_single_record('categories','id',$magazine->primary_category);
      $users = $this->Category_Model->checkrecords('users',"id = $articles->user_id");
      if(!empty($users[0]['image']))
      {
        $photo = site_url( '/assets/images/users/'.$users[0]['image'] );
      }
      else
      {
        $photo = site_url( '/assets/images/user.png' );
      }
      ?>
 <div class="followArt">
   
<div class="author-info ">
<div class="avatar avatar-lg center-block">
<a class="on-navigate" href="#">
<img src="<?=$photo?>">
</a>
</div>
<div class="info">
<a class="on-navigate" href="#">
<span class="center-block">by <strong><?=$users[0]['name']?></strong></span>
</a>
<button class="btn-white on-follow-login"><span class="fa fa-user-plus"></span> <span class="follow-text">Follow</span></button>
</div>
</div>

<div class="socailShare">
  <h3>Share</h3>
  <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox_a0x1"></div>
</div>
 </div>
 <div class="cont-Art">
   <?=$articles->body?>
 </div>
 <div class="advertside">
   <img src="<?=site_url('assets/images/advert.jpg')?>"/>
 </div>
<div class="clear"></div>
<div class="youmy">
    <div class="similar-stories">
      <h4 class="section-heading">You'll also like</h4>
      <?php 
      $myissue = $this->myissue->comman_function('issues','m_id',$articles->magazine_id);
        shuffle($myissue);
         foreach ($myissue as $myissues) { ?>
      <!-- Story 1 -->
      <div class="story-item">
        <div class="story-cover-event">
        <img width="136px" height="194px" src="<?php echo site_url('assets/images/magzines/cover/'.$myissues->cover);?>" alt="<?=$myissues->issue_name?>">
        </div>
        <div class="story-cotnt">
        <h3><?=$myissues->issue_name?></h3>
        <small class="author"> By <?=$users[0]['name']?></small>

        <p><?=substr($myissues->description, 0,25)?>..</p>
        <a href="<?=site_url('magazine/'.$category->slug.'/'.$magazine->slug.'/'.$myissues->slug);?>">Read more</a>

        </div>
      </div>
    <?php } ?>
       <!-- Story 2 -->



  <div class="clear"></div>
</div>
</div>


</div>

</div>
</div>
</div>