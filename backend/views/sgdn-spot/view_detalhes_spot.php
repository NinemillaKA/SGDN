<?php

  use yii\helpers\Html;
  use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnSpot */
$this->title = 'Spot:'.$model->DESIG;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Spots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sgdn-spot-view">

    <div class="box box-widget">
        <div class="row">
            <div class="box-body">
                  <div class="col-md-5" >
                      <div>
                          <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-flat btn-primary']) ?>
                          <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
                              'class' => 'btn btn-flat btn-danger',
                              'data' => [
                                  'confirm' => 'Are you sure you want to delete this item?',
                                  'method' => 'post',
                              ],
                          ]) ?> <br><br>
                          <?php echo Html::img('@web/'.$model->URL_IMAGEM, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 245px; width:auto;border: 1px solid #d9d9d9; padding: 8px;']); ?>
                          <footer 'style'='font-size: 12px;'><b>Imagem:</b> Spot <?=$model->DESIG?></footer><br><br>
                          <?php if($show_buttonOrLabel == true):?>

                          <?php endif;?>
                      </div>
                  </div>
                  <div class="col-md-7">
                      <?= DetailView::widget([
                          'model' => $model,
                          'attributes' => [
                              // 'ID',
                              'gEOGRAFIA.NOME',
                              'CODIGO',
                              //'DESIG',
                              'DESCR',
                              // 'URL_IMAGEM:url',
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
    </div>
</div>
