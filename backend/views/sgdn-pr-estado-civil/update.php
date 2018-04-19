<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrEstadoCivil */

$this->title = 'Update Sgdn Pr Estado Civil: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Estado Civils', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?php
  Modal::begin([
    'id' => 'update-modal',
    'size' => 'modal-sm',
    'header' => '<strong>Alterar tipo Estado Cevil</strong>',
    'footer' => Html::button('Confirmar', ['onclick' => '$("#sgdn-pr-estado-civil-form").submit();', 'class' => 'pull-right btn btn-flat btn-primary']),
  ]);
?>
    <div class="sgdn-pr-estado-civil-update">

        <!--h1><-?= Html::encode($this->title) ?></h1-->

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    <div>

<?php
  Modal::end();
?>
