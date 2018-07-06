<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model backend\models\sgdnPessoa */

$this->title = $model->NOME;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-pessoa-view">
      <div class="box box-widget">
            <div class="box-body">
                  <div class="row">
                        <div class="col-md-4" >
                              <div>
                              <?php echo Html::img('@web/'.$model->URL_FOTO, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:162px;border: 1px solid #d9d9d9; padding: 4px;']); ?>
                              <footer 'style'='font-size: 12px;'><!--&emsp;--><i><b>*** Imagen do Perfil ***</b></i></footer><br><b><br>
                              <?php if($show_buttonOrLabel == true):?>
                                  <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary btn-flat']) ?>
                                  <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
                                      'class' => 'btn btn-danger btn-flat',
                                      'data' => [
                                          'confirm' => 'Are you sure you want to delete this item?',
                                          'method' => 'post',
                                      ],
                                  ]) ?>
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'NOME',
                                    //'ID',
                                    // 'NATURALIDADE_ID',
                                    'nATURALIDADE.NACIONALIDADE',
                                    //'LOCALIDADE_ID',
                                    'lOCALIDADE.NOME',
                                    //'PR_ESTADO_CIVIL_ID',
                                    'pRESTADOCIVIL.DESIG',
                                    'DT_NASC',
                                    'SEXO',
                                    'MORADA',
                                    //'URL_FOTO:url',
                                    //'DT_REGISTO',
                                    [
                                             'attribute'=>'ESTADO',
                                             'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';},
                                             'visible' => $show_buttonOrLabel,

                                    ],

                                ],
                            ]) ?>
                      </div>
              </div>
          </div>
     </div>
</div>
