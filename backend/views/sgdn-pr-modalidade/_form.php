<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnPrModalidade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-pr-modalidade-form">

    <?php $form = ActiveForm::begin(['id' => 'sgdn-pr-modalidade-form']); ?>

    <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCR')->textInput(['maxlength' => true]) ?>

    <!-- <div class="col-md-4"> -->
        <?php $img = ($model) ? '../../'.$model->URL_IMAGEM : '#' ; ?>
        <div class="upload text-center" style="background: #f4f7fa; height: 180px; width:200px; overflow: hidden;'style' => 'width:100% !important; ">
          <!--img class="img-responsive" style="height: inherit !important;" id="blah" src="<?= $img ?>" alt="" /-->
            <?php echo Html::img('@web/'.$model->URL_IMAGEM, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: inherit !important;']); ?>
            <div id="papelFundo">
               <br><br><br><br>
                <i class="fa fa-upload" id='upload'></i><br>
               <span id="ecrevCriv">Carregar Imagen (233x216)</span>
            </div>
          <i class="fa fa-trash" style="background: #fff; border-radius: 4px;" id="trashd"></i>
        </div>
        <?= $form->field($model, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*', 'style' => 'font-size: 12px;' ]) ?>
    <!-- </div> -->

    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'ESTADO')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']) ?>
    <?php endif; ?>

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
