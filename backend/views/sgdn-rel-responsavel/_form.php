<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SgdnPessoa;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;
use backend\models\SgdnResidencia;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelResponsavel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-responsavel-form">

    <?php $form = ActiveForm::begin(['id'=>'sgdn-rel-responsavel-form']); ?>

    <!-- <-?= $form->field($model, 'PESSOA_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
    ['prompt'=>'*** Seleciona Pessoa ***',
    'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?-> -->

     <div class="row">
         <div class="col-md-6">
              <?= $form->field($model, 'PESSOA_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
              ['prompt'=>'*** Seleciona Pessoa ***',
              'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?>

              <div id="result"></div>
         </div>
         <div class="col-md-6">
              <?= $form->field($model, 'REL_RESIDENCIA_ID')->dropDownList(ArrayHelper::map(SgdnResidencia::find()->where('ESTADO = "A"')->all(),'ID','DESIG'),
              ['prompt'=>'*** Seleciona Residencia***',
              'Onchange'=>'getResidencia(this.value);','id'=>'selectResidencia', 'class'=>'form-control'])?>

              <div id="result_residencia"></div>
         </div>
     </div>
     <div class="row">
         <div class="col-md-12" >
            <?php if (!$model->isNewRecord): ?>
                <?= $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']) ?>
            <?php endif; ?>
         </div>
     </div>

      <div class="row">

          <div class="col-md-6">

              <?php $addon = '<span class="input-group-addon">
                      <i class="glyphicon glyphicon-calendar"></i>
                  </span>';
                  ?>
                  <label> Data Inico </label>
                  <div class="input-group drp-container">
                      <?= DateRangePicker::widget([
                          'model'=>$model,
                          'attribute' => 'DT_INICIO',
                          'value'=>'2015-10-19 12:00 AM',
                          'useWithAddon'=>true,
                          'convertFormat'=>true,
                          'pluginOptions'=>[
                              'timePicker'=>false,
                              'timePickerIncrement'=>15,
                              'timePicker24Hour' => false,
                              'locale'=>['format' => 'Y-m-d'],
                              'singleDatePicker'=>true,
                              'showDropdowns'=>true
                          ]
                      ]).$addon ?>
                   </div>
              </div>

              <div class="col-md-6">
                <?php $addon = '<span class="input-group-addon">
                        <i class="glyphicon glyphicon-calendar"></i>
                    </span>';
                    ?>
                <label> Data Fim </label>
                <div class="input-group drp-container">
                    <?= DateRangePicker::widget([
                        'model'=>$model,
                        'attribute' => 'DT_FIM',
                        'value'=>'2015-10-19 12:00 AM',
                        'useWithAddon'=>true,
                        'convertFormat'=>true,
                        'pluginOptions'=>[
                            'timePicker'=>false,
                            'timePickerIncrement'=>15,
                            'timePicker24Hour' => true,
                            'locale'=>['format' => 'Y-m-d'],
                            'singleDatePicker'=>true,
                            'showDropdowns'=>true
                        ]
                    ]).$addon ?>
                 </div>
              </div>

          </div>

        <br><br><br><br><br><br><br><br>



    <?php ActiveForm::end(); ?>

</div>
<!-- Ajax Scripts -->

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
      function getResidencia(id_residencia)
      {
          $.get( '<?=Url::to(['sgdn-residencia/get-residencia'])?>',{id:id_residencia}, function( data ) {
              $( "#result_residencia" ).html( data );

            });
      }
</script>
