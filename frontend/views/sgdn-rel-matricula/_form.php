<?php

use yii\helpers\Html;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\SgdnPessoa;
use common\models\SgdnRelAula;
use common\models\SgdnPrMetodoPagamento;
use yii\helpers\Url;
// use dosamigos\datepicker\DatePicker;
// use wbraganca\dynamicform\DynamicFormWidget;


/* @var $this yii\web\View */
/* @var $model commom\models\SgdnRelMatricula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-matricula-form">

    <?php $form = ActiveForm::begin(['id'=>'sgdn-rel-matricula-form']); ?>
          <div class="row">
              <div class="col-md-6">

                  <div class="col-md-6">
                      <?= $form->field($model, 'OBS')->textInput(['maxlength' => true]) ?>
                  </div>

                  <div class="col-md-6" id="preco">
                      <?=$form->field($model, 'PRECO', [
                          'addon' => [
                              'prepend' => [ 'content' => '$', 'options'=>['class'=>'alert-success'],],
                              'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                          ],
                      ]);?>
                  </div>
                  <div class="col-md-6">
                      <?= $form->field($model, 'METD_PGMENT_ID')->dropDownList(ArrayHelper::map(SgdnPrMetodoPagamento::find()->where('ESTADO = "A"')->all(),'ID','DESIG'),
                       ['prompt'=>'*** Payment Mode  ***', 'Onchange'=>'getPreco(this.value);','id'=>'selectPreco', 'class'=>'form-control']) ?>
                  </div>
                  <?php if (!$model->isNewRecord): ?>
                      <div class="col-md-12">
                          <?= $form->field($model, 'ESTADO')->textInput(['maxlength' => true])->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']); ?>
                      </div>
                  <?php endif; ?>

                      <!-- <-?php endforeach; ?> -->
              </div>
              <div class="col-md-6" >
                     <div id="result">
                     </div>
              </div>
          </div>



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

      <?php if (!$model->isNewRecord): ?>
          $(document).ready(function(){

              $("#selectPreco").trigger("change");
          });
      <?php endif; ?>

      function getPreco(id_aula)
      {
          $.get( '<?=Url::to(['sgdn-rel-matricula/get-aula-price'])?>',{id:id_aula}, function( data ) {
              $( "#sgdnrelmatricula-preco" ).val(data);$( "#sgdnrelmatricula-preco" ).prop('disabled', true);
          });
      }
</script>
