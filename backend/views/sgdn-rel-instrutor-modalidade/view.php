<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelInstrutorModalidade */

 $this->title = 'Instrutor: '.$model->pESSOA->NOME;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Instrutor Modalidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Vizualizar Instrutor</strong>',
  ]);
?>

<div class="sgdn-rel-instrutor-modalidade-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary', 'onclick' => 'update("' .Url::to(['update', 'id' => $model->ID]). '")', 'data-dismiss'=>'modal']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> <br>
    <div class="row">
      <div class="col-md-12">
          <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Informação Pessoal</h3>
                </div>
            <?= $this->render('/sgdn-pessoa/view_detalhes_pessoa', [
                'model' => $model->iNSTRUTOR->pESSOA,
                'show_buttonOrLabel'=>false,
            ]) ?>
          </div>
       </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Informação de Contrato</h3>
                  </div>
                  <?= DetailView::widget([
                      'model' => $model,
                      'attributes' => [
                          //'ID',
                          //'PR_MODALIDADE_ID',
                          //'INSTRUTOR_ID',
                          'pRMODALIDADE.DESIG',
                          'OBS',
                          'DATA',
                          [
                              'attribute'=>'ESTADO',
                              'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';},
                          ],
                      ],
                  ]) ?>
            </div>
        </div>
    </div>
    <div class="row">
          <div class="col-md-12">
            <?= $this->render('/sgdn-pessoa/view_contacto_pessoa', [
                'model' => $model->iNSTRUTOR->pESSOA,
                'modelContatos' => $model->iNSTRUTOR->pESSOA->sgdnRelContactos,
                'modelDocumentos' => $model->iNSTRUTOR->pESSOA->sgdnRelDocumentos,
                'show_buttonOrLabel'=>true,
            ]) ?>
          </div>
   </div>

<?php
  Modal::end();
?>
