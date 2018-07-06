<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\SgdnPessoa;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelMatricula */

$this->title = $model->aLUNO->NOME;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Matriculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Vizualizar Aula/strong>',
  ]);
?>


<div class="sgdn-rel-matricula-view">

    <h1>Matricula de <?= Html::encode($this->title) ?></h1>

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
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'ID',
                    //'ALUNO_ID',
                    'AULA_ID',
                    'CODIGO',
                    'DATA',
                    'OBS',
                    'DT_REGISTO',
                    'ESTADO',
                    'PRECO',
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-blue">
                <!-- <div class="widget-user-image">
                  <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar"> -->
                  <div class="widget-user-image">
                      <?php echo Html::img('@web/'.$model->aLUNO->URL_FOTO, ['class' => 'img-responsive img-circle', 'id'=>'blah']); ?>
                  </div>
                <!-- </div> -->
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><?=$model->aLUNO->NOME?></h3>
                <h5 class="widget-user-desc"><?=$model->aLUNO->nATURALIDADE->NACIONALIDADE?></h5>
              </div>
              <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                  <li><a href="#">Localidade <span class="pull-right badge bg-blue"><?=$model->aLUNO->lOCALIDADE->NOME?></span></a></li>
                  <li><a href="#">Sexo <span class="pull-right badge bg-blue"><?=$model->aLUNO->SEXO?></span></a></li>
                  <li><a href="#">Estado Civil <span class="pull-right badge bg-blue"><?=$model->aLUNO->pRESTADOCIVIL->DESIG?></span></a></li>
                  <li><a href="#">Data Nascimento <span class="pull-right badge bg-red"><?=$model->aLUNO->DT_NASC?></span></a></li>
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->

        </div>


    </div>

</div>
