<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SgdnPessoa;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdmInstrutor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdm-instrutor-form">

    <?php $form = ActiveForm::begin(['id' => 'sgdm-instrutor-form']); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true,]) ?>
            </div>
            <?php if (!$model->isNewRecord){ ?>
                <div class="col-md-6">
                    <?= $form->field($model, 'PESSOA_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
                    ['disabled'=> true,'prompt'=>'*** Seleciona Pessoa ***',
                    'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'OBS')->textArea(['maxlength' => true, 'line' => '2', 'placeholder' => 'Enter Some Description...']) ?>
                </div>
                <div class="col-md-12">
                      <?= $form->field($model, 'ESTADO')->dropDownList(["A" => "ACTIVO", "I" => "INACTIVO"],['prompt' =>'*** ESTADO ***', 'class'=>'form-control']) ?>
                </div>
            <?php }else{?>
                  <div class="col-md-6">
                      <?= $form->field($model, 'PESSOA_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
                      ['prompt'=>'*** Seleciona Pessoa ***',
                      'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?>
                  </div>
                  <div class="col-md-12">
                      <?= $form->field($model, 'OBS')->textArea(['maxlength' => true, 'line' => '2', 'placeholder' => 'Enter Some Description...']) ?>
                  </div>
          <?php } ?>
            <!-- <div class="col-md-6">
                <-?= $form->field($model, 'PESSOA_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
                ['prompt'=>'*** Seleciona Pessoa ***',
                'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?>
            </div>             -->



        </div>

        <div class="col-md-12" >
              <div id="result">
              </div>
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
