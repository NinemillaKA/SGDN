<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnViagen */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Viagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Vizualizar Viagem</strong>',
  ]);
?>

<?= $this->render('view_detalhes_viagen', [
    'model' => $model,
    'show_buttonOrLabel'=>true,
]) ?>

<?php
  Modal::end();
?>
