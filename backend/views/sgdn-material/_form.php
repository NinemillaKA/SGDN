<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\SgdnMaterial;
use backend\models\SgdnPrMaterialTp;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnMaterial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-material-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Informacoes ... </h3>
        </div>
        <div class="box-body">
               <div class="row">
                      <div class="col-md-8">
                          <div class="col-md-4">
                                <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true, 'disabled'=>true]) ?>
                          </div>
                          <div class="col-md-6">
                                <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>
                          </div>
                          <div class="col-md-5">
                                <?= $form->field($model, 'MATERIAL_TP_ID')->textInput(['maxlength' => true])->dropDownList(ArrayHelper::map(SgdnPrMaterialTp::find()->where(['ESTADO'=>'A'])->all(),'ID','DESIG'),['prompt'=>'*** TIPO ***'])->label('MARCA')?>
                          </div>
                          <div class="col-md-10" style="margin-top: 10px;">
                                <?= $form->field($model, 'DESCR')->textArea(['id'=>'idObservacao','placeholder' => 'Enter Observação...','rows'=> '4', 'maxlength' => true])->label(false) ?>
                          </div>

                      </div>
                      <div class="col-md-4">
                          <?php $img = ($model) ? '../../'.$model->URL_LOGO : '#' ; ?>
                          <div class="upload text-center" style="background: #f4f7fa; border: 5px solid #DCDCDC; height:264px; width: 213px; overflow: hidden;'width:100% !important; ">
                            <!--img class="img-responsive" style="height: inherit !important;" id="blah" src="<?= $img ?>" alt="" /-->
                              <?php echo Html::img('@web/'.$model->URL_LOGO, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: inherit !important;']); ?>
                              <div id="papelFundo">
                                 <br><br><br><br>
                                  <i class="fa fa-upload" id='upload'></i><br>
                                 <span id="ecrevCriv">Carregar Imagen (233x216)</span>
                              </div>
                            <i class="fa fa-trash" style="background: #fff; border-radius: 4px;" id="trashd"></i>
                          </div>
                          <?= $form->field($model, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*']) ?>
                     </div>
                </div>
          </div>

        </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- Images script format -->
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
