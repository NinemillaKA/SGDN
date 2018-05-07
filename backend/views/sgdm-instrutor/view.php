<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdmInstrutor */

$this->title = $model->pESSOA->NOME;

$this->params['breadcrumbs'][] = ['label' => 'Sgdm Instrutors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Vizualizar Instrutor</strong>',
  ]);
?>

<div class="sgdm-instrutor-view">

  <h3><?= Html::encode($this->title) ?></h3>
<br>
    <div class="row">
        <div class="col-md-12">
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">Dados do Instrutor</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="col-md-4">
                        <?php echo Html::img('@web/'.$model->pESSOA->URL_FOTO, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:162px;border: 1px solid #d9d9d9; padding: 4px;']); ?>
                        <footer 'style'='font-size: 12px;'><b>Perfil:</b><?=$model->pESSOA->NOME?></footer><br><b><br>
                          <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary', 'onclick' => 'update("' .Url::to(['update', 'id' => $model->ID]). '")', 'data-dismiss'=>'modal']) ?>
                          <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
                              'class' => 'btn btn-danger',
                              'data' => [
                                  'confirm' => 'Are you sure you want to delete this item?',
                                  'method' => 'post',
                              ],
                          ]) ?>
                </div>
                <div class="col-md-8">

                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'CODIGO',
                                    'OBS',
                                    //'pESSOA.NOME',
                                    //'ID',
                                    // 'NATURALIDADE_ID',
                                    'pESSOA.nATURALIDADE.NACIONALIDADE',
                                    //'LOCALIDADE_ID',
                                    'pESSOA.lOCALIDADE.NOME',
                                    //'PR_ESTADO_CIVIL_ID',
                                    'pESSOA.pRESTADOCIVIL.DESIG',
                                    'pESSOA.DT_NASC',
                                    'pESSOA.SEXO',
                                    'pESSOA.MORADA',
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
     </div>

     <div class="row">
           <div class="col-md-12">
             <?= $this->render('/sgdn-pessoa/view_contacto_pessoa', [
                 'model' => $model->pESSOA,
                 'modelContatos' => $model->pESSOA->sgdnRelContactos,
                 'modelDocumentos' => $model->pESSOA->sgdnRelDocumentos,
                 'show_buttonOrLabel'=>true,
             ]) ?>
           </div>
    </div>

  </div>
  <!-- <script>

      function getPessoaAll(id_pessoa){
          $.get( '<-?=Url::to(['sgdn-pessoa/get-pessoa-all'])?>',{id:id_pessoa} function( data ) {
          $( "#result" ).html( data );
          });
      }

  </script> -->
<?php
  Modal::end();
?>
