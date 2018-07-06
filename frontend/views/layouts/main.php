<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\Modal;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Surfer Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
  	SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <link href='//fonts.googleapis.com/css?family=Buda:300' rel='stylesheet' type='text/css'>
  <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
  <!-- banner -->
  <div class="banner jarallax">
    <div class="banner-info">
      <div class="banner-top">
        <div class="container">
          <div class="navbar-header banner-logo">
            <a href="index.html">
              <h1>SURFER <span>Wave Diver</span></h1>
            </a>
          </div>
          <div class="banner-top-right">
            <div class="agileinfo-social-grids">
              <ul>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-rss"></i></a></li>
                <li><a href="#" onclick="js:create('<?= Url::to(['site/login']) ?>','login-form','modal-sm')"><i class="fa fa-sign-in"></i></a></li>
                <li><a href="#" onclick="js:create('<?= Url::to(['user/create']) ?>','login-form','modal-lg')"><i class="fa fa-user-plus"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <!-- banner-text -->
      <div class="banner-text">
        <!-- top-navigation -->
        <div class="main">
          <div class="container">
            <nav id="menu" class="nav top-nav">
              <button  class="navtoogle">
                <span class="icon-menu glyphicon glyphicon-menu-hamburger"> </span> Menu
              </button>
              <ul>
                <li>
                  <a href="<?= Url::to(['site/index'])?>">
                    <span class="icon">
                      <i aria-hidden="true" class="icon-home glyphicon glyphicon-home"></i>
                    </span>
                    <span>Home</span>
                  </a>
                </li>
                <li>
                  <a href="#about" class="scroll">
                    <span class="icon">
                      <i aria-hidden="true" class="icon-services glyphicon glyphicon-info-sign"></i>
                    </span>
                    <span>About</span>
                  </a>
                </li>
                <li>
                  <a href="<?= Url::to(['site/services'])?>">
                    <span class="icon">
                      <i aria-hidden="true" class="icon-portfolio glyphicon glyphicon-cog"></i>
                    </span>
                    <span>Services</span>
                  </a>
                </li>
                <li>
                  <a href="<?=Url::to(['site/team'])?>">
                    <span class="icon">
                      <i aria-hidden="true" class="icon-team fa fa-group"></i>
                    </span>
                    <span>Team</span>
                  </a>
                </li>
                <li>
                <a href="<?=Url::to(['site/gallery'])?>">
                    <span class="icon">
                      <i aria-hidden="true" class="icon-blog glyphicon glyphicon-picture"></i>
                    </span>
                    <span>Gallery</span>
                  </a>
                </li>
                <li>
                  <a href="<?= Url::to(['site/contact'])?>">
                    <span class="icon">
                      <i aria-hidden="true" class="icon-contact glyphicon glyphicon-envelope"></i>
                    </span>
                    <span>Contact</span>
                  </a>
                </li>
              </ul>
            </nav>
            <script src="js/modernizr.custom.js"></script>
          </div>
        </div>
        <!-- //top-navigation -->
      </div>
      <!-- //banner-text -->
      <div class="clearfix"> </div>
      <p class="w3-agilephn"><span class="glyphicon glyphicon-earphone"></span> +11 999 8888 7777 </p>
    </div>
  </div>
  <!-- //banner -->
<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
<!-- footer -->
<div class="w3l-footer">
  <div class="container">
    <div class="copyright-agile">
      <p>&copy; 2017 Surfer. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
    </div>
  </div>
</div>
<!-- //footer -->
<!-- modal-about -->
<div class="modal bnr-modal fade" id="myModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body modal-spa">
        <!-- <iframe src="https://player.vimeo.com/video/117554484?title=0&portrait=0"></iframe> -->
        <div class="modal-w3lstext">
          <h4>Blanditiis deleniti</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras rutrum iaculis enim, non convallis felis mattis at. Donec fringilla lacus eu pretium rutrum. Cras aliquet congue ullamcorper. Etiam mattis eros eu ullamcorper volutpat. Proin ut dui a urna efficitur varius. uisque molestie cursus mi et congue consectetur adipiscing elit cras rutrum iaculis enim, Lorem ipsum dolor sit amet, non convallis felis mattis at. Maecenas sodales tortor ac ligula ultrices dictum et quis urna. Etiam pulvinar metus neque, eget porttitor massa vulputate in. Fusce lacus purus, pulvinar ut lacinia id, sagittis eumi.</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
  /* init Jarallax */
  $('.jarallax').jarallax({
    speed: 0.5,
    imgWidth: 1366,
    imgHeight: 768
  })
</script>
<!-- //jarallax -->
<!-- start-smooth-scrolling -->

<script type="text/javascript">
    jQuery(document).ready(function($) {
      $(".scroll").click(function(event){
        event.preventDefault();

    $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
      });
    });
</script>
<!-- //end-smooth-scrolling -->
<!-- smooth-scrolling-of-move-up -->
<script type="text/javascript">
  $(document).ready(function() {
    /*
    var defaults = {
      containerID: 'toTop', // fading element id
      containerHoverID: 'toTopHover', // fading element hover id
      scrollSpeed: 1200,
      easingType: 'linear'
    };
    */

    $().UItoTop({ easingType: 'easeOutQuart' });

  });
  $(document).ready(function () {
  	var rotationMultiplier = 3.6;
  	// For each div that its id ends with "circle", do the following.
  	$( "div[id$='circle']" ).each(function() {
  		// Save all of its classes in an array.
  		var classList = $( this ).attr('class').split(/\s+/);
  		// Iterate over the array
  		for (var i = 0; i < classList.length; i++) {
  		   /* If there's about a percentage class, take the actual percentage and apply the
  				css transformations in all occurences of the specified percentage class,
  				even for the divs without an id ending with "circle" */
  		   if (classList[i].match("^p")) {
  			var rotationPercentage = classList[i].substring(1, classList[i].length);
  			var rotationDegrees = rotationMultiplier*rotationPercentage;
  			$('.c100.p'+rotationPercentage+ ' .bar').css({
  			  '-webkit-transform' : 'rotate(' + rotationDegrees + 'deg)',
  			  '-moz-transform'    : 'rotate(' + rotationDegrees + 'deg)',
  			  '-ms-transform'     : 'rotate(' + rotationDegrees + 'deg)',
  			  '-o-transform'      : 'rotate(' + rotationDegrees + 'deg)',
  			  'transform'         : 'rotate(' + rotationDegrees + 'deg)'
  			});
  		   }
  		}
  	});
  });


  function create(url, id, sz) {
    $('#create-modal').find('.content').load(url, function() {
      $("#create-modal").find('.modal-dialog').removeClass('modal-sm');
      $("#create-modal").find('.modal-dialog').removeClass('modal-lg');
      $("#create-modal").find('.modal-dialog').addClass(sz);
      $('#modal-btn').attr('onclick','$("#'+id+'").submit();')
      $("#create-modal").modal("show");
    });
  }
</script>
</html>
<?php $this->endPage() ?>

<?php
  Modal::begin([
    'id' => 'create-modal',
    //'size' => 'modal-lg',
    'header' => '<strong>Registar Perfil</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '', 'class' => 'btn btn-flat btn-primary', 'id'=>'modal-btn']),
  ]);
?>

<!-- <-?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Registar Perfil</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '', 'class' => 'btn btn-flat btn-primary', 'id'=>'modal-btn']),
  ]);
?> -->


<div class="content">


</div>

<?php
  Modal::end();
?>
