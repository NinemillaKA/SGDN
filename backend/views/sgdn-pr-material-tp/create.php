<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrMaterialTp */

$this->title = 'Create Sgdn Pr Material Tp';
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Material Tps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
  Modal::begin([
    'id' => 'create-modal',
    'size' => 'modal-sm',
    'header' => '<strong>Registar tipo Material</strong>',
    'footer' => Html::button('<i class="fa fa-save"></i> Confirmar', ['onclick' => '$("#sgdn-pr-material-tp-form").submit();', 'class' => 'btn btn-flat btn-primary']),
  ]);
?>
<div class="sgdn-pr-material-tp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
  Modal::end();
?>
