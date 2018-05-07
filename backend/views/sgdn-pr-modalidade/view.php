<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrModalidade */

$this->title = $model->DESIG;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pr Modalidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>SGDN Modalidade</strong>',
    'footer' => Html::button('Close', ['onclick' => '$("#sgdn-pr-modalidade-form").submit();', 'class' => 'btn btn-flat btn-danger', 'data-dismiss'=>'modal']),
  ]);
?>

<div class="sgdn-pr-modalidade-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="row">
        <div class="col-md-4" >
              <div>
              <?php echo Html::img('@web/'.$model->URL_IMAGEM, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 190px; width:300px;border: 0px solid #d9d9d9; padding: 4px;']); ?>
              <footer 'style'='font-size: 12px;'><b>Imagem:</b> Modalidade <?=$model->DESIG?></footer><br><b><br>
              <?= Html::a('Update', ['update', 'id' => $model->ID], ['onclick' => '$("#sgdn-pr-modalidade-form").submit();', 'class' => 'btn btn-primary btn-flat', 'onclick' => 'update("' .Url::to(['update', 'id' => $model->ID]). '")', 'data-dismiss'=>'modal']) ?>
              <!-- <-?= Html::button('Update', ['onclick' => '$("#sgdn-pr-modalidade-form").submit();', 'class' => 'btn btn-primary btn-flat']) ?> -->
              <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
                  'class' => 'btn btn-danger btn-flat',
                  'data' => [
                      'confirm' => 'Are you sure you want to delete this item?',
                      'method' => 'post',
                  ],
              ]) ?>
            </div>
        </div>
        <div class="col-md-8">
          <?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  //'ID',
                  'CODIGO',
                  'DESIG',
                  'DESCR',
                  //'URL_IMAGEM:url',
                  'DT_REGISTO',
                  [
                    'attribute'=>'ESTADO',
                    'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';}
                  ],
              ],
          ]) ?>
        </div>
    </div>

</div>

<?php
  Modal::end();
?>
