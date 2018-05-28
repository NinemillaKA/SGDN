<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

?>

<div class="sgdn-residencia-view" >

    <div class="box box-widget">
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                        <div>
                        <?php echo Html::img('@web/'.$model->URL_IMAGEM, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: 200px; width:162px;border: 1px solid #d9d9d9; padding: 4px;']); ?>
                        <footer 'style'='font-size: 12px;'><b>Imagem:</b> Viagem <?=$model->DESIG?></footer><br><b><br>
                        <?php if($show_buttonOrLabel == true):?>
                        <?= Html::a('Update', ['update', 'id' => $model->ID], ['onclick' => '$("#sgdn-viagem-form").submit();', 'class' => 'btn btn-primary btn-flat', 'onclick' => 'update("' .Url::to(['update', 'id' => $model->ID]). '")', 'data-dismiss'=>'modal']) ?>
                        <!-- <-?= Html::button('Update', ['onclick' => '$("#sgdn-pr-modalidade-form").submit();', 'class' => 'btn btn-primary btn-flat']) ?> -->
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
                            // 'ID',
                            'CODIGO',
                            // 'URL_IMAGEM:url',
                            'DESIG',
                            'DESCR',
                            'GEOGRAFIA_ID',
                            'ENDERECO',
                            'DT_INICIO',
                            'DT_FIM',
                            'PRECO',
                            // 'DT_REGISTO',
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
