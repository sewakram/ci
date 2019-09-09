<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>3D FlipBook - jQuery plugin</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>pages/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>pages/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>pages/css/style.css">

    <script src="<?php echo base_url(); ?>pages/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>pages/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $(function () {
        var titles = {
          'bookview': 'idondza',
        }, title = $('title'), content = $('.content');
        function loadContent(docName) {
          title.text(titles[docName]);
          $.get( '<?php echo base_url('pages/viewmagazine'); ?>', { name: "John" } )
          .done(function( html ) {
            content.html(html);
          });
        }
        function navigation(e) {
          var target = e.target;
          while(target && target.tagName!=='A') {
            target = target.parentNode;
          }
          if(target && target.href.indexOf('#')===-1 && target.href.indexOf(window.location.origin)===0) {
            e.preventDefault();
            var location = window.location,
                parts = target.href.substr(location.origin.length).split(location.pathname),
                docName = parts[parts.length-1];
            if(docName==='') {
              docName = 'bookview';
            }
            if(((history.state || {}).docName || '')!==docName) {
              history.pushState({docName: docName}, titles[docName], '#'+docName);
              alert(docName);
              //loadContent(docName);
            }
          }
        }
        $(document).on('click', navigation);
        $(window).on('popstate', function(e) {
          if(e.originalEvent.state) {
            loadContent(e.originalEvent.state.docName);
          }
        });

        var docName = window.location.hash.substr(1) || '';
        if(docName==='' || !titles[docName]) {
          docName = 'bookview';
        }
        history.replaceState({docName: docName}, titles[docName], '#'+docName);
        loadContent(docName);
      });
    </script>
  </head>

  <body>
   
    <div class="container">
      <div class="content">
      </div>
      <div class="copyright">
        <span class="sign">©</span> <span class="author">Idondza</span>. All rights reserved.
      </div>
    </div>
    <script src="<?php echo base_url(); ?>pages/js/script.js"></script>
  </body>
</html>
