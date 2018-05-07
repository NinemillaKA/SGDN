<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\SgdnPrContactoTp;
use backend\models\SgdnPrDocumentoTp;
use app\models\SgdnEntidade;
use backend\models\GlbGeografia;
use dosamigos\datepicker\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;


?>
<div class="sgdn-entidade-form">
  <?php $form = ActiveForm::begin(['id' => 'form-entidade']); ?>

  <div class="box box-primary">
      <div class="box-header with-border">
          <h3 class="box-title">Informacoes Primordiais </h3>
      </div>

      <div class="box-body">
          <div class="row">
              <div class="col-md-8">
                 <div class="col-md-4">
                      <?= $form->field($model, 'CODIGO' )->textInput(['placeholder' => 'Enter codigo', 'maxlength' => true,'disabled'=>true])->label('Codigo')?>
                  </div>
                  <div class="col-md-10">
                    <?= $form->field($model, 'DESIG')->textInput(['id' => 'idDesignacao','placeholder' => 'Enter Designação...', 'maxlength' => true])->label('Designação') ?>
                  </div>
                  <div class="col-md-12">
                      <label for="idObservacao">Observação</label>
                      <?= $form->field($model, 'OBS')->textArea(['id'=>'idObservacao','placeholder' => 'Enter Observação...','rows'=> '4', 'maxlength' => true])->label(false) ?>
                  </div>
                  <div class="col-md-4">
                    <?php if(!$model->isNewRecord){
                          echo $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']);
                          }
                     ?>
                  </div>
                </div>
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

          </div>
      </div>
</div>

<!-- //endeeço -->
   <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Endereço</h3>
        </div>

            <div class="box-body">
                <div class="col-md-12">
                <?php if(!$model->isNewRecord){
                              $freguesia = $model->gLBGEOGRAFIA->FREGUESIA;
                              $conselho = $model->gLBGEOGRAFIA->CONCELHO;
                              $ilha = $model->gLBGEOGRAFIA->ILHA;
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
                                 <?= $form->field($model, 'GLB_GEOGRAFIA_ID')->label('Zona')->dropDownList(ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238','FREGUESIA'=>$freguesia])->all(),'ID','NOME'),['prompt'=>'*** Zona ***'])?>
                             </div>
                 <?php }else{ ?>
                             <div class="col-md-6">
                               <?= Html::dropDownList('LOCALIDADE_ID_ilha','', ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'2','PAIS'=>'238'])->all(),'ID','NOME'),
                                                     ['prompt'=>'*** Ilha ***','Onchange'=>'getListConselho(this.value);','id'=>'selectIlha', 'class'=>'form-control'])?>
                               <?= Html::dropDownList('LOCALIDADE_ID_conselho','',[],['prompt'=>'*** Concelho ***','Onchange'=>'getListFreguesia(this.value);','id'=>'selectConcelho', 'class'=>'form-control']) ?>
                             </div>
                             <div class="col-md-6">
                               <?= Html::dropDownList('LOCALIDADE_ID_freguesia','',[],['prompt'=>'*** Freguesia ***','Onchange'=>'getListZona(this.value);','id'=>'selectFreguesia', 'class'=>'form-control']) ?>
                               <?= $form->field($model, 'GLB_GEOGRAFIA_ID')->dropDownList((!$model->ID) ? [] : ArrayHelper::map(GlbGeografia::find()->where(['NIVEL_DETALHE'=>'5','PAIS'=>'238'])->all(),'ID','NOME'),['prompt' =>'*** Zona ***', 'class'=>'form-control'])->label(false) ?>
                             </div>
                 <?php } ?>
                      <div class="col-md-12">
                          <?= $form->field($model, 'ENDERECO')->textArea(['id'=>'idObservacao','placeholder' => 'Enter Description','rows'=> '3', 'maxlength' => true])->label(false) ?>
                      </div>
                   </div>
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
        'formId' => 'form-entidade',
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

    <!-- documentos -->

    <?php
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper1',
        'widgetBody' => '.container-items1', // required: css class selector
        'widgetItem' => '.item1', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item1', // css class
        'deleteButton' => '.remove-item1', // css class
        'model' => $modelDocumentos[0],
        'formId' => 'form-entidade',
        'formFields' => [
            'PR_DOCUMENTO_TP_ID',
            'NUMERO',
            'DT_EMISSAO',
            'DT_VALIDADE',
            'URL_DOCUMENTO',
        ],
    ]);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> Documents
            <button type="button" class="pull-right add-item1 btn btn-success btn-xs"><i class="fa fa-plus"></i>Add</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items1"><!-- widgetContainer -->
          <?php foreach ($modelDocumentos as $i => $documento): ?>
              <?php
              if (!$documento->isNewRecord) {
                  echo Html::activeHiddenInput($documento, "[{$i}]ID");
              }
              ?>
              <div class="item1 panel row " style="height: 40px; margin: 2px 0 0 0px">
                  <div class="col-md-2" style="height: 40px">
                      <?= $form->field($documento, "[{$i}]PR_DOCUMENTO_TP_ID")->label(FALSE)->dropDownList(ArrayHelper::map(SgdnPrDocumentoTp::find()->where(['ESTADO'=>'A'])->all(),'ID','DESIG'),['prompt'=>'*** TIPO ***']) ?>
                  </div>
                  <div class="col-md-2" style="height: 40px">
                      <?= $form->field($documento, "[{$i}]NUMERO")->label(FALSE)->textInput(['maxlength' => true, 'placeholder' => 'NUM DOC']) ?>
                  </div>
                  <div class="col-md-2" style="height: 40px">
                      <?= $form->field($documento, "[{$i}]DT_EMISSAO")->widget(
                                    DatePicker::className(), [
                                       'options' => ['placeholder' => 'DT_EMITD'],
                                       'template' => '{addon}{input}',
                                       'clientOptions' => [
                                            'autoclose' => true,
                                            'format' => 'dd-mm-yyyy'
                                        ]
                                ])->label(false); ?>
                  </div>
                  <div class="col-md-2" style="height: 40px">
                      <?= $form->field($documento, "[{$i}]DT_VALIDADE")->widget(
                                    DatePicker::className(), [
                                        'options' => ['placeholder' => 'DT_VALID'],
                                        'template' => '{addon}{input}',
                                        'clientOptions' => [
                                            'autoclose' => true,
                                            'format' => 'dd-mm-yyyy'
                                        ]
                                ])->label(false); ?>
                  </div>
                  <div class="col-md-3" style="height: 40px">
                      <!-- <-?php if (!$documento->isNewRecord): ?>
                                 <-?= Html::a('<i class="fa fa-download"></i>', ['sample-download','filename'=>$documento->URL_DOCUMENTO], ['class' => '']) ?>
                      <-?php endif; ?> -->

                      <?= $form->field($documento, "[{$i}]docfile")->label(FALSE)->fileInput(['maxlength' => true, 'style' => 'margin: 5px 5px 2px 11px;'] ) ?>
                  </div>
                  <div class="col-md-1 " style="padding-left: 7px;padding-top: 3px">
                      <button type="button" class="remove-item1 btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                  </div>
              </div>
          <?php endforeach; ?>
        </div>
    </div>
<?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-entidade/droplist-conselho&id=" + id;
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
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-entidade/droplist-freguesia&id=" + id;
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
                    document.getElementById("sgdnentidade-glb_geografia_id").innerHTML = xmlhttp.responseText;
                }
            }
        };
        var URL = "<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseURL ?>/index.php?r=sgdn-entidade/droplist-zona&id=" + id;
        xmlhttp.open("GET", URL, true);
        xmlhttp.send();
    }

</script>
