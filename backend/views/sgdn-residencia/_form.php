<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SgdnResidencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sgdn-residencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'SELF_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LOCALIDADE_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESIG')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DESCR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'URL_LOGO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PRECO_DIA')->textInput() ?>

    <?= $form->field($model, 'VALOR')->textInput() ?>

    <?= $form->field($model, 'ENDERECO')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DT_REGISTO')->textInput() ?>

    <?= $form->field($model, 'ESTADO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
