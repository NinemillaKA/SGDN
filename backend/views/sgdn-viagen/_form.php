<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use backend\models\GlbGeografia;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnViagen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-viagen-form">

    <?php $form = ActiveForm::begin(['id' => 'sgdn-viagen-form']); ?>

    <div class="row">

        <div class="col-md-8">
        <?= $form->field($model, 'CODIGO')->textInput(['placeholder' => 'Enter codigo', 'maxlength' => true,'disabled'=>true])->label('Codigo')?>

        <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'DESCR')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?php $img = ($model) ? '../../'.$model->URL_IMAGEM : '#' ; ?>
            <div class="upload text-center" style="background: #f4f7fa; height: 210px; overflow: hidden; ">
                <?php echo Html::img('@web/'.$model->URL_IMAGEM, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: inherit !important;']); ?>
                <div id="papelFundo">
                   <br><br><br><br>
                    <i class="fa fa-upload" id='upload'></i><br>
                   <span id="ecrevCriv">Carregar Imagen (233x216)</span>
                </div>
                <i class="fa fa-trash" style="background: #fff; border-radius: 4px;" id="trashd"></i>
            </div>
            <?= $form->field($model, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*', 'class'=>'btn btn-default btn-block']) ?>
        </div>

    </div>

    <?php if(!$model->isNewRecord){


    } ?>

    <div class="box box-primary">
         <div class="box-header with-border">
             <h3 class="box-title">Endereço</h3>
         </div>
             <div class="row">
                 <div class="box-body">
                     <div class="col-md-12">
                     <?php if(!$model->isNewRecord){
                                   $freguesia = $model->gEOGRAFIA->FREGUESIA;
                                   $conselho = $model->gEOGRAFIA->CONCELHO;
                                   $ilha = $model->gEOGRAFIA->ILHA;
                              ?>
                                  <div class="col-md-3">
                                      <label>Ilha</label>
                                      <?= Html::dropDownList('LOCALIDADE_ID_ilha', $ilha, ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'2','PAIS'=>'238'])->all(),'ID','NOME'),['prompt'=>'*** Ilha ***','Onchange'=>'getListConselho(this.value);','id'=>'selectIlha', 'class'=>'form-control']) ?>
                                  </div>
                                  <div class="col-md-3">
                                      <label>Concelho</label>
                                      <?= Html::dropDownList('LOCALIDADE_ID_conselho', $conselho, ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE' => '3','PAIS'=>'238','ILHA'=>$ilha])->all(),'ID','NOME'),['prompt'=>'*** Concelho ***','Onchange'=>'getListFreguesia(this.value);','id'=>'selectConcelho', 'class'=>'form-control']) ?>
                                  </div>
                                  <div class="col-md-3">
                                      <label>Freguesia</label>
                                      <?= Html::dropDownList('LOCALIDADE_ID_freguesia', $freguesia, ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE' => '4','PAIS'=>'238','CONCELHO'=>$conselho])->all(),'ID','NOME'),['prompt'=>'*** Freguesia ***','Onchange'=>'getListZona(this.value);','id'=>'selectFreguesia', 'class'=>'form-control']) ?>
                                  </div>
                                  <div class="col-md-3">
                                      <?= $form->field($model, 'GEOGRAFIA_ID')->label('Zona')->dropDownList(ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238','FREGUESIA'=>$freguesia])->all(),'ID','NOME'),['prompt'=>'*** Zona ***'])?>
                                  </div>
                      <?php }else{ ?>
                                  <div class="col-md-6">
                                    <?= Html::dropDownList('LOCALIDADE_ID_ilha','', ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'2','PAIS'=>'238'])->all(),'ID','NOME'),
                                                          ['prompt'=>'*** Ilha ***','Onchange'=>'getListConselho(this.value);','id'=>'selectIlha', 'class'=>'form-control'])?>
                                    <?= Html::dropDownList('LOCALIDADE_ID_conselho','',[],['prompt'=>'*** Concelho ***','Onchange'=>'getListFreguesia(this.value);','id'=>'selectConcelho', 'class'=>'form-control']) ?>
                                  </div>
                                  <div class="col-md-6">
                                    <?= Html::dropDownList('LOCALIDADE_ID_freguesia','',[],['prompt'=>'*** Freguesia ***','Onchange'=>'getListZona(this.value);','id'=>'selectFreguesia', 'class'=>'form-control']) ?>
                                    <?= $form->field($model, 'GEOGRAFIA_ID')->dropDownList((!$model->ID) ? [] : ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238'])->all(),'ID','NOME'),['prompt' =>'*** Zona ***', 'class'=>'form-control'])->label(false) ?>
                                    <!-- <-?= $form->field($model, 'GEOGRAFIA_ID')->dropDownList((!$model->ID) ? [] : ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238'])->all(),'ID','NOME'),['prompt' =>'*** Zona ***', 'class'=>'form-control'])->label(false) ?> -->
                                  </div>
                      <?php } ?>
                           <div class="col-md-12">
                               <?= $form->field($model, 'ENDERECO')->textArea(['id'=>'idObservacao','placeholder' => 'Enter Description da localização','rows'=> '3', 'maxlength' => true])->label(false) ?>
                           </div>
                        </div>
                 </div>
           </div>
           <?php
              if(!$model->isNewRecord){
                  echo $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']);
              }
           ?>

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

        <!-- <-?= $form->field($model, 'PRECO')->textInput() ?> -->
        <div class="col-md-3" id="preco">
            <?=$form->field($model, 'PRECO', [
                'addon' => [
                    'prepend' => [ 'content' => '$', 'options'=>['class'=>'alert-success'],],
                    'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                ],
            ]);?>
        </div>
     </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
      function readURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#blah').attr('src', e.target.result);
                  $('#upload').hide();
                  $('#papelFundo').show();
                  $('#ecrevCriv').hide();
                  $('#trashd').show();
                  $('#trashd').hover($('#trashd').css('cursor','pointer'));
                  $('#papelFundo').css('opacity',0.5);
              }
              reader.readAsDataURL(input.files[0]);
          }
      }
</script>

<script type="text/javascript">

    function getListConselho(id) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                if (xmlhttp.responseText !== '<option> ------ </option>') {
                    document.getElementById("selectConcelho").innerHTML = xmlhttp.responseText;
                    document.getElementById("igtentidadeigt-localidade_id").innerHTML ='<option value>--- Zona ---</option>';
                }
            }
        };
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-spot/droplist-conselho&id=" + id;
        xmlhttp.open("GET", URL, true);
        xmlhttp.send();
    }

    function getListFreguesia(id) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                if (xmlhttp.responseText !== '<option> ------ </option>') {
                    document.getElementById("selectFreguesia").innerHTML = xmlhttp.responseText;
                    document.getElementById("igtentidadeigt-localidade_id").innerHTML = '<option value>*** Zona ***</option>';
                }
            }
        };
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-spot/droplist-freguesia&id=" + id;
        xmlhttp.open("GET", URL, true);
        xmlhttp.send();
    }
    function getListZona(id) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else { // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                if (xmlhttp.responseText !== '<option> ------ </option>') {
                    document.getElementById("sgdnviagen-geografia_id").innerHTML = xmlhttp.responseText;
                }
            }
        };
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-spot/droplist-zona&id=" + id;
        xmlhttp.open("GET", URL, true);
        xmlhttp.send();
    }

</script>
