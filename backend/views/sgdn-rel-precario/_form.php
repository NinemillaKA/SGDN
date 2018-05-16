<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\SgdnMaterial;
use backend\models\SgdnPrModalidade;

use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelPrecario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-precario-form">

    <?php $form = ActiveForm::begin(['id' => 'sgdn-rel-precario-form']); ?>


        <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelMaterialModalidade[0],
                'formId' => 'sgdn-rel-precario-form',
                'formFields' => [
                  'REL_MATERIAL_MODALIDADE_ID',
                  'PRECO',
                  'OBS',
                ],
            ])?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> Address Book
                <button type="button" class="pull-right add-item btn btn-primary btn-xs"><i class="fa fa-plus"></i>Add</button>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items"><!-- widgetContainer -->
              <?php foreach ($modelMaterialModalidade as $i => $materialModalidade): ?>
                  <?php
                  if (!$materialModalidade->isNewRecord) {
                      echo Html::activeHiddenInput($materialModalidade, "[{$i}]ID");
                  }
                  ?>
                  <div class="item panel row">
                          <div class="col-md-4" style="height: 40px">
                            <?= Html::dropDownList("MODALIDADE_ID[]", ''
                            , ArrayHelper::map(SgdnPrModalidade::find()->where(['ESTADO'=>'A'])->all(),'ID','DESIG')
                            ,['prompt'=>'*** Modalidade ***','Onchange'=>'getMaterialModalidade(this);','id'=>'selectModalidade', 'class'=>'form-control']) ?>
                          </div>
                          <div class="col-md-4" style="height: 40px">
                                <?= $form->field($materialModalidade, "[{$i}]REL_MATERIAL_MODALIDADE_ID")->dropDownList(ArrayHelper::map(SgdnMaterial::find()->where(['ESTADO'=>'A'])->all(),'ID','DESIG')
                                ,['prompt'=>'*** Material ***','id'=>'selectMaterial', 'class'=>'form-control'])->label(false) ?>
                          </div>
                          <div class="col-md-3">
                              <?=$form->field($materialModalidade, "[{$i}]PRECO", [
                                  'addon' => [
                                      'prepend' => ['content' => '$', 'options'=>['class'=>'alert-success']],
                                      'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                                  ]
                              ])->label(false);?>
                          </div>
                          <div class="col-md-11">
                              <?= $form->field($materialModalidade, "[{$i}]OBS")->textInput(['maxlength' => true]) ?>
                          </div>
                          <div class="col-md-1" style="padding-left: 7px;padding-top: 3px">
                              <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                          </div>
                  </div>
              <?php endforeach; ?>
            </div>
        </div>
    <?php DynamicFormWidget::end(); ?>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">

    <?php if (!$modelMaterialModalidade[0]->isNewRecord): ?>
        $(document).ready(function(){

            $("#selectModalidade").trigger("change");
        });
    <?php endif; ?>

      function getMaterialModalidade(elem)
      {
          $.get( '<?=Url::to(['sgdn-rel-precario/get-material-modalidade'])?>',{id:$(elem).val()}, function( data ) {
              $($($(elem).parent().next()).find('.select-instrutor')).html(data);
            });
      }
</script>
