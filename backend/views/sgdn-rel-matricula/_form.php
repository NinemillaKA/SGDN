<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnRelMatricula */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-rel-matricula-form">

    <?php $form = ActiveForm::begin(['id'=>'sgdn-rel-matricula-form']); ?>

    <?= $form->field($model, 'CODIGO')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?php if (!$model->isNewRecord){ ?>
            <?= $form->field($model, 'ALUNO_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
            ['disabled'=> true,'prompt'=>'*** Seleciona Pessoa ***',
            'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control'])

            <?= $form->field($model, 'AULA_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
            ['disabled'=> true,'prompt'=>'*** Seleciona Pessoa ***',
            'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control'])
    <?php }else{?>
            <?= $form->field($model, 'ALUNO_ID')->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
            ['disabled'=> true,'prompt'=>'*** SELECIONA PESSOA ***',
            'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control'])

            <?= $form->field($model, 'AULA_ID')->textInput(['maxlength' => true])->dropDownList(ArrayHelper::map(SgdnPessoa::find()->where('ESTADO = "A"')->all(),'ID','NOME'),
            ['disabled'=> true,'prompt'=>'*** Seleciona Pessoa ***',
            'Onchange'=>'getPessoa(this.value);','id'=>'selectPessoa', 'class'=>'form-control']) ?> // MODIFY
    <?php } ?>

    <!-- <-?= $form->field($model, 'DATA')->textInput() ?> -->

    <?= $form->field($model, 'OBS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRECO')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
