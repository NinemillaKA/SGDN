<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAlojamento */

$this->title = $model->ID;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Alojamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Vizualizar Alojamento</strong>',
  ]);
?>

<div class="sgdn-rel-alojamento-view">

    <!-- <h1><-?= Html::encode($this->title) ?></h1> -->

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
<!--
    <-?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'PESSOA_ID',
            'RESIDENCIA_ID',
            'OBS',
            'DT_ENTRADA',
            'DT_SAIDA',
            'TOTAL',
            'DT_REGISTO',
            'ESTADO',
        ],
    ]) ?>

    <!S xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
    <div class="row">
        <div class="col-md-12">
              <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Informação da Residencia</h3>
                    </div>
                <?= $this->render('/sgdn-residencia/view_detalhes_residencia', [
                    'model' => $model->rESIDENCIA,
                    'show_buttonOrLabel'=>false,
                ]) ?>
              </div>
           </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Informação do Responsavel</h3>
                  </div>
                  <div>
                      <?= $this->render('/sgdn-pessoa/view_detalhes_pessoa', [
                          'model' => $model->pESSOA,
                          'show_buttonOrLabel'=>false,
                      ]) ?>
                  </div>
                  <div>
                      <?= $this->render('/sgdn-pessoa/view_contacto_pessoa', [
                          'model' => $model->pESSOA,
                          'modelContatos' => $model->pESSOA->sgdnRelContactos,
                          'modelDocumentos' => $model->pESSOA->sgdnRelDocumentos,
                          'show_buttonOrLabel'=>true,
                      ]) ?>
                  </div>
            </div>
         </div>
    </div>

    <div class="row">
          <div class="col-md-12">
              <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Informação do Contrato</h3>
                    </div>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                          // 'ID',
                          'PESSOA_ID',
                          'RESIDENCIA_ID',
                          'OBS',
                          'DT_ENTRADA',
                          'DT_SAIDA',
                          'TOTAL',
                          'DT_REGISTO',
                          [
                              'attribute'=>'ESTADO',
                              'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';},
                          ],
                        ],
                    ]) ?>
              </div>
          </div>
    </div>

</div>

<?php
  Modal::end();
?>
