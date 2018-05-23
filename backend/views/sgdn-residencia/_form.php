<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\SgdnPrContactoTp;
use backend\models\GlbGeografia;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model backend\models\SgdnResidencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-residencia-form">

    <?php $form = ActiveForm::begin(['id' => 'sgdn-residencia-form']); ?>

    <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCR')->textInput(['maxlength' => true]) ?>

    <div class="col-md-4">
        <?php $img = ($model) ? '../../'.$model->URL_LOGO : '#' ; ?>
        <div class="upload text-center" style="background: #f4f7fa; height: 210px; overflow: hidden; ">
            <?php echo Html::img('@web/'.$model->URL_LOGO, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: inherit !important;']); ?>
            <div id="papelFundo">
               <br><br><br><br>
                <i class="fa fa-upload" id='upload'></i><br>
               <span id="ecrevCriv">Carregar Imagen (233x216)</span>
            </div>
          <i class="fa fa-trash" style="background: #fff; border-radius: 4px;" id="trashd"></i>
        </div>
        <?= $form->field($model, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*', 'class'=>'btn btn-default btn-block']) ?>
    </div>

    <div class="box-body">
        <div class="col-md-12">
            <?php if(!$model->isNewRecord){
                    $freguesia = $model->lOCALIDADE->FREGUESIA;
                    $conselho = $model->lOCALIDADE->CONCELHO;
                    $ilha = $model->lOCALIDADE->ILHA;
            ?>
                     <div class="col-md-3">
                         <label>Ilha</label>
                         <?= Html::dropDownList('LOCALIDADE_ID_ilha', $ilha, ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'2','PAIS'=>'238'])->all(),'ID','NOME'),
                              ['prompt'=>'*** Ilha ***','Onchange'=>'getListConselho(this.value);','id'=>'selectIlha', 'class'=>'form-control']) ?>
                     </div>
                     <div class="col-md-3">
                         <label>Concelho</label>
                         <?= Html::dropDownList('LOCALIDADE_ID_conselho', $conselho, ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE' => '3','PAIS'=>'238','ILHA'=>$ilha])->all(),'ID','NOME'),
                                ['prompt'=>'*** Concelho ***','Onchange'=>'getListFreguesia(this.value);','id'=>'selectConcelho', 'class'=>'form-control']) ?>
                     </div>
                     <div class="col-md-3">
                         <label>Freguesia</label>
                         <?= Html::dropDownList('LOCALIDADE_ID_freguesia', $freguesia, ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE' => '4','PAIS'=>'238','CONCELHO'=>$conselho])->all(),'ID','NOME'),
                                ['prompt'=>'*** Freguesia ***','Onchange'=>'getListZona(this.value);','id'=>'selectFreguesia', 'class'=>'form-control']) ?>
                     </div>
                     <div class="col-md-3">
                         <!-- <-?= $form->field($model, '')->textInput(['maxlength' => true]) ?> -->
                         <?= $form->field($model, 'LOCALIDADE_ID')->label('Zona')->dropDownList(ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238','FREGUESIA'=>$freguesia])->all(),'ID','NOME'),['prompt'=>'*** Zona ***'])?>
                     </div>

                     <?php echo $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']); ?>

         <?php }else{ ?>
                     <div class="col-md-6">
                       <?= Html::dropDownList('LOCALIDADE_ID_ilha','', ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'2','PAIS'=>'238'])->all(),'ID','NOME'),
                                             ['prosmpt'=>'*** Ilha ***','Onchange'=>'getListConselho(this.value);','id'=>'selectIlha', 'class'=>'form-control'])?>
                       <?= Html::dropDownList('LOCALIDADE_ID_conselho','',[],['prompt'=>'*** Concelho ***','Onchange'=>'getListFreguesia(this.value);','id'=>'selectConcelho', 'class'=>'form-control']) ?>
                     </div>
                     <div class="col-md-6">
                       <?= Html::dropDownList('LOCALIDADE_ID_freguesia','',[],['prompt'=>'*** Freguesia ***','Onchange'=>'getListZona(this.value);','id'=>'selectFreguesia', 'class'=>'form-control']) ?>
                       <?= $form->field($model, 'LOCALIDADE_ID')->dropDownList((!$model->ID) ? [] : ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238'])->all(),'ID','NOME'),
                                ['prompt' =>'*** Zona ***', 'class'=>'form-control'])->label(false) ?>
                     </div>
         <?php } ?>

           </div>

           <div>
               <?=$form->field($model, 'PRECO_DIA', [
                   'addon' => [
                       'prepend' => [ 'content' => '$', 'options'=>['class'=>'alert-success'],],
                       'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                   ],
               ]);?>

               <?=$form->field($model, 'VALOR', [
                   'addon' => [
                       'prepend' => [ 'content' => '$', 'options'=>['class'=>'alert-success'],],
                       'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                   ],
               ]);?>
           </div>
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
        'model' => $modelContatos[0],
        'formId' => 'sgdn-residencia-form',
        'formFields' => [
            'PR_CONTACTO_TP_ID',
            'CONTACTO',
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
          <?php foreach ($modelContatos as $i => $contacto): ?>
              <?php
              if (!$contacto->isNewRecord) {
                  echo Html::activeHiddenInput($contacto, "[{$i}]ID");
              }
              ?>
              <div class="item panel row " style="height: 40px; margin: 2px 0 0 0px">
                  <div class="col-md-4" style="height: 40px">
                      <?=$form->field($contacto, "[{$i}]PR_CONTACTO_TP_ID")->label(FALSE)->dropDownList(ArrayHelper::map(SgdnPrContactoTp::find()->where(['ESTADO'=>'A'])->all(),'ID','DESIG'),['prompt'=>'*** TIPO ***'])?>
                  </div>
                  <div class="col-md-7" style="height: 40px">
                      <?= $form->field($contacto, "[{$i}]CONTACTO", [ 'inputOptions' => ['class' =>'contactos form-control','placeholder'=>'Entre um contato...']])->label(FALSE)->textInput(['maxlength'=>true])
                      ?>
                  </div>
                  <div class="col-md-1 " style="padding-left: 7px;padding-top: 3px">
                      <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                  </div>
              </div>
          <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

    <?php ActiveForm::end(); ?>

</div>



<!-- scripts -->

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
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-residencia/droplist-conselho&id=" + id;
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
                    document.getElementById("igtentidadeigt-localidade_id").innerHTML = '<option value>--- Zona ---</option>';
                }
            }
        };
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-residencia/droplist-freguesia&id=" + id;
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
                    document.getElementById("sgdnresidencia-localidade_id").innerHTML = xmlhttp.responseText;
                }
            }
        };
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-residencia/droplist-zona&id=" + id;
        xmlhttp.open("GET", URL, true);
        xmlhttp.send();
    }

</script>
