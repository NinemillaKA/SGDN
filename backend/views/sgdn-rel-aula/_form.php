<?php

use yii\helpers\Html;
use kartik\daterange\DateRangePicker;
use kartik\form\ActiveForm;
use backend\models\SgdnPessoa;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\SgdnRelEntidadeSpot;
use backend\models\SgdnPrModalidade;
use backend\models\SgdnRelInstrutorModalidade;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelAula */
/* @var $form yii\widgets\ActiveForm */
if (!$model->isNewRecord) {

  $models_inst_mod = SgdnRelInstrutorModalidade::find() //(X)
  ->where(['PR_MODALIDADE_ID' => $model->MODALIDADE_ID])
  //->orderBy('id DESC')
  ->all();
  $lista_instrutores_mod = ArrayHelper::map($models_inst_mod,'ID',function($model){return $model->iNSTRUTOR->pESSOA->NOME;});
}
?>

<div class="sgdn-rel-aula-form">

    <?php $form = ActiveForm::begin(['id' => "sgdn-rel-aula-form"]); ?>


      <div class="row">
            <div class="col-md-2">
                <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true, 'disabled' => true]) ?>
            </div>
      </div>
      <div class="row">

          <div class="col-md-6">
              <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>
          </div>
          <div class="col-md-3">
              <?= $form->field($model, 'SPOT_ID')->dropDownList(ArrayHelper::map(SgdnRelEntidadeSpot::find()->where('ESTADO = "A"')->all(),'ID','sPOT.DESIG'),
              ['prompt'=>'*** Selecione Pico ***']) ?>
          </div>
          <div class="col-md-3" style="height: 40px">
                <?= $form->field($model, "MODALIDADE_ID")->dropDownList(ArrayHelper::map(SgdnPrModalidade::find()->where('ESTADO = "A"')->all(),'ID','DESIG'),
                ['prompt'=>'*** Selecione Modalidade ***', 'Onchange'=>'getInstructorModalidade(this);','id'=>'selectModelidade', 'class'=>'form-control' ])->label("Pico") ?>
          </div>

      </div>
       <div class="row">
          <div class="col-md-12">

                     <!-- Instrutores -->
                   <?php
                   DynamicFormWidget::begin([
                       'widgetContainer' => 'dynamicform_wrapper',
                       'widgetBody' => '.container-items', // required: css class selector
                       'widgetItem' => '.item', // required: css class
                       'limit' => 4, // the maximum times, an element can be cloned (default 999)
                       'min' => 1, // 0 or 1 (default 1)
                       'insertButton' => '.add-item', // css class
                       'deleteButton' => '.remove-item', // css class
                       'model' => $modelAulaInstrutorModalidade[0],
                       'formId' => 'sgdn-rel-aula-form',
                       'formFields' => [
                           'INSTRUTOR_MODALIDADE_ID',
                       ],
                   ]);
                   ?>
                   <div class="panel panel-default">
                       <div class="panel-heading">
                           <i class="fa fa-envelope"></i> Address Book
                           <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i>Add</button>
                           <div class="clearfix"></div>
                       </div>
                       <div class="panel-body container-items"><!-- widgetContainer -->
                         <?php foreach ($modelAulaInstrutorModalidade as $i => $instModalidade): ?>
                           <?php
                           if (!$instModalidade->isNewRecord) {
                               echo Html::activeHiddenInput($instModalidade, "[{$i}]ID");
                           }
                           ?>
                             <div class="item panel row " style="height: 40px; margin: 2px 0 0 0px">

                                     <!-- <-?php $dataPost=ArrayHelper::map(\app\models\City::find()->asArray()->all(), 'id', 'city'); ?> -->
                                     <div class="col-md-5" style="height: 40px">
                                           <?= $form->field($instModalidade, "[{$i}]INSTRUTOR_MODALIDADE_ID")->dropDownList((!$instModalidade->isNewRecord)?$lista_instrutores_mod:[],
                                           ['prompt'=>'*** Selecione Instructor ***',
                                           'id'=>'selectInstrutor', 'class'=>'form-control select-instrutor'])->label(false) ?>
                                     </div>
                                     <div class="col-md-1 " style="padding-left: 7px;padding-top: 3px">
                                         <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                     </div>
                              </div>
                         <?php endforeach; ?>
                       </div>
                   </div>
               <?php DynamicFormWidget::end(); ?>
                </div>
              </div>

            <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
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
                                'attribute' => 'DT_FIM',
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
                          <?=$form->field($model, 'PRECO', [
                              'addon' => [
                                  'prepend' => ['content' => '$', 'options'=>['class'=>'alert-success']],
                                  'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                              ]
                          ]);?>
                      </div>
                </div>
           </div>


    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">

      <?php if (!$model->isNewRecord): ?>
          $(document).ready(function(){

              $("#selectInstructorModalidade").trigger("change");
          });

      <?php endif; ?>

      function validateData(item_html){

        var flag_iselected = true;

        if($( ".select-instrutor" ).length > 1)
        {
            $( ".select-instrutor option:selected" ).each(function() {
              var selected = '<option value="'+$(this).val()+'">'+$(this).text()+'</option>';

              if( item_html.includes(selected))
              {
                  flag_iselected = false;
                  item_html = item_html.replace(selected, '');
              }
             });
          }
          return (!flag_iselected)?item_html:flag_iselected;
      }

       function getInstructorModalidade(item)
       {
           $.get( '<?=Url::to(['sgdn-rel-aula/lists'])?>',{id:item.value}, function( data ) {

             var item_id =item.id.match(/\d+/);

             var item_name = (item_id!== null)? 'selectInstrutor'+item_id : 'selectInstrutor';
             var validation = validateData(data);


             if( validation == true)
             {
               $( '#'+item_name ).html( data );
             }else if( validation != true ){
               $( '#'+item_name ).html( validation );
             }
            });
      }

      $( ".add-item" ).on( "mouseup", function(event) {
        setTimeout(function(){
          var select_novo =   $('.select-instrutor:last');

          var select_anterior = $($($(select_novo).parent().parent().parent().prev()).find('.select-instrutor'));
          var html_elem = $(select_anterior).clone();
          $(html_elem).find('option:selected').remove();

          if($(html_elem).html() !== "")
          {
              $('.select-instrutor:last').html($(html_elem).html());
          }else{
             $($('.select-instrutor:last').parent().parent().parent()).remove();
          }
        }
          ,100);

      });

</script>
