<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use backend\models\SgdnPessoa;
use backend\models\SgdnRelPrecario;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAluguer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-aluguer-form">

    <?php $form = ActiveForm::begin(['id'=>'sgdn-rel-aluguer-form']); ?>
    <!-- <div class="row"> -->
        <?=  Html::dropDownList('pessoa_id','',ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
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

                  <div class="item panel row">

                    <div class="row">
                        <div class="col-md-3" style="height: 40px">
                            <?= $form->field($modelSgdnRelAluger, "[{$i}]PRECARIO_ID")->dropDownList(ArrayHelper::map(SgdnRelPrecario::find()->where(['ESTADO'=>'A'])->all(),'ID','rELMATERIALMODALIDADE.mATERIAL.DESIG')
                            ,['prompt'=>'*** Material ***','id'=>'selectMaterial', 'class'=>'form-control'])?>
                        </div>
                        <?php $addon = '<span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            </span>';
                        ?>
                        <div class="col-md-3" style="height: 40px">
                            <label> Data Inico </label>
                            <div class="input-group drp-container">
                                <?= DateRangePicker::widget([
                                    'model'=>$modelSgdnRelAluger,
                                    'attribute' =>  "[{$i}]DT_ALUGUER",
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
                                    ],
                                    'options'=>['class'=>'form-control dt_ini', 'onchange'=>'getPreco(this,"dti")']

                                ]).$addon ?>
                            </div>
                        </div>

                        <?php $addon = '<span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                            </span>';
                        ?>
                        <div class="col-md-3" style="height: 40px">
                            <label> Data Fim </label>
                            <div class="input-group drp-container">
                                <?= DateRangePicker::widget([
                                    'model'=>$modelSgdnRelAluger,
                                    'attribute' =>  "[{$i}]DT_DEVOLUCAO",
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
                                    ],
                                    'options'=>['class'=>'form-control dt_fim', 'onchange'=>'getPreco(this,"dtf")']
                                ]).$addon ?>
                            </div>
                        </div>

                            <!--------------------------------------------------------------------------->
                          <!-- <div class="col-md-3" style="height: 40px">
                                <-?= $form->field($modelSgdnRelAluger, "[{$i}]DT_ALUGUER")->textInput() ?>
                          </div>
                          <div class="col-md-3">
                              <-?= $form->field($modelSgdnRelAluger, "[{$i}]DT_DEVOLUCAO")->textInput() ?>
                          </div> -->
                          <div class="col-md-3">
                              <?=$form->field($modelSgdnRelAluger, "[{$i}]VALOR", [
                                  'addon' => [
                                      'prepend' => [ 'content' => '$', 'options'=>['class'=>'alert-success'],],
                                      'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                                  ],
                              ]);?>
                          </div>
                      </div>
                      <div class="row">

                              <!-- <div class="col-md-3">
                                  <-?= $form->field($modelSgdnRelAluger, "[{$i}]VALOR")->textInput() ?>
                              </div> -->
                              <div class="col-md-5">
                                  <?= $form->field($modelSgdnRelAluger, "[{$i}]OBS")->textInput(['maxlength' => true]) ?>
                              </div>
                              <div class="col-md-1" style="padding-left: 7px;padding-top: 3px">
                                  <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                              </div>

                      </div>

                  </div>
              <?php endforeach; ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">

    <?php if (false): ?>
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

      <?php if (false): ?>
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



        function getPreco(elem,tipo)
        {
          if(tipo == 'dti')
          {
            var dthrini = $(elem).val();
            var dthrfim = $($($(elem).parent().parent().next()).find('input')).val();
            var res_id =   $($($(elem).parent().parent().prev()).find('select option:selected')).val();
          }else{
            var dthrini = $($($(elem).parent().parent().prev()).find('input')).val();
            var dthrfim = $(elem).val();
            var res_id =   $($($(elem).parent().parent().prev().prev()).find('select option:selected')).val();
          }


          if(dthrini != "" && dthrfim != "" && res_id != "")
          {
            $.get( '<?=Url::to(['sgdn-rel-aluguer/get-price-calculator'])?>',{id:res_id,dthrini:dthrini,dthrfim:dthrfim}, function( data ) {
                $( "#sgdnrelaluguer-0-valor" ).val(data);$( "#sgdnrelaluguer-0-valor" ).prop('disabled', true);
            });
          }

        }

        $( ".add-item" ).on( "mouseup", function(event) {
          setTimeout(function(){
              var dt_ini_picker =   $('.dt_ini:last');
              var dt_fim_picker =   $('.dt_fim:last');

              jQuery(dt_ini_picker).off('change.kvdrp').on('change.kvdrp', function() {
                    var drp = jQuery(dt_ini_picker).closest('.input-group').data('daterangepicker'), fm, to;
                    if ($(this).val() || !drp) {
                        return;
                    }
                    fm = moment().startOf('day').format('YYYY-MM-DD HH:mm') || '';
                    to = moment().format('YYYY-MM-DD HH:mm') || '';
                    drp.setStartDate(fm);
                    drp.setEndDate(to);

                });
                if (jQuery(dt_ini_picker).data('daterangepicker')) { jQuery(dt_ini_picker).daterangepicker('destroy'); }
                jQuery(dt_ini_picker).closest('.input-group').daterangepicker(daterangepicker_51dae132, function(start,end,label){
                  var val=start.format('YYYY-MM-DD HH:mm');
                  jQuery(dt_ini_picker).val(val).trigger('change');});

                  jQuery(dt_fim_picker).off('change.kvdrp').on('change.kvdrp', function() {
                        var drp = jQuery(dt_ini_picker).closest('.input-group').data('daterangepicker'), fm, to;
                        if ($(this).val() || !drp) {
                            return;
                        }
                        fm = moment().startOf('day').format('YYYY-MM-DD HH:mm') || '';
                        to = moment().format('YYYY-MM-DD HH:mm') || '';
                        drp.setStartDate(fm);
                        drp.setEndDate(to);

                    });
                    if (jQuery(dt_fim_picker).data('daterangepicker')) { jQuery(dt_fim_picker).daterangepicker('destroy'); }
                    jQuery(dt_fim_picker).closest('.input-group').daterangepicker(daterangepicker_51dae132, function(start,end,label){
                      var val=start.format('YYYY-MM-DD HH:mm');
                      jQuery(dt_fim_picker).val(val).trigger('change');});
          }
            ,100);

        });

</script>
