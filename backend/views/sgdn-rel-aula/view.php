<?php

use yii\helpers\Html;
use backend\models\SgdnRelAulaInstrutorModalidade;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAula */

$this->title = $model->DESIG;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Rel Aulas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
  Modal::begin([
    'id' => 'view-modal',
    'size' => 'modal-lg',
    'header' => '<strong>Vizualizar Aula/strong>',
  ]);
?>

<div class="sgdn-rel-aula-view">

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
</div>

<div class="row">
       <div class="col-md-7">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'ID',
                    'SPOT_ID',
                    'MODALIDADE_ID',
                    //'sgdnRelAulaInstrutorModalidades.iNSTRUTORMODALIDADE.iNSTRUTOR.pESSOA.NOME',
                    // 'sgdnRelAulaInstrutorModalidades.iNSTRUTORMODALIDADE.iNSTRUTOR.pESSOA.ID',
                    'DT_INICIO',
                    'DT_FIM',
                    'DT_REGISTO',
                    'HORA_INICIO',
                    'HORA_FIM',
                    'ESTADO',
                    'DESIG',
                    'PRECO',
                ],
             ]) ?>
          </div>
          <div class="col-md-5">
              <div class="box box-default">
                          <div class="box-header with-border">
                                <h3 class="box-title">Intrutores da Aula </h3>

                                <div class="box-tools pull-right">
                                  <h4><span class="label label-default" style="padding: 13px 9px 1px 6px;"> <?= Html::encode($instructorCounter)?> Membros</span></h4>
                                </div>
                          </div>
                          <!-- /.box-header -->
                          <ul class="users-list clearfix" style="padding: 16px 4px 6px 80px;">
                                <?php foreach ($modelAulaInstrutorModalidade as $key => $AulaInstrutorModalidade) { ?>
                                      <!-- <li> -->
                                          <!-- <-?php echo Html::img('@web/'.$AulaInstrutorModalidade->iNSTRUTORMODALIDADE->iNSTRUTOR->pESSOA->URL_FOTO, ['class' => 'img-responsive', 'id'=>'blah','style'=>'vertical-align: middle; width: 100px; height: 100px; border-radius: 50%;']); ?>
                                          <footer 'style'='font-size: 12px; padding: 4PX 91PX 10PX 0PX;'><-?=$AulaInstrutorModalidade->iNSTRUTORMODALIDADE->iNSTRUTOR->pESSOA->NOME?></footer>
                                          <!-- <a class="users-list-name" href="#"><-?php $AulaInstrutorModalidade->iNSTRUTORMODALIDADE->iNSTRUTOR->pESSOA->NOME;?></a> -->
                                          <!-- <span class="users-list-date">Idade: <-?=$AulaInstrutorModalidade->iNSTRUTORMODALIDADE->iNSTRUTOR->pESSOA->DT_NASC?></span><br> -->
                                      <!-- </li> -->
                                      <!-- <div class="col-md-4"> -->
                                      <!-- Widget: user widget style 1 -->
                                      <div class="box box-widget widget-user">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header bg-aqua-active">
                                          <h3 class="widget-user-username"><?=$AulaInstrutorModalidade->iNSTRUTORMODALIDADE->iNSTRUTOR->pESSOA->NOME?></h3>
                                          <h5 class="widget-user-desc"><?=$AulaInstrutorModalidade->iNSTRUTORMODALIDADE->iNSTRUTOR->OBS?></h5>
                                        </div>
                                        <div class="widget-user-image">
                                            <?php echo Html::img('@web/'.$AulaInstrutorModalidade->iNSTRUTORMODALIDADE->iNSTRUTOR->pESSOA->URL_FOTO, ['class' => 'img-responsive', 'id'=>'blah','style'=>'vertical-align: middle; width: 100px; height: 100px; border-radius: 50%;']); ?>
                                        </div>
                                        <div class="box-footer">
                                          <div class="row">
                                            <div class="col-sm-4 border-right">
                                              <div class="description-block">
                                                <h5 class="description-header"><?=$AulaInstrutorModalidade->iNSTRUTORMODALIDADE->iNSTRUTOR->pESSOA->dataNascimento()?></h5>
                                                <span class="description-text">IDADE</span>
                                              </div>
                                              <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 border-right">
                                              <div class="description-block">
                                                <h5 class="description-header">13,000</h5>
                                                <span class="description-text">MORADA</span>
                                              </div>
                                              <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4">
                                              <div class="description-block">
                                                <h5 class="description-header">35</h5>
                                                <span class="description-text">SEXO</span>
                                              </div>
                                              <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                          </div>
                                          <!-- /.row -->
                                        </div>
                                      </div>
                                      <!-- /.widget-user -->
                                    <!-- </div> -->
                                <?php } ?>
                           </ul>
                                <!-- /.users-list -->
              </div>
            </div>

</div>

<?php
  Modal::end();
?>
