<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnMaterial */

$this->title = $model->DESIG;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Materials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-material-view">

  <div class="sgdn-entidade-view">
    <div class="box box-widget">
        <div class="box-header with-border">

              <p>
                  <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary btn-flat']) ?>
                  <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
                      'class' => 'btn btn-danger btn-flat',
                      'data' => [
                          'confirm' => 'Are you sure you want to delete this item?',
                          'method' => 'post',
                      ],
                  ]) ?>
              </p>
              <div class="row">
              <div class="box-body">
                  <div class="col-md-8">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                //'ID',
                                //'MATERIAL_TP_ID',
                                'DESIG',
                                'CODIGO',
                                'URL_LOGO',
                                'DESCR',
                                'DT_REGISTO',
                                [
                                  'attribute'=>'ESTADO',
                                  'value'=>function($model){return ($model->ESTADO == 'A')?'Activo':'Inactivo';}
                                ],
                            ],
                        ]) ?>
                    </div>
                    <div class="col-md-3" >
                        <?php echo Html::img('@web/'.$model->URL_LOGO, ['style' => 'background: #f4f7fa; border: 1px solid #DCDCDC; height:264px; width: 213px; overflow: hidden; width:100% !important;']) ?>
                        <footer 'style'='font-size: 12px;'><!--&emsp;--><i><b>img</b>_material:</i> <?= $model->DESIG ?> </footer>
                    </div>
              </div></div>
        </div>
      </div>
    </div>

</div>

<?php if ($model->ESTADO_MATERIAL == 'G'): ?>
          <div class="callout callout-success">
                  <h4>Observação</h4>
                  <?= $model->DESCR ?>
          </div>
        <?php elseif ($model->ESTADO_MATERIAL == 'W'): ?>
          <div class="callout callout-warning">
                  <h4>Observação</h4>
                  <?= $model->DESCR ?>
          </div>

          <?php else: ?>
              <div class="callout callout-danger">
                      <h4>Observação</h4>
                      <?= $model->DESCR ?>
              </div>

<?php endif; ?>
