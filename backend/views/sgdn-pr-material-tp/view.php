<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;


/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrMaterialTp */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Material Tps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Registar tipo Contacto</strong>',
    'footer' =>  Html::button('Close', ['onclick' => '$("#sgdn-pr-material-tp-form").submit();', 'class' => 'btn btn-flat btn-danger', 'data-dismiss'=>'modal']),
  ]);
?>

<div class="sgdn-pr-material-tp-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary btn btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger btn btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'CODIGO',
            'DESIG',
            'OBS',
            'DT_REGISTO',
            [
              'attribute'=>'ESTADO',
              'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';}
            ],
        ],
    ]) ?>

</div>

<?php
  Modal::end();
?>
