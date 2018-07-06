<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/font-awesome.css',
        'css/percircle.css',
        'css/style.css',

    ];
    public $js = [
      'js/bootstrap.js',
      'js/easing.js',
      'js/jarallax.js',
      'js/jzBox.js',
      'js/modernizr.custom.js',
      'js/move-top.js',
      //'js/percircle.js',
      'js/SmoothScroll.min.js',
      'js/controller.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
