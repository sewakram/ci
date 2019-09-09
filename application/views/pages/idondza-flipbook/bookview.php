<?php 
if(!isset($_GET['name']))
{
   return false;
}
?>
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
      pdf: '<?php echo site_url('assets/images/magzines/preview/'.$_GET['name']);?>#disableAutoFetch=true&disableStream=true',
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
