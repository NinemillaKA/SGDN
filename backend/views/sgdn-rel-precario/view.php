<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelPrecario */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Precarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Visualizar Mateirial da Modadalidade </strong>',
    'footer' =>  Html::button('Close', ['onclick' => '$("#sgdn-pr-material-tp-form").submit();', 'class' => 'btn btn-flat btn-danger', 'data-dismiss'=>'modal']),
  ]);
?>

<div class="sgdn-rel-precario-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary btn btn-flat', 'onclick' => 'update("' .Url::to(['update', 'id' => $model->ID]). '")', 'data-dismiss'=>'modal']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger btn btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

<div class="row">

    <div class="col-md-6">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'ID',
                // 'REL_AULA_ID',
                'REL_MATERIAL_MODALIDADE_ID',
                'PRECO',
                'OBS',
                'DT_REGISTO',
                [
                  'attribute'=>'ESTADO',
                  'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';}
                ],
            ],
        ]) ?>
    </div>
    <div class="col-md-6">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user-2">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header" style="background-color: #cecece !important;">
            <div class="widget-user-image">
                  <?php echo Html::img('@web/'.$model->rELMATERIALMODALIDADE->mATERIAL->URL_LOGO, ['class' => 'img-responsive img-circle', 'id'=>'blah']); ?>
            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username"><?= $model->rELMATERIALMODALIDADE->mATERIAL->DESIG ?></h3>
            <h5 class="widget-user-desc"><?= $model->rELMATERIALMODALIDADE->mATERIAL->mATERIALMARCA->OBS?></h5>
          </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
              <li><a href="#">Marca <span class="pull-right badge bg-blue flat"><?= $model->rELMATERIALMODALIDADE->mATERIAL->mATERIALMARCA->DESIG?></span></a></li>
              <li><a href="#">Notes <span class="pull-right badge bg-blue flat"><?= $model->rELMATERIALMODALIDADE->mATERIAL->mATERIALTP->OBS ?></span></a></li>
              <li><a href="#">Tipo <span class="pull-right badge bg-blue flat"><?= $model->rELMATERIALMODALIDADE->mATERIAL->mATERIALTP->DESIG?></span></a></li>
              <li><a href="#">Codigo <span class="pull-right badge bg-blue flat"><?= $model->rELMATERIALMODALIDADE->mATERIAL->CODIGO ?></span></a></li>
            </ul>
          </div>
        </div>
        <!-- /.widget-user -->
    </div>
  </div>
</div>


<?php
Modal::end();
?>
