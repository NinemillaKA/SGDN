<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrDocumentoTp */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Documento Tps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>SGDN Documento</strong>',
    'footer' => Html::button('Close', ['onclick' => '$("#sgdn-pr-documento-tp-form").submit();', 'class' => 'btn btn-flat btn-danger', 'data-dismiss'=>'modal']),
  ]);
?>
<div class="sgdn-pr-documento-tp-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary', 'onclick' => 'update("' .Url::to(['update', 'id' => $model->ID]). '")', 'data-dismiss'=>'modal']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'ID',
            'CODIGO',
            'DESIG',
            'DESCR',
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
