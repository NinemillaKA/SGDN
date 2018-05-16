<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SgdnPessoa;
use backend\models\SgdnRelPrecario;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAluguer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-aluguer-form">

    <?php $form = ActiveForm::begin(['id'=>'sgdn-rel-aluguer-form']); ?>
    <!-- <div class="row"> -->
        <?= $form->field($model, 'PESSOA_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
        ['prompt'=>'*** Seleciona Pessoa ***',
        'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?>
        <div id="result">
        </div>

        <?php
            DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper',
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsSgdnRelAluger[0],
                'formId' => 'sgdn-rel-aluguer-form',
                'formFields' => [
                  'PRECARIO_ID',
                  'DT_ALUGUER',
                  'DT_DEVOLUCAO',
                  'VALOR',
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
              <?php foreach ($modelsSgdnRelAluger as $i => $modelSgdnRelAluger): ?>
                  <!-- <-?php
                  if (!$materialModalidade->isNewRecord) {
                      echo Html::activeHiddenInput($modelAluger, "[{$i}]ID");
                  }
                  ?> -->
                  <div class="item panel row">
                          <div class="col-md-3" style="height: 40px">
                            <?= $form->field($modelSgdnRelAluger, "[{$i}]PRECARIO_ID")->dropDownList(ArrayHelper::map(SgdnRelPrecario::find()->where(['ESTADO'=>'A'])->all(),'ID','rELMATERIALMODALIDADE.mATERIAL.DESIG')
                            ,['prompt'=>'*** Material ***','id'=>'selectMaterial', 'class'=>'form-control'])?>
                          </div>
                          <div class="col-md-3" style="height: 40px">
                                <?= $form->field($modelSgdnRelAluger, "[{$i}]DT_ALUGUER")->textInput() ?>
                          </div>
                          <div class="col-md-3">
                              <?= $form->field($modelSgdnRelAluger, "[{$i}]DT_DEVOLUCAO")->textInput() ?>
                          </div>
                          <div class="col-md-3">
                              <?= $form->field($modelSgdnRelAluger, "[{$i}]VALOR")->textInput() ?>
                          </div>
                          <div class="col-md-3">
                              <?= $form->field($modelSgdnRelAluger, "[{$i}]OBS")->textInput(['maxlength' => true]) ?>
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

    <?php if (!$model->isNewRecord): ?>
        $(document).ready(function(){

            $("#selectPessoa").trigger("change");
        });
    <?php endif; ?>
      function getPessoa(id_pessoa)
      {
          $.get( '<?=Url::to(['sgdn-pessoa/get-pessoa'])?>',{id:id_pessoa}, function( data ) {
              $( "#result" ).html( data );

            });
      }

      //ajax for materials

      <?php if (!$model->isNewRecord): ?>
          $(document).ready(function(){

              $("#selectPessoa").trigger("change");
          });
      <?php endif; ?>
        function getPessoa(id_pessoa)
        {
            $.get( '<?=Url::to(['sgdn-pessoa/get-pessoa'])?>',{id:id_pessoa}, function( data ) {
                $( "#result" ).html( data );

              });
        }

</script>
