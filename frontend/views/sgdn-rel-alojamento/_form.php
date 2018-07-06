<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use commom\models\SgdnPessoa;
use commom\models\SgdnResidencia;
use commom\models\SgdnPrMetodoPagamento;
/* @var $this yii\web\View */
/* @var $model commom\models\SgdnRelAlojamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-alojamento-form">

   <?php $form = ActiveForm::begin(['id'=>'sgdn-rel-alojamento-form']); ?>

   <div class="row">
       <div class="col-md-6">
            <?= $form->field($model, 'PESSOA_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
            ['prompt'=>'*** Seleciona Pessoa ***',
            'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?>

            <div id="result"></div>
       </div>
       <div class="col-md-6">
            <?= $form->field($model, 'RESIDENCIA_ID')->dropDownList(ArrayHelper::map(SgdnResidencia::find()->where('ESTADO = "A"')->all(),'ID','DESIG'),
            ['prompt'=>'*** Seleciona Residencia***',
            'Onchange'=>'getResidencia(this.value);','id'=>'selectResidencia', 'class'=>'form-control'])?>

            <div id="result_residencia"></div>
       </div>
   </div>

   <div class="row">

       <div class="col-md-4">

           <?php $addon = '<span class="input-group-addon">
                   <i class="glyphicon glyphicon-calendar"></i>
               </span>';
               ?>
               <label> Data Inico </label>
               <div class="input-group drp-container">
                   <?= DateRangePicker::widget([
                       'model'=>$model,
                       'attribute' => 'DT_ENTRADA',
                       'value'=>'2015-10-19 12:00 AM',
                       'useWithAddon'=>true,
                       'convertFormat'=>true,
                       'pluginOptions'=>[
                           'timePicker'=>true,
                           'timePickerIncrement'=>15,
                           'timePicker24Hour' => true,
                           'locale'=>['format' => 'Y-m-d H:i'],
                           'singleDatePicker'=>true,
                           'showDropdowns'=>true
                       ]

                   ]).$addon ?>
                </div>
           </div>

           <div class="col-md-4">
             <?php $addon = '<span class="input-group-addon">
                     <i class="glyphicon glyphicon-calendar"></i>
                 </span>';
                 ?>
             <label> Data Fim </label>
             <div class="input-group drp-container">
                 <?= DateRangePicker::widget([
                     'model'=>$model,
                     'attribute' => 'DT_SAIDA',
                     'value'=>'2015-10-19 12:00 AM',
                     'useWithAddon'=>true,
                     'convertFormat'=>true,
                     'pluginOptions'=>[
                         'timePicker'=>true,
                         'timePickerIncrement'=>15,
                         'timePicker24Hour' => true,
                         'locale'=>['format' => 'Y-m-d H:i'],
                         'singleDatePicker'=>true,
                         'showDropdowns'=>true
                     ]
                 ]).$addon ?>
              </div>
           </div>
           <div class="col-md-4">
               <?=$form->field($model, 'TOTAL', [
                   'addon' => [
                       'prepend' => [ 'content' => '$', 'options'=>['class'=>'alert-success'],],
                       'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                   ],
               ]);?>
           </div>
           <br><br><br><br><br><br><br><br><br><br>
   </div>

   <div class="row">
        <div class="col-md-8">
           <?= $form->field($model, 'OBS')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
          <?= $form->field($model, 'METD_PGMENT_ID')->dropDownList(ArrayHelper::map(SgdnPrMetodoPagamento::find()->where('ESTADO = "A"')->all(),'ID','DESIG'),
           ['prompt'=>'*** Payment Mode  ***', 'Onchange'=>'getPreco(this.value);','id'=>'selectPreco', 'class'=>'form-control']) ?>
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
</script>

<script type="text/javascript">

    <?php if (!$model->isNewRecord): ?>
        $(document).ready(function(){

            $("#selectResidencia").trigger("change");
        });
    <?php endif; ?>

    $(document).ready(function(){
        $("#sgdnrelalojamento-dt_entrada").on('change',function(){
          getPreco();
        });

        $("#sgdnrelalojamento-dt_saida").on('change',function(){
          getPreco();
        });
    });
      function getResidencia(id_residencia)
      {
          $.get( '<?=Url::to(['sgdn-residencia/get-residencia'])?>',{id:id_residencia}, function( data ) {
              $( "#result_residencia" ).html( data );

            });
      }

      function getPreco()
      {
        var dtini = $("#sgdnrelalojamento-dt_entrada").val();
        var dtfim = $("#sgdnrelalojamento-dt_saida").val();
        var res_id =  $("#selectResidencia option:selected").val();

        if(dtini != "" && dtfim != "" && res_id != "")
        {
          $.get( '<?=Url::to(['sgdn-rel-alojamento/get-price-calculator'])?>',{id:res_id,dtini:dtini,dtfim:dtfim}, function( data ) {
              $( "#sgdnrelalojamento-total" ).val(data);$( "#sgdnrelalojamento-total" ).prop('disabled', true);
          });
        }

      }
</script>
