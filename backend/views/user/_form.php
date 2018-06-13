<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\SgdnRelPerfil;
use kartik\password\PasswordInput;
// use kartik\widgets\ActiveForm; // optional
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id'=>'user-form']); ?>

    <div class="row">

        <div class="col-md-6">
            <?php
                echo $form->field($model,'username');

                echo $form->field($model, 'email', [
                    'addon' => [
                        'prepend' => [ 'content' => '<i class="fa fa-envelope"></i>', 'options'=>['class'=>'alert-success'],],
                        // 'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                    ],
                ]);

                echo $form->field($model, 'password_hash')->widget(PasswordInput::classname(), [
                    'pluginOptions' => [
                        'showMeter' => true,
                        'toggleMask' => true
                    ]
                ]);
            ?>

            <!-- <-?= $form->field($model, 'email', [
                'addon' => [
                    'prepend' => [ 'content' => '<i class="fa fa-envelope"></i>', 'options'=>['class'=>'alert-success'],],
                    // 'append' => ['content' => '.00', 'options'=>['style' => 'font-family: Monaco, Consolas, monospace;']],
                ],
            ]);?> -->

            <?= $form->field($model, 'sgdn_rel_perfil_ID')->label(FALSE)->dropDownList(ArrayHelper::map(SgdnRelPerfil::find()->where(['ESTADO'=>'A'])->all(),'ID','DESIG'),['prompt'=>'*** Perfil ***']) ?>

        </div>

        <div class="col-md-6">

          <?php $img = ($model) ? '../../'.$model->url_perfil : '#' ; ?>
          <div class="upload text-center avatar width-full rounded-2" style="background: #f4f7fa; height: 170px; width: 170px; overflow: hidden;'style' => 'width:100% !important; ">
              <?php echo Html::img('@web/'.$model->url_perfil, ['class' => 'img-responsive', 'id'=>'blah','style'=>'height: inherit !important;']); ?>
              <div id="papelFundo">
                 <br><br><br><br>
                  <i class="fa fa-upload" id='upload'></i><br>
                 <span id="ecrevCriv">Carregar Imagen (233x216)</span>
              </div>
            <i class="fa fa-trash" style="background: #fff; border-radius: 4px;" id="trashd"></i>
          </div>
          <?= $form->field($model, 'file')->fileInput(['onchange'=>'readURL(this)','id'=>"file",'accept' => 'image/*', 'style' => 'font-size: 12px;', 'class'=>'manual-file-chooser width-full height-full ml-0 js-manual-file-chooser' ]) ?>

        </div>

    <div class="row">
        <div class="col-md-4">
          <?php if(!$model->isNewRecord){
                echo $form->field($model, 'estado')->dropDownList(["A"=>"ACTIVO", "I"=>"INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']);
             }
           ?>
        </div>
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
