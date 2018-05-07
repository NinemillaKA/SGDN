<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnEntidade */

$this->title ='Entidade: '.$model->DESIG;
$this->params['breadcrumbs'][] = ['label' => 'Sgdn Entidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sgdn-entidade-view">
  <div class="box box-widget">
      <div class="row">
            <div class="box-body">
              <div class="col-md-4" >
                <div>
                    <?php echo Html::img('@web/'.$model->URL_LOGO, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:auto;border: 1px solid #d9d9d9; padding: 8px;']); ?>
                    <footer 'style'='font-size: 12px;'><!--&emsp;--><i><b>*** Imagen do Perfil ***</b></i></footer><br><b>
                    <?php if($show_buttonOrLabel == true):?>
                        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-flat btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
                            'class' => 'btn btn-flat btn-danger',
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

                        'gLBGEOGRAFIA.NOME' ,
                        'CODIGO',
                        'DESIG',
                        'OBS',
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
