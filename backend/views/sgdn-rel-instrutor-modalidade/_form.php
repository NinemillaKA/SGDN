<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SgdnPrModalidade;
use backend\models\SgdmInstrutor;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelInstrutorModalidade */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-instrutor-modalidade-form">

    <?php $form = ActiveForm::begin(['id' => 'sgdn-rel-instrutor-modalidade-form']); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true, 'disabled' => true]) ?>
            </div>
            <?php if (!$model->isNewRecord){ ?>
                    <div class="col-md-4">
                        <?= $form->field($model, 'INSTRUTOR_ID')->dropDownList(ArrayHelper::map(SgdmInstrutor::find()->where('ESTADO = "A"')->all(),'ID','pESSOA.NOME'),
                        ['Disabled' => true]) ?>

                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'PR_MODALIDADE_ID')->dropDownList(ArrayHelper::map(SgdnPrModalidade::find()->where('ESTADO = "A"')->all(),'ID','DESIG'),
                        ['Disabled' => true]) ?>
                    </div>
            <?php }else{?>
                    <div class="col-md-4">
                        <?= $form->field($model, 'INSTRUTOR_ID')->dropDownList(ArrayHelper::map(SgdmInstrutor::find()->where('ESTADO = "A"')->all(),'ID','pESSOA.NOME'),
                        ['prompt'=>'*** Selecione Intrutor ***',
                        'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?>

                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'PR_MODALIDADE_ID')->dropDownList(ArrayHelper::map(SgdnPrModalidade::find()->where('ESTADO = "A"')->all(),'ID','DESIG'),
                        ['prompt'=>'*** Selecione a Modalidade ***']) ?>
                    </div>
            <?php } ?>
            <!-- <div class="col-md-6">
                  <-?= $form->field($model, 'DATA')->textInput() ?>
            </div> -->
            <div class="col-md-12">
                <?= $form->field($model, 'OBS')->textArea(['maxlength' => true, 'line' => '2', 'placeholder' => 'Enter Some Description...']) ?>
            </div>
        </div>

        <div class="col-md-12" >
              <div id="result">
              </div>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">

    //get_pessoa
    // <-?php if (!$model->isNewRecord): ?>
    //     $(document).ready(function(){
    //
    //         $("#selectPessoa").trigger("change");
    //     });
    // <-?php endif; ?>
      function getPessoa(id_pessoa)
      {
          $.get( '<?=Url::to(['sgdn-pessoa/get-pessoa1'])?>',{id:id_pessoa}, function( data ) {
              $( "#result" ).html( data );

            });
      }
</script>
